@extends('public.index')


@section('extracontent')
@php
  switch(config('database.default'))
  {
    case('pgsql'):
      $initcapvoice = "initcap(voice)";
      break;
    case('mysql'):
      $initcapvoice = "CONCAT(UCASE(LEFT(voice,1)),SUBSTRING(VOICE,2))";
      break;
  }
  $q1 = "SELECT
            {$initcapvoice} AS voice,
            COUNT(userid) as choristers
          FROM
            v_cols_choral
          GROUP BY
            voice ORDER BY
            CASE voice WHEN 'soprano' THEN 1
                       WHEN 'alto' THEN 2
                       WHEN 'tenor' THEN 3
                       WHEN 'bass' THEN 4 END";
  $q0 = "WITH a AS (
          SELECT *
          FROM f_aicsachoirs
          UNION
          SELECT *
          FROM f_nonaicsachoirs
        ), b AS (
          SELECT userid,1/count(choirshortname) AS scaled
          FROM a
          GROUP BY userid
        )
          SELECT city,ROUND(SUM(scaled)) as numfrom
          FROM a NATURAL JOIN b
          GROUP BY city";
  $q = "SELECT
          choirprintname,
          count(userid) as count
        FROM (
          SELECT userid,choirname,choirshortname,choirname as choirprintname FROM f_aicsachoirs
          UNION
          SELECT userid,choirname,choirshortname,choirname as choirprintname FROM f_nonaicsachoirs
        ) T
        GROUP BY
          choirname,
          choirshortname,
          choirprintname
        ORDER BY
          count DESC";
  $voicecount = DB::select($q1,[]);
  $citycount = DB::select($q0,[]);
  $choircount = DB::select($q,[]);
  $citytotal = 0;
@endphp
<h3>Who’s coming</h3>
<p>The choir looks like:</p>
<ul class="mdl-list">
  <li class="mdl-list__item mdl-list__item--two-line">
    @foreach($voicecount as $row)
      <span class="mdl-list__item-primary-content">
        <span>{{ $row->voice }}</span>
        <span class="mdl-list__item-sub-title">{{ $row->choristers }}</span>
      </span>
    @endforeach
  </li>
</ul>
<p>So far, we have choristers joining the festival from the following cities:</p>
<ul class="mdl-list">
  <li class="mdl-list__item mdl-list__item--two-line">
    @foreach($citycount as $row)
      @php $citytotal = $citytotal + $row->numfrom; @endphp
      <span class="mdl-list__item-primary-content">
        <span>{{ $row->city }}</span>
        <span class="mdl-list__item-sub-title">{{ $row->numfrom }}</span>
      </span>
    @endforeach
      <span class="mdl-list__item-primary-content">
        <span>Other/unknown</span>
        <span class="mdl-list__item-sub-title">{{ (DB::table('v_cols_essential')->where('doing_singing',1)->count()) - $citytotal }}</span>
      </span>
  </li>
</ul>
<p>Made up from members of the following choirs:</p>
<ul class="mdl-list">
  <li class="mdl-list__item mdl-list__item--two-line">
    @foreach($choircount as $row)
      <span class="mdl-list__item-primary-content">
        <span>{{ $row->choirprintname }}</span>
        <span class="mdl-list__item-sub-title">{{ $row->count }}</span>
      </span>
    @endforeach
  </li>
</ul>

{{--
<p>The choir looks like:</p>
  <div class="table-responsible">
    <table class=mdl-data-table mdl-js-data-table">
      <thead>
        <tr><th class="mdl-data-table__cell--non-numeric">Voice</th><th>Choristers</th></tr>
      </thead>
      <tbody>
        @foreach($voicecount as $voicerow)
          <tr>
            <td class="mdl-data-table__cell--non-numeric">{{ $voicerow->voice }}</td><td>{{ $voicerow->choristers }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <p></p>
<p>So far, we have choristers joining the festival from the following cities:</p>
  <div class="table-responsible">
    <table class=mdl-data-table mdl-js-data-table">
      <thead>
        <tr><th class="mdl-data-table__cell--non-numeric">City</th><th>Choristers</th></tr>
      </thead>
      <tbody>
        @foreach($citycount as $cityrow)
          @php $citytotal = $citytotal + $cityrow->numfrom; @endphp
          <tr>
            <td class="mdl-data-table__cell--non-numeric">{{ $cityrow->city }}</td><td>{{ $cityrow->numfrom }}</td>
          </tr>
        @endforeach
          <tr>
            <td class="mdl-data-table__cell--non-numeric">Other/unknown</td><td>{{ (DB::table('v_cols_essential')->where('doing_singing',1)->count()) - $citytotal }}</td>
          </tr>
      </tbody>
    </table>
  </div>
  <p></p>
<p>Made up from members of the following choirs:</p>
  <div class="table-responsible">
    <table class=mdl-data-table mdl-js-data-table">
      <thead>
        <tr><th class="mdl-data-table__cell--non-numeric">Choir</th><th>Choristers</th></tr>
      </thead>
      <tbody>
        @foreach($choircount as $choirrow)
          <tr>
            <td class="mdl-data-table__cell--non-numeric">{{ $choirrow->choirprintname }}</td><td>{{ $choirrow->count }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
--}}

@stop


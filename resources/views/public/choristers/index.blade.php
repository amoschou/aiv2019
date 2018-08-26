@extends('public.index')

@section('extracontent')
@php
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
  $citycount = DB::select($q0,[]);
  $choircount = DB::select($q,[]);
  $citytotal = 0;
@endphp
<h3>Who’s coming</h3>
<p>So far, we have choristers joining the festival from the following cities:</p>
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
  <p></p>
<p>Made up from members of the following choirs:</p>
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
@stop


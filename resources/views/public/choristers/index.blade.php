@extends('public.index')

@section('extracontent')
<h3>Who’s coming</h3>
<p>So far, we have choristers joining the festival from the following cities and choirs.</p>
@php
  $q = "WITH a AS (
          SELECT *
          FROM f_aicsachoirs
          UNION
          SELECT *
          FROM f_nonaicsachoirs
        ), b AS (
          SELECT userid,1/count(choirshortname) AS scaled
          FROM a
          GROUP BY userid
        ), c AS (
          SELECT city,ROUND(SUM(scaled)) as numfrom
          FROM a NATURAL JOIN b
          GROUP BY city
        )
        SELECT * FROM c";
  $citycount = DB::select($q,[]);
@endphp
  <table>
    <thead>
      <tr><th>Choir</th><th>Choristers</th></tr>
    </thead>
    <tbody>
      @foreach($citycount as $cityrow)
        <tr>
          <th>{{ $cityrow->city }}</th><td>{{ $cityrow->numfrom }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
@php
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
  $choircount = DB::select($q,[]);
@endphp
  <table>
    <thead>
      <tr><th>Choir</th><th>Choristers</th></tr>
    </thead>
    <tbody>
      @foreach($choircount as $choirrow)
        <tr>
          <th>{{ $choirrow->choirprintname }}</th><td>{{ $choirrow->count }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
@stop
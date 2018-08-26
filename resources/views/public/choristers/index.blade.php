@extends('public.index')

@section('extracontent')
<h3>Who’s coming</h3>
@php
  $q = "SELECT
  choirname,
  choirshortname,
  count(userid) as count
FROM (
  SELECT * FROM f_aicsachoirs
  UNION SELECT * FROM f_nonaicsachoirs
) T
GROUP BY
  choirname,
  choirshortname
ORDER BY
  count DESC";

  $choircount = DB::select($q,[]);
@endphp
  <table>
    <thead>
      <tr><th>Choir</th><th>Choirsters</th></tr>
    </thead>
    <tbody>
      @foreach($choircount as $choirrow)
        <tr>
          <th>{{ $choirrow->choirname }}</th><td>{{ $choirrow->count }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
@stop
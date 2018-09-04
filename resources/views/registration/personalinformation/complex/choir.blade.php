@extends('registration.layouts.appwithnotopbox')

@section('innercontent')

  <h1>Repertoire</h1>

  @php
    $scorekeys = [
      'arnesen',
      'part',
      'esenvalds',
      'gjeilo',
      'sandstrom',
      'dove',
      'lauridsenii',
      'lauridseniii',
      'whitacre'
    ];
  $scorekeyslist = '';
  $comma = '';
  foreach($scorekeys as $key) {
    $scorekeyslist .= $comma . "'score". $key ."'";
    $comma = ',';
  }
  $q = "
          WITH a AS (
              SELECT userid, questionshortname, json_unquote(responsejson) as act
              FROM rego_responses
              WHERE questionshortname in
              ('scorearnesen','scorepart','scoreesenvalds','scoregjeilo','scoresandstrom','scoredove','scorelauridsenii','scorelauridseniii','scorewhitacre')
          ), b AS (
              SELECT questionshortname, act, count(userid) as frequency
              FROM a
              GROUP BY act, questionshortname
          ), c AS (
              SELECT COUNT(id) as numsingers FROM v_cols_essential WHERE doing_singing = 1 
          )

          SELECT
            questionshortname,
            SUM(CASE WHEN act = 'buy' THEN frequency END) AS buy,
            SUM(CASE WHEN act = 'borrow' THEN frequency END) AS borrow,
            SUM(CASE WHEN act = 'bring' THEN frequency END) AS bring,
            (SELECT numsingers FROM c) - SUM(frequency) as unknown
          FROM
            b
          GROUP BY questionshortname
  ";
  $c = ['questionshortname','buy','borrow','bring','unknown'];
  $h = ['Repertoire','Buy','Borrow','Bring','Unknown'];
  @endphp
  
  <h2>Summary</h2>
  <table id="datatable" class="table table-sm table-striped table-bordered">
    <thead class="thead-dark">
      @foreach($h as $hh)
        <th scope="col">{{ $hh }}</th>
      @endforeach
    </thead>
    @php
      $rows = DB::select($q,[]);
    @endphp
    @foreach($rows as $row)
      <tr>
        @foreach($c as $cc)
          <td>{{ $row->{$cc} }}</td>
        @endforeach
      </tr>
    @endforeach
  </table>
  
  @php
    $q = "
    
    WITH a AS (
              SELECT userid, questionshortname, json_unquote(responsejson) as act
              FROM rego_responses
              WHERE questionshortname in
              ('scorearnesen','scorepart','scoreesenvalds','scoregjeilo','scoresandstrom','scoredove','scorelauridsenii','scorelauridseniii','scorewhitacre')
          )
          
          select
            userid,firstname,lastname,
            questionshortname,act
          from
            a join v_cols_essential on (id=userid)
          ORDER BY
            act,questionshortname
    ";
  $c = ['userid','firstname','lastname','questionshortname','act'];
  $h = ['ID','First name','Last name','Repertoire','Action'];
  @endphp
  
  <h2>Individual records</h2>
  <p>Use the search bar to filter this table. For example search for ‘part buy’ to find out who is buying the Pärt.</p>
  <table id="datatable2" class="table table-sm table-striped table-bordered">
    <thead class="thead-dark">
      @foreach($h as $hh)
        <th scope="col">{{ $hh }}</th>
      @endforeach
    </thead>
    @php
      $rows = DB::select($q,[]);
    @endphp
    @foreach($rows as $row)
      <tr>
        @foreach($c as $cc)
          <td>{{ $row->{$cc} }}</td>
        @endforeach
      </tr>
    @endforeach
  </table>
  
  <h2>Choristes who don’t know</h2>
  @php
    $q = "
  WITH a AS (
              SELECT userid, questionshortname, json_unquote(responsejson) as act
              FROM rego_responses
              WHERE questionshortname in
              ('scorearnesen','scorepart','scoreesenvalds','scoregjeilo','scoresandstrom','scoredove','scorelauridsenii','scorelauridseniii','scorewhitacre')
          )

SELECT id,firstname,lastname FROM v_cols_essential WHERE doing_singing = 1 AND id NOT IN (SELECT userid FROM a GROUP BY userid)
    ";
  $c = ['id','firstname','lastname'];
  $h = ['ID','First name','Last name'];
  @endphp
  
  <p>The number of people in this table should match the number of unknowns in the first table.</p>
  <table id="datatable2" class="table table-sm table-striped table-bordered">
    <thead class="thead-dark">
      @foreach($h as $hh)
        <th scope="col">{{ $hh }}</th>
      @endforeach
    </thead>
    @php
      $rows = DB::select($q,[]);
    @endphp
    @foreach($rows as $row)
      <tr>
        @foreach($c as $cc)
          <td>{{ $row->{$cc} }}</td>
        @endforeach
      </tr>
    @endforeach
  </table>
  
@endsection

@section('extrastyles')
  <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
  @endsection
@section('extrascripts')
  <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
  <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
  <script>
    $(document).ready(function() {
        $('#datatable').DataTable();
        $('#datatable2').DataTable();
    } );
  </script>
@endsection



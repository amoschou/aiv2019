@extends('registration.layouts.appwithnotopbox')

@section('innercontent')
  <h1>{{ DB::table('rego_sections')->select('sectionname')->where('sectionid',$sectionid)->first()->sectionname }}</h1>
  @switch($sectionid)
    @case(1)
      @php
        $q = "SELECT * FROM v_cols_essential order by lastname,firstname,id";
        $c = ['id','firstname','lastname','pronoun','adelaide','doing_singing','doing_social','doing_billeting','doing_camp'];
        $h = ['ID','First name','Last name','Pronoun','Adelaide','Singing','Social','Billeting','Camp'];
      @endphp
      @break
    @case(2)
      @break
    @case(3)
      @bre4k
    @case(4)
      @break
    @case(5)
      @break
    @case(6)
      @break
    @case(7)
      @break
  @endswitch
  
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
    
@endsection

@section('extrascripts')
  <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
  <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
  <script>
    $(document).ready(function() {
        $('#datatable').DataTable();
    } );
  </script>
@endsection



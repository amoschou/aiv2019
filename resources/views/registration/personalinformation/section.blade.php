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
      @php
        $q = "SELECT id,firstname,lastname,phonebefore,phoneduring,post,student,youth,specialrequirements,ivhistory FROM v_cols_personal natural join v_cols_essential order by lastname,firstname,student,youth";
        $c = ['id','firstname','lastname','phonebefore','phoneduring','post','student','youth','specialrequirements','ivhistory'];
        $h = ['ID','First name','Last name','Phone before','Phone during','Post','Student','Youth','Special requirements','IV history'];
      @endphp
      @break
    @case(3)
        $q = "SELECT id,firstname,lastname,emergencyname,emergencyrelationship,emergencyphone,emergencyadditions FROM v_cols_emergency natural join v_cols_emergency order by lastname,firstname";
        $c = ['id','firstname','lastname','emergecyname','emergencyrelationship','emergencyphone'];
        $h = ['ID','First name','Last name','Emergency contact name','Emergency contact relationship','Emergency contact phone','Emergency more information'];
      @break
    @case(4)
      @php
        $q = "SELECT userid as id,firstname,lastname,voice,divisi,sometimessoprano,sometimesalto,sometimestenor,sometimesbass FROM v_cols_choral join v_cols_essential on (id=userid) order by voice,divisi,lastname,firstname,sometimessoprano,sometimesalto,sometimestenor,sometimesbass";
        $c = ['id','firstname','lastname','voice','divisi','sometimessoprano','sometimesalto','sometimestenor','sometimesbass'];
        $h = ['ID','First name','Last name','Voice','Divisi line','Also S','Also A','Also T','Also B'];
      @endphp
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
    } );
  </script>
@endsection



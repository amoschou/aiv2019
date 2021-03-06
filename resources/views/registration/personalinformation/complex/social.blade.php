@extends('registration.layouts.appwithnotopbox')

@section('innercontent')

  <h1>List of academic dinner tickets</h1>
  
  <p>In addition to the big lists below, also include in the dinner if they are not already listed there:</p>
  <ul>
    <li>Peter Kelsall</li>
    <li>Trish Kelsall</li>
    <li>Alistair Knight</li>
    <li>Phoebe Knight</li>
    <li>Everybody who signed up using the separate Google form at <a href="https://docs.google.com/spreadsheets/d/1DOJxagLDSDMxZoYLKej6C_fRhiQtI3Mbc09npnkcyuI">https://docs.google.com/spreadsheets/d/1DOJxagLDSDMxZoYLKej6C_fRhiQtI3Mbc09npnkcyuI</a></li>
  </ul>
  
  <p>Dietary requirements are available at <a href="https://www.aiv.org.au/home/personalinformation/section/10">https://www.aiv.org.au/home/personalinformation/section/10</a>.</p>

  @php
    $q = "select json_remove(responsejson,json_unquote(json_search(responsejson,'one','hiddeninput'))) as guests from rego_responses where questionshortname = 'acdinnerguest' and responsejson <> '[\"hiddeninput\"]'";
  $c = ['guests'];
  $h = ['Guests'];
  @endphp
  
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
    $q = "select userid,firstname,lastname from rego_responses join v_cols_essential on (userid=id) where questionshortname = 'acdinner' and responsejson = '\"yes\"' order by userid";
  $c = ['userid','firstname','lastname'];
  $h = ['ID','First name','Lastname'];
  @endphp
  
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
  <link href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css" rel="stylesheet">
  @endsection
@section('extrascripts')
  <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
  <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
  <script>
    $(document).ready(function() {
        $('#datatable2').DataTable({
            dom: 'Bfrtip',
            buttons: ['copy','csv','excel','pdf','print']
        });
    });
  </script>
@endsection



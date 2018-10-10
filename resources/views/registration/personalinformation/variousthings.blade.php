@extends('registration.layouts.appwithnotopbox')

@section('innercontent')
  <h1>Various things</h1>
  
  <h2>iv_users table</h2>
  <p>Warning: This table also includes false accounts. Be careful when using it that the ID and reference number match up to who you want.</p>
  @php
    $q = "select id,accountref,email,username from iv_users";
    $c = ['id','accountref','email','username'];
    $h = ['ID','Account reference number','Email','Username'];
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



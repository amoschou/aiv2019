@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    {{--
    <div class="col-md-8">
      <div class="card card-default">
        <div class="card-header">Dashboard</div>
        <div class="card-body">
        </div>
      </div>
    </div>
    --}}
    <table class="table table-bordered bg-light my-0 border-top-0">
      <thead>
        <tr>
          <th>Question</th>
          <th>Response</th>
        </tr>
      </thead>
      <tbody>
        @foreach($responsetable as $row)
          <tr>
            <td>{{ $row->questiontext }}</td>
            <td>
              @php
                $object = json_decode($row->responsejson);
                
                $done = False;
                
                // IS IT A STRING?
                if(is_string($object))
                {
                  echo ucfirst($object);
                  $done = True;
                }
                
                // IS IT AN ARRAY?
                if(is_array($object))
                {
                  // IS IT AN ARRAY OF STRINGS?
                  $arrayofstrings = True;
                  foreach($object as $element)
                  {
                    if(!is_string($element))
                    {
                      $arrayofstrings = False;
                    }
                  }
                  if($arrayofstrings)
                  {
                    echo ucfirst(implode(', ',$object));
                    $done = True;
                  }
                  
                  // EVERY THING ELSE
                  echo !$done ? $row->responsejson : '' ;
                }
              @endphp
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection

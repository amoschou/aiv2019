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
        @php
          $sections = DB::table('rego_mustask')
                        ->join('rego_sections','rego_mustask.sectionid','=','rego_sections.sectionid')
                        ->leftJoin('rego_subsections','rego_subsections.sectionid','=','rego_sections.sectionid')
                        ->where('userid',Auth::id())
                        ->where('submitted',True)
                        ->select('rego_sections.sectionid','rego_sections.sectionname','rego_subsections.subsectionname')
                        ->get();
        @endphp
        @foreach($sections as $section)
          <thead>
            <tr>
              <th>{{ $section->sectionname }}{{ is_null($section->subsectionname) ? '' : ': '.$section->subsectionname }}</th>
              <th>Responses (<a href="/home/registration/{{ $section->sectionid }}">Edit</a>)</th>
            </tr>
          </thead>
          <tbody>
            @php
              $responsetable = DB::table('rego_questions')
                                 ->join('rego_responses','rego_questions.questionshortname','=','rego_responses.questionshortname')
                                 ->join('rego_sections','rego_questions.sectionid','=','rego_sections.sectionid')
                                 ->leftJoin('rego_subsections','rego_subsections.sectionid','=','rego_sections.sectionid')
                                 ->where('userid',Auth::id())
                                 ->select('rego_sections.sectionid','rego_subsections.subsectioncode','questiontext','rego_questions.questionshortname','responsejson')
                                 ->get();
            @endphp
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
                      if($object === 'othertext')
                      {
                        echo ucfirst(json_decode(DB::table('rego_responses_nofk')->where('userid',Auth::id())->where('attributename',$row->questionshortname.':othertext')->value('responsejson')));
                      }
                      else
                      {
                        echo ucfirst($object);
                      }
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
          </tbody
        @endforeach
        
    </table>
  </div>
</div>
@endsection

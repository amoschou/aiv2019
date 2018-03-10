@extends('registration.layouts.app')

@include('registration.form.stylesheets')
@include('registration.form.scripts')

@section('content')

<div class="container">
  <div class="row justify-content-md-center">
    <div class="col-md-12">
      @php
        if(isset($singlesectionid))
        {
          $sections = DB::table('rego_sections')
                        ->select('sectionid','sectionname','sectiondescr')
                        ->where('sectionid',$singlesectionid)
                        ->orderBy('sectionord','asc')
                        ->get();
        }
        else
        {
          $sections = DB::table('rego_sections')
                        ->select('sectionid','sectionname','sectiondescr')
                        ->orderBy('sectionord','asc')
                        ->get();
        }
      @endphp
      @foreach ($sections as $section)
        <div class="card mb-4 border-primary rounded-0">
          <div class="card-header border-primary rounded-0 bg-primary text-white">{{ $section->sectionname }}</div>
            <div class="list-group list-group-flush">
              @if(!is_null($section->sectiondescr))
                <div class="list-group-item text-info border-primary" class="info">
                 {!! $section->sectiondescr !!}
                </div>
              @endif
              <div class="list-group-item border-primary">
                General tips<br>
                If a question does not apply to you, it is best to <strong>leave it empty</strong>.
                Putting ‘N/A’ or ‘0’ or something similar draws our attention to the wrong places and makes our job harder.
              </div>
            </div>
          <div class="card-body">
            <form class="form-horizontal" method="POST" action="/home/registration/{{ $section->sectionid }}" enctype="multipart/form-data">
              {{ csrf_field() }}
              <input type="hidden" name="foritem" value="{{ $foritem }}">
              @php
                $hassubsections = 0 !== DB::table('rego_subsections')->where('sectionid',$section->sectionid)->count();
                if($hassubsections)
                {
                  $subsections = DB::table('rego_subsections')->select('sectionid','subsectioncode','subsectionname','subsectiondescr')->where('sectionid',$section->sectionid)->get();
                }
                else
                {
                  switch(config('database.default'))
                  {
                    case('pgsql'):
                      $rawquery = 'NULL::INT as sectionid,NULL::INT as subsectioncode,NULL::TEXT as subsectionname,NULL::TEXT as subsectiondescr';
                      break;
                    case('mysql'):
                      $rawquery = 'NULL as sectionid,NULL as subsectioncode,NULL as subsectionname,NULL as subsectiondescr';
                      break;
                  }
                  $subsections = DB::table('rego_subsections')->selectRaw($rawquery)->take(1)->get();
                }
              @endphp
              @foreach ($subsections as $subsection)
                @if (!is_null($subsection->subsectionname))
                  <div class="form-row">
                    <h3 class="offset-md-3 col-md-9">{{ $subsection->subsectionname }}</h3>
                    @if (!is_null($subsection->subsectiondescr))
                      <div class="offset-md-3 col-md-9">
                        <p>{!! $subsection->subsectiondescr !!}</p>
                      </div>
                    @endif
                  </div>
                @endif
                @php
                  $questions = $hassubsections
                             ? DB::table('rego_questions')
                                 ->select('questionshortname','questiontext','questiondescr','responseformat','html5required')
                                 ->whereRaw('sectionid = ? and subsectioncode = ?',[$section->sectionid, $subsection->subsectioncode])
                                 ->orderBy('questionord','asc')
                                 ->get()
                             : DB::table('rego_questions')
                                 ->select('questionshortname','questiontext','questiondescr','responseformat','html5required')
                                 ->where('sectionid',$section->sectionid)
                                 ->orderBy('questionord','asc')
                                 ->get();
                @endphp
                @foreach ($questions as $question)
                  @php
                    $question->questiontext = $question->questiontext . ($question->html5required ? '' : '<br><small class="text-muted">Optional</small>');
                    $responseformat = explode(':',$question->responseformat);
/*
  $responseformat[0]
  A string indicating the broad type of input control used.
  Valid values:
    text
    textarea
    radio
    checkbox
    subquestion-radio
    text-var
    text-var-custom
    files
*/
                    switch($responseformat[0])
                    {
                      case('text'):
                      case('textarea'):
                        $hasfieldset = False;
                        break;
                      case('radio'):
                      case('checkbox'):
                      case('subquestion-radio'):
                      case('text-var'):
                      case('text-var-custom'):
                      case('files'):
                      default:
                        $hasfieldset = True;
                        break;
                    }
                  @endphp
                  @if($hasfieldset)
                    <fieldset class="form-group" aria-describedby="{{ $question->questionshortname }}:questiondescr">
                      <legend class="sr-only">{!! $question->questiontext !!}</legend>
                      <div class="form-row">
                  @else
                    <div class="form-group form-row">
                  @endif
                    @switch($responseformat[0])
                      @case('textarea')
                        @include('components.bootstrap4form.textarea',[
                          'question' => $question,
                          'errors' => $errors,
                          'foritem' => $foritem
                        ])
                        @break
                      @case('text')
                        @component('components.bootstrap4form.input-text',[
                          'question' => $question,
                          'errors' => $errors,
                          'foritem' => $foritem,
                          'inputtype' => $responseformat[1]
                        ])
                        @endcomponent
                        @break
                      @case('files')
                        @include('components.bootstrap4form.input-file-multi')
                        @break
                      @case('text-var-custom')
                        @include('components.bootstrap4form.input-checkbox-multi-custom')
                        @break
                      @case('text-var')
                        @include('components.bootstrap4form.input-number-vari')
                        @break
                      @case('checkbox')
                        @include('components.bootstrap4form.input-checkbox-multi')
                        @break
                      @case('subquestion-radio')
                        @include('components.bootstrap4form.sub-input-radio-multi')
                        @break
                      @case('radio')
                        @include('components.bootstrap4form.input-radio-multi')
                        @break
                      @default
                        <p>Something went wrong here: $answercontrol is <strong>{{ $answercontrol }}</strong>, which is not allowed.</p>
                    @endswitch
                  @if($hasfieldset)
                      </div>
                    </fieldset>
                  @else
                    </div>
                  @endif
                @endforeach
              @endforeach
              <div class="form-group form-row mb-0">
                <div class="offset-md-3 col-md-5">
                  <button type="submit" class="rounded-0 btn btn-primary">Save</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</div>

@endsection

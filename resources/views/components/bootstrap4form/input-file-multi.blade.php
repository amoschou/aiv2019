<label for="{{ $question->questionshortname }}" class="col-md-3 col-form-label text-md-right">{!! $question->questiontext !!}</label>
<div class="col-md-5">
  <div class="form-row">
    <div class="col-md-12">
      <button type="button" class="btn btn-default checkboxadd rounded-0" onclick="addfileinput('{{ $question->questionshortname }}')">Add a file</button>
    </div>
  </div>
  <input type="hidden" value="hiddeninput" name="{{ $question->questionshortname }}[checkbox][0]">
  <input type="hidden" value="hiddeninput" name="{{ $question->questionshortname }}[file][0]">
  <div class="form-row" id="{{ $question->questionshortname }}:extra">
    @php
      $files = DB::table('v_rego_fileuploads')
                 ->select('key','filename')
                 ->where('userid',Auth::id())
                 ->where('foritem','')
                 ->where('questionshortname',$question->questionshortname)
                 ->get();
    @endphp
    @foreach($files as $file)
      @switch(config('database.default'))
        @case('pgsql')
          @php
            $file->filename = $file->filename;
            $file->key = $file->key;
          @endphp
          @break
        @case('mysql')
          @php
            $file->filename = json_decode($file->filename);
            $file->key = json_decode($file->key);
          @endphp
          @break
      @endswitch
      <div class="col-md-12">
        <div class="form-check pl-0" id="">
          <div class="pretty p-icon p-toggle p-plain" id="">
            <input  class="form-check-input"
                     type="checkbox"
                     name="{{ $question->questionshortname }}[checkbox][{{ $file->key }}]"
                       id="{{ $question->questionshortname }}:checkbox:{{ $file->key }}"
                    value="save"
                          checked
            >
              <div class="state p-on">
                <i class="icon material-icons text-primary">check_box</i>
                <label class="form-check-label" for="{{ $question->questionshortname }}:checkbox:{{ $file->key }}">
                  {{ $file->filename }}
                </label>
              </div>
              <div class="state p-off">
                <i class="icon material-icons text-secondary">check_box_outline_blank</i>
                <label class="form-check-label" for="{{ $question->questionshortname }}:checkbox:{{ $file->key }}">
                  {{ $file->filename }}
                </label>
              </div>
          </div>
          <a href="/home/registration/{{$question->questionshortname}}/{{$file->key}}/{{$file->filename}}">Open</a>
        </div>
      </div>
    @endforeach
  </div>
</div>
<span id="{{ $question->questionshortname }}:questiondescr" class="col-md-4 form-control-plaintext">{!! $question->questiondescr !!}</span>

@extends('registration.layouts.app')


<?php
  function accordionshow($accordionshow,$string){
    return $accordionshow === $string ? 'show' : '' ;
  }
?>

@section('content')
<div class="container">
  <div class="row justify-content-center">

    <div class="col-md-3 mb-4">

      <div id="accordion">
        <div class="card border-primary rounded-0">
          <div class="card-header border-primary rounded-0 bg-primary text-white"
                  id="header-registrationdetails"
         data-toggle="collapse"
         data-target="#collapse-registrationdetails"
       aria-expanded="true"
       aria-controls="collapse-registrationdetails"
               style="cursor:pointer">
            Registration details
          </div>
          @php
            $q = "SELECT DISTINCT sectionid,
                         sectionname,
                         sectionord
                    FROM rego_responses
                         NATURAL JOIN
                         rego_requirements
                         JOIN rego_sections
                         ON (doasksection = sectionshortname)
                   WHERE userid = ?
                         AND ";
                         switch(config('database.default'))
                         {
                           case('pgsql'):
                             $q .= "CASE
                                    WHEN comparisonoperator = 'LIKE'
                                    THEN responsejson::TEXT LIKE responsepattern
                                    WHEN comparisonoperator = '@>'
                                    THEN responsejson::JSONB @> ('\"'||responsepattern||'\"')::JSONB
                                    END ";
                             break;
                           case('mysql'):
                             // Wow, MySQL, just wow.
                             $suba = "(comparisonoperator = 'LIKE')";
                             $subb = "(CAST(responsejson AS CHAR) LIKE responsepattern)";
                             $subc = "(comparisonoperator = '@>')";
                             $subd = "(JSON_SEARCH(responsejson,'one',responsepattern) IS NOT NULL)";
                             $subp = "((NOT $suba) OR $subb)";
                             $subq = "($suba OR (NOT $subc) OR $subd)";
                             $subr = "($suba OR $subc)";
                             $subxnorpqr = "(($subp AND $subq AND $subr) OR ((NOT $subp) AND (NOT $subq) AND (NOT $subr)))";
                             $q .= $subxnorpqr;
                             break;
                         }
                  $q .= " ORDER BY sectionord";
            $sections = DB::select($q,[Auth::id()]);
          @endphp
          <div id="collapse-registrationdetails"
            class="collapse {{ accordionshow($accordionshow ?? NULL,'responses') }}"
  aria-labelledby="header-registrationdetails"
      data-parent="#accordion">
            <div class="list-group list-group-flush">
            @foreach($sections as $section)
              <a class="list-group-item list-group-item-action {{ $section->sectionid === (int) $sectionid ? 'text-primary' : 'text-muted' }}" href="/home/registration/{{ $section->sectionid }}">{{ $section->sectionname }}</a>
            @endforeach
            </div>
          </div>
          <div class="card-header border-primary rounded-0 bg-primary text-white"
                  id="header-personalinformation"
         data-toggle="collapse"
         data-target="#collapse-personalinformation"
       aria-expanded="true"
       aria-controls="collapse-personalinformation"
               style="cursor:pointer">
            Personal information
          </div>
          <div id="collapse-personalinformation"
            class="collapse"
  aria-labelledby="header-registrationdetails"
      data-parent="#accordion">
            <div class="list-group list-group-flush">
              <a class="list-group-item list-group-item-action text-muted" href="/home/personalinformation/miscellaneous">Miscellaneous personal information</a>
            </div>
          </div>


          @if($iscommittee)
            <div class="card-header border-warning rounded-0 bg-warning"
                    id="header-bulkdata"
           data-toggle="collapse"
           data-target="#collapse-bulkdata"
         aria-expanded="true"
         aria-controls="collapse-bulkdata"
                 style="cursor:pointer">
              Bulk data
            </div>
            @php
              $sections = DB::table('rego_sections')->select('sectionid','sectionname','sectionshortname')->get();
            @endphp
            <div id="collapse-bulkdata"
              class="collapse"
    aria-labelledby="header-bulkdata"
        data-parent="#accordion">
              <div class="list-group list-group-flush">
                @foreach($sections as $section)
                  <a class="list-group-item list-group-item-action" href="/home/bulkdata/{{ $section->sectionid }}">{{ $section->sectionshortname }}</a>
                @endforeach
              </div>
            </div>
          @endif

        </div>
      </div>

    </div>
    
    <div class="col-md-9">
    
    @section('innercontent')
      <h1>
        Welcome, {{ $firstname }}
        @if($iscommittee)
          <br><small class="text-muted">Committee member</small>
        @endif
      </h1>
      <p>This is where you can register for the festival and manage your personal information.</p>
      <p>Use the navigation on the left (or above on small screens) to find your way around here.</p>
    @endsection

    @yield('innercontent')
    
    </div>
  </div>
</div>
@endsection

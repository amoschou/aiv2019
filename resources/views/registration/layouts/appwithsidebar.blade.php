@extends('registration.layouts.app')


<?php
  function accordionshow($accordionshow,$string){
    return $accordionshow === $string ? 'show' : '' ;
  }
?>


@section('content')
@php $registrationiscomplete = True; @endphp
<div class="container">
  <div class="row justify-content-center">

    <div class="col-md-3 mb-4">

      <div id="accordion">
        <div class="card border-primary rounded-0">
        
          @php
            $expansion = 'registrationdetails';
            $expansion = Request::is('home') ? 'accountinfo' : $expansion;
            $expansion = Request::is('home/invoice') ? 'accountinfo' : $expansion;
          @endphp
        
          {{-- ACCOUNT INFORMATION --}}
          <div class="card-header border-white rounded-0 bg-primary text-white"
                  id="header-accountinfo"
         data-toggle="collapse"
         data-target="#collapse-accountinfo"
       aria-expanded="true"
       aria-controls="collapse-accountinfo"
               style="cursor:pointer">
            Account information
          </div>
          <div id="collapse-accountinfo"
            class="collapse {{ $expansion === 'accountinfo' ? 'show' : '' }}"
  aria-labelledby="header-accountinfo"
      data-parent="#accordion">
            <div class="list-group list-group-flush">
              <a class="list-group-item list-group-item-action {{ Request::is('home') ? 'text-primary' : 'text-muted' }}" href="/home">Home</a>
            </div>
            <div class="list-group list-group-flush">
              <a class="list-group-item list-group-item-action {{ Request::is('home/invoice') ? 'text-primary' : 'text-muted' }}" href="/home/invoice">Invoice</a>
            </div>
          </div>


          {{-- REGISTRATION DETAILS --}}
          <div class="card-header border-white border-0 rounded-0 bg-primary text-white"
                  id="header-registrationdetails"
         data-toggle="collapse"
         data-target="#collapse-registrationdetails"
       aria-expanded="true"
       aria-controls="collapse-registrationdetails"
               style="cursor:pointer">
            Registration details
          </div>
          @php
            $q = "select sectionid from rego_responses natural join rego_questions where userid = ? group by sectionid";
            $tmp = DB::select($q,[Auth::id()]);
            $submittedsections = [];
            foreach($tmp as $a)
            {
              $submittedsections[] = $a->sectionid;
            }
            $q = "SELECT
                    sectionid,
                    sectionname,
                    sectionord
                  from
                    v_rego_required_sections
                    natural join
                    rego_sections
                  where
                    userid = ?
                    and
                    required = 'true'
                  order by
                    sectionord";
            $sections = DB::select($q,[Auth::id()]);
          @endphp
          <div id="collapse-registrationdetails"
            class="collapse {{ accordionshow($accordionshow ?? NULL,'responses') }}"
  aria-labelledby="header-registrationdetails"
      data-parent="#accordion">
            <div class="list-group list-group-flush">
            @foreach($sections as $section)
              @php
                $tick = in_array($section->sectionid,$submittedsections);
                $registrationiscomplete = !$tick ? False : $registrationiscomplete;
              @endphp
              <a class="list-group-item list-group-item-action {{ $section->sectionid === (int) $sectionid ? 'text-primary' : 'text-muted' }} {{ $tick ? '' : 'bg-warning' }}" href="/home/registration/{{ $section->sectionid }}">{{ $section->sectionname }}</a>
            @endforeach
            </div>
          </div>
{{--
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
--}}

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
    
    @if($registrationiscomplete)
      <div class="alert alert-success rounded-0" role="alert">
        <p class="h4">Registration is complete</p>
        <p>Your included activities and events are:</p>
        @php
          switch(config('database.default'))
          {
            case('pgsql'):
              $caststring = '::TEXT';
              break;
            case('mysql'):
              $caststring = '';
              break;
          }
          $q = "with a as (select userid,checklistdescr,'Yes' as tickbox from rego_checklist natural join v_user_rego_items order by userid,checklistord), b as (select distinct checklistdescr,checklistord from rego_checklist), c as (select id as userid from iv_users) select userid,checklistdescr,coalesce(tickbox{$caststring},'No') as tickbox from (b cross join c) left join a using (userid,checklistdescr) where userid = ? order by userid,checklistord";
          $checklist = DB::select($q,[Auth::id()]);
        @endphp
        <table class="table table-sm">
          @foreach($checklist as $checklistitem)
            <tr><td class="pl-0">{{ $checklistitem->checklistdescr }}</td><td class="pr-0">{{ $checklistitem->tickbox }}</td></tr>
          @endforeach
        </table>
        <p>Please make sure that your respones are all correct and complete your payment by the published timeline (on page 2 of <a href="/documents/newsbulletins/adelaideiv2019news4.pdf">News bulletin 4</a>).</p>
        <p class="mb-0">You have agreed to follow the <a href="{{ route('conduct') }}">code of conduct</a>.</p>
      </div>
    @else
      <div class="alert alert-danger rounded-0" role="alert">
        <p class="h4">Registration is not yet finished</p>
        <hr>
        <p>Please save your responses to each section under <em>Registration details</em>.</p>
        <p class="mb-0">By registering, you agree to follow the <a href="{{ route('conduct') }}">code of conduct</a>.</p>
      </div>
    @endif

    @yield('innercontent')
    
    </div>
  </div>
</div>
@endsection

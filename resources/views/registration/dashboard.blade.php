@extends('registration.layouts.app')


<?php
  function accordionshow($accordionshow,$string){
    return $accordionshow === $string ? 'show' : '' ;
  }
?>

@section('innercontent')
  <h1>
    Welcome, {{ $firstname }}
    @if($iscommittee)
      <br><small class="text-muted">Committee member</small>
    @endif
  </h1>
  {{--
  <div class="row">
    <div class="col">
      <div class="alert alert-success" role="alert">
        <h4 class="alert-heading">Registration status</h4>
        <p class="mb-0">Complete</p>
      </div>
    </div>
    <div class="col">
      <div class="alert alert-danger" role="alert">
        <h4 class="alert-heading">Financial status</h4>
        <p class="mb-0">Not paid</p>
      </div>
    </div>
  </div>
  --}}
  <p>This is where you can register for the festival and manage your personal information.</p>
  <p>Use the navigation on the left (or above on small screens) to find your way around here.</p>
  
  {{--
  @php
    $regoitems = DB::table('v_user_rego_items')
      ->select('itemname','price')
      ->where('userid',Auth::id())
      ->get();
    $regoitemtotal = 0;
  @endphp
  <table class="table">
    <thead>
      <tr>
        <th>Item</th>
        <th>$</th>
      </tr>
    </thead>
    <tbody>
      @foreach($regoitems as $regoitem)
        @php $regoitemtotal += $regoitem->price; @endphp
        <tr>
          <td>{{ $regoitem->itemname }}</td>
          <td>{{ $regoitem->price }}</td>
        </tr>
      @endforeach
    </tbody>
    <tfoot>
      <tr>
        <td>Total</td>
        <td>{{ $regoitemtotal }}</td>
      </tr>
    </tfoot>
  </table>
  --}}
  
  <h2>Payments</h2>
  
  @php
    $accountref = DB::table('iv_users')->select('accountref')->where('id',Auth::id())->first()->accountref;
  @endphp
  <div class="alert alert-success rounded-0" role="alert">
    <p>Your account reference number is:</p>
    <p class="h4">{{ $accountref }}</p>
    <hr>
    <p class="mb-0">Remember to include your account reference number whenever you make a payment.</p>
  </div>

  <p>Payments can be made by debit/credit card (Including iternational cards) at <a href="/payments/checkout?ref={{ $accountref }}">https://www.aiv.org.au/payments/checkout?ref={{ $accountref }}</a></p>
  <p>Or payments can be made by bank transfer to the account BSB&nbsp;105-120, Number&nbsp;027885840.</p>
  
  <p>Fees are available from <a href="/participate/choir">https://www.aiv.org.au/participate/choir</a> and the cost of any merchandise sales or music sales are additional.</p>
  
@endsection


@section('content')
<div class="container">
  <div class="row justify-content-center">

    <div class="col-md-3 mb-4">

      <div id="accordion">
        <div class="card border-primary rounded-0">
        
          @php
            $expansion = NULL;
            $expansion = Request::is('home') ? 'accountinfo' : 'registrationdetails';
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
              <a class="list-group-item list-group-item-action {{ $section->sectionid === (int) $sectionid ? 'text-primary' : 'text-muted' }}" href="/home/registration/{{ $section->sectionid }}">{{ $section->sectionname }}</a>
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
    
    @yield('innercontent')
    
    </div>
  </div>
</div>
@endsection

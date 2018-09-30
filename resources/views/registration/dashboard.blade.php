@extends('registration.layouts.appwithsidebar')

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
        <div class="alert alert-success rounded-0" role="alert">
          <h4 class="alert-heading">Registration status</h4>
          <p class="mb-0">Complete</p>
        </div>
      </div>
      <div class="col">
        <div class="alert alert-danger rounded-0" role="alert">
          <h4 class="alert-heading">Financial status</h4>
          <p class="mb-0">Not paid</p>
        </div>
      </div>
    </div>
  --}}
  <p>This is where you can register for the festival and manage your personal information.</p>
  <p>Use the navigation on the left (or above on small screens) to find your way around here.</p>
  <p>Registration sections that you need to respond to will remain highlighted until they are submitted.</p>
  
  @if(env('APP_ENV') !== 'local' || True)
    @php
      $regoitems = DB::table('v_user_rego_items')
        ->select('itemname','price')
        ->where('userid',Auth::id())
        ->get();
      $regoitemtotal = 0;
    @endphp
    {{--
    <table class="table table-sm">
      <thead>
        <tr>
          <th>Item</th>
          <th class="text-right">$</th>
        </tr>
      </thead>
      <tbody>
        @foreach($regoitems as $regoitem)
          @php $regoitemtotal += $regoitem->price; @endphp
          <tr>
            <td>{{ $regoitem->itemname }}</td>
            <td class="text-right">{{ $regoitem->price }}</td>
          </tr>
        @endforeach
      </tbody>
      <tfoot class="bg-info font-weight-bold">
        <tr>
          <td>Total</td>
          <td class="text-right">{{ number_format($regoitemtotal,2,'.','') }}</td>
        </tr>
      </tfoot>
    </table>
    --}}
  @endif
  
  <h2>Payments</h2>
  
  @php
    $accountref = DB::table('iv_users')->select('accountref')->where('id',Auth::id())->first()->accountref;
  @endphp
  <div class="alert alert-info rounded-0" role="alert">
    <p class="">Total amount payable:</p>
    <p class="lead">${{ DB::table('v_user_rego_items')->where('userid',Auth::id())->sum('price') }}</p>
    <hr>
    <p class="">Your account reference number is:</p>
    <p class="lead">{{ $accountref }}</p>
    <p class="mb-0">Remember to include your account reference number whenever you make a payment.</p>
  </div>

  <h3>How to pay</h3>
  <h4>Preferred payment option</h4>
  <p>Payments can be made by debit/credit card (Including international cards) at <a href="/payments/checkout?ref={{ $accountref }}">https://www.aiv.org.au/payments/checkout?ref={{ $accountref }}</a>.</p>
  <p>When you pay with card and include your account reference number, your payment will automatically and immediately be reflected on your invoice.</p>
  <h4>Other payment option</h4>
  <p>Or payments can be made by bank transfer to the account BSB&nbsp;105-120, Account number&nbsp;027885840, Account name&nbsp;<em>AIVCF Adelaide</em>.</p>
  <p>When you pay by bank transfer, there will be a manual processing delay and your invoice won’t be reflected immediately.</p>
  <h4>Fees and due dates</h4>
  <p>Fees are available from <a href="/participate/choir">https://www.aiv.org.au/participate/choir</a> and the cost of any merchandise sales or music sales are additional.</p>
  <p>Complete payment by the published timeline (on page 2 of <a href="/documents/newsbulletins/adelaideiv2019news4.pdf">News bulletin 4</a>)</p>
  
@endsection


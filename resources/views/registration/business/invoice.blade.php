@extends('registration.layouts.appwithsidebar')

@section('innercontent')
  <h1>AIVCF Adelaide<br><small><span class="font-weight-bold">ABN</span> 41 628 114 920</small></h1>
  <p class="text-right lead">Date: {{ date('l, j F Y') }}</p>
  <div class="row">
    <div class="col-2 text-right">To:</div>
    <div class="col-10">
      {{ $name }}<br>{{ $address }}<br>{{ $email }}
    </div>
  </div>
  <p class="text-right lead"><span class="font-weight-bold">INVOICE</span> No. {{ $accountref }}</p>
  @php
    $regoitems = DB::table('v_user_rego_items')
      ->select('itemname','unitprice','qty','price')
      ->where('userid',Auth::id())
      ->get();
    $regoitemtotal = 0;
  @endphp
  <table class="table table-sm">
    <thead>
      <tr>
        <th class="pl-0">Description</th>
        <th>Qty</th>
        <th class="text-right">Unit price</th>
        <th class="text-right pr-0">Amount payable</th>
      </tr>
    </thead>
    <tbody>
      @foreach($regoitems as $regoitem)
        @php $regoitemtotal += $regoitem->price; @endphp
        <tr>
          <td class="pl-0">{{ $regoitem->itemname }}</td>
          <td>{{ $regoitem->qty }}</td>
          <td class="text-right">{{ $regoitem->unitprice }}</td>
          <td class="text-right pr-0">{{ $regoitem->price }}</td>
        </tr>
      @endforeach
    </tbody>
    <tfoot class="font-weight-bold">
      <tr>
        <td colspan="3" class="pl-0">TOTAL AMOUNT PAYABLE</td>
        <td class="text-right pr-0">${{ number_format($regoitemtotal,2,'.','') }}</td>
      </tr>
    </tfoot>
  </table>
  <p class="font-weight-bold">No GST has been charged.</p>
  <h2>Receipts</h2>
  <h3>Card payments</h3>
  @php
    \Stripe\Stripe::setApiKey(config('services.stripe.secret'));
    $charges = DB::table('rego_stripe_charges')->select('chargeid')->where('accountref',$accountref)->get();
    function centstodollarsandcents($a) {
      $hundredths = $a % 10;
      $a = (int) ($a - $hundredths)/10;
      $tenths = $a % 10;
      $a = (int) ($a - $tenths)/10;
      return '$' . $a . '.' . $tenths . $hundredths ;
    }
  @endphp
  <table class="table table-sm">
    <thead>
      <tr>
        <th class="pl-0">Charge ID</th>
        <th>Paid</th>
        <th class="text-right">Transaction amount</th>
        <th class="text-right pr-0">Transaction net</th>
      </tr>
    </thead>
    <tbody>
      @foreach($charges as $charge)
        @php
          $chargeobject = \Stripe\Charge::retrieve($charge->chargeid);
          $balancetransactionobject = \Stripe\BalanceTransaction::retrieve($chargeobject->balance_transaction);
        @endphp
        <tr>
          <td class="pl-0">{{ $chargeobject->id }}</td>
          <td>{{ $chargeobject->paid ? 'Paid' : 'Not paid' }}</td>
          <td class="text-right">{{ centstodollarsandcents($balancetransactionobject->amount) }}</td>
          <td class="text-right class="pr-0">{{ centstodollarsandcents($balancetransactionobject->net) }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
  <p>Receipts for payments received will soon be updated and displayed here. Please check back soon.</p>
@endsection

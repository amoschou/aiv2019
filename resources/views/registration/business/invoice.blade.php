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
    $stripetotal = 0;
  @endphp
  <table class="table table-sm">
    <thead>
      <tr>
        <th class="pl-0">Charge ID</th>
        <th>Date</th>
        <th>Status</th>
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
          <td>{{ date('j/m/y',$chargeobject->created) }}</td>
          <td>
            {{ $chargeobject->status }}
            @if( $chargeobject->status === 'failed' )
              ({{ $chargeobject->failure_message }})
            @endif
          </td>
          @if( $chargeobject->captured )
            <td class="text-right">${{ number_format($balancetransactionobject->amount/100,2,'.','') }}</td>
            <td class="text-right pr-0">${{ number_format($balancetransactionobject->net/100,2,'.','') }}</td>
            @php
              $stripetotal += $balancetransactionobject->net/100;
            @endphp
          @else
            <td class="text-right"></td>
            <td class="text-right pr-0"></td>
          @endif
        </tr>
      @endforeach
    </tbody>
  </table>
  <h3>Electronic bank transfer</h3>
  <table class="table table-sm">
    <thead>
      <tr>
        <th class="pl-0">Transaction ID</th>
        <th>Date</th>
        <th>Description</th>
        <th class="text-right pr-0">Credit</th>
      </tr>
    </thead>
    <tbody>
      @php
        $bankq = "SELECT id,date,description,credit FROM bank_transaction_accounts JOIN bank_transactions ON (id = transactionid) WHERE accountref = ?";
        $transactions = DB::SELECT($bankq,[$accountref]);
        $banktotal = 0;
      @endphp
      @foreach($transactions as $transaction)
        <td clas="pl-0">{{ $transaction->id }}</td>
        <td class="">{{ $transaction->date }}</td>
        <td class="">{{ $transaction->description }}</td>
        <td class="text-right pr-0">${{ $transaction->credit }}</td>
        @php
          $banktotal += $transaction->credit;
        @endphp
      @endforeach
    </tbody>
  </table>
  <h3>Other transfer</h3>
  <table class="table table-sm">
    <thead>
      <tr>
        <th class="pl-0">Transaction ID</th>
        <th>Description</th>
        <th class="text-right pr-0">Credit</th>
      </tr>
    </thead>
    <tbody>
      @php
        $otherq = "SELECT othertransactionid,description,value FROM rego_othertransactions WHERE accountref = ?";
        $othertransactions = DB::SELECT($otherq,[$accountref]);
        $othertotal = 0;
      @endphp
      @foreach($othertransactions as $transaction)
        <td clas="pl-0">{{ $transaction->othertransactionid }}</td>
        <td class="">{{ $transaction->description }}</td>
        <td class="text-right pr-0">${{ $transaction->value }}</td>
        @php
          $othertotal += $transaction->value;
        @endphp
      @endforeach
    </tbody>
  </table>
  <h3>Balance due</h3>
  <table class="table table-sm">
    <tfoot class="font-weight-bold">
      <tr>
        <td colspan="3" class="pl-0">BALANCE DUE</td>
        <td class="text-right pr-0">${{ number_format($regoitemtotal - $stripetotal - $banktotal - $othertotal,2,'.','') }}</td>
      </tr>
    </tfoot>
  </table>
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

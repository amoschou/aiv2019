@extends('registration.layouts.appwithsidebar')

@section('innercontent')
  <h1>AIVCF Adelaide<br><small><span class="font-weight-bold">ABN</span> 41 628 114 920</small></h1>
  <p class="text-right lead">Date: {{ date('l, j F Y') }}</p>
  <p class="font-weight-bold">No GST has been charged.</p>
  @php
    \Stripe\Stripe::setApiKey(config('services.stripe.secret'));
      function centstodollarsandcents($a) {
        $hundredths = $a % 10;
        $a = (int) ($a - $hundredths)/10;
        $tenths = $a % 10;
        $a = (int) ($a - $tenths)/10;
        return '$' . $a . '.' . $tenths . $hundredths ;
      }
  @endphp
  @foreach($people as $person)
    <hr>
    @php
      $accountref = DB::table('iv_users')->select('accountref')->where('id',$person->id)->first()->accountref;
    @endphp
    <h2>{{ $person->id }}: {{ $person->firstname }} {{ $person->lastname }} <small>({{ $accountref }})</small></h2>
    <div class="row">
      <div class="col-2 text-right">To:</div>
      <div class="col-10">
        {{ $person->firstname }} {{ $person->lastname }}
      </div>
    </div>
    <p class="text-right lead"><span class="font-weight-bold">INVOICE</span> No. {{ $accountref }}</p>
    @php
      $regoitems = DB::table('v_user_rego_items')
        ->select('itemname','unitprice','qty','price')
        ->where('userid',$person->id)
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
    <h2>Receipts</h2>
    <h3>Card payments</h3>
    @php
      $charges = DB::table('rego_stripe_charges')->select('chargeid')->where('accountref',$accountref)->get();
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
            if(!is_null($chargeobject->balance_transaction))
            {
              $balancetransactionobject = \Stripe\BalanceTransaction::retrieve($chargeobject->balance_transaction);
            }
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
              <td class="text-right">{{ centstodollarsandcents($balancetransactionobject->amount) }}</td>
              <td class="text-right pr-0">{{ centstodollarsandcents($balancetransactionobject->net) }}</td>
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
        @endphp
        @foreach($transactions as $transaction)
          <td clas="pl-0">{{ $transaction->id }}</td>
          <td class="">{{ $transaction->date }}</td>
          <td class="">{{ $transaction->description }}</td>
          <td class="text-right pr-0">${{ $transaction->credit }}</td>
        @endforeach
      </tbody>
    </table>
  @endforeach
@endsection

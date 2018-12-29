@extends('registration.layouts.app')

@section('content')
<div class="container">

  <p>Meet and greet</p>
  
  
  
  @php
    \Stripe\Stripe::setApiKey(config('services.stripe.secret'));
      function centstodollarsandcents($a) {
        $hundredths = $a % 10;
        $a = (int) ($a - $hundredths)/10;
        $tenths = $a % 10;
        $a = (int) ($a - $tenths)/10;
        return '$' . $a . '.' . $tenths . $hundredths ;
      }
    $authenticatedusersemail = DB::table('iv_users')->select('email')->where('id',Auth::id())->first()->email;
  @endphp
  @php
    $numpages = $getnumpages;
    $newpeople = [];
    foreach($people as $person)
    {
      if($person->id % $numpages === (int) $getpeoplelist)
      {
        $newpeople[] = $person;
      }
    }
    if($newpeople !== [])
    {
      $people = $newpeople;
    }
  @endphp
  @foreach($people as $person)
    <hr>
    @php
      $accountref = DB::table('iv_users')->select('accountref')->where('id',$person->id)->first()->accountref;
      $personemail = DB::table('iv_users')->select('email')->where('id',$person->id)->first()->email;
    @endphp
    <h1>{{ $person->id }}: {{ $person->firstname }} {{ $person->lastname }} <small>({{ $accountref }})</small></h1>




    <div class="card border-primary mb-3"><h3 class="card-header text-white bg-primary">Pre registration checks</h3>
      @php
        $ConcessionList = DB::table('rego_responses')->select('responsejson')->where('userid',$person->id)->where('questionshortname','concession')->first();
        $Fresher = DB::table('rego_responses')->select('responsejson')->where('userid',$person->id)->where('questionshortname','fresher')->first();
        $IVHistory = DB::table('rego_responses')->select('responsejson')->where('userid',$person->id)->where('questionshortname','ivhistory')->first();
        
        if(!is_null($ConcessionList))
        {
          $ConcessionList = json_decode($ConcessionList->responsejson);
        }
        if(!is_null($Fresher))
        {
          $Fresher = json_decode($Fresher->responsejson);
        }
        if(!is_null($IVHistory))
        {
          $IVHistory = json_decode($IVHistory->responsejson);
        }
        
      @endphp
      <table class="table border-primary">
        @php $hasrows = false; @endphp
        <tbody class="border-primary">
          @if(!is_null($ConcessionList))
            @foreach($ConcessionList as $Concession)
              @if($Concession === 'student')
                <tr class="border-primary">@php $hasrows = true; @endphp
                  <th class="border-primary px-5"></th>
                  <td class="border-primary"><Strong>Full time student</strong><br>Enrolled full time at an Australian university during Semester Two 2018 or Semester One 2019 or equivalent</td>
                </tr>
              @endif
              @if($Concession === 'youth')
                <tr class="border-primary">@php $hasrows = true; @endphp
                  <th class="border-primary px-5"></th>
                  <td class="border-primary"><strong>Youth</strong><br>Born on or after 10 January 1989</td>
                </tr>
              @endif
            @endforeach
          @endif
          @if($Fresher === 'yes')
            <tr class="border-primary">@php $hasrows = true; @endphp
              <th class="border-primary px-5"></th>
              <td class="border-primary"><strong>Fresher</strong> (First time singing at an IV)<br>IV history: {{ $IVHistory }}</td>
            </tr>
          @endif
          @if(!$hasrows)
            <tr><td>No checks necessary.</td></tr>
          @endif
        </tbody>
      </table>
    </div>



    <div class="row">


    {{-- Invoice --}}
    <div class="col-6">
    <div class="card border-primary mb-3"><h3 class="card-header text-white bg-primary">Invoice</h3><div class="card-body">
      <h2>AIVCF Adelaide<br><small><span class="font-weight-bold">ABN</span> 41 628 114 920</small></h2>
      <p class="text-right lead">Date: {{ date('l, j F Y') }}</p>
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
      <p class="font-weight-bold">No GST has been charged.</p>
    </div></div>
    </div>
    {{-- End invoice --}}
    
    
    
    
    {{-- Receipts --}}
    <div class="col-6">
    <div class="card border-primary mb-3"><h3 class="card-header text-white bg-primary">Receipts</h3><div class="card-body">
      <h4>Card payments</h4>
      @php
        $charges = DB::table('rego_stripe_charges')->select('chargeid')->where('accountref',$accountref)->get();
        $stripetotal = 0;
      @endphp
      <table class="table table-sm">
        <thead>
          <tr class="border-bottom-0 mb-0 pb-0"><th class="pl-0 border-bottom-0 mb-0 pb-0" colspan="4">Charge ID</th></tr>
          <tr class="border-top-0 mt-0 pt-0">
            <th class="pl-0 border-top-0 mt-0 pt-0">Date</th>
            <th class="border-top-0 mt-0 pt-0">Status</th>
            <th class="text-right border-top-0 mt-0 pt-0">Transaction amount</th>
            <th class="text-right border-top-0 pr-0 mt-0 pt-0">Transaction net</th>
          </tr>
        </thead>
        <tbody>
          @foreach($charges as $charge)
            @php
              $chargeobject = \Stripe\Charge::retrieve($charge->chargeid);
              if($chargeobject->captured)
              {
                $balancetransactionobject = \Stripe\BalanceTransaction::retrieve($chargeobject->balance_transaction);
              }
            @endphp
            <tr class="border-bottom-0 mb-0 pb-0"><td class="pl-0 border-bottom-0 mb-0 pb-0" colspan="4">{{ $chargeobject->id }}</td></tr>
            <tr class="border-top-0 mt-0 pt-0">
              <td class="pl-0 border-top-0 mt-0 pt-0">{{ date('j/m/y',$chargeobject->created) }}</td>
              <td class="border-top-0 mt-0 pt-0">
                {{ $chargeobject->status }}
                @if( $chargeobject->status === 'failed' )
                  ({{ $chargeobject->failure_message }})
                @endif
              </td>
              @if( $chargeobject->captured )
                <td class="text-right border-top-0 mt-0 pt-0">${{ number_format($balancetransactionobject->amount/100,2,'.','') }}</td>
                <td class="text-right border-top-0 pr-0 mt-0 pt-0">${{ number_format($balancetransactionobject->net/100,2,'.','') }}</td>
                @php
                  $stripetotal += $balancetransactionobject->net/100;
                @endphp
              @else
                <td class="text-right border-top-0 mt-0 pt-0"></td>
                <td class="text-right border-top-0 pr-0 mt-0 pt-0"></td>
              @endif
            </tr>
          @endforeach
        </tbody>
      </table>
      <h4>Electronic bank transfer</h4>
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
            <tr>
              <td clas="pl-0">{{ $transaction->id }}</td>
              <td class="">{{ $transaction->date }}</td>
              <td class="">{{ $transaction->description }}</td>
              <td class="text-right pr-0">${{ $transaction->credit }}</td>
              @php
                $banktotal += $transaction->credit;
              @endphp
            </tr>
          @endforeach
        </tbody>
      </table>
      <h4>Other transfer</h4>
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
    </div></div>
    </div>
    {{-- End receipts --}}

    </div>  {{-- Invoice/receipts row --}}

    <div class="card border-primary mb-3">
      <h3 class="card-header text-white bg-primary">Balance due</h3>
      <div class="card-body">
        <p class="lead">${{ number_format($regoitemtotal - $stripetotal - $banktotal - $othertotal,2,'.','') }}</p>
      </div>
    </div>
    
    

    
    @php
      $q = "select sectionid from rego_responses natural join rego_questions where userid = ? group by sectionid";
      $tmp = DB::select($q,[$person->id]);
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
      $sections = DB::select($q,[$person->id]);
      $registrationiscomplete = True;
      $omittedsections = [];
    @endphp
    @foreach($sections as $section)
      @php
        $tick = in_array($section->sectionid,$submittedsections);
        if(!$tick)
        {
          $registrationiscomplete = False;
          $omittedsections[] = $section->sectionid;
        }
      @endphp
    @endforeach
    <div class="alert alert-{{ $registrationiscomplete ? 'success' : 'danger' }} rounded-0" role="alert">
      <p class="h4">Registration is {{ $registrationiscomplete ? 'complete' : 'not yet finished' }}</p>
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
        $checklist = DB::select($q,[$person->id]);
        $numberofactivities = 0;
        $includedevents = [];
        $excludedevents = [];

        $essentialrecord = DB::table('v_cols_essential')->select('id','doing_singing','doing_social','adelaide')->where('id',$person->id)->first();
        $personalrecord = DB::table('v_cols_personal')->select('id','student','youth')->where('id',$person->id)->first();
        
        
        $ischoral = $essentialrecord->doing_singing ? true : false;
        $issocial = $essentialrecord->doing_social ? true : false;
        $isadelaide = $essentialrecord->adelaide ? true : false;

        $isstudent = $personalrecord->student ?? NULL;
        $isyouth = $personalrecord->youth ?? NULL;

        $sleepingatcampq = "select userid as id,case when json_search(responsejson,'one','no') is not null then false else true end as sleepingatcamp from rego_responses where questionshortname = 'sleepingatcamp' and userid = ?";
        $billetingrequestq = "select userid as id, case when responsejson <> '[\"hiddeninput\"]' then true else false end as billetingrequest from rego_responses where questionshortname = 'billetingrequest' and userid = ?";
        $accommodationq = "select userid as id,case when json_unquote(responsejson) is not null then true else false end as accommodation from rego_responses where questionshortname = 'accommodation' and userid = ?";
        

        $sleepingatcampselect = DB::select($sleepingatcampq,[$person->id]); // [0]->sleepingatcamp ? true : false;
        $billetingrequestselect = DB::select($billetingrequestq,[$person->id]); // [0]->billetingrequest ? true : false;
        $accommodationselect = DB::select($accommodationq,[$person->id]); // [0]->accommodation ? true : false;

        $sleepingatcamp = NULL;
        $billetingrequest = NULL;
        $accommodation = NULL;
        foreach($sleepingatcampselect as $a)
        {
          $sleepingatcamp = $a->sleepingatcamp ? true : false;
        }
        foreach($billetingrequestselect as $a)
        {
          $billetingrequest = $a->billetingrequest ? true : false;
        }
        foreach($accommodationselect as $a)
        {
          $accommodation = $a->accommodation ? true : false;
        }

        $antisocialchorister = $ischoral && !$issocial ? true : false;
        $foreignernotsleepingatcamp = !$isadelaide && !$sleepingatcamp ? true : false;
        $homelessforeignstudent = $isstudent && !$isadelaide && !$billetingrequest;
        $homelessforeignnonstudents = !$isstudent && !$isadelaide && !$accommodation;
        
        $unusualcombination = $antisocialchorister || $foreignernotsleepingatcamp || $homelessforeignstudent || $homelessforeignnonstudents;
        
      @endphp
      <table class="table table-sm">
        @foreach($checklist as $checklistitem)
          <tr>
            <td class="pl-0">{{ $checklistitem->checklistdescr }}</td>
            <td class="pr-0">{{ $checklistitem->tickbox }}</td>
            @php
              if($checklistitem->tickbox == 'Yes')
              {
                $numberofactivities++;
                $includedevents[] = $checklistitem->checklistdescr;
              }
              else
              {
                $excludedevents[] = $checklistitem->checklistdescr;
              }
            @endphp
          </tr>
        @endforeach
      </table>
      @if(!$registrationiscomplete)
        @php
          $omittedsectionsobj = DB::table('rego_sections')->whereIn('sectionid',$omittedsections)->get();
        @endphp
        <p>Omitted sections:</p>
        <ul>
          @foreach($omittedsectionsobj as $section)
            <li>{{ $section->sectionname }}</li>
          @endforeach
        </ul>
      @else
        @php
          $omittedsectionsobj = [];
        @endphp
      @endif
    </div>
  
  @endforeach
</div>
@endsection


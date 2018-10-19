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
    $authenticatedusersemail = DB::table('iv_users')->select('email')->where('id',Auth::id())->first()->email;
  @endphp
  @php
    if($getpeoplelist == 'short')
    {
      $newpeople = [];
      $newpeople[] = $people[0];
      $newpeople[] = $people[1];
      $newpeople[] = $people[2];
      $people = $newpeople;
    }
  @endphp
  @foreach($people as $person)
    <hr>
    @php
      $accountref = DB::table('iv_users')->select('accountref')->where('id',$person->id)->first()->accountref;
      $personemail = DB::table('iv_users')->select('email')->where('id',$person->id)->first()->email;
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
    {{--
      <h2>Receipts</h2>
      <h3>Card payments</h3>
    --}}
    @php
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
            if($chargeobject->captured)
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
    {{--
      <h3>Electronic bank transfer</h3>
    --}}
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
    <table class="table table-sm">
      <tfoot class="font-weight-bold">
        <tr>
          <td colspan="3" class="pl-0">BALANCE DUE</td>
          <td class="text-right pr-0">${{ number_format($regoitemtotal - $stripetotal - $banktotal,2,'.','') }}</td>
        </tr>
      </tfoot>
    </table>
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
  
    {{-- Email below --}}
  
    @php
      $variables = [
        'firstname' => $person->firstname,
        'lastname' => $person->lastname,
        'registrationcomplete' => $registrationiscomplete,
        'allactivities' => $numberofactivities == 5 ? True : False,
        'includedevents' => $includedevents,
        'excludedevents' => $excludedevents,
        'unusualcombination' => $unusualcombination,
        'omittedsectionsobj' => $omittedsectionsobj,
        'totalamountpayable' => $regoitemtotal,
        'totalpayments' => $stripetotal + $banktotal,
        'antisocialchorister' => $antisocialchorister,
        'foreignernotsleepingatcamp' => $foreignernotsleepingatcamp,
        'homelessforeignstudent' => $homelessforeignstudent,
        'homelessforeignnonstudents' => $homelessforeignnonstudents,
        'isyouth' => $isyouth,
        'isstudent' => $isstudent,
        'isadelaide' => $isadelaide,
        'accountref' => $accountref,
      ];
      $data = (object) $variables;
      $emailcontext = [ 'data' => $data ]
    @endphp
    
    <div class="alert alert-info rounded-0" role="alert">
      <p>If <strong>?email=display</strong>, this email will not be sent.</p>
      <p>If <strong>?email=testsend</strong>, this email will be sent to {{ $authenticatedusersemail }}.</p>
      <p>If <strong>?email=realsend</strong>, this email will be sent to {{ $personemail }}.</p>
      @if($getemail == 'display')
        @include('mail.registration.checkup.index', $emailcontext)
      @elseif($getemail == 'testsend')
        @include('mail.registration.checkup.index', $emailcontext)
        @php
          Mail::to($authenticatedusersemail)
            ->send(new App\Mail\CheckupRegistration($data));
        @endphp
      @elseif($getemail == 'realsend')
        @include('mail.registration.checkup.index', $emailcontext)
        @php
          Mail::to($personemail)
            ->send(new App\Mail\CheckupRegistration($data));
        @endphp
      @endif
    </div>

  @endforeach
@endsection

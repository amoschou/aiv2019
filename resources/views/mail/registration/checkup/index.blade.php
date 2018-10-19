<p>Hi {{ $data->firstname }},</p>
<p>This email contains important information about Adelaide IV. Please read and understand it fully and carefully.</p>
<p>This email has been generated automatically and there is no need to reply. But if you have an important question, please email andrew@aiv.org.au.</p>
<p>Thanks,<br>Andrew Moschou<br>Treasurer, AIVCF Adelaide</p>

<h3>Registration</h3>

@if( $data->registrationcomplete )
  @if( $data->allactivities )
    <p>You have completed the registration process, as can be seen at <a href="https://www.aiv.org.au/home">https://www.aiv.org.au/home</a>.</p>
  @else
    <p>You have completed the registration process, in as much as you have told us, as can be seen at <a href="https://www.aiv.org.au/home">https://www.aiv.org.au/home</a>.</p>
  @endif
@else
  <p>You have not completed the registration process, as can be seen at <a href="https://www.aiv.org.au/home">https://www.aiv.org.au/home</a>.</p>
  <p>You have not yet told us about:</p>
  <ul>
    @foreach( $data->omittedsectionsobj as $section )
      <li>{{ $section->sectionname }}</li>
    @endforeach
  </ul>
  <p>Please do this as soon as possible by visiting <a href="https://www.aiv.org.au/home">https://www.aiv.org.au/home</a> within the next few days. We are in the process of confirming numbers and we need accurate information from you.</p>
@endif

@if( $data->registrationcomplete )
  @if( $data->allactivities )
    <p>You have elected to include all activities and events:</p>
  @else
    <p>You have elected to include the following activities and events:</p>
  @endif
@else
  <p>In as much as you have told us so far, you have elected to include the following activities and events:</p>
@endif
<ul>
  @foreach( $data->includedevents as $event )
    <li>{{ $event }}</li>
  @endforeach
</ul>
<p>And will <strong>not</strong> be participating in the following activities and events:</p>
<ul>
  @foreach( $data->excludedevents as $event )
    <li>{{ $event }}</li>
  @endforeach
</ul>
@if( $data->isstudent )
  @if( !$data->isadelaide )
    <p>Billeting is strictly limited. As you are a student not from Adelaide, please upload a copy of your student ID or enrolment status to <a href="https://www.aiv.org.au/home/registration/2/edit">https://www.aiv.org.au/home/registration/2/edit</a> as soon as possible, if you have not done so already, so that we can verify this before allocating billets, and to maintain your student concession fees.</p>
  @else
    <p>To maintain your student concession fees, please remember to upload your student ID or concession status if you have not done so already at <a href="https://www.aiv.org.au/home/registration/2/edit">https://www.aiv.org.au/home/registration/2/edit</a>, or be prepared to show this to us by the beginning of the festival. Remember that if you are requesting billeting, at the start of the festival is too late, we need to confirm your student status as soon as possible.</p>
  @endif
@else
  @if( $data->isyouth )
    <p>To maintain your youth concession fees, please remember to upload your ID if you have not done so already at <a href="https://www.aiv.org.au/home/registration/2/edit">https://www.aiv.org.au/home/registration/2/edit</a>, or be prepared to show this to us by the beginning of the festival.</p>
  @endif
@endif
@if( $data->unusualcombination )
  <p>However, the combination of events that you have chosen seems to be unusual:</p>
  <ul>
    @if ( $data->antisocialchorister )
      <li>You are part of the choir, but are not coming to social events including the academic dinner, post concert party and farewell barbecue.<br>
      Choristers would normally come to these social events.<br>
      If this isn’t right, please visit <strong>Essential details</strong> at <a href="https://www.aiv.org.au/home/registration/1/edit">https://www.aiv.org.au/home/registration/1/edit</a> and make sure that you select <strong>At social events</strong>.</li>
    @endif
    @if ( $data->foreignernotsleepingatcamp )
      <li>You are not from Adelaide, but you are not sleeping at camp.<br>
      Choristers, especially those not from Adelaide, would normally sleep at camp.<br>
      If this isn’t right, please visit <strong>Accommodation</strong> at <a href="https://www.aiv.org.au/home/registration/6/edit">https://www.aiv.org.au/home/registration/6/edit</a> and make sure that you select the right option.</li>
    @endif
    @if ( $data->homelessforeignstudent )
      <li>You are a student not from Adelaide, but you have not requested billeting.<br>
      We are offering billeting to all students who are not from Adelaide, so that they won’t need to seek their own accommodation. You are, however, welcome to seek your own accommodation if you so choose.<br>
      If this isn’t right, please visit <strong>Billeting accommodation</strong> <a href="https://www.aiv.org.au/home/registration/7/edit">https://www.aiv.org.au/home/registration/7/edit</a> to request billeting.<br>
      </li>
    @endif
    @if ( $data->homelessforeignnonstudents )
      <li>You are not from Adelaide, but you have not told us about your accommodation.<br>
      We are not offering billeting, except to students, and as you are not a student, you will need to arrange your own accommodation. There’s no need to tell us about where you will be staying, but this message is just in case you weren’t aware.</li>
    @endif
  </ul>
@endif
<p>If there is an error with your registration, please change it by visiting <a href="https://www.aiv.org.au/home">https://www.aiv.org.au/home</a> as soon as possible.</p>


<h3>Scores and merchandise</h3>

<p>Scores and merchandise requests must be completed by the end of October. Please make sure that they are correct.</p>

<h4>Scores</h4>

<p>If you are singing in the concert, please use this time to check that your score orders are correct.</p>
<p>If you are buying a score, make sure it is listed in your invoice. Otherwise, that you are borrowing or bringing your own.</p>

<h4>Merchandise</h4>

<p>If you are ordering merchandise, please use this time to check that your orders are correct, especially for the festival water bottles, T shirts, wine glasses and tote bags, because these orders will need to be finalised by the end of October.</p>
<p>In case you missed it the announcement earlier, tote bags are now also for sale.</p>
<p>If you ordered a T shirt, please check that the size is correct using the size charts <a href="https://www.aiv.org.au/documents/merchandise/size1.png">https://www.aiv.org.au/documents/merchandise/size1.png</a> and <a href="https://www.aiv.org.au/documents/merchandise/size1.png">https://www.aiv.org.au/documents/merchandise/size2.png</a>.</p>

<h3>Payments</h3>

@php
  $balancedue = $data->totalamountpayable - $data->totalpayments;
@endphp

<h4>Payment summary</h4>

<p>Your invoice is available from <a href="https://www.aiv.org.au/home/invoice">https://www.aiv.org.au/home/invoice</a> after logging in.</p>

@if( $data->registrationcomplete )
  <p>Your total amount payable on your invoice is ${{ number_format($data->totalamountpayable,2,'.','') }}.</p>
@else
  <p>Your total amount payable on your invoice is ${{ number_format($data->totalamountpayable,2,'.','') }}, but you have not completed the registration process, so this amount is subject to change.</p>
@endif

@if($data->totalpayments == 0)
  <p>There have been no payments to your account so far, and the balance due is currently ${{ number_format($balancedue,2,'.','') }}.</p>
@elseif($data->totalpayments < $data->totalamountpayable)
  <p>Payments received so far total ${{ number_format($data->totalpayments,2,'.','')  }}, and the balance due is currently ${{ number_format($balancedue,2,'.','') }}.</p>
@elseif($data->totalpayments == $data->totalamountpayable)
  <p>This has been paid in full.</p>
@elseif($data->totalpayments > $data->totalamountpayable)
  <p>Payments received so far total {{ number_format($data->totalpayments,2,'.','')  }}, so this has been paid in full, with an overpayment of ${{ number_format(-$balancedue,2,'.','') }}.</p>
@endif

@if($data->totalpayments < $data->totalamountpayable)
  <h4>Payment due dates</h4>
  <p>Please keep to the due dates to avoid incurring any penalty.</p>
  @if($data->totalamountpayable <= 50)
    @if($data->totalpayments == 0)
      <p>${{ number_format($data->totalamountpayable,2,'.','') }} is due by 31/10/2018.</p>
    @elseif($data->totalpayments < $data->totalamountpayable)
      <p>A further ${{ number_format($data->totalamountpayable - $data->totalpayments,2,'.','') }} is due by 31/10/2018.</p>
    @endif
  @elseif($data->totalamountpayable <= 200)
    @if($data->totalpayments == 0)
      <p>$50 is due by 31/10/2018, and your fees must be paid in full by 2/01/2018.</p>
    @elseif($data->totalpayments < 50)
      <p>A further ${{ number_format(50 - $data->totalpayments,2,'.','') }} is due by 31/10/2018, and your fees must be paid in full by 2/01/2018.</p>
    @elseif($data->totalpayments >= 50 && $data->totalpayments < 200)
      <p>Your fees must be paid in full by 2/01/2018.</p>
    @endif
  @else
    @if($data->totalpayments == 0)
      <p>$50 is due by 31/10/2018, a further $150 is due by 2/01/2018 (totalling $200 at this point), and your fees must be paid in full by 10/01/2019.</p>
    @elseif($data->totalpayments < 50)
      <p>A further ${{ number_format(50 - $data->totalpayments,2,'.','') }} is due by 31/10/2018 (to total $50 by this date), a further $150 is due by 2/01/2018 (to total $200 by this date), and your fees must be paid in full by 10/01/2018.</p>
    @elseif($data->totalpayments >= 50 && $data->totalpayments < 200)
      <p>A further ${{ number_format(200 - $data->totalpayments,2,'.','') }} is due by 2/01/2018 (to total $200 by this date), and your fees must be paid in full by 10/01/2018.</p>
    @elseif($data->totalpayments >= 200 && $data->totalpayments < $data->totalamountpayable)
      <p>Your fees must be paid in full by 10/01/2018.</p>
    @endif
  @endif
@endif



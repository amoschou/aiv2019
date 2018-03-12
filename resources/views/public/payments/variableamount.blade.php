@extends('public.layouts.base')

@section('class') portfolio-contact @endsection

@section('cellsupportingtext')
  @if(isset($essay))
    @foreach ($essay as $section)
      @if($section[0] !== '')
        <h3 class="mdl-typography--headline">{{ $section[0] }}</h3>
      @endif
      @foreach ($section[1] as $par)
        <p>{!! $par !!}</p>
      @endforeach
    @endforeach
  @endif
  @if(isset($text1))
    @foreach ($text1 as $par)
      <p>{{ $par }}</p>
    @endforeach
  @endif
  @section('receiptmessage')
  @stop

<script>
  function calculate()
  {
    if(document.getElementsByName('cardtype')[0].checked)
    {
      feetype = 'domestic';
    }
    else
    {
      if(document.getElementsByName('cardtype')[1].checked)
      {
        feetype = 'international';
      }
      else
      {
        feetype = 'This should never happen.';
      }
    }
    switch(feetype)
    {
      case('domestic'):
        var percentage = '1.75';
        break;
      case('international'):
        var percentage = '2.9';
        break;
      default:
        alert(feetype);
        break;
    }
    document.getElementById('percentage').innerHTML = percentage;
    var pvindollars = document.getElementById('pv').value;
    if(pvindollars.charAt(0) === '$')
    {
      pvindollars = pvindollars.substr(1);
    }
    if(/^[0-9]+(\.[0-9]{2})?$/.test(pvindollars))
    {
      var pvindollarsandcents = pvindollars.split('.',2);
      var pvdollars = Number(pvindollarsandcents[0]);
      var pvcents = Number(pvindollarsandcents[1]) || 0;
      var pvincents = 100*pvdollars + pvcents;
      pvcents = ((pvcents < 10) ? '0' : '') + pvcents;
      document.getElementById('pv').value = '$' + pvdollars + '.' + pvcents;
      switch(feetype)
      {
        case('domestic'):
          var p = 7;
          var B = 12193;
          var A = 393;
          break;
        case('international'):
          var p = 29;
          var B = 30471;
          var A = 971;
          break;
        default:
          alert(feetype);
          break;
      }
      var feeincents = Math.floor((p*pvincents + B)/A);
      var feecents = feeincents % 100;
      var feedollars = (feeincents - feecents)/100;
      feecents = ((feecents < 10) ? '0' : '') + feecents;
      document.getElementById('fee1').value = '$' + feedollars + '.' + feecents;
      document.getElementById('fee2').value = '$' + feedollars + '.' + feecents;

      var totalincents = feeincents + pvincents;
      var totalcents = totalincents % 100;
      var totaldollars = (totalincents - totalcents)/100;
      totalcents = ((totalcents < 10) ? '0' : '') + totalcents;
      document.getElementById('total1').value = '$' + totaldollars + '.' + totalcents;
      document.getElementById('total2').value = '$' + totaldollars + '.' + totalcents;
    }
    else
    {
      document.getElementById('pv').value = '';
      document.getElementById('fee1').value = '';
      document.getElementById('fee2').value = '';
      document.getElementById('total1').value = '';
      document.getElementById('total2').value = '';
      
    }
  }
</script>

<form action="/payments/checkout" method="POST">
  {{ csrf_field() }}
  <div class="mdl-textfield @if ($errors->has('name')) is-invalid @endif mdl-js-textfield mdl-textfield--floating-label">
    <input class="mdl-textfield__input" pattern=".+" type="text" id="name" name="name" value="{{ old('name') }}">
    <label class="mdl-textfield__label" for="name">Name</label>
    <span class="mdl-textfield__error">Attention!
      @if ($errors->has('name'))
        @foreach ($errors->get('name') as $message)
          <br>{{ $message }}
        @endforeach
      @endif
    </span>
  </div>
  <div class="mdl-textfield @if ($errors->has('email')) is-invalid @endif mdl-js-textfield mdl-textfield--floating-label">
    <input class="mdl-textfield__input" pattern="^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$" type="text" id="email" name="email" value="{{ old('email') }}">
    <label class="mdl-textfield__label" for="email">Email address</label>
    <span class="mdl-textfield__error">Attention!
      @if ($errors->has('email'))
        @foreach ($errors->get('email') as $message)
          <br>{{ $message }}
        @endforeach
      @endif
    </span>
  </div>
  <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="subscribe">
    <input type="checkbox" id="subscribe" class="mdl-checkbox__input" checked name="subscribe" value="yes">
    <span class="mdl-checkbox__label">Subscribe to learn about Adelaide IV news and events.</span>
  </label>
  <div class="mdl-textfield @if ($errors->has('phone')) is-invalid @endif mdl-js-textfield mdl-textfield--floating-label">
    <input class="mdl-textfield__input" pattern=".+" type="tel" id="phone" name="phone" value="{{ old('phone') }}">
    <label class="mdl-textfield__label" for="phone">Phone number</label>
    <span class="mdl-textfield__error">Attention!
      @if ($errors->has('phone'))
        @foreach ($errors->get('phone') as $message)
          <br>{{ $message }}
        @endforeach
      @endif
    </span>
  </div>
  <div class="mdl-textfield @if ($errors->has('purpose')) is-invalid @endif mdl-js-textfield mdl-textfield--floating-label">
    <input class="mdl-textfield__input" pattern=".+" type="text" id="purpose" name="purpose" value="{{ old('purpose') }}">
    <label class="mdl-textfield__label" for="purpose">Purpose of payment (e.g. Preregistration, donation)</label>
    <span class="mdl-textfield__error">Attention!
      @if ($errors->has('purpose'))
        @foreach ($errors->get('purpose') as $message)
          <br>{{ $message }}
        @endforeach
      @endif
    </span>
  </div>
  <div class="mdl-textfield @if ($errors->has('pv')) is-invalid @endif mdl-js-textfield mdl-textfield--floating-label">
    <input class="mdl-textfield__input" type="text" id="pv" name="pv" onblur="calculate()" value="{{ old('pv') }}">
    <label class="mdl-textfield__label" for="pv">Payment value</label>
    <span class="mdl-textfield__error">Attention!
      @if ($errors->has('pv'))
        @foreach ($errors->get('pv') as $message)
          <br>{{ $message }}
        @endforeach
      @endif
    </span>
  </div>
  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label has-placeholder">
    <label class="mdl-textfield__label" for="cardtypegroup">Card type</label>
    <input type="hidden" id="cardtypegroup">
    <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="cardtypedomestic">
      <input type="radio" id="cardtypedomestic" class="mdl-radio__button" name="cardtype" value="domestic" @if (old('cardtype') !== 'international') checked @endif onchange="calculate()">
      <span class="mdl-radio__label">Domestic (Australian)</span>
    </label><br>
    <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="cardtypeinternational">
      <input type="radio" id="cardtypeinternational" class="mdl-radio__button" name="cardtype" value="international" @if (old('cardtype') === 'international') checked @endif onchange="calculate()">
      <span class="mdl-radio__label">International</span>
    </label>
  </div>
  <!-- rgb(96, 125, 139) -->
  <!-- rgba(0, 0, 0, .26) -->
  <style>
fieldset[disabled] .mdl-textfield .mdl-textfield__input, .mdl-textfield.is-disabled .mdl-textfield__input {
    background-color: transparent;
    border-bottom: 1px solid rgba(0, 0, 0, .12);
    color: rgb(96, 125, 139);
    -webkit-text-fill-color:rgb(96, 125, 139);
}
fieldset[disabled] .mdl-textfield .mdl-textfield__label, .mdl-textfield.is-disabled.is-disabled .mdl-textfield__label {
    color: rgb(96, 125, 139);
}
  </style>
  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label is-dirty">
    <!-- The disabled input for user display doesn't validate or flash.
         Therefore also require a hidden input for machine use. -->
    <input class="mdl-textfield__input" type="text" id="fee1" disabled value="@if (old('fee') === '' || is_null(old('fee'))) &nbsp; @else old('fee',' ') @endif">
    <label class="mdl-textfield__label" for="fee">Transaction fee (30c + <span id="percentage">1.75</span>% of the total charge; We make no profit from transaction fees)</label>
  </div>
  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    <!-- The disabled input for user display doesn't validate or flash.
         Therefore also require a hidden input for machine use. -->
    <input class="mdl-textfield__input" type="text" id="total1" disabled value="@if (old('total') === '' || is_null(old('total'))) &nbsp; @else old('total',' ') @endif">
    <label class="mdl-textfield__label" for="total">Total charge</label>
  </div>
  <input type="hidden" id="fee2" name="fee" value="{{ old('fee') }}">
  <input type="hidden" id="total2" name="total" value="{{ old('total') }}">
  <p>
    Card details are collected on the next page.
  </p>
  <p>
    <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" type="submit">
      Next
    </button>
  </p>
</form>

@stop




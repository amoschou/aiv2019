@extends ('layouts.base')

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

  <form action="/participate/choir/register" method="POST">
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
    <p>Please organise payment (We suggest about $50 to $100, your choice) to the account BSB&nbsp;105-120 account number&nbsp;027885840. If you can, please email the internet banking receipt to <strong>banking@aiv.org.au</strong>, and copy and paste it into the box below, so that things don’t become anonymous.</p>
    <div class="mdl-textfield @if ($errors->has('receipt')) is-invalid @endif mdl-js-textfield mdl-textfield--floating-label">
      <textarea class="mdl-textfield__input" pattern=".+" type="text" rows="6" id="receipt" name="receipt">{{ old('receipt') }}</textarea>
      <label class="mdl-textfield__label" for="receipt">Message or internet banking receipt</label>
      <span class="mdl-textfield__error">Attention!
        @if ($errors->has('receipt'))
          @foreach ($errors->get('receipt') as $message)
            <br>{{ $message }}
          @endforeach
        @endif
      </span>
    </div>
    <p>
      <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" type="submit">
          Submit
      </button>
    </p>
  </form>


@endsection
@extends ('layouts.base')

@section('class') portfolio-contact @endsection

@section('cellsupportingtext')
  <form action="/contact" method="POST">
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
    <div class="mdl-textfield @if ($errors->has('subject')) is-invalid @endif mdl-js-textfield mdl-textfield--floating-label">
      <input class="mdl-textfield__input" pattern=".+" type="text" id="subject" name="subject" value="{{ old('subject') }}">
      <label class="mdl-textfield__label" for="subject">Subject</label>
      <span class="mdl-textfield__error">Attention!
        @if ($errors->has('subject'))
          @foreach ($errors->get('subject') as $message)
            <br>{{ $message }}
          @endforeach
        @endif
      </span>
    </div>
    <div class="mdl-textfield @if ($errors->has('message')) is-invalid @endif mdl-js-textfield mdl-textfield--floating-label">
      <textarea class="mdl-textfield__input" pattern=".+" type="text" rows="6" id="message" name="message">{{ old('message') }}</textarea>
      <label class="mdl-textfield__label" for="message">Message</label>
      <span class="mdl-textfield__error">Attention!
        @if ($errors->has('message'))
          @foreach ($errors->get('message') as $message)
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
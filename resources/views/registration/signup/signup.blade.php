@extends('registration.layouts.app')

@section('extrascripts')
<script>
  function toggleusername()
  {
    if(document.getElementById('sharedemail').checked)
    {
      document.getElementById('usernamegroup').hidden = false;
    }
    else
    {
      document.getElementById('usernamegroup').hidden = true;
      document.getElementById('username').value = '';
    }
  }
</script>
@endsection

@section('extrastyles')
<link href="https://cdn.jsdelivr.net/npm/pretty-checkbox@3.0/dist/pretty-checkbox.min.css"
      rel="stylesheet">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
@endsection

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card card-default border-primary rounded-0">
        <div class="card-header border-primary rounded-0 bg-primary text-white">Registration</div>
        <div class="card-body">
          <form method="POST" action="/login">
            @csrf
            <div class="form-group">
              <label for="email">Email Address</label>
              <input id="email" type="email" class="rounded-0 form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
              @if ($errors->has('email'))
                <span class="invalid-feedback">
                  <strong>{{ $errors->first('email') }}</strong>
                </span>
              @endif
            </div>
            <div class="form-group">
              <div class="pl-0 form-check">
                <div class="pretty p-icon p-toggle p-plain">
                  <input class="form-check-input" type="checkbox" id="sharedemail" value="on" name="sharedemail" onchange="toggleusername()" @if ($errors->has('username') || old('username')) checked @endif>
                  <div class="state p-on">
                    <i class="icon material-icons text-primary">check_box</i>
                    <label class="form-check-label" for="sharedemail">This is a shared email address.</label>
                  </div>
                  <div class="state p-off">
                    <i class="icon material-icons text-secondary">check_box_outline_blank</i>
                    <label class="form-check-label" for="sharedemail">This is a shared email address.</label>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group" id="usernamegroup" @if ($errors->has('username') || old('username')) @else hidden @endif>
              <label for="username">Username</label>
              <input id="username" type="text" class="rounded-0 form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" aria-describedby="usernamehelp">
              @if ($errors->has('username'))
                <span class="invalid-feedback">
                  <strong>{{ $errors->first('username') }}</strong>
                </span>
              @endif
            </div>
            {{--
            Remember doesn't work. It expects a password but this is passwordless.
            <div class="form-group">
              <div class="form-check">
                <input type="checkbox" class="form-check-input" id="remember" name="remember" value="on" {{ old('remember') ? 'checked' : '' }}>
                <label class="form-check-label" for="remember">Remember me after logging in.</label>
              </div>
            </div>
            --}}
            <button type="submit" class="rounded-0 btn btn-primary">Log in</button>
          </form>
        </div>
        <div class="card-footer border-primary">
          <p class="card-text">Registration closes on 28 December 2018.</p>        
          <p class="card-text">To access Adelaide IV Registration, please tell us your email address. If it is shared, you’ll need to provide a username too.</p>
          <p class="card-text">This form works for both signing up on your first visit and logging in afterwards.</p>
          <p class="card-text">We don’t use passwords; instead, check your email for access.</p>
        </div>
{{--
        <div class="card-footer border-primary bg-warning">
          <p class="card-text">Emails are failing to deliver to Hotmail and other Microsoft addresses, if you are having trouble and are using one of these addresses, please consider registering under a different address. We apologise for the inconvenience.</p>
        </div>
--}}
      </div>
    </div>
  </div>
</div>
@endsection

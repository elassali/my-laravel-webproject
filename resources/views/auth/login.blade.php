<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="stylesheet" href="{{asset('css/libs.css')}}">
</head>

<body class="login-img3-body">

  <div class="container">

    <form class="login-form" method="POST" action="{{ route('login') }}">
        @csrf
      <div class="login-wrap">
        <p class="login-img"><i class="icon_lock_alt"></i></p>
        <div class="input-group">
          <span class="input-group-addon"><i class="icon_profile"></i></span>
          <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required placeholder="Username" autofocus>       
        </div>
        <div class="input-group">
          <span class="input-group-addon"><i class="icon_key_alt"></i></span>
          <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Password" required>

          
         </div>
         @if ($errors->has('password'))
              <span class="text-danger">
                  <strong>{{ $errors->first('password') }}</strong>
              </span>
          @endif       
         @if ($errors->has('email'))
         <span class="text-danger">
             <strong>{{ $errors->first('email') }}</strong>
         </span>
        @endif 
        <label class="checkbox">
            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}> Remember me
            <span class="pull-right">  <a href="{{ route('password.request') }}">
                {{ __('Forgot Your Password?') }}
            </a></span>
            </label>
            <button type="submit" class="btn btn-primary btn-lg btn-block">
                {{ __('Login') }}
            </button>
        @if (Route::has('register'))
        <a class="btn btn-info btn-lg btn-block" href="{{ route('register') }}">{{ __('Register') }}</a>
       @endif
      </div>
    </form>
    
  </div>


</body>

</html>

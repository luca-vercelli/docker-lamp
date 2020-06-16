<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', '') }}</title>
    <link href="{{ url('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ url('font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ url('css/animate.css') }}" rel="stylesheet">
    <link href="{{ url('css/style.css') }}" rel="stylesheet">
  </head>
  <body class="gray-bg">
    <div class="middle-box text-center loginscreen animated fadeInDown">
      <div>
        <div>
          <img src="{{ url('img/logo.png') }}" class="img img-responsive center-block" alt="">
        </div>
        @if ($errors->has('email'))
        <span class="help-block">
          <strong>{{ $errors->first('email') }}</strong>
        </span>
        @endif
        <form class="m-t" role="form" method="POST" action="{{ url('/login') }}">
          {{ csrf_field() }}
          <div class="form-group">
            <input type="email" name="email" id="email" class="form-control{{ $errors->has('email') ? ' has-error' : '' }}" placeholder="Email" required>
          </div>
          <div class="form-group">
            <input type="password" name="password" id="password" class="form-control{{ $errors->has('password') ? ' has-error' : '' }}" placeholder="Password" required>
          </div>
          <button type="submit" class="btn btn-primary block full-width m-b">Login</button>
        </form>
        <p class="m-t"> <small>Boom Digital {{ date('Y') }}</small> </p>
      </div>
    </div>
    <!-- Mainly scripts -->
    <script src="{{ url('js/jquery-2.1.1.js') }}"></script>
    <script src="{{ url('js/bootstrap.min.js') }}"></script>
  </body>
</html>

@extends('layouts.app')

@section('title','Inicia Sesión en Shopping Market')
@section('content')
<div class="page-header header-filter" style="background-image: url( {{asset('img/bg7.jpg')}}); background-size: cover; background-position: top center;">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 col-md-6 ml-auto mr-auto">
          <div class="card card-login">
            <form class="form" method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}
              <div class="card-header card-header-primary text-center">
                <h4 class="card-title">Iniciar Sesión</h4>
                <div class="social-line">
                  <a href="#pablo" class="btn btn-just-icon btn-link">
                    <i class="fa fa-facebook-square"></i>
                  </a>
                  <a href="#pablo" class="btn btn-just-icon btn-link">
                    <i class="fa fa-twitter"></i>
                  </a>
                  <a href="#pablo" class="btn btn-just-icon btn-link">
                    <i class="fa fa-google-plus"></i>
                  </a>
                </div>
              </div>
              <p class="description text-center">Ingresa tus credenciales...</p>
              <div class="card-body">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="material-icons">mail</i>
                    </span>
                </div>
                <input id="email" type="email" class="form-control" name="email" placeholder="email" value="{{ old('email') }}" required autofocus>
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
                </div>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="material-icons">lock_outline</i>
                    </span>
                </div>
                
                <input id="password" type="password" class="form-control" name="password" placeholder="contraseña" required>
                
                @if ($errors->has('password'))
                    <span class="alert alert-danger">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
               </div>

              <div class="form-check">
                <label class="form-check-label">
                  <input class="form-check-input" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Recordar Sesión
                  <span class="form-check-sign">
                    <span class="check"></span>
                  </span>
                </label>
              </div>

              <div class="footer text-center">
                <button type="submit" class="btn btn-primary btn-link btn-wd btn-lg">Ingresar</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
</div>   
@endsection

@extends('layouts.app')

@section('content')
  
  <div class="page-header header-filter" style="background-image: url({{ asset('/img/bg7.jpg') }}); background-size: cover; background-position: top center;">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 col-md-6 ml-auto mr-auto">
          <div class="card card-login">
            <form class="form" method="POST" action="{{ route('register') }}">
                {{ csrf_field() }}
                <div class="card-header card-header-primary text-center">
                <h4 class="card-title">Registrate</h4>
              </div>
              <p class="description text-center">Registrate para disfrutar de nuestros productos</p>
              <div class="card-body">
                <div class="input-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <span class="input-group-text">
                    <i class="material-icons">face</i>
                    </span>      
                    <input id="name" type="text" class="form-control" name="name" placeholder="Nombre" value="{{ old('name') }}" required autofocus>
                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="input-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <span class="input-group-text">
                        <i class="material-icons">mail</i>
                    </span>                  
                    <input id="email" type="email" class="form-control" name="email" placeholder="Email" value="{{ old('email') }}" required>
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="input-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <span class="input-group-text">
                      <i class="material-icons">lock_outline</i>
                    </span>    
                    <input id="password" type="password" class="form-control" placeholder="Contraseña" name="password" required>
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif      
                </div>
                <div class="input-group">
                    <span class="input-group-text">
                      <i class="material-icons">lock_outline</i>
                    </span>
                    <input id="password-confirm" type="password" class="form-control"  placeholder="Confirmar Contraseña" name="password_confirmation" required>
                </div>
              </div>
                <div class="footer text-center">
                    <button type="submit" class="btn btn-primary btn-link btn-wd btn-lg">Comenzar</button>
                </div>
            </form>
          </div>    
        </div>
      </div>
    </div>
  </div>
@endsection

@extends('layouts.app')

@section('style')
    <link href="{{ asset('css/home.css') }}" rel="stylesheet">
@endsection

@section('content')

        <div class="container p-0" style="margin-top: 55px">
            <div class="row justify-content-center">
                <div class="col-xs-8 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                    <div class="text-center py-4">
                        <img src="{{ asset('img/login.png') }}" alt="">
                        <h4 class="m-0 p-0 pt-2" style="padding: 2rem 2rem 0 2rem; color:#00d4e4">INICIAR SESIÓN</h4>

                    </div>

                            @if (session('status'))
                                <div class="alert alert-success autohide">
                                    {{ session('status') }}
                                </div>
                            @endif
                            @if (session('warning'))
                                <div class="alert alert-warning">
                                    {{ session('warning') }}
                                    <a class="alert-link" href="{{ route('resendActivation') }}">Reenviar mail de verificación</a>
                                </div>
                            @endif

                    <div class="text-white" style="padding: 0 2em 0 2em">
                        <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                            {{-- @csrf --}}
                            {{ csrf_field() }}



                            <div class="form-group row">
                                <div class="col-12">

                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-at"></i>
                                            </span>
                                        </div>
                                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus aria-describedby="addon-slack" placeholder="correo electrónico">
                                    </div> {{-- input-group --}}
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-12">
                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Login') }}
                                    </button>

                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
@endsection

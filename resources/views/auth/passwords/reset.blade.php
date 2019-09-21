@extends('layouts.app_without_footer')

@section('style')
    <link href="{{ asset('css/home.css') }}" rel="stylesheet">
    <style>
        body{
            background: #161b35;
            color: #fff;
        }
    </style>
@endsection

@section('content')
    <div class="container" style="margin-top: 55px">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 py-3">
                <div class="text-center px-3">
                    <img src="{{ asset('img/login.png') }}" class="py-2">
                    <h4 class="pt-3" style="color: #00d4e4">
                        CAMBIO DE CONTRASEÑA
                    </h4>
                    <span class="d-block">
                        Introduce la nueva contraseña para tu usuario.
                    </span>
                </div>

                <div class="row justify-content-center">
                    <div class="col-10 col-lg-8 py-3 my-3">

                        <form method="POST" action="{{ route('password.request') }}" aria-label="{{ __('Reset Password') }}">
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">
                            <input type="hidden" name="email" value="{{ $email ?? old('email') }}">

                            <div class="form-group">
                                <label for="password" style="color: #00d4e4;">Nueva contraseña</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon2">
                                            <i class="fas fa-lock"></i>
                                        </span>
                                    </div>
                                    <input id="password" type="password" class="form-control" name="password" placeholder="Nueva contraseña" aria-label="password" aria-describedby="basic-addon2" required autofocus>
                                </div>

                                @if ($errors->has('password'))
                                    <span class="text-danger" role="alert">
                                        <strong><small>{{ $errors->first('password') }}</small></strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="password-confirm" style="color: #00d4e4;">Confirmar contraseña</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon3">
                                            <i class="fas fa-lock"></i>
                                        </span>
                                    </div>
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Repite la nueva contraseña" aria-label="password" aria-describedby="basic-addon3" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="text-center pt-3">
                                    <button type="submit" class="btn btn-primary">
                                        Cambiar contraseña
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>

            </div> {{-- col --}}
        </div> {{-- row --}}
    </div> {{-- container --}}
@endsection

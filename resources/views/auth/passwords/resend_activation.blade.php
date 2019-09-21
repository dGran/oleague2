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
                    <h5 class="pt-3" style="color: #00d4e4">
                        ACTIVA TU CUENTA
                    </h5>
                    <span class="d-block" style="font-size: .9em">
                        Indícanos la dirección de correo electrónico con la que te has registrado y te enviaremos un correo electrónico con instrucciones para activar tu cuenta.
                    </span>
                </div>

                    <div class="row justify-content-center">
                        <div class="col-10 col-lg-8 py-3 my-3">

                        <form method="POST" action="{{ route('resendActivation.mail') }}">
                                @csrf

                            <div class="form-group">
                                <label for="email" style="color: #00d4e4;">Correo electrónico</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">@</span>
                                    </div>
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Correo electrónico" required>
                                </div>
                                @if ($errors->has('email'))
                                    <span class="text-danger" role="alert">
                                        <strong><small>{{ $errors->first('email') }}</small></strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <div class="text-center pt-3">
                                    <button type="submit" class="btn btn-primary">
                                        Enviar enlace de activación
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
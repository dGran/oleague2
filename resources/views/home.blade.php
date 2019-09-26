@extends('layouts.app')

@section('style')
    <link href="{{ asset('css/home.css') }}" rel="stylesheet">
    <style>
        body{
            /*background: #161b35;*/
        }
    </style>
@endsection

@section('content')

    <div id="wrapper" style="background: #222B47">

        <div class="cover-page-wrap fade-in">
            <div class="cover-page-container">
                <div class="logos">
                    <div class="container">
                        <div class="row">
                            <div class="col-6 align-middle">
                                <img class="logo_game" src="img/logo_pes2020.png" alt="">
                            </div>
                            <div class="col-6 align-middle">
                                <img class="logo_platform" src="img/logo_xboxone.png" alt="">
                            </div>
                        </div>
                    </div>
                </div>

        {{--         <div class="slogan">
                    <p>
                        <span style="text-shadow: 0 0 20px #ed1e79;">
                            ligaspesxbox.com
                        </span>
                        Enjoy!
                    </p>

                </div> --}}

            </div>

        </div>

        <div class="section-title">
            <div class="container">
<div data-type="countdown" data-id="1470929" class="tickcounter" style="width: 100%; position: relative; padding-bottom: 25%"><a href="//www.tickcounter.com/countdown/1470929/sorteo-de-packs" title="SORTEO DE PACKS">SORTEO DE PACKS</a><a href="//www.tickcounter.com/" title="Countdown">Countdown</a></div><script>(function(d, s, id) { var js, pjs = d.getElementsByTagName(s)[0]; if (d.getElementById(id)) return; js = d.createElement(s); js.id = id; js.src = "//www.tickcounter.com/static/js/loader.js"; pjs.parentNode.insertBefore(js, pjs); }(document, "script", "tickcounter-sdk"));</script>
            </div>
        </div>

        <div class="section-title">
            <div class="container">
                <div class="clearfix p-0">
                    <h3 class="float-left">
                        Últimas noticias
                    </h3>
                    @if ($posts->lastPage() > 1)
                        <div class="navigation-buttons float-right">
                            <a href="{{ $posts->previousPageUrl() }}" class="mr-2 {{ $posts->currentPage() == 1 ? 'disabled' : '' }}">
                                <i class="fas fa-chevron-left"></i>
                            </a>
                            <span>{{ $posts->currentPage() }}</span>
                            <a href="{{ $posts->nextPageUrl() }}" class="ml-2 {{ $posts->currentPage() == $posts->lastPage() ? 'disabled' : '' }}">
                                <i class="fas fa-chevron-right"></i>
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-12">
                    <ul style="list-style: none; margin:0; padding: 0;">
                    @foreach ($posts as $post)
                        <li class="py-2 d-block" style="display: table; border-bottom: 1px solid #292C5E">
                            <figure style="width: 96px; height: 96px; display: table-cell; position: relative; line-height: 1.1em;" class="m-0 text-center align-top px-2">
                                @if ($post->type == "transfer")
                                    <img src="{{ asset($post->img) }}" style="width: 100%; height: auto; background: #c3cfea; border: 1px solid #940a53" class="rounded-circle">
                                @elseif ($post->type == "press")
                                    <img src="{{ asset($post->img) }}" style="margin: .5em; width: auto; height: 60px" class="rounded">
                                    <small class="text-white d-inline-block text-truncate" style="max-width: 80px;">{{ $post->press->participant->user->name }}</small>
                                @elseif ($post->type == "default")
                                    <img src="{{ $post->img }}" style="margin: .5em; width: auto; height: 60px" class="rounded">
                                @endif
                            </figure>
                            <div style="display: table-cell; padding-left: 8px;" class="align-top">
                                <ul style="list-style: none; margin:0; padding: 0">
                                    <li>
                                        <span class="text-white d-block" style="font-size: .7em">
                                            {{ $post->created_at->diffForHumans() }}
                                        </span>
                                        <span style="display: block; margin-bottom: 6px; font-size: 11px; color: #00d4e4">
                                            {{ $post->category }}
                                        </span>
                                        <span style="display: block; font-size: 16px; font-weight: 500; line-height: 20px; color: #fff;">
                                            {{ $post->title }}
                                        </span>
                                        <span style="display: block; font-size: 13px;line-height: 18px; color: #A4A4A4" class="mt-1">
                                            {{ $post->description }}
                                        </span>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    @endforeach








                    {{-- <img src="https://www.mundodeportivo.com/r/GODO/MD/p6/Barca/Imagenes/2019/03/13/Recortada/img_rguillamet_20190313-224453_imagenes_md_otras_fuentes_champions-03-klvB-U461014157231diG-980x554@MundoDeportivo-Web.jpg" class="img-fluid" alt="" width="450"> --}}



         {{--                <li class="py-2 d-block" style="display: table; border-top: 1px solid #292C5E; width: 100%">
                            <figure style="width: 96px; display: table-cell; position: relative;" class="m-0 text-center align-top p-0">
                                <img src="https://image.flaticon.com/icons/svg/448/448003.svg" alt="" style="padding: .5em .5em 0 ,5em; width: auto; height: 60px" class="rounded">
                            </figure>
                            <div style="display: table-cell; padding-left: 8px;" class="align-top">
                                <ul style="list-style: none; margin:0; padding: 0">
                                    <li>
                                        <span style="display: block; font-size: 16px; font-weight: 500; line-height: 20px; color: #fff;">
                                            Felicidades ferminnn!!
                                        </span>
                                        <span style="display: block; font-size: 13px;line-height: 18px; color: #A4A4A4" class="mt-1">
                                            LPX te desea un feliz día en tu 47 cumpleaños
                                        </span>
                                    </li>
                                </ul>
                            </div>
                            <span class="text-right" style="display: block; font-size: 11px; color: #fafafa">
                                 hoy, a las 3:43
                            </span>
                        </li>




                        <li class="py-2 d-block" style="display: table; border-top: 1px solid #292C5E">
                            <figure style="width: 96px; height: 80px; display: table-cell; position: relative;" class="m-0 text-center align-top p-0">

                                <img src="https://seeklogo.com/images/F/FC_Barcelona-logo-D941E13B46-seeklogo.com.png" alt="" style="position:absolute; left: 10px; top: 0; width: 50px; height: auto" class="rounded">
        <img src="https://upload.wikimedia.org/wikipedia/commons/d/d5/Flamengo_FC_%28Alegrete%29_-_3.png" alt="" style="position: absolute; right: 10px; top: 15px; width: 50px; height: auto" class="rounded">



                            </figure>
                            <div style="display: table-cell; padding-left: 8px;" class="align-top">
                                <ul style="list-style: none; margin:0; padding: 0">
                                    <li>
                                        <span style="display: block; font-size: 11px; color: #00d4e4">
                                            COPA NORTE - FINAL
                                        </span>
                                        <span style="display: block; font-size: 16px; font-weight: 500; line-height: 20px; color: #fff;">
                                            FC Barcelona vs Flamengo
                                        </span>
                                        <span style="display: block; font-size: 13px;line-height: 18px; color: #A4A4A4" class="mt-1">
                                            FC Barcelona de Maxi y Flamengo de ferminnn disputarán la final de Copa Norte
                                        </span>
                                    </li>
                                </ul>
                            </div>
                        </li>


                        <li class="py-2 d-block" style="display: table; border-top: 1px solid #292C5E">
                            <figure style="width: 96px; height: 80px; display: table-cell; position: relative;" class="m-0 text-center align-top p-0">

                                <img src="img/winner.png" alt="" style="padding: .5em .5em 0 ,5em; width: auto; height: 60px" class="rounded">
                                <small class="text-white" style="text-shadow: 0 0 20px #ed1e79;">pAdRoNe</small>
                            </figure>
                            <div style="display: table-cell; padding-left: 8px;" class="align-top">
                                <ul style="list-style: none; margin:0; padding: 0">
                                    <li>
                                        <span style="display: block; font-size: 11px; color: #00d4e4">
                                            EUROPA LEAGUE - FINALIZADO
                                        </span>
                                        <span style="display: block; font-size: 16px; font-weight: 500; line-height: 20px; color: #fff;">
                                            Zenit campeón
                                        </span>
                                        <span style="display: block; font-size: 13px;line-height: 18px; color: #A4A4A4" class="mt-1">
                                            El Zenit de pAdRoNe se proclama campeón del torneo Europa League
                                        </span>
                                    </li>
                                </ul>
                            </div>
                        </li>


                        <li class="py-2 d-block" style="display: table; border-top: 1px solid #292C5E">
                            <figure style="width: 96px; height: 96px; display: table-cell; position: relative;" class="m-0 text-center align-top px-2">

                                <img src="img/score.png" alt="" style="padding: .5em; width: 100%; height: auto;" class="rounded">
                            </figure>
                            <div style="display: table-cell; padding-left: 8px;" class="align-top">
                                <ul style="list-style: none; margin:0; padding: 0">
                                    <li>
                                        <span style="display: block; font-size: 11px; color: #00d4e4">
                                            EUROPA LEAGUE - GRUPO A - JORNADA 3
                                        </span>
                                        <div style="display:table-cell; vertical-align: middle; " class="text-center">
                                            <div class="d-inline-block">
                                            <span style="font-size: 12px; font-weight: 500; line-height: 20px; color: #fff;">FLAMENGO</span>
        <span style="font-size: 9px; font-weight: 400; line-height: 10px; color: #fff; display:block">ferminnn</span>
        </div>
        <div class="d-inline-block align-top ml-1">
                                            <figure class="m-0 text-center align-bottom p-0">
                                            <img src="https://ssl.gstatic.com/onebox/media/sports/logos/orE554NToSkH6nuwofe7Yg_96x96.png" alt="" style="width: 18px; height: auto;">
                                            </figure>
                                            </div>
                                        </div>
                                        <div class="px-2" style="display: table-cell; font-size: 17px; font-weight: 500; line-height: 30px; color: #fff; vertical-align: bottom; padding-bottom: 15px">
                                            2 - 0
                                        </div>
                                        <div style="display:table-cell; vertical-align: middle; " class="text-center">
        <div class="d-inline-block align-top mr-1">
                                            <figure class="m-0 text-center align-bottom p-0">
                                            <img src="https://ssl.gstatic.com/onebox/media/sports/logos/orE554NToSkH6nuwofe7Yg_96x96.png" alt="" style="width: 18px; height: auto;">
                                            </figure>
                                            </div>
                                            <div class="d-inline-block">
                                            <span style="font-size: 12px; font-weight: 500; line-height: 20px; color: #fff;">FLAMENGO</span>
        <span style="font-size: 9px; font-weight: 400; line-height: 10px; color: #fff; display:block">ferminnn</span>
        </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </li> --}}

                    </ul>

                </div>
            </div>
        </div>

        <div class="section-title">
            <div class="container">
                <h3>
                    Recién llegados
                </h3>
            </div>
        </div>
        <div class="container p-3 text-white">
            <p>
                Últimos usuarios registrados en LPX
            </p>
            <ul>
                @foreach ($last_users as $user)
                    <li>{{ $user->name }}</li>

                @endforeach
            </ul>

        </div>


    </div> {{-- wrapper --}}


@endsection

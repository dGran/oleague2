@extends('layouts.app')

@section('style')
    <link href="{{ asset('css/home.css') }}" rel="stylesheet">
@endsection

@section('content')

{{-- {{ $onlineUsersCount }} usuarios conectados --}}

<div class="cover-page-wrap fade-in">

    <div class="cover-page-container">

        <div class="logos">
            <div class="container">
                <img class="logo_game" src="img/logo_pes2020.png" alt="">
                <img class="logo_platform" src="img/logo_xboxone.png" alt="">
            </div>
        </div>

{{--         <div class="buttons p-4 text-center">
            <a href="" class="btn btn-success">Registrate</a>
            <a href="" class="btn btn-danger">Registrate</a>
        </div> --}}

        <p style="text-align: center; padding-left: 1em; padding-right: 1em; padding-top: 320px; color: #00d4e4; font-size: 1.25em; font-weight: bold)">
            <span style="text-shadow: 0 0 20px #ed1e79;">Torneos y campeonatos online<br>Pro Evolution Soccer - Xbox One</span>
        </p>

    </div>
</div>

{{-- <div class="container-fluid" style="overflow-x: hidden;">
          <nav class="tabbable">
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
              <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Home</a>
              <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Profile</a>
              <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Contact</a>
              <a class="nav-item nav-link" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Home</a>
              <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Profile</a>
              <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Contact</a>
              <a class="nav-item nav-link" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Home</a>
              <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Profile</a>
              <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Contact</a>
              <a class="nav-item nav-link" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Home</a>
              <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Profile</a>
            </div>
          </nav>
          <div class="tab-content pt-2" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">Home</div>
            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">Profile</div>
            <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">Contact</div>
          </div>
        </div> --}}


<div class="container">

    <div class="row">
        <div class="col-12">

{{--             <img src="https://www.mundodeportivo.com/r/GODO/MD/p6/Barca/Imagenes/2019/03/13/Recortada/img_rguillamet_20190313-224453_imagenes_md_otras_fuentes_champions-03-klvB-U461014157231diG-980x554@MundoDeportivo-Web.jpg" class="img-fluid" alt="" width="450"> --}}
            <ul style="list-style: none; margin:0; padding: 0;">

                <li class="py-2 d-inline-block" style="display: table; border-top: 1px solid #292C5E; width: 100%">
                    <figure style="width: 96px; height: 80px; display: table-cell; position: relative;" class="m-0 text-center align-top p-0">

                        <img src="img/microphone.png" alt="" style="padding: .5em .5em 0 ,5em; width: auto; height: 60px" class="rounded">
                        <small class="text-white" style="text-shadow: 0 0 20px #ed1e79;">Luizao</small>
                    </figure>
                    <div style="display: table-cell; padding-left: 8px;" class="align-top">
                        <ul style="list-style: none; margin:0; padding: 0">
                            <li>
                                <span style="display: block; font-size: 11px; color: #00d4e4">
                                    RUEDA DE PRENSA - AJAX
                                </span>
                                <span style="display: block; font-size: 16px; font-weight: 500; line-height: 20px; color: #fff;">
                                    "Konami me trolea"
                                </span>
                                <span style="display: block; font-size: 13px;line-height: 18px; color: #A4A4A4" class="mt-1">
                                    El técnico del Ajax explota y carga contra los desarrolladores de Konami. "Es muy injusto querer hacer cosas y no poder"
                                </span>
                            </li>
                            <li class="text-right pt-2">
                                <span style="display: block; font-size: 11px; color: #fafafa">
                                     hoy, a las 3:43
                                </span>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="py-2 d-inline-block" style="display: table; border-top: 1px solid #292C5E; width: 100%">
                    <figure style="width: 96px; display: table-cell; position: relative;" class="m-0 text-center align-top p-0">
                        <img src="https://image.flaticon.com/icons/svg/448/448003.svg" alt="" style="padding: .5em .5em 0 ,5em; width: auto; height: 60px" class="rounded">
                    </figure>
                    <div style="display: table-cell; padding-left: 8px;" class="align-top">
                        <ul style="list-style: none; margin:0; padding: 0">
                            <li>
{{--                                 <span style="display: block; font-size: 11px; color: #00d4e4">
                                    Ferminnn cumple 47 años
                                </span> --}}
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




                <li class="py-2 d-inline-block" style="display: table; border-top: 1px solid #292C5E">
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

{{--                 <li class="py-2 d-inline-block" style="display: table; border-top: 1px solid #292C5E">
                                <span style="display: block; font-size: 11px; color: #00d4e4">
                                    SORTEO DE PACKS
                                </span>
                    <img src="http://i61.tinypic.com/wph76.jpg" alt="" class="img-fluid">
                </li> --}}

                <li class="py-2 d-inline-block" style="display: table; border-top: 1px solid #292C5E">
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

                <li class="py-2 d-inline-block" style="display: table; border-top: 1px solid #292C5E">
                    <figure style="width: 96px; height: 80px; display: table-cell; position: relative;" class="m-0 text-center align-top p-0">

                        <img src="img/microphone.png" alt="" style="padding: .5em .5em 0 ,5em; width: auto; height: 60px" class="rounded">
                        <small class="text-white" style="text-shadow: 0 0 20px #ed1e79;">padronee</small>
                    </figure>
                    <div style="display: table-cell; padding-left: 8px;" class="align-top">
                        <ul style="list-style: none; margin:0; padding: 0">
                            <li>
                                <span style="display: block; font-size: 11px; color: #00d4e4">
                                    RUEDA DE PRENSA - ZENIT
                                </span>
                                <span style="display: block; font-size: 16px; font-weight: 500; line-height: 20px; color: #fff;">
                                    "Pollito no está en venta"
                                </span>
                                <span style="display: block; font-size: 13px;line-height: 18px; color: #A4A4A4" class="mt-1">
                                    Es el jugador más valioso del equipo, si alguien lo quiere que pase por caja. Lorem ipsum dolor sit amet, consectetur adipisicing elit
                                </span>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="py-2 d-inline-block" style="display: table; border-top: 1px solid #292C5E">
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
                </li>


                <li class="py-2 d-inline-block" style="display: table; border-top: 1px solid #292C5E">
                    <figure style="width: 96px; height: 96px; display: table-cell; position: relative;" class="m-0 text-center align-top px-2">

                        <img src="http://pesdb.net/pes2019/images/players/60550.png" alt="L. Suarez firma por el PSG" style="width: 100%; height: auto; background: #c3cfea; border: 1px solid #940a53" class="rounded-circle">
                    </figure>
                    <div style="display: table-cell; padding-left: 8px;" class="align-top">
                        <ul style="list-style: none; margin:0; padding: 0">
                            <li>
                                <span style="display: block; font-size: 11px; color: #00d4e4">
                                    FICHAJES - ZENIT
                                </span>
                                <span style="display: block; font-size: 16px; font-weight: 500; line-height: 20px; color: #fff;">
                                    A. Saint-Maximin "Pollito" firma por el ZENIT
                                </span>
                                <span style="display: block; font-size: 13px;line-height: 18px; color: #A4A4A4" class="mt-1">
                                    Se incorpora como agente libre
                                </span>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="py-2 d-inline-block" style="display: table; border-top: 1px solid #292C5E">
                    <figure style="width: 96px; height: 96px; display: table-cell; position: relative;" class="m-0 text-center align-top px-2">

                        <img src="http://pesdb.net/pes2018/images/players/player_34881.png" alt="L. Suarez firma por el PSG" style="width: 100%; height: auto; background: #c3cfea; border: 1px solid #940a53" class="rounded-circle">
                    </figure>
                    <div style="display: table-cell; padding-left: 8px;" class="align-top">
                        <ul style="list-style: none; margin:0; padding: 0">
                            <li>
                                <span style="display: block; font-size: 11px; color: #00d4e4">
                                    FICHAJES - ZENIT
                                </span>
                                <span style="display: block; font-size: 16px; font-weight: 500; line-height: 20px; color: #fff;">
                                    A. Saint-Maximin "Pollito" firma por el ZENIT
                                </span>
                                <span style="display: block; font-size: 13px;line-height: 18px; color: #A4A4A4" class="mt-1">
                                    Se incorpora como agente libre
                                </span>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>

        </div>
    </div>

    <div class="section-title">
        Video resultados
    </div>
</div>
@endsection

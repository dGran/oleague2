@extends('layouts.app')

@section('section')
    <section class="section">

    	<div class="container title">
			<div class="row align-items-center">
				<div class="col">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="{{ route('home') }}">Portada</a></li>
						</ol>
					</nav>
					<h2 class="d-inline-block">Competiciones</h2>
				</div>
				<div class="col text-right banner d-none d-md-inline-block">
					<img src="{{ asset('img/menus/competitions.png') }}" alt="competiciones">
				</div>
			</div>
		</div>

		<div class="row no-gutters menu">
			<div class="container">
				<nav>
					<ul class="nav">
						<li class="nav-item">
							<a class="nav-link" href="{{ route('competition') }}">Champions League</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="">Europa League</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="">Liga Norte</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="">Copa Norte</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="">Liga Sur</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="">Copa Sur</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="">Liga Este</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="">Copa Este</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="">Liga Oeste</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="">Copa Oeste</a>
						</li>
					</ul>
				</nav>
			</div>
		</div>

	</section>
@endsection

@section('content')

	<div class="container">

	    <div class="row my-4">
    		<div class="col-12 col-sm-4">
				<h4>Ultimos resultados</h4>

		            <ul style="list-style: none; margin:0; padding: 0;">

		                <li class="border-top py-2">
		                    <div style="display: block; font-weight: 200; font-size: 11px;" class="clearfix">
		                        <span class="float-left">PARTIDO FINALIZADO</span>
		                        <span class="float-right">ayer, 12:31</span>
		                    </div>
		                    <div style="display: block; background: #e9ecef; border-top: 2px solid #ced4da" class="align-top p-2">
		                        <ul style="list-style: none; margin:0; padding: 0; background: #f8f9fa">
		                            <li style="border: 1px solid #fff; ">
		                                <div style="display: block; font-weight: 500; font-size: 12px; line-height: 24px; border-bottom: 1px solid #e9ecef;" class="clearfix py-1 px-2">
		                                    <img src="https://www.legalgamblingandthelaw.com/images/icons/sports/leagues/uefa-champions-league.png" width="24" class="float-left mr-2">
		                                    <span class="float-left border-left pl-2">CHAMPIONS LEAGUE</span>
		                                    <span class="float-right">Grupo B - Jornada 1</span>
		                                </div>
		                                <div style="display: table; font-size: 11px; font-weight: 200; line-height: 18px; background: #fff; " class="w-100 pt-1">
		                                    <div style="display: table-cell; width: 42%" class="text-right pr-1">
		                                        FLAMENGO
		                                        <img src="https://3.bp.blogspot.com/---SFAGB1KH0/WWPPxu80EBI/AAAAAAABMfg/TqZwGFBY2LEBSg-GkeNEmILZ6ZvxbS7QQCLcBGAs/s1600/Flamengo128x.png" alt="" width="22">
		                                    </div>
		                                    <div style="display: table-cell; width: 16%; padding: 5px 10px; font-size: 13px; font-weight: 500; background: #373737; color: #fff; text-align: center;">
		                                        2 - 2
		                                    </div>
		                                    <div style="display: table-cell; width: 42%" class="text-left pl-1">
		                                        <img src="https://3.bp.blogspot.com/--wb1CxJiWg4/WWPL1O-G64I/AAAAAAABMd0/ABxiPfdXcxQDPL-c0gR4YnGsKXg0BdxfQCLcBGAs/s1600/Botafago128x.png" alt="" width="22">
		                                        BOTAFOGO
		                                    </div>
		                                </div>
		                                <div style="display: table; font-size: 11px; font-weight: 200; line-height: 18px; background: #fff; " class="w-100 pt-1">
		                                    <div style="display: table-cell; width: 42%" class="text-right pr-1">
		                                        Mbappe, C. Ronaldo
		                                        <i class="fas fa-futbol"></i>
		                                    </div>
		                                    <div style="display: table-cell; width: 16%; padding: 5px 10px; font-size: 13px; font-weight: 500; color: #fff; text-align: center;">
		                                    </div>
		                                    <div style="display: table-cell; width: 42%" class="text-left pl-1">
		                                        <i class="fas fa-futbol"></i>
		                                        Benteke (2)
		                                    </div>
		                                </div>
		                                <div style="display: table; font-size: 11px; font-weight: 200; line-height: 18px; background: #fff; " class="w-100">
		                                    <div style="display: table-cell; width: 42%" class="text-right pr-1">
		                                        Hummels
		                                        <i class="fas fa-square" style="color: #fff80b"></i>
		                                    </div>
		                                    <div style="display: table-cell; width: 16%; padding: 5px 10px; font-size: 13px; font-weight: 500; color: #fff; text-align: center;">
		                                    </div>
		                                    <div style="display: table-cell; width: 42%" class="text-left pl-1">
		                                        <i class="fas fa-square" style="color: red"></i>
		                                        Pique
		                                    </div>
		                                </div>
		                            </li>
		                        </ul>
		                    </div>
		                </li>

		                <li class="border-top py-2">
		                    <div style="display: block; font-weight: 200; font-size: 11px;" class="clearfix">
		                        <span class="float-left">PARTIDO FINALIZADO</span>
		                        <span class="float-right">ayer, 12:31</span>
		                    </div>
		                    <div style="display: block; background: #e9ecef; border-top: 2px solid #ced4da" class="align-top p-2">
		                        <ul style="list-style: none; margin:0; padding: 0; background: #f8f9fa">
		                            <li style="border: 1px solid #fff; ">
		                                <div style="display: block; font-weight: 500; font-size: 12px; line-height: 24px; border-bottom: 1px solid #e9ecef;" class="clearfix py-1 px-2">
		                                    <img src="https://www.legalgamblingandthelaw.com/images/icons/sports/leagues/uefa-champions-league.png" width="24" class="float-left mr-2">
		                                    <span class="float-left border-left pl-2">CHAMPIONS LEAGUE</span>
		                                    <span class="float-right">Grupo B - Jornada 1</span>
		                                </div>
		                                <div style="display: table; font-size: 11px; font-weight: 200; line-height: 18px; background: #fff; " class="w-100 pt-1">
		                                    <div style="display: table-cell; width: 42%" class="text-right pr-1">
		                                        FLAMENGO
		                                        <img src="https://3.bp.blogspot.com/---SFAGB1KH0/WWPPxu80EBI/AAAAAAABMfg/TqZwGFBY2LEBSg-GkeNEmILZ6ZvxbS7QQCLcBGAs/s1600/Flamengo128x.png" alt="" width="22">
		                                    </div>
		                                    <div style="display: table-cell; width: 16%; padding: 5px 10px; font-size: 13px; font-weight: 500; background: #373737; color: #fff; text-align: center;">
		                                        2 - 2
		                                    </div>
		                                    <div style="display: table-cell; width: 42%" class="text-left pl-1">
		                                        <img src="https://3.bp.blogspot.com/--wb1CxJiWg4/WWPL1O-G64I/AAAAAAABMd0/ABxiPfdXcxQDPL-c0gR4YnGsKXg0BdxfQCLcBGAs/s1600/Botafago128x.png" alt="" width="22">
		                                        BOTAFOGO
		                                    </div>
		                                </div>
		                                <div style="display: table; font-size: 11px; font-weight: 200; line-height: 18px; background: #fff; " class="w-100 pt-1">
		                                    <div style="display: table-cell; width: 42%" class="text-right pr-1">
		                                        Mbappe, C. Ronaldo
		                                        <i class="fas fa-futbol"></i>
		                                    </div>
		                                    <div style="display: table-cell; width: 16%; padding: 5px 10px; font-size: 13px; font-weight: 500; color: #fff; text-align: center;">
		                                    </div>
		                                    <div style="display: table-cell; width: 42%" class="text-left pl-1">
		                                        <i class="fas fa-futbol"></i>
		                                        Benteke (2)
		                                    </div>
		                                </div>
		                                <div style="display: table; font-size: 11px; font-weight: 200; line-height: 18px; background: #fff; " class="w-100">
		                                    <div style="display: table-cell; width: 42%" class="text-right pr-1">
		                                        Hummels
		                                        <i class="fas fa-square" style="color: #fff80b"></i>
		                                    </div>
		                                    <div style="display: table-cell; width: 16%; padding: 5px 10px; font-size: 13px; font-weight: 500; color: #fff; text-align: center;">
		                                    </div>
		                                    <div style="display: table-cell; width: 42%" class="text-left pl-1">
		                                        <i class="fas fa-square" style="color: red"></i>
		                                        Pique
		                                    </div>
		                                </div>
		                            </li>
		                        </ul>
		                    </div>
		                </li>

		                <li class="border-top py-2">
		                    <div style="display: block; font-weight: 200; font-size: 11px;" class="clearfix">
		                        <span class="float-left">PARTIDO FINALIZADO</span>
		                        <span class="float-right">ayer, 12:31</span>
		                    </div>
		                    <div style="display: block; background: #e9ecef; border-top: 2px solid #ced4da" class="align-top p-2">
		                        <ul style="list-style: none; margin:0; padding: 0; background: #f8f9fa">
		                            <li style="border: 1px solid #fff; ">
		                                <div style="display: block; font-weight: 500; font-size: 12px; line-height: 24px; border-bottom: 1px solid #e9ecef;" class="clearfix py-1 px-2">
		                                    <img src="https://www.legalgamblingandthelaw.com/images/icons/sports/leagues/uefa-champions-league.png" width="24" class="float-left mr-2">
		                                    <span class="float-left border-left pl-2">CHAMPIONS LEAGUE</span>
		                                    <span class="float-right">Grupo B - Jornada 1</span>
		                                </div>
		                                <div style="display: table; font-size: 11px; font-weight: 200; line-height: 18px; background: #fff; " class="w-100 pt-1">
		                                    <div style="display: table-cell; width: 42%" class="text-right pr-1">
		                                        FLAMENGO
		                                        <img src="https://3.bp.blogspot.com/---SFAGB1KH0/WWPPxu80EBI/AAAAAAABMfg/TqZwGFBY2LEBSg-GkeNEmILZ6ZvxbS7QQCLcBGAs/s1600/Flamengo128x.png" alt="" width="22">
		                                    </div>
		                                    <div style="display: table-cell; width: 16%; padding: 5px 10px; font-size: 13px; font-weight: 500; background: #373737; color: #fff; text-align: center;">
		                                        2 - 2
		                                    </div>
		                                    <div style="display: table-cell; width: 42%" class="text-left pl-1">
		                                        <img src="https://3.bp.blogspot.com/--wb1CxJiWg4/WWPL1O-G64I/AAAAAAABMd0/ABxiPfdXcxQDPL-c0gR4YnGsKXg0BdxfQCLcBGAs/s1600/Botafago128x.png" alt="" width="22">
		                                        BOTAFOGO
		                                    </div>
		                                </div>
		                                <div style="display: table; font-size: 11px; font-weight: 200; line-height: 18px; background: #fff; " class="w-100 pt-1">
		                                    <div style="display: table-cell; width: 42%" class="text-right pr-1">
		                                        Mbappe, C. Ronaldo
		                                        <i class="fas fa-futbol"></i>
		                                    </div>
		                                    <div style="display: table-cell; width: 16%; padding: 5px 10px; font-size: 13px; font-weight: 500; color: #fff; text-align: center;">
		                                    </div>
		                                    <div style="display: table-cell; width: 42%" class="text-left pl-1">
		                                        <i class="fas fa-futbol"></i>
		                                        Benteke (2)
		                                    </div>
		                                </div>
		                                <div style="display: table; font-size: 11px; font-weight: 200; line-height: 18px; background: #fff; " class="w-100">
		                                    <div style="display: table-cell; width: 42%" class="text-right pr-1">
		                                        Hummels
		                                        <i class="fas fa-square" style="color: #fff80b"></i>
		                                    </div>
		                                    <div style="display: table-cell; width: 16%; padding: 5px 10px; font-size: 13px; font-weight: 500; color: #fff; text-align: center;">
		                                    </div>
		                                    <div style="display: table-cell; width: 42%" class="text-left pl-1">
		                                        <i class="fas fa-square" style="color: red"></i>
		                                        Pique
		                                    </div>
		                                </div>
		                            </li>
		                        </ul>
		                    </div>
		                </li>
	               </ul>

    		</div>

    		<div class="col-12 col-sm-8">

    		</div>
    	</div>
    </div>


@endsection
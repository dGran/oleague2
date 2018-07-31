@extends('layouts.app')

@section('section')
    <section class="section">

    	<div class="container title">
			<div class="row align-items-center">
				<div class="col py-2 py-md-0">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="{{ route('home') }}">Portada</a></li>
							<li class="breadcrumb-item"><a href="{{ route('competitions') }}">Competiciones</a></li>
						</ol>
					</nav>
					<h2 class="d-block">Champions League</h2>
				</div>
				<div class="col text-right banner d-none d-md-inline-block">
					<img src="{{ asset('img/menus/champions.png') }}" alt="competiciones">
				</div>
			</div>
		</div>

		<div class="row no-gutters menu">
			<div class="container">
				<nav>
					<ul class="nav">
						<li class="nav-item">
							<a class="nav-link" href="{{ route('competition.league.standing') }}">Clasificación</a>
						</li>
						<li class="nav-item current">
							<a class="nav-link" href="{{ route('competition.league.schedule') }}">Calendario</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="{{ route('competition.league.statistics') }}">Estadísticas</a>
						</li>
					</ul>
				</nav>
			</div>
		</div>

	</section>
@endsection

@section('content')

	<div class="container">

	    <div class="row schedule no-gutters my-1">

	    	<div class="day col-12 col-md-6 col-lg-4 my-2">

				<div class="title">
					<span class="principal">Jornada 1</span>
				</div>

                <div class="match">
                    <div class="local">
                        FLAMENGO
                        <img src="https://3.bp.blogspot.com/---SFAGB1KH0/WWPPxu80EBI/AAAAAAABMfg/TqZwGFBY2LEBSg-GkeNEmILZ6ZvxbS7QQCLcBGAs/s1600/Flamengo128x.png" alt="" width="22">
                    </div>
                    <div class="result">
                        2 - 2
                    </div>
                    <div class="visitor">
                        <img src="https://3.bp.blogspot.com/--wb1CxJiWg4/WWPL1O-G64I/AAAAAAABMd0/ABxiPfdXcxQDPL-c0gR4YnGsKXg0BdxfQCLcBGAs/s1600/Botafago128x.png" alt="" width="22">
                        BOTAFOGO
                    </div>
                </div>

                <div class="match">
                    <div class="local">
                        FLAMENGO
                        <img src="https://3.bp.blogspot.com/---SFAGB1KH0/WWPPxu80EBI/AAAAAAABMfg/TqZwGFBY2LEBSg-GkeNEmILZ6ZvxbS7QQCLcBGAs/s1600/Flamengo128x.png" alt="" width="22">
                    </div>
                    <div class="result">
                        2 - 2
                    </div>
                    <div class="visitor">
                        <img src="https://3.bp.blogspot.com/--wb1CxJiWg4/WWPL1O-G64I/AAAAAAABMd0/ABxiPfdXcxQDPL-c0gR4YnGsKXg0BdxfQCLcBGAs/s1600/Botafago128x.png" alt="" width="22">
                        BOTAFOGO
                    </div>
                </div>

                <div class="match">
                    <div class="local">
                        FLAMENGO
                        <img src="https://3.bp.blogspot.com/---SFAGB1KH0/WWPPxu80EBI/AAAAAAABMfg/TqZwGFBY2LEBSg-GkeNEmILZ6ZvxbS7QQCLcBGAs/s1600/Flamengo128x.png" alt="" width="22">
                    </div>
                    <div class="result">
                        2 - 2
                    </div>
                    <div class="visitor">
                        <img src="https://3.bp.blogspot.com/--wb1CxJiWg4/WWPL1O-G64I/AAAAAAABMd0/ABxiPfdXcxQDPL-c0gR4YnGsKXg0BdxfQCLcBGAs/s1600/Botafago128x.png" alt="" width="22">
                        BOTAFOGO
                    </div>
                </div>

                <div class="match">
                    <div class="local">
                        FLAMENGO
                        <img src="https://3.bp.blogspot.com/---SFAGB1KH0/WWPPxu80EBI/AAAAAAABMfg/TqZwGFBY2LEBSg-GkeNEmILZ6ZvxbS7QQCLcBGAs/s1600/Flamengo128x.png" alt="" width="22">
                    </div>
                    <div class="result">
                        2 - 2
                    </div>
                    <div class="visitor">
                        <img src="https://3.bp.blogspot.com/--wb1CxJiWg4/WWPL1O-G64I/AAAAAAABMd0/ABxiPfdXcxQDPL-c0gR4YnGsKXg0BdxfQCLcBGAs/s1600/Botafago128x.png" alt="" width="22">
                        BOTAFOGO
                    </div>
                </div>
	    	</div>

	    	<div class="day col-12 col-md-6 col-lg-4 my-2">

				<div class="title">
					<span class="principal">Jornada 2</span>
				</div>

                <div class="match">
                    <div class="local">
                        FLAMENGO
                        <img src="https://3.bp.blogspot.com/---SFAGB1KH0/WWPPxu80EBI/AAAAAAABMfg/TqZwGFBY2LEBSg-GkeNEmILZ6ZvxbS7QQCLcBGAs/s1600/Flamengo128x.png" alt="" width="22">
                    </div>
                    <div class="result">
                        2 - 2
                    </div>
                    <div class="visitor">
                        <img src="https://3.bp.blogspot.com/--wb1CxJiWg4/WWPL1O-G64I/AAAAAAABMd0/ABxiPfdXcxQDPL-c0gR4YnGsKXg0BdxfQCLcBGAs/s1600/Botafago128x.png" alt="" width="22">
                        BOTAFOGO
                    </div>
                </div>

                <div class="match">
                    <div class="local">
                        FLAMENGO
                        <img src="https://3.bp.blogspot.com/---SFAGB1KH0/WWPPxu80EBI/AAAAAAABMfg/TqZwGFBY2LEBSg-GkeNEmILZ6ZvxbS7QQCLcBGAs/s1600/Flamengo128x.png" alt="" width="22">
                    </div>
                    <div class="result">
                        2 - 2
                    </div>
                    <div class="visitor">
                        <img src="https://3.bp.blogspot.com/--wb1CxJiWg4/WWPL1O-G64I/AAAAAAABMd0/ABxiPfdXcxQDPL-c0gR4YnGsKXg0BdxfQCLcBGAs/s1600/Botafago128x.png" alt="" width="22">
                        BOTAFOGO
                    </div>
                </div>

                <div class="match">
                    <div class="local">
                        FLAMENGO
                        <img src="https://3.bp.blogspot.com/---SFAGB1KH0/WWPPxu80EBI/AAAAAAABMfg/TqZwGFBY2LEBSg-GkeNEmILZ6ZvxbS7QQCLcBGAs/s1600/Flamengo128x.png" alt="" width="22">
                    </div>
                    <div class="result">
                        2 - 2
                    </div>
                    <div class="visitor">
                        <img src="https://3.bp.blogspot.com/--wb1CxJiWg4/WWPL1O-G64I/AAAAAAABMd0/ABxiPfdXcxQDPL-c0gR4YnGsKXg0BdxfQCLcBGAs/s1600/Botafago128x.png" alt="" width="22">
                        BOTAFOGO
                    </div>
                </div>

                <div class="match">
                    <div class="local">
                        FLAMENGO
                        <img src="https://3.bp.blogspot.com/---SFAGB1KH0/WWPPxu80EBI/AAAAAAABMfg/TqZwGFBY2LEBSg-GkeNEmILZ6ZvxbS7QQCLcBGAs/s1600/Flamengo128x.png" alt="" width="22">
                    </div>
                    <div class="result">
                        2 - 2
                    </div>
                    <div class="visitor">
                        <img src="https://3.bp.blogspot.com/--wb1CxJiWg4/WWPL1O-G64I/AAAAAAABMd0/ABxiPfdXcxQDPL-c0gR4YnGsKXg0BdxfQCLcBGAs/s1600/Botafago128x.png" alt="" width="22">
                        BOTAFOGO
                    </div>
                </div>
	    	</div>

	    	<div class="day col-12 col-md-6 col-lg-4 my-2">

				<div class="title">
					<span class="principal">Jornada 3</span>
				</div>

                <div class="match">
                    <div class="local">
                        FLAMENGO
                        <img src="https://3.bp.blogspot.com/---SFAGB1KH0/WWPPxu80EBI/AAAAAAABMfg/TqZwGFBY2LEBSg-GkeNEmILZ6ZvxbS7QQCLcBGAs/s1600/Flamengo128x.png" alt="" width="22">
                    </div>
                    <div class="result">
                        2 - 2
                    </div>
                    <div class="visitor">
                        <img src="https://3.bp.blogspot.com/--wb1CxJiWg4/WWPL1O-G64I/AAAAAAABMd0/ABxiPfdXcxQDPL-c0gR4YnGsKXg0BdxfQCLcBGAs/s1600/Botafago128x.png" alt="" width="22">
                        BOTAFOGO
                    </div>
                </div>

                <div class="match">
                    <div class="local">
                        FLAMENGO
                        <img src="https://3.bp.blogspot.com/---SFAGB1KH0/WWPPxu80EBI/AAAAAAABMfg/TqZwGFBY2LEBSg-GkeNEmILZ6ZvxbS7QQCLcBGAs/s1600/Flamengo128x.png" alt="" width="22">
                    </div>
                    <div class="result">
                        2 - 2
                    </div>
                    <div class="visitor">
                        <img src="https://3.bp.blogspot.com/--wb1CxJiWg4/WWPL1O-G64I/AAAAAAABMd0/ABxiPfdXcxQDPL-c0gR4YnGsKXg0BdxfQCLcBGAs/s1600/Botafago128x.png" alt="" width="22">
                        BOTAFOGO
                    </div>
                </div>

                <div class="match">
                    <div class="local">
                        FLAMENGO
                        <img src="https://3.bp.blogspot.com/---SFAGB1KH0/WWPPxu80EBI/AAAAAAABMfg/TqZwGFBY2LEBSg-GkeNEmILZ6ZvxbS7QQCLcBGAs/s1600/Flamengo128x.png" alt="" width="22">
                    </div>
                    <div class="result">
                        2 - 2
                    </div>
                    <div class="visitor">
                        <img src="https://3.bp.blogspot.com/--wb1CxJiWg4/WWPL1O-G64I/AAAAAAABMd0/ABxiPfdXcxQDPL-c0gR4YnGsKXg0BdxfQCLcBGAs/s1600/Botafago128x.png" alt="" width="22">
                        BOTAFOGO
                    </div>
                </div>

                <div class="match">
                    <div class="local">
                        FLAMENGO
                        <img src="https://3.bp.blogspot.com/---SFAGB1KH0/WWPPxu80EBI/AAAAAAABMfg/TqZwGFBY2LEBSg-GkeNEmILZ6ZvxbS7QQCLcBGAs/s1600/Flamengo128x.png" alt="" width="22">
                    </div>
                    <div class="result">
                        2 - 2
                    </div>
                    <div class="visitor">
                        <img src="https://3.bp.blogspot.com/--wb1CxJiWg4/WWPL1O-G64I/AAAAAAABMd0/ABxiPfdXcxQDPL-c0gR4YnGsKXg0BdxfQCLcBGAs/s1600/Botafago128x.png" alt="" width="22">
                        BOTAFOGO
                    </div>
                </div>
	    	</div>

	    	<div class="day col-12 col-md-6 col-lg-4 my-2">

				<div class="title">
					<span class="principal">Jornada 4</span>
				</div>

                <div class="match">
                    <div class="local">
                        FLAMENGO
                        <img src="https://3.bp.blogspot.com/---SFAGB1KH0/WWPPxu80EBI/AAAAAAABMfg/TqZwGFBY2LEBSg-GkeNEmILZ6ZvxbS7QQCLcBGAs/s1600/Flamengo128x.png" alt="" width="22">
                    </div>
                    <div class="result">
                        2 - 2
                    </div>
                    <div class="visitor">
                        <img src="https://3.bp.blogspot.com/--wb1CxJiWg4/WWPL1O-G64I/AAAAAAABMd0/ABxiPfdXcxQDPL-c0gR4YnGsKXg0BdxfQCLcBGAs/s1600/Botafago128x.png" alt="" width="22">
                        BOTAFOGO
                    </div>
                </div>

                <div class="match">
                    <div class="local">
                        FLAMENGO
                        <img src="https://3.bp.blogspot.com/---SFAGB1KH0/WWPPxu80EBI/AAAAAAABMfg/TqZwGFBY2LEBSg-GkeNEmILZ6ZvxbS7QQCLcBGAs/s1600/Flamengo128x.png" alt="" width="22">
                    </div>
                    <div class="result">
                        2 - 2
                    </div>
                    <div class="visitor">
                        <img src="https://3.bp.blogspot.com/--wb1CxJiWg4/WWPL1O-G64I/AAAAAAABMd0/ABxiPfdXcxQDPL-c0gR4YnGsKXg0BdxfQCLcBGAs/s1600/Botafago128x.png" alt="" width="22">
                        BOTAFOGO
                    </div>
                </div>

                <div class="match">
                    <div class="local">
                        FLAMENGO
                        <img src="https://3.bp.blogspot.com/---SFAGB1KH0/WWPPxu80EBI/AAAAAAABMfg/TqZwGFBY2LEBSg-GkeNEmILZ6ZvxbS7QQCLcBGAs/s1600/Flamengo128x.png" alt="" width="22">
                    </div>
                    <div class="result">
                        2 - 2
                    </div>
                    <div class="visitor">
                        <img src="https://3.bp.blogspot.com/--wb1CxJiWg4/WWPL1O-G64I/AAAAAAABMd0/ABxiPfdXcxQDPL-c0gR4YnGsKXg0BdxfQCLcBGAs/s1600/Botafago128x.png" alt="" width="22">
                        BOTAFOGO
                    </div>
                </div>

                <div class="match">
                    <div class="local">
                        FLAMENGO
                        <img src="https://3.bp.blogspot.com/---SFAGB1KH0/WWPPxu80EBI/AAAAAAABMfg/TqZwGFBY2LEBSg-GkeNEmILZ6ZvxbS7QQCLcBGAs/s1600/Flamengo128x.png" alt="" width="22">
                    </div>
                    <div class="result">
                        2 - 2
                    </div>
                    <div class="visitor">
                        <img src="https://3.bp.blogspot.com/--wb1CxJiWg4/WWPL1O-G64I/AAAAAAABMd0/ABxiPfdXcxQDPL-c0gR4YnGsKXg0BdxfQCLcBGAs/s1600/Botafago128x.png" alt="" width="22">
                        BOTAFOGO
                    </div>
                </div>
	    	</div>


		</div>

	</div>

@endsection
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

	    <div class="row">
			<div class="col-12 px-0 px-sm-3">

				<ul class="phases-selector mt-3">
	  				<li class="active">
						<a>Fase de grupos</a>
					</li>
	  				<li>
						<a>4os de final</a>
					</li>
	  				<li>
						<a>Semifinales</a>
					</li>
	  				<li>
						<a>Final</a>
					</li>
				</ul>

				<ul class="groups-selector mt-2 mb-0">
	  				<li class="active">
						<a>Grupo A</a>
					</li>
	  				<li>
						<a>Grupo B</a>
					</li>
	  				<li>
						<a>Grupo C</a>
					</li>
	  				<li>
						<a>Grupo D</a>
					</li>
				</ul>

		    </div>
		</div>

	    <div class="row">
	    	<div class="col-12 px-0 px-sm-3 mt-3 mb-2">
		    	<select name="" id="">
		    		<option value="">Todos los equipos</option>
		    		<option value="">F.C.Barcelona</option>
		    		<option value="">Real Madrid</option>
		    		<option value="">At. Madrid</option>
		    		<option value="">Valencia</option>
		    	</select>
		    </div>
		</div>

	    <div class="row schedule mb-3">

	    	<div class="col-12 col-lg-6 col-xl-4 px-0 px-sm-3 my-2">
	    		<div class="day">

					<div class="title clearfix">
						<span class="float-left">Jornada 1</span>
						<span class="time-limit float-right"><i class="far fa-calendar-times"></i>25 jun</span>
					</div>

	                <div class="match">
	                    <div class="local">
                    		<div class="participant">
	                    		<span class="team">
		                        	F.C.BARCELONA
	                    		</span>
		                        <span class="gamertag">
		                        	x pAdRoNe x
		                        </span>
                    		</div>
	                    	<figure class="logo">
	                        	<img src="https://as01.epimg.net/img/comunes/fotos/fichas/equipos/medium/3.png" alt="">
	                        </figure>
	                    </div> {{-- local --}}
	                    <div class="result">
	                    	<a href="{{ route('competition.match') }}">
	                        1 - 1
	                        </a>
	                    </div>
	                    <div class="visitor">
	                    	<figure class="logo">
	                        	<img src="https://as01.epimg.net/img/comunes/fotos/fichas/equipos/medium/1.png" alt="">
	                        </figure>
                    		<div class="participant">
	                    		<span class="team">
		                        	REAL MADRID
	                    		</span>
		                        <span class="gamertag">
		                        	ferminnn
		                        </span>
                    		</div>
	                    </div> {{-- visitor --}}
	                </div> {{-- match --}}

	                <div class="match">
	                    <div class="local">
                    		<div class="participant">
	                    		<span class="team">
		                        	VALENCIA
	                    		</span>
		                        <span class="gamertag">
		                        	eckae
		                        </span>
                    		</div>
	                    	<figure class="logo">
	                        	<img src="https://as01.epimg.net/img/comunes/fotos/fichas/equipos/medium/17.png" alt="">
	                        </figure>
	                    </div> {{-- local --}}
	                    <div class="result">
	                    	<a href="{{ route('competition.match') }}">
	                        3 - 2
	                        </a>
	                    </div>
	                    <div class="visitor">
	                    	<figure class="logo">
	                        	<img src="https://as01.epimg.net/img/comunes/fotos/fichas/equipos/medium/42.png" alt="">
	                        </figure>
                    		<div class="participant">
	                    		<span class="team">
		                        	AT.MADRID
	                    		</span>
		                        <span class="gamertag">
		                        	Maxi
		                        </span>
                    		</div>
	                    </div> {{-- visitor --}}
	                </div> {{-- match --}}

		    	</div> {{-- day --}}
		    </div> {{-- col --}}

	    	<div class="col-12 col-lg-6 col-xl-4 px-0 px-sm-3 my-2">
	    		<div class="day">

					<div class="title clearfix">
						<span class="float-left">Jornada 2</span>
						<span class="time-limit float-right"><i class="far fa-calendar-times"></i>25 jun</span>
					</div>

	                <div class="match">
	                    <div class="local">
                    		<div class="participant">
	                    		<span class="team">
		                        	F.C.BARCELONA
	                    		</span>
		                        <span class="gamertag">
		                        	x pAdRoNe x
		                        </span>
                    		</div>
	                    	<figure class="logo">
	                        	<img src="https://as01.epimg.net/img/comunes/fotos/fichas/equipos/medium/3.png" alt="">
	                        </figure>
	                    </div> {{-- local --}}
	                    <div class="result">
	                    	<a href="{{ route('competition.match') }}">
	                        1 - 3
	                        </a>
	                    </div>
	                    <div class="visitor">
	                    	<figure class="logo">
	                        	<img src="https://as01.epimg.net/img/comunes/fotos/fichas/equipos/medium/1.png" alt="">
	                        </figure>
                    		<div class="participant">
	                    		<span class="team">
		                        	REAL MADRID
	                    		</span>
		                        <span class="gamertag">
		                        	ferminnn
		                        </span>
                    		</div>
	                    </div> {{-- visitor --}}
	                </div> {{-- match --}}

	                <div class="match">
	                    <div class="local">
                    		<div class="participant">
	                    		<span class="team">
		                        	VALENCIA
	                    		</span>
		                        <span class="gamertag">
		                        	eckae
		                        </span>
                    		</div>
	                    	<figure class="logo">
	                        	<img src="https://as01.epimg.net/img/comunes/fotos/fichas/equipos/medium/17.png" alt="">
	                        </figure>
	                    </div> {{-- local --}}
	                    <div class="result">
	                    	<a href="{{ route('competition.match') }}">
	                        1 - 4
	                        </a>
	                    </div>
	                    <div class="visitor">
	                    	<figure class="logo">
	                        	<img src="https://as01.epimg.net/img/comunes/fotos/fichas/equipos/medium/42.png" alt="">
	                        </figure>
                    		<div class="participant">
	                    		<span class="team">
		                        	AT.MADRID
	                    		</span>
		                        <span class="gamertag">
		                        	Maxi
		                        </span>
                    		</div>
	                    </div> {{-- visitor --}}
	                </div> {{-- match --}}

		    	</div> {{-- day --}}
		    </div> {{-- col --}}

	    	<div class="col-12 col-lg-6 col-xl-4 px-0 px-sm-3 my-2">
	    		<div class="day">

					<div class="title clearfix">
						<span class="float-left">Jornada 3</span>
						<span class="time-limit float-right"><i class="far fa-calendar-times"></i>25 jun</span>
					</div>

	                <div class="match">
	                    <div class="local">
                    		<div class="participant">
	                    		<span class="team">
		                        	F.C.BARCELONA
	                    		</span>
		                        <span class="gamertag">
		                        	x pAdRoNe x
		                        </span>
                    		</div>
	                    	<figure class="logo">
	                        	<img src="https://as01.epimg.net/img/comunes/fotos/fichas/equipos/medium/3.png" alt="">
	                        </figure>
	                    </div> {{-- local --}}
	                    <div class="result">
	                    	<a href="{{ route('competition.match') }}">
	                        4 - 0
	                        </a>
	                    </div>
	                    <div class="visitor">
	                    	<figure class="logo">
	                        	<img src="https://as01.epimg.net/img/comunes/fotos/fichas/equipos/medium/1.png" alt="">
	                        </figure>
                    		<div class="participant">
	                    		<span class="team">
		                        	REAL MADRID
	                    		</span>
		                        <span class="gamertag">
		                        	ferminnn
		                        </span>
                    		</div>
	                    </div> {{-- visitor --}}
	                </div> {{-- match --}}

	                <div class="match">
	                    <div class="local">
                    		<div class="participant">
	                    		<span class="team">
		                        	VALENCIA
	                    		</span>
		                        <span class="gamertag">
		                        	eckae
		                        </span>
                    		</div>
	                    	<figure class="logo">
	                        	<img src="https://as01.epimg.net/img/comunes/fotos/fichas/equipos/medium/17.png" alt="">
	                        </figure>
	                    </div> {{-- local --}}
	                    <div class="result">
	                    	<a href="{{ route('competition.match') }}">
	                        1 - 0
	                        </a>
	                    </div>
	                    <div class="visitor">
	                    	<figure class="logo">
	                        	<img src="https://as01.epimg.net/img/comunes/fotos/fichas/equipos/medium/42.png" alt="">
	                        </figure>
                    		<div class="participant">
	                    		<span class="team">
		                        	AT.MADRID
	                    		</span>
		                        <span class="gamertag">
		                        	Maxi
		                        </span>
                    		</div>
	                    </div> {{-- visitor --}}
	                </div> {{-- match --}}

		    	</div> {{-- day --}}
		    </div> {{-- col --}}

	    	<div class="col-12 col-lg-6 col-xl-4 px-0 px-sm-3 my-2">
	    		<div class="day">

					<div class="title clearfix">
						<span class="float-left">Jornada 4</span>
						<span class="time-limit float-right"><i class="far fa-calendar-times"></i>25 jun</span>
					</div>

	                <div class="match">
	                    <div class="local">
                    		<div class="participant">
	                    		<span class="team">
		                        	F.C.BARCELONA
	                    		</span>
		                        <span class="gamertag">
		                        	x pAdRoNe x
		                        </span>
                    		</div>
	                    	<figure class="logo">
	                        	<img src="https://as01.epimg.net/img/comunes/fotos/fichas/equipos/medium/3.png" alt="">
	                        </figure>
	                    </div> {{-- local --}}
	                    <div class="result pending">-</div>
	                    <div class="visitor">
	                    	<figure class="logo">
	                        	<img src="https://as01.epimg.net/img/comunes/fotos/fichas/equipos/medium/1.png" alt="">
	                        </figure>
                    		<div class="participant">
	                    		<span class="team">
		                        	REAL MADRID
	                    		</span>
		                        <span class="gamertag">
		                        	ferminnn
		                        </span>
                    		</div>
	                    </div> {{-- visitor --}}
	                </div> {{-- match --}}

	                <div class="match">
	                    <div class="local">
                    		<div class="participant">
	                    		<span class="team">
		                        	VALENCIA
	                    		</span>
		                        <span class="gamertag">
		                        	eckae
		                        </span>
                    		</div>
	                    	<figure class="logo">
	                        	<img src="https://as01.epimg.net/img/comunes/fotos/fichas/equipos/medium/17.png" alt="">
	                        </figure>
	                    </div> {{-- local --}}
	                    <div class="result">
	                    	<a href="{{ route('competition.match') }}">
	                        0 - 0
	                        </a>
	                    </div>
	                    <div class="visitor">
	                    	<figure class="logo">
	                        	<img src="https://as01.epimg.net/img/comunes/fotos/fichas/equipos/medium/42.png" alt="">
	                        </figure>
                    		<div class="participant">
	                    		<span class="team">
		                        	AT.MADRID
	                    		</span>
		                        <span class="gamertag">
		                        	Maxi
		                        </span>
                    		</div>
	                    </div> {{-- visitor --}}
	                </div> {{-- match --}}

		    	</div> {{-- day --}}
		    </div> {{-- col --}}

		</div>  {{-- row schedule --}}
	</div> {{-- container --}}

@endsection
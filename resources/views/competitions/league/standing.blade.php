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
						<li class="nav-item current">
							<a class="nav-link" href="{{ route('competition.league.standing') }}">Clasificación</a>
						</li>
						<li class="nav-item">
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

				<div class="standing mt-3">

					<div class="standing-title">
						<span class="principal">Clasificación</span>
					</div>

					<table class="standing-table table-responsive w-100 d-block d-md-table">
						<thead>
							<tr>
								<th scope="col"></th>
								<th scope="col" class="d-none d-sm-table-cell"></th>
								<th scope="col" width="100%"></th>
								<th scope="col" width="39" class="pts">Pts</th>
								<th scope="col" width="39" class="pj">PJ</th>
								<th scope="col" width="39" class="pg">PG</th>
								<th scope="col" width="39" class="pe">PE</th>
								<th scope="col" width="39" class="pp">PP</th>
								<th scope="col" width="39" class="gf d-none d-md-table-cell">GF</th>
								<th scope="col" width="39" class="gc d-none d-md-table-cell">GC</th>
								<th scope="col" width="39" class="avg d-none d-md-table-cell">+/-</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td class="position green">
									1
								</td>
								<td class="logo d-none d-sm-table-cell">
									<img src="https://as01.epimg.net/img/comunes/fotos/fichas/equipos/medium/3.png" alt="">
								</td>
								<td class="team text-nowrap">
									F.C.BARCELONA
									<span class="gamertag">x pAdRoNe x</span>
								</td>
								<td class="data pts">
									25
								</td>
								<td class="data pj">
									9
								</td>
								<td class="data pg">
									9
								</td>
								<td class="data pe">
									9
								</td>
								<td class="data pp">
									9
								</td>
								<td class="data gf d-none d-md-table-cell">
									9
								</td>
								<td class="data gc d-none d-md-table-cell">
									9
								</td>
								<td class="data avg d-none d-md-table-cell">
									9
								</td>
							</tr>
							<tr>
								<td class="position green">
									2
								</td>
								<td class="logo d-none d-sm-table-cell">
									<img src="https://as01.epimg.net/img/comunes/fotos/fichas/equipos/medium/1.png" alt="">
								</td>
								<td class="team">
									REAL MADRID
									<span class="gamertag">ferminnn</span>
								</td>
								<td class="data pts">
									21
								</td>
								<td class="data pj">
									9
								</td>
								<td class="data pg">
									9
								</td>
								<td class="data pe">
									9
								</td>
								<td class="data pp">
									9
								</td>
								<td class="data gf d-none d-md-table-cell">
									9
								</td>
								<td class="data gc d-none d-md-table-cell">
									9
								</td>
								<td class="data avg d-none d-md-table-cell">
									9
								</td>
							</tr>
							<tr>
								<td class="position red">
									3
								</td>
								<td class="logo d-none d-sm-table-cell">
									<img src="https://as01.epimg.net/img/comunes/fotos/fichas/equipos/medium/42.png" alt="">
								</td>
								<td class="team">
									AT.MADRID
									<span class="gamertag">Maxi</span>
								</td>
								<td class="data pts">
									32
								</td>
								<td class="data pj">
									9
								</td>
								<td class="data pg">
									9
								</td>
								<td class="data pe">
									9
								</td>
								<td class="data pp">
									9
								</td>
								<td class="data gf d-none d-md-table-cell">
									9
								</td>
								<td class="data gc d-none d-md-table-cell">
									9
								</td>
								<td class="data avg d-none d-md-table-cell">
									9
								</td>
							</tr>
							<tr>
								<td class="position red">
									4
								</td>
								<td class="logo d-none d-sm-table-cell">
									<img src="https://as01.epimg.net/img/comunes/fotos/fichas/equipos/medium/17.png" alt="">
								</td>
								<td class="team">
									VALENCIA
									<span class="gamertag">eckae</span>
								</td>
								<td class="data pts">
									4
								</td>
								<td class="data pj">
									9
								</td>
								<td class="data pg">
									9
								</td>
								<td class="data pe">
									9
								</td>
								<td class="data pp">
									9
								</td>
								<td class="data gf d-none d-md-table-cell">
									9
								</td>
								<td class="data gc d-none d-md-table-cell">
									9
								</td>
								<td class="data avg d-none d-md-table-cell">
									9
								</td>
							</tr>

						</tbody>
					</table> {{-- standing-table --}}

				</div> {{-- standing --}}

				<div class="legend mt-2 mb-3">
					<span class="green">Clasificado</span>
					<span class="red">Eliminado</span>

				</div>
			</div>
		</div>
	</div>

@endsection
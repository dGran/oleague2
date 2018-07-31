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
						<li class="nav-item">
							<a class="nav-link" href="{{ route('competition.league.schedule') }}">Calendario</a>
						</li>
						<li class="nav-item current">
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
		</div>

	</div>

@endsection
@extends('layouts.app')

@section('style')
    <link href="{{ asset('css/clubs/clubs.css') }}" rel="stylesheet">
@endsection

@section('content')

	@include('clubs.partials.header')

	<div class="wrapper" style="background: #ffffff">

		<div class="row">
			<div class="col-6">
				<div class="container text-center p-3 border-bottom">
					<h5>Valoración media</h5>
					<div class="single-chart">
						<svg viewBox="0 0 36 36" class="circular-chart orange">
							<path class="circle-bg"
							d="M18 2.0845
							a 15.9155 15.9155 0 0 1 0 31.831
							a 15.9155 15.9155 0 0 1 0 -31.831"
							/>
							<path class="circle"
							stroke-dasharray="{{ $team_avg_overall }}, 100"
							d="M18 2.0845
							a 15.9155 15.9155 0 0 1 0 31.831
							a 15.9155 15.9155 0 0 1 0 -31.831"
							/>
							<text x="18" y="20.35" class="percentage">
								{{ number_format($team_avg_overall, 2) }}
							</text>
						</svg>
					</div>
				</div>
			</div>

			<div class="col-6">
				<div class="container text-center p-3 border-bottom">
					<h5>Edad media</h5>
					<div class="single-chart">
						<svg viewBox="0 0 36 36" class="circular-chart orange">
							<path class="circle-bg"
							d="M18 2.0845
							a 15.9155 15.9155 0 0 1 0 31.831
							a 15.9155 15.9155 0 0 1 0 -31.831"
							/>
							<path class="circle"
							stroke-dasharray="{{ $team_avg_age }}, 100"
							d="M18 2.0845
							a 15.9155 15.9155 0 0 1 0 31.831
							a 15.9155 15.9155 0 0 1 0 -31.831"
							/>
							<text x="18" y="20.35" class="percentage">
								{{ number_format($team_avg_age, 2) }}
							</text>
						</svg>
					</div>
				</div>
			</div>
		</div>


		info del team
		<br>
		economia
		<br>
		<ul>
			<li>presupuesto</li>
			<li>total salarios</li>
			<li>media de salario</li>
			<li>jugador que mas cobra</li>
			<li>jugador que menos cobra</li>
		</ul>
		jugadores <br>
		<ul>
			<li>jugador de mas media</li>
			<li>jugador de menos media</li>
			<li>jugador mas joven</li>
			<li>jugador mas veterano</li>
			<li>media de edad del equipo</li>

		</ul>
		resultados
		<li>forma del equipo</li>

	</div> {{-- wrapper --}}

@endsection

@section('bottom-fixed')
	@include('clubs.partials.bottom_fixed')
@endsection
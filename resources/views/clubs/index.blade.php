@extends('layouts.app')

@section('style')
	<link href="https://fonts.googleapis.com/css?family=Bad+Script|Kaushan+Script&display=swap" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Merienda+One&display=swap" rel="stylesheet">
    <link href="{{ asset('css/home.css') }}" rel="stylesheet">
@endsection

@section('content')


	<div style="overflow: hidden;margin-top: 54px;
    background: rgba(22,28,51,1);
background: -moz-linear-gradient(top, rgba(22,28,51,1) 0%, rgba(64,88,158,1) 100%);
background: -webkit-gradient(left top, left bottom, color-stop(0%, rgba(22,28,51,1)), color-stop(100%, rgba(64,88,158,1)));
background: -webkit-linear-gradient(top, rgba(22,28,51,1) 0%, rgba(64,88,158,1) 100%);
background: -o-linear-gradient(top, rgba(22,28,51,1) 0%, rgba(64,88,158,1) 100%);
background: -ms-linear-gradient(top, rgba(22,28,51,1) 0%, rgba(64,88,158,1) 100%);
background: linear-gradient(to bottom, rgba(22,28,51,1) 0%, rgba(64,88,158,1) 100%);
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#161c33', endColorstr='#40589e', GradientType=0 );">
    	<div class="container py-2">
    		<div class="d-table-cell align-top">
    			<img src="{{ $participant->logo() }}" alt="" width="70">
    		</div>
    		<div class="d-table-cell pl-2 align-middle">
	    		<h3 class="m-0 text-white">
	    			{{ $participant->name() }}
	    		</h3>
	    		<span class="d-block text-white" style="font-family: 'Merienda One', cursive; font-weight: bold; font-size: .8em;">
	    			{{ $participant->sub_name() }}
	    		</span>

    		</div>

    	</div>


	</div>

	<div style="border-top: 1px solid #32467d; padding-top: 5px; background: rgba(64,88,158,1);
background: -moz-linear-gradient(top, rgba(64,88,158,1) 0%, rgba(22,28,51,1) 100%);
background: -webkit-gradient(left top, left bottom, color-stop(0%, rgba(64,88,158,1)), color-stop(100%, rgba(22,28,51,1)));
background: -webkit-linear-gradient(top, rgba(64,88,158,1) 0%, rgba(22,28,51,1) 100%);
background: -o-linear-gradient(top, rgba(64,88,158,1) 0%, rgba(22,28,51,1) 100%);
background: -ms-linear-gradient(top, rgba(64,88,158,1) 0%, rgba(22,28,51,1) 100%);
background: linear-gradient(to bottom, rgba(64,88,158,1) 0%, rgba(22,28,51,1) 100%);
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#40589e', endColorstr='#161c33', GradientType=0 );">
		<div class="container">
				<ul class="puff-in-tl" style="list-style: none; color: #fff; margin:0; padding: 0">
					<li class="p-1 d-inline-block text-center" style="min-width:55px">
						<a href="{{ route('club', $participant->team->slug) }}">
						<div>
							<img src="{{ asset('img/clubs/stadium.png') }}" alt="" width="32px">
						</div>
						<span style="font-size: .7em; text-transform: uppercase;">
							Club
						</span>
						</a>
					</li>
					<li class="p-1 d-inline-block text-center" style="min-width:55px">
						<a href="{{ route('club.roster', $participant->team->slug) }}">
						<div>
							<img src="{{ asset('img/clubs/roster.png') }}" alt="" width="32px">
						</div>
						<span style="font-size: .7em; text-transform: uppercase;">
							Plantilla
						</span>
						</a>
					</li>
					<li class="p-1 d-inline-block text-center" style="min-width:55px">
						<div>
							<img src="{{ asset('img/clubs/economy.png') }}" alt="" width="32px">
						</div>
						<span style="font-size: .7em; text-transform: uppercase;">
							Economía
						</span>
					</li>
					<li class="p-1 d-inline-block text-center" style="min-width:55px">
						<div>
							<img src="{{ asset('img/clubs/matchs.png') }}" alt="" width="32px">
						</div>
						<span style="font-size: .7em; text-transform: uppercase;">
							Resultados
						</span>
					</li>
					<li class="p-1 d-inline-block text-center" style="min-width:55px">
						<div>
							<img src="{{ asset('img/microphone.png') }}" alt="" width="32px">
						</div>
						<span style="font-size: .7em; text-transform: uppercase;">
							Prensa
						</span>
					</li>
				</ul>

		</div>

	</div>

	<div class="wrapper" style="background: #ffffff">



	<div class="container py-3">

		<div class="row">
			<div class="col-6">
				<h5>Media del equipo</h5>
				<div class="flex-wrapper">
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
				      <text x="18" y="20.35" class="percentage">{{ number_format($team_avg_overall, 2) }}</text>
				    </svg>
				  </div>
				</div>

			</div>

			<div class="col-6">
				<h5>Edad del equipo</h5>
				<div class="flex-wrapper">
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
				      <text x="18" y="20.35" class="percentage">{{ number_format($team_avg_age, 2) }}</text>
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


		</div>
	</div>


<div style="padding: .5rem 1rem; font-family: 'Bad Script', cursive; font-weight: bold; font-size: .9em; color: #fff; border-bottom: 1px solid #292C5E">
	Home - <a href="{{route('clubs')}}">Clubs</a>
</div>
@endsection

@section('bottom-fixed')
	<div class="bottom-fixed">
		<div class="scrolling-wrapper">
			@foreach ($participants as $participant)
				<div class="card participants">
					<a href="{{route('club', $participant->team->slug) }}">
						<img src="{{ $participant->logo() }}" alt="">
						<span>{{ $participant->name() }}</span>
					</a>
				</div>
			@endforeach
		</div>
		{{-- <a href="" class="text-white d-block p-2" style="font-size: 1.15em">REGISTRATE</a> --}}
	</div>
@endsection
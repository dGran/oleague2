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

	<div class="wrapper" style="background: #f2f2f2">


	    <div class="animated bounceInLeft" style="">
	    	@if ($participant->players->count() > 0)

	    		<h4 class="p-2 m-0" style="background: #DBDBDB">
	    			<div class="container clearfix">
	    				<span class="float-left">Porteros</span>
	    				<img src="{{ asset('img/clubs/pt.png') }}" alt="" height="24" class="float-right">
	    			</div>
	    		</h4>
    			<div class="container">
    				<div class="row" style="padding-bottom: 15px">
						@foreach ($participant->players as $player)
							@if ($player->player->position == 'PT')
								<div class="col-6 col-md-4 col-lg-3 col-xl-2">
									<div class="player-card border" style="background: #fff; margin: 15px 5px 0 5px; position: relative">
										<figure class="text-center d-block m-0">
											<img src="{{ $player->player->getImgFormatted() }}" alt="" width="96">
										</figure>
										<img src="{{ asset($player->player->getBall()) }}" alt="" width="28" style="position: absolute; right: 6px; top: 6px">
										<span style="position: absolute; top: 28px; left: 6px; font-size: .9em; font-weight: bold">
											{{ $player->player->overall_rating }}
										</span>
										<span style="position: absolute; top: 6px; left: 6px; font-size: 1.2em; line-height: 18px; font-weight: bold; border-bottom: 2px solid {{ $player->player->getPositionColor() }}">
											{{ $player->player->position }}
										</span>
										<div class="border-top text-center" style="line-height: 18px; background: #EAEAEA">
											<span style="font-size: .75em; font-weight: bold">
												{{ $player->player->name }}
											</span>
										</div>
										<div class="border-top text-center" style="padding: .2em; line-height: 14px; background: #FDFDFD">
											<span style="display: block; font-size: .7em">
												{{ $player->player->nation_name }}
											</span>
											<span style="display: block; font-size: .7em">
												{{ $player->player->age }} años - {{ $player->player->height }} cm
											</span>
										</div>
									</div>
								</div>
							@endif
						@endforeach
					</div>
				</div>

	    		<h4 class="p-2 m-0" style="background: #DBDBDB">
	    			<div class="container clearfix">
	    				<span class="float-left">Defensas</span>
	    				<img src="{{ asset('img/clubs/ct.png') }}" alt="" height="24" class="float-right">
	    			</div>
	    		</h4>
    			<div class="container">
    				<div class="row" style="padding-bottom: 15px">
						@foreach ($participant->players as $player)
							@if ($player->player->position == 'CT' || $player->player->position == 'LD' || $player->player->position == 'LI')
								<div class="col-6 col-md-4 col-lg-3 col-xl-2">
									<div class="player-card border" style="background: #fff; margin: 15px 5px 0 5px; position: relative">
										<figure class="text-center d-block m-0">
											<img src="{{ $player->player->getImgFormatted() }}" alt="" width="96">
										</figure>
										<img src="{{ asset($player->player->getBall()) }}" alt="" width="28" style="position: absolute; right: 6px; top: 6px">
										<span style="position: absolute; top: 28px; left: 6px; font-size: .9em; font-weight: bold">
											{{ $player->player->overall_rating }}
										</span>
										<span style="position: absolute; top: 6px; left: 6px; font-size: 1.2em; line-height: 18px; font-weight: bold; border-bottom: 2px solid {{ $player->player->getPositionColor() }}">
											{{ $player->player->position }}
										</span>
										<div class="border-top text-center" style="line-height: 18px; background: #EAEAEA">
											<span style="font-size: .75em; font-weight: bold">
												{{ $player->player->name }}
											</span>
										</div>
										<div class="border-top text-center" style="padding: .2em; line-height: 14px; background: #FDFDFD">
											<span style="display: block; font-size: .7em">
												{{ $player->player->nation_name }}
											</span>
											<span style="display: block; font-size: .7em">
												{{ $player->player->age }} años - {{ $player->player->height }} cm
											</span>
										</div>
									</div>
								</div>
							@endif
						@endforeach
					</div>
				</div>

	    		<h4 class="p-2 m-0" style="background: #DBDBDB">
	    			<div class="container clearfix">
	    				<span class="float-left">Medios</span>
	    				<img src="{{ asset('img/clubs/mc.png') }}" alt="" height="24" class="float-right">
	    			</div>
	    		</h4>
    			<div class="container">
    				<div class="row" style="padding-bottom: 15px">
						@foreach ($participant->players as $player)
							@if ($player->player->position == 'MCD' || $player->player->position == 'MC' || $player->player->position == 'MP' || $player->player->position == 'II' || $player->player->position == 'ID')
								<div class="col-6 col-md-4 col-lg-3 col-xl-2">
									<div class="player-card border" style="background: #fff; margin: 15px 5px 0 5px; position: relative">
										<figure class="text-center d-block m-0">
											<img src="{{ $player->player->getImgFormatted() }}" alt="" width="96">
										</figure>
										<img src="{{ asset($player->player->getBall()) }}" alt="" width="28" style="position: absolute; right: 6px; top: 6px">
										<span style="position: absolute; top: 28px; left: 6px; font-size: .9em; font-weight: bold">
											{{ $player->player->overall_rating }}
										</span>
										<span style="position: absolute; top: 6px; left: 6px; font-size: 1.2em; line-height: 18px; font-weight: bold; border-bottom: 2px solid {{ $player->player->getPositionColor() }}">
											{{ $player->player->position }}
										</span>
										<div class="border-top text-center" style="line-height: 18px; background: #EAEAEA">
											<span style="font-size: .75em; font-weight: bold">
												{{ $player->player->name }}
											</span>
										</div>
										<div class="border-top text-center" style="padding: .2em; line-height: 14px; background: #FDFDFD">
											<span style="display: block; font-size: .7em">
												{{ $player->player->nation_name }}
											</span>
											<span style="display: block; font-size: .7em">
												{{ $player->player->age }} años - {{ $player->player->height }} cm
											</span>
										</div>
									</div>
								</div>
							@endif
						@endforeach
					</div>
				</div>

	    		<h4 class="p-2 m-0" style="background: #DBDBDB">
	    			<div class="container clearfix">
	    				<span class="float-left">Delanteros</span>
	    				<img src="{{ asset('img/clubs/dc.png') }}" alt="" height="24" class="float-right">
	    			</div>
	    		</h4>
    			<div class="container">
    				<div class="row" style="padding-bottom: 15px">
						@foreach ($participant->players as $player)
							@if ($player->player->position == 'DC' || $player->player->position == 'SD' || $player->player->position == 'EI' || $player->player->position == 'ED')
								<div class="col-6 col-md-4 col-lg-3 col-xl-2">
									<div class="player-card border" style="background: #fff; margin: 15px 5px 0 5px; position: relative">
										<figure class="text-center d-block m-0">
											<img src="{{ $player->player->getImgFormatted() }}" alt="" width="96">
										</figure>
										<img src="{{ asset($player->player->getBall()) }}" alt="" width="28" style="position: absolute; right: 6px; top: 6px">
										<span style="position: absolute; top: 28px; left: 6px; font-size: .9em; font-weight: bold">
											{{ $player->player->overall_rating }}
										</span>
										<span style="position: absolute; top: 6px; left: 6px; font-size: 1.2em; line-height: 18px; font-weight: bold; border-bottom: 2px solid {{ $player->player->getPositionColor() }}">
											{{ $player->player->position }}
										</span>
										<div class="border-top text-center" style="line-height: 18px; background: #EAEAEA">
											<span style="font-size: .75em; font-weight: bold">
												{{ $player->player->name }}
											</span>
										</div>
										<div class="border-top text-center" style="padding: .2em; line-height: 14px; background: #FDFDFD">
											<span style="display: block; font-size: .7em">
												{{ $player->player->nation_name }}
											</span>
											<span style="display: block; font-size: .7em">
												{{ $player->player->age }} años - {{ $player->player->height }} cm
											</span>
										</div>
									</div>
								</div>
							@endif
						@endforeach
					</div>
				</div>

			@else
				<div class="p-3 text-center">
					<h5>Plantilla sin jugadores</h5>
					<img src="{{ asset('img/clubs/empty.png') }}" alt="" width="128">
				</div>
			@endif
	    </div>


		<h4 class="p-2 m-0" style="background: #DBDBDB">
			<div class="container clearfix">
				<span class="float-left">Total: {{ $participant->players->count() }} jugadores</span>
				<img src="{{ $participant->logo() }}" alt="" height="24" class="float-right">
			</div>
		</h4>

</div>


	@if ($participant->players->count() > 0)

		<div class="wrapper" style="background: #f2f2f2">
			<div class="container p-3 border-bottom">
				<h5>Mejores jugadores</h5>
				@foreach ($top_players as $top_player)
				<div style="padding: 2px 8px 0 8px">
					<div class="table-cell d-inline-block">
						<img src="{{ $top_player->player->getImgFormatted() }}" alt="" width="32" class="rounded-circle border bg-white" style="background: #f9f9f9;">
					</div>
					<div class="table-cell d-inline-block ml-2" style="min-width: 20px; max-width: 20px">
						<span class="d-block text-center">
							{{ $top_player->player->overall_rating }}
						</span>
					</div>
					<div class="table-cell d-inline-block ml-2">
						<img src="{{ asset($top_player->player->getBall()) }}" alt="" width="20">
					</div>
					<div class="table-cell d-inline-block ml-2 text-center" style="min-width: 29px; max-width: 29px">
						<span class="d-block">
							{{ $top_player->player->position }}
						</span>
					</div>

					<div class="table-cell d-inline-block ml-2">
						<span class="d-block">
							{{ $top_player->player->name }}
						</span>
					</div>
				</div>
				@endforeach
			</div>

			<div class="container p-3 border-bottom">
				<h5>Mejores delanteros</h5>
				@foreach ($top_forws as $top_forw)
				<div style="padding: 2px 8px 0 8px">
					<div class="table-cell d-inline-block">
						<img src="{{ $top_forw->player->getImgFormatted() }}" alt="" width="32" class="rounded-circle border bg-white" style="background: #f9f9f9;">
					</div>
					<div class="table-cell d-inline-block ml-2" style="min-width: 20px; max-width: 20px">
						<span class="d-block text-center">
							{{ $top_forw->player->overall_rating }}
						</span>
					</div>
					<div class="table-cell d-inline-block ml-2">
						<img src="{{ asset($top_forw->player->getBall()) }}" alt="" width="20">
					</div>
					<div class="table-cell d-inline-block ml-2 text-center" style="min-width: 29px; max-width: 29px">
						<span class="d-block">
							{{ $top_forw->player->position }}
						</span>
					</div>

					<div class="table-cell d-inline-block ml-2">
						<span class="d-block">
							{{ $top_forw->player->name }}
						</span>
					</div>
				</div>
				@endforeach
			</div>

			<div class="container p-3 border-bottom">
				<h5>Mejores medios</h5>
				@foreach ($top_mids as $top_mid)
				<div style="padding: 2px 8px 0 8px">
					<div class="table-cell d-inline-block">
						<img src="{{ $top_mid->player->getImgFormatted() }}" alt="" width="32" class="rounded-circle border bg-white" style="background: #f9f9f9;">
					</div>
					<div class="table-cell d-inline-block ml-2" style="min-width: 20px; max-width: 20px">
						<span class="d-block text-center">
							{{ $top_mid->player->overall_rating }}
						</span>
					</div>
					<div class="table-cell d-inline-block ml-2">
						<img src="{{ asset($top_mid->player->getBall()) }}" alt="" width="20">
					</div>
					<div class="table-cell d-inline-block ml-2 text-center" style="min-width: 29px; max-width: 29px">
						<span class="d-block">
							{{ $top_mid->player->position }}
						</span>
					</div>

					<div class="table-cell d-inline-block ml-2">
						<span class="d-block">
							{{ $top_mid->player->name }}
						</span>
					</div>
				</div>
				@endforeach
			</div>

			<div class="container p-3 border-bottom">
				<h5>Mejores defensas</h5>
				@foreach ($top_defs as $top_def)
				<div style="padding: 2px 8px 0 8px">
					<div class="table-cell d-inline-block">
						<img src="{{ $top_def->player->getImgFormatted() }}" alt="" width="32" class="rounded-circle border bg-white" style="background: #f9f9f9;">
					</div>
					<div class="table-cell d-inline-block ml-2" style="min-width: 20px; max-width: 20px">
						<span class="d-block text-center">
							{{ $top_def->player->overall_rating }}
						</span>
					</div>
					<div class="table-cell d-inline-block ml-2">
						<img src="{{ asset($top_def->player->getBall()) }}" alt="" width="20">
					</div>
					<div class="table-cell d-inline-block ml-2 text-center" style="min-width: 29px; max-width: 29px">
						<span class="d-block">
							{{ $top_def->player->position }}
						</span>
					</div>

					<div class="table-cell d-inline-block ml-2">
						<span class="d-block">
							{{ $top_def->player->name }}
						</span>
					</div>
				</div>
				@endforeach
			</div>

			<div class="container p-3 border-bottom">
				<h5>Jugadores más jóvenes</h5>
				@foreach ($young_players as $young_player)
				<div style="padding: 2px 8px 0 8px">
					<div class="table-cell d-inline-block">
						<img src="{{ $young_player->player->getImgFormatted() }}" alt="" width="32" class="rounded-circle border bg-white" style="background: #f9f9f9;">
					</div>
					<div class="table-cell d-inline-block ml-2" style="min-width: 52px; max-width: 52px">
						<span class="d-block text-center">
							{{ $young_player->player->age }} años
						</span>
					</div>
					<div class="table-cell d-inline-block ml-2 text-center" style="min-width: 29px; max-width: 29px">
						<span class="d-block">
							{{ $young_player->player->position }}
						</span>
					</div>

					<div class="table-cell d-inline-block ml-2">
						<span class="d-block">
							{{ $young_player->player->name }}
						</span>
					</div>
				</div>
				@endforeach
			</div>

			<div class="container p-3 border-bottom">
				<h5>Jugadores más veteranos</h5>
				@foreach ($veteran_players as $veteran_player)
				<div style="padding: 2px 8px 0 8px">
					<div class="table-cell d-inline-block">
						<img src="{{ $veteran_player->player->getImgFormatted() }}" alt="" width="32" class="rounded-circle border bg-white" style="background: #f9f9f9;">
					</div>
					<div class="table-cell d-inline-block ml-2" style="min-width: 52px; max-width: 52px">
						<span class="d-block text-center">
							{{ $veteran_player->player->age }} años
						</span>
					</div>
					<div class="table-cell d-inline-block ml-2 text-center" style="min-width: 29px; max-width: 29px">
						<span class="d-block">
							{{ $veteran_player->player->position }}
						</span>
					</div>

					<div class="table-cell d-inline-block ml-2">
						<span class="d-block">
							{{ $veteran_player->player->name }}
						</span>
					</div>
				</div>
				@endforeach
			</div>

		</div>
	@endif

<div style=" padding: .25rem 0; font-family: 'Bad Script', cursive; font-weight: bold; font-size: .9em; color: #00d4e4;">
		<div class="container">
			<a href="{{route('home')}}">Homne</a> - <a href="{{route('clubs')}}">Clubs</a> - <span class=''>Ajax</span>

		</div>
</div>

@endsection

@section('bottom-fixed')
	<div class="bottom-fixed">
		<div class="container">
			<div class="scrolling-wrapper">
				@foreach ($participants as $participant)
					<div class="card participants" style="max-width: 48px; min-width: 48px; background: rgba(255, 255, 255, .15); ">
						<a href="{{route('club.roster', $participant->team->slug) }}">
							<img src="{{ $participant->logo() }}" alt="" style="" width="32">
							<span style="font-size: .6em; text-transform: uppercase;       white-space: nowrap;
      text-overflow: ellipsis;
      overflow: hidden;">{{ $participant->name() }}</span>
						</a>
					</div>
				@endforeach
			</div>
		</div>
		{{-- <a href="" class="text-white d-block p-2" style="font-size: 1.15em">REGISTRATE</a> --}}
	</div>
@endsection
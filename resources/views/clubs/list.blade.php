@extends('layouts.app')

@section('style')
	<link href="https://fonts.googleapis.com/css?family=Bad+Script|Kaushan+Script&display=swap" rel="stylesheet">
    <link href="{{ asset('css/home.css') }}" rel="stylesheet">
@endsection

@section('content')

<div class="wrapper" style="background: #f2f2f2">

	<div style="min-height: 104px; overflow: hidden;
    background: url(img/bg_mv2nd.png) no-repeat 0 0 #161c33;
    background-position: left center;
    background-size: 70% auto; margin-top: 54px">
    	<div class="container py-3">
    		<div class="d-table-cell align-middle">
    			<img src="{{ asset('img/team_no_image.png') }}" alt="" height="72">
    		</div>
    		<div class="d-table-cell pl-2 align-middle">
	    		<h3 class="m-0 text-white">
	    			Clubs
	    		</h3>
	    		<span class="d-block text-white">
	    			Temporada 7
	    		</span>
    		</div>
    	</div>
	</div>

<div class="container">
    <div class="row" style="padding-bottom: 15px">
		@foreach ($participants as $participant)
			<div class="col-12 col-md-6 col-lg-4">
				<div class="club-card border" style="background: #fff; margin: 15px 5px 0 5px; padding: 1em 0">
					<div class="text-center d-table-cell" style="width: 170px">
						<img src="{{ $participant->logo() }}" alt="" width="72px">
						<span class="d-block" style="font-size: .9em; font-weight: bold">{{ $participant->name() }}</span>
						<span class="d-block" style="font-size: .8em;">{{ $participant->sub_name() }}</span>
					</div>
					<div class="d-table-cell border-left align-top ">
						<ul style="font-size: .9em">
							<li>
								<a href="{{route('club', $participant->team->slug) }}">
									Portada
								</a>
							</li>
							<li>Plantilla</li>
							<li>Economía</li>
							<li>Sala de Prensa</li>
						</ul>
					</div>
				</div>
			</div>
		@endforeach
    </div>

	<div class="p-3">
	@foreach ($participants as $participant)
		<div class="">
			{{ $participant->name() }}
		</div>
		<div class="progress mb-2" style="height: 20px;">
			<div class="progress-bar text-left p-2" role="progressbar" style="width: {{$participant->budget()/500*100}}%;" aria-valuenow="{{$participant->budget()}}" aria-valuemin="0" aria-valuemax="500">
				{{ $participant->budget() }} mill.
			</div>
		</div>
	@endforeach
	</div>

</div>

</div>

<div style="padding: .5rem 1rem; margin-top: 54px; font-family: 'Bad Script', cursive; font-weight: bold; font-size: .9em; color: #fff; border-bottom: 1px solid #292C5E">
	Home - Competiciones - Champions League - Grupo A
</div>
@endsection
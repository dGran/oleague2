@extends('layouts.app')

@section('style')
    <link href="{{ asset('css/clubs/clubs.css') }}" rel="stylesheet">
@endsection

@section('content')

<div class="club-header">
	<div class="container py-2">
		<div class="d-table-cell align-top">
			{{-- <img src="{{ $participant->logo() }}" alt=""> --}}
		</div>
		<div class="d-table-cell pl-2 align-middle">
    		<h3>
    			{{-- {{ $participant->name() }} --}}
    			Clubs
    		</h3>
    		<span class="subname">
    			{{-- {{ $participant->sub_name() }} --}}
    			Temporada 7
    		</span>
		</div>
	</div>
</div>

<div class="club-menu">
	<div class="container">
		{{-- @include('clubs.partials.menu') --}}
	</div>
</div>

<div class="wrapper" style="background: #f2f2f2">

<div class="container">
    <div class="row" style="padding-bottom: 15px">
		@foreach ($participants as $participant)
			<div class="col-12 col-md-6 col-lg-4">
				<div class="club-card border" style="background: #fff; margin: 15px 5px 0 5px; padding: 1em 0">
					<div class="text-center d-table-cell" style="width: 170px">
						<a class="text-dark" href="{{route('club', $participant->team->slug) }}">
							<img src="{{ $participant->logo() }}" alt="" width="72px">
							<span class="d-block" style="font-size: .9em; font-weight: bold">{{ $participant->name() }}</span>
							<span class="d-block" style="font-size: .8em;">{{ $participant->sub_name() }}</span>
						</a>
					</div>
					<div class="d-table-cell border-left align-top ">
						<ul style="font-size: .9em; padding: 0 1em; list-style: none">
							<li>
								<a class="text-dark" href="{{route('club', $participant->team->slug) }}">
									<i class="fas fa-caret-right mr-1" style="color: #89be38"></i>
									Club
								</a>
							</li>
							<li>
								<a class="text-dark" href="{{route('club.roster', $participant->team->slug) }}">
									<i class="fas fa-caret-right mr-1" style="color: #89be38"></i>
									Plantilla
								</a>
							</li>
							<li>
								<a class="text-dark" href="{{route('club.economy', $participant->team->slug) }}">
									<i class="fas fa-caret-right mr-1" style="color: #89be38"></i>
									Economía
								</a>
							</li>
							<li>
								<a class="text-dark" href="{{route('club.calendar', $participant->team->slug) }}">
									<i class="fas fa-caret-right mr-1" style="color: #89be38"></i>
									Calendario
								</a>
							</li>
							<li>
								<a class="text-dark" href="{{route('club.press', $participant->team->slug) }}">
									<i class="fas fa-caret-right mr-1" style="color: #89be38"></i>
									Prensa
								</a>
							</li>
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
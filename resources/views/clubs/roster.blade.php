@extends('layouts.app')

@section('style')
    <link href="{{ asset('css/clubs/clubs.css') }}" rel="stylesheet">
@endsection

@section('content')

	@include('clubs.partials.header')

	<div class="wrapper">
    	@if ($participant->players->count() > 0)
			@include('clubs.roster.roster_data')
		@else
			<div class="p-3 text-center">
				<img src="{{ asset('img/clubs/empty.png') }}" alt="" width="128">
				<h5>Plantilla sin jugadores</h5>
			</div>
		@endif
	</div>

@endsection

@section('breadcrumb')
	@include('clubs.club.breadcrumb')
@endsection

@section('bottom-fixed')
	@include('clubs.partials.bottom_fixed')
@endsection
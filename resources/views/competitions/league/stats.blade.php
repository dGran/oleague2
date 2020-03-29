@extends('layouts.app')

@section('style')
    <link href="{{ asset('css/competition/competition.css') }}" rel="stylesheet">
@endsection

@section('content')

	@include('competitions.partials.header')

	<div class="wrapper" style="background: #f9f9f9">
		@include('competitions.league.stats.content')
	</div> {{-- wrapper --}}
@endsection

@section('breadcrumb')
	@include('competitions.league.stats.breadcrumb')
@endsection

@section('bottom-fixed')
	@include('competitions.partials.bottom_fixed')
@endsection

@section('js')
    @include('competitions.league.stats.javascript')
@endsection
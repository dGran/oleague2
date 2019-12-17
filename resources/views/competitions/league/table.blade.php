@extends('layouts.app')

@section('style')
    <link href="{{ asset('css/competition/competition.css') }}" rel="stylesheet">
@endsection

@section('content')

	@include('competitions.partials.header')

	<div class="wrapper" style="background: #f9f9f9">
		@include('competitions.league.table.content')
	</div> {{-- wrapper --}}
@endsection

@section('breadcrumb')
	@include('competitions.league.table.breadcrumb')
@endsection

@section('bottom-fixed')
	@include('competitions.partials.bottom_fixed')
@endsection
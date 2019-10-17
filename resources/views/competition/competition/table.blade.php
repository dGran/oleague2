@extends('layouts.app')

@section('style')
    <link href="{{ asset('css/competition/competition.css') }}" rel="stylesheet">
@endsection

@section('content')

	@include('competition.partials.header')

	<div class="wrapper" style="background: #fff">
		@include('competition.competition.table.content')
	</div> {{-- wrapper --}}
@endsection

@section('breadcrumb')
	@include('competition.competition.table.breadcrumb')
@endsection
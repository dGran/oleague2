@extends('layouts.app')

@section('style')
    <link href="{{ asset('css/competition/competition.css') }}" rel="stylesheet">
@endsection

@section('content')

	@include('competition.partials.header')

	<div class="wrapper" style="background: #f9f9f9">
		@include('competition.competition.calendar.content')
	</div> {{-- wrapper --}}
@endsection

@section('breadcrumb')
	@include('competition.competition.calendar.breadcrumb')
@endsection

@section('bottom-fixed')
	@include('competition.partials.bottom_fixed')
@endsection

@section('modal')
    @include('competition.competition.calendar.update_modal')
@endsection

@section('js')
    @include('competition.competition.calendar.javascript')
@endsection
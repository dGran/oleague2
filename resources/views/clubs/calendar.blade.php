@extends('layouts.app')

@section('style')
    <link href="{{ asset('css/clubs/clubs.css') }}" rel="stylesheet">
@endsection

@section('content')

	@include('clubs.partials.header')

	<div class="wrapper" style="background: #f9f9f9">
		@include('clubs.calendar.data')
	</div>

@endsection

@section('breadcrumb')
	@include('clubs.club.breadcrumb')
@endsection

@section('modal')
    @include('competitions.league.calendar.match_details_modal')
@endsection

@section('bottom-fixed')
	@include('clubs.partials.bottom_fixed')
@endsection

@section('js')
    @include('clubs.calendar.javascript')
@endsection
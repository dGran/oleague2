@extends('layouts.app')

@section('style')
    <link href="{{ asset('css/clubs/clubs.css') }}" rel="stylesheet">
@endsection

@section('content')

	@include('clubs.partials.header')

	<div class="wrapper">
		@include('clubs.club.manager')
		@include('clubs.club.economy')
		@include('clubs.club.roster')
		@include('clubs.club.results')
	</div> {{-- wrapper --}}

	@include('clubs.club.breadcrumb')

@endsection

@section('bottom-fixed')
	@include('clubs.partials.bottom_fixed')
@endsection
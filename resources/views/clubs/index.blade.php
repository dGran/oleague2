@extends('layouts.app')

@section('style')
    <link href="{{ asset('css/clubs/clubs.css') }}" rel="stylesheet">
@endsection

@section('content')
	@include('clubs.partials.header')

	<div class="wrapper">
		<div class="container">
			<div class="row">
				<div class="col-12 col-md-6">
					@include('clubs.club.manager')
				</div>
				<div class="col-12 col-md-6">
					@include('clubs.club.economy')
				</div>
			</div>
			@include('clubs.club.roster')
		</div>
		@include('clubs.club.results')
	</div> {{-- wrapper --}}
@endsection

@section('breadcrumb')
	@include('clubs.club.breadcrumb')
@endsection

@section('bottom-fixed')
	@include('clubs.partials.bottom_fixed')
@endsection
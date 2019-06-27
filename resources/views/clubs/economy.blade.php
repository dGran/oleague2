@extends('layouts.app')

@section('style')
    <link href="{{ asset('css/clubs/clubs.css') }}" rel="stylesheet">
@endsection

@section('content')

	@include('clubs.partials.header')

	<div class="wrapper">
		<div class="container">
			<h4 class="p-3">Economia</h4>
		</div>
	</div>

@endsection

@section('bottom-fixed')
	@include('clubs.partials.bottom_fixed')
@endsection
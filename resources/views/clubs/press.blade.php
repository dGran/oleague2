@extends('layouts.app')

@section('style')
    <link href="{{ asset('css/clubs/clubs.css') }}" rel="stylesheet">
@endsection

@section('content')

	@include('clubs.partials.header')

	<div class="wrapper">
		<div class="container">
			<h4 class="p-3">Sala de prensa</h4>
		</div>
		@include('clubs.press.data')
	</div>

@endsection

@section('breadcrumb')
	@include('clubs.press.breadcrumb')
@endsection

@section('bottom-fixed')
	@include('clubs.partials.bottom_fixed')
@endsection

@section('js')
	@include('clubs.press.javascript')
@endsection
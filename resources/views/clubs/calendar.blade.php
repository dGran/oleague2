@extends('layouts.app')

@section('style')
    <link href="{{ asset('css/clubs/clubs.css') }}" rel="stylesheet">
@endsection

@section('content')

	@include('clubs.partials.header')

	<div class="wrapper">
		<h4 class="title-position border-bottom">
			<div class="container clearfix">
				<span>Resultados</span>
			</div>
		</h4>
		<div class="container p-3">
			Próximamente...
		</div>
	</div>

@endsection

@section('breadcrumb')
	@include('clubs.club.breadcrumb')
@endsection

@section('bottom-fixed')
	@include('clubs.partials.bottom_fixed')
@endsection
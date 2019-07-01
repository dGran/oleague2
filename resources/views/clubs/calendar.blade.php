@extends('layouts.app')

@section('style')
    <link href="{{ asset('css/clubs/clubs.css') }}" rel="stylesheet">
@endsection

@section('content')

	@include('clubs.partials.header')

	<div class="wrapper">
		<div class="container">
			<h4 class="p-3">Resultados</h4>
		</div>
	</div>

	Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eius vel tempore, porro nihil iure delectus amet numquam mollitia rem quisquam odio quas fugit maxime aliquid minima esse est perferendis repellendus?

	@include('clubs.calendar.breadcrumb')

@endsection

@section('bottom-fixed')
	@include('clubs.partials.bottom_fixed')
@endsection
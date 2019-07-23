@extends('layouts.app')

@section('style')
    <link href="{{ asset('css/market/market.css') }}" rel="stylesheet">
@endsection

@section('content')
	@include('market.partials.header')

	<div class="wrapper">
		<div class="container">
			@include('market.index.content')
		</div>
	</div> {{-- wrapper --}}
@endsection

@section('breadcrumb')
	@include('market.index.breadcrumb')
@endsection

@section('bottom-fixed')
	{{-- @include('rules.partials.bottom_fixed') --}}
@endsection
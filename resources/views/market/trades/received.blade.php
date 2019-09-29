@extends('layouts.app')

@section('style')
    <link href="{{ asset('css/market/market.css') }}" rel="stylesheet">
@endsection

@section('content')
	@include('market.partials.header')

	<div class="wrapper">
		@include('market.trades.received.content')
	</div> {{-- wrapper --}}
@endsection

@section('breadcrumb')
	@include('market.trades.received.breadcrumb')
@endsection

@section('js')
    @include('market.trades.received.javascript')
@endsection
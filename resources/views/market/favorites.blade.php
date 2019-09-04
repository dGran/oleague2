@extends('layouts.app')

@section('style')
    <link href="{{ asset('css/market/market.css') }}" rel="stylesheet">
@endsection

@section('content')
	@include('market.partials.header')

	<div class="wrapper">
		@include('market.favorites.content')
	</div> {{-- wrapper --}}
@endsection

@section('breadcrumb')
	@include('market.favorites.breadcrumb')
@endsection

@section('modal')
	@include('market.favorites.filters_modal')
    @include('general_modals.player_view_modal')
@endsection

@section('js')
	@include('market.partials.market_functions')
    @include('market.favorites.javascript')
@endsection
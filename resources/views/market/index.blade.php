@extends('layouts.app')

@section('style')
    <link href="{{ asset('css/market/market.css') }}" rel="stylesheet">
@endsection

@section('content')
	@include('market.partials.header')

	<div class="wrapper">
		@include('market.index.content')
	</div> {{-- wrapper --}}
@endsection

@section('breadcrumb')
	@include('market.index.breadcrumb')
@endsection

@section('modal')
    @include('general_modals.player_view_modal')
@endsection

@section('js')
	@include('market.partials.market_functions')
    @include('market.index.javascript')
@endsection
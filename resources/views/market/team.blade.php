@extends('layouts.app')

@section('style')
    <link href="{{ asset('css/market/market.css') }}" rel="stylesheet">
@endsection

@section('content')
	@include('market.partials.header')

	<div class="wrapper">
		@include('market.team.content')
	</div> {{-- wrapper --}}
@endsection

@section('breadcrumb')
	@include('market.team.breadcrumb')
@endsection

@section('bottom-fixed')
	@include('market.team.bottom_fixed')
@endsection

@section('modal')
    @include('general_modals.player_view_modal')
@endsection

@section('js')
	@include('market.partials.market_functions')
    @include('market.team.javascript')
@endsection
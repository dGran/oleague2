@extends('layouts.app')

@section('style')
    <link href="{{ asset('css/market/market.css') }}" rel="stylesheet">
@endsection

@section('content')
	@include('market.partials.header')

	<div class="wrapper">
		@include('market.trades.content')
	</div> {{-- wrapper --}}
@endsection

@section('breadcrumb')
	@include('market.trades.breadcrumb')
@endsection

@section('modal')
    @include('general_modals.player_view_modal')
@endsection

@section('js')
    @include('market.trades.javascript')
@endsection
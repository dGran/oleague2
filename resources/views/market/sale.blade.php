@extends('layouts.app')

@section('style')
    <link href="{{ asset('css/market/market.css') }}" rel="stylesheet">
@endsection

@section('content')
	@include('market.partials.header')

	<div class="wrapper">
		@include('market.sale.content')
	</div> {{-- wrapper --}}
@endsection

@section('breadcrumb')
	@include('market.sale.breadcrumb')
@endsection

@section('bottom-fixed')
	{{-- @include('rules.partials.bottom_fixed') --}}
@endsection

@section('modal')
	@include('market.sale.filters_modal')
    @include('general_modals.player_view_modal')
@endsection

@section('js')
    @include('market.sale.javascript')
@endsection
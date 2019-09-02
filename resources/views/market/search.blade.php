@extends('layouts.app')

@section('style')
    <link href="{{ asset('css/market/market.css') }}" rel="stylesheet">
@endsection

@section('content')
	@include('market.partials.header')

	<div class="wrapper">
		@include('market.search.content')
	</div> {{-- wrapper --}}
@endsection

@section('breadcrumb')
	@include('market.search.breadcrumb')
@endsection

@section('bottom-fixed')
	{{-- @include('market.search.bottom_fixed') --}}
@endsection

@section('modal')
	@include('market.search.filters_modal')
    @include('general_modals.player_view_modal')
@endsection

@section('js')
    @include('market.search.javascript')
@endsection
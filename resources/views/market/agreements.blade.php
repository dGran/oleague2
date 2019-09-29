@extends('layouts.app')

@section('style')
    <link href="{{ asset('css/market/market.css') }}" rel="stylesheet">
@endsection

@section('content')
	@include('market.partials.header')

	<div class="wrapper">
		@include('market.agreements.content')
	</div> {{-- wrapper --}}
@endsection

@section('breadcrumb')
	@include('market.agreements.breadcrumb')
@endsection

@section('js')
    @include('market.agreements.javascript')
@endsection
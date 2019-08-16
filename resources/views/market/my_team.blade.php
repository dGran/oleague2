@extends('layouts.app')

@section('style')
    <link href="{{ asset('css/market/market.css') }}" rel="stylesheet">
@endsection

@section('content')
	@include('market.partials.header')

	<div class="wrapper">
		<div class="container p-0">
			@include('market.my_team.content')
		</div>
	</div> {{-- wrapper --}}
@endsection

@section('breadcrumb')
	@include('market.my_team.breadcrumb')
@endsection

@section('bottom-fixed')
	{{-- @include('rules.partials.bottom_fixed') --}}
@endsection

@section('modal')
	@include('market.my_team.edit_modal')
    @include('market.my_team.view_modal')
@endsection

@section('js')
    @include('market.my_team.javascript')
@endsection
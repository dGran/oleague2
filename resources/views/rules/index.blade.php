@extends('layouts.app')

@section('style')
    <link href="{{ asset('css/clubs/clubs.css') }}" rel="stylesheet">
@endsection

@section('content')
	@include('rules.header')

	<div class="wrapper">
		<div class="container">
			<div class="row">
				<div class="col-12 py-3">
					@include('rules.content')
				</div>
			</div>
		</div>
	</div> {{-- wrapper --}}
@endsection

@section('breadcrumb')
	@include('rules.breadcrumb')
@endsection

@section('bottom-fixed')
	{{-- @include('rules.partials.bottom_fixed') --}}
@endsection
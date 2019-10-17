@extends('layouts.app')

@section('style')
    <link href="{{ asset('css/competition/competition.css') }}" rel="stylesheet">
@endsection

@section('content')
	<div class="competition-header">
		<div class="container">
			<div class="logo">
				<i class="icon-trophy"></i>
			</div>
			<div class="title">
	    		<h3>
	    			Competiciones
	    		</h3>
	    		<span class="subtitle">
	    			{{ active_season()->name }}
	    		</span>
			</div>
		</div>
	</div>

	<div class="wrapper">
		@include('competition.competitions.content')
	</div> {{-- wrapper --}}
@endsection

@section('breadcrumb')
	@include('competition.competitions.breadcrumb')
@endsection
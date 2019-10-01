@extends('layouts.app')

@section('style')
    <link href="{{ asset('css/clubs/clubs.css') }}" rel="stylesheet">
@endsection

@section('content')
	<div class="club-header">
		<div class="container">
			<div class="d-table-cell align-top">
				<i class="icon-clubs"></i>
			</div>
			<div class="d-table-cell pl-3 align-middle">
	    		<h3>
	    			Clubs
	    		</h3>
	    		<span class="subname">
	    			{{ active_season()->name }}
	    		</span>
			</div>
		</div>
	</div>

	<div class="wrapper" style="background: #f9f9f9">
		@include('clubs.index.data')
	</div> {{-- wrapper --}}
@endsection

@section('breadcrumb')
	@include('clubs.index.breadcrumb')
@endsection
@extends('layouts.app')

@section('style')
    <link href="{{ asset('css/clubs/clubs.css') }}" rel="stylesheet">
@endsection

@section('content')
	@include('users.profile.header')

	<div class="wrapper">
		<div class="container">
			<div class="row">
				<div class="col-12">
					@include('users.profile.content')
				</div>
			</div>
		</div>
	</div>
@endsection

@section('breadcrumb')
	@include('users.profile.breadcrumb')
@endsection

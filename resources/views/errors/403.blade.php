@extends('layouts.app')

@section('content')
	<div class="bg-white" style="margin-top: 55px">
		<div class="container">
		    <div class="error-page p-3">
		        <h2 class="headline text-info mb-3 text-underline">
		        	403
		        </h2>
		        <div class="error-content">
		            <h3>
		            	<i class="fas fa-exclamation-triangle text-warning"></i> {{ $exception->getMessage() }}
		            </h3>
{{-- 		            <p class="my-3">
		            </p> --}}
	                <div class="my-4">
	                	<a class="btn btn-primary" href="{{ route('home') }}">Volver al inicio</a>
	                </div>
		        </div>
		    </div>
	    </div>
    </div>
@endsection
{{-- <div class="container"> --}}
	{{-- <div class="row py-1"> --}}
		<div class="col-12 col-md-6 ">
			<div class="shadow-sm p-3 bg-white rounded m-1">
				<div class="clearfix">
					@if ($round->round_trip) {{-- round_trip --}}
						<small class="text-info text-uppercase d-block mb-2">
							@if ($match->order == 1)
								Partido de ida
							@else
								Partido de vuelta
							@endif
						</small>
					@endif
					<div class="img d-inline-block mr-2 align-top float-left">
						<img src="{{ $match->local_participant->participant->logo() }}" alt="" width="30">
					</div>
					<div class="name d-inline-block float-left" style="width: 160px">
				        <div class="text-uppercase {{ $match->sanctioned_id && $match->local_id == $match->sanctioned_id ? 'text-danger' : '' }}" style="font-size: .9em">
				        	{{ $match->local_participant->participant->name() == 'undefined' ? '' : $match->local_participant->participant->name() }}
				        </div>
				    	<small class="{{ $match->sanctioned_id && $match->local_id == $match->sanctioned_id ? 'text-danger' : 'text-black-50' }} d-block" style="font-size: .7em">
				            @if ($match->local_participant->participant->sub_name() == 'undefined')
				                <span class="badge badge-danger p-1 mt-1">SIN USUARIO</span>
				            @else
				                {{ $match->local_participant->participant->sub_name() }}
				            @endif
				        </small>
					</div>
					<div class="result d-inline-block align-top float-right" style="font-size: .9em">
						{{ $match->local_score }}
					</div>
				</div>
				<div class="clearfix">
					<div class="img d-inline-block mr-2 align-top float-left">
						<img src="{{ $match->visitor_participant->participant->logo() }}" alt="" width="30">
					</div>
					<div class="name d-inline-block float-left" style="width: 160px">
				        <div class="text-uppercase {{ $match->sanctioned_id && $match->visitor_id == $match->sanctioned_id ? 'text-danger' : '' }}" style="font-size: .9em">
				        	{{ $match->visitor_participant->participant->name() == 'undefined' ? '' : $match->visitor_participant->participant->name() }}
				        </div>
				    	<small class="{{ $match->sanctioned_id && $match->visitor_id == $match->sanctioned_id ? 'text-danger' : 'text-black-50' }} d-block" style="font-size: .7em">
				            @if ($match->visitor_participant->participant->sub_name() == 'undefined')
				                <span class="badge badge-danger p-1 mt-1">SIN USUARIO</span>
				            @else
				                {{ $match->visitor_participant->participant->sub_name() }}
				            @endif
				        </small>
					</div>
					<div class="result d-inline-block align-top float-right" style="font-size: .9em">
						{{ $match->visitor_score }}
					</div>
				</div>
			</div>

		</div>
{{-- </div> --}}



{{-- <div class="row" data-id="{{ $match->id }}" data-name="{{ $match->local_participant->participant->name() . ' ' . $match->local_score . '-' . $match->visitor_score . ' ' . $match->visitor_participant->participant->name() }}">
	<div class="col-6 local text-right">
		<div class="img float-right ml-2">
        	<img src="{{ $match->local_participant->participant->logo() }}" alt="" width="30">
        </div>
		<div class="name float-right">
	        <div class="text-uppercase {{ $match->sanctioned_id && $match->local_id == $match->sanctioned_id ? 'text-danger' : '' }} text-truncate" style="max-width: 105px; font-size: .8em">
	        	{{ $match->local_participant->participant->name() == 'undefined' ? '' : $match->local_participant->participant->name() }}
	        </div>
	    	<small class="{{ $match->sanctioned_id && $match->local_id == $match->sanctioned_id ? 'text-danger' : 'text-black-50' }} d-block" style="font-size: .65em">
	            @if ($match->local_participant->participant->sub_name() == 'undefined')
	                <span class="badge badge-danger p-1 mt-1">SIN USUARIO</span>
	            @else
	                {{ $match->local_participant->participant->sub_name() }}
	            @endif
	        </small>

		</div>
	</div>
	<div class="col-6 visitor">
		<div class="img float-left mr-2">
        	<img src="{{ $match->visitor_participant->participant->logo() }}" alt="" width="30">
        </div>
		<div class="name float-left">
	        <div class="text-uppercase {{ $match->sanctioned_id && $match->visitor_id == $match->sanctioned_id ? 'text-danger' : '' }} text-truncate" style="max-width: 105px; font-size: .8em">
	        	{{ $match->visitor_participant->participant->name() == 'undefined' ? '' : $match->visitor_participant->participant->name() }}
	        </div>
	    	<small class="{{ $match->sanctioned_id && $match->visitor_id == $match->sanctioned_id ? 'text-danger' : 'text-black-50' }} d-block" style="font-size: .65em">
	            @if ($match->visitor_participant->participant->sub_name() == 'undefined')
	                <span class="badge badge-danger p-1 mt-1">SIN USUARIO</span>
	            @else
	                {{ $match->visitor_participant->participant->sub_name() }}
	            @endif
	        </small>

		</div>
	</div> --}}

<div class="modal-content">
    <div class="modal-header bg-light">
        <h4 class="m-0">Historial de economía</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

    <div class="modal-body">
    	<div class="pb-3">
	    	<img src="{{ $participant->logo() }}" alt="" width="72" class="p-1 border">
	    	<div class="d-inline-block ml-1">
		    	<span>
		    		{{ $participant->name() == 'undefined' ? '' : $participant->name() }}
		    	</span>
			    <small class="text-black-50 d-block">
			        @if ($participant->sub_name() == 'undefined')
			            <span class="badge badge-danger p-1 mt-1">SIN USUARIO</span>
			        @else
			            {{ $participant->sub_name() }}
			        @endif
			    </small>
		    </div>
		</div>
    	<table>
	        <colgroup>
	            <col width="0%" />
	            <col width="0%" />
	            <col width="100%"/>
	            <col width="0%" />
	        </colgroup>
	        <thead>
	            <tr>
					<th scope="col" class="p-1">Fecha</th>
					<th scope="col" class="text-center pl-3 pr-3">E/S</th>
					<th scope="col">Descripción</th>
					<th scope="col" class="text-right">Cantidad</th>
				</tr>
	        </thead>

	        <tbody>
	    	@foreach ($participant->cash_history as $cash_history)
	    		<tr class="border-top">
	    			<td class="p-1">
                        <small class="text-nowrap">{{ \Carbon\Carbon::parse($cash_history->created_at)->format('d/m/Y')}} - {{ \Carbon\Carbon::parse($cash_history->created_at)->format('H:m')}}</small>
                        {{-- <small></small> --}}
	    			</td>
					<td class="text-center">
						@if ($cash_history->movement == "E")
							<i class="fas fa-piggy-bank text-success"></i>
						@else
							<i class="fas fa-piggy-bank text-danger"></i>
						@endif
					</td>
					<td>{{ $cash_history->description }}</td>
					<td class="text-right">
						@if ($cash_history->movement == "S")
						-
						@endif
						{{ $cash_history->amount }}
					</td>
	    		</tr>
	    	@endforeach
	    		<tr>
	    			<td colspan="4" class="pt-2 border-top text-right">
	    				<h4 class="pt-2">
	    					Presupuesto:
	    					{{ $participant->budget_formatted() }}
	    				</h4>
	    			</td>
	    		</tr>
	    	</tbody>
    	</table>
    </div>
</div>
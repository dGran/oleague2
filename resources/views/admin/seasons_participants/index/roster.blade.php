<div class="modal-content">
    <div class="modal-header bg-light">
    	<h4 class="m-0">Plantilla</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

	<div class="d-table">
		<div class="d-table-cell pl-2 pr-2 pt-2">
    		<img src="{{ $participant->logo() }}" alt="" width="60">
		</div>
    	<div class="d-table-cell w-100 pt-2 pr-2 align-middle">
	    	<span>
	    		{{ $participant->name() == 'undefined' ? '' : $participant->name() }}
	    	</span>
		    <small class="text-black-50 d-block">
		        @if ($participant->sub_name() == 'undefined')
		            <span class="badge badge-danger p-1 mt-1">SIN USUARIO</span>
		        @else
		            <strong>Manager: </strong>{{ $participant->sub_name() }}
		        @endif
		    </small>
	    </div>
	</div>

    <div class="modal-body">
    	<table style="font-size: .9em">
	        <colgroup>
	        	<col width="0%" />
	        	<col width="0%" />
	            <col width="100%"/>
	            <col width="0%" />
	            <col width="0%" />
	        </colgroup>
	        <thead>
	            <tr>
	            	<th scope="col" class="text-right pt-1 pb-1">#</th>
					<th scope="col" colspan="2" class="pl-2">Jugador</th>
					<th scope="col" class="text-center pl-2">Media</th>
					<th scope="col" class="text-center pl-2">Pos.</th>
					<th scope="col" class="pl-2 text-right">Salario</th>
				</tr>
	        </thead>
	        <tbody>
	    	@foreach ($participant->players->sortByDesc('player.overall_rating') as $player)
	    		<tr class="border-top">
	    			<td class="text-right">
	    				{{ $loop->index +1 }}
	    			</td>
	    			<td class="pt-1 pb-1 pl-2">
	    				<img src="{{ $player->player->getImgFormatted() }}" alt="" width="38">
	    			</td>
	    			<td class="pl-2">
	    				{{ $player->player->name }}
	    				<small class="text-black-50 d-block">{{ $player->player->nation_name }}</small>
	    			</td>
					<td class="text-center pl-2">
						{{ $player->player->overall_rating }}
					</td>
					<td class="text-center pl-2">
						{{ $player->player->position }}
					</td>
					<td class="text-right">
						{{ $player->salary }} M
					</td>
	    		</tr>
	    	@endforeach
	    	</tbody>
    	</table>
    </div>
    <div class="modal-footer bg-light">
		<h5 class="text-right">
			Total Salarios: {{ $participant->salaries_formatted() }}
		</h5>
    </div>
</div>
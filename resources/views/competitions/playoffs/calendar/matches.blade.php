<tr class="matches" data-id="{{ $match->id }}" data-name="{{ $match->local_participant->participant->name() . ' ' . $match->local_score . '-' . $match->visitor_score . ' ' . $match->visitor_participant->participant->name() }}">
    <td class="local text-right text-truncate" style="max-width: 95px;">
        <span class="text-uppercase {{ $match->sanctioned_id && $match->local_id == $match->sanctioned_id ? 'text-danger' : '' }}">{{ $match->local_participant->participant->name() == 'undefined' ? '' : $match->local_participant->participant->name() }}
        </span>
    	<small class="{{ $match->sanctioned_id && $match->local_id == $match->sanctioned_id ? 'text-danger' : 'text-black-50' }} d-block">
            @if ($match->local_participant->participant->sub_name() == 'undefined')
                <span class="badge badge-danger p-1 mt-1">SIN USUARIO</span>
            @else
                {{ $match->local_participant->participant->sub_name() }}
            @endif
        </small>
    </td>
    <td class="img text-right" width="32">
        <img src="{{ $match->local_participant->participant->logo() }}" alt="">
    </td>
    <td class="score text-center" width="70">
    	@if (is_null($match->local_score) && is_null($match->visitor_score))
			@if (!auth()->guest() && (user_is_participant(auth()->user()->id) && (participant_of_user()->id == $match->local_participant->participant->id || participant_of_user()->id == $match->visitor_participant->participant->id)))
        		<a href="" data-toggle="modal" data-target="#updateModal">
	        		<small class="bg-primary rounded px-2 py-1 text-white">
	        			EDITAR
	        		</small>
        		</a>
    		@else
    		Vs
    		@endif
    	@else
    		@if ($match->sanctioned_id)
				<span class="result rounded px-2 py-1 text-white bg-danger" data-toggle="tooltip" data-placement="top" title="{{ $match->sanctioned_participant->participant->name() }} sancionado">
					{{ $match->local_score }} - {{ $match->visitor_score }}
				</span>
    		@else
				<span class="result rounded px-2 py-1 {{ $match->sanctioned_id ? 'text-white bg-danger' : '' }}">
					{{ $match->local_score }} - {{ $match->visitor_score }}
				</span>
    		@endif
    	@endif
    </td>
    <td class="img text-left" width="32">
        <img src="{{ $match->visitor_participant->participant->logo() }}" alt="">
    </td>
    <td class="visitor text-left text-truncate" style="max-width: 95px;">
        <span class="text-uppercase {{ $match->sanctioned_id && $match->visitor_id == $match->sanctioned_id ? 'text-danger' : '' }}">{{ $match->visitor_participant->participant->name() == 'undefined' ? '' : $match->visitor_participant->participant->name() }}
        </span>
        <small class="{{ $match->sanctioned_id && $match->visitor_id == $match->sanctioned_id ? 'text-danger' : 'text-black-50' }} d-block">
            @if ($match->visitor_participant->participant->sub_name() == 'undefined')
                <span class="badge badge-danger p-1 mt-1">SIN USUARIO</span>
            @else
                {{ $match->visitor_participant->participant->sub_name() }}
            @endif
        </small>
    </td>
</tr>
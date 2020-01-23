<div class="club-info">
	<h4 class="title-position">
		<div class="container clearfix">
			<span>Ultimos resultados</span>
		</div>
	</h4>

	@if ($participant->last_results())
		<div class="container pb-3">
			<table>
			@foreach ($participant->last_results() as $match)
					<tr>
						<td colspan=9 class="px-2 pt-2">
							<small class="text-muted">{{ $match->match_name() }}</small>
						</td>
					</tr>
			    	<tr class="matches" data-id="{{ $match->id }}" data-name="{{ $match->local_participant->participant->name() . ' ' . $match->local_score . '-' . $match->visitor_score . ' ' . $match->visitor_participant->participant->name() }}">
				        <td class="text-right px-2">
                            <span class="text-uppercase d-block">
                            	{{ $match->local_participant->participant->name() == 'undefined' ? '' : $match->local_participant->participant->name() }}
                            </span>
                            @if (($match->sanctioned_id) && ($match->local_id == $match->sanctioned_id))
                            	<i class="fas fa-exclamation ml-1 text-danger"></i>
                            @endif
                            <small class="text-black-50 d-block">
                                @if ($match->local_participant->participant->sub_name() == 'undefined')
                                    <span class="badge badge-danger p-1 mt-1">SIN USUARIO</span>
                                @else
                                    {{ $match->local_participant->participant->sub_name() }}
                                @endif
                            </small>
				        </td>
                        <td class="img text-right" width="32">
                            <img src="{{ $match->local_participant->participant->logo() }}" alt="" width="24">
                        </td>
				        <td class="score text-center" width="50">
							<span class="px-2 py-1 {{ $match->sanctioned_id ? 'border text-danger' : '' }}">
								{{ $match->local_score }} - {{ $match->visitor_score }}
							</span>
				        </td>
                        <td class="img text-left" width="32">
                            <img src="{{ $match->visitor_participant->participant->logo() }}" alt="" width="24">
                        </td>
				        <td class="text-left">
                            @if (($match->sanctioned_id) && ($match->visitor_id == $match->sanctioned_id))
                            	<i class="fas fa-exclamation mr-1 text-danger"></i>
                            @endif
							<span class="text-uppercase d-block">
								{{ $match->visitor_participant->participant->name() == 'undefined' ? '' : $match->visitor_participant->participant->name() }}
							</span>
                            <small class="text-black-50 d-block">
                                @if ($match->visitor_participant->participant->sub_name() == 'undefined')
                                    <span class="badge badge-danger p-1 mt-1">SIN USUARIO</span>
                                @else
                                    {{ $match->visitor_participant->participant->sub_name() }}
                                @endif
                            </small>
				        </td>
			        </tr>


			@endforeach
			</table>
		</div>
	@endif
</div>
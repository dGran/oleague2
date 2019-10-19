<div class="container">
	<div class="row justify-content-center">
		<div class="col-12 col-md-10 col-lg-8 px-0 py-0 py-md-4">
			@if ($league->days->count() == 0)
			    <div class="text-center py-4">
		            <figure>
		                <img src="{{ asset('img/table-empty.png') }}" alt="" width="72">
		            </figure>
		            Actualmente no existen partidos
			    </div>
			@else
			    <table class="calendar">
					@foreach ($league->days as $day)
						<tr class="days">
							<td colspan="6" class="px-3 px-md-0 py-2">
								<strong class="text-uppercase">Jornada {{ $day->order }}</strong>
							</td>
						</tr>
					    @foreach ($day->matches as $match)
					    	<tr class="matches" data-id="{{ $match->id }}" data-name="{{ $match->local_participant->participant->name() . ' ' . $match->local_score . '-' . $match->visitor_score . ' ' . $match->visitor_participant->participant->name() }}">
						        <td class="local text-right text-truncate" style="max-width: 95px;">
		                            <span class="text-uppercase {{ $match->sanctioned_id && $match->local_id == $match->sanctioned_id ? 'text-danger' : '' }}">{{ $match->local_participant->participant->name() == 'undefined' ? '' : $match->local_participant->participant->name() }}</span>
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
		                            <img src="{{ $match->local_participant->participant->logo() }}" alt="">
		                        </td>
						        <td class="score text-center" width="70">
						        	@if (is_null($match->local_score) && is_null($match->visitor_score))
					        			@if (!auth()->guest() && user_is_participant(auth()->user()->id) && (participant_of_user()->id == $match->local_participant->participant->id || participant_of_user()->id == $match->visitor_participant->participant->id))
							        		<a href="{{ route('home') }}" data-toggle="modal" data-target="#updateModal">
								        		<small class="bg-primary rounded px-2 py-1 text-white">
								        			EDITAR
								        		</small>
							        		</a>
						        		@else
						        		Vs
						        		@endif
						        	@else
										<span class="result rounded px-2 py-1 {{ $match->sanctioned_id ? 'border text-danger' : '' }}">
											{{ $match->local_score }} - {{ $match->visitor_score }}
										</span>
						        	@endif
						        </td>
		                        <td class="img text-left" width="32">
		                            <img src="{{ $match->visitor_participant->participant->logo() }}" alt="">
		                        </td>
						        <td class="visitor text-left text-truncate" style="max-width: 95px;">
		                            @if (($match->sanctioned_id) && ($match->visitor_id == $match->sanctioned_id))
		                            	<i class="fas fa-exclamation mr-1 text-danger"></i>
		                            @endif
		                            <span class="text-uppercase {{ $match->sanctioned_id && $match->visitor_id == $match->sanctioned_id ? 'text-danger' : '' }}">{{ $match->visitor_participant->participant->name() == 'undefined' ? '' : $match->visitor_participant->participant->name() }}</span>
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
					@endforeach
			    </table>

			@endif

		</div>
	</div>
</div>
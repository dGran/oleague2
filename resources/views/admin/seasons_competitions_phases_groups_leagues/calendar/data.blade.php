<div class="table-form-content px-3 py-1 bg-light col-12 animated fadeIn">
	<form
	    id="frmGenerate"
	    lang="{{ app()->getLocale() }}"
	    role="form"
	    method="POST"
	    action="{{ route('admin.season_competitions_phases_groups_leagues.calendar.generate', [$group->phase->competition->slug, $group->phase->slug, $group->slug]) }}"
	    enctype="multipart/form-data"
	    data-toggle="validator"
	    autocomplete="off">
	    {{ csrf_field() }}

		<div class="form-group row pt-2">
			<div class="col-12">
			    <div class="custom-control custom-checkbox">
			        <input type="checkbox" class="custom-control-input" id="second_round" name="second_round">
			        <label class="custom-control-label" for="second_round">Partidos de ida y vuelta</label>
			    </div>
			    <div class="custom-control custom-checkbox">
			        <input type="checkbox" class="custom-control-input" id="inverse_order" name="inverse_order" disabled>
			        <label class="custom-control-label text-muted" id="lbinverse_order" for="inverse_order">Orden inverso para la segunda vuelta</label>
			    </div>
			</div>
		</div>

		<div class="form-group row">
			<div class="col-12">
				<a id="btnGenerate" href="" onclick="generate()" class="btn btn-primary border border-primary">
		    		<i class="fas fa-magic mr-2"></i>
		    		Generar calendario
				</a>
		    </div>
		</div>

	</form>
</div>

<div class="table-form-content col-12 animated fadeIn mt-3 p-0 border-0">

	@if ($league->days->count() == 0)
	    <div class="text-center border-top py-4">
            <figure>
                <img src="{{ asset('img/table-empty.png') }}" alt="" width="72">
            </figure>
            Actualmente no existen partidos
	    </div>
	@else
	    <table class="calendar">
	        <colgroup>
	        	<col width="35%" />
	        	<col width="0%" />
	        	<col width="30%" />
	        	<col width="0%" />
	            <col width="35%" />
	        </colgroup>
			@foreach ($league->days as $day)
				<tr class="days border">
					<td colspan="6">
						<strong class="text-uppercase">Jornada {{ $day->order }}</strong>
					</td>
				</tr>
			    @foreach ($day->matches as $match)
			    	<tr class="matches" data-id="{{ $match->id }}" data-name="{{ $match->local_participant->participant->name() . ' ' . $match->local_score . '-' . $match->visitor_score . ' ' . $match->visitor_participant->participant->name() }}">
				        <td class="text-right">
                            <span class="name text-uppercase">{{ $match->local_participant->participant->name() == 'undefined' ? '' : $match->local_participant->participant->name() }}</span>
                            <small class="text-black-50 d-block">
                                @if ($match->local_participant->participant->sub_name() == 'undefined')
                                    <span class="badge badge-danger p-1 mt-1">SIN USUARIO</span>
                                @else
                                    {{ $match->local_participant->participant->sub_name() }}
                                @endif
                            </small>
				        </td>
                        <td class="img text-right">
                            <img src="{{ $match->local_participant->participant->logo() }}" alt="">
                        </td>
				        <td class="score text-center">
				        	@if (is_null($match->local_score) && is_null($match->visitor_score))
				        		<a href="" data-toggle="modal" data-target="#updateModal">
					        		<small class="bg-primary rounded px-3 py-1 text-white">
					        			EDITAR
					        		</small>
				        		</a>
				        	@else
								<span class="bg-light rounded px-3 py-1">
									{{ $match->local_score }} - {{ $match->visitor_score }}
								</span>
								<a href="{{ route('admin.season_competitions_phases_groups_leagues.reset_match', [$group->phase->competition->slug, $group->phase->slug, $group->slug, $match->id]) }}" class="btnReset">
									<i class="fas fa-undo-alt ml-1"></i>
								</a>
				        	@endif
				        </td>
                        <td class="img text-left">
                            <img src="{{ $match->visitor_participant->participant->logo() }}" alt="">
                        </td>
				        <td class="text-left">
                            <span class="name text-uppercase">{{ $match->visitor_participant->participant->name() == 'undefined' ? '' : $match->visitor_participant->participant->name() }}</span>
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
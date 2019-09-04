<div class="modal fade" id="filtersModal" tabindex="-1" role="dialog" aria-labelledby="filtersModallLongTitle" aria-hidden="true">
    <div id="modal-dialog-filters" class="modal-dialog" role="document">
		<div class="modal-content">

		    <div class="modal-header primary">
		    	<h4>Filtros</h4>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		            <span aria-hidden="true">&times;</span>
		        </button>
		    </div>

		    <div class="modal-body">
				<form class="frmFilter" role="search" method="get" action="{{ route('market.favorites') }}">

					<input class="search-input form-control mousetrap filterName d-none" name="filterName" type="text" placeholder="Buscar..." value="{{ $filterName ? $filterName : '' }}" autocomplete="off">

					<div class="d-block mb-2">
					    <div class="pretty p-switch p-fill">
					        <input type="checkbox" name="filterHideFree" id="filterHideFree" {{ $filterHideFree ? 'checked' : '' }} />
					        <div class="state p-success">
					            <label for="filterHideFree" style="padding: .025rem 0;">Ocultar libres</label>
					        </div>
					    </div>
				    </div>

					<div class="d-block mb-2">
					    <div class="pretty p-switch p-fill">
					        <input type="checkbox" name="filterHideClausePaid" id="filterHideClausePaid" {{ $filterHideClausePaid ? 'checked' : '' }} />
					        <div class="state p-success">
					            <label for="filterHideClausePaid" style="padding: .025rem 0;">Ocultar claúsulas pagadas</label>
					        </div>
					    </div>
				    </div>

					<div class="d-block mb-2">
					    <div class="pretty p-switch p-fill">
					        <input type="checkbox" name="filterHideParticipantClauseLimit" id="filterHideParticipantClauseLimit" {{ $filterHideParticipantClauseLimit ? 'checked' : '' }} />
					        <div class="state p-success">
					            <label for="filterHideParticipantClauseLimit" style="padding: .025rem 0;">Ocultar límite de claúsulas</label>
					        </div>
					    </div>
				    </div>

					@if (!auth()->guest() && user_is_participant(auth()->user()->id))
						<div class="d-block mb-2">
						    <div class="pretty p-switch p-fill">
						        <input type="checkbox" name="filterShowClausesCanPay" id="filterShowClausesCanPay" {{ $filterShowClausesCanPay ? 'checked' : '' }} />
						        <div class="state p-success">
						            <label for="filterShowClausesCanPay" style="padding: .025rem 0;">Claúsulas que puedo pagar</label>
						        </div>
						    </div>
					    </div>
					@endif

			        <div class="form-group row">
			            <div class="col-12">
			                <label for="filterParticipant" class="col-form-label">Equipo</label>
			                <select name="filterParticipant" id="filterParticipant" class="form-control selectpicker show-tick filterParticipant" data-size="5">
			                    <option value="">Todos los equipos</option>
                        		<option {{ $filterParticipant == 0 ? 'selected' : '' }} data-content="<img class='mr-2' src='{{ asset('img/team_no_image.png') }}' width='20'><span>Agentes libres</span>" value="0">Agentes libres</option>
			                    @foreach ($participants as $participant)
			                        @if ($participant->id == $filterParticipant)
		                            	<option selected data-content="<img class='mr-2' src='{{ $participant->logo() }}' width='20'><span>{{ $participant->name() }}</span><small class='text-muted'>{{ $participant->sub_name() }}</small>" value="{{ $participant->id }}">{{ $participant->name() }}</option>
			                        @else
		                            	<option data-content="<img class='mr-2' src='{{ $participant->logo() }}' width='20'><span>{{ $participant->name() }}</span><small class='text-muted'>{{ $participant->sub_name() }}</small>" value="{{ $participant->id }}">{{ $participant->name() }}</option>
			                        @endif
			                    @endforeach
			                </select>
			            </div> {{-- col --}}
		           	</div>

				    <div class="form-group row">
			            <div class="col-12">
			                <label for="filterNation" class="col-form-label">Nacionalidad</label>
			                <select name="filterNation" id="filterNation" class="form-control selectpicker show-tick filterNation" data-size="5" data-live-search="true">
			                    <option value="">Todas las nacionalidades</option>
			                    @foreach ($nations as $nation)
			                            <option {{ $nation->nation_name == $filterNation ? 'selected' : '' }} value="{{ $nation->nation_name }}">{{ $nation->nation_name }}</option>
			                    @endforeach
			                </select>
			            </div> {{-- col --}}
			        </div> {{-- row --}}

				    <div class="form-group row">
			            <div class="col-12">
			                <label for="filterPosition" class="col-form-label">Posición</label>
			                <select name="filterPosition" id="filterPosition" class="form-control selectpicker show-tick filterPosition" data-size="5">
			                    <option value="">Todas las posiciones</option>
			                    @foreach ($positions as $position)
			                            <option {{ $position->position == $filterPosition ? 'selected' : '' }} value="{{ $position->position }}">{{ $position->position }}</option>
			                    @endforeach
			                </select>
			            </div> {{-- col --}}
			        </div> {{-- row --}}

				    <div class="form-group row">
			            <div class="col-12">
			                <label for="filterOriginalTeam" class="col-form-label">*Equipo original</label>
			                <select name="filterOriginalTeam" id="filterOriginalTeam" class="form-control selectpicker show-tick filterOriginalTeam" data-size="5" data-live-search="true">
			                    <option value="">Todos los equipos</option>
			                    @foreach ($original_teams as $team)
			                            <option {{ $team->team_name == $filterOriginalTeam ? 'selected' : '' }} value="{{ $team->team_name }}">{{ $team->team_name }}</option>
			                    @endforeach
			                </select>
			            </div> {{-- col --}}
			        </div> {{-- row --}}

				    <div class="form-group row">
			            <div class="col-12">
			                <label for="filterOriginalLeague" class="col-form-label">*Liga original</label>
			                <select name="filterOriginalLeague" id="filterOriginalLeague" class="form-control selectpicker show-tick filterOriginalLeague" data-size="5" data-live-search="true">
			                    <option value="">Todas las ligas</option>
			                    @foreach ($original_leagues as $league)
			                            <option {{ $league->league_name == $filterOriginalLeague ? 'selected' : '' }} value="{{ $league->league_name }}">{{ $league->league_name }}</option>
			                    @endforeach
			                </select>
			            </div> {{-- col --}}
			        </div> {{-- row --}}

				    <div class="form-group row">
			            <div class="col-12">
							<label for="overall_range" class="col-form-label d-block">Valoración general</label>
							<input type="text" class="js-range-slider" name="overall_range" id="overall_range" value="" />
							<div class="text-center pt-2">
								<a class="d-inline p-2" onclick="setBallOverallRange(0,69)">
									<img src="{{ asset('img/white_ball.png') }}" class="align-top" width="24">
								</a>
								<a class="d-inline p-2" onclick="setBallOverallRange(70,74)">
									<img src="{{ asset('img/bronze_ball.png') }}" class="align-top" width="24">
								</a>
								<a class="d-inline p-2" onclick="setBallOverallRange(75,79)">
									<img src="{{ asset('img/silver_ball.png') }}" class="align-top" width="24">
								</a>
								<a class="d-inline p-2" onclick="setBallOverallRange(80,84)">
									<img src="{{ asset('img/yellow_ball.png') }}" class="align-top" width="24">
								</a>
								<a class="d-inline p-2" onclick="setBallOverallRange(85,99)">
									<img src="{{ asset('img/black_ball.png') }}" class="align-top" width="24" >
								</a>
							</div>
						</div> {{-- col --}}
					</div> {{-- row --}}

				    <div class="form-group row">
			            <div class="col-12">
							<label for="clause_range" class="col-form-label">Claúsula</label>
							<input type="text" class="js-range-slider" name="clause_range" id="clause_range" value="" />
						</div> {{-- col --}}
					</div> {{-- row --}}

				    <div class="form-group row">
			            <div class="col-12">
							<label for="age_range" class="col-form-label">Edad</label>
							<input type="text" class="js-range-slider" name="age_range" id="age_range" value="" />
							<div class="text-center pt-2">
								<a class="d-inline" onclick="setAgeRange(15,19)">
									<span class="badge badge-light border p-1 font-weight-normal">Críos</span>
								</a>
								<a class="d-inline" onclick="setAgeRange(20,25)">
									<span class="badge badge-light border p-1 font-weight-normal">Jóvenes</span>
								</a>
								<a class="d-inline" onclick="setAgeRange(26,32)">
									<span class="badge badge-light border p-1 font-weight-normal">Maduros</span>
								</a>
								<a class="d-inline" onclick="setAgeRange(33,36)">
									<span class="badge badge-light border p-1 font-weight-normal">Veteranos</span>
								</a>
								<a class="d-inline" onclick="setAgeRange(37,45)">
									<span class="badge badge-light border p-1 font-weight-normal">Abuelos</span>
								</a>
							</div>
						</div> {{-- col --}}
					</div> {{-- row --}}

				    <div class="form-group row">
			            <div class="col-12">
							<label for="height_range" class="col-form-label">Altura</label>
							<input type="text" class="js-range-slider" name="height_range" id="height_range" value="" />
							<div class="text-center pt-2">
								<a class="d-inline" onclick="setHeightRange(150,164)">
									<span class="badge badge-light border p-1 font-weight-normal">Enanos</span>
								</a>
								<a class="d-inline" onclick="setHeightRange(165,174)">
									<span class="badge badge-light border p-1 font-weight-normal">Pequeños</span>
								</a>
								<a class="d-inline" onclick="setHeightRange(175,180)">
									<span class="badge badge-light border p-1 font-weight-normal">Medios</span>
								</a>
								<a class="d-inline" onclick="setHeightRange(181,195)">
									<span class="badge badge-light border p-1 font-weight-normal">Altos</span>
								</a>
								<a class="d-inline" onclick="setHeightRange(196,210)">
									<span class="badge badge-light border p-1 font-weight-normal">Gigantes</span>
								</a>
							</div>

						</div> {{-- col --}}
					</div> {{-- row --}}

					<hr>

			        <div class="form-group row">
			            <div class="col-12">
			                <label for="order" class="col-form-label">Ordenar por</label>
				            <select name="order" id="order" class="form-control selectpicker show-tick order">
				                <option value="overall" {{ $order == 'overall' ? 'selected' : '' }} data-icon="fas fa-sort-numeric-up">Por media</option>
				                <option value="overall_desc" {{ $order == 'overall_desc' ? 'selected' : '' }} data-icon="fas fa-sort-numeric-down">Por media</option>
				                <option value="name" {{ $order == 'name' ? 'selected' : '' }} data-icon="fas fa-sort-alpha-up">Por nombre</option>
				                <option value="name_desc" {{ $order == 'name_desc' ? 'selected' : '' }} data-icon="fas fa-sort-alpha-down">Por nombre</option>
								<option value="clause" {{ $order == 'clause' ? 'selected' : '' }} data-icon="fas fa-sort-numeric-up">Por claúsula</option>
				                <option value="clause_desc" {{ $order == 'clause_desc' ? 'selected' : '' }} data-icon="fas fa-sort-numeric-down">Por claúsula</option>
								<option value="age" {{ $order == 'age' ? 'selected' : '' }} data-icon="fas fa-sort-numeric-up">Por edad</option>
				                <option value="age_desc" {{ $order == 'age_desc' ? 'selected' : '' }} data-icon="fas fa-sort-numeric-down">Por edad</option>
								<option value="height" {{ $order == 'height' ? 'selected' : '' }} data-icon="fas fa-sort-numeric-up">Por altura</option>
				                <option value="height_desc" {{ $order == 'height_desc' ? 'selected' : '' }} data-icon="fas fa-sort-numeric-down">Por altura</option>
				            </select>
			            </div> {{-- col --}}
			        </div> {{-- form-group --}}

				    <div class="form-group row">
				        <div class="col-12">
				        	<label for="pagination" class="col-form-label">Registros por página</label>
				            <select name="pagination" id="pagination" class="selectpicker show-tick form-control pagination">
				                <option value="6" {{ $pagination == '6' ? 'selected' : '' }}>6 registros / pagina</option>
				                <option value="12" {{ $pagination == '12' || !$pagination ? 'selected' : '' }}>12 registros / pagina</option>
				                <option value="20" {{ $pagination == '20' ? 'selected' : '' }}>20 registros / pagina</option>
				                <option value="50" {{ $pagination == '50' ? 'selected' : '' }}>50 registros / pagina</option>
				                <option value="100" {{ $pagination == '100' ? 'selected' : '' }}>100 registros / pagina</option>
				            </select>
				        </div>
				    </div>
		    	</form>
			</div>

		    <div class="modal-bottom">
		    	<div class="clearfix">
		    		<a href="{{ route('market.favorites') }}" class="btn float-left" onclick="disabledActionsButtons()">Limpiar filtros</a>
		    		<a href="" class="btn btn-primary float-right" onclick="ApplyFilters()">Ver resultados</a>
		    	</div>
		    </div>

		</div>
    </div>
</div>
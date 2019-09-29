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
				<form class="frmFilter" role="search" method="get" action="{{ route('market.sale') }}">

			        <div class="form-group row">
			            <div class="col-12">
			            	<label>Situación de mercado</label>

							<div class="d-block mb-2">
							    <div class="pretty p-switch p-fill">
							        <input type="radio" name="filterState" id="opt_all" value="all" {{ $filterState == 'all' ? 'checked' : '' }} />
							        <div class="state p-success">
							            <label for="opt_all" style="padding: .05rem 0;">Todos</label>
							        </div>
							    </div>
						    </div>
							<div class="d-block mb-2">
							    <div class="pretty p-switch p-fill">
							        <input type="radio" name="filterState" id="opt_transferable" value="transferable" {{ $filterState == 'transferable' ? 'checked' : '' }} />
							        <div class="state p-success">
							            <label for="opt_transferable" style="padding: .05rem 0;">Transferibles</label>
							        </div>
							    </div>
						    </div>
							<div class="d-block mb-2">
							    <div class="pretty p-switch p-fill">
							        <input type="radio" name="filterState" id="opt_salePrice" value="saleprice" {{ $filterState == 'saleprice' ? 'checked' : '' }} />
							        <div class="state p-success">
							            <label for="opt_salePrice" style="padding: .05rem 0;">Con precio de venta</label>
							        </div>
							    </div>
						    </div>
							<div class="d-block mb-2">
							    <div class="pretty p-switch p-fill">
							        <input type="radio" name="filterState" id="opt_buyNow" value="buynow" {{ $filterState == 'buynow' ? 'checked' : '' }} />
							        <div class="state p-success">
							            <label for="opt_buyNow" style="padding: .05rem 0;">Con venta directa</label>
							        </div>
							    </div>
						    </div>
							<div class="d-block">
							    <div class="pretty p-switch p-fill">
							        <input type="radio" name="filterState" id="opt_onLoan" value="onloan" {{ $filterState == 'onloan' ? 'checked' : '' }} />
							        <div class="state p-success">
							            <label for="opt_onLoan" style="padding: .05rem 0;">Cedibles</label>
							        </div>
							    </div>
						    </div>
						</div> {{-- col --}}
					</div> {{-- row --}}

				    <div class="form-group row">
			            <div class="col-12">
							<label for="overall_range" class="col-form-label">Valoración general</label>
							<input type="text" class="js-range-slider" name="overall_range" id="overall_range" value="" />
						</div> {{-- col --}}
					</div> {{-- row --}}

			        <div class="form-group row">
			            <div class="col-12">
			                <label for="filterParticipant" class="col-form-label">Equipos</label>
			                <select name="filterParticipant" id="filterParticipant" class="form-control selectpicker show-tick filterParticipant" data-header="Selecciona equipo" data-size="5">
			                    <option value="">Todos los equipos</option>
			                    @foreach ($participants as $participant)
			                        @if ($participant->id == $filterParticipant)
		                            	<option selected title="<img class='mr-2' src='{{ $participant->logo() }}' width='20'><span>{{ $participant->name() }}<small class='pl-1 text-muted'>{{ $participant->sub_name() }}<small>" data-content="<img class='mr-2' src='{{ $participant->logo() }}' width='20'><span>{{ $participant->name() }}<small class='pl-1 text-muted'>{{ $participant->sub_name() }}<small></span>" value="{{ $participant->id }}">{{ $participant->name() }}
		                            	</option>
			                        @else
		                            	<option title="<img class='mr-2' src='{{ $participant->logo() }}' width='20'><span>{{ $participant->name() }}<small class='pl-1 text-muted'>{{ $participant->sub_name() }}<small>" data-content="<img class='mr-2' src='{{ $participant->logo() }}' width='20'><span>{{ $participant->name() }}<small class='pl-1 text-muted'>{{ $participant->sub_name() }}<small></span>" value="{{ $participant->id }}">{{ $participant->name() }}
		                            	</option>
			                        @endif
			                    @endforeach
			                </select>
			            </div> {{-- col --}}
		           	</div>

				    <div class="form-group row">
			            <div class="col-12">
			                <label for="filterPosition" class="col-form-label">Posiciones</label>
			                <select name="filterPosition" id="filterPosition" class="form-control selectpicker show-tick filterPosition" data-header="Selecciona posición" data-size="5">
			                    <option value="">Todas las posiciones</option>
			                    @foreach ($positions as $position)
			                            <option {{ $position->position == $filterPosition ? 'selected' : '' }} value="{{ $position->position }}">
			                            	{{ $position->position }}
			                            </option>
			                    @endforeach
			                </select>
			            </div> {{-- col --}}
			        </div> {{-- row --}}

				    <div class="form-group row">
			            <div class="col-12">
							<label for="sale_price_range" class="col-form-label">Precio</label>
							<input type="text" class="js-range-slider" name="sale_price_range" id="sale_price_range" value="" />
						</div> {{-- col --}}
					</div> {{-- row --}}

			        <div class="form-group row">
			            <div class="col-12">
			                <label for="players_db_id" class="col-form-label">Ordenar por</label>
				            <select name="order" id="order" class="form-control selectpicker show-tick order">
				                <option value="date_desc" {{ $order == 'date_desc' ? 'selected' : '' }} data-icon="fas fa-sort-amount-up">Los últimos al principio</option>
				                <option value="date" {{ $order == 'date' ? 'selected' : '' }} data-icon="fas fa-sort-amount-down">Los últimos al final</option>
				                <option value="name" {{ $order == 'name' ? 'selected' : '' }} data-icon="fas fa-sort-alpha-up">Por nombre</option>
				                <option value="name_desc" {{ $order == 'name_desc' ? 'selected' : '' }} data-icon="fas fa-sort-alpha-down">Por nombre</option>
				                <option value="overall" {{ $order == 'overall' ? 'selected' : '' }} data-icon="fas fa-sort-numeric-up">Por media</option>
				                <option value="overall_desc" {{ $order == 'overall_desc' ? 'selected' : '' }} data-icon="fas fa-sort-numeric-down">Por media</option>
				                <option value="saleprice" {{ $order == 'saleprice' ? 'selected' : '' }} data-icon="fas fa-sort-numeric-up">Por precio</option>
				                <option value="saleprice_desc" {{ $order == 'saleprice_desc' ? 'selected' : '' }} data-icon="fas fa-sort-numeric-down">Por precio</option>
				            </select>
			            </div> {{-- col --}}
			        </div> {{-- form-group --}}
		    	</form>
			</div>

		    <div class="modal-bottom">
		    	<div class="clearfix">
		    		<a href="{{ route('market.sale') }}" class="btn float-left">Limpiar filtros</a>
		    		<a href="" class="btn btn-primary float-right" onclick="ApplyFilters()">Ver resultados</a>
		    	</div>
		    </div>

		</div>
    </div>
</div>
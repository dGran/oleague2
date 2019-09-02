<div class="modal-content">

	<form
	    id="frmEdit"
	    lang="{{ app()->getLocale() }}"
	    role="form"
	    method="POST"
	    action="{{ route('market.my_team.player.update', $player->id) }}"
	    enctype="multipart/form-data"
	    data-toggle="validator"
	    autocomplete="off">
	    {{ method_field('PUT') }}
	    {{ csrf_field() }}

    <div class="modal-header primary">
    	<h4>{{ $player->player->name }}</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

    <div class="modal-body">
    	<div class="row justify-content-center p-1 p-lg-3">
			<div class="col-12 col-sm-5 mb-3 mb-md-0">
				<div class="card">
					<img class="img" src="{{ $player->player->getImgFormatted() }}">
					<span class="position">
						{{ $player->player->position }}
					</span>
					<span class="overall">
						{{ $player->player->overall_rating }}
					</span>
					<figure class="ball">
						<img src="{{ asset($player->player->getBall()) }}">
					</figure>
				</div>
			</div>

			<div class="col-12 col-sm-7">
	            <div class="details">
					<div class="row">
						<div class="form-group col-6">
							<label class="m-0" for="salary">Salario</label>
							<input type="number" step="any" min="0.5" max="{{ ($player->salary + active_season()->salary_cap - $player->participant->salaries()) }}" class="form-control py-1" name="salary" id="salary" value="{{ $player->salary }}" onkeyup="changeSalary()" onblur="salaryBlur()">
							<small id="salaryHelp" class="form-text text-muted">Salario máximo: {{ $player->salary + active_season()->salary_cap - $player->participant->salaries() }} M.</small>
						</div>
						<div class="form-group col-6">
							<label class="m-0" for="salary">Claúsula</label>
							<input type="number" class="form-control py-1" name="price" id="price" value="{{ $player->price }}" onkeyup="changePrice()" onblur="priceBlur()">
						</div>
					</div>

					<h5 class="border-top pt-3 pb-2">
						Situación de mercado
					</h5>

					<div class="d-block mb-2">
					    <div class="pretty p-switch p-fill">
					        <input type="checkbox" name="untransferable" id="untransferable" {{ $player->untransferable ? 'checked' : '' }} onchange="untransferableChange()"/>
					        <div class="state p-success">
					            <label for="untransferable">Intransferible</label>
					        </div>
					    </div>
				    </div>

					<div class="d-block mb-2">
					    <div class="pretty p-switch p-fill">
					        <input type="checkbox" name="player_on_loan" id="player_on_loan" {{ $player->player_on_loan ? 'checked' : '' }} onchange="onLoanChange()" />
					        <div class="state p-success">
					            <label for="player_on_loan">Cedible</label>
					        </div>
					    </div>
				    </div>

					<div class="d-block mb-2">
					    <div class="pretty p-switch p-fill">
					        <input type="checkbox" name="transferable" id="transferable" {{ $player->transferable ? 'checked' : '' }} onchange="transferableChange()" />
					        <div class="state p-success">
					            <label for="transferable">Transferible</label>
					        </div>
					    </div>
				    </div>

					<div class="col-6 m-0 p-0 mb-1 form-group">
						<label class="m-0" for="sale_price">Precio</label>
						<input type="number" step="any" name="sale_price" id="sale_price" class="form-control py-1" value="{{ $player->sale_price }}" {{ !$player->transferable ? 'disabled' : '' }}>
					</div>
					<div class="d-block">
					    <div class="pretty p-switch p-fill">
					        <input type="checkbox" name="sale_auto_accept" id="sale_auto_accept" {{ $player->sale_auto_accept ? 'checked' : '' }} {{ !$player->transferable ? 'disabled' : '' }}/>
					        <div class="state p-danger">
					            <label for="sale_auto_accept">Compra directa</label>
					        </div>
					    </div>
					    <small id="emailHelp" class="form-text text-muted">Venta automática por el valor del precio de venta</small>
				    </div>

					<div class="form-group mt-3">
						<label class="m-0" for="market_phrase">Comentario de mercado</label>
						<small class="float-right d-none" id="phrase_counter">0 / 80</small>
						<input type="text" class="form-control py-1 px-2" style="font-size: .9em" name="market_phrase" id="market_phrase" value="{{ $player->market_phrase }}" onkeyup="phraseCounter()" onblur="phraseCounterBlur()" onfocus="phraseCounterFocus()" maxlength="80" {{ $player->transferable || $player->player_on_loan ? '' : 'disabled' }}>
						<small id="marketPhraseHelp" class="form-text text-muted">Comentario opcional para el escaparate</small>
					</div>
				</div>
			</div>
		</div>
	</div>

    <div class="modal-bottom p-3" style="background-color: #e2e2e4">
        @if ($player->player->game_id)
            <div class="text-right" style="font-size: .9em">
				<input type="submit" class="btn btn-primary" value="Guardar cambios">
            </div>
        @endif
    </div>

	</form>
</div>
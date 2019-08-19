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

    <div class="modal-header" style="background-color: #e2e2e4">
    	<h4 class="m-0">{{ $player->player->name }}</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
    	<div class="row justify-content-center p-1 p-lg-3">
			<div class="col-12 col-sm-5 col-md-5 col-lg-3 mb-3 mb-md-0">
				<div class="border rounded" style="width: 160px; height: 120px; position: relative; background: rgba(139,160,184,1);
background: -moz-linear-gradient(top, rgba(139,160,184,1) 0%, rgba(162,179,199,1) 50%, rgba(255,255,255,1) 100%);
background: -webkit-gradient(left top, left bottom, color-stop(0%, rgba(139,160,184,1)), color-stop(50%, rgba(162,179,199,1)), color-stop(100%, rgba(255,255,255,1)));
background: -webkit-linear-gradient(top, rgba(139,160,184,1) 0%, rgba(162,179,199,1) 50%, rgba(255,255,255,1) 100%);
background: -o-linear-gradient(top, rgba(139,160,184,1) 0%, rgba(162,179,199,1) 50%, rgba(255,255,255,1) 100%);
background: -ms-linear-gradient(top, rgba(139,160,184,1) 0%, rgba(162,179,199,1) 50%, rgba(255,255,255,1) 100%);
background: linear-gradient(to bottom, rgba(139,160,184,1) 0%, rgba(162,179,199,1) 50%, rgba(255,255,255,1) 100%);
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#8ba0b8', endColorstr='#ffffff', GradientType=0 );">
					<img src="{{ $player->player->getImgFormatted() }}" alt="" width="100" style="position: absolute; bottom: 0; left: 30px">
					<span class="text-center" style="color: white; width: 35px; font-size: 1.2em; font-weight: bold; position: absolute; top: 2px; left: 5px">
						{{ $player->player->position }}
					</span>
					<span class="text-center" style="width: 35px; color: white; font-size: 1.6em; font-weight: bold; position: absolute; top: 20px; left: 5px">
						{{ $player->player->overall_rating }}
					</span>
					<figure style="position: absolute; top: 8px; right: 8px;">
						<img src="{{ asset($player->player->getBall()) }}" style="width: 36px">
					</figure>
{{-- 					<figure style="position: absolute; top: 35px; right: 5px;">
						<img src="https://carwad.net/sites/default/files/russia-flag-png-transparent-images-149955-5284790.png" style="width: 25px">
					</figure> --}}
				</div>

{{-- 				<div class="d-sm-none">
					<span class="badge badge-dark p-1" style="position: absolute; right: 0px; top: 5px; padding: 2px; opacity: .2">INTRANSFERIBLE</span>
					<span class="badge badge-dark p-1" style="position: absolute; right: 0px; top: 30px; padding: 2px;">TRANSFERIBLE</span>
					<span class="badge badge-dark p-1" style="position: absolute; right: 0px; top: 55px; padding: 2px;">CEDIBLE</span>
				</div>

				<div class="d-none d-sm-block">
					<div class="pt-2 pb-1">
						<span class="badge badge-dark p-1" style="padding: 2px; opacity: .2">INTRANSFERIBLE</span>
					</div>
					<div class="pb-1">
						<span class="badge badge-dark p-1" style="padding: 2px;">TRANSFERIBLE</span>
					</div>
					<div class="pb-1">
						<span class="badge badge-dark p-1" style="padding: 2px;">CEDIBLE</span>
					</div>
				</div> --}}
			</div>

			<div class="col-12 col-sm-7 col-md-7 col-lg-9">
	            <div class="details" style="font-size: .9em">
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
				<input type="submit" class="btn btn-success" value="Guardar cambios">
            </div>
        @endif
    </div>

	</form>
</div>
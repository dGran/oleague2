<div class="col-12 col-md-6">
	<div class="" style="border-top: 1px solid #E9E9E9; line-height: 1.25em; font-size: .9em; height: 72px; position: relative;">
		<img src="{{ $player->player->getImgFormatted() }}" alt="" width="48" style="position: absolute; left: 0px; bottom: 0;">
		<div style='background: {{ $player->player->getPositionColor() }}; border: 1px solid grey; font-size: .7em; width: 24px; height: 24px; line-height: 1.3em; position: absolute; left: 5px; top: 5px;' class='rounded-circle p-1 text-center'>
			<span class='font-weight-bold text-white'>
				<small>{{ $player->player->position }}</small>
			</span>
		</div>
		<img src="{{ asset($player->player->getBall()) }}" alt="" width="24" height="24" style="position: absolute; right: 20px; top: 5px">
		<span class="player-name text-uppercase" style="position: absolute; left: 36px; top: 9px; font-size: .9rem; font-weight: bold">
			{{ $player->player->name }}
			<a href="" class="ml-1" data-toggle="modal" data-target="#viewModal" id="btnView" data-id="{{ $player->id }}">
				<i class="fas fa-info-circle text-info"></i>
			</a>
		</span>

	{{-- 							<div style='background: #000; font-size: .7em; height: 20px; border: 1px solid grey; line-height: 1em; position: absolute; left: 65px; bottom: -5px;' class='rounded p-1 text-center'>
		    <span class='font-weight-bold text-white'>
		        <small>3 clubs le siguen</small>
		    </span>
		</div> --}}

		<div style="position: absolute; right: 90px; top: 7px;">
			<img src="https://image.flaticon.com/icons/svg/126/126422.svg" width="15">
			<span class="d-inline-block" style="font-size: .9em; font-weight: bold">
				<small>{{ number_format($player->price, 2, ',', '.') }}</small>
			</span>
			<small class="d-inline-block" style="font-size: .7em">mill.</small>
		</div>

		<img src="{{ asset($player->player->getIconPosition()) }}" width="20" style="position: absolute; top: 7px; right: 50px">
		<div style='background: {{ $player->player->getOverallRatingColor() }}; font-size: 1em; width: 24px; height: 24px; border: 1px solid grey; line-height: 1em; position: absolute; right: 5px; top: 5px;' class='rounded-circle p-1 text-center'>
		    <span class='font-weight-bold text-dark'>
		        <small>{{ $player->player->overall_rating }}</small>
		    </span>
		</div>
		@if ($player->untransferable)
			<span class="badge badge-danger p-1" style="position: absolute; left: 55px; top: 40px; padding: 2px;">IN</span>
		@else
			<span class="badge badge-danger p-1" style="position: absolute; left: 55px; top: 40px; padding: 2px; opacity: .2">IN</span>
		@endif
		@if ($player->transferable)
			<span class="badge badge-success p-1" style="position: absolute; left: 80px; top: 40px; padding: 2px;">TR</span>
		@else
			<span class="badge badge-success p-1" style="position: absolute; left: 80px; top: 40px; padding: 2px; opacity: .2">TR</span>
		@endif
		@if ($player->player_on_loan)
			<span class="badge badge-success p-1" style="position: absolute; left: 105px; top: 40px; padding: 2px;">CD</span>
		@else
			<span class="badge badge-success p-1" style="position: absolute; left: 105px; top: 40px; padding: 2px; opacity: .2">CD</span>
		@endif
		@if ($player->for_sale)
			<span class="badge badge-success p-1" style="position: absolute; left: 130px; top: 40px; padding: 2px;">VT</span>
		@else
			<span class="badge badge-success p-1" style="position: absolute; left: 130px; top: 40px; padding: 2px; opacity: .2">VT</span>
		@endif


	{{-- 							<img src="https://image.flaticon.com/icons/svg/118/118650.svg" alt="" width="28" style="position: absolute; left: 105px; top: 94px; padding: 2px; background-color: #fff" class="border rounded-circle">
		<span class="text-uppercase" style="position: absolute; left: 140px; top: 100px; font-size: .8rem; font-weight: bold; font-size: .7rem">
			181 cm
		</span>
		<img src="https://image.flaticon.com/icons/svg/1743/1743289.svg" alt="" width="28" style="position: absolute; left: 105px; top: 124px; padding: 2px; background-color: #fff" class="border rounded-circle">
		<span class="text-uppercase" style="position: absolute; left: 140px; top: 130px; font-size: .8rem; font-weight: bold; font-size: .7rem">
			70 kg
		</span> --}}


		<div style="position: absolute; right: 8px; bottom: 8px">
			<a href="" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#editModal" id="btnEdit" data-id="{{ $player->id }}">
				Editar
				{{-- <i class="fas fa-info-circle text-info"></i> --}}
			</a>
{{-- 			<div class="dropdown dropleft">
			  <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-size: .9em;">
			    Acciones
			  </button>
			  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="font-size: .9em;">
			    <a class="dropdown-item" href="#">Editar salario</a>
			    <a class="dropdown-item" href="#">Marcar como transferible</a>
			    <a class="dropdown-item" href="#">Marcar como cedible</a>
			    <a class="dropdown-item" href="#">Marcar como intransferible</a>
			  </div>


			</div> --}}
		</div>
	</div>
</div>
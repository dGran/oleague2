<div class="col-12 col-md-6 m-0 p-0" style="background: #f9f9f9">
	<div class="border rounded mt-2 mx-2" style="border-top: 1px solid #E9E9E9; line-height: 1.25em; font-size: .9em; height: 92px; position: relative; background: #fff">
		<img src="{{ $player->player->getImgFormatted() }}" alt="" width="55" style="position: absolute; left: 0px; bottom: 0;">
		<div style='background: {{ $player->player->getPositionColor() }}; font-size: .8em; width: 24px; height: 24px; line-height: 1.3em; position: absolute; left: 5px; top: 5px; padding-top: .43em' class='rounded-circle text-center'>
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

		<div class="text-muted" style="position: absolute; left: 55px; top: 26px;">
			<i class="fas fa-star" style="font-size: .7em;"></i>
			<span class="d-inline-block" style="font-size: .9em; font-weight: bold">
				<small>14</small>
			</span>
		</div>

		<div class="text-muted" style="position: absolute; left: 85px; top: 26px;">
			<i class="fas fa-euro-sign" style="font-size: .7em"></i>
			<span class="d-inline-block" style="font-size: .9em; font-weight: bold">
				<small>{{ number_format($player->salary, 2, ',', '.') }}</small>
			</span>
			<small class="d-inline-block" style="font-size: .7em">mill.</small>
		</div>

		<div style='background: {{ $player->player->getOverallRatingColor() }}; font-size: 1em; width: 24px; height: 24px; border: 1px solid grey; line-height: 1em; position: absolute; right: 5px; top: 5px;' class='rounded-circle p-1 text-center'>
		    <span class='font-weight-bold text-dark'>
		        <small>{{ $player->player->overall_rating }}</small>
		    </span>
		</div>
		@if ($player->transferable)
			<span class="badge badge-success p-1" style="position: absolute; left: 55px; top: 47px; padding: 2px;">TRA</span>
			<div class="text-muted" style="position: absolute; left: 55px; top: 67px;">
				@if ($player->sale_price)
					<i class="fas fa-tag" style="font-size: .7em"></i>
					<span class="d-inline-block" style="font-size: .9em; font-weight: bold">
						<small>{{ number_format($player->sale_price, 2, ',', '.') }}</small>
					</span>
					<small class="d-inline-block" style="font-size: .7em">mill.</small>
				@endif
			</div>
		@else
			<span class="badge badge-success p-1" style="position: absolute; left: 55px; top: 47px; padding: 2px; opacity: .2">TRA</span>
		@endif
		@if ($player->player_on_loan)
			<span class="badge badge-success p-1" style="position: absolute; left: 87px; top: 47px; padding: 2px;">CED</span>
		@else
			<span class="badge badge-success p-1" style="position: absolute; left: 87px; top: 47px; padding: 2px; opacity: .2">CED</span>
		@endif
		@if ($player->untransferable)
			<span class="badge badge-danger p-1" style="position: absolute; left: 119px; top: 47px; padding: 2px;">INT</span>
		@else
			<span class="badge badge-danger p-1" style="position: absolute; left: 119px; top: 47px; padding: 2px; opacity: .2">INT</span>
		@endif

		<div style="position: absolute; right: 8px; bottom: 8px;">
{{-- 			<a href="" class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#editModal" id="btnEdit" data-id="{{ $player->id }}" style="font-size: .9em">
				Editar
			</a> --}}
			<div class="dropdown dropleft">
			  <button class="btn btn-light btn-sm border dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-size: .9em;">
			    Acciones
			  </button>
			  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="font-size: .9em; background: #f9f9f9">
			    <a class="dropdown-item" href="" data-toggle="modal" data-target="#editModal" id="btnEdit" data-id="{{ $player->id }}">Editar</a>
			    <div class="dropdown-divider"></div>
			    <a class="dropdown-item {{ $player->untransferable ? 'disabled' : '' }}" href="{{ route('market.my_team.player.tags.untransferable', $player->id) }}">Declarar intransferible</a>
			    <a class="dropdown-item {{ $player->transferable ? 'disabled' : '' }}" href="{{ route('market.my_team.player.tags.transferable', $player->id) }}">Declarar transferible</a>
			    <a class="dropdown-item {{ $player->player_on_loan ? 'disabled' : '' }}" href="{{ route('market.my_team.player.tags.on_loan', $player->id) }}">Declarar cedible</a>
			    <a class="dropdown-item" href="{{ route('market.my_team.player.tags.delete', $player->id) }}">Eliminar etiquetas</a>
			    <div class="dropdown-divider"></div>
			    <a class="dropdown-item text-danger" href="" onclick="dismiss_player('{{ $player->id }}', '{{ $player->player->name }}', '{{ number_format($player->season->free_players_remuneration, 2, ',', '.') }}')">Despedir</a>
			  </div>


			</div>
		</div>
	</div>
</div>
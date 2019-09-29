<div class="item {{ !$player->season_player->participant ? 'free' : '' }} {{ (!$player->season_player->allow_clause_pay && $player->season_player->participant) || ($player->season_player->participant && $player->season_player->participant->clauses_received_limit()) ? 'clause-pay' : '' }}">
	@if (player_in_showcase($player->season_player->id))
		<span class="showcase badge badge-success">Escaparate</span>
	@endif
	@if ($player->season_player->untransferable)
		<span class="untransferable badge badge-danger">Intransferible</span>
	@endif
	<img class="player-img" src="{{ $player->season_player->player->getImgFormatted() }}">
	<div class="position" style="background: {{ $player->season_player->player->getPositionColor() }};">
		{{ $player->season_player->player->position }}
	</div> {{-- position --}}
	<img class="player-ball" src="{{ asset($player->season_player->player->getBall()) }}">
	<span class="name">
		{{ $player->season_player->player->name }}
		<a class="player-info" data-toggle="modal" data-target="#viewModal" id="btnView" data-id="{{ $player->season_player->id }}">
			<i class="fas fa-info-circle"></i>
		</a>
	</span> {{-- name --}}
	<img class="icon-position" src="{{ asset($player->season_player->player->getIconPosition()) }}">
	<div class="overall" style="background: {{ $player->season_player->player->getOverallRatingColor() }}; color: {{ $player->season_player->player->getOverallRatingColorText() }}">
        {{ $player->season_player->player->overall_rating }}
	</div> {{-- overall --}}
	@if ($player->season_player->participant)
		<img class="participant-logo" src="{{ $player->season_player->participant->logo() }}">
		<span class="participant-name">
			{{ $player->season_player->participant->name() }}
		</span> {{-- participant-name --}}
		<span class="participant-subname">
			{{ $player->season_player->participant->sub_name() }}
		</span> {{-- participant-subname --}}
	@else
		<img class="participant-logo none" src="{{ asset('img/team_no_image.png') }}">
		<span class="participant-name none">
			Agente libre
		</span> {{-- participant-name --}}
	@endif
	<img class="nation-logo" src="https://cdn10.bigcommerce.com/s-ey7tq/products/3606/images/4932/FISPA-2__55833.1407859367.1280.1280.jpg?c=2" data-toggle="tooltip" data-placement="top" title="{{ $player->season_player->player->nation_name}}">
	@if ($player->season_player->participant)
		<div class="clause-data">
			<span class="units">Claúsula: {{ number_format($player->season_player->price, 2, ',', '.') }}</span>
			<small class="measure">mill.</small>
		</div> {{-- clause-data --}}
	@endif
	@if (!$player->season_player->allow_clause_pay || ($player->season_player->participant && $player->season_player->participant->clauses_received_limit()))
		@if (!$player->season_player->allow_clause_pay && $player->season_player->participant)
			<small class="clause-pay">Claúsula pagada</small>
		@elseif ($player->season_player->participant && $player->season_player->participant->clauses_received_limit())
			<small class="clause-pay">Límite claúsulas</small>
		@endif
	@endif
	@if (!auth()->guest() && user_is_participant(auth()->user()->id))
		<div class="actions">
			<div class="dropdown dropleft">
				<button class="btn btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					Acciones
				</button>
				<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
					<h6 class="dropdown-header">
						{{ $player->season_player->player->name }}
						@if (!$player->season_player->participant)
							<small class="free"><strong>Libre</strong></small>
						@endif
					</h6>
					<a class="dropdown-item text-danger" href="" onclick="destroy_favorite('{{ $player->id }}', '{{ $player->season_player->player->name }}')">
						Eliminar favorito
					</a>
					<div class="dropdown-divider"></div>
					<a class="dropdown-item {{ !$player->season_player->participant ? 'disabled' : '' }}" href="">
						Abrir negociación
					</a>
					<a class="dropdown-item {{ !$player->season_player->participant || !$player->season_player->allow_clause_pay || ($player->season_player->participant && $player->season_player->participant->clauses_received_limit()) || ($player->season_player->participant && participant_of_user()->clauses_paid_limit()) || $player->season_player->participant && $player->season_player->participant->id == participant_of_user()->id || participant_of_user()->budget() < $player->season_player->clause_price() || participant_of_user()->max_players_limit() ? 'disabled' : '' }}" href="" onclick="pay_clause_player('{{ $player->season_player->id }}', '{{ $player->season_player->player->name }}', '{{ number_format($player->season_player->price, 2, ',', '.') }}')">
						Pagar claúsula
					</a>
					<a class="dropdown-item {{ $player->season_player->participant || participant_of_user()->max_players_limit() ? 'disabled' : '' }}" href="" onclick="sign_free_player('{{ $player->season_player->id }}', '{{ $player->season_player->player->name }}', '{{ number_format($player->season_player->season->free_players_cost, 2, ',', '.') }}')">
						Fichar jugador
					</a>
				</div> {{-- dropdown-menu --}}
			</div> {{-- dropdown --}}
		</div> {{-- actions --}}
	@endif
</div> {{-- item --}}
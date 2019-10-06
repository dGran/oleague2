<div class="item {{ !$player->participant ? 'free' : '' }} {{ (!$player->allow_clause_pay && $player->participant) || ($player->participant && $player->participant->clauses_received_limit()) ? 'clause-pay' : '' }}">
	@if (player_in_showcase($player->id))
		<span class="showcase badge badge-success">Escaparate</span>
	@endif
	@if ($player->untransferable)
		<span class="untransferable badge badge-danger">Intransferible</span>
	@endif
	<img class="player-img" src="{{ $player->player->getImgFormatted() }}">
	<div class="position" style="background: {{ $player->player->getPositionColor() }};">
		{{ $player->player->position }}
	</div> {{-- position --}}
	@if (!auth()->guest() && user_is_participant(auth()->user()->id))
		<div id="player_favorite{{ $player->id}}" class="d-inline-block">
			@include('market.partials.favorite')
		</div>
	@endif
	<img class="player-ball" src="{{ asset($player->player->getBall()) }}">
	<span class="name">
		{{ $player->player->name }}
		<a class="player-info" data-toggle="modal" data-target="#viewModal" id="btnView" data-id="{{ $player->id }}">
			<i class="fas fa-info-circle"></i>
		</a>
	</span> {{-- name --}}
	<img class="icon-position" src="{{ asset($player->player->getIconPosition()) }}">
	<div class="overall" style="background: {{ $player->player->getOverallRatingColor() }}; color: {{ $player->player->getOverallRatingColorText() }}">
        {{ $player->player->overall_rating }}
	</div> {{-- overall --}}
	@if ($player->participant)
		<img class="participant-logo" src="{{ $player->participant->logo() }}">
		<span class="participant-name">
			{{ $player->participant->name() }}
			@if ($player->owner_id)
				<span class="text-primary">(CESION)</span>
			@endif
		</span> {{-- participant-name --}}
		<span class="participant-subname">
			{{ $player->participant->sub_name() }}
		</span> {{-- participant-subname --}}
	@else
		<img class="participant-logo none" src="{{ asset('img/team_no_image.png') }}">
		<span class="participant-name none">
			Agente libre
		</span> {{-- participant-name --}}
	@endif
	<img class="nation-logo" src="{{ asset($player->player->nation_flag()) }}" data-toggle="tooltip" data-placement="top" title="{{ $player->player->nation_name }}">
	@if ($player->participant)
		<div class="clause-data">
			<span class="units">Claúsula: {{ number_format($player->price, 2, ',', '.') }}</span>
			<small class="measure">mill.</small>
		</div> {{-- clause-data --}}
	@endif
	@if (!$player->allow_clause_pay || ($player->participant && $player->participant->clauses_received_limit()))
		@if (!$player->allow_clause_pay && $player->participant)
			<small class="clause-pay">Claúsula pagada</small>
		@elseif ($player->participant && $player->participant->clauses_received_limit())
			<small class="clause-pay">Límite claúsulas</small>
		@endif
	@endif
	@if (!auth()->guest() && user_is_participant(auth()->user()->id))
		<div class="actions {{ participant_of_user()->id == $player->participant_id ? 'd-none' : '' }}">
			<div class="dropdown dropleft">
				<button class="btn btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					Acciones
				</button>
				<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
					<h6 class="dropdown-header">
						{{ $player->player->name }}
						@if (!$player->participant)
							<small class="free"><strong>Libre</strong></small>
						@endif
					</h6>
					<div class="dropdown-divider"></div>
					<a class="dropdown-item {{ !active_season()->transfers_period || !$player->participant || participant_of_user()->id == $player->participant_id || $player->owner_id ? 'disabled' : '' }}" href="{{ route('market.trades.add', [$player->participant_id, $player->id]) }}">
						Abrir negociación
					</a>
					<a class="dropdown-item {{ !active_season()->clausules_period || !$player->participant || !$player->allow_clause_pay || ($player->participant && $player->participant->clauses_received_limit()) || ($player->participant && participant_of_user()->clauses_paid_limit()) || $player->participant && $player->participant->id == participant_of_user()->id || participant_of_user()->budget() < $player->clause_price() || participant_of_user()->max_players_limit() ? 'disabled' : '' }}" href="" onclick="pay_clause_player('{{ $player->id }}', '{{ $player->player->name }}', '{{ number_format($player->price, 2, ',', '.') }}')">
						Pagar claúsula
					</a>
					<a class="dropdown-item {{ !active_season()->free_players_period || $player->participant || participant_of_user()->max_players_limit() ? 'disabled' : '' }}" href="" onclick="sign_free_player('{{ $player->id }}', '{{ $player->player->name }}', '{{ number_format($player->season->free_players_cost, 2, ',', '.') }}')">
						Fichar jugador
					</a>
				</div> {{-- dropdown-menu --}}
			</div> {{-- dropdown --}}
		</div> {{-- actions --}}
	@endif
</div> {{-- item --}}
<div class="wrap col-12 col-md-6 col-xl-4">

	<div class="item
		{{ $player->transferable || $player->player_on_loan ? 'transferable' : '' }}
		{{ ($player->participant->clauses_received_limit() || !$player->allow_clause_pay || $player->untransferable) && (!$player->transferable || !$player->player_on_loan)  ? 'not-allowed' : '' }}">

		{{-- ribbons  --}}
		@if ($player->transferable || $player->player_on_loan)
			<div class="ribbon rb-right rb-success">
				<span>
					@if ($player->transferable && $player->player_on_loan)
						Transferible / Cedibe
					@elseif ($player->transferable)
						Transferible
					@else
						Cedible
					@endif
				</span>
			</div>
		@endif
		@if ($player->untransferable)
			<div class="ribbon rb-right rb-danger"><span>Instransferible</span></div>
		@endif
		@if ($player->participant->clauses_received_limit() || !$player->allow_clause_pay)
			<div class="ribbon rb-left rb-danger">
				<span>
					@if ($player->participant->clauses_received_limit())
						Límite claúsulas
					@else
						Claúsula pagada
					@endif
				</span>
			</div>
		@endif
		{{-- end-ribbons --}}

		<img class="player-img" src="{{ $player->player->getImgFormatted() }}" alt="" >
		<div class="position" style="background: {{ $player->player->getPositionColor() }};">
			<span class='text'>
				<small>{{ $player->player->position }}</small>
			</span>
		</div>
		<img class="nation-logo" src="{{ asset($player->player->nation_flag()) }}" data-toggle="tooltip" data-placement="top" title="{{ $player->player->nation_name}}">

		@if (!auth()->guest() && user_is_participant(auth()->user()->id))
			<div id="player_favorite{{ $player->id}}" class="d-inline-block">
				@include('market.partials.favorite')
			</div>
		@endif
		<img class="ball-img" src="{{ asset($player->player->getBall()) }}">
		<span class="player-name">
			@if ($player->owner_id)
				<small class="text-primary font-weight-bold" style="font-size: .7em">(CESION)</small>
			@endif
			{{ $player->player->name }}
			<a class="player-info" data-toggle="modal" data-target="#viewModal" id="btnView" data-id="{{ $player->id }}">
				<i class="fas fa-info-circle"></i>
			</a>
		</span>

		<div class="overall" style="background: {{ $player->player->getOverallRatingColor() }}">
		    <span style="color: {{ $player->player->getOverallRatingColorText() }}">{{ $player->player->overall_rating }}</span>
		</div>

		<div class="salary">
			{{-- <i class="fas fa-euro-sign"></i> --}}
			<span>
				Salario: {{ number_format($player->salary, 2, ',', '.') }} mill.
			</span>
		</div>

		<div class="clause-data">
			<span class="units">Claúsula: {{ number_format($player->price, 2, ',', '.') }}</span>
			<small class="measure">mill.</small>
		</div> {{-- clause-data --}}

		@if (!auth()->guest() && user_is_participant(auth()->user()->id) && active_season()->id == $season->id)
			<div class="actions {{ participant_of_user()->id == $player->participant_id ? 'd-none' : '' }}">
				<div class="dropdown dropleft">
					<button class="btn btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Acciones
					</button>
					<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
						<h6 class="dropdown-header">
							{{ $player->player->name }}
						</h6>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item {{ !active_season()->transfers_period || !$player->participant || participant_of_user()->id == $player->participant_id || $player->owner_id ? 'disabled' : '' }}" href="{{ route('market.trades.add', [$player->participant_id, $player->id]) }}">
							Abrir negociación
						</a>
						<a class="dropdown-item {{ !active_season()->clausules_period || !$player->participant || !$player->allow_clause_pay || ($player->participant && $player->participant->clauses_received_limit()) || ($player->participant && participant_of_user()->clauses_paid_limit()) || $player->participant && $player->participant->id == participant_of_user()->id || participant_of_user()->budget() < $player->clause_price() || participant_of_user()->max_players_limit() ? 'disabled' : '' }}" href="" onclick="pay_clause_player('{{ $player->id }}', '{{ $player->player->name_addslashes() }}', '{{ number_format($player->price, 2, ',', '.') }}')">
							Pagar claúsula
						</a>
					</div> {{-- dropdown-menu --}}
				</div> {{-- dropdown --}}
			</div> {{-- actions --}}
		@endif
	</div>
</div>
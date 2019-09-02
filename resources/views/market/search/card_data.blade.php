<div class="item {{ !$player->participant ? 'free' : '' }} {{ !$player->allow_clause_pay || ($player->participant && $player->participant->clauses_received_limit()) ? 'clause-pay' : '' }}">
	@if (player_in_showcase($player->id))
		<span class="showcase badge badge-success">Escaparate</span>
	@endif
	<img class="player-img" src="{{ $player->player->getImgFormatted() }}">
	<div class="position" style="background: {{ $player->player->getPositionColor() }};">
		{{ $player->player->position }}
	</div> {{-- position --}}
	<img class="player-ball" src="{{ asset($player->player->getBall()) }}">
	<span class="name">
		{{ $player->player->name }}
		<a class="player-info" data-toggle="modal" data-target="#viewModal" id="btnView" data-id="{{ $player->id }}">
			<i class="fas fa-info-circle"></i>
		</a>
	</span> {{-- name --}}
	<img class="icon-position" src="{{ asset($player->player->getIconPosition()) }}">
	<div class="overall" style="background: {{ $player->player->getOverallRatingColor() }};">
        {{ $player->player->overall_rating }}
	</div> {{-- overall --}}
	@if ($player->participant)
		<img class="participant-logo" src="{{ $player->participant->logo() }}">
		<span class="participant-name">
			{{ $player->participant->name() }}
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
	<img class="nation-logo" src="https://cdn10.bigcommerce.com/s-ey7tq/products/3606/images/4932/FISPA-2__55833.1407859367.1280.1280.jpg?c=2" data-toggle="tooltip" data-placement="top" title="{{ $player->player->nation_name}}">
	@if ($player->participant)
		<div class="clause-data">
			<span class="units">Claúsula: {{ number_format($player->price, 2, ',', '.') }}</span>
			<small class="measure">mill.</small>
		</div> {{-- clause-data --}}
	@endif
	@if (!$player->allow_clause_pay || ($player->participant && $player->participant->clauses_received_limit()))
		@if (!$player->allow_clause_pay)
			<small class="clause-pay">Claúsula pagada</small>
		@endif
		@if ($player->participant->clauses_received_limit())
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
					<h6 class="dropdown-header p-2">
						{{ $player->player->name }}
						@if (!$player->participant)
							<small class="text-warning ml-1"><strong>Libre</strong></small>
						@endif
					</h6>
					<div class="dropdown-divider"></div>
					<a class="dropdown-item {{ !$player->participant ? 'disabled' : '' }}" href="">
						Abrir negociación
					</a>
					<a class="dropdown-item {{ !$player->participant || !$player->allow_clause_pay || ($player->participant && $player->participant->clauses_received_limit()) || ($player->participant && participant_of_user()->clauses_paid_limit()) ? 'disabled' : '' }}" href="">
						Pagar claúsula
					</a>
					<a class="dropdown-item {{ $player->participant ? 'disabled' : '' }}" href="">
						Fichar jugador
					</a>
				</div> {{-- dropdown-menu --}}
			</div> {{-- dropdown --}}
		</div> {{-- actions --}}
	@endif
</div> {{-- item --}}
<div class="wrap col-12 col-md-6 col-xl-4">
	<div class="item {{ $player->transferable || $player->player_on_loan ? 'transferable' : '' }} {{ $player->untransferable ? 'untransferable' : '' }}">

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

		@if ($player->transferable || $player->player_on_loan || $player->untransferable)
			<span class="market-situation {{ $player->untransferable ? 'red' : 'green' }}">
				@if ($player->transferable || $player->player_on_loan)
					@if ($player->transferable && $player->player_on_loan)
						Transferible & Cedible
					@else
						@if ($player->transferable)
							Transferible
						@else
							Cedible
						@endif
					@endif
				@else
					Intransferible
				@endif
			</span>
		@endif
	</div>
</div>
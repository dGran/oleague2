<div class="item-header">
	<div class="date">
		desde {{ $player->created_at->diffForHumans() }}
	</div>
</div> {{-- item-header --}}
<div class="item">
	<img class="player-img" src="{{ $player->season_player->player->getImgFormatted() }}">
	<div class="position" style="background: {{ $player->season_player->player->getPositionColor() }};">
		{{ $player->season_player->player->position }}
	</div> {{-- position --}}
	@if (!auth()->guest() && user_is_participant(auth()->user()->id))
		<div id="player_favorite{{ $player->id}}" class="d-inline-block">
			@include('market.partials.favorite')
		</div>
	@endif
	<img class="player-ball" src="{{ asset($player->season_player->player->getBall()) }}">
	<span class="name">
		{{ $player->season_player->player->name }}
		<a class="player-info" data-toggle="modal" data-target="#viewModal" id="btnView" data-id="{{ $player->season_player->id }}">
			<i class="fas fa-info-circle"></i>
		</a>
	</span> {{-- name --}}
	<img class="icon-position" src="{{ asset($player->season_player->player->getIconPosition()) }}">
	<div class="overall" style="background: {{ $player->season_player->player->getOverallRatingColor() }};">
        {{ $player->season_player->player->overall_rating }}
	</div> {{-- overall --}}
	<img class="participant-logo" src="{{ $player->season_player->participant->logo() }}">
	<span class="participant-name">
		{{ $player->season_player->participant->name() }}
	</span> {{-- participant-name --}}
	<span class="participant-subname">
		{{ $player->season_player->participant->sub_name() }}
	</span> {{-- participant-subname --}}
	<img class="nation-logo" src="https://www.pesmaster.com/pes-2019/graphics/nteamlogos/flag_HRV.png">
	<span class="nation-name">
		{{ $player->season_player->player->nation_name }}
	</span> {{-- nation-name --}}
	<div class="clause-title">
		Claúsula
	</div> {{-- clause-title --}}
	<div class="clause-data">
		<span class="units">{{ number_format($player->season_player->price, 2, ',', '.') }}</span>
		<small class="measure">mill.</small>
	</div> {{-- clause-data --}}
	@if ($player->season_player->transferable)
		@if ($player->season_player->sale_price > 0)
			<div class="price-title">
				Precio
			</div> {{-- price-title --}}
			<div class="price-data">
				<span class="units">
					{{ number_format($player->season_player->sale_price, 2, ',', '.') }}
				</span>
				<small class="measure">mill.</small>
			</div> {{-- price-data --}}
		@else
			<div class="price-data">
				<span class="units">
					Transferible {{ $player->season_player->player_on_loan ? '& Cedible' : '' }}
				</span>
			</div> {{-- price-data --}}
		@endif
	@elseif ($player->season_player->player_on_loan)
		<div class="price-data">
			<span class="units">
				Cedible
			</span>
		</div> {{-- price-data --}}
	@endif
	<div class="buy-now">
		@if ($player->season_player->sale_price > 0 && $player->season_player->sale_auto_accept)
			<a class="btn btn-success btn-sm {{ participant_of_user()->id == $player->season_player->participant_id ? 'disabled' : '' }}" href="" onclick="sign_now_player('{{ $player->season_player->id }}', '{{ $player->season_player->player->name }}', '{{ number_format($player->season_player->sale_price, 2, ',', '.') }}')">
				Fichar ya!
			</a>
		@endif
		<a class="btn btn-primary btn-sm {{ participant_of_user()->id == $player->season_player->participant_id ? 'disabled' : '' }}" href="" >
			Abrir negociación
		</a>
	</div> {{-- buy-now --}}
</div> {{-- item --}}
<div class="item-bottom">
	@if ($player->season_player->market_phrase)
		<div class="phrase">
			<strong>{{ $player->season_player->participant->sub_name() }}</strong>: {{ $player->season_player->market_phrase }}
		</div>
	@endif
</div> {{-- item-bottom --}}
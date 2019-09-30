<div class="item-header clearfix">
	<div class="date">
		<i class="fas fa-history"></i>
		{{ $player->created_at->diffForHumans() }}
	</div>
</div> {{-- item-header --}}
<div class="item">
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
	@if ($player->participant_from > 0)
		<span class="icon-transfer-out">
			<i class="fas fa-sign-out-alt"></i>
		</span>
		<img class="participant-from-logo" src="{{ $player->participantFrom->logo() }}">
		<span class="participant-from-name">
			{{ $player->participantFrom->name() }}
		</span> {{-- participant-name --}}
		<span class="participant-from-subname">
			{{ $player->participantFrom->sub_name() }}
		</span> {{-- participant-subname --}}
	@else
		<span class="icon-transfer-out">
			<i class="fas fa-sign-out-alt"></i>
		</span>
		<img class="participant-from-logo" src="{{ asset('img/team_no_image.png') }}">
		<span class="participant-from-name none">
			jugadores libres
		</span> {{-- participant-name --}}
	@endif
	@if ($player->participant_to > 0)
		<span class="icon-transfer-in">
			<i class="fas fa-sign-in-alt"></i>
		</span>
		<img class="participant-to-logo" src="{{ $player->participantTo->logo() }}">
		<span class="participant-to-name">
			{{ $player->participantTo->name() }}
		</span> {{-- participant-name --}}
		<span class="participant-to-subname">
			{{ $player->participantTo->sub_name() }}
		</span> {{-- participant-subname --}}
	@else
		<span class="icon-transfer-in">
			<i class="fas fa-sign-in-alt"></i>
		</span>
		<img class="participant-to-logo" src="{{ asset('img/team_no_image.png') }}">
		<span class="participant-to-name none">
			jugadores libres
		</span> {{-- participant-name --}}
	@endif
	<img class="nation-logo" src="{{ asset($player->season_player->player->nation_flag()) }}" data-toggle="tooltip" data-placement="top" title="{{ $player->season_player->player->nation_name}}">
</div> {{-- item --}}
<div class="item-bottom">
	<div class="phrase" style="text-transform: uppercase;">
		@if ($player->type == 'free')
			<div class="clearfix">
				<strong class="float-left">Agente libre</strong>
				<span class="float-right">coste {{ number_format($player->price, 2, ',', '.') }} M.</span>
			</div>
		@endif
		@if ($player->type == 'negotiation')
			<div class="clearfix">
				<strong class="float-left">Negociación</strong>
			</div>
		@endif
		@if ($player->type == 'buynow')
			<div class="clearfix">
				<strong class="float-left">Venta directa</strong>
				<span class="float-right">coste {{ number_format($player->price, 2, ',', '.') }} M.</span>
			</div>
		@endif
		@if ($player->type == 'clause')
			<div class="clearfix">
				<strong class="float-left">Clausulazo!!!</strong>
				<span class="float-right">coste {{ number_format($player->price, 2, ',', '.') }} M.</span>
			</div>
		@endif
		@if ($player->type == 'cession')
			<div class="clearfix">
				<strong class="float-left">Cesión</strong>
			</div>
		@endif
		@if ($player->type == 'dismiss')
			<div class="clearfix">
				<strong class="float-left">Despido</strong>
				<span class="float-right">remuneración {{ number_format($player->price, 2, ',', '.') }} M.</span>
			</div>
		@endif
	</div>
</div> {{-- item-bottom --}}
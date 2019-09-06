<div class="item-header clearfix">
	<div class="type">
		@if ($player->type == 'free')
			<span class="text-primary">
				jugador libre
			</span>
		@endif
		@if ($player->type == 'negotiation')
			<span class="text-primary">
				Negociación
			</span>
		@endif
		@if ($player->type == 'clause')
			<span class="text-success" style="font-size: 1.25em">
				<i class="fab fa-paypal" style="font-weight: normal"></i>
				Clausulazo!!!
			</span>
		@endif
		@if ($player->type == 'cession')
			<span class="text-warning">
				Cesión
			</span>
		@endif
		@if ($player->type == 'dismiss')
			<span class="text-danger">
				Despido
			</span>
		@endif
	</div>
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
	<div class="overall" style="background: {{ $player->season_player->player->getOverallRatingColor() }};">
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
	<img class="nation-logo" src="https://cdn10.bigcommerce.com/s-ey7tq/products/3606/images/4932/FISPA-2__55833.1407859367.1280.1280.jpg?c=2" data-toggle="tooltip" data-placement="top" title="{{ $player->season_player->player->nation_name}}">
</div> {{-- item --}}
{{-- <div class="item-bottom">
	<div class="phrase">
		@if ($player->type == 'free')
			{{ $player->season_player->player->name }} se incorpora a la disciplina de {{ $player->participantTo->name() }}
		@endif
		@if ($player->type == 'negotiation')
				Negociación
		@endif
		@if ($player->type == 'clause')
				Clausulazo!!!
		@endif
		@if ($player->type == 'cession')
				Cesión
		@endif
		@if ($player->type == 'dismiss')
			{{ $player->season_player->player->name }} se va a cascarla a la bolsa de jugadores libres esperando que algún manager se apiade de el.
		@endif
	</div>
</div> --}} {{-- item-bottom --}}
<div class="modal-content">
    <div class="modal-header bg-light">
    	#{{ $player->id }} - {{ $player->name }}
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="border-bottom pb-2">
            @if ($player->playerDb)
                @if ($player->playerDb)
                    <small class="d-block">DATABASE: {{ $player->playerDb->name }}</small>
                @else
                    <small class="d-block">DATABASE: no definida</small>
                @endif
                @if ($player->game_id)
                    <small class="d-block">GAME ID: {{ $player->game_id }}</small>
                @endif
            @endif
        </div>
		<div class="text-center">
			<figure class="">
				<img src="{{ $player->getImgFormatted() }}" alt="" width="128">
			</figure>
			<h4 class="m-0">{{ $player->name }}</h4>
            <h5 class="m-0 p-2"><strong class="d-block">
                @if ($player->overall_rating)
                    {{ $player->overall_rating }}
                    @if ($player->position)
                        / {{ $player->position }}
                    @endif
                @else
                    @if ($player->position)
                        {{ $player->position }}
                    @endif
                @endif
            </strong></h5>
            <span class="d-block">
                @if ($player->nation_name)
                    {{ $player->nation_name }}
                    @if ($player->age)
                        / {{ $player->age }} años
                    @endif
                    @if ($player->height)
                        / {{ $player->height }} cm
                    @endif
                @else
                    @if ($player->age)
                        {{ $player->age }} años
                        @if ($player->height)
                            / {{ $player->height }} cm
                        @endif
                    @else
                        @if ($player->height)
                            {{ $player->height }} cm
                        @endif
                    @endif
                @endif
            </span>
            <span class="d-block">
                @if ($player->team_name)
                    {{ $player->team_name }}
                    @if ($player->league_name)
                        / {{ $player->league_name }}
                    @endif
                @else
                    @if ($player->league_name)
                        {{ $player->league_name }}
                    @endif
                @endif
            </span>
            @if ($player->game_id)
                <div class="border-top mt-2 pt-2">
                    <a class="d-block" target="_blank" href="http://pesdb.net/pes2019/?id={{ $player->game_id }}">ver en pesdb.net</a>
                    <a class="d-block" target="_blank" href="https://www.pesmaster.com/neymar/pes-2019/player/{{ $player->game_id }}">ver en pesmaster.com</a>
                </div>
            @endif
		</div>
    </div>
</div>
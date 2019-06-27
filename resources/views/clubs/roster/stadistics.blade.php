<div class="container p-3 border-bottom">
	<h5>Mejores jugadores</h5>
	@foreach ($top_players as $top_player)
	<div class="tops">
		<div class="img">
			<img src="{{ $top_player->player->getImgFormatted() }}" class="rounded-circle">
		</div>
		<div class="overall_rating">
			<span>{{ $top_player->player->overall_rating }}</span>
		</div>
		<div class="ball">
			<img src="{{ asset($top_player->player->getBall()) }}">
		</div>
		<div class="position">
			<span>{{ $top_player->player->position }}</span>
		</div>
		<div class="name">
			<span>{{ $top_player->player->name }}</span>
		</div>
	</div>
	@endforeach
</div>

<div class="container p-3 border-bottom">
	<h5>Mejores delanteros</h5>
	@foreach ($top_forws as $top_forw)
	<div class="tops">
		<div class="img">
			<img src="{{ $top_forw->player->getImgFormatted() }}" class="rounded-circle">
		</div>
		<div class="overall_rating">
			<span>{{ $top_forw->player->overall_rating }}</span>
		</div>
		<div class="ball">
			<img src="{{ asset($top_forw->player->getBall()) }}">
		</div>
		<div class="position">
			<span>{{ $top_forw->player->position }}</span>
		</div>
		<div class="name">
			<span>{{ $top_forw->player->name }}</span>
		</div>
	</div>
	@endforeach
</div>

<div class="container p-3 border-bottom">
	<h5>Mejores medios</h5>
	@foreach ($top_mids as $top_mid)
	<div class="tops">
		<div class="img">
			<img src="{{ $top_mid->player->getImgFormatted() }}" class="rounded-circle">
		</div>
		<div class="overall_rating">
			<span>{{ $top_mid->player->overall_rating }}</span>
		</div>
		<div class="ball">
			<img src="{{ asset($top_mid->player->getBall()) }}">
		</div>
		<div class="position">
			<span>{{ $top_mid->player->position }}</span>
		</div>
		<div class="name">
			<span>{{ $top_mid->player->name }}</span>
		</div>
	</div>
	@endforeach
</div>

<div class="container p-3 border-bottom">
	<h5>Mejores defensas</h5>
	@foreach ($top_defs as $top_def)
	<div class="tops">
		<div class="img">
			<img src="{{ $top_def->player->getImgFormatted() }}" class="rounded-circle">
		</div>
		<div class="overall_rating">
			<span>{{ $top_def->player->overall_rating }}</span>
		</div>
		<div class="ball">
			<img src="{{ asset($top_def->player->getBall()) }}">
		</div>
		<div class="position">
			<span>{{ $top_def->player->position }}</span>
		</div>
		<div class="name">
			<span>{{ $top_def->player->name }}</span>
		</div>
	</div>
	@endforeach
</div>

<div class="container p-3 border-bottom">
	<h5>Jugadores más jóvenes</h5>
	@foreach ($young_players as $young_player)
	<div class="tops">
		<div class="img">
			<img src="{{ $young_player->player->getImgFormatted() }}" class="rounded-circle">
		</div>
		<div class="age">
			<span>{{ $young_player->player->age }} años</span>
		</div>
		<div class="position">
			<span>{{ $young_player->player->position }}</span>
		</div>
		<div class="name">
			<span>{{ $young_player->player->name }}</span>
		</div>
	</div>
	@endforeach
</div>

<div class="container p-3">
	<h5>Jugadores más veteranos</h5>
	@foreach ($veteran_players as $veteran_player)
	<div class="tops">
		<div class="img">
			<img src="{{ $veteran_player->player->getImgFormatted() }}" class="rounded-circle">
		</div>
		<div class="age">
			<span>{{ $veteran_player->player->age }} años</span>
		</div>
		<div class="position">
			<span>{{ $veteran_player->player->position }}</span>
		</div>
		<div class="name">
			<span>{{ $veteran_player->player->name }}</span>
		</div>
	</div>
	@endforeach
</div>
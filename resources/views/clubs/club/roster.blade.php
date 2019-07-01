<div class="club-info">
	<h4 class="title-position">
		<div class="container clearfix">
			<span>Plantilla</span>
		</div>
	</h4>
	<div class="container p-3">
		<ul class="details">
			<li>
				Plantilla: <strong>{{ $participant->players->count() }} jugadores</strong>
			</li>
			<li>
				Edad media: <strong>{{ number_format($participant->team_avg_age(), 0) }} años</strong>
			</li>
			<li>
				Valoración media
			</li>
			<div class="single-chart">
				<svg viewBox="0 0 36 36" class="circular-chart orange">
					<path class="circle-bg"
					d="M18 2.0845
					a 15.9155 15.9155 0 0 1 0 31.831
					a 15.9155 15.9155 0 0 1 0 -31.831"
					/>
					<path class="circle"
					stroke-dasharray="{{ $participant->team_avg_overall() }}, 100"
					d="M18 2.0845
					a 15.9155 15.9155 0 0 1 0 31.831
					a 15.9155 15.9155 0 0 1 0 -31.831"
					/>
					<text x="18" y="20.35" class="percentage">
						{{ number_format($participant->team_avg_overall(), 2) }}
					</text>
				</svg>
			</div>
		</ul>
	</div>

	@if ($participant->players->count() > 0)
		<div class="container pb-3">
			<h5 class="p-2">Mejores jugadores</h5>
			@foreach ($participant->top_players() as $top_player)
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

		<div class="container pb-3">
			<h5 class="p-2">Mejores delanteros</h5>
			@foreach ($participant->top_forws() as $top_forw)
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

		<div class="container pb-3">
			<h5 class="p-2">Mejores medios</h5>
			@foreach ($participant->top_mids() as $top_mid)
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

		<div class="container pb-3">
			<h5 class="p-2">Mejores defensas</h5>
			@foreach ($participant->top_defs() as $top_def)
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

		<div class="container pb-3">
			<h5 class="p-2">Jugadores más jóvenes</h5>
			@foreach ($participant->young_players() as $young_player)
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

		<div class="container pb-3">
			<h5 class="p-2">Jugadores más veteranos</h5>
			@foreach ($participant->veteran_players() as $veteran_player)
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
	@endif
</div>
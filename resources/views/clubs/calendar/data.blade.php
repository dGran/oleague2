<h4 class="title-position border-bottom">
	<div class="container clearfix">
		<span>CALENDARIO DE PARTIDOS</span>
	</div>
</h4>

<div class="calendar container">
	@foreach ($matches as $match)
		<div class="item">
			<div class="title">
				<span class="match-name">{{ $match->match_name() }}</span>
				<span class="rival">Rival:
					@if ($match->local_participant->participant->user->id == $participant->user->id)
						{{ $match->visitor_participant->participant->user->name }}
					@else
						{{ $match->local_participant->participant->user->name }}
					@endif
				</span>
			</div>
			<div class="row align-items-center">
				<div class="col local">
					<center>
						<img class="team-logo" src="{{ $match->local_participant->participant->logo() }}" alt="">
						<span class="team-name text-truncate">{{ $match->local_participant->participant->name() }}</span>
					</center>
				</div>
				<div class="col info">
					<center>
						<img class="logo rounded-circle shadow-sm" src="{{ $match->competition()->getImgFormatted() }}" alt="" width="24">
						@if ($match->winner() == -1)
							<span class="date">
								{{ \Carbon\Carbon::parse($match->date_limit)->format('j F') }}
							</span>
							<span class="time">
								{{ \Carbon\Carbon::parse($match->date_limit)->format('H:i') }}
							</span>
						@else
							<a href="{{ route("competitions.calendar.match.details", [$season->slug, $match->competition()->slug, $match->id]) }}" class="result form-control" onclick="view_match_detail(this)">
								{{ $match->local_score }} - {{ $match->visitor_score }}
							</a>
							<span class="result-register mt-1">
								Resultado registrado
								<span class="d-block">{{ \Carbon\Carbon::parse($match->update_at)->format('j F H:i') }}</span>
							</span>
						@endif
					</center>
				</div>
				<div class="col visitor">
					<center>
						<img class="team-logo" src="{{ $match->visitor_participant->participant->logo() }}" alt="">
						<span class="team-name text-truncate">{{ $match->visitor_participant->participant->name() }}</span>
					</center>
				</div>
			</div>
				<div class="competition-link">
					<a href="{{ route('competitions.calendar', [$season->slug, $match->competition()->slug, $match->group()->phase_slug_if_necesary(), $match->group()->group_slug_if_necesary()]) }}" class="btn btn-link form-control shadow-sm">
						{{ $match->competition()->name }}
					</a>
				</div>
		</div>
	@endforeach
</div>
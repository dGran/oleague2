<h4 class="title-position border-bottom">
	<div class="container clearfix">
		<span>PARTIDAS PENDIENTES {{ $participant->name() }} - {{ active_season()->name }}</span>
	</div>
</h4>

<div class="container p-3">
	@foreach ($matches as $match)
		@if ($match->winner() == -1 && $match->active)
			<div class="match-item">
				<a href="{{ route('competitions.calendar', [active_season()->id, $match->competition()->slug, $match->group()->phase_slug_if_necesary(), $match->group()->group_slug_if_necesary()]) }}">

					<div class="description">
						<img src="{{ $match->competition()->getImgFormatted() }}" alt="" width="24" class="rounded">
						<small class="text-muted pl-1">{{ $match->match_name() }}</small>
					</div>
					<div class="match text-dark">
						<span class="text-dark">{{ $match->local_participant->participant->name() }}</span>
						<img src="{{ $match->local_participant->participant->logo() }}" alt="" width="16">
						<strong class="px-2">
							@if ($match->winner() == -1)
								vs
							@else
		    					{{ $match->local_score }} - {{ $match->visitor_score }}
							@endif
						</strong>
						<img src="{{ $match->visitor_participant->participant->logo() }}" alt="" width="16">
						<span class="text-dark">{{ $match->visitor_participant->participant->name() }}</span>
					</div>
					<div class="bottom-data clearfix shadow-sm">
						<div class="float-left">
							<div class="type">
								@if ($match->winner() == -1)
									<small class="text-muted">
										<strong class="px-1">N/D</strong>
										- No disputado
									</small>
								@elseif ($match->winner() == 0)
									<small class="text-warning">
										<strong class="px-1">E</strong>
										- Empate
									</small>
								@elseif ($match->winner() == $participant->id)
									<small class="text-success">
										<strong class="px-1">V</strong>
										- Victoria
									</small>
								@else
									<small class="text-danger">
										<strong class="px-1">D</strong>
										- Derrota
									</small>
								@endif
							</div>
						</div>
						<div class="float-right">
							<div class="limit text-muted" style="min-width: 80px">
								<small class="text-muted">
									<strong class="mr-1">Fecha Límite</strong>
									{{ \Carbon\Carbon::parse($match->date_limit)->format('d/m/Y - h:m')}}
								</small>
							</div>
						</div>
					</div>
				</a>
			</div>
		@endif
	@endforeach
</div>
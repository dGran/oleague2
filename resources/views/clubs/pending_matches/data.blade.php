<h4 class="title-position border-bottom">
	<div class="container clearfix">
		<span class="d-block">PARTIDAS PENDIENTES {{ $participant->name() }}</span>
		<span>{{ active_season()->name }}</span>
	</div>
</h4>

<div class="container p-3">
	@foreach ($matches as $match)
		@if ($match->winner() == -1 && $match->active)
			<a href="{{ route('competitions.calendar', [active_season()->id, $match->competition()->slug, $match->group()->phase_slug_if_necesary(), $match->group()->group_slug_if_necesary()]) }}">
				<div class="match-item">
					<div class="description">
						<img src="{{ $match->competition()->getImgFormatted() }}" alt="" width="24" class="rounded">
						<small class="text-muted pl-1">{{ $match->match_name() }}</small>
					</div>
					<div class="rival text-dark">
						@if ($match->local_participant->participant->id == $participant->id)
							<img src="{{ $participant->logo() }}" alt="" width="40" class="align-middle">
							<h4 class="d-inline-block m-0 px-1">vs</h4>
							<img src="{{ $match->visitor_participant->participant->logo() }}" alt="" width="40" class="align-middle">
							<div class="d-inline-block align-middle pl-2">
								<span class="text-dark d-block">{{ $match->visitor_participant->participant->name() }}</span>
								<small class="text-muted">{{ $match->visitor_participant->participant->sub_name() }}</small>
							</div>
						@else
							<img src="{{ $match->local_participant->participant->logo() }}" alt="" width="40" class="align-middle">
							<h4 class="d-inline-block m-0 px-1">vs</h4>
							<img src="{{ $participant->logo() }}" alt="" width="40" class="align-middle">
							<div class="d-inline-block align-middle pl-2">
								<span class="text-dark d-block">{{ $match->local_participant->participant->name() }}</span>
								<small class="text-muted">{{ $match->local_participant->participant->sub_name() }}</small>
							</div>
						@endif
					</div>
	            	<div class="bottom-data text-center p-2">
	            		@if ($match->date_limit_match())
							<small class="text-muted d-block">
								<strong class="mr-1">Fecha Límite</strong>
								{{ \Carbon\Carbon::parse($match->date_limit_match())->format('j M, H:i') }}
							</small>
						@endif
						<h5 class="limit m-0 p-0">
							@if ($match->date_limit_match())
								@if ($match->date_limit_match() > now())
									<span class="text-success">Dentro del plazo</span>
								@else
									<span class="text-danger">Fuera de plazo!</span>
								@endif
							@else
								<span class="text-muted">Plazo no establecido</span>
							@endif
						</h5>
					</div>
				</div>
			</a>
		@endif
	@endforeach
</div>
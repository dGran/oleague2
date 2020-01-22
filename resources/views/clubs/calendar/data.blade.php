<h4 class="title-position border-bottom">
	<div class="container clearfix">
		<span>Caledario</span>
	</div>
</h4>

<div class="container p-3">
	@foreach ($matches as $match)
		<div class="match-item">
			<div class="description">
				<img src="{{ $match->competition()->getImgFormatted() }}" alt="" width="32">
				<small class="text-muted pl-1">{{ $match->match_name() }}</small>
			</div>
			<div class="match">
				{{ $match->local_participant->participant->name() }}
				<img src="{{ $match->local_participant->participant->logo() }}" alt="" width="16">
				<strong class="px-1">
					@if ($match->winner() == -1)
						vs
					@else
						{{ $match->local_score }} - {{ $match->visitor_score }}
					@endif
				</strong>
				<img src="{{ $match->visitor_participant->participant->logo() }}" alt="" width="16">
				{{ $match->visitor_participant->participant->name() }}
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
						<small class="text-muted d-block">
							<strong class="mr-1">Fecha Límite</strong>
							{{ \Carbon\Carbon::parse($match->date_limit)->format('d/m/Y - h:m')}}
						</small>
					</div>
				</div>
			</div>
		</div>
	@endforeach
</div>
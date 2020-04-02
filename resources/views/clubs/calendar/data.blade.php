<div class="title-position">
	<div class="container clearfix">
		<h4>CALENDARIO DE PARTIDOS</h4>
	</div>
</div>

<div class="container p-3">
	<div class="calendar">
	@foreach ($matches as $match)
		<div class="item shadow-sm" onmouseenter="item_enter({{$match->id}})" onmouseleave="item_leave({{$match->id}})">
			@if (!is_null($match->day_id))
				@if ($match->date_limit > $match->day->date_limit)
					<div class="ribbon left info"><span>Plazo ampliado</span></div>
				@endif
			@else
				@if ($match->date_limit > $match->clash->round->date_limit)
					<div class="ribbon left info"><span>Plazo ampliado</span></div>
				@endif
			@endif
			<div class="row align-items-center">
				<div class="col local">
					<img class="team-logo" src="{{ $match->local_participant->participant->logo() }}" alt="">
					<br>
					<span class="team-name">{{ $match->local_participant->participant->name() }}</span>
				</div>
				<div class="col order-md-first match-info">
					<div class="competition">
						<div class="row align-items-center">
							<div class="col-auto">
								<img class="logo" src="{{ $match->competition()->getImgFormatted() }}" alt="" width="18">
							</div>
							<div class="col-auto align-middle">
								<span class="name">{{ $match->match_name_array()['competition'] }}</span>
								@if (isset($match->match_name_array()['group']))
									<span class="group">{{ $match->match_name_array()['group'] }}</span>
								@endif
								@if ($match->day_id)
									@if (isset($match->match_name_array()['day']))
										<span class="day">Jornada {{ $match->match_name_array()['day'] }}</span>
									@endif
								@else
									@if (isset($match->match_name_array()['round']))
										<span class="round">{{ $match->match_name_array()['round'] }}</span>
									@endif
									@if (isset($match->match_name_array()['match']))
										<span class="match">{{ $match->match_name_array()['match'] }}</span>
									@endif
								@endif
								<span class="date-limit {{ ($match->winner() == -1) ? 'd-block' : 'd-none' }}">
									<strong>Plazo: </strong>
									{{ \Carbon\Carbon::parse($match->date_limit_match())->format('j M, H:i') }}</span>
							</div>
						</div>
					</div>
					@if (!($match->winner() == -1))
						<a class="d-inline-block d-md-none btn btn-link result" href="{{ route("competitions.calendar.match.details", [$season->slug, $match->competition()->slug, $match->id]) }}" onclick="view_match_detail(this)">
							{{ $match->local_score }} - {{ $match->visitor_score }}
						</a>
					@endif
				</div>
				<div class="col-md-auto d-none d-md-block vs">
						@if ($match->winner() == -1)
							<strong class="blank-result">Vs</strong>
						@else
							<a href="{{ route("competitions.calendar.match.details", [$season->slug, $match->competition()->slug, $match->id]) }}" class="btn btn-link result" onclick="view_match_detail(this)">
								{{ $match->local_score }} - {{ $match->visitor_score }}
							</a>
						@endif
				</div>
				<div class="col visitor">
					<img class="team-logo" src="{{ $match->visitor_participant->participant->logo() }}" alt="">
					<br>
					<span class="team-name">{{ $match->visitor_participant->participant->name() }}</span>
				</div>
			</div>
			<div class="competition-link" id="competition_link{{$match->id}}">
				<a href="{{ route('competitions.calendar', [$season->slug, $match->competition()->slug, $match->group()->phase_slug_if_necesary(), $match->group()->group_slug_if_necesary()]) }}" class="btn btn-link form-control">
					{{ $match->competition()->name }}
				</a>
			</div>
		</div>
	@endforeach
	</div>
</div>
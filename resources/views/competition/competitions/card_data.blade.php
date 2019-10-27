<div class="col-12 col-md-6 col-lg-4">
	<div class="border" style="background: #fff; margin: 15px 5px 0 5px; padding: 1em 0">
		<div class="text-center d-table-cell" style="width: 170px">
			<a class="text-dark" href="{{ route('competitions.competition.table', [active_season()->slug, $competition->slug]) }}">
				<img src="{{ asset($competition->img) }}" width="72px" class="rounded">
				<span class="d-block mt-1" style="font-size: .9em; font-weight: bold">{{ $competition->name }}</span>
			</a>
		</div>
		<div class="d-table-cell border-left align-top ">
			<ul style="font-size: .9em; padding: 0 1em; list-style: none; line-height: 1.4rem">
				<li>
					<a class="text-dark" href="{{ route('competitions.competition.table', [active_season()->slug, $competition->slug]) }}">
						<i class="fas fa-caret-right mr-1" style="color: #89be38"></i>
						Clasificación
					</a>
				</li>
				<li>
					<a class="text-dark" href="{{ route('competitions.competition.calendar', [active_season()->slug, $competition->slug]) }}">
						<i class="fas fa-caret-right mr-1" style="color: #89be38"></i>
						Partidos
					</a>
				</li>
				<li>
					<a class="text-dark" href="{{ route('competitions.competition.stats', [active_season()->slug, $competition->slug]) }}">
						<i class="fas fa-caret-right mr-1" style="color: #89be38"></i>
						Estadísticas
					</a>
				</li>
			</ul>
		</div>
	</div>
</div>
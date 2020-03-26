<div class="col-12 col-lg-6">
	<a class="text-dark {{ !$competition->initialPhase()->active ? 'disabled' : '' }}" href="{{ route('competitions.table', [$season_slug, $competition->slug]) }}">
		<div class="competition-item shadow-sm">
			<div class="logo">
				<img src="{{ $competition->getImgFormatted() }}">
			</div>
			<div class="links">
				<h5>{{ $competition->name }}</h5>
				<ul>
					<li>
						<a class="text-secondary {{ !$competition->initialPhase()->active ? 'disabled' : '' }}" href="{{ route('competitions.table', [$season_slug, $competition->slug]) }}">
							<i class="fas fa-caret-right mr-1" style="color: #89be38"></i>
							{{ $competition->initialPhase()->mode == 'league' ? 'Clasificación' : 'PlayOffs' }}
						</a>
					</li>
					<li>
						<a class="text-secondary {{ !$competition->initialPhase()->active ? 'disabled' : '' }}" href="{{ route('competitions.calendar', [$season_slug, $competition->slug]) }}">
							<i class="fas fa-caret-right mr-1" style="color: #89be38"></i>
							Partidos
						</a>
					</li>
					<li>
						<a class="text-secondary {{ !$competition->initialPhase()->active ? 'disabled' : '' }}" href="{{ route('competitions.stats', [$season_slug, $competition->slug]) }}">
							@if ($competition->initialPhase()->mode == 'league')
								@if ($competition->initialPhase()->initialGroup()->league && $competition->initialPhase()->initialGroup()->league->has_stats())
									<i class="fas fa-caret-right mr-1" style="color: #89be38"></i>
									Estadísticas
								@endif
							@else
								@if ($competition->initialPhase()->initialGroup()->league && $competition->initialPhase()->initialGroup()->playoff->has_stats())
									<i class="fas fa-caret-right mr-1" style="color: #89be38"></i>
									Estadísticas
								@endif
							@endif
						</a>
					</li>
				</ul>
			</div>
		</div>
	</a>
</div>
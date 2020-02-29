<div class="container">
	<div class="scrolling-wrapper">
		<ul>
			<li class="item {{ \Route::current()->getName() == 'market' ? 'active' : '' }}">
				<a href="{{ route('market', $season_slug) }}">
					<i class="icon-transfer"></i>
					<span>Resumen</span>
				</a>
			</li>
			<li class="item {{ \Route::current()->getName() == 'market.agreements' ? 'active' : '' }}">
				<a href="{{ route('market.agreements', $season_slug) }}">
					<i class="icon-agreement"></i>
					<span>Acuerdos</span>
				</a>
			</li>
			<li class="item {{ \Route::current()->getName() == 'market.search' ? 'active' : '' }}">
				<a href="{{ route('market.search', $season_slug) }}">
					<i class="icon-search-player"></i>
					<span>Buscador</span>
				</a>
			</li>
			<li class="item {{ \Route::current()->getName() == 'market.sale' ? 'active' : '' }}">
				<a href="{{ route('market.sale', $season_slug) }}">
					<i class="icon-sale"></i>
					<span>Escaparate</span>
				</a>
			</li>
			<li class="item {{ \Request::is('mercado/equipos*') ? 'active' : '' }}">
				<a href="{{ route('market.teams', $season_slug) }}">
					<i class="icon-teams"></i>
					<span>Equipos</span>
				</a>
			</li>

			@if (auth()->user() && user_is_participant(auth()->user()->id))
				<li class="item new-section {{ \Route::current()->getName() == 'market.my_team' ? 'active' : '' }}">
					<a href="{{ route('market.my_team') }}">
						<i class="icon-my-team"></i>
						<span>Mi equipo</span>
					</a>
				</li>
				<li class="item {{ \Request::is('mercado/negociaciones*') ? 'active' : '' }} {{ !active_season()->transfers_period ? 'd-none' : '' }}">
					<a href="{{ route('market.trades') }}">
						<i class="icon-negotiation"></i>
						<span>Negocios</span>
						@if (participant_of_user()->trades_received_pending() > 0)
							<span class="counter badge badge-danger rounded-circle">
								{{ participant_of_user()->trades_received_pending() }}
							</span>
						@endif
					</a>
				</li>
				<li class="item {{ \Route::current()->getName() == 'market.favorites' ? 'active' : '' }}">
					<a href="{{ route('market.favorites', $season_slug) }}">
						<i class="fas fa-heart"></i>
						<span>Favoritos</span>
					</a>
				</li>
			@endif

		</ul>
	</div>
</div>

@if ($seasons->count()>1)
	@if (\Route::current()->getName() == 'market' || \Route::current()->getName() == 'market.agreements' || \Route::current()->getName() == 'market.search' || \Route::current()->getName() == 'market.sale' || \Route::current()->getName() == 'market.teams' || \Route::current()->getName() == 'market.favorites')
		<div class="season-selector">
			<div class="container px-3">
				<label for="season_selector">Temporada</label>
				<select class="selectpicker btn-light" id="season_selector">
					@foreach ($seasons as $season)
						<option {{ $season->slug == $season_slug ? 'selected' : '' }} value="{{ route(\Route::current()->getName(), $season->slug) }}">
							<span>{{ $season->name }}</span>
							@if ($season->id == active_season()->id)
								<small>(activa)</small>
							@endif
						</option>
					@endforeach
				</select>
			</div>
		</div>
	@endif
@endif

<script>
	jQuery(function($) {
		$('#season_selector').on('change', function() {
			var url = $(this).val();
			if (url) {
				window.location = url;
			}
			return false;
		});
	});
</script>
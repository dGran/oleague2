<div class="teams">

	<div class="header">
		<div class="container">
			<h2 class="text-center">
				Listado de equipos
			</h2>
		</div> {{-- container --}}
	</div> {{-- header --}}

	@if ($seasons->count()>1)
		<div class="season-selector">
			<div class="container px-3">
				<label for="season_selector">Temporada</label>
				<select class="selectpicker btn-light" id="season_selector">
					@foreach ($seasons as $season)
						<option {{ $season->slug == $season_slug ? 'selected' : '' }} value="{{ route('market.teams', $season->slug) }}">
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

	<section class="content">
		<div class="container">
			<div class="row pb-4 px-2">
			@foreach ($participants as $participant)
				<div class="col-12 col-md-6 col-lg-4 col-xl-3">
					@include('market.teams.card_data')
				</div>
			@endforeach
			</div>
		</div>
	</section> {{-- content --}}

</div> {{-- teams --}}

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
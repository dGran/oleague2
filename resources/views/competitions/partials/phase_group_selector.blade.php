@if ($competition->phases->count()>1 || $group->phase->groups->count()>1)
	<div class="competition-phase-group-selector">
		<div class="container px-3 px-md-0">
			@if ($competition->phases->count()>1 && $group->phase->groups->count()>1)
				<div class="row justify-content-center">
			@else
				<div class="row">
			@endif
				@if ($competition->phases->count()>1)
					<div class="col-6 col-md-5 col-lg-4">
						<label for="season_selector">Fase</label>
						<select class="selectpicker btn-light form-control" id="phase_selector">
							@foreach ($competition->phases as $phase)
								@if (\Route::current()->getName() == 'competitions.table')
									<option {{ $phase->id == $group->phase->id ? 'selected' : '' }} value="{{ route('competitions.table', [active_season()->slug, $group->phase->competition->slug, $phase->slug]) }}">
										{{ $phase->name }}
									</option>
								@endif
								@if (\Route::current()->getName() == 'competitions.calendar')
									<option {{ $phase->id == $group->phase->id ? 'selected' : '' }} value="{{ route('competitions.calendar', [active_season()->slug, $group->phase->competition->slug, $phase->slug]) }}">
										{{ $phase->name }}
									</option>
								@endif
								@if (\Route::current()->getName() == 'competitions.stats')
									<option {{ $phase->id == $group->phase->id ? 'selected' : '' }} value="{{ route('competitions.stats', [active_season()->slug, $group->phase->competition->slug, $phase->slug]) }}">
										{{ $phase->name }}
									</option>
								@endif
							@endforeach
						</select>
					</div>
				@endif
				@if ($group->phase->groups->count()>1)
					<div class="col-6 col-md-5 col-lg-4">
						<label for="season_selector">Grupo</label>
						<select class="selectpicker btn-light form-control" id="group_selector">
							@foreach ($group->phase->groups as $groupe)
								@if (\Route::current()->getName() == 'competitions.table')
									<option {{ $groupe->id == $group->id ? 'selected' : '' }} value="{{ route('competitions.table', [active_season()->slug, $group->phase->competition->slug, $group->phase->slug, $groupe->slug]) }}">
										{{ $groupe->name }}
									</option>
								@endif
								@if (\Route::current()->getName() == 'competitions.calendar')
									<option {{ $groupe->id == $group->id ? 'selected' : '' }} value="{{ route('competitions.calendar', [active_season()->slug, $group->phase->competition->slug, $group->phase->slug, $groupe->slug]) }}">
										{{ $groupe->name }}
									</option>
								@endif
								@if (\Route::current()->getName() == 'competitions.stats')
									<option {{ $groupe->id == $group->id ? 'selected' : '' }} value="{{ route('competitions.stats', [active_season()->slug, $group->phase->competition->slug, $group->phase->slug, $groupe->slug]) }}">
										{{ $groupe->name }}
									</option>
								@endif
							@endforeach
						</select>
					</div>
				@endif
			</div> {{-- row --}}
		</div> {{-- content --}}
	</div> {{-- phase-group-selector --}}
@endif

<script>
	jQuery(function($) {
		$('#group_selector').on('change', function() {
			var url = $(this).val();
			if (url) {
				window.location = url;
			}
			return false;
		});
		$('#phase_selector').on('change', function() {
			var url = $(this).val();
			if (url) {
				window.location = url;
			}
			return false;
		});
	});
</script>
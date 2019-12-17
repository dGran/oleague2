@if ($competition->phases->count()>1 || $group->phase->groups->count()>1)
	<div class="competition-phase-group-selector">
		<div class="container">
			@if ($competition->phases->count()>1)
				<select name="" id="" class="selectpicker">
					@foreach ($competition->phases as $phase)
						<option {{ $phase->id == $group->phase->id ? 'selected' : '' }} value="">
							{{ $phase->name }}
						</option>
					@endforeach
				</select>
			@endif
			@if ($group->phase->groups->count()>1)
				<select class="selectpicker" id="group_selector">
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
			@endif
		</div>
	</div>
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
	});
</script>
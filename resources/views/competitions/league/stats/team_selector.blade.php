<div class="team-selector">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-12 col-md-10 col-lg-8 px-3 px-md-0 py-3">

				<select class="selectpicker btn-light form-control" id="participant_selector">
					<option {{ $participant_id == 0 ? 'selected' : '' }} value="{{ route('competitions.stats', [$group->phase->competition->season->slug, $group->phase->competition->slug]) }}">
						Todos los equipos
					</option>
					@foreach ($league->group->participants as $participant)
						<option {{ $participant->participant->id == $participant_id ? 'selected' : '' }} value="{{ route('competitions.stats', [$group->phase->competition->season->slug, $group->phase->competition->slug, $participant->participant->id]) }}">
							{{ $participant->participant->name() }}
						</option>
					@endforeach
				</select>

			</div>
		</div>
	</div>
</div>

<script>
	jQuery(function($) {
		$('#participant_selector').on('change', function() {
			var url = $(this).val();
			if (url) {
				window.location = url;
			}
			return false;
		});
	});
</script>
<div class="container">
	<div class="row justify-content-center">
		<div class="col-12 col-md-10 col-lg-8 px-0 py-0 py-md-4">
			@if ($playoff->rounds->count() == 0)
			    <div class="text-center py-4">
		            <figure>
		                <img src="{{ asset('img/table-empty.png') }}" alt="" width="72">
		            </figure>
		            Actualmente no existen rondas
			    </div>
			@else
			    <table class="calendar">
					@foreach ($playoff->rounds as $round)
						@if ($round->num_matches_count() > 0)
							<tr class="days">
								<td colspan="2" class="px-3 px-md-0 py-2">
									<strong class="text-uppercase">{{ $round->name }}</strong>
								</td>
								<td colspan="3" class="px-3 px-md-0 py-2 text-right">
									@if ($round->date_limit)
										<small class="text-muted">
											<strong>Fecha límite: </strong>{{ \Carbon\Carbon::parse($round->date_limit)->format('j M, H:i') }}
										</small>
									@else
										<small class="text-muted">
											<strong>Fecha límite no definida</strong>
										</small>
									@endif
								</td>
							</tr>
							@if ($round->round_trip)
								@include('competitions.playoffs.calendar.matches_round_trip')
							@else
								@include('competitions.playoffs.calendar.matches_singular')
							@endif
						@endif
					@endforeach
			    </table>
			@endif
		</div>
	</div>
</div>
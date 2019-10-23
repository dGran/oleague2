<div class="container">
	<div class="row justify-content-center">
		<div class="col-12 col-md-10 col-lg-8 px-0 py-3">
			@if ($league->stats_goals)
				<h4 class="mt-4 mx-2">
					<small><i class="icon-soccer-ball mr-1"></i></small>
					Goleadores
				</h4>

				@if ($stats_goals->count() > 0)
					<table class="table">
						<thead>
							<tr>
								<th>Pos</th>
								<th colspan="2">Jugador</th>
								<th class="text-center">
									<i class="icon-soccer-ball"></i>
								</th>
							</tr>
						</thead>
						<tbody>
						@foreach ($stats_goals as $stat)
							<tr>
								<td width="24" class="text-right align-middle">
									{{ $loop->iteration }}
								</td>
								<td width="32" class="pl-2 text-center">
									<img src="{{ $stat->player->player->getImgFormatted() }}" alt="" width="{{ $loop->iteration == 1 ? 48 : 32}}">
								</td>
								<td>
									{{ $stat->player->player->name }}
									<small class="d-block">
										{{ $stat->player->participant->name() }}
									</small>
								</td>
								<td width="48" class="text-center align-middle">
									{{ $stat->goals }}
								</td>
							</tr>
						@endforeach
						</tbody>
					</table>
				@else
					<p class="mx-3">No hay datos registrados</p>
				@endif
			@endif

			@if ($league->stats_assists)
				<h4 class="mt-4 mx-2">
					<i class="icon-soccer_assist mr-1"></i>
					Asistencias
				</h4>
				@if ($stats_assists->count() > 0)
					<table class="table">
						<thead>
							<tr>
								<th>Pos</th>
								<th colspan="2">Jugador</th>
								<th class="text-center">
									<i class="icon-soccer_assist"></i>
								</th>
							</tr>
						</thead>
						<tbody>
						@foreach ($stats_assists as $stat)
							<tr>
								<td width="24" class="text-right align-middle">
									{{ $loop->iteration }}
								</td>
								<td width="32" class="pl-2">
									<img src="{{ $stat->player->player->getImgFormatted() }}" alt="" width="32">
								</td>
								<td>
									{{ $stat->player->player->name }}
									<small class="d-block">
										{{ $stat->player->participant->name() }}
									</small>
								</td>
								<td width="48" class="text-center align-middle">
									{{ $stat->assists }}
								</td>
							</tr>
						@endforeach
						</tbody>
					</table>
				@else
					<p class="mx-3">No hay datos registrados</p>
				@endif
			@endif

			@if ($league->stats_yellow_cards)
				<h4 class="mt-4 mx-2">
					<i class="icon-soccer_card text-warning mr-1"></i>
					Tarjetas Amarillas
				</h4>
				@if ($stats_yellow_cards->count() > 0)
					<table class="table">
						<thead>
							<tr>
								<th>Pos</th>
								<th colspan="2">Jugador</th>
								<th class="text-center">
									<i class="icon-soccer_card text-warning"></i>
								</th>
							</tr>
						</thead>
						<tbody>
						@foreach ($stats_yellow_cards as $stat)
							<tr>
								<td width="24" class="text-right align-middle">
									{{ $loop->iteration }}
								</td>
								<td width="32" class="pl-2">
									<img src="{{ $stat->player->player->getImgFormatted() }}" alt="" width="32">
								</td>
								<td>
									{{ $stat->player->player->name }}
									<small class="d-block">
										{{ $stat->player->participant->name() }}
									</small>
								</td>
								<td width="48" class="text-center align-middle">
									{{ $stat->yellow_cards }}
								</td>
							</tr>
						@endforeach
						</tbody>
					</table>
				@else
					<p class="mx-3">No hay datos registrados</p>
				@endif
			@endif

			@if ($league->stats_red_cards)
				<h4 class="mt-4 mx-2">
					<i class="icon-soccer_card text-danger mr-1"></i>
					Tarjetas Rojas
				</h4>
				@if ($stats_red_cards->count() > 0)
					<table class="table">
						<thead>
							<tr>
								<th>Pos</th>
								<th colspan="2">Jugador</th>
								<th class="text-center">
									<i class="icon-soccer_card text-danger"></i>
								</th>
							</tr>
						</thead>
						<tbody>
						@foreach ($stats_red_cards as $stat)
							<tr>
								<td width="24" class="text-right align-middle">
									{{ $loop->iteration }}
								</td>
								<td width="32" class="pl-2">
									<img src="{{ $stat->player->player->getImgFormatted() }}" alt="" width="32">
								</td>
								<td>
									{{ $stat->player->player->name }}
									<small class="d-block">
										{{ $stat->player->participant->name() }}
									</small>
								</td>
								<td width="48" class="text-center align-middle">
									{{ $stat->red_cards }}
								</td>
							</tr>
						@endforeach
						</tbody>
					</table>
				@else
					<p class="mx-3">No hay datos registrados</p>
				@endif
			@endif
		</div>
	</div>
</div>
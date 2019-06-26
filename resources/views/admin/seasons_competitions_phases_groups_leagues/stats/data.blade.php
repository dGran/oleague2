<div class="table-form-content mt-3 table-results col-12 col-xl-9 animated fadeIn">
	@if ($league->stats_goals)
		<h4 class="mt-4">
			<i class="fas fa-futbol mr-1"></i>
			Goleadores
		</h4>

		@if ($stats_goals->count() > 0)
			<table class="table">
				<thead>
					<tr>
						<th>Pos</th>
						<th colspan="2">Jugador</th>
						<th class="text-center">
							<i class="fas fa-futbol"></i>
						</th>
					</tr>
				</thead>
				<tbody>
				@foreach ($stats_goals as $stat)
					<tr>
						<td width="24" class="text-right">
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
						<td width="48" class="text-center">
							{{ $stat->goals }}
						</td>
					</tr>
				@endforeach
				</tbody>
			</table>
		@else
			<p>No hay datos registrados</p>
		@endif
	@endif

	@if ($league->stats_assists)
		<h4 class="mt-4">
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
						<td width="24" class="text-right">
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
						<td width="48" class="text-center">
							{{ $stat->assists }}
						</td>
					</tr>
				@endforeach
				</tbody>
			</table>
		@else
			<p>No hay datos registrados</p>
		@endif
	@endif

	@if ($league->stats_yellow_cards)
		<h4 class="mt-4">
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
						<td width="24" class="text-right">
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
						<td width="48" class="text-center">
							{{ $stat->yellow_cards }}
						</td>
					</tr>
				@endforeach
				</tbody>
			</table>
		@else
			<p>No hay datos registrados</p>
		@endif
	@endif

	@if ($league->stats_red_cards)
		<h4 class="mt-4">
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
						<td width="24" class="text-right">
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
						<td width="48" class="text-center">
							{{ $stat->red_cards }}
						</td>
					</tr>
				@endforeach
				</tbody>
			</table>
		@else
			<p>No hay datos registrados</p>
		@endif
	@endif
</div>
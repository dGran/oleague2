<div class="row justify-content-center">
	<div class="col-12 col-md-10 col-lg-8 p-0">
		<span class="table-stats-title">ESTADISTICAS</span>
		<div class="table-stats">
			<div class="item">
				<table width="100%" cellspacing="0" cellpadding="8">
					<tr>
						<td>
							<i class="fas fa-caret-right pr-1 pb-2 text-warning"></i><strong class="text-success">Equipo más goleador</strong>
							<div class="py-1 pl-3">
								<img src="{{ asset($table_participants->sortByDesc('gf')->first()['participant']->participant->logo()) }}" alt="" width="20" class="mr-1">
								<span>{{ $table_participants->sortByDesc('gf')->first()['participant']->participant->name() }}</span>
							</div>
						</td>
						<td class="text-right">
							<span class="text-dark">{{ $table_participants->sortByDesc('gf')->first()['gf'] }} goles</span>
							@if ($table_participants->sortByDesc('gf')->first()['pj'] > 0)
								<small class="d-block pt-1">
									{{ number_format($table_participants->sortByDesc('gf')->first()['gf'] / $table_participants->sortByDesc('gf')->first()['pj'], 2, ',', '.') }} / partido
								</small>
							@endif
						</td>
					</tr>
				</table>
			</div>
			<div class="item">
				<table width="100%" cellspacing="0" cellpadding="8">
					<tr>
						<td>
							<i class="fas fa-caret-right pr-1 pb-2 text-warning"></i><strong class="text-success">Equipo menos goleado</strong>
							<div class="py-1 pl-3">
								<img src="{{ asset($table_participants->sortBy('gc')->first()['participant']->participant->logo()) }}" alt="" width="20" class="mr-1">
								<span>{{ $table_participants->sortBy('gc')->first()['participant']->participant->name() }}</span>
							</div>
						</td>
						<td class="text-right">
							<span class="text-dark">{{ $table_participants->sortBy('gc')->first()['gc'] }} goles</span>
							@if ($table_participants->sortBy('gc')->first()['pj'] > 0)
								<small class="d-block pt-1">
									{{ number_format($table_participants->sortBy('gc')->first()['gc'] / $table_participants->sortBy('gc')->first()['pj'], 2, ',', '.') }} / partido
								</small>
							@endif
						</td>
					</tr>
				</table>
			</div>
			<div class="item">
				<table width="100%" cellspacing="0" cellpadding="8">
					<tr>
						<td>
							<i class="fas fa-caret-right pr-1 pb-2 text-warning"></i><strong class="text-success">Mejor diferencia de goles</strong>
							<div class="py-1 pl-3">
								<img src="{{ asset($table_participants->sortByDesc('avg')->first()['participant']->participant->logo()) }}" alt="" width="20" class="mr-1">
								<span>{{ $table_participants->sortByDesc('avg')->first()['participant']->participant->name() }}</span>
							</div>
						</td>
						<td class="text-right">
							<span class="text-dark">{{ $table_participants->sortByDesc('avg')->first()['avg'] }} goles</span>
						</td>
					</tr>
				</table>
			</div>

			<div class="item">
				<table width="100%" cellspacing="0" cellpadding="8">
					<tr>
						<td>
							<i class="fas fa-caret-right pr-1 pb-2 text-warning"></i><strong>Rey del empate</strong>
							<div class="py-1 pl-3">
								<img src="{{ asset($table_participants->sortByDesc('pe')->first()['participant']->participant->logo()) }}" alt="" width="20" class="mr-1">
								<span>{{ $table_participants->sortByDesc('pe')->first()['participant']->participant->name() }}</span>
							</div>
						</td>
						<td class="text-right">
							<span class="text-dark">{{ $table_participants->sortByDesc('pe')->first()['pe'] }} empates</span>
						</td>
					</tr>
				</table>
			</div>

			<div class="item">
				<table width="100%" cellspacing="0" cellpadding="8">
					<tr>
						<td>
							<i class="fas fa-caret-right pr-1 pb-2 text-warning"></i><strong class="text-danger">Equipo menos goleador</strong>
							<div class="py-1 pl-3">
								<img src="{{ asset($table_participants->sortBy('gf')->first()['participant']->participant->logo()) }}" alt="" width="20" class="mr-1">
								<span>{{ $table_participants->sortBy('gf')->first()['participant']->participant->name() }}</span>
							</div>
						</td>
						<td class="text-right">
							<span class="text-dark">{{ $table_participants->sortBy('gf')->first()['gf'] }} goles</span>
							@if ($table_participants->sortBy('gf')->first()['pj'] > 0)
								<small class="d-block pt-1">
									{{ number_format($table_participants->sortBy('gf')->first()['gf'] / $table_participants->sortBy('gf')->first()['pj'], 2, ',', '.') }} / partido
								</small>
							@endif
						</td>
					</tr>
				</table>
			</div>
			<div class="item">
				<table width="100%" cellspacing="0" cellpadding="8">
					<tr>
						<td>
							<i class="fas fa-caret-right pr-1 pb-2 text-warning"></i><strong class="text-danger">Equipo más goleado</strong>
							<div class="py-1 pl-3">
								<img src="{{ asset($table_participants->sortByDesc('gc')->first()['participant']->participant->logo()) }}" alt="" width="20" class="mr-1">
								<span>{{ $table_participants->sortByDesc('gc')->first()['participant']->participant->name() }}</span>
							</div>
						</td>
						<td class="text-right">
							<span class="text-dark">{{ $table_participants->sortByDesc('gc')->first()['gc'] }} goles</span>
							@if ($table_participants->sortByDesc('gc')->first()['pj'] > 0)
								<small class="d-block pt-1">
									{{ number_format($table_participants->sortByDesc('gc')->first()['gc'] / $table_participants->sortByDesc('gc')->first()['pj'], 2, ',', '.') }} / partido
								</small>
							@endif
						</td>
					</tr>
				</table>
			</div>
			<div class="item">
				<table width="100%" cellspacing="0" cellpadding="8">
					<tr>
						<td>
							<i class="fas fa-caret-right pr-1 pb-2 text-warning"></i><strong class="text-danger">Peor diferencia de goles</strong>
							<div class="py-1 pl-3">
								<img src="{{ asset($table_participants->sortBy('avg')->first()['participant']->participant->logo()) }}" alt="" width="20" class="mr-1">
								<span>{{ $table_participants->sortBy('avg')->first()['participant']->participant->name() }}</span>
							</div>
						</td>
						<td class="text-right">
							<span class="text-dark">{{ $table_participants->sortBy('avg')->first()['avg'] }} goles</span>
						</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</div>
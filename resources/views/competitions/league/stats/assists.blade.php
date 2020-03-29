<div class="row justify-content-center">
	<div class="col-12 col-md-10 col-lg-8 px-0 pt-2 pb-3">
		<div class="px-3 px-md-0 pb-2">
			<strong class="text-uppercase" style="font-size: .9em">Asistencias</strong>
		</div>
		@if ($stats_assists->count() > 0)
			<table class="stats">
				<tbody>
				@foreach ($stats_assists as $stat)
					<tr class="item" data-id="{{ 'assists'.$stat->player_id }}">
						<td class="pos">
							{{ $loop->iteration }}
						</td>
						<td class="player-img">
							<img src="{{ $stat->player->player->getImgFormatted() }}">
						</td>
						<td class="player-name">
							{{ $stat->player->player->name }}
							<small class="d-block">
								@if ($participant_id == 0)
									<img src="{{ $stat->player->participant->logo() }}" width="16">
									<span class="text-muted">{{ $stat->player->participant->name() }}</span>
								@else
									<img src="{{ asset($stat->player->player->nation_flag()) }}" width="16">
									<span class="text-muted">{{ $stat->player->player->nation_name }}</span>
									<span class="text-muted">, {{ $stat->player->player->age }} años</span>
									<span class="text-muted"> - {{ $stat->player->player->position }}</span>
								@endif
							</small>
						</td>
						<td class="total">
							{{ $stat->assists }}
						</td>
					</tr>
					<tr class="detail d-none animated" id="{{ 'assists'.$stat->player_id }}">
						<td colspan="4">
							@foreach ($stat->stat_detail('assists', $league->id, $stat->player->id) as $detail)
								<div class="list clearfix text-muted">
									<div class="d-inline-block float-left" style="width: 70px">
										Jornada {{ $detail->match->day->order }}
									</div>
									<div class="d-inline-block float-left">
										{{ $detail->match->match_result() }}
									</div>
									<div class="d-inline-block float-right text-right">
										@for ($i = 0; $i < $detail->assists; $i++)
										    <i class="icon-soccer-assist"></i>
										@endfor
									</div>
								</div>
							@endforeach
						</td>
					</tr>
				@endforeach
				</tbody>
			</table>
		@else
			<p class="mx-3">
				<small>No hay datos registrados</small>
			</p>
		@endif
	</div>
</div>
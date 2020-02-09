<div class="row justify-content-center">
	<div class="col-12 col-md-10 col-lg-8 px-0 pt-2 pb-3">
		<div class="px-3 px-md-0 pb-2">
			<strong class="text-uppercase" style="font-size: .9em">Asistencias</strong>
		</div>
		@if ($stats_assists->count() > 0)
			<table class="stats animated bounceInLeft delay-3s">
				<tbody>
				@foreach ($stats_assists as $stat)
					<tr>
						<td class="pos">
							{{ $loop->iteration }}
						</td>
						<td class="player-img">
							<img src="{{ $stat->player->player->getImgFormatted() }}">
						</td>
						<td class="player-name">
							{{ $stat->player->player->name }}
							<small class="d-block">
								<img src="{{ $stat->player->participant->logo() }}" width="16">
								<span class="text-muted">{{ $stat->player->participant->name() }}</span>
							</small>
						</td>
						<td class="total">
							{{ $stat->assists }}
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
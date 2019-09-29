<div class="offer">
	<div class="info">
		<div class="clearfix">
			<div class="float-left">
				@if ($trade->cession)
					<h5 class="m-0">Acuerdo de cesión</h4>
				@else
					<h5 class="m-0">Acuerdo de intercambio</h4>
				@endif
			</div>
			<div class="float-right">
				<small class="text-muted">{{ $trade->updated_at->diffForHumans() }}</small>
			</div>
		</div>
	</div> {{-- date --}}

	<div class="data">
		<div class="row">
			<div class="col-6 text-right">
				<img src="{{ $trade->participant1->logo() }}" width="60">
				<span class="name d-block">
					{{ $trade->participant1->name() }}
				</span>
				<span class="sub-name d-block text-muted">
					{{ $trade->participant1->sub_name() }}
				</span>
			</div>
			<div class="col-6 text-left">
				<img src="{{ $trade->participant2->logo() }}" width="60">
				<span class="name d-block">
					{{ $trade->participant2->name() }}
				</span>
				<span class="sub-name d-block text-muted">
					{{ $trade->participant2->sub_name() }}
				</span>
			</div>
		</div>
	</div> {{-- data --}}

	<div class="detail">

		<div class="row">
			<div class="col-6 text-right">
				<div class="title">
					Recibe
				</div>
				<div class="cash {{ $trade->cash2 == 0 ? 'text-muted' : '' }}">
					{{ $trade->cash2 }} M.
				</div>
				<div class="title">
					Se incorporan
				</div>
				<div class="players">
					@foreach ($trade->detail as $detail)
						@if ($detail->player2)
							<div class="player">
								<div class="player-data text-right">
									<span class="name">
										{{ $detail->player2->player->name }}
									</span>
									<small class="sub-name">
										{{ $detail->player2->player->position }}-{{ $detail->player2->player->overall_rating }}
									</small>
								</div>
								<img class="player-img" src="{{ $detail->player2->player->getImgFormatted() }}">
							</div>
						@endif
					@endforeach
				</div>
			</div>

			<div class="col-6 text-left">
				<div class="title">
					Recibe
				</div>
				<div class="cash {{ $trade->cash1 == 0 ? 'text-muted' : '' }}">
					{{ $trade->cash1 }} M.
				</div>
				<div class="title">
					Se incorporan
				</div>
				<div class="players">
					@foreach ($trade->detail as $detail)
						@if ($detail->player1)
							<div class="player">
								<img class="player-img" src="{{ $detail->player1->player->getImgFormatted() }}">
								<div class="player-data">
									<span class="name">
										{{ $detail->player1->player->name }}
									</span>
									<small class="sub-name">
										{{ $detail->player1->player->position }}-{{ $detail->player1->player->overall_rating }}
									</small>
								</div>
							</div>
						@endif
					@endforeach
				</div>
			</div>
		</div> {{-- row --}}

	</div> {{-- detail --}}

</div> {{-- offer --}}
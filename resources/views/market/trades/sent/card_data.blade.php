<div class="offer">
	<div class="info">
		<div class="clearfix">
			<div class="float-left">
				@if ($trade->cession)
					<h5 class="m-0">Oferta de cesión</h4>
				@else
					<h5 class="m-0">Oferta de intercambio</h4>
				@endif
			</div>
			<div class="float-right">
				<small class="text-muted">{{ $trade->created_at->diffForHumans() }}</small>
			</div>
		</div>
	</div> {{-- date --}}

	<div class="data">
		@if ($trade->state == 'refushed')
			<div class="bg-danger p-2 rounded mb-2">
				<h5 class="text-white m-0">
					😔 Oferta Rechazada
				</h5>
			</div>
		@endif
		<img src="{{ $trade->participant2->logo() }}" width="60">
		<span class="name d-block">
			{{ $trade->participant2->name() }}
		</span>
		<span class="sub-name d-block text-muted">
			{{ $trade->participant2->sub_name() }}
		</span>
	</div> {{-- data --}}

	<div class="detail">

		<div class="row">
			<div class="col-6 text-right">
				<div class="title">
					Ofreces
				</div>
				<div class="cash {{ $trade->cash1 == 0 ? 'text-muted' : '' }}">
					{{ $trade->cash1 }} M.
				</div>
				<div class="players">
					@foreach ($trade->detail as $detail)
						@if ($detail->player1)
							<div class="player">
								<div class="player-data text-right">
									<span class="name">
										{{ $detail->player1->player->name }}
									</span>
									<small class="sub-name">
										{{ $detail->player1->player->position }}-{{ $detail->player1->player->overall_rating }}
									</small>
								</div>
								<img class="player-img" src="{{ $detail->player1->player->getImgFormatted() }}">
							</div>
						@endif
					@endforeach
				</div>
			</div>

			<div class="col-6 text-left">
				<div class="title">
					Solicitas
				</div>
				<div class="cash {{ $trade->cash2 == 0 ? 'text-muted' : '' }}">
					{{ $trade->cash2 }} M.
				</div>
				<div class="players">
					@foreach ($trade->detail as $detail)
						@if ($detail->player2)
							<div class="player">
								<img class="player-img" src="{{ $detail->player2->player->getImgFormatted() }}">
								<div class="player-data">
									<span class="name">
										{{ $detail->player2->player->name }}
									</span>
									<small class="sub-name">
										{{ $detail->player2->player->position }}-{{ $detail->player2->player->overall_rating }}
									</small>
								</div>
							</div>
						@endif
					@endforeach
				</div>
			</div>
		</div> {{-- row --}}

	</div> {{-- detail --}}

	<div class="actions">
		@if ($trade->state == 'refushed')
			<a href="{{ route('market.trades.delete', $trade->id) }}" class="btn btn-danger brn-sm"  id="btn_delete">
				Eliminar oferta
			</a>
		@else
			<a href="{{ route('market.trades.retire', $trade->id) }}" class="btn btn-warning text-white brn-sm"  id="btn_retire">
				Retirar oferta
			</a>
		@endif
	</div>

	<div class="validations {{ count($trade->check_offer()) > 0 ? 'invalid' : 'd-none' }}">
		@if (count($trade->check_offer()) > 0)
			<div class="state text-danger">
				<i class="fas fa-ban mr-2"></i>Oferta inválida
			</div>
			<div class="warnings">
				@foreach ($trade->check_offer() as $warning)
						<div class="item">
							<i class="fas fa-exclamation-triangle mr-1"></i>{{ $warning }}
						</div>
				@endforeach
			</div>
		@endif
	</div>

</div> {{-- offer --}}
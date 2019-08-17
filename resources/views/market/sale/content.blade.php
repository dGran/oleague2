<div class="clearfix pt-3">
	<h5 class="float-left">
		Jugadores en venta
	</h5>
	<h5 class="float-right">
		<a href="">
			<i class="fas fa-filter"></i>
		</a>
	</h5>
</div>

@foreach ($players as $player)
	<div class="row">
		<div class="col-12 p-0">

			<div class="" style="border-top: 1px solid #E9E9E9; line-height: 1.25em; background: #f9f9f9; font-size: .9em; height: 124px; position: relative;">
				<img src="{{ $player->player->getImgFormatted() }}" alt="" width="94" style="position: absolute; left: 0px; bottom: 0;">
				<div style='background: {{ $player->player->getPositionColor() }}; border: 1px solid grey; font-size: 1em; width: 24px; height: 24px; line-height: 1em; position: absolute; left: 5px; top: 5px;' class='rounded-circle p-1 text-center'>
					<span class='font-weight-bold text-white'>
						<small>{{ $player->player->position }}</small>
					</span>
				</div>
				<img src="{{ asset($player->player->getBall()) }}" alt="" width="24" height="24" style="position: absolute; right: 20px; top: 5px">
				<span class="player-name text-uppercase" style="position: absolute; left: 36px; top: 9px; font-size: .9rem; font-weight: bold">
					{{ $player->player->name }}
				</span>
				<div style='background: #000; font-size: .7em; height: 20px; border: 1px solid grey; line-height: 1em; position: absolute; left: 65px; bottom: -5px;' class='rounded p-1 text-center'>
				    <span class='font-weight-bold text-white'>
				        <small>2 ofertas</small>
				    </span>
				</div>

				<img src="{{ asset($player->player->getIconPosition()) }}" width="20" style="position: absolute; top: 7px; right: 50px">
				<div style='background: {{ $player->player->getOverallRatingColor() }}; font-size: 1em; width: 24px; height: 24px; border: 1px solid grey; line-height: 1em; position: absolute; right: 5px; top: 5px;' class='rounded-circle p-1 text-center'>
				    <span class='font-weight-bold text-dark'>
				        <small>{{ $player->player->overall_rating }}</small>
				    </span>
				</div>
				<img src="{{ $player->participant->logo() }}" alt="" width="28" style="position: absolute; left: 95px; top: 40px; padding: 2px; background-color: #fff" class="border rounded-circle">
				<span class="text-uppercase" style="position: absolute; left: 130px; top: 41px; font-weight: bold; font-size: .6rem">
					{{ $player->participant->name() }}
				</span>
				<span class="" style="position: absolute; left: 130px; top: 52px; font-size: .55rem">
					{{ $player->participant->sub_name() }}
				</span>
				<img src="https://www.pesmaster.com/pes-2019/graphics/nteamlogos/flag_HRV.png?w=40" alt="" width="28" style="position: absolute; left: 95px; top: 70px; padding: 2px; background-color: #fff" class="border rounded-circle">
				<span class="text-uppercase" style="position: absolute; left: 130px; top: 76px; font-weight: bold; font-size: .6rem">
					{{ $player->player->nation_name }}
				</span>

				<div style="position: absolute; right: 105px; top: 40px; font-size: .9em; ">
					Claúsula
				</div>
				<div style="position: absolute; right: 8px; top: 40px;">
					<span class="d-inline-block" style="font-size: .9em; font-weight: bold">
						{{ number_format($player->price, 2, ',', '.') }}
					</span>
					<small class="d-inline-block" style="font-size: .7em">mill.</small>
				</div>

				@if ($player->transferable)
					@if ($player->sale_price > 0)
						<div style="position: absolute; right: 105px; top: 60px; font-size: .9em; ">
							Precio
						</div>
						<div style="position: absolute; right: 8px; top: 60px;">
							<span class="d-inline-block" style="font-size: 1.25em; font-weight: bold">
								{{ number_format($player->sale_price, 2, ',', '.') }}
							</span>
							<small class="d-inline-block">mill.</small>
						</div>
					@else
						<div style="position: absolute; right: 8px; top: 60px;">
							<span class="d-inline-block" style="font-size: 1.25em; font-weight: bold">
								Transferible {{ $player->player_on_loan ? '& Cedible' : '' }}
							</span>
						</div>
					@endif
				@elseif ($player->player_on_loan)
					<div style="position: absolute; right: 8px; top: 60px;">
						<span class="d-inline-block" style="font-size: 1.25em; font-weight: bold">
							Cedible
						</span>
					</div>
				@endif

				<div style="position: absolute; right: 8px; bottom: 8px">
					@if ($player->sale_price > 0 && $player->sale_auto_accept)
						<a href="" class="btn btn-success btn-sm"  style="font-size: .9em">
							Fichar ya!
						</a>
					@endif
					<a href="" class="btn btn-primary btn-sm" style="font-size: .9em;">
						Abrir negociación
					</a>
				</div>
			</div>
			@if ($player->market_phrase)
				<p class="px-2 py-2 mb-1 border-top" style="font-size: .8em">
					<strong>{{ $player->participant->sub_name() }}</strong>: {{ $player->market_phrase }}
				</p>
			@endif

		</div>
	</div>
@endforeach
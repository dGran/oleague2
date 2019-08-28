<div class="sale">

	<div class="header">
		<div class="clearfix">
			<h5 class="float-left">
				Jugadores en venta
			</h5>
			<h5 class="float-right">
				<a href="">
					<i class="fas fa-filter"></i>
				</a>
			</h5>
		</div>
	</div> {{-- header --}}

	<section class="content">
		@foreach ($players as $player)
			<div class="row">
				<div class="col-12 p-0">
					<div class="item">
						<img class="player-img" src="{{ $player->player->getImgFormatted() }}">
						<div class="position" style="background: {{ $player->player->getPositionColor() }};">
							{{ $player->player->position }}
						</div> {{-- position --}}
						<img class="player-ball" src="{{ asset($player->player->getBall()) }}">
						<span class="name">{{ $player->player->name }}</span>
{{-- 						<div class="offers">
						    2 ofertas
						</div> --}} {{-- offers --}}
						<img class="icon-position" src="{{ asset($player->player->getIconPosition()) }}">
						<div class="overall" style="background: {{ $player->player->getOverallRatingColor() }};">
					        {{ $player->player->overall_rating }}
						</div> {{-- overall --}}
						<img class="participant-logo" src="{{ $player->participant->logo() }}">
						<span class="participant-name">
							{{ $player->participant->name() }}
						</span> {{-- participant-name --}}
						<span class="participant-subname">
							{{ $player->participant->sub_name() }}
						</span> {{-- participant-subname --}}
						<img class="nation-logo" src="https://www.pesmaster.com/pes-2019/graphics/nteamlogos/flag_HRV.png">
						<span class="nation-name">
							{{ $player->player->nation_name }}
						</span> {{-- nation-name --}}
						<div class="clause-title">
							Claúsula
						</div> {{-- clause-title --}}
						<div class="clause-data">
							<span class="units">{{ number_format($player->price, 2, ',', '.') }}</span>
							<small class="measure">mill.</small>
						</div> {{-- clause-data --}}
						@if ($player->transferable)
							@if ($player->sale_price > 0)
								<div class="price-title">
									Precio
								</div> {{-- price-title --}}
								<div class="price-data">
									<span class="units">
										{{ number_format($player->sale_price, 2, ',', '.') }}
									</span>
									<small class="measure">mill.</small>
								</div> {{-- price-data --}}
							@else
								<div class="price-data">
									<span class="units">
										Transferible {{ $player->player_on_loan ? '& Cedible' : '' }}
									</span>
								</div> {{-- price-data --}}
							@endif
						@elseif ($player->player_on_loan)
							<div class="price-data">
								<span class="units">
									Cedible
								</span>
							</div> {{-- price-data --}}
						@endif
						<div class="buy-now">
							@if ($player->sale_price > 0 && $player->sale_auto_accept)
								<a class="btn btn-success btn-sm" href="" >
									Fichar ya!
								</a>
							@endif
							<a class="btn btn-primary btn-sm" href="" >
								Abrir negociación
							</a>
						</div> {{-- buy-now --}}
					</div> {{-- item --}}
					<p class="item-phrase">
						@if ($player->market_phrase)
							<strong>{{ $player->participant->sub_name() }}</strong>: {{ $player->market_phrase }}
						@endif
					</p> {{-- item-phrase --}}
				</div> {{-- col --}}
			</div> {{-- row --}}
		@endforeach
	</section> {{-- content --}}
</div> {{-- sale --}}
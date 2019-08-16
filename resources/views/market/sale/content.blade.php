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

<div class="row">
	<div class="col-12 p-0">

		@foreach ($players as $player)
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

				@if ($player->for_sale)
					<div style="position: absolute; right: 105px; top: 60px; font-size: .9em; ">
						Precio
					</div>
					<div style="position: absolute; right: 8px; top: 60px;">
						<span class="d-inline-block" style="font-size: 1.25em; font-weight: bold">
							{{ $player->sale_price }}
						</span>
						<small class="d-inline-block">mill.</small>
					</div>
				@endif

				@if ($player->player_on_loan)
					<div style="position: absolute; right: 105px; top: 60px; font-size: .9em; ">
						Cedible
					</div>
				@endif
	{{-- 			<img src="https://image.flaticon.com/icons/svg/118/118650.svg" alt="" width="28" style="position: absolute; left: 105px; top: 94px; padding: 2px; background-color: #fff" class="border rounded-circle">
				<span class="text-uppercase" style="position: absolute; left: 140px; top: 100px; font-size: .8rem; font-weight: bold; font-size: .7rem">
					181 cm
				</span>
				<img src="https://image.flaticon.com/icons/svg/1743/1743289.svg" alt="" width="28" style="position: absolute; left: 105px; top: 124px; padding: 2px; background-color: #fff" class="border rounded-circle">
				<span class="text-uppercase" style="position: absolute; left: 140px; top: 130px; font-size: .8rem; font-weight: bold; font-size: .7rem">
					70 kg
				</span> --}}


				<div style="position: absolute; right: 8px; bottom: 8px">
					<a href="" class="btn btn-success btn-sm"  style="font-size: .9em">
						Fichar ya!
					</a>
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
		@endforeach

		<div class="" style="border-top: 1px solid #E9E9E9; border-bottom: 1px solid #E9E9E9; line-height: 1.25em; background: #f9f9f9; font-size: .9em; height: 124px; position: relative;">
			<img src="https://www.pesmaster.com/pes-2019/graphics/players/player_60550.png" alt="" width="94" style="position: absolute; left: 0px; bottom: 0;">
			<div style='background: #be262d; border: 1px solid grey; font-size: 1em; width: 24px; height: 24px; line-height: 1em; position: absolute; left: 5px; top: 5px;' class='rounded-circle p-1 text-center'>
				<span class='font-weight-bold text-white'>
					<small>ED</small>
				</span>
			</div>
			<img src="{{ asset('img/yellow_ball.png') }}" alt="" width="24" height="24" style="position: absolute; right: 20px; top: 5px">
			<span class="player-name text-uppercase" style="position: absolute; left: 36px; top: 9px; font-size: .9rem; font-weight: bold">
				A.saint-Maximin
			</span>
			<img src="{{ asset('img/clubs/dc.png') }}" width="20" style="position: absolute; top: 7px; right: 50px">
			<div style='background: #ffbe00; font-size: 1em; width: 24px; height: 24px; border: 1px solid grey; line-height: 1em; position: absolute; right: 5px; top: 5px;' class='rounded-circle p-1 text-center'>
			    <span class='font-weight-bold text-dark'>
			        <small>80</small>
			    </span>
			</div>
			<img src="{{ asset('img/teams/4_062520190008315d1149dfb99ad.png') }}" alt="" width="28" style="position: absolute; left: 95px; top: 40px; padding: 2px; background-color: #fff" class="border rounded-circle">
			<span class="text-uppercase" style="position: absolute; left: 130px; top: 41px; font-weight: bold; font-size: .6rem">
				CAEN
			</span>
			<span class="" style="position: absolute; left: 130px; top: 52px; font-size: .55rem">
				pAdRoNe
			</span>
			<img src="https://www.pesmaster.com/pes-2019/graphics/nteamlogos/flag_FRA.png?w=40" alt="" width="28" style="position: absolute; left: 95px; top: 70px; padding: 2px; background-color: #fff" class="border rounded-circle">
			<span class="text-uppercase" style="position: absolute; left: 130px; top: 76px; font-weight: bold; font-size: .6rem">
				Francia
			</span>

			<div style="position: absolute; right: 105px; top: 40px; font-size: .9em; ">
				Claúsula
			</div>
			<div style="position: absolute; right: 8px; top: 40px;">
				<span class="d-inline-block" style="font-size: .9em; font-weight: bold">
					110,00
				</span>
				<small class="d-inline-block" style="font-size: .7em">mill.</small>
			</div>

			<div style="position: absolute; right: 105px; top: 60px; font-size: .9em; ">
				Precio
			</div>
			<div style="position: absolute; right: 8px; top: 60px;">
				<span class="d-inline-block" style="font-size: 1.25em; font-weight: bold">
					80,00
				</span>
				<small class="d-inline-block">mill.</small>
			</div>
{{-- 			<img src="https://image.flaticon.com/icons/svg/118/118650.svg" alt="" width="28" style="position: absolute; left: 105px; top: 94px; padding: 2px; background-color: #fff" class="border rounded-circle">
			<span class="text-uppercase" style="position: absolute; left: 140px; top: 100px; font-size: .8rem; font-weight: bold; font-size: .7rem">
				181 cm
			</span>
			<img src="https://image.flaticon.com/icons/svg/1743/1743289.svg" alt="" width="28" style="position: absolute; left: 105px; top: 124px; padding: 2px; background-color: #fff" class="border rounded-circle">
			<span class="text-uppercase" style="position: absolute; left: 140px; top: 130px; font-size: .8rem; font-weight: bold; font-size: .7rem">
				70 kg
			</span> --}}


			<div style="position: absolute; right: 8px; bottom: 8px">
				<a href="" class="btn btn-primary btn-sm" style="font-size: .9em">
					Abrir negociación
				</a>
			</div>
		</div>


		<p class="px-2 py-2 mb-1" style="font-size: .8em">
			<strong>pAdRoNe</strong>: Pollo original, purasangre, contagia a todo el equipo, pon un pollo en tu equipo
		</p>

		<div class="" style="border-top: 1px solid #E9E9E9; border-bottom: 1px solid #E9E9E9; line-height: 1.25em; background: #f9f9f9; font-size: .9em; height: 124px; position: relative; margin-bottom: 1em">
			<img src="https://www.pesmaster.com/pes-2019/graphics/players/player_46263445.png" alt="" width="94" style="position: absolute; left: 0px; bottom: 0;">
			<div style='background: #be262d; border: 1px solid grey; font-size: 1em; width: 24px; height: 24px; line-height: 1em; position: absolute; left: 5px; top: 5px;' class='rounded-circle p-1 text-center'>
				<span class='font-weight-bold text-white'>
					<small>DC</small>
				</span>
			</div>
			<img src="{{ asset('img/silver_ball.png') }}" alt="" width="24" height="24" style="position: absolute; right: 20px; top: 5px">
			<span class="player-name text-uppercase" style="position: absolute; left: 36px; top: 9px; font-size: .9rem; font-weight: bold">
				l. dimata
			</span>
			<img src="{{ asset('img/clubs/dc.png') }}" width="20" style="position: absolute; top: 7px; right: 50px">
			<div style='background: #ffff00; font-size: 1em; width: 24px; height: 24px; border: 1px solid grey; line-height: 1em; position: absolute; right: 5px; top: 5px;' class='rounded-circle p-1 text-center'>
			    <span class='font-weight-bold text-dark'>
			        <small>78</small>
			    </span>
			</div>
			<img src="{{ asset('img/teams/4_062520190008315d1149dfb99ad.png') }}" alt="" width="28" style="position: absolute; left: 95px; top: 40px; padding: 2px; background-color: #fff" class="border rounded-circle">
			<span class="text-uppercase" style="position: absolute; left: 130px; top: 41px; font-weight: bold; font-size: .6rem">
				CAEN
			</span>
			<span class="" style="position: absolute; left: 130px; top: 52px; font-size: .55rem">
				pAdRoNe
			</span>
			<img src="https://www.pesmaster.com/pes-2019/graphics/nteamlogos/flag_BEL.png?w=40" alt="" width="28" style="position: absolute; left: 95px; top: 70px; padding: 2px; background-color: #fff" class="border rounded-circle">
			<span class="text-uppercase" style="position: absolute; left: 130px; top: 76px; font-weight: bold; font-size: .6rem">
				Belgica
			</span>

			<div style="position: absolute; right: 105px; top: 40px; font-size: .9em; ">
				Claúsula
			</div>
			<div style="position: absolute; right: 8px; top: 40px;">
				<span class="d-inline-block" style="font-size: .9em; font-weight: bold">
					30,00
				</span>
				<small class="d-inline-block" style="font-size: .7em">mill.</small>
			</div>

			<div style="position: absolute; right: 105px; top: 60px; font-size: .9em; ">
				Precio
			</div>
			<div style="position: absolute; right: 8px; top: 60px;">
				<span class="d-inline-block" style="font-size: 1.25em; font-weight: bold">
					20,00
				</span>
				<small class="d-inline-block">mill.</small>
			</div>
{{-- 			<img src="https://image.flaticon.com/icons/svg/118/118650.svg" alt="" width="28" style="position: absolute; left: 105px; top: 94px; padding: 2px; background-color: #fff" class="border rounded-circle">
			<span class="text-uppercase" style="position: absolute; left: 140px; top: 100px; font-size: .8rem; font-weight: bold; font-size: .7rem">
				181 cm
			</span>
			<img src="https://image.flaticon.com/icons/svg/1743/1743289.svg" alt="" width="28" style="position: absolute; left: 105px; top: 124px; padding: 2px; background-color: #fff" class="border rounded-circle">
			<span class="text-uppercase" style="position: absolute; left: 140px; top: 130px; font-size: .8rem; font-weight: bold; font-size: .7rem">
				70 kg
			</span> --}}


			<div style="position: absolute; right: 8px; bottom: 8px">
				<a href="" class="btn btn-primary btn-sm" style="font-size: .9em">
					Abrir negociación
				</a>
			</div>
		</div>

		<table class="w-100">
			<thead>
{{-- 				<tr>
					<td colspan='2'>Jugador</td>
					<td class="text-center"></td>
					<td class="text-center"></td>
					<td class="text-right">Coste</td>
				</tr> --}}
			</thead>

			<tbody style="font-size: .9em">

				<tr style="border-top: 1px solid #E9E9E9; line-height: 1.25em">
					<td width="40" class="align-middle py-2 pl-1 pr-2">
						<img src="https://www.pesmaster.com/pes-2019/graphics/players/player_60550.png" alt="" width="40">
					</td>
					<td class="align-middle">
						<span class="player-name text-uppercase">A.saint-Maximin</span>
						<small class="player-data d-block">Francia / 21 años</small>
					</td>
					<td class="align-middle" width="32">
						<div style='background: #be262d; font-size: .85em; border: 1px solid grey; width: 2.25em; height: 2em; line-height: 1.1em' class='rounded p-1 text-center'>
							<span class='font-weight-bold text-white'>
								<small>ED</small>
							</span>
						</div>
						<div style='background: #ffbe00; font-size: .85em; border: 1px solid grey; width: 2.25em; height: 2em; line-height: 1.1em' class='rounded p-1 text-center mt-1'>
						    <span class='font-weight-bold text-dark'>
						        <small>80</small>
						    </span>
						</div>
					</td>
					<td width="48" class="align-middle text-center" style="line-height: .7em">
						<img src="{{ asset('img/teams/4_062520190008315d1149dfb99ad.png') }}" alt="" width="32" style="">
						<span class="text-truncate d-block" style="font-size: .65em; max-width: 48px; padding-top: .5em">CAEN</span>
					</td>

					<td width="80" class="align-middle pr-2 text-right">
						{{-- <span class="badge badge-danger">Compra ya</span> --}}
						<span class="d-inline-block" style="font-size: 1.1em; font-weight: bold">
							80,00
						</span>
						<small class="d-inline-block">mill.</small>
						<span class="d-block" style="font-size: .9em; text-decoration:line-through">
							110 mill.
						</span>
					</td>

					<td width="32" class="align-middle text-center border-left">
						<a href="">
							<i class="fas fa-ellipsis-v" style="font-size: 1.5em"></i>
						</a>
					</td>
				</tr>

				<tr style="border-top: 1px solid #E9E9E9; line-height: 1.25em">
					<td width="40" class="align-middle py-2 pl-1 pr-2">
						<img src="https://www.pesmaster.com/pes-2019/graphics/players/player_103293.png" alt="" width="40">
					</td>
					<td class="align-middle">
						<span class="player-name text-uppercase">J. denayer</span>
						<small class="player-data d-block">Belgium / 23 años</small>
					</td>
					<td class="align-middle" width="32">
						<div style='background: #2269d9; font-size: .85em; border: 1px solid grey; width: 2.25em; height: 2em; line-height: 1.1em' class='rounded p-1 text-center'>
							<span class='font-weight-bold text-white'>
								<small>CT</small>
							</span>
						</div>
						<div style='background: #ffff00; font-size: .85em; border: 1px solid grey; width: 2.25em; height: 2em; line-height: 1.1em' class='rounded p-1 text-center mt-1'>
						    <span class='font-weight-bold text-dark'>
						        <small>76</small>
						    </span>
						</div>
					</td>
					<td width="48" class="align-middle text-center" style="line-height: .7em">
						<img src="{{ asset('img/teams/4_062520190008315d1149dfb99ad.png') }}" alt="" width="32" style="">
						<span class="text-truncate d-block" style="font-size: .65em; max-width: 48px; padding-top: .5em">CAEN</span>
					</td>

					<td width="80" class="align-middle pr-2 text-right">
						{{-- <span class="badge badge-danger">Compra ya</span> --}}
						<span class="d-inline-block" style="font-size: 1.1em; font-weight: bold">
							10,00
						</span>
						<small class="d-inline-block">mill.</small>
						<span class="d-block" style="font-size: .9em; text-decoration:line-through">
							5 mill.
						</span>
					</td>

					<td width="32" class="align-middle text-center border-left">
						<a href="">
							<i class="fas fa-ellipsis-v" style="font-size: 1.5em"></i>
						</a>
					</td>
				</tr>

				<tr style="border-top: 1px solid #E9E9E9; line-height: 1.25em">
					<td width="40" class="align-middle py-2 pl-1 pr-2">
						<img src="https://www.pesmaster.com/pes-2019/graphics/players/player_34098.png" alt="" width="40">
					</td>
					<td class="align-middle">
						<span class="player-name text-uppercase">L. Modric</span>
						<small class="player-data d-block">Croacia / 30 años</small>
					</td>
					<td class="align-middle" width="32">
						<div style='background: #4c9f20; font-size: .85em; border: 1px solid grey; width: 2.25em; height: 2em; line-height: 1.1em' class='rounded p-1 text-center'>
							<span class='font-weight-bold text-white'>
								<small>MC</small>
							</span>
						</div>
						<div style='background: #ff7f00; font-size: .85em; border: 1px solid grey; width: 2.25em; height: 2em; line-height: 1.1em' class='rounded p-1 text-center mt-1'>
						    <span class='font-weight-bold text-white'>
						        <small>91</small>
						    </span>
						</div>
					</td>
					<td width="48" class="align-middle text-center" style="line-height: .7em">
						<img src="{{ asset('img/teams/4_070620191940315d20dd0f32d9b.png') }}" alt="" width="32" style="">
						<span class="text-truncate d-block" style="font-size: .65em; max-width: 48px; padding-top: .5em">PARIS SG</span>
					</td>

					<td width="90" class="align-middle pr-2 text-right">
						<span class="badge badge-danger mb-1">Compra ya</span>
						<span class="d-inline-block" style="font-size: 1.1em; font-weight: bold">
							105,00
						</span>
						<small class="d-inline-block">mill.</small>
						<span class="d-block" style="font-size: .9em; text-decoration:line-through">
							180 mill.
						</span>
					</td>

					<td width="32" class="align-middle text-center border-left">
						<a href="">
							<i class="fas fa-ellipsis-v" style="font-size: 1.5em"></i>
						</a>
					</td>
				</tr>

				<tr style="border-top: 1px solid #E9E9E9; line-height: 1.25em">
					<td width="40" class="align-middle py-2 pl-1 pr-2">
						<img src="https://www.pesmaster.com/pes-2019/graphics/players/player_43202.png" alt="" width="40">
					</td>
					<td class="align-middle">
						<span class="player-name text-uppercase">Neto</span>
						<small class="player-data d-block">Brasil / 30 años</small>
					</td>
					<td class="align-middle" width="32">
						<div style='background: #dba00f; font-size: .85em; border: 1px solid grey; width: 2.25em; height: 2em; line-height: 1.1em' class='rounded p-1 text-center'>
							<span class='font-weight-bold text-white'>
								<small>PO</small>
							</span>
						</div>
						<div style='background: #ffbe00; font-size: .85em; border: 1px solid grey; width: 2.25em; height: 2em; line-height: 1.1em' class='rounded p-1 text-center mt-1'>
						    <span class='font-weight-bold text-dark'>
						        <small>84</small>
						    </span>
						</div>
					</td>
					<td width="48" class="align-middle text-center" style="line-height: .7em">
						<img src="{{ asset('img/teams/9_070620191941255d20dd454ae71.png') }}" alt="" width="32" style="">
						<span class="text-truncate d-block" style="font-size: .65em; max-width: 48px; padding-top: .5em">PSV</span>
					</td>

					<td width="90" class="align-middle pr-2 text-right">
						<span class="d-inline-block" style="font-size: 1.1em; font-weight: bold">
							Cesión
						</span>
					</td>

					<td width="32" class="align-middle text-center border-left">
						<a href="">
							<i class="fas fa-ellipsis-v" style="font-size: 1.5em"></i>
						</a>
					</td>
				</tr>



			</tbody>
		</table>
	</div>
</div>

<div class="row border-top py-2">
	<div class="col-12">
		<span class="badge badge-danger">Compra ya</span>
		<small class="d-block">Fichaje automático pagando la cantidad solicitada por el propietario del jugador</small>
	</div>
</div>
<div class="transfer">

	<div class="header">
		<div class="container">
			<h2 class="text-center">
				Resumen de mercado
			</h2>
		</div> {{-- container --}}
	</div> {{-- header --}}

	<div class="container">
		<section class="content">
			{{-- search --}}
			<div class="row">
			    <div class="col-12 col-md-8 col-xl-6">
			    	<form class="frmFilter" role="search" method="get" action="{{ route('market') }}">
				    	<div class="searchbox">
					        <label class="search-icon" for="search-by"><i class="fas fa-search"></i></label>
					        <input class="search-input form-control mousetrap filterName" name="filterName" type="text" placeholder="Buscar..." value="{{ $filterName ? $filterName : '' }}" autocomplete="off" onkeypress="submitFilterForm()">
					        <span class="search-clear"><i class="fas fa-times"></i></span>
				        </div>
			    	</form>
			    </div>
			</div>
			@if ($players->count() > 0)
				<div class="row py-2">
					@foreach ($players as $player)
						<div class="col-12 col-md-6 col-xl-4 py-1 px-3">
							@include('market.index.card_data')
						</div>
					@endforeach
				</div> {{-- row --}}

			    <div class="regs-info clearfix py-3 px-1">
			        <div class="float-right">
			        	{!! $players->appends(Request::all())->render() !!}
						<div class="regs-info2 text-right pt-1 text-muted"><small>Registros: {{ $players->firstItem() }}-{{ $players->lastItem() }} de {{ number_format($players->total(), 0, ',', '.') }}</small></div>
			        </div>
			    </div>
			@else
				<div class="py-3 px-1 text-center">
					<h5>No se han encontrado resultados</h5>
					<figure class="text-center">
						<img class="img-fluid" src="https://media.giphy.com/media/12zV7u6Bh0vHpu/giphy.gif">
					</figure>
				</div>
			@endif
		</section> {{-- content --}}
	</div> {{-- container --}}
</div> {{-- sale --}}




<div class="clearfix pt-3">
	<h5 class="float-left">
		Fichajes confirmados
	</h5>
	<h5 class="float-right">
		<a href="">
			<i class="fas fa-filter"></i>
		</a>
	</h5>
</div>

<div class="row">
	<div class="col-12 p-0">
		<table class="w-100">
			<thead>

			</thead>

			<tbody style="font-size: .9em">

				<tr style="border-top: 1px solid #E9E9E9">
					<td width="50" class="align-middle py-1 pl-1 pr-2">
						<img src="https://www.pesmaster.com/pes-2019/graphics/players/player_60550.png" alt="" width="50">
					</td>
					<td class="align-middle">
						<span class="player-name text-uppercase">A.saint-Maximin</span>
						<small class="player-data d-block">ED - 80</small>
					</td>
					<td width="48" class="align-middle text-center" style="opacity: .4">
						<img src="{{ asset('img/teams/9_062320192135065d0fd46ae7a7d.png') }}" alt="" width="32">
						<span class="text-truncate d-block" style="font-size: .65em; max-width: 48px; padding-top: .5em;">AJAX</span>
					</td>
					<td width="48" class="align-middle text-center">
						<img src="{{ asset('img/teams/4_062520190008315d1149dfb99ad.png') }}" alt="" width="32" style="">
						<span class="text-truncate d-block" style="font-size: .65em; max-width: 48px; padding-top: .5em">CAEN</span>
					</td>

					<td width="90" class="align-middle pr-2 text-right">
						<span class="d-inline-block" style="font-size: 1.1em; font-weight: bold">
							80,00
						</span>
						<small class="d-inline-block">mill.</small>
					</td>
				</tr>

				<tr style="border-top: 1px solid #E9E9E9">
					<td width="50" class="align-middle py-1 pl-1 pr-2">
						<img src="https://www.pesmaster.com/pes-2019/graphics/players/player_103408.png" alt="" width="50">
					</td>
					<td class="align-middle">
						<span class="player-name text-uppercase">Lucas Vazquez</span>
						<small class="player-data d-block">ED - 83</small>
					</td>
					<td width="48" class="align-middle text-center" style="opacity: .4">
						<img src="{{ asset('img/teams/4_062520190008315d1149dfb99ad.png') }}" alt="" width="32">
						<span class="text-truncate d-block" style="font-size: .65em; max-width: 48px; padding-top: .5em;">CAEN</span>
					</td>

					<td width="48" class="align-middle text-center">
						<img src="{{ asset('img/teams/5_062320191028345d0f383223df7.png') }}" alt="" width="32" style="">
						<span class="text-truncate d-block" style="font-size: .65em; max-width: 48px; padding-top: .5em">ARSENAL</span>
					</td>
					<td width="90" class="align-middle pr-2 text-right">
						<span class="d-inline-block" style="font-size: 1.1em; font-weight: bold">
							Acuerdo
						</span>
						<small class="d-inline-block">#248</small>
						<span class="d-inline-block" style="font-size: 1.1em; font-weight: bold">
							12,50
						</span>
						<small class="d-inline-block">mill.</small>
					</td>
				</tr>

				<tr style="border-top: 1px solid #E9E9E9">
					<td width="50" class="align-middle py-1 pl-1 pr-2">
						<img src="https://www.pesmaster.com/pes-2019/graphics/players/player_43076.png" alt="" width="50">
					</td>
					<td class="align-middle">
						<span class="player-name text-uppercase">R. Varane</span>
						<small class="player-data d-block">CT - 86</small>
					</td>
					<td width="48" class="align-middle text-center" style="opacity: .4">
						<img src="{{ asset('img/teams/4_062520190008315d1149dfb99ad.png') }}" alt="" width="32">
						<span class="text-truncate d-block" style="font-size: .65em; max-width: 48px; padding-top: .5em;">CAEN</span>
					</td>

					<td width="48" class="align-middle text-center">
						<img src="{{ asset('img/teams/5_062320191028345d0f383223df7.png') }}" alt="" width="32" style="">
						<span class="text-truncate d-block" style="font-size: .65em; max-width: 48px; padding-top: .5em">ARSENAL</span>
					</td>
					<td width="90" class="align-middle pr-2 text-right">
						<span class="d-inline-block" style="font-size: 1.1em; font-weight: bold">
							Acuerdo
						</span>
						<small class="d-inline-block">#248</small>
						<span class="d-inline-block" style="font-size: 1.1em; font-weight: bold">
							12,50
						</span>
						<small class="d-inline-block">mill.</small>
					</td>
				</tr>

				<tr style="border-top: 1px solid #E9E9E9">
					<td width="50" class="align-middle py-1 pl-1 pr-2">
						<img src="https://www.pesmaster.com/pes-2019/graphics/players/player_102757.png" alt="" width="50">
					</td>
					<td class="align-middle">
						<span class="player-name text-uppercase">k. koulibay</span>
						<small class="player-data d-block">CT - 87</small>
					</td>
					<td width="48" class="align-middle text-center" style="opacity: .4">
						<img src="{{ asset('img/teams/5_062320191028345d0f383223df7.png') }}" alt="" width="32">
						<span class="text-truncate d-block" style="font-size: .65em; max-width: 48px; padding-top: .5em;">ARSENAL</span>
					</td>

					<td width="48" class="align-middle text-center">
						<img src="{{ asset('img/teams/4_062520190008315d1149dfb99ad.png') }}" alt="" width="32" style="">
						<span class="text-truncate d-block" style="font-size: .65em; max-width: 48px; padding-top: .5em">CAEN</span>
					</td>
					<td width="90" class="align-middle pr-2 text-right">
						<span class="d-inline-block" style="font-size: 1.1em; font-weight: bold">
							Acuerdo
						</span>
						<small class="d-inline-block">#248</small>
					</td>
				</tr>

				<tr style="border-top: 1px solid #E9E9E9">
					<td width="50" class="align-middle py-1 pl-1 pr-2">
						<img src="https://www.pesmaster.com/pes-2019/graphics/players/player_5518.png" alt="" width="50">
					</td>
					<td class="align-middle">
						<span class="player-name text-uppercase">ALBIOL</span>
						<small class="player-data d-block">CT - 81</small>
					</td>
					<td width="48" class="align-middle text-center" style="opacity: .4">
						<img src="{{ asset('img/team_no_image.png') }}" alt="" width="32">
						<span class="text-truncate d-block" style="font-size: .65em; max-width: 48px; padding-top: .5em;">LIBRE</span>
					</td>

					<td width="48" class="align-middle text-center">
						<img src="{{ asset('img/teams/7_062320192136345d0fd4c2dd8a9.png') }}" alt="" width="32" style="">
						<span class="text-truncate d-block" style="font-size: .65em; max-width: 48px; padding-top: .5em">SPORTING</span>
					</td>
					<td width="90" class="align-middle pr-2 text-right">
						<span class="d-inline-block" style="font-size: 1.1em; font-weight: bold">
							5,00
						</span>
						<small class="d-inline-block">mill.</small>
					</td>
				</tr>




				<tr style="border-top: 1px solid #E9E9E9">
					<td width="50" class="align-middle py-1 pl-1 pr-2">
						<img src="https://www.pesmaster.com/pes-2019/graphics/players/player_36625.png" alt="" width="50">
					</td>
					<td class="align-middle">
						<span class="player-name text-uppercase">I. Rakitić</span>
						<small class="player-data d-block">MC - 86</small>
					</td>
					<td width="48" class="align-middle text-center" style="opacity: .4">
						<img src="{{ asset('img/teams/4_062520190008315d1149dfb99ad.png') }}" alt="" width="32">
						<span class="text-truncate d-block" style="font-size: .65em; max-width: 48px; padding-top: .5em;">CAEN</span>
					</td>

					<td width="48" class="align-middle text-center">
						<img src="{{ asset('img/teams/5_062320191028345d0f383223df7.png') }}" alt="" width="32" style="">
						<span class="text-truncate d-block" style="font-size: .65em; max-width: 48px; padding-top: .5em">ARSENAL</span>
					</td>
					<td width="90" class="align-middle pr-2 text-right">
						<span class="d-inline-block" style="font-size: 1.1em; font-weight: bold">
							Acuerdo
						</span>
						<small class="d-inline-block">#247</small>
						<span class="d-inline-block" style="font-size: 1.1em; font-weight: bold">
							45,00
						</span>
						<small class="d-inline-block">mill.</small>
					</td>
				</tr>

				<tr style="border-top: 1px solid #E9E9E9">
					<td width="50" class="align-middle py-1 pl-1 pr-2">
						<img src="https://www.pesmaster.com/pes-2019/graphics/players/player_114053.png" alt="" width="50">
					</td>
					<td class="align-middle">
						<span class="player-name text-uppercase">T. Ndombèlé</span>
						<small class="player-data d-block">MC - 82</small>
					</td>
					<td width="48" class="align-middle text-center" style="opacity: .4">
						<img src="{{ asset('img/teams/5_062320191028345d0f383223df7.png') }}" alt="" width="32">
						<span class="text-truncate d-block" style="font-size: .65em; max-width: 48px; padding-top: .5em;">ARSENAL</span>
					</td>

					<td width="48" class="align-middle text-center">
						<img src="{{ asset('img/teams/4_062520190008315d1149dfb99ad.png') }}" alt="" width="32" style="">
						<span class="text-truncate d-block" style="font-size: .65em; max-width: 48px; padding-top: .5em">CAEN</span>
					</td>
					<td width="90" class="align-middle pr-2 text-right">
						<span class="d-inline-block" style="font-size: 1.1em; font-weight: bold">
							Acuerdo
						</span>
						<small class="d-inline-block">#247</small>
					</td>
				</tr>

				<tr style="border-top: 1px solid #E9E9E9">
					<td width="50" class="align-middle py-1 pl-1 pr-2">
						<img src="https://www.pesmaster.com/pes-2019/graphics/players/player_107716.png" alt="" width="50">
					</td>
					<td class="align-middle">
						<span class="player-name text-uppercase">N. PÉPÉ</span>
						<small class="player-data d-block">ED - 80</small>
					</td>
					<td width="48" class="align-middle text-center" style="opacity: .4">
						<img src="{{ asset('img/teams/5_062320191028345d0f383223df7.png') }}" alt="" width="32">
						<span class="text-truncate d-block" style="font-size: .65em; max-width: 48px; padding-top: .5em;">ARSENAL</span>
					</td>

					<td width="48" class="align-middle text-center">
						<img src="{{ asset('img/teams/4_062520190008315d1149dfb99ad.png') }}" alt="" width="32" style="">
						<span class="text-truncate d-block" style="font-size: .65em; max-width: 48px; padding-top: .5em">CAEN</span>
					</td>
					<td width="100" class="align-middle pr-2 text-right">
						<span class="d-inline-block" style="font-size: 1.1em; font-weight: bold">
							Acuerdo
						</span>
						<small class="d-inline-block">#247</small>
					</td>
				</tr>



				<tr style="border-top: 1px solid #E9E9E9">
					<td width="50" class="align-middle py-1 pl-1 pr-2">
						<img src="https://www.pesmaster.com/pes-2019/graphics/players/player_40352.png" alt="" width="50">
					</td>
					<td class="align-middle">
						<span class="player-name text-uppercase">NEYMAR</span>
						<small class="player-data d-block">EI - 94</small>
					</td>
					<td width="48" class="align-middle text-center" style="opacity: .4">
						<img src="{{ asset('img/teams/4_062520190008315d1149dfb99ad.png') }}" alt="" width="32">
						<span class="text-truncate d-block" style="font-size: .65em; max-width: 48px; padding-top: .5em;">CAEN</span>
					</td>
					<td width="48" class="align-middle text-center">
						<img src="{{ asset('img/teams/2_070620191942275d20dd831ea62.png') }}" alt="" width="32" style="">
						<span class="text-truncate d-block" style="font-size: .65em; max-width: 48px; padding-top: .5em">NAPOLI</span>
					</td>

					<td width="90" class="align-middle pr-2 text-right">
						<span class="d-block" style="font-size: 1.1em; font-weight: bold">
							Acuerdo
						</span>
						<img src="https://image.flaticon.com/icons/svg/1654/1654392.svg" width="20" class="d-inline-block ml-1">
						<img src="https://image.flaticon.com/icons/svg/189/189093.svg" width="20" class="d-inline-block ml-1">
					</td>
				</tr>

				<tr style="border-top: 1px solid #E9E9E9">
					<td width="50" class="align-middle py-1 pl-1 pr-2">
						<img src="https://www.pesmaster.com/pes-2019/graphics/players/player_5518.png" alt="" width="50">
					</td>
					<td class="align-middle">
						<span class="player-name text-uppercase">ALBIOL</span>
						<small class="player-data d-block">CT - 81</small>
					</td>
					<td width="48" class="align-middle text-center" style="opacity: .4">
						<img src="{{ asset('img/teams/19_070620191943185d20ddb60a8f6.png') }}" alt="" width="32">
						<span class="text-truncate d-block" style="font-size: .65em; max-width: 48px; padding-top: .5em;">CELTIC</span>
					</td>
					<td width="48" class="align-middle text-center">
						<img src="{{ asset('img/team_no_image.png') }}" alt="" width="32" style="">
						<span class="text-truncate d-block" style="font-size: .65em; max-width: 48px; padding-top: .5em">LIBRE</span>
					</td>

					<td width="90" class="align-middle pr-2 text-right">

					</td>
				</tr>


				<tr style="border-top: 1px solid #E9E9E9">
					<td width="50" class="align-middle py-1 pl-1 pr-2">
						<img src="{{ asset('img/players/1_062420192349495d11457dd4e3d.png') }}" alt="" width="50">
					</td>
					<td class="align-middle">
						<span class="player-name text-uppercase">M. DE LIGT</span>
						<small class="player-data d-block">CT - 81</small>
					</td>
					<td width="48" class="align-middle text-center" style="opacity: .4">
						<img src="{{ asset('img/teams/4_070620191942125d20dd744c6da.png') }}" alt="" width="32" style="">
						<span class="text-truncate d-block" style="font-size: .65em; max-width: 48px; padding-top: .5em;">
							OLYMPIQUE MARSELLA
						</span>
					</td>
					<td width="48" class="align-middle text-center">
						<img src="{{ asset('img/teams/2_062320191023305d0f370283155.png') }}" alt="" width="32" style="">
						<span class="text-truncate d-block" style="font-size: .65em; max-width: 48px; padding-top: .5em">
							MILAN
						</span>
					</td>
					<td width="90" class="align-middle pr-2 text-right">
						<span class="badge badge-danger">Clausulazo</span>
						<span class="d-inline-block" style="font-size: 1.1em; font-weight: bold">
							85,50
						</span>
						<small class="d-inline-block">mill.</small>
					</td>
				</tr>

				<tr style="border-top: 1px solid #E9E9E9">
					<td width="50" class="align-middle py-1 pl-1 pr-2">
						<img src="https://www.pesmaster.com/pes-2019/graphics/players/player_45641.png" alt="" width="50">
					</td>
					<td class="align-middle">
						<span class="player-name text-uppercase">ALLAN</span>
						<small class="player-data d-block">MC - 84</small>
					</td>
					<td width="48" class="align-middle text-center" style="opacity: .4">
						<img src="{{ asset('img/teams/4_070620191943315d20ddc3727a5.png') }}" alt="" width="32" style="">
						<span class="text-truncate d-block" style="font-size: .65em; max-width: 48px; padding-top: .5em;">
							MONTPELLIER
						</span>
					</td>
					<td width="48" class="align-middle text-center">
						<img src="{{ asset('img/teams/4_070620191940315d20dd0f32d9b.png') }}" alt="" width="32" style="">
						<span class="text-truncate d-block" style="font-size: .65em; max-width: 48px; padding-top: .5em">
							PARIS S.G.
						</span>
					</td>
					<td width="90" class="align-middle pr-2 text-right">
						<span class="d-inline-block" style="font-size: 1.1em; font-weight: bold">
							40,00
						</span>
						<small class="d-inline-block">mill.</small>
					</td>
				</tr>

				<tr style="border-top: 1px solid #E9E9E9">
					<td width="50" class="align-middle py-1 pl-1 pr-2">
						<img src="https://www.pesmaster.com/pes-2019/graphics/players/player_108239.png" alt="" width="50">
					</td>
					<td class="align-middle">
						<span class="player-name text-uppercase">FABIAN RUIZ</span>
						<small class="player-data d-block">MC - 81</small>
					</td>
					<td width="48" class="align-middle text-center" style="opacity: .4">
						<img src="{{ asset('img/teams/4_070620191943315d20ddc3727a5.png') }}" alt="" width="32" style="">
						<span class="text-truncate d-block" style="font-size: .65em; max-width: 48px; padding-top: .5em;">
							MONTPELLIER
						</span>
					</td>
					<td width="48" class="align-middle text-center">
						<img src="{{ asset('img/teams/8_062320191022435d0f36d3ca462.png') }}" alt="" width="32" style="">
						<span class="text-truncate d-block" style="font-size: .65em; max-width: 48px; padding-top: .5em">
							SHAKTAR DONNEST
						</span>
					</td>
					<td width="90" class="align-middle pr-2 text-right">
						<span class="d-inline-block" style="font-size: 1.1em; font-weight: bold">
							Cesión
						</span>
					</td>
				</tr>




			</tbody>
		</table>
	</div>
</div>
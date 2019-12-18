<div class="container">
	<div class="row justify-content-center">
		<div class="col-12 col-md-10 col-lg-8 px-3 px-md-0 py-3">
			<div class="clearfix">
				<div class="float-left animated rubberBand">
					<div class="d-inline-block align-middle">
						<figure class="bg-white border rounded-circle m-0 shadow" style="padding: 10px">
							<img src="{{ $table_participants->first()['participant']->participant->logo() }}" width="40">
						</figure>
					</div>
					<div class="d-inline-block align-middle pl-2">
						<strong>{{ $table_participants->first()['participant']->participant->name() }}</strong>
						<small class="text-muted d-block">
							{{ $table_participants->first()['participant']->participant->sub_name() }}
						</small>
					</div>
				</div>
				<div class="float-right text-center animated bounceInDown delay-2s">
					<img src="https://media.giphy.com/media/eMmj4M254X9sFu06jQ/giphy.gif" alt="" width="40">
					{{-- <img src="https://thumbs.gfycat.com/SpryGrotesqueIvorybilledwoodpecker-max-1mb.gif" width="60"> --}}
					{{-- <img src="https://media.tenor.com/images/9f208823ef7db08e4b3c2aeef043266e/tenor.gif" width="48"> --}}
					<div style="font-size: .7em; font-weight: bold; text-transform: uppercase; padding-top: 4px">Líder</div>
				</div>
			</div>
		</div>
	</div>

	<div class="row justify-content-center">
		<div class="col-12 col-md-10 col-lg-8 p-0" style="position: relative;">
			<figure style="position: absolute; top: 0; left: 96px;">
				{{-- <img src="https://media.giphy.com/media/VeNDn269qsn3sFdhZg/giphy.gif" alt="" width="120" > --}}
			</figure>
		    <table class="table-results">
		        <colgroup>
		        	<col width="0%" />
		            <col width="0%" />
		            <col class="" width="0%" />
		            <col width="100%" />
		            <col width="0%" />
		            <col width="0%" />
		            <col width="0%" />
		            <col width="0%" />
		            <col class="d-none d-sm-table-cell" width="0%" />
		            <col class="d-none d-sm-table-cell" width="0%" />
		            <col class="d-none d-sm-table-cell" width="0%" />
		            <col class="d-none d-sm-table-cell" width="0%" />
		            <col width="0%" />
		        </colgroup>
		        <thead>
					<tr class="">
						<th colspan="4" class="pl-3 pl-md-0">
							Clasificación
						</th>
						<th class="text-center">PJ</th>
						<th class="text-center">PG</th>
						<th class="text-center">PE</th>
						<th class="text-center">PP</th>
						<th class="text-center d-none d-sm-table-cell">PS</th>
						<th class="text-center d-none d-sm-table-cell">GF</th>
						<th class="text-center d-none d-sm-table-cell">GC</th>
						<th class="text-center d-none d-sm-table-cell">+/-</th>
						<th class="text-center px-2">PT</th>
					</tr>
				</thead>
				@foreach ($table_participants as $tp)
					<tr>
						<td class="zones">
							@if ($tp['table_zone'])
								<img src="{{ asset($tp['table_zone']->getImgFormatted()) }}" alt="">
							@endif

						</td>
						<td class="pos text-right">
							{{ $loop->iteration }}
						</td>
		                <td class="img">
		                    <img src="{{ $tp['participant']->participant->logo() }}" alt="" width="24">
		                </td>
				        <td class="names">
		                    <a href="{{ route('club', $tp['participant']->participant->team->slug) }}" class="name text-uppercase">
		                    	{{ $tp['participant']->participant->name() == 'undefined' ? '' : $tp['participant']->participant->name() }}
		                    	<br>
			                    <small class="description">
			                        @if ($tp['participant']->participant->sub_name() == 'undefined')
			                            <span class="badge badge-danger p-1 mt-1">SIN USUARIO</span>
			                        @else
			                            {{ $tp['participant']->participant->sub_name() }}
			                        @endif
			                    </small>
							</a>
						</td>
						<td class="data text-center {{ $tp['pj'] == 0 ? 'text-zero' : '' }}">
							{{ $tp['pj'] }}
						</td>
						<td class="data text-center {{ $tp['pg'] == 0 ? 'text-zero' : '' }}">
							{{ $tp['pg'] }}
						</td>
						<td class="data text-center {{ $tp['pe'] == 0 ? 'text-zero' : '' }}">
							{{ $tp['pe'] }}
						</td>
						<td class="data text-center {{ $tp['pp'] == 0 ? 'text-zero' : '' }}">
							{{ $tp['pp'] }}
						</td>
						<td class="data text-center d-none d-sm-table-cell {{ $tp['ps'] == 0 ? 'text-zero' : '' }} {{ $tp['ps'] > 0 ? 'text-danger' : '' }}">
							{{ $tp['ps'] }}
						</td>
						<td class="data text-center d-none d-sm-table-cell {{ $tp['gf'] == 0 ? 'text-zero' : '' }}">
							{{ $tp['gf'] }}
						</td>
						<td class="data text-center d-none d-sm-table-cell {{ $tp['gc'] == 0 ? 'text-zero' : '' }}">
							{{ $tp['gc'] }}
						</td>
						<td class="data text-center d-none d-sm-table-cell {{ $tp['avg'] == 0 ? 'text-zero' : '' }}">
							{{ $tp['avg'] }}
						</td>
						<td class="data pt text-center">
							<strong>{{ $tp['pts'] }}</strong>
						</td>
					</tr>
				@endforeach
			</table>
		</div>
	</div>



	<div class="row justify-content-center">
		<div class="col-12 col-md-6 pb-4 px-3 px-md-0" style="font-size: .8em">
			<h5>Estadísticas</h5>

			<strong>Equipo más goleador</strong>
			<div class="clearfix py-1 pl-3">
				<div class="float-left">
					<span class="text-success">{{ $table_participants->sortByDesc('gf')->first()['participant']->participant->name() }}</span>
				</div>
				<div class="float-right">
					{{ $table_participants->sortByDesc('gf')->first()['gf'] }} goles
				</div>
			</div>

			<strong>Equipo menos goleador</strong>
			<div class="clearfix py-1 pl-3">
				<div class="float-left">
					<span class="text-danger">{{ $table_participants->sortBy('gf')->first()['participant']->participant->name() }}</span>
				</div>
				<div class="float-right">
					{{ $table_participants->sortBy('gf')->first()['gf'] }} goles
				</div>
			</div>

			<strong>Equipo menos goleado</strong>
			<div class="clearfix py-1 pl-3">
				<div class="float-left">
					<span class="text-success">{{ $table_participants->sortBy('gc')->first()['participant']->participant->name() }}</span>
				</div>
				<div class="float-right">
					{{ $table_participants->sortBy('gc')->first()['gc'] }} goles
				</div>
			</div>

			<strong>Equipo más goleado</strong>
			<div class="clearfix py-1 pl-3">
				<div class="float-left">
					<span class="text-danger">{{ $table_participants->sortByDesc('gc')->first()['participant']->participant->name() }}</span>
				</div>
				<div class="float-right">
					{{ $table_participants->sortByDesc('gc')->first()['gc'] }} goles
				</div>
			</div>

			<strong>Mejor diferencia de goles</strong>
			<div class="clearfix py-1 pl-3">
				<div class="float-left">
					<span class="text-success">{{ $table_participants->sortByDesc('avg')->first()['participant']->participant->name() }}</span>
				</div>
				<div class="float-right">
					{{ $table_participants->sortByDesc('avg')->first()['avg'] }} goles
				</div>
			</div>

			<strong>Peor diferencia de goles</strong>
			<div class="clearfix py-1 pl-3">
				<div class="float-left">
					<span class="text-danger">{{ $table_participants->sortBy('avg')->first()['participant']->participant->name() }}</span>
				</div>
				<div class="float-right">
					{{ $table_participants->sortBy('avg')->first()['avg'] }} goles
				</div>
			</div>

			<strong>Rey del empate</strong>
			<div class="clearfix py-1 pl-3">
				<div class="float-left">
					{{ $table_participants->sortByDesc('pe')->first()['participant']->participant->name() }}
				</div>
				<div class="float-right">
					{{ $table_participants->sortByDesc('pe')->first()['pe'] }} empates
				</div>
			</div>
		</div>
	</div>

</div> {{-- container --}}
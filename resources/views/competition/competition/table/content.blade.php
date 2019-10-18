<div class="container">
	<div class="row justify-content-center">
		<div class="col-12 col-md-10 col-lg-8 animated fadeIn px-3 px-md-0 pt-3 pb-2">
			<div class="d-inline-block align-middle">
				<figure class="bg-white border rounded-circle m-0" style="padding: 10px">
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
	</div>
	<div class="row justify-content-center">
		<div class="col-12 col-md-10 col-lg-8 animated fadeIn p-0">
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
				        <td>
		                    <span class="name text-uppercase">{{ $tp['participant']->participant->name() == 'undefined' ? '' : $tp['participant']->participant->name() }}</span>
		                    <br>
		                    <small class="description text-black-50">
		                        @if ($tp['participant']->participant->sub_name() == 'undefined')
		                            <span class="badge badge-danger p-1 mt-1">SIN USUARIO</span>
		                        @else
		                            {{ $tp['participant']->participant->sub_name() }}
		                        @endif
		                    </small>
						</td>
						<td class="data text-center">
							{{ $tp['pj'] }}
						</td>
						<td class="data text-center">
							{{ $tp['pg'] }}
						</td>
						<td class="data text-center">
							{{ $tp['pe'] }}
						</td>
						<td class="data text-center">
							{{ $tp['pp'] }}
						</td>
						<td class="data text-center d-none d-sm-table-cell {{ $tp['ps'] > 0 ? 'text-danger' : '' }}">
							{{ $tp['ps'] }}
						</td>
						<td class="data text-center d-none d-sm-table-cell">
							{{ $tp['gf'] }}
						</td>
						<td class="data text-center d-none d-sm-table-cell">
							{{ $tp['gc'] }}
						</td>
						<td class="data text-center d-none d-sm-table-cell">
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
</div>
<div class="row justify-content-center">
	<div class="col-12 col-md-10 col-lg-8 p-0">
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
					<th class="text-center px-2">PT</th>
					<th class="text-center">PJ</th>
					<th class="text-center">PG</th>
					<th class="text-center">PE</th>
					<th class="text-center">PP</th>
					<th class="text-center d-none d-sm-table-cell">PS</th>
					<th class="text-center d-none d-sm-table-cell">GF</th>
					<th class="text-center d-none d-sm-table-cell">GC</th>
					<th class="text-center d-none d-sm-table-cell">+/-</th>
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
	                    <a href="{{ route('club', [$competition->season->slug, $tp['participant']->participant->team->slug]) }}" class="name text-uppercase">
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
					<td class="data pt text-center">
						<strong>{{ $tp['pts'] }}</strong>
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
				</tr>
			@endforeach
		</table>
	</div>
</div>
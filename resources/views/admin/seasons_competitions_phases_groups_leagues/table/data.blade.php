<div class="table-form-content mt-3 table-results col-12 col-xl-9 animated fadeIn">

    <table class="table">
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
				<th colspan="4">clasificación</th>
				<th class="text-center">PJ</th>
				<th class="text-center">PG</th>
				<th class="text-center">PE</th>
				<th class="text-center">PP</th>
				<th class="text-center d-none d-sm-table-cell">PS</th>
				<th class="text-center d-none d-sm-table-cell">GF</th>
				<th class="text-center d-none d-sm-table-cell">GC</th>
				<th class="text-center d-none d-sm-table-cell">+/-</th>
				<th class="text-center">PT</th>
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
                    <small class="text-black-50">
                        @if ($tp['participant']->participant->sub_name() == 'undefined')
                            <span class="badge badge-danger p-1 mt-1">SIN USUARIO</span>
                        @else
                            {{ $tp['participant']->participant->sub_name() }}
                        @endif
                    </small>
				</td>
				<td class="text-center">
					{{ $tp['pj'] }}
				</td>
				<td class="text-center">
					{{ $tp['pg'] }}
				</td>
				<td class="text-center">
					{{ $tp['pe'] }}
				</td>
				<td class="text-center">
					{{ $tp['pp'] }}
				</td>
				<td class="text-center d-none d-sm-table-cell {{ $tp['ps'] > 0 ? 'text-danger' : '' }}">
					{{ $tp['ps'] }}
				</td>
				<td class="text-center d-none d-sm-table-cell">
					{{ $tp['gf'] }}
				</td>
				<td class="text-center d-none d-sm-table-cell">
					{{ $tp['gc'] }}
				</td>
				<td class="text-center d-none d-sm-table-cell">
					{{ $tp['avg'] }}
				</td>
				<td class="pt text-center">
					<strong>{{ $tp['pts'] }}</strong>
				</td>
			</tr>

		@endforeach
	</table>

</div>
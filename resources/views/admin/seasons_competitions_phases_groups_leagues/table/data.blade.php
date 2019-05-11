<div class="table-form-content table-results col-12 col-xl-9 animated fadeIn">

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
					@if ($loop->iteration < 3)
						<img src="https://upload.wikimedia.org/wikipedia/commons/5/52/Uefa_champions_league_logo.png" alt="">
					@elseif ($loop->iteration < 5)
						<img src="https://images-wixmp-ed30a86b8c4ca887773594c2.wixmp.com/f/b4df844d-29cf-487f-90c9-a64adee0f81e/d2yab2j-799fd838-d1f2-4d53-9278-1a836eb84ed3.png?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJ1cm46YXBwOjdlMGQxODg5ODIyNjQzNzNhNWYwZDQxNWVhMGQyNmUwIiwiaXNzIjoidXJuOmFwcDo3ZTBkMTg4OTgyMjY0MzczYTVmMGQ0MTVlYTBkMjZlMCIsIm9iaiI6W1t7InBhdGgiOiJcL2ZcL2I0ZGY4NDRkLTI5Y2YtNDg3Zi05MGM5LWE2NGFkZWUwZjgxZVwvZDJ5YWIyai03OTlmZDgzOC1kMWYyLTRkNTMtOTI3OC0xYTgzNmViODRlZDMucG5nIn1dXSwiYXVkIjpbInVybjpzZXJ2aWNlOmZpbGUuZG93bmxvYWQiXX0.XIwzaDFqOhBGHUymo4cD-feyQqyslu7F-_Psyc5Rb9U" alt="">
					@elseif ($loop->iteration == 8)
						<img src="https://upload.wikimedia.org/wikipedia/commons/thumb/0/04/Red_Arrow_Down.svg/1024px-Red_Arrow_Down.svg.png" alt="">
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
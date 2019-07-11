<div class="container py-3">
	<h4>Presupuesto: {{ $participant->budget() }} M.</h4>
	<table>
	    <colgroup>
	        <col width="0%" />
	        <col width="0%" />
	        <col width="100%"/>
	        <col width="0%" />
	    </colgroup>
	    <thead>
	        <tr>
				<th scope="col" class="p-1">Fecha</th>
				<th scope="col" class="text-center pl-3 pr-3">E/S</th>
				<th scope="col">Descripción</th>
				<th scope="col" class="text-right">Cantidad</th>
			</tr>
	    </thead>

	    <tbody>
		@foreach ($participant->cash_history->sortByDesc('created_at') as $cash_history)
			<tr class="border-top">
				<td class="p-1">
	                <small class="text-nowrap">{{ \Carbon\Carbon::parse($cash_history->created_at)->format('d/m/Y')}}</small>
				</td>
				<td class="text-center">
					@if ($cash_history->movement == "E")
						<i class="fas fa-piggy-bank text-success"></i>
					@else
						<i class="fas fa-piggy-bank text-danger"></i>
					@endif
				</td>
				<td>{{ $cash_history->description }}</td>
				<td class="text-right">
					@if ($cash_history->movement == "S")
					-
					@endif
					{{ $cash_history->amount }} M
				</td>
			</tr>
		@endforeach
		</tbody>
	</table>
</div>
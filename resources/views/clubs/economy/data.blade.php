<h4 class="title-position border-bottom">
	<div class="container clearfix">
		<span>Presupuesto: {{ $participant->budget() }} M.</span>
	</div>
</h4>

<div class="container p-0">
	<table class="table-economy">
	    <tbody>
		@php $cash = 0; @endphp
		@foreach ($participant->cash_history as $cash_history)
			@if ($cash_history->movement == "E")
				@php $cash += $cash_history->amount; @endphp
			@else
				@php $cash -= $cash_history->amount; @endphp
			@endif
			<tr class="data">
				<td class="date text-muted">
					<small class="text-nowrap">{{ \Carbon\Carbon::parse($cash_history->created_at)->format('d/m/Y - h:m')}}</small>
				</td>
				<td class="type text-muted">
					@if ($cash_history->movement == "E")
						<i class="fas fa-piggy-bank text-success mr-1"></i> <small>Entrada</small>
					@else
						<i class="fas fa-piggy-bank text-danger mr-1"></i> <small>Salida</small>
					@endif
				</td>
				<td class="movement">
					@if ($cash_history->movement == "S")
					-
					@endif
					{{ $cash_history->amount }} M
				</td>
				<td class="cash text-muted" width="80">
					<small>Caja: {{ $cash }} M</small>
				</td>
			</tr>
			<tr class="description">
				<td colspan="4">{{ $cash_history->description }}</td>
			</tr>
		@endforeach
		</tbody>
	</table>
</div>
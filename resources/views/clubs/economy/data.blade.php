<div class="title-position">
	<div class="container clearfix">
		<h4>Presupuesto: {{ $participant->budget() }} M.</h4>
	</div>
</div>

<div class="container p-3">
	@foreach ($participant->cash_history->sortByDesc('created_at') as $cash_history)
		<div class="economy-item">
			<div class="description">
				<small class="text-muted d-block">{{ \Carbon\Carbon::parse($cash_history->created_at)->format('d/m/Y - h:m')}}</small>
				{{ $cash_history->description }}
			</div>
			<div class="data clearfix shadow-sm">
				<div class="float-left">
					<div class="type text-muted">
						@if ($cash_history->movement == "E")
							<i class="fas fa-piggy-bank text-success mr-1"></i> <small>Entrada</small>
						@else
							<i class="fas fa-piggy-bank text-danger mr-1"></i> <small>Salida</small>
						@endif
					</div>
				</div>
				<div class="float-right">
					<div class="amount">
						@if ($cash_history->movement == "S")
						-
						@endif
						{{ $cash_history->amount }} M
					</div>
					<div class="cash text-muted" style="min-width: 80px">
						<small>Caja: {{ $cash_history->cash }} M</small>
					</div>
				</div>
			</div>
		</div>
	@endforeach
</div>
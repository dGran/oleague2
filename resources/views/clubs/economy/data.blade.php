<div class="title-position">
	<div class="container clearfix">
		<h4>Presupuesto: {{ $participant->budget() }} M.</h4>
	</div>
</div>

<div class="container p-3">
	<div class="economy">
		@foreach ($participant->cash_history->sortByDesc('created_at') as $cash_history)
			<div class="item shadow-sm">
				<div class="date text-muted">{{ \Carbon\Carbon::parse($cash_history->created_at)->format('d/m/Y - h:m')}}</div>
				<div class="description">
					<i class="fas fa-piggy-bank mr-2 {{ $cash_history->movement == "E" ? 'text-success' : 'text-danger' }}"></i>
					{{ $cash_history->description }}
				</div>
				<div class="data clearfix {{ $cash_history->movement == "E" ? 'money-in' : 'money-out' }}">
					<div class="float-left d-inline-block d-md-none">
						<div class="type text-muted">
							<i class="fas fa-piggy-bank mr-1 {{ $cash_history->movement == "E" ? 'text-success' : 'text-danger' }}"></i>
							<span>{{ $cash_history->movement == "E" ? 'Entrada' : 'Salida' }}</span>
						</div>
					</div>
					<div class="float-right">
						<div class="amount">
							{{ $cash_history->movement == "S" ? '-' : '' }}{{ $cash_history->amount }} M
						</div>
						<div class="cash text-muted" style="min-width: 80px">
							<small>Caja: {{ $cash_history->cash }} M</small>
						</div>
					</div>
				</div>
			</div>
		@endforeach
	</div>
</div>
<h4 class="title-position border-bottom">
	<div class="container clearfix">
		<span>Presupuesto: {{ $participant->budget() }} M.</span>
	</div>
</h4>

<div class="container p-3">
	@php $cash = 0; @endphp
	@foreach ($participant->cash_history as $cash_history)
		@if ($cash_history->movement == "E")
			@php $cash += $cash_history->amount; @endphp
		@else
			@php $cash -= $cash_history->amount; @endphp
		@endif
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
					<div class="cash text-muted" width="80">
						<small>Caja: {{ $cash }} M</small>
					</div>
				</div>
			</div>
		</div>
	@endforeach
</div>
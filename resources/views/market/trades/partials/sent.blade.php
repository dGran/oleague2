@if ($offers_sent->count() > 0)
	<table>
		@foreach ($offers_sent as $trade)
			@include('market.trades.card_data_sent')
		@endforeach
	</table>
@else
	<div class="row">
		<div class="col-12 col-lg-6 offset-lg-3 p-0">
			@include('market.trades.card_data_empty')
		</div>
	</div>
@endif
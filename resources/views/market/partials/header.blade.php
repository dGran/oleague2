<div class="market-header">
	<div class="container">
		<div class="logo">
			<img src="{{ asset('img/transfer_icon.png') }}">
		</div>
		<div class="title">
    		<h3>
    			Mercado de fichajes
    		</h3>
    		<span class="subtitle">
    			{{ active_season()->name }}
    		</span>
		</div>
	</div>
</div>

<div class="market-menu">
	<div class="container">
		@include('market.partials.menu')
	</div>
</div>
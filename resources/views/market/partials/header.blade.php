<div class="market-header">
	<div class="container">
		<div class="logo">
			<i class="icon-transfer"></i>
		</div>
		<div class="title">
    		<h3>
    			Mercado de fichajes
    		</h3>
    		<span class="subtitle">
    			{{ $season->name }}
    		</span>
			<div class="market-state">
				<span class="badge badge-{{ $season->change_salaries_period ? 'success' : 'secondary' }}">Salarios</span>
				<span class="badge badge-{{ $season->transfers_period ? 'success' : 'secondary' }}">Transfers</span>
				<span class="badge badge-{{ $season->free_players_period ? 'success' : 'secondary' }}">Libres</span>
				<span class="badge badge-{{ $season->clausules_period ? 'success' : 'secondary' }}">Claúsulas</span>
			</div>
		</div>
	</div>
</div>

<div class="market-menu">
	@include('market.partials.menu')
</div>
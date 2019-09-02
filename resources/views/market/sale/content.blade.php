<div class="sale">

	<div class="header">
		<div class="container">
			<h2 class="text-center">
				Jugadores transferibles, cedibles y en venta directa
			</h2>
			<div class="filters text-center p-2">
				<a data-toggle="modal" data-target="#filtersModal" id="btnFilters">
					<i class="fas fa-filter mr-1"></i>
					Filtros
				</a>
			</div>
		</div> {{-- container --}}
	</div> {{-- header --}}

	<div class="container">
		<section class="content">
			@if ($players->count() > 0)
				<div class="row py-2">
					@foreach ($players as $player)
						<div class="col-12 col-md-6 col-xl-4 py-1 px-3">
							@include('market.sale.card_data')
						</div>
					@endforeach
				</div> {{-- row --}}
			@else
				<div class="py-3 px-1 text-center">
					<h5>No se han encontrado resultados</h5>
					<figure class="text-center">
						<img class="img-fluid" src="https://media.giphy.com/media/12zV7u6Bh0vHpu/giphy.gif">
					</figure>
				</div>
			@endif
		</section> {{-- content --}}
	</div>
</div> {{-- sale --}}

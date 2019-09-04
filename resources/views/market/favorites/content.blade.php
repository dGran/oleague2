<div class="search">

	<div class="header">
		<div class="container">
			<h2 class="text-center">
				Lista de seguimiento
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
			{{-- search --}}
			<div class="row">
			    <div class="col-12 col-md-8 col-xl-6">
			    	<div class="searchbox">
				        <label class="search-icon" for="search-by"><i class="fas fa-search"></i></label>
				        <input class="search-input form-control mousetrap filterName" name="filterName" type="text" placeholder="Buscar..." value="{{ $filterName ? $filterName : '' }}" autocomplete="off" onkeypress="submitFilterForm()">
				        <span class="search-clear"><i class="fas fa-times"></i></span>
			        </div>
			    </div>
			</div>
			@if ($players->count() > 0)
				<div class="row">
					@foreach ($players as $player)
						<div class="col-12 col-md-6 col-xl-4 p-0">
							@include('market.favorites.card_data')
						</div>
					@endforeach
				</div> {{-- row --}}

			    <div class="regs-info clearfix py-3 px-1">
			        <div class="float-right">
			        	{!! $players->appends(Request::all())->render() !!}
						<div class="regs-info2 text-right pt-1 text-muted"><small>Registros: {{ $players->firstItem() }}-{{ $players->lastItem() }} de {{ number_format($players->total(), 0, ',', '.') }}</small></div>
			        </div>
			    </div>
			@else
				<div class="py-3 px-1 text-center">
					<h5>No se han encontrado resultados</h5>
					<figure class="text-center">
						<img class="img-fluid" src="https://media.giphy.com/media/12zV7u6Bh0vHpu/giphy.gif">
					</figure>
				</div>
			@endif
		</section> {{-- content --}}
	</div> {{-- container --}}
</div> {{-- sale --}}

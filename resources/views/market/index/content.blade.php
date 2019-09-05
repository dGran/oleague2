<div class="transfer">

	<div class="header">
		<div class="container">
			<h2 class="text-center">
				Resumen del mercado
			</h2>
		</div> {{-- container --}}
	</div> {{-- header --}}

	<div class="container">
		<section class="content">
			{{-- search --}}
			<div class="row">
			    <div class="col-12 col-md-8 col-xl-6">
			    	<form class="frmFilter" role="search" method="get" action="{{ route('market') }}">
				    	<div class="searchbox">
					        <label class="search-icon" for="search-by"><i class="fas fa-search"></i></label>
					        <input class="search-input form-control mousetrap filterName" name="filterName" type="text" placeholder="Buscar..." value="{{ $filterName ? $filterName : '' }}" autocomplete="off" onkeypress="submitFilterForm()">
					        <span class="search-clear"><i class="fas fa-times"></i></span>
				        </div>
			    	</form>
			    </div>
			</div>

<div class="player-card" style="background-image: url(https://www.pesmaster.com//pes-2020/graphics/cards/000_l.png);">
    <div class="player-card-ovr">93</div>
    <div class="player-card-position">LWF</div>
    <div class="player-card-name">C. Ronaldo</div>
            <img class="player-card-teamlogo" src="https://www.pesmaster.com//pes-2020/graphics/teamlogos/e_000120.png">
        <img class="player-card-image" src="https://www.pesmaster.com//pes-2020/graphics/players/player_4522.png">
    <div class="stats-col-1">
        88 <span class="player-card-stats-name">SPD</span><br>
        89 <span class="player-card-stats-name">DRI</span><br>
        83 <span class="player-card-stats-name">PAS</span>
    </div>
    <div class="stats-col-2">
        91 <span class="player-card-stats-name">SHT</span><br>
        86 <span class="player-card-stats-name">PHY</span><br>
        49 <span class="player-card-stats-name">DEF</span>
    </div>
    <div class="stats-col-bg"></div>
            <a href="/c-ronaldo/pes-2020/player/4522/">
            <div class="player-card-clicktrap"></div>
        </a>
    </div>

			@if ($players->count() > 0)
				<div class="row py-2">
					@foreach ($players as $player)
						<div class="col-12 col-md-6 col-xl-4 py-1 px-3">
							@include('market.index.card_data')
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
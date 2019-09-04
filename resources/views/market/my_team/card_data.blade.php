<div class="wrap col-12 col-md-6 col-xl-4">
	<div class="item">

		<img class="player-img" src="{{ $player->player->getImgFormatted() }}" alt="" >
		<div class="position" style="background: {{ $player->player->getPositionColor() }};">
			<span class='text'>
				<small>{{ $player->player->position }}</small>
			</span>
		</div>

		<img class="ball-img" src="{{ asset($player->player->getBall()) }}">
		<span class="player-name">
			{{ $player->player->name }}
			<a class="player-info" data-toggle="modal" data-target="#viewModal" id="btnView" data-id="{{ $player->id }}">
				<i class="fas fa-info-circle"></i>
			</a>
		</span>

		<div id="player_favorite{{ $player->id}}" class="d-inline-block">
			@include('market.partials.favorite')
		</div>

		<div class="overall" style="background: {{ $player->player->getOverallRatingColor() }};">
		    <span>{{ $player->player->overall_rating }}</span>
		</div>

		<div class="salary">
			<span>
				Salario: {{ number_format($player->salary, 2, ',', '.') }} mill.
			</span>
		</div>

		<div class="clause">
			<span>
				Claúsula: {{ number_format($player->price, 2, ',', '.') }} mill.
			</span>
		</div>

		<span class="market-icons transferable {{ !$player->transferable ? 'off' : '' }}">TRA</span>
		<span class="market-icons on-loan {{ !$player->player_on_loan ? 'off' : '' }}">CED</span>
		<span class="market-icons untransferable {{ !$player->untransferable ? 'off' : '' }}">INT</span>

		@if ($player->sale_price > 0)
			<div class="sale-price">
				<span>
					Precio venta: {{ number_format($player->sale_price, 2, ',', '.') }} mill.
				</span>
			</div>
		@endif

		<div class="actions">
			<div class="dropdown dropleft">
				<button class="btn btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					Acciones
				</button>
				<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
					<h6 class="dropdown-header">
						{{ $player->player->name }}
					</h6>
					<a class="dropdown-item" href="" data-toggle="modal" data-target="#editModal" id="btnEdit" data-id="{{ $player->id }}">
						Editar
					</a>
					<div class="dropdown-divider"></div>
					<a class="dropdown-item {{ $player->untransferable ? 'disabled' : '' }}" href="{{ route('market.my_team.player.tags.untransferable', $player->id) }}">
						Declarar intransferible
					</a>
					<a class="dropdown-item {{ $player->transferable ? 'disabled' : '' }}" href="{{ route('market.my_team.player.tags.transferable', $player->id) }}">
						Declarar transferible
					</a>
					<a class="dropdown-item {{ $player->player_on_loan ? 'disabled' : '' }}" href="{{ route('market.my_team.player.tags.on_loan', $player->id) }}">
						Declarar cedible
					</a>
					<a class="dropdown-item" href="{{ route('market.my_team.player.tags.delete', $player->id) }}">
						Eliminar etiquetas
					</a>
					<div class="dropdown-divider"></div>
					<a class="dropdown-item text-danger" href="" onclick="dismiss_player('{{ $player->id }}', '{{ $player->player->name }}', '{{ number_format($player->season->free_players_remuneration, 2, ',', '.') }}')">
						Despedir
					</a>
				</div> {{-- dropdown-menu --}}
			</div> {{-- dropdown --}}
		</div>
	</div>
</div>
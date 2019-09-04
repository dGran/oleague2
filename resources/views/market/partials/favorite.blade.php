@if (is_favourite_player($player->id))
	<a class="player-favorite" onclick="removeFavorite('{{ $player->id}}', '{{ participant_of_user()->id }}')">
		<i class="fab fa-gratipay {{ is_favourite_player($player->id) ? 'active' : 'inactive' }}"></i>
	</a>
@else
	<a class="player-favorite" onclick="addFavorite('{{ $player->id}}', '{{ participant_of_user()->id }}')">
		<i class="fab fa-gratipay {{ is_favourite_player($player->id) ? 'active' : 'inactive' }}"></i>
	</a>
@endif

<ul>
	<li class="{{ \Route::current()->getName() == 'club' ? 'active' : '' }}">
		<a href="{{ route('club', $participant->team->slug) }}">
			<div>
				<img src="{{ asset('img/clubs/stadium.png') }}" alt="Club">
			</div>
			<span>
				Club
			</span>
		</a>
	</li>
	<li class="{{ \Route::current()->getName() == 'club.roster' ? 'active' : '' }}">
		<a href="{{ route('club.roster', $participant->team->slug) }}">
			<div>
				<img src="{{ asset('img/clubs/roster.png') }}" alt="Plantilla">
			</div>
			<span>
				Plantilla
			</span>
		</a>
	</li>
	<li class="{{ \Route::current()->getName() == 'club.economy' ? 'active' : '' }}">
		<a href="{{ route('club.economy', $participant->team->slug) }}">
			<div>
				<img src="{{ asset('img/clubs/economy.png') }}" alt="Economía">
			</div>
			<span>
				Economía
			</span>
		</a>
	</li>
	<li class="{{ \Route::current()->getName() == 'club.results' ? 'active' : '' }}">
		<a href="{{ route('club.results', $participant->team->slug) }}">
			<div>
				<img src="{{ asset('img/clubs/matchs.png') }}" alt="Resultados">
			</div>
			<span>
				Resultados
			</span>
		</a>
	</li>
	<li class="{{ \Route::current()->getName() == 'club.press' ? 'active' : '' }}">
		<a href="{{ route('club.press', $participant->team->slug) }}">
			<div>
				<img src="{{ asset('img/microphone.png') }}" alt="Prensa">
			</div>
			<span>
				Prensa
			</span>
		</a>
	</li>
</ul>

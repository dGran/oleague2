<div class="navigator">
	<div class="container">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
				<li class="breadcrumb-item"><a href="{{ route('market') }}">Mercado de fichajes</a></li>
				<li class="breadcrumb-item"><a href="{{ route('market.teams') }}">Equipos</a></li>
				<li class="breadcrumb-item active" aria-current="page">{{ $participant->name() }}</li>
			</ol>
		</nav>
	</div>
</div>
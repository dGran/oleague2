<div class="navigator">
	<div class="container">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
				<li class="breadcrumb-item"><a href="{{ route('clubs') }}">Clubs</a></li>
				<li class="breadcrumb-item"><a href="{{ route('club', [$season_slug, $participant->team->slug]) }}">{{ $participant->name() }}</a></li>
				<li class="breadcrumb-item active" aria-current="page">Economía</li>
			</ol>
		</nav>
	</div>
</div>
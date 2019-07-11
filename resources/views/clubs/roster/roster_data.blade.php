<h4 class="title-section">
	<div class="container clearfix">
		<span>Total: {{ $participant->players->count() }} jugadores</span>
		<a href="" class="text-dark">
			<i class="fas fa-id-card"></i>
		</a>
		<a href="" class="text-dark">
			<i class="fas fa-th-list mr-3"></i>
		</a>
	</div>
</h4>

<h4 class="title-position">
	<div class="container clearfix">
		<span>Porteros</span>
		<img class="d-block d-md-none" src="{{ asset('img/clubs/pt.png') }}">
	</div>
</h4>
<div class="container">
	<div class="row pb-3">
		@foreach ($participant->players as $player)
			@if ($player->player->position == 'PT')
				@include('clubs.roster.card_data')
			@endif
		@endforeach
	</div>
</div>

<h4 class="title-position">
	<div class="container clearfix">
		<span>Defensas</span>
		<img src="{{ asset('img/clubs/ct.png') }}">
	</div>
</h4>
<div class="container">
	<div class="row pb-3">
		@foreach ($participant->players as $player)
			@if ($player->player->position == 'CT' || $player->player->position == 'LD' || $player->player->position == 'LI')
				@include('clubs.roster.card_data')
			@endif
		@endforeach
	</div>
</div>

<h4 class="title-position">
	<div class="container clearfix">
		<span>Medios</span>
		<img src="{{ asset('img/clubs/mc.png') }}">
	</div>
</h4>
<div class="container">
	<div class="row pb-3">
		@foreach ($participant->players as $player)
			@if ($player->player->position == 'MCD' || $player->player->position == 'MC' || $player->player->position == 'MP' || $player->player->position == 'II' || $player->player->position == 'ID')
				@include('clubs.roster.card_data')
			@endif
		@endforeach
	</div>
</div>

<h4 class="title-position">
	<div class="container clearfix">
		<span>Delanteros</span>
		<img src="{{ asset('img/clubs/dc.png') }}">
	</div>
</h4>
<div class="container">
	<div class="row pb-3">
		@foreach ($participant->players as $player)
			@if ($player->player->position == 'DC' || $player->player->position == 'SD' || $player->player->position == 'EI' || $player->player->position == 'ED')
				@include('clubs.roster.card_data')
			@endif
		@endforeach
	</div>
</div>
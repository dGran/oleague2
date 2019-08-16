<div style="padding: 1em .5em; background: #E5E5E5; position: relative">
	<img src="{{ $participant->logo() }}" width="64">
	<div class="d-inline-block align-middle">
		<span class="">
			<strong>{{ $participant->name() }}</strong>
		</span>
		<small class="d-block">
			{{ $participant->sub_name() }}
		</small>
	</div>
	<div style="position: absolute; right: 8px; top: 8px; line-height: 1.1em" class="text-right">
		<span class="d-block text-uppercase" style="font-size: .7em">Presupuesto</span>
		<span class="d-inline-block" style="font-size: 1.25em; font-weight: bold">
			{{ number_format($participant->budget(), 2, ',', '.') }}
		</span>
		<small class="d-inline-block" style="font-size: .9em">mill.</small>

		<span class="d-block text-uppercase pt-2" style="font-size: .7em">salarios</span>
		<span class="d-inline-block" style="font-size: .9em; font-weight: bold">
			{{ number_format($participant->salaries(), 2, ',', '.') }}
		</span>
		<small class="d-inline-block" style="font-size: .7em">mill.</small>

{{-- 		<span class="d-block" style="font-size: .9em">Salarios</span>
		<span class="d-inline-block" style="font-size: .9em; font-weight: bold">
			{{ number_format($participant->salaries(), 2, ',', '.') }}
		</span>
		<small class="d-inline-block" style="font-size: .7em">mill.</small> --}}
	</div>

</div>

<section class="positions gk">
	<h4 class="title-position">
		<div class="container clearfix">
			<span>Porteros</span>
			<img class="d-block d-md-none" src="{{ asset('img/clubs/pt.png') }}" width="16">
		</div>
	</h4>
	<div class="container">
		<div class="row pb-3">
			@foreach ($players as $player)
				@if ($player->player->position == 'PT')
					@include('market.my_team.card_data')
				@endif
			@endforeach
		</div>
	</div>
</section>

<section class="positions df">
	<h4 class="title-position">
		<div class="container clearfix">
			<span>Defensas</span>
			<img src="{{ asset('img/clubs/ct.png') }}" width="16">
		</div>
	</h4>
	<div class="container">
		<div class="row pb-3">
			@foreach ($players as $player)
				@if ($player->player->position == 'CT' || $player->player->position == 'LD' || $player->player->position == 'LI')
					@include('market.my_team.card_data')
				@endif
			@endforeach
		</div>
	</div>
</section>

<section class="positions md">
	<h4 class="title-position">
		<div class="container clearfix">
			<span>Medios</span>
			<img src="{{ asset('img/clubs/mc.png') }}" width="16">
		</div>
	</h4>
	<div class="container">
		<div class="row pb-3">
			@foreach ($players as $player)
				@if ($player->player->position == 'MCD' || $player->player->position == 'MC' || $player->player->position == 'MP' || $player->player->position == 'MD' || $player->player->position == 'MI')
					@include('market.my_team.card_data')
				@endif
			@endforeach
		</div>
	</div>
</section>

<section class="positions md">
	<h4 class="title-position">
		<div class="container clearfix">
			<span>Delanteros</span>
			<img src="{{ asset('img/clubs/dc.png') }}" width="16">
		</div>
	</h4>
	<div class="container">
		<div class="row pb-3">
			@foreach ($players as $player)
				@if ($player->player->position == 'DC' || $player->player->position == 'SD' || $player->player->position == 'EI' || $player->player->position == 'ED')
					@include('market.my_team.card_data')
				@endif
			@endforeach
		</div>
	</div>
</section>
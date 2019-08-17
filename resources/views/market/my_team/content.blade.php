<div style="background: #f9f9f9; position: relative">
	<div class="p-2" style="background: #f9f9f9; position: relative">
		<img src="{{ $participant->logo() }}" width="75" class="align-top p-1 rounded-circle mr-3" style="-webkit-box-shadow: 14px 0px 9px -11px rgba(148,148,148,1);
-moz-box-shadow: 14px 0px 9px -11px rgba(148,148,148,1);
box-shadow: 14px 0px 9px -11px rgba(148,148,148,1);">
		<div class="d-inline-block">
			<span class="m-0" style="font-size: 1.35em; font-weight: bold;">
				{{ $participant->name() }}
			</span>
			<span class="d-block text-muted" style="font-size: .8em">
				<strong>Manager: </strong>{{ $participant->sub_name() }}
			</span>
			<div class="d-inline-block">
				<img src="https://image.flaticon.com/icons/svg/2000/2000597.svg" alt="" width="16" class="mr-1">
				<span class="text-muted" style="font-size: .7em">
					{{ number_format($participant->budget(), 2, ',', '.') }} M.
				</span>
			</div>
			<div class="d-inline-block">
				<img src="https://image.flaticon.com/icons/svg/1319/1319523.svg" alt="" width="16" class="ml-2 mr-1">
				<span style="font-size: .7em">
					{{ number_format($participant->salaries(), 2, ',', '.') }} M.
				</span>
			</div>
			<div class="d-inline-block">
				<img src="https://image.flaticon.com/icons/svg/56/56950.svg" alt="" width="16" class="ml-2 mr-1">
				<span class="text-muted" style="font-size: .7em">
					{{ $participant->players->count() }} jug.
				</span>
			</div>

		</div>
	</div>
</div>

<section class="positions gk">
	<h5 class="title-position m-0">
		<div class="container clearfix p-2 border-top border-bottom" style="background: #eceaee">
			<span class="float-left">Porteros</span>
			<img class="d-block d-md-none float-right mt-1" src="{{ asset('img/clubs/pt.png') }}" width="16">
		</div>
	</h5>
	<div class="container">
		<div class="row pb-2">
			@foreach ($players as $player)
				@if ($player->player->position == 'PT')
					@include('market.my_team.card_data')
				@endif
			@endforeach
		</div>
	</div>
</section>

<section class="positions df">
	<h5 class="title-position m-0">
		<div class="container clearfix p-2 border-top border-bottom" style="background: #eceaee">
			<span class="float-left">Defensas</span>
			<img class="d-block d-md-none float-right mt-1" src="{{ asset('img/clubs/ct.png') }}" width="16">
		</div>
	</h5>
	<div class="container">
		<div class="row pb-2">
			@foreach ($players as $player)
				@if ($player->player->position == 'CT' || $player->player->position == 'LD' || $player->player->position == 'LI')
					@include('market.my_team.card_data')
				@endif
			@endforeach
		</div>
	</div>
</section>

<section class="positions md">
	<h5 class="title-position m-0">
		<div class="container clearfix p-2 border-top border-bottom" style="background: #eceaee">
			<span class="float-left">Medios</span>
			<img class="d-block d-md-none float-right mt-1" src="{{ asset('img/clubs/mc.png') }}" width="16">
		</div>
	</h5>
	<div class="container">
		<div class="row pb-2">
			@foreach ($players as $player)
				@if ($player->player->position == 'MCD' || $player->player->position == 'MC' || $player->player->position == 'MP' || $player->player->position == 'MD' || $player->player->position == 'MI')
					@include('market.my_team.card_data')
				@endif
			@endforeach
		</div>
	</div>
</section>

<section class="positions md">
	<h5 class="title-position m-0">
		<div class="container clearfix p-2 border-top border-bottom" style="background: #eceaee">
			<span class="float-left">Delanteros</span>
			<img class="d-block d-md-none float-right mt-1" src="{{ asset('img/clubs/dc.png') }}" width="16">
		</div>
	</h5>
	<div class="container">
		<div class="row pb-2">
			@foreach ($players as $player)
				@if ($player->player->position == 'DC' || $player->player->position == 'SD' || $player->player->position == 'EI' || $player->player->position == 'ED')
					@include('market.my_team.card_data')
				@endif
			@endforeach
		</div>
	</div>
</section>
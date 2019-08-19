<div style="background: #f9f9f9; position: relative">

	<div class="p-2" style="background: #f9f9f9; position: relative">
		<img src="{{ $participant->logo() }}" width="75" class="align-top p-1 rounded-circle mr-3" style="-webkit-box-shadow: 14px 0px 9px -11px rgba(148,148,148,1);
-moz-box-shadow: 14px 0px 9px -11px rgba(148,148,148,1);
box-shadow: 14px 0px 9px -11px rgba(148,148,148,1);">
		<div class="d-inline-block pt-2">
			<span class="m-0" style="font-size: 1.35em; font-weight: bold;">
				{{ $participant->name() }}
			</span>
			<span class="d-block text-muted" style="font-size: .8em">
				<strong>Manager: </strong>{{ $participant->sub_name() }}
			</span>
{{-- 			<div class="d-inline-block">
				<img src="https://image.flaticon.com/icons/svg/2000/2000597.svg" alt="" width="14" class="mr-1">
				<span class="text-muted" style="font-size: .7em">
					{{ number_format($participant->budget(), 2, ',', '.') }} M.
				</span>
			</div>
			<div class="d-inline-block">
				<img src="https://image.flaticon.com/icons/svg/1319/1319523.svg" alt="" width="14" class="ml-2 mr-1">
				<span class="text-muted" style="font-size: .7em">
					{{ number_format($participant->salaries(), 2, ',', '.') }} M.
				</span>
			</div>
			<div class="d-inline-block">
				<img src="https://image.flaticon.com/icons/svg/56/56950.svg" alt="" width="14" class="ml-2 mr-1">
				<span class="text-muted" style="font-size: .7em">
					{{ $participant->players->count() }} jug.
				</span>
			</div>
			<div class="d-block" style="line-height: .8em">
				<span class="text-muted" style="font-size: .7em;">
					@if ($participant->salaries() > active_season()->salary_cap)
						<i class="fas fa-exclamation-triangle text-warning"></i>
					@endif
					Tope salarial: {{ number_format(active_season()->salary_cap, 2, ',', '.') }} M.
				</span>
			</div> --}}
		</div>
	</div>

	<div class="" style="background: #fff;">
    	<div class="clearfix py-1 px-2 align-middle" style="font-size: .9em; border-top: 1px solid #f1eff3; line-height: 1.8em">
    		<span class="float-left text-muted">
    			Presupuesto
    		</span>
    		<div class="float-right" style="font-size: 1.2em; font-weight: bold">
                <img src="https://image.flaticon.com/icons/svg/1803/1803103.svg" alt="" width="20" class="mr-1">
                {{ number_format($participant->budget(), 2, ',', '.') }} M.
    		</div>
    	</div>
    	<div class="clearfix py-1 px-2" style="font-size: .9em; border-top: 1px solid #f1eff3">
    		<span class="float-left text-muted">
    			Total salarios
    		</span>
    		<div class="float-right text-right">
                {{ number_format($participant->salaries(), 2, ',', '.') }} M.<small class="d-block text-muted ml-2">Tope salarial: {{ number_format(active_season()->salary_cap, 2, ',', '.') }} M.</small>
    		</div>
    	</div>
    	<div class="clearfix py-1 px-2" style="font-size: .9em; border-top: 1px solid #f1eff3">
    		<span class="float-left text-muted">
    			Salario medio
    		</span>
    		<div class="float-right text-right">
                {{ number_format($participant->salaries_avg(), 2, ',', '.') }} M.
    		</div>
    	</div>
    	<div class="clearfix py-1 px-2" style="font-size: .9em; border-top: 1px solid #f1eff3">
    		<span class="float-left text-muted">
    			Claúsulas pagadas
    		</span>
    		<div class="float-right text-right">
                {{ $participant->paid_clauses }} / {{ active_season()->max_clauses_paid }}
    		</div>
    	</div>
    	<div class="clearfix py-1 px-2" style="font-size: .9em; border-top: 1px solid #f1eff3">
    		<span class="float-left text-muted">
    			Claúsulas recibidas
    		</span>
    		<div class="float-right text-right">
                {{ $participant->clauses_received }} / {{ active_season()->max_clauses_received }}
    		</div>
    	</div>
    	<div class="clearfix py-1 px-2" style="font-size: .9em; border-top: 1px solid #f1eff3">
    		<span class="float-left text-muted">
    			Plantilla
    		</span>
    		<div class="float-right text-right">
                {{ $participant->players->count() }} jug.<small class="d-block text-muted ml-2">{{ active_season()->min_players }} min. / {{ active_season()->max_players }} max.</small>
    		</div>
    	</div>
    	<div class="clearfix py-1 px-2" style="font-size: .9em; border-top: 1px solid #f1eff3">
    		<span class="float-left text-muted">
    			Valoración media
    		</span>
    		<div class="float-right text-right">
                {{ number_format($participant->team_avg_overall(), 2, ',', '.') }}
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
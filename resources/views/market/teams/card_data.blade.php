@if ($participant->team)
<a href="{{ route('market.team', [$season_slug, $participant->team->slug]) }}">
	<div class="item">
		<img class="team-img" src="{{ $participant->logo() }}">
		<div class="title">
			<span class="name">
				{{ $participant->name() }}
			</span> {{-- name --}}
			<span class="subname">
				{{ $participant->sub_name() }}
			</span> {{-- name --}}
		</div> {{-- title --}}
		{{-- <i class="budget-icon icon-safe-box"></i> --}}
		<div class="budget text-right">
			<div class="d-block">
				<small class="text-muted mr-2">PRESUPUESTO</small>
				{{ number_format($participant->budget(), 2, ',', '.') }} <span class="measure">M.</span>
			</div>
			<div class="d-block mt-2">
				{{ $participant->players->count() }}
				<small class="text-muted ml-1">JUGADORES</small>
			</div>
			<div class="d-block">
				<small class="text-muted mr-2">CLAUSULAS PAGADAS</small>
				{{ $participant->paid_clauses }} / {{ active_season()->max_clauses_paid }}
			</div>
			<div class="d-block">
				<small class="text-muted mr-2">CLAUSULAS RECIBIDAS</small>
				{{ $participant->clauses_received }} / {{ active_season()->max_clauses_received }}
			</div>
		</div> {{-- budget --}}
	</div> {{-- item --}}
</a>
@endif
<a href="{{ route('market.team', $participant->team->slug) }}">
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
		<i class="budget-icon icon-safe-box"></i>
		<div class="budget">
			{{ number_format($participant->budget(), 2, ',', '.') }} <span class="measure">mill.</span>
		</div> {{-- budget --}}
	</div> {{-- item --}}
</a>
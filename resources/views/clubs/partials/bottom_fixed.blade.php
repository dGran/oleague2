<div class="bottom-fixed">
	<div class="container">
		<div class="scrolling-wrapper">
			@foreach ($participants as $part)
				<div class="card participants {{ $part->id == $participant->id ? 'active' : ''}}">
					{{-- \Route::current()->getName() --}}
					<a href="{{route(\Route::current()->getName(), [$season_slug, $part->team->slug]) }}">
						<img src="{{ $part->logo() }}" alt="{{ $part->name() }}">
						<span>{{ $part->name() }}</span>
					</a>
				</div>
			@endforeach
		</div> {{-- scrolling-wrapper --}}
	</div> {{-- container --}}
</div> {{-- bottom-fixed --}}
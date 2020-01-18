<div class="bottom-fixed">
	<div class="container">
		<div class="scrolling-wrapper">
			@foreach ($competitions as $comp)
				<div class="card competitions {{ $comp->slug == $competition->slug ? 'active' : ''}}">
					{{-- \Route::current()->getName() --}}
					<a href="{{route(\Route::current()->getName(), [active_season()->slug, $comp->slug]) }}">
						<img src="{{ $comp->getImgFormatted() }}" alt="{{ $comp->name }}" class="rounded">
						<span>{{ $comp->name }}</span>
					</a>
				</div>
			@endforeach
		</div> {{-- scrolling-wrapper --}}
	</div> {{-- container --}}
</div> {{-- bottom-fixed --}}
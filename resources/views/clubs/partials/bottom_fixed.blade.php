<div class="bottom-fixed">
	<div class="container">
		<div class="scrolling-wrapper">
			@foreach ($participants as $participant)
				<div class="card participants">
					{{-- \Route::current()->getName() --}}
					<a href="{{route(\Route::current()->getName(), $participant->team->slug) }}">
						<img src="{{ $participant->logo() }}" alt="{{ $participant->name() }}">
						<span>{{ $participant->name() }}</span>
					</a>
				</div>
			@endforeach
		</div> {{-- scrolling-wrapper --}}
	</div> {{-- container --}}
</div> {{-- bottom-fixed --}}
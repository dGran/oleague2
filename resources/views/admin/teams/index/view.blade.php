<div class="modal-content">
    <div class="modal-header bg-light">
    	#{{ $team->id }} - {{ $team->name }}
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body text-center">
		<div class="">
			<figure class="p-2">
				<img src="{{ $team->getLogoFormatted() }}" alt="" width="128">
			</figure>
			<h4 class="m-0">{{ $team->name }}</h4>
			<h5 class="mt-2">{{ $team->category->name }}</h5>
		</div>
    </div>
</div>
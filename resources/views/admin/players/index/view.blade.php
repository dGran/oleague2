<div class="modal-content">
    <div class="modal-header bg-light">
    	#{{ $player->id }} - {{ $player->name }}
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body text-center">
		<div class="">
			<figure class="p-2">
				<img src="{{ $player->getImgFormatted() }}" alt="" width="128">
			</figure>
			<h4 class="m-0">{{ $player->name }}</h4>
            @if ($player->playerDb)
                <h5 class="mt-2">{{ $player->playerDb->name }}</h5>
            @endif
		</div>
    </div>
</div>
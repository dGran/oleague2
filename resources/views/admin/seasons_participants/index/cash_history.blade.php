<div class="modal-content">
    <div class="modal-header bg-light">
        <h4 class="m-0">Historial de economía</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

    <div class="modal-body">
    	<ul>
    	@foreach ($participant->cash_history as $cash_history)
			<li>{{ $cash_history->movement }}</li>
			<li>{{ $cash_history->description }}</li>
			<li>{{ $cash_history->amount }}</li>
    	@endforeach
    	</ul>


    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-primary">Ok</button>
    </div>
</div>
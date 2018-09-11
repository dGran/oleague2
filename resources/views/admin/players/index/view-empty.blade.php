<div class="modal-content">
    <div class="modal-header bg-light">
    	<h4>Error!</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body text-center">
		<p>
			<strong>El jugador ya no existe.</strong>
		</p>
		Por favor, recarga la página para actualizar los datos.
		<a href="{{ route("admin.players") }}" class="mt-3 d-block btn btn-primary">Recargar la página</a>
    </div>
</div>
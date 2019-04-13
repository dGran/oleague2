<div class="modal fade" id="assignModal" tabindex="-1" role="dialog" aria-labelledby="assignModalLongTitle" aria-hidden="true" data-backdrop="false" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h4 class="m-0">Asignar jugadores a participante</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
				<label for="participants">Participante</label>
				<select class="selectpicker form-control participants" id="participants" data-size="3" data-live-search="true">
				    <option value="0">LIBRE</option>
				    @foreach ($participants as $participant)
				        <option value="{{ $participant->id }}">{{ $participant->name() }}</option>
				    @endforeach
				</select>
            </div>

            <div class="modal-footer">
                <a href="" onclick="transferMany()" class="btn btn-primary">Asignar participante</a>
            </div>

        </div>
    </div>
</div>
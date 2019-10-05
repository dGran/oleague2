<div class="modal fade" id="assignPackModal" tabindex="-1" role="dialog" aria-labelledby="assignPackModalLongTitle" aria-hidden="true" data-backdrop="false" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h4 class="m-0">Asignar jugadores al pack</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
				<label for="packs">Pack</label>
				<select class="selectpicker form-control packs" id="packs" data-live-search="true">
				    <option value="0">Ninguno</option>
				    @foreach ($packs as $pack)
				        <option value="{{ $pack->id }}">{{ $pack->name }}</option>
				    @endforeach
				</select>
            </div>

            <div class="modal-footer">
                <a href="" onclick="assingPackMany()" class="btn btn-primary">Asignar pack</a>
            </div>

        </div>
    </div>
</div>
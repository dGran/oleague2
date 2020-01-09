<form
    id="frmAdd"
    lang="{{ app()->getLocale() }}"
    role="form"
    method="POST"
    action="{{ route('admin.season_cash_history.save', $season->id) }}"
    enctype="multipart/form-data"
    data-toggle="validator"
    autocomplete="off">
    {{ csrf_field() }}

    <input type="hidden" name="season_id" value="{{ $season->id }}">

    <div class="table-form-content col-12 col-lg-8 col-xl-6 p-md-3 animated fadeIn">
        <div class="form-group row pt-2">
            <label for="movement" class="col-sm-3 col-form-label">Movimiento</label>
            <div class="col-sm-9">
                <select class="selectpicker form-control" name="movement" id="movement" data-size="3" data-live-search="true">
                    <option value="E">Entrada</option>
                    <option value="S">Salida</option>
                </select>
            </div>
        </div>
        <div class="form-group row pt-2">
            <label for="amount" class="col-sm-3 col-form-label">Cantidad</label>
            <div class="col-sm-9">
                <input type="number" class="form-control" id="amount" name="amount" placeholder="Cantidad" value="{{ old('amount', 0) }}" min="0" step="any">
            </div>
        </div>
        <div class="form-group row pt-2">
            <label for="description" class="col-sm-3 col-form-label">Descripción</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="description" name="description" placeholder="Descripción" value="{{ old('description') }}">
            </div>
        </div>
        <div class="form-group row">
            <label for="participant_id" class="col-sm-3 col-form-label">Participante</label>
            <div class="col-sm-9">
                <select class="selectpicker form-control" name="participant_id" id="participant_id" data-live-search="true">
                    <option value="0">Todos los participantes</option>
                    @foreach ($participants as $participant)
                        <option value="{{ $participant->id }}">{{ $participant->name() }} ({{$participant->budget()}} M.)</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <div class="table-form-footer col-12 col-lg-8 col-xl-6 pt-3 px-3 px-md-0">
        <input type="submit" class="btn btn-primary border border-primary" value="Guardar" id="btnSave">
        <div class="no-close custom-control custom-checkbox mt-2">
            <input type="checkbox" class="custom-control-input" id="telegram" name="telegram" checked>
            <label class="custom-control-label is-valid" for="telegram">Notificar por Telegram</label>
        </div>
        <div class="no-close custom-control custom-checkbox mt-2">
            <input type="checkbox" class="custom-control-input" id="no_close" name="no_close">
            <label class="custom-control-label is-valid" for="no_close">Insertar nuevo registro</label>
        </div>
    </div>

</form>
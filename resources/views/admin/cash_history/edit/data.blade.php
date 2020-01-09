<form
    id="frmEdit"
    lang="{{ app()->getLocale() }}"
    role="form"
    method="POST"
    action="{{ route('admin.season_cash_history.update', $cash->id) }}"
    enctype="multipart/form-data"
    data-toggle="validator"
    autocomplete="off">
    {{ method_field('PUT') }}
    {{ csrf_field() }}

    <div class="table-form-content col-12 col-lg-8 col-xl-6 p-md-3 animated fadeIn">

        <div class="form-group row pt-2">
            <label for="movement" class="col-sm-3 col-form-label">Movimiento</label>
            <div class="col-sm-9">
                <select class="selectpicker form-control" name="movement" id="movement" data-size="3" data-live-search="true">
                    <option {{ $cash->movement == 'E' ? 'selected' : '' }} value="E">Entrada</option>
                    <option {{ $cash->movement == 'S' ? 'selected' : '' }} value="S">Salida</option>
                </select>
            </div>
        </div>
        <div class="form-group row pt-2">
            <label for="amount" class="col-sm-3 col-form-label">Cantidad</label>
            <div class="col-sm-9">
                <input type="number" class="form-control" id="amount" name="amount" placeholder="Cantidad" value="{{ old('name', $cash->amount) }}" min="0" step="any">
            </div>
        </div>
        <div class="form-group row pt-2">
            <label for="description" class="col-sm-3 col-form-label">Descripción</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="description" name="description" placeholder="Descripción" value="{{ old('description', $cash->description) }}">
            </div>
        </div>
        <div class="form-group row">
            <label for="participant_id" class="col-sm-3 col-form-label">Participante</label>
            <div class="col-sm-9">
                <select class="selectpicker form-control" name="participant_id" id="participant_id" data-live-search="true">
                    @foreach ($participants as $participant)
                        <option {{ $cash->participant_id == $participant->id ? 'selected' : '' }}  value="{{ $participant->id }}">{{ $participant->name() }} ({{$participant->budget()}} M.)</option>
                    @endforeach
                </select>
            </div>
        </div>

    </div>

    <div class="table-form-footer col-12 col-lg-8 col-xl-6 pt-3 px-3 px-md-0">
        <input type="submit" class="btn btn-primary border border-primary" value="Guardar" id="btnSave">
    </div>

</form>
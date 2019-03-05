<form
    id="frmEdit"
    lang="{{ app()->getLocale() }}"
    role="form"
    method="POST"
    action="{{ route('admin.season_players.update', $player->id) }}"
    enctype="multipart/form-data"
    data-toggle="validator"
    autocomplete="off">
    {{ method_field('PUT') }}
    {{ csrf_field() }}

    <div class="table-form-content col-12 col-lg-8 col-xl-6 p-md-3 animated fadeIn">

        <div class="form-group row">
            <label for="participant_id" class="col-sm-3 col-form-label">Participante</label>
            <div class="col-sm-9">
                <select class="selectpicker form-control" name="participant_id" id="participant_id" data-size="3" data-live-search="true">
                    <option value="0">Ninguno</option>
                    @foreach ($participants as $participant)
                        @if ($player->participant_id == $participant->id)
                            <option selected value="{{ $participant->id }}">{{ $participant->name() }}</option>
                        @else
                            <option value="{{ $participant->id }}">{{ $participant->name() }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label for="salary" class="col-sm-3 col-form-label">Salario</label>
            <div class="col-sm-9">
                <input type="number" class="form-control" id="salary" name="salary" placeholder="Salario" min="0.5" step="0.5" value="{{ old('name', $player->salary) }}" autofocus>
            </div>
        </div>

        <div class="form-group row">
            <label for="price" class="col-sm-3 col-form-label">Claúsula</label>
            <div class="col-sm-9">
                <input type="number" class="form-control" id="price" name="price" placeholder="Claúsula" min="5" step="5" value="{{ old('name', $player->price) }}" autofocus>
            </div>
        </div>

        <div class="form-group row pt-2">
            <div class="col-sm-10">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="active" name="active" {{ $player->active ? 'checked = "checked"' : ''}}>
                    <label class="custom-control-label is-valid" for="active">
                        <span>Jugador activo</span>
                    </label>
                </div>
            </div>
        </div>

    </div>

    <div class="table-form-footer col-12 col-lg-8 col-xl-6 pt-3 px-3 px-md-0">
        <input type="submit" class="btn btn-primary border border-primary" value="Guardar" id="btnSave">
    </div>

</form>
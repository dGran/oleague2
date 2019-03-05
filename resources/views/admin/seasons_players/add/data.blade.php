<form
    id="frmAdd"
    lang="{{ app()->getLocale() }}"
    role="form"
    method="POST"
    action="{{ route('admin.season_players.save') }}"
    enctype="multipart/form-data"
    data-toggle="validator"
    autocomplete="off">
    {{ csrf_field() }}

    <input type="hidden" name="season_id" value="{{ $season_id }}">

    <div class="table-form-content col-12 col-lg-8 col-xl-6 p-md-3 animated fadeIn">
        <div class="form-group row">
            <label for="player_id" class="col-sm-3 col-form-label">Jugador</label>
            <div class="col-sm-9">
                <select class="selectpicker form-control" name="player_id" id="player_id" data-size="3" data-live-search="true">
                    @foreach ($players as $player)
                        <option value="{{ $player->id }}">{{ $player->name }}</option>
                    @endforeach
                </select>
                <small class="text-info">
                    <i class="fas fa-info mr-1"></i>Unicamente aparecen los jugadores de la Database seleccionada en la temporada no importados. Para agregar un nuevo jugador debes agregarlo en la tabla jugadores con la misma Database
                </small>
            </div>
        </div>

        <div class="form-group row">
            <label for="participant_id" class="col-sm-3 col-form-label">Participante</label>
            <div class="col-sm-9">
                <select class="selectpicker form-control" name="participant_id" id="participant_id" data-size="3" data-live-search="true">
                    <option value="0">Ninguno</option>
                    @foreach ($participants as $participant)
                        <option value="{{ $participant->id }}">{{ $participant->name() }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label for="salary" class="col-sm-3 col-form-label">Salario</label>
            <div class="col-sm-9">
                <input type="number" class="form-control" id="salary" name="salary" placeholder="Salario" min="0.5" step="0.5" value="{{ old('name', 0.5) }}" autofocus>
            </div>
        </div>

        <div class="form-group row">
            <label for="price" class="col-sm-3 col-form-label">Claúsula</label>
            <div class="col-sm-9">
                <input type="number" class="form-control" id="price" name="price" placeholder="Claúsula" min="5" step="5" value="{{ old('name', 5) }}" autofocus>
            </div>
        </div>

        <div class="form-group row pt-2">
            <div class="col-sm-10">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="active" name="active" checked = "checked"}}>
                    <label class="custom-control-label is-valid" for="active">
                        <span>Jugador activo</span>
                    </label>
                </div>
            </div>
        </div>
    </div>

    <div class="table-form-footer col-12 col-lg-8 col-xl-6 pt-3 px-3 px-md-0">
        @if ($players->count() > 0)
            <input type="submit" class="btn btn-primary border border-primary" value="Guardar" id="btnSave">
            <div class="no-close custom-control custom-checkbox mt-2">
                <input type="checkbox" class="custom-control-input" id="no_close" name="no_close">
                <label class="custom-control-label is-valid" for="no_close">Insertar nuevo registro</label>
            </div>
        @else
            <small class="text-warning">
                <i class="fas fa-exclamation-triangle mr-1"></i>No existen jugadores en la Database seleccionada en la temporada no importados
            </small>
            <a class="btn btn-white border border-light" href="{{ route('admin.season_players') }}">
                Volver al listado
            </a>
        @endif
    </div>

</form>
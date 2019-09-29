<form
    id="frmAdd"
    lang="{{ app()->getLocale() }}"
    role="form"
    method="POST"
    action="{{ route('admin.seasons.save') }}"
    enctype="multipart/form-data"
    data-toggle="validator"
    autocomplete="off">
    {{ csrf_field() }}

    <div class="table-form-content col-12 col-lg-8 col-xl-6 p-md-3 animated fadeIn">
        <div class="form-group row pt-2">
            <label for="name" class="col-sm-3 col-form-label">Nombre</label>
            <div class="col-sm-9">
                <input type="text" class="form-control {{ $errors->first('name') ? 'invalid' : '' }}" id="name" name="name" placeholder="Nombre" autofocus value="{{ old('name') }}">
                @if ($errors->first('name'))
                    <small class="text-danger">{{ $errors->first('name') }}</small>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <label for="num_participants" class="col-sm-3 col-form-label">Participantes</label>
            <div class="col-sm-9">
                <input type="number" class="form-control" id="num_participants" name="num_participants" placeholder="Número de participantes" autofocus value="{{ old('num_participants') }}">
                <small class="text-info">
                    <i class="fas fa-info mr-1"></i>Los participantes se crearán automaticamente
                </small>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-10">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="participant_has_team" name="participant_has_team" checked>
                    <label class="custom-control-label is-valid" for="participant_has_team">
                        <span>Cada participante representa un equipo</span>
                    </label>
                </div>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-10">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="use_rosters" name="use_rosters" checked>
                    <label class="custom-control-label is-valid" for="use_rosters">
                        <span>Usar plantillas de jugadores</span>
                    </label>
                </div>
            </div>
        </div>

        <div class="form-group row roster_options">
            <div class="col-sm-9 offset-sm-3">
                <label for="players_db_id" class="col-form-label">Player Database</label>
                <select class="selectpicker form-control" name="players_db_id" id="players_db_id" data-size="3" data-live-search="true">
                    <option value="0">Ninguna</option>
                    @foreach ($databases as $database)
                        <option value="{{ $database->id }}">{{ $database->name }}</option>
                    @endforeach
                </select>
                <small class="text-info">
                    <i class="fas fa-info mr-1"></i>Los jugadores se importarán automáticamente
                </small>
            </div>
        </div>

        <div class="form-group row roster_options">
            <div class="col-sm-9 offset-sm-3">
                <label for="min_players">Mínimo jugadores por plantilla</label>
                <input type="number" class="form-control" id="min_players" name="min_players" placeholder="Número mínimo de jugadores por plantilla" autofocus value="{{ old('min_players', 16) }}">
            </div>
        </div>
        <div class="form-group row roster_options">
            <div class="col-sm-9 offset-sm-3">
                <label for="max_players">Máximo jugadores por plantilla</label>
                <input type="number" class="form-control" id="max_players" name="max_players" placeholder="Número máximo de jugadores por plantilla" autofocus value="{{ old('max_players', 25) }}">
            </div>
        </div>
        <div class="form-group row roster_options">
            <div class="col-sm-9 offset-sm-3">
                <label for="salary_cap">Tope salarial de la plantilla</label>
                <input type="number" class="form-control" id="salary_cap" name="salary_cap" placeholder="Tope salarial de la plantilla" autofocus value="{{ old('salary_cap', 110) }}">
                <small class="text-info">
                    <i class="fas fa-info mr-1"></i>Tope salarial permitido en el periodo de edición de salarios
                </small>
            </div>
        </div>
        <div class="form-group row roster_options">
            <div class="col-sm-9 offset-sm-3">
                <label for="free_players_salary">Salario jugadores libres</label>
                <input type="number" step="0.5" min="0.5" class="form-control" id="free_players_salary" name="free_players_salary" placeholder="Salario jugadores libres" autofocus value="{{ old('free_players_salary', 0.5) }}">
            </div>
        </div>
        <div class="form-group row roster_options">
            <div class="col-sm-9 offset-sm-3">
                <label for="free_players_new_salary">Salario jugadores libres fichados</label>
                <input type="number" step="0.5" min="0.5" class="form-control" id="free_players_new_salary" name="free_players_new_salary" placeholder="Salario jugadores libres fichados" autofocus value="{{ old('free_players_new_salary', 1) }}">
                <small class="text-info">
                    <i class="fas fa-info mr-1"></i>Nuevo salario de los jugadores libres una vez son fichados
                </small>
            </div>
        </div>
        <div class="form-group row roster_options">
            <div class="col-sm-9 offset-sm-3">
                <label for="free_players_cost">Coste de los jugadores libres</label>
                <input type="number" step="0.5" min="0.5" class="form-control" id="free_players_cost" name="free_players_cost" placeholder="Coste de los jugadores libres" autofocus value="{{ old('free_players_cost', 5) }}">
            </div>

        </div>
        <div class="form-group row roster_options">
            <div class="col-sm-9 offset-sm-3">
                <label for="free_players_remuneration">Remuneración al liberar jugador</label>
                <input type="number" step="0.5" min="0.5" class="form-control" id="free_players_remuneration" name="free_players_remuneration" placeholder="Remuneración al liberar jugador" autofocus value="{{ old('free_players_remuneration', 5) }}">
            </div>
        </div>
        <div class="form-group row roster_options">
            <div class="col-sm-9 offset-sm-3">
                <label for="max_clauses_paid">Máximo claúsulas pagadas permitido</label>
                <input type="number" min="0" class="form-control" id="max_clauses_paid" name="max_clauses_paid" placeholder="Máximo claúsulas pagadas permitido" autofocus value="{{ old('max_clauses_paid', 4) }}">
            </div>
        </div>
        <div class="form-group row roster_options">
            <div class="col-sm-9 offset-sm-3">
                <label for="max_clauses_received">Máximo claúsulas recibidas permitido</label>
                <input type="number" min="0" class="form-control" id="max_clauses_received" name="max_clauses_received" placeholder="Máximo claúsulas recibidas permitido" autofocus value="{{ old('max_clauses_received', 4) }}">
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-10">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="use_economy" name="use_economy" checked>
                    <label class="custom-control-label is-valid" for="use_economy">
                        <span>Usar economía</span>
                    </label>
                </div>
            </div>
        </div>
        <div class="form-group row initial_budget">
            <div class="col-sm-9 offset-sm-3">
                <label for="initial_budget">Presupuesto inicial</label>
                <input type="number" class="form-control" id="initial_budget" name="initial_budget" placeholder="Presupuesto inicial" autofocus value="{{ old('initial_budget', 0) }}">
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-10">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="active_season" name="active_season">
                    <label class="custom-control-label is-valid" for="active_season">
                        <span>Temporada activa</span>
                    </label>
                </div>
            </div>
        </div>

    </div>

    <div class="table-form-footer col-12 col-lg-8 col-xl-6 pt-3 px-3 px-md-0">
        <input type="submit" class="btn btn-primary border border-primary" value="Guardar" id="btnSave">
        <div class="d-inline-block ml-3">
            <img id="loading" class="d-none" src="{{ asset('img/loading.gif') }}" alt="" width="48">
        </div>
        <div class="no-close custom-control custom-checkbox mt-2">
            <input type="checkbox" class="custom-control-input" id="no_close" name="no_close">
            <label class="custom-control-label is-valid" for="no_close">Insertar nuevo registro</label>
        </div>
    </div>

</form>
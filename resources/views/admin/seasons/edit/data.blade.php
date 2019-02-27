<form
    id="frmEdit"
    lang="{{ app()->getLocale() }}"
    role="form"
    method="POST"
    action="{{ route('admin.seasons.update', $season->id) }}"
    enctype="multipart/form-data"
    data-toggle="validator"
    autocomplete="off">
    {{ method_field('PUT') }}
    {{ csrf_field() }}

    <div class="table-form-content col-12 col-lg-8 col-xl-6 p-md-3 animated fadeIn">
        <div class="form-group row pt-2">
            <label for="name" class="col-sm-3 col-form-label">Nombre</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="name" name="name" placeholder="Nombre" value="{{ old('name', $season->name) }}" autofocus>
                @if ($errors->first('name'))
                    <small class="text-danger">{{ $errors->first('name') }}</small>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label for="num_participants" class="col-sm-3 col-form-label">Participantes</label>
            <div class="col-sm-9">
                <input type="number" class="form-control" id="num_participants" name="num_participants" placeholder="Número de participantes" autofocus value="{{ old('num_participants', $season->num_participants) }}">
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-10">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="participant_has_team" name="participant_has_team" {{ $season->participant_has_team ? 'checked = "checked"' : ''}}>
                    <label class="custom-control-label is-valid" for="participant_has_team">
                        <span>Cada participante representa un equipo</span>
                    </label>
                </div>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-10">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="use_rosters" name="use_rosters" {{ $season->use_rosters ? 'checked = "checked"' : ''}}>
                    <label class="custom-control-label is-valid" for="use_rosters">
                        <span>Usar plantillas de jugadores</span>
                    </label>
                </div>
            </div>
        </div>
        <div class="form-group row max_min_players {{ $season->use_rosters ? 'd-block' : 'd-none'}}">
            <div class="col-sm-9 offset-sm-3">
                <label for="initial_budget">Mínimo jugadores por plantilla</label>
                <input type="number" class="form-control" id="min_players" name="min_players" placeholder="Número mínimo de jugadores por plantilla" autofocus value="{{ old('min_players', $season->min_players) }}">
            </div>
        </div>
        <div class="form-group row max_min_players {{ $season->use_rosters ? 'd-block' : 'd-none'}}">
            <div class="col-sm-9 offset-sm-3">
                <label for="initial_budget">Máximo jugadores por plantilla</label>
                <input type="number" class="form-control" id="max_players" name="max_players" placeholder="Número máximo de jugadores por plantilla" autofocus value="{{ old('max_players', $season->max_players) }}">
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-10">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="use_economy" name="use_economy" {{ $season->use_economy ? 'checked = "checked"' : ''}}>
                    <label class="custom-control-label is-valid" for="use_economy">
                        <span>Usar economía</span>
                    </label>
                </div>
            </div>
        </div>
        <div class="form-group row initial_budget {{ $season->use_economy ? 'd-block' : 'd-none'}}">
            <div class="col-sm-9 offset-sm-3">
                <label for="initial_budget">Presupuesto inicial</label>
                <input type="number" class="form-control" id="initial_budget" name="initial_budget" placeholder="Presupuesto inicial" autofocus value="{{ old('initial_budget', $season->initial_budget) }}">
            </div>
        </div>
    </div>


    <div class="table-form-footer col-12 col-lg-8 col-xl-6 pt-3 px-3 px-md-0">
        <input type="submit" class="btn btn-primary border border-primary" value="Guardar" id="btnSave">
    </div>

</form>
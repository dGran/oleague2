<form
    id="frmAdd"
    lang="{{ app()->getLocale() }}"
    role="form"
    method="POST"
    action="{{ route('admin.players.save') }}"
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
            <label for="team_category_id" class="col-sm-3 col-form-label">Database</label>
            <div class="col-sm-9">
                <select class="selectpicker form-control {{ $errors->first('players_db_name') ? 'd-none' : 'd-inline-block' }}" name="players_db_id" id="players_db_id" data-size="3">
                    @foreach ($players_dbs as $players_db)
                        <option value="{{ $players_db->id }}">{{ $players_db->name }}</option>
                    @endforeach
                </select>

                <input type="text" class="form-control {{ $errors->first('players_db_name') ? 'd-inline-block' : 'd-none' }}" id="players_db_name" name="players_db_name" placeholder="Nombre de la database" autofocus value="{{ old('players_db_name') }}">
                <small class="text-danger">{{ $errors->first('players_db_name') }}</small>

                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="new_parent" name="new_parent" {{ $errors->first('players_db_name') ? 'checked = "checked"' : ''}}">
                    <label class="custom-control-label is-valid" for="new_parent">
                        <small>Nueva database</small>
                    </label>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="img" class="col-sm-3 col-form-label">Imagen</label>

            <div class="col-sm-9">
                <div class="d-inline-block">
                    <div class="input-group mb-1" id="img_local">
                        <div class="input-group-prepend">
                            <button class="btn btn-danger d-none" type="button" id="img_remove">Eliminar</button>
                        </div>
                         <div class="custom-file">
                            <input readonly type="file" class="custom-file-input" id="img_field" name="img">
                            <label class="custom-file-label" for="img_field">Selecciona una imagen</label>
                        </div>
                    </div>
                    @if ($errors->first('img'))
                        <small class="text-danger d-block">{{ $errors->first('img') }}</small>
                    @endif
                    <small>min: 48x48 max: 256x256 ratio: 1/1</small>
                    <div class="preview d-none mt-2 border p-3">
                        <figure class="m-0">
                            <img id="img_preview" src="{{ asset('img/no-photo.png') }}" alt="img" width="96">
                        </figure>
                    </div>
{{--                     <small id="img_info"></small> --}}
                </div>

                <input type="text" class="form-control d-none" id="img_link" name="img_link" placeholder="Url de la imagen" autofocus value="{{ old('img') }}">

                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="url_img" name="url_img">
                    <label class="custom-control-label is-valid" for="url_img">
                        <small>Url de imagen</small>
                    </label>
                </div>
            </div>

        </div>

        <div class="form-group row">
            <label for="overall_rating" class="col-sm-3 col-form-label">Media</label>
            <div class="col-sm-9">
                <input type="number" class="form-control" id="overall_rating" name="overall_rating" placeholder="Valoración media del jugador" value="{{ old('overall_rating') }}">
            </div>
        </div>

        <div class="form-group row">
            <label for="position" class="col-sm-3 col-form-label">Posición</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="position" name="position" placeholder="Posición" value="{{ old('position') }}">
            </div>
        </div>

        <div class="form-group row">
            <label for="nation_name" class="col-sm-3 col-form-label">Nacionalidad</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="nation_name" name="nation_name" placeholder="Nacionalidad" value="{{ old('nation_name') }}">
            </div>
        </div>

        <div class="form-group row">
            <label for="team_name" class="col-sm-3 col-form-label">Equipo</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="team_name" name="team_name" placeholder="Equipo" value="{{ old('team_name') }}">
            </div>
        </div>

        <div class="form-group row">
            <label for="league_name" class="col-sm-3 col-form-label">Competición</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="league_name" name="league_name" placeholder="Competición" value="{{ old('league_name') }}">
            </div>
        </div>

        <div class="form-group row">
            <label for="height" class="col-sm-3 col-form-label">Altura</label>
            <div class="col-sm-9">
                <input type="number" class="form-control" id="height" name="height" placeholder="Altura" value="{{ old('height') }}">
            </div>
        </div>

        <div class="form-group row">
            <label for="age" class="col-sm-3 col-form-label">Edad</label>
            <div class="col-sm-9">
                <input type="number" class="form-control" id="age" name="age" placeholder="Edad" value="{{ old('age') }}">
            </div>
        </div>

        <div class="form-group row">
            <label for="game_id" class="col-sm-3 col-form-label">Game ID</label>
            <div class="col-sm-9">
                <input type="number" class="form-control" id="game_id" name="game_id" placeholder="Identificador (ID) del jugador en el juego" value="{{ old('game_id') }}">
            </div>
        </div>

    </div>

    <div class="table-form-footer col-12 col-lg-8 col-xl-6 pt-3 px-3 px-md-0">
        <input type="submit" class="btn btn-primary border border-primary" value="Guardar" id="btnSave">
        <div class="no-close custom-control custom-checkbox mt-2">
            <input type="checkbox" class="custom-control-input" id="no_close" name="no_close">
            <label class="custom-control-label is-valid" for="no_close">Insertar nuevo registro</label>
        </div>
    </div>

</form>
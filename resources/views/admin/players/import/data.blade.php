<form
id="frmImport"
    lang="{{ app()->getLocale() }}"
    role="form"
    method="POST"
    action="{{ route('admin.players.import.data.save') }}"
    enctype="multipart/form-data"
    data-toggle="validator"
    autocomplete="off">
    {{ csrf_field() }}



    <div class="table-form-content col-12 col-lg-8 col-xl-6 p-md-3 animated fadeIn">

        <div class="form-group row pt-2">
            <label for="players_db_id" class="col-sm-2 col-form-label">Archivo</label>
            <div class="col-sm-10">
                {{-- <input type="file" name="import_file" id="import_file" class="form-control"> --}}

                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="import_file" name="import_file" aria-describedby="inputGroupFileAddon01">
                    <label class="custom-file-label" for="import_file">Selecciona archivo (.xls, .xlsx, .csv)</label>
                    <small id="file_name" class="text-black-50">Ningún archivo cargado</small>
                </div>
                <small></small>
            </div>
        </div>

        <div class="form-group row">
            <label for="players_db_id" class="col-sm-2 col-form-label">Database</label>
            <div class="col-sm-10">
                <select class="selectpicker form-control {{ $errors->first('players_db_name') ? 'd-none' : 'd-inline-block' }}" name="players_db_id" id="players_db_id" data-size="3">
                    @foreach ($players_dbs as $players_db)
                        <option value="{{ $players_db->id }}">{{ $players_db->name }}</option>
                    @endforeach
                </select>

                <input type="text" class="form-control {{ $errors->first('players_db_name') ? 'd-inline-block' : 'd-none' }}" id="players_db_name" name="players_db_name" placeholder="Nombre de la database" autofocus value="{{ old('players_db_name') }}">
                <small class="text-danger">{{ $errors->first('players_db_name') }}</small>

                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="new_parent" name="new_parent">
                    <label class="custom-control-label is-valid" for="new_parent">
                        <small>Nueva database</small>
                    </label>
                </div>
            </div>
        </div>

        <div class="form-group row pt-2">
            <div class="col-sm-10">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="add_teams" name="add_teams">
                    <label class="custom-control-label is-valid" for="add_teams">
                        Dar de alta los equipos que no existan
                    </label>
                </div>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-10">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="add_categories" name="add_categories">
                    <label class="custom-control-label is-valid" for="add_categories">
                        Dar de alta las categorías de equipos que no existan
                    </label>
                </div>
            </div>
        </div>
    </div>

    <div class="table-form-footer col-12 col-lg-8 col-xl-6 pt-3 px-3 px-md-0">
        <input type="submit" class="btn btn-primary border border-primary" value="Importar" id="btnSave">
    </div>

</form>
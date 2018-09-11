<form
    id="frmEdit"
    lang="{{ app()->getLocale() }}"
    role="form"
    method="POST"
    action="{{ route('admin.players.update', $player->id) }}"
    enctype="multipart/form-data"
    data-toggle="validator"
    autocomplete="off">
    {{ method_field('PUT') }}
    {{ csrf_field() }}

    <div class="table-form-content col-12 col-lg-8 col-xl-6 p-md-3 animated fadeIn">
        <div class="form-group row pt-2">
            <label for="name" class="col-sm-2 col-form-label">Nombre</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="name" name="name" placeholder="Nombre" value="{{ old('name', $player->name) }}" autofocus>
                @if ($errors->first('name'))
                    <small class="text-danger">{{ $errors->first('name') }}</small>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label for="players_db_id" class="col-sm-2 col-form-label">Player Database</label>
            <div class="col-sm-10">
                <select class="selectpicker form-control" name="players_db_id" id="players_db_id" data-size="3">
                    @foreach ($players_dbs as $players_db)
                        @if ($player->players_db_id == $players_db->id)
                            <option selected value="{{ $players_db->id }}">{{ $players_db->name }}</option>
                        @else
                            <option value="{{ $players_db->id }}">{{ $players_db->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="logo" class="col-sm-2 col-form-label">Imagen</label>

            <div class="col-sm-10">
                <div class="input-group mb-1">
                    <div class="input-group-prepend">
                        <button class="btn btn-danger {{ $player->img ? 'd-inline-block' : 'd-none' }}" type="button" id="logo_remove">Eliminar</button>
                        {{-- <span class="input-group-text">Eliminar</span> --}}
                    </div>
                     <div class="custom-file">
                        <input type="hidden" name="old_img" id="old_img" value="{{ $player->img }}">
                        <input readonly type="file" class="custom-file-input" id="img_field" name="img">
                        <label class="custom-file-label" for="logo_field">Selecciona una imagen</label>
                    </div>
                </div>
                @if ($errors->first('img'))
                    <small class="text-danger d-block">{{ $errors->first('img') }}</small>
                @endif
                <small>min: 48x48 max: 256x256 ratio: 1/1</small>
                <div class="preview mt-2 border p-3 {{ $player->img ? 'd-block' : 'd-none' }}">
                    <figure class="m-0">
                        <img id="img_preview" src="{{ $player->getImgFormatted() }}" alt="img" width="96">
                    </figure>
                </div>
            </div>
        </div>

    </div>

    <div class="table-form-footer col-12 col-lg-8 col-xl-6 pt-3 px-3 px-md-0">
        <input type="submit" class="btn btn-primary border border-primary" value="Guardar" id="btnSave">
    </div>

</form>
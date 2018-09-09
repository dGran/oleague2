<form
    id="frmEdit"
    lang="{{ app()->getLocale() }}"
    role="form"
    method="POST"
    action="{{ route('admin.teams.update', $team->id) }}"
    enctype="multipart/form-data"
    data-toggle="validator"
    autocomplete="off">
    {{ method_field('PUT') }}
    {{ csrf_field() }}

    <div class="table-form-content col-12 col-lg-8 col-xl-6 p-md-3 animated fadeIn">
        <div class="form-group row pt-2">
            <label for="name" class="col-sm-2 col-form-label">Nombre</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="name" name="name" placeholder="Nombre" value="{{ old('name', $team->name) }}" autofocus>
                @if ($errors->first('name'))
                    <small class="text-danger">{{ $errors->first('name') }}</small>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label for="team_category_id" class="col-sm-2 col-form-label">Categoría</label>
            <div class="col-sm-10">
                <select class="selectpicker form-control" name="team_category_id" id="team_category_id" data-size="3">
                    @foreach ($categories as $category)
                        @if ($team->team_category_id == $category->id)
                            <option selected value="{{ $category->id }}">{{ $category->name }}</option>
                        @else
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="logo" class="col-sm-2 col-form-label">Escudo</label>

            <div class="col-sm-10">
                <div class="input-group mb-1">
                    <div class="input-group-prepend">
                        <button class="btn btn-danger {{ $team->logo ? 'd-inline-block' : 'd-none' }}" type="button" id="logo_remove">Eliminar</button>
                        {{-- <span class="input-group-text">Eliminar</span> --}}
                    </div>
                     <div class="custom-file">
                        <input type="hidden" name="old_logo" id="old_logo" value="{{ $team->logo }}">
                        <input readonly type="file" class="custom-file-input" id="logo_field" name="logo">
                        <label class="custom-file-label" for="logo_field">Selecciona una imagen</label>
                    </div>
                </div>
                @if ($errors->first('logo'))
                    <small class="text-danger d-block">{{ $errors->first('logo') }}</small>
                @endif
                <small>min: 48x48 max: 256x256 ratio: 1/1</small>
                <div class="preview mt-2 border p-3 {{ $team->logo ? 'd-block' : 'd-none' }}">
                    <figure class="m-0">
                        <img id="logo_preview" src="{{ $team->getLogoFormatted() }}" alt="logo" width="96">
                    </figure>
                </div>
            </div>
        </div>

    </div>

    <div class="table-form-footer col-12 col-lg-8 col-xl-6 pt-3 px-3 px-md-0">
        <input type="submit" class="btn btn-primary border border-primary" value="Guardar" id="btnSave">
    </div>

</form>
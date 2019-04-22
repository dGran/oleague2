<form
    id="frmEdit"
    lang="{{ app()->getLocale() }}"
    role="form"
    method="POST"
    action="{{ route('admin.season_competitions_phases.update', [$competition->slug, $phase->id]) }}"
    enctype="multipart/form-data"
    data-toggle="validator"
    autocomplete="off">
    {{ method_field('PUT') }}
    {{ csrf_field() }}

    <div class="table-form-content col-12 col-lg-8 col-xl-6 p-md-3 animated fadeIn">

        <div class="form-group row pt-2">
            <label for="name" class="col-sm-3 col-form-label">Nombre</label>
            <div class="col-sm-9">
                <input type="text" class="form-control {{ $errors->first('name') ? 'invalid' : '' }}" id="name" name="name" placeholder="Nombre" autofocus value="{{ old('name', $phase->name) }}">
                @if ($errors->first('name'))
                    <small class="text-danger">{{ $errors->first('name') }}</small>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <label for="num_participants" class="col-sm-3 col-form-label">Participantes</label>
            <div class="col-sm-9">
                <input type="number" class="form-control" id="num_participants" name="num_participants" placeholder="Número de participantes" min="2" max="{{ $max_participants }}" autofocus value="{{ old('num_participants', $phase->num_participants) }}">
                <small class="text-info">Máximo participantes: {{ $max_participants }}</small>
            </div>
        </div>

        <div class="form-group row">
            <label for="mode" class="col-sm-3 col-form-label">Participantes</label>
            <div class="col-sm-9">
                <select class="selectpicker form-control" name="mode" id="mode">
                    <option {{ $phase->mode == 'league' ? 'selected' : '' }} value="league">Liga</option>
                    <option {{ $phase->mode == 'playoffs' ? 'selected' : '' }} value="playoffs">Playoffs</option>
                </select>
            </div>
        </div>

    </div>

    <div class="table-form-footer col-12 col-lg-8 col-xl-6 pt-3 px-3 px-md-0">
        <input type="submit" class="btn btn-primary border border-primary" value="Guardar" id="btnSave">
    </div>

</form>
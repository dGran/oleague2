<form
    id="frmDuplicate"
    lang="{{ app()->getLocale() }}"
    role="form"
    method="POST"
    action="{{ route('admin.seasons.duplicate.save', $season->id) }}"
    enctype="multipart/form-data"
    data-toggle="validator"
    autocomplete="off">
    {{ csrf_field() }}

    <div class="table-form-content col-12 col-lg-8 col-xl-6 p-md-3 animated fadeIn">
        <div class="form-group row pt-2 px-3">
            Todas las opciones serán configurables pero de momebto se hace personalizado para actualizar plantillas y economías
        </div>
    </div>

    <div class="table-form-footer col-12 col-lg-8 col-xl-6 pt-3 px-3 px-md-0">
        <input type="submit" class="btn btn-primary border border-primary" value="Duplicar" id="btnSave">
        <div class="d-inline-block ml-3">
            <img id="loading" class="d-none" src="{{ asset('img/loading.gif') }}" alt="" width="48">
        </div>
        <div class="d-block">
            <small id="loading-info" class="d-none">El tiempo del proceso se puede demorar en función de la cantidad de datos a duplicar.</small>
        </div>
    </div>

</form>
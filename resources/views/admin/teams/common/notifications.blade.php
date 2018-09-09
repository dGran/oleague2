<div class="area-notifications px-3 px-md-0">

    @if ($errors->any())
        <div class="alert alert-danger autohide">
            No se han guardado los datos. Revisa los errores en los campos del formulario
        </div>
    @endif

{{--     @if (session('error'))
        <div class="alert alert-danger autohide">
            {{ session('error') }}
        </div>
    @endif --}}

    @if (session('status'))
        <div class="alert alert-success autohide">
            {{ session('status') }}
        </div>
    @endif
</div>
<div class="area-notifications px-3 px-md-0">

    @if ($errors->any())
        <div class="alert alert-danger autohide">
            No se han guardado los datos. Revisa los errores en los campos del formulario
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success autohide">
            {{ session('success') }}
        </div>
    @endif

    @if (session('warning'))
        <div class="alert alert-warning autohide">
            {{ session('warning') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger autohide">
            {{ session('error') }}
        </div>
    @endif

    @if (session('info'))
        <div class="alert alert-info autohide">
            {{ session('info') }}
        </div>
    @endif

</div>
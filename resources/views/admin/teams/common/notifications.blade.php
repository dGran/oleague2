<div class="area-notifications px-3 px-md-0">
    @if (session('error'))
        <div class="alert alert-danger autohide">
            {{ session('error') }}
        </div>
    @endif

    @if (session('status'))
        <div class="alert alert-info autohide">
            {{ session('status') }}
        </div>
    @endif
</div>
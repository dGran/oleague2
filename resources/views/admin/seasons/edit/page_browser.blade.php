<div class="pagebrowser form px-3 px-md-0 py-2 mb-2 mb-md-0">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb p-0 m-0 mb-1">
            <li class="breadcrumb-item"><a href="{{ route('admin') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.seasons') }}">Temporadas</a></li>
        </ol>
    </nav>
    <h5 class="text-uppercase m-0">{{ $season->name }}</h5>
</div>
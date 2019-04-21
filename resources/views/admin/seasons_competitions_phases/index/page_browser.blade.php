<div class="pagebrowser px-3 px-md-0 py-2">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb p-0 m-0 mb-1">
            <li class="breadcrumb-item"><a href="{{ route('admin') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.season_competitions') }}">Competiciones ({{ $competition->season->name }})</a></li>
        </ol>
    </nav>
    <div class="d-table">
    	<img src="{{ $competition->getImgFormatted() }}" alt="" width="38" class="d-table-cell align-middle">
    	<h5 class="text-uppercase m-0 d-table-cell align-middle pl-2">{{ $competition->name }} - Fases</h5>
    </div>
</div>
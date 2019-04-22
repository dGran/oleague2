<div class="pagebrowser px-3 px-md-0 py-2">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb p-0 m-0 mb-1">
            <li class="breadcrumb-item"><a href="{{ route('admin') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.season_competitions') }}">Competiciones ({{ $competition->season->name }})</a></li>
        </ol>
    </nav>
    <div class="d-table">
    	<img src="{{ $competition->getImgFormatted() }}" alt="" width="38" class="d-table-cell align-middle">
    	<h5 class="text-uppercase m-0 d-table-cell align-middle pl-2">
            <span class="d-none d-sm-inline-block">{{ $competition->name }}</span>
            <i class="d-none d-sm-inline-block fas fa-angle-double-right text-warning"></i>
            <span class="">Fases</span>
            <span class="d-block d-sm-none" style="font-size: 0.5em">{{ $competition->name }}</span>
        </h5>
    </div>
</div>
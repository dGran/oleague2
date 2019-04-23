<div class="pagebrowser px-3 px-md-0 py-2">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb p-0 m-0 mb-1">
            <li class="breadcrumb-item"><a href="{{ route('admin') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.season_competitions') }}">Competiciones ({{ $phase->competition->season->name }})</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.season_competitions_phases', $phase->competition->slug) }}">{{ $phase->competition->name }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.season_competitions_phases_groups', [$phase->competition->slug, $phase->slug]) }}">{{ $phase->name }}</a></li>
        </ol>
    </nav>
    <div class="d-table">
		<h5 class="text-uppercase m-0">Nuevo grupo</h5>
    </div>
</div>
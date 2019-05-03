<div class="pagebrowser px-3 px-md-0 py-2">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb p-0 m-0 mb-1">
            <li class="breadcrumb-item"><a href="{{ route('admin') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.season_competitions') }}">Competiciones ({{ $group->phase->competition->season->name }})</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.season_competitions_phases', $group->phase->competition->slug) }}">{{ $group->phase->competition->name }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.season_competitions_phases_groups', [$group->phase->competition->slug, $group->phase->slug]) }}">{{ $group->phase->name }}</a></li>
        </ol>
    </nav>
    <div class="d-table">
        <img src="{{ $group->phase->competition->getImgFormatted() }}" alt="" width="38" class="d-table-cell align-middle">
        <h5 class="text-uppercase m-0 d-table-cell align-middle pl-2">
            <span class="d-none d-sm-inline-block">{{ $group->name }}</span>
            <i class="d-none d-sm-inline-block fas fa-angle-double-right text-warning"></i>
            <span class="">Liga</span>
            <span class="d-block d-sm-none" style="font-size: 0.5em">{{ $group->name }}</span>
        </h5>
    </div>
</div>
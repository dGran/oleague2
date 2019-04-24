<div class="pagebrowser px-3 px-md-0 py-2">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb p-0 m-0 mb-1">
            <li class="breadcrumb-item"><a href="{{ route('admin') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.season_competitions') }}">Competiciones ({{ $group->phase->competition->season->name }})</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.season_competitions_phases', $group->phase->competition->slug) }}">{{ $group->phase->competition->name }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.season_competitions_phases_groups', [$group->phase->competition->slug, $group->phase->slug]) }}">{{ $group->phase->name }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.season_competitions_phases_groups_participants', [$group->phase->competition->slug, $group->phase->slug, $group->slug]) }}">{{ $group->name }}</a></li>
        </ol>
    </nav>
	<h5 class="text-uppercase m-0">Nuevo participante</h5>
</div>
@if ($groups->count() == 0)
    <div class="text-center border-top py-4">
        <figure>
            <img src="{{ asset('img/table-empty.png') }}" alt="" width="72">
        </figure>
        Actualmente no existen registros
    </div>
@else
    <table class="teams-table animated fadeIn">
        <colgroup>
            <col width="0%" />
            <col width="100%" />
            <col width="0%" />
            <col width="0%" class="d-none d-sm-table-cell" />
            <col width="0%" class="d-none d-sm-table-cell" />
            <col width="0%" />
        </colgroup>

        <thead>
            <tr class="border-top">
                <th scope="col" class="select">
                    <div class="pretty p-icon p-jelly mr-0">
                        <input type="checkbox" id="allMark" onchange="showHideAllRowOptions()">
                        <div class="state p-primary">
                            <i class="icon material-icons">done</i>
                            <label></label>
                        </div>
                    </div>
                </th>
                <th scope="col" class="name" onclick="$('#allMark').trigger('click');">Nombre</th>
                <th scope="col" onclick="$('#allMark').trigger('click');"><i class="fas fa-users"></i></th>
                <th scope="col" onclick="$('#allMark').trigger('click');" class="d-none d-sm-table-cell"></th>
                <th scope="col" onclick="$('#allMark').trigger('click');" class="d-none d-sm-table-cell"></th>
                <th scope="col" onclick="$('#allMark').trigger('click');"></th>
            </tr>
        </thead>

        <tbody>
            @foreach ($groups as $group)
                {{-- <tr class="border-top" data-id="{{ $group->id }}" data-name="{{ $group->name }}" data-allow-delete="{{ $group->teams->count() > 0 ? 0 : 1 }}"> --}}
                <tr class="border-top" data-id="{{ $group->id }}" data-name="{{ $group->name }}">
                    <td class="select">
                        <div class="pretty p-icon p-jelly mr-0">
                            <input type="checkbox" class="mark" value="{{ $group->id }}" onchange="showHideRowOptions(this)">
                            <div class="state p-primary">
                                <i class="icon material-icons">done</i>
                                <label></label>
                            </div>
                        </div>
                    </td>
                    <td onclick="rowSelect(this)">
                        <span class="name">{{ $group->name }}</span>
                    </td>
                    <td onclick="rowSelect(this)" class="text-center">
                        {{ $group->num_participants }}
                    </td>
                    <td class="d-none d-sm-table-cell">
                        <a href="" class="btn btn-light border" id="btnParticipants{{ $phase->id }}">
                            <div class="d-block d-lg-none">
                                <i class="fas fa-users-cog"></i>
                            </div>
                            <div class="d-none d-lg-block">
                                <i class="fas fa-users-cog fa-fw mr-1"></i>
                                Participantes
                            </div>
                        </a>
                    </td>
                    <td class="d-none d-sm-table-cell">
                        <a href="" class="btn btn-light border" id="btnCompetition{{ $phase->id }}">
                            <div class="d-block d-lg-none">
                                <i class="fas fa-futbol"></i>
                            </div>
                            <div class="d-none d-lg-block">
                                <i class="fas fa-futbol fa-fw mr-1"></i>
                                Competición
                            </div>
                        </a>
                    </td>
                    <td class="actions">
                        <a id="btnRegActions" class="btn btn-link dropdown-toggle" data-toggle="dropdown">
                            <i class="fas fa-ellipsis-h text-secondary"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right my-1" aria-labelledby="btnRegActions">
                            <a class="dropdown-item text-secondary d-block d-sm-none" href="" id="btnParticipants{{ $group->id }}">
                                <i class="fas fa-users-cog fa-fw mr-1"></i>
                                Participantes
                            </a>
                            <a class="dropdown-item text-secondary d-block d-sm-none" href="" id="btnCompetition{{ $group->id }}">
                                <i class="fas fa-futbol fa-fw mr-1"></i>
                                Competición
                            </a>
                            <a class="dropdown-item text-secondary" href="{{ route('admin.season_competitions_phases_groups.edit', [$phase->competition->slug, $phase->slug, $group->id]) }}" id="btnEdit{{ $group->id }}">
                                <i class="fas fa-edit fa-fw mr-1"></i>
                                Editar
                            </a>
                            <a href="" class="btn-delete dropdown-item text-danger" value="Eliminar">
                                <i class="fas fa-trash fa-fw mr-1"></i>
                                Eliminar
                            </a>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="regs-info clearfix border-top p-3 px-md-0">
        <div class="regs-info2 float-left">Registros: {{ $groups->count() }}</div>
    </div>

    <form id="form-delete" action="{{ route('admin.season_competitions_phases_groups.destroy', [$phase->competition->slug, $phase->slug, ':GROUP_ID']) }}" method="post">
        {{ csrf_field() }}
        {{ method_field('delete') }}
    </form>
@endif
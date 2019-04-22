@if ($phases->count() == 0)
    <div class="text-center border-top py-4">
        <figure>
            <img src="{{ asset('img/oops.png') }}" alt="" width="72">
        </figure>
        <strong>Oops!!!, </strong>no se han encontrado resultados
    </div>
@else
    <table class="teams-table animated fadeIn">
        <colgroup>
            <col width="0%" />
            <col width="0%" />
            <col width="100%" />
            <col width="0%" />
            <col width="0%" />
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
                <th scope="col" onclick="$('#allMark').trigger('click');"></th>
                <th scope="col" class="name" onclick="$('#allMark').trigger('click');">Nombre</th>
                <th scope="col" onclick="$('#allMark').trigger('click');">Modo</th>
                <th scope="col" onclick="$('#allMark').trigger('click');"><i class="fas fa-users"></i></th>
                <th scope="col" onclick="$('#allMark').trigger('click');"></th>
            </tr>
        </thead>

        <tbody>
            @foreach ($phases as $phase)
                {{-- <tr class="border-top" data-id="{{ $phase->id }}" data-name="{{ $phase->name }}" data-allow-delete="{{ $phase->teams->count() > 0 ? 0 : 1 }}"> --}}
                <tr class="border-top" data-id="{{ $phase->id }}" data-name="{{ $phase->name }}" data-active="{{ $phase->active }}">
                    <td class="select">
                        <div class="pretty p-icon p-jelly mr-0">
                            <input type="checkbox" class="mark" value="{{ $phase->id }}" name="competitionId[]" onchange="showHideRowOptions(this)">
                            <div class="state p-primary">
                                <i class="icon material-icons">done</i>
                                <label></label>
                            </div>
                        </div>
                    </td>
                    <td onclick="rowSelect(this)">
                        <i class="fas fa-circle {{ $phase->active ? 'text-success' : 'text-warning' }}"></i>
                    </td>
                    <td onclick="rowSelect(this)">
                        <span class="name">{{ $phase->name }}</span>
                    </td>
                    <td onclick="rowSelect(this)">
                        {{ $phase->mode == 'league' ? 'Liga' : 'PlayOffs' }}
                    </td>
                    <td onclick="rowSelect(this)" class="text-center">
                        {{ $phase->num_participants }}
                    </td>
                    <td class="d-none d-sm-table-cell">
                        <a href="{{ route('admin.season_competitions_phases', $competition->slug) }}" class="btn btn-light border" id="btnGroups{{ $competition->id }}">
                            <i class="fas fa-users-cog fa-fw mr-1"></i>
                            Grupos
                        </a>
                    </td>
                    <td class="actions">
                        <a id="btnRegActions" class="btn btn-link dropdown-toggle" data-toggle="dropdown">
                            <i class="fas fa-ellipsis-h text-secondary"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right my-1" aria-labelledby="btnRegActions">
                            <a class="dropdown-item text-secondary d-block d-sm-none" href="{{ route('admin.season_competitions_phases', $competition->slug) }}" id="btnGroups{{ $competition->id }}">
                                <i class="fas fa-users-cog fa-fw mr-1"></i>
                                Grupos
                            </a>
                            @if ($phase->active)
                                <a class="dropdown-item text-secondary" href="{{ route('admin.season_competitions_phases.desactivate', [$competition->slug, $phase->id]) }}" id="btnDesactivate{{ $phase->id }}">
                                    <i class="fas fa-toggle-off fa-fw mr-1"></i>
                                    Desactivar
                                </a>
                            @else
                                <a class="dropdown-item text-secondary" href="{{ route('admin.season_competitions_phases.activate', [$competition->slug, $phase->id]) }}" id="btnActivate{{ $phase->id }}">
                                    <i class="fas fa-toggle-on fa-fw mr-1"></i>
                                    Activar
                                </a>
                            @endif
                            <a class="dropdown-item text-secondary" href="{{ route('admin.season_competitions_phases.edit', [$competition->slug, $phase->id]) }}" id="btnEdit{{ $phase->id }}">
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
        <div class="regs-info2 float-left">Registros: {{ $phases->count() }}</div>
    </div>

    <form id="form-delete" action="{{ route('admin.season_competitions_phases.destroy', [$competition->slug, ':PHASE_ID']) }}" method="post">
        {{ csrf_field() }}
        {{ method_field('delete') }}
    </form>
@endif
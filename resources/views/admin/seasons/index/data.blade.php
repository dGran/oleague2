@if ($seasons->count() == 0)
    <div class="text-center border-top py-4">
        @if ($filterName == null)
            <figure>
                <img src="{{ asset('img/table-empty.png') }}" alt="" width="72">
            </figure>
            Actualmente no existen registros
        @else
            <figure>
                <img src="{{ asset('img/oops.png') }}" alt="" width="72">
            </figure>
            <strong>Oops!!!, </strong>no se han encontrado resultados
        @endif

    </div>
@else
    <table class="teams-table animated fadeIn">
        <colgroup>
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
                <th scope="col" class="name" onclick="$('#allMark').trigger('click');">Temporada</th>
                <th scope="col" onclick="$('#allMark').trigger('click');"></th>
                <th scope="col" onclick="$('#allMark').trigger('click');"></th>
                <th scope="col" onclick="$('#allMark').trigger('click');"></th>
            </tr>
        </thead>

        <tbody>
            @foreach ($seasons as $season)
                {{-- mantengo la linea comentada por el data-allow-delete, crear un metodo que compruebe si tiene competiciones o participantes o plantillas (cualquier tabla que use su id)....para permitir o no eliminar --}}
                {{-- <tr class="border-top" data-id="{{ $season->id }}" data-name="{{ $season->name }}" data-allow-delete="{{ $season->teams->count() > 0 ? 0 : 1 }}"> --}}
                <tr class="border-top" data-id="{{ $season->id }}" data-name="{{ $season->name }}"">
                    <td class="select align-top">
                        <div class="pretty p-icon p-jelly mr-0">
                            <input type="checkbox" class="mark" value="{{ $season->id }}" name="teamId[]" onchange="showHideRowOptions(this)">
                            <div class="state p-primary">
                                <i class="icon material-icons">done</i>
                                <label></label>
                            </div>
                        </div>
                    </td>
                    <td class="name" onclick="rowSelect(this)">
                        <span>{{ $season->name }}</span>
                        @if (active_season() && $season->id == active_season()->id)
                            <span class="badge badge-success p-1 ml-2 d-inline-block">TEMPORADA ACTIVA</span>
                        @endif
                        @if ($season->hasParticipants())
                            <small class="d-block">Participantes: {{ $season->participants->count() }}</small>
                        @endif
{{--                         @if ($season->use_rosters)
                            @if ($season->transfers_period)
                                <small class="badge badge-success text-white d-inline-block">Salarios</small>
                            @else
                                <small class="badge badge-secondary text-white d-inline-block">Salarios</small>
                            @endif
                            @if ($season->transfers_period)
                                <small class="badge badge-success text-white d-inline-block">Transfers</small>
                            @else
                                <small class="badge badge-secondary text-white d-inline-block">Transfers</small>
                            @endif
                            @if ($season->free_players_period)
                                <small class="badge badge-success text-white d-inline-block">Libres</small>
                            @else
                                <small class="badge badge-secondary text-white d-inline-block">Libres</small>
                            @endif
                            @if ($season->clausules_period)
                                <small class="badge badge-success text-white d-inline-block">Claúsulas</small>
                            @else
                                <small class="badge badge-secondary text-white d-inline-block">Claúsulas</small>
                            @endif
                        @endif --}}
                    </td>
                    <td>
                        @if ($season->use_rosters)
                            <i class="fas fa-user-shield text-info"></i>
                        @else
                            <i class="fas fa-user-shield text-black-50"></i>
                        @endif
                    </td>
                    <td>
                        @if ($season->use_economy)
                            <i class="fas fa-piggy-bank text-info"></i>
                        @else
                            <i class="fas fa-piggy-bank text-black-50"></i>
                        @endif
                    </td>
                    <td class="actions">
                        <a id="btnRegActions" class="btn btn-link dropdown-toggle" data-toggle="dropdown">
                            <i class="fas fa-ellipsis-h text-secondary"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right my-1" aria-labelledby="btnRegActions">
                            @if (active_season())
                                @if ($season->id != active_season()->id)
                                    <a class="dropdown-item text-secondary" href="{{ route('admin.seasons.setActiveSeason', $season->id) }}">
                                        <i class="fas fa-map-marker-alt fa-fw mr-1"></i>
                                        Temporada activa
                                    </a>
                                @endif
                            @else
                                <a class="dropdown-item text-secondary" href="{{ route('admin.seasons.setActiveSeason', $season->id) }}">
                                    <i class="fas fa-map-marker-alt fa-fw mr-1"></i>
                                        Temporada activa
                                </a>
                            @endif
                            <a class="dropdown-item text-secondary" href="{{ route('admin.seasons.edit', $season->id) }}" id="btnEdit{{ $season->id }}">
                                <i class="fas fa-edit fa-fw mr-1"></i>
                                Editar
                            </a>
                            <a class="dropdown-item text-secondary" href="{{ route('admin.seasons.duplicate', $season->id) }}" id="btnDuplicate{{ $season->id }}">
                                <i class="fas fa-clone fa-fw mr-1"></i>
                                Duplicar
                            </a>
                            @if ($season->change_salaries_period)
                                <a class="dropdown-item text-secondary" href="{{ route('admin.seasons.salaries.desactivate', $season->id) }}">
                                    <i class="fas fa-toggle-off fa-fw mr-1"></i>
                                    Desactivar periodo edición de salarios
                                </a>
                            @else
                                <a class="dropdown-item text-secondary" href="{{ route('admin.seasons.salaries.activate', $season->id) }}">
                                    <i class="fas fa-toggle-on fa-fw mr-1"></i>
                                    Activar periodo edición de salarios
                                </a>
                            @endif
                            @if ($season->transfers_period)
                                <a class="dropdown-item text-secondary" href="{{ route('admin.seasons.transfers.desactivate', $season->id) }}">
                                    <i class="fas fa-toggle-off fa-fw mr-1"></i>
                                    Desactivar periodo negociaciones
                                </a>
                            @else
                                <a class="dropdown-item text-secondary" href="{{ route('admin.seasons.transfers.activate', $season->id) }}">
                                    <i class="fas fa-toggle-on fa-fw mr-1"></i>
                                    Activar periodo negociaciones
                                </a>
                            @endif
                            @if ($season->free_players_period)
                                <a class="dropdown-item text-secondary" href="{{ route('admin.seasons.free.desactivate', $season->id) }}">
                                    <i class="fas fa-toggle-off fa-fw mr-1"></i>
                                    Desactivar periodo agentes libres
                                </a>
                            @else
                                <a class="dropdown-item text-secondary" href="{{ route('admin.seasons.free.activate', $season->id) }}">
                                    <i class="fas fa-toggle-on fa-fw mr-1"></i>
                                    Activar periodo agentes libres
                                </a>
                            @endif
                            @if ($season->clausules_period)
                                <a class="dropdown-item text-secondary" href="{{ route('admin.seasons.clausules.desactivate', $season->id) }}">
                                    <i class="fas fa-toggle-off fa-fw mr-1"></i>
                                    Desactivar periodo pago de claúsulas
                                </a>
                            @else
                                <a class="dropdown-item text-secondary" href="{{ route('admin.seasons.clausules.activate', $season->id) }}">
                                    <i class="fas fa-toggle-on fa-fw mr-1"></i>
                                    Activar periodo pago de claúsulas
                                </a>
                            @endif
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
        <div class="regs-info2 float-left">Registros: {{ $seasons->firstItem() }}-{{ $seasons->lastItem() }} de {{ $seasons->total() }}</div>
        <div class="float-right">{!! $seasons->appends(Request::all())->render() !!}</div>
    </div>

    <form id="form-delete" action="{{ route('admin.seasons.destroy', ':SEASON_ID') }}" method="post">
        {{ csrf_field() }}
        {{ method_field('delete') }}
    </form>
@endif
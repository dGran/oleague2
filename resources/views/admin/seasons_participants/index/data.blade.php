@if ($participants->count() == 0)
    <div class="text-center border-top py-4">
{{--         @if ($filterName == null)
            <figure>
                <img src="{{ asset('img/table-empty.png') }}" alt="" width="72">
            </figure>
            Actualmente no existen registros
        @else --}}
            <figure>
                <img src="{{ asset('img/oops.png') }}" alt="" width="72">
            </figure>
            <strong>Oops!!!, </strong>no se han encontrado resultados
        {{-- @endif --}}

    </div>
@else
    <table class="teams-table animated fadeIn">
        <colgroup>
            <col width="0%" />
            <col width="0%" />
            <col width="100%" />
            <col width="0%" class="d-none d-sm-table-cell" />
            <col width="0%" />
            @if ($active_season->use_rosters)
                <col width="0%" />
            @endif
            @if ($active_season->use_economy)
                <col width="0%" />
            @endif
        </colgroup>

        <thead>
            <tr class="border-top">
                <th colspan="7" class="p-3 bg-light">
                    {{ $active_season->name }}
                    @if (active_season() && $filterSeason == active_season()->id)
                        <span class="badge badge-success p-1 ml-2">TEMPORADA ACTIVA</span>
                    @endif
                </th>
            </tr>
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
                @if ($active_season->participant_has_team)
                    <th scope="col" colspan="2" onclick="$('#allMark').trigger('click');" class="d-none d-sm-table-cell">Equipo</th>
                    <th scope="col" colspan="2" onclick="$('#allMark').trigger('click');" class="d-table-cell d-sm-none">Participante</th>
                    <th scope="col" class="d-none d-sm-table-cell" onclick="$('#allMark').trigger('click');">Usuario</th>
                @else
                    <th scope="col" colspan="2" onclick="$('#allMark').trigger('click');">Participante</th>
                @endif
                <th class="text-right" onclick="$('#allMark').trigger('click');"></th>
                @if ($active_season->use_rosters)
                    <th onclick="$('#allMark').trigger('click');"></th>
                @endif
                @if ($active_season->use_economy)
                    <th onclick="$('#allMark').trigger('click');"></th>
                @endif
            </tr>
        </thead>

        <tbody>
            @foreach ($participants as $participant)
                {{-- comentamos la linea por el data-allow-delete --}}
                {{-- <tr class="border-top" data-id="{{ $participant->id }}" data-name="{{ $participant->name }}" data-allow-delete="{{ $participant->teams->count() > 0 ? 0 : 1 }}"> --}}
                <tr class="border-top" data-id="{{ $participant->id }}" data-name="{{ $participant->name }}" data-user-name="{{ $participant->user_id ? $participant->user->name : '' }}">
                    <td class="select">
                        <div class="pretty p-icon p-jelly mr-0">
                            <input type="checkbox" class="mark" value="{{ $participant->id }}" name="teamId[]" onchange="showHideRowOptions(this)">
                            <div class="state p-primary">
                                <i class="icon material-icons">done</i>
                                <label></label>
                            </div>
                        </div>
                    </td>

                    @if ($active_season->participant_has_team)

                        @if ($participant->team_id)
                            <td onclick="rowSelect(this)">
                                <img src="{{ $participant->team->getLogoFormatted() }}" alt="" width="32">
                            </td>
                            <td class="text-nowrap name"  onclick="rowSelect(this)">
                                {{ $participant->team->name }}
                                <div class="d-table-cell d-sm-none">
                                    @if ($participant->user_id)
                                        <small>{{ $participant->user->name }}</small>
                                    @else
                                        <span class="badge badge-danger p-1 mt-1">SIN USUARIO</span>
                                    @endif

                                </div>
                            </td>
                        @else
                            <td onclick="rowSelect(this)">
                                <img src="{{ asset('img/team_no_image.png') }}" alt="" width="32">
                            </td>
                            <td class="text-nowrap" onclick="rowSelect(this)">
                                No definido
                            </td>
                        @endif

                        <td class="text-nowrap d-none d-sm-table-cell" onclick="rowSelect(this)">
                            @if ($participant->user_id)
                                {{ $participant->user->name }}
                            @else
                                <span class="badge badge-danger p-1 mt-1">SIN USUARIO</span>
                            @endif
                        </td>

                    @else

                        @if ($participant->user_id)
                            <td onclick="rowSelect(this)">
                                <img src="{{ $participant->user->avatar() }}" alt="" width="32">
                            </td>
                            <td class="text-nowrap"  onclick="rowSelect(this)">
                                {{ $participant->user->name }}
                            </td>
                        @else
                            <td onclick="rowSelect(this)">
                                <img src="{{ asset('img/user_unknown.png') }}" alt="" width="32">
                            </td>
                            <td class="text-nowrap" onclick="rowSelect(this)">
                                No definido
                            </td>
                        @endif

                    @endif

                    @if ($active_season->use_rosters)
                        <td>
                            <a href="" style="font-size: 1.25em"><i class="fas fa-user-shield"></i></a>
                        </td>
                    @endif
                    @if ($active_season->use_economy)
                        <td>
                            <a href="" style="font-size: 1.25em"><i class="fas fa-piggy-bank"></i></a>
                        </td>
                    @endif

                    <td class="actions">
                        <a id="btnRegActions" class="btn btn-link dropdown-toggle" data-toggle="dropdown">
                            <i class="fas fa-ellipsis-h text-secondary"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right my-1" aria-labelledby="btnRegActions">
                            @if ($active_season->use_rosters)
                                <a class="dropdown-item text-secondary" href="{{ route('admin.season_participants.edit', $participant->id) }}" id="btnEdit{{ $participant->id }}">
                                    <i class="fas fa-user-shield fa-fw mr-1"></i>
                                    Plantilla
                                </a>
                            @endif
                            @if ($active_season->use_economy)
                                <a class="dropdown-item text-secondary" href="{{ route('admin.season_participants.edit', $participant->id) }}" id="btnEdit{{ $participant->id }}">
                                    <i class="fas fa-piggy-bank fa-fw mr-1"></i>
                                    Historial de economía
                                </a>
                            @endif
                            <a class="dropdown-item text-secondary" href="{{ route('admin.season_participants.edit', $participant->id) }}" id="btnEdit{{ $participant->id }}">
                                <i class="fas fa-edit fa-fw mr-1"></i>
                                Editar
                            </a>
                            @if ($participant->user_id)
                                <a href="" class="btn-kickout dropdown-item text-danger" value="Expulsar">
                                    <i class="fas fa-sign-out-alt fa-fw mr-1"></i>
                                    Expulsar usuario
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
        <div class="regs-info2 float-left">Registros: {{ $participants->firstItem() }}-{{ $participants->lastItem() }} de {{ $participants->total() }}</div>
        <div class="float-right">{!! $participants->appends(Request::all())->render() !!}</div>
    </div>

    <form id="form-delete" action="{{ route('admin.season_participants.destroy', ':PARTICIPANT_ID') }}" method="post">
        {{ csrf_field() }}
        {{ method_field('delete') }}
    </form>
@endif
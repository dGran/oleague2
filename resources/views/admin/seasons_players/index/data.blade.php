@if ($players->count() == 0)
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
            <col width="0%" class="d-none d-sm-table-cell" />
            <col width="0%" />
        </colgroup>

        <thead>
            <tr class="border-top">
                <th colspan="9" class="p-3 bg-light">
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
                <th scope="col" colspan="2" onclick="$('#allMark').trigger('click');">Jugador</th>
                <th scope="col" onclick="$('#allMark').trigger('click');">Media</th>
                <th scope="col" onclick="$('#allMark').trigger('click');">Pos.</th>
                <th scope="col" colspan="2" onclick="$('#allMark').trigger('click');" class="d-none d-sm-table-cell">Equipo</th>
                <th scope="col" onclick="$('#allMark').trigger('click');" class="text-right d-none d-sm-table-cell">Claúsula</th>
                <th scope="col" class="text-right" onclick="$('#allMark').trigger('click');"></th>
            </tr>
        </thead>

        <tbody>
            @foreach ($players as $player)
                <tr class="border-top" data-id="{{ $player->id }}" data-name="{{ $player->player->name }}" data-player-id="{{ $player->player_id }}" data-active="{{ $player->active }}" data-allow-delete="{{ $player->allowDelete() }}">
                    <td class="select">
                        <div class="pretty p-icon p-jelly mr-0">
                            <input type="checkbox" class="mark" value="{{ $player->id }}" name="playerId[]" onchange="showHideRowOptions(this)">
                            <div class="state p-primary">
                                <i class="icon material-icons">done</i>
                                <label></label>
                            </div>
                        </div>
                    </td>

                    <td class="img" onclick="rowSelect(this)">
                        <img src="{{ $player->player->getImgFormatted() }}" alt="" width="38">
                    </td>
                    <td onclick="rowSelect(this)">
                        @if (!$player->active)
                            <span class="badge badge-danger mr-1">OFF</span>
                        @endif
                        <span class="name">{{ $player->player->name }}</span>
                        <small class="d-block d-sm-none text-black-50 text-uppercase">
                            @if ($player->participant_id && $player->participant->team_id)
                                {{ $player->participant->team->name }}
                            @else
                                <img src="{{ asset('img/free.png') }}" alt="Libre" height="32" style="position: absolute; left: 13em">
                                <span class="text-warning">Agente libre</span>
                            @endif
                        </small>
                        <small class="d-none d-sm-block text-black-50 text-uppercase">
                            @if ($player->player->height)
                                {{ $player->player->height }} cm
                                @if ($player->player->age)
                                    / {{ $player->player->age }} años
                                @endif
                            @elseif ($player->player->age)
                                {{ $player->player->age }} años
                            @endif
                        </small>
                    </td>

                    <td onclick="rowSelect(this)" class="text-center">
                        <span>{{ $player->player->overall_rating }}</span>
                    </td>

                    <td onclick="rowSelect(this)" class="text-center">
                        <span>{{ $player->player->position }}</span>
                    </td>

                    @if ($active_season->participant_has_team)

                        @if ($player->participant_id && $player->participant->team_id)
                            <td onclick="rowSelect(this)" class="d-none d-sm-table-cell">
                                <img src="{{ $player->participant->team->getLogoFormatted() }}" alt="" width="32">
                            </td>
                            <td class="text-nowrap d-none d-sm-table-cell"  onclick="rowSelect(this)">
                                {{ $player->participant->team->name }}
                                <div>
                                    @if ($player->participant->user_id)
                                        <small>{{ $player->participant->user->name }}</small>
                                    @else
                                        <span class="badge badge-danger p-1 mt-1">SIN USUARIO</span>
                                    @endif

                                </div>
                            </td>
                        @else
                            <td onclick="rowSelect(this)" class="d-none d-sm-table-cell">
                                {{-- <img src="{{ asset('img/team_no_image.png') }}" alt="" width="32"> --}}
                                <img src="{{ asset('img/free.png') }}" alt="Libre" height="32">
                            </td>
                            <td class="text-nowrap d-none d-sm-table-cell" onclick="rowSelect(this)">
                                <small class="text-warning">Agente libre</small>
                            </td>
                        @endif

                    @else

                        @if ($player->participant->user_id)
                            <td onclick="rowSelect(this)" class="d-none d-sm-table-cell">
                                <img src="{{ $player->participant->user->avatar() }}" alt="" width="32">
                            </td>
                            <td class="text-nowrap d-none d-sm-table-cell"  onclick="rowSelect(this)">
                                {{ $player->participant->user->name }}
                            </td>
                        @else
                            <td onclick="rowSelect(this)" class="d-none d-sm-table-cell">
                                <img src="{{ asset('img/user_unknown.png') }}" alt="" width="32">
                            </td>
                            <td class="text-nowrap d-none d-sm-table-cell" onclick="rowSelect(this)">
                                Libre
                            </td>
                        @endif

                    @endif

                    <td onclick="rowSelect(this)" class="text-right d-none d-sm-table-cell">
                        <span>{{ $player->price }}</span>
                    </td>

                    <td class="actions">
                        <a id="btnRegActions" class="btn btn-link dropdown-toggle" data-toggle="dropdown">
                            <i class="fas fa-ellipsis-h text-secondary"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right my-1" aria-labelledby="btnRegActions">
                            <a href="" class="btn-view dropdown-item text-secondary" data-toggle="modal" data-target="#viewModal" id="btnView{{ $player->player_id }}">
                                <i class="far fa-eye fa-fw mr-1"></i>
                                Visualizar
                            </a>
                            @if ($player->active)
                                <a class="dropdown-item text-secondary" href="{{ route('admin.season_players.desactivate', $player->id) }}" id="btnDesactivate{{ $player->id }}">
                                    <i class="fas fa-toggle-off fa-fw mr-1"></i>
                                    Desactivar
                                </a>
                            @else
                                <a class="dropdown-item text-secondary" href="{{ route('admin.season_players.activate', $player->id) }}" id="btnActivate{{ $player->id }}">
                                    <i class="fas fa-toggle-on fa-fw mr-1"></i>
                                    Activar
                                </a>
                            @endif
                            <a class="dropdown-item text-secondary" href="{{ route('admin.season_players.edit', $player->id) }}" id="btnEdit{{ $player->id }}">
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
        <div class="regs-info2 float-left">Registros: {{ $players->firstItem() }}-{{ $players->lastItem() }} de {{ $players->total() }}</div>
        <div class="float-right">{!! $players->appends(Request::all())->render() !!}</div>
    </div>

    <form id="form-delete" action="{{ route('admin.season_players.destroy', ':PLAYER_ID') }}" method="post">
        {{ csrf_field() }}
        {{ method_field('delete') }}
    </form>
@endif
@if ($players->count() == 0)
    <div class="text-center border-top py-4">
        @if ($filterName == null && $filterPlayerDb == null)
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
            <col width="0%" />
            <col width="100%" />
            <col width="0%" />
            <col width="0%" />
            <col width="0%" />
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
                <th scope="col" colspan="2" class="name" onclick="$('#allMark').trigger('click');">Jugador</th>
                <th scope="col" class="name" onclick="$('#allMark').trigger('click');">Pais</th>
                <th scope="col" class="name" onclick="$('#allMark').trigger('click');">Pos</th>
                <th scope="col" class="name" onclick="$('#allMark').trigger('click');">Altura</th>
                <th scope="col" class="name" onclick="$('#allMark').trigger('click');">Edad</th>
                <th scope="col" class="name" onclick="$('#allMark').trigger('click');">Media</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($players as $player)
                <tr class="border-top" data-id="{{ $player->id }}" data-name="{{ $player->name }}">
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
                        <img src="{{ $player->getImgFormatted() }}" alt="" width="38">
                    </td>
                    <td class="name" onclick="rowSelect(this)">
                        <span>{{ $player->name }}</span>
                        <span class="d-block">
                            @if ($player->playerDb)
                                <small class="text-black-50 text-uppercase">{{ $player->team->name }}</small>
                            @endif
                        </span>
                    </td>
                    <td onclick="rowSelect(this)">
                        <img class="d-block" src="{{ $player->nation->getImgFormatted() }}" alt="" width="24">
                        <small>{{ $player->nation_name }}</small>
                    </td>
                    <td onclick="rowSelect(this)">
                        <span>{{ $player->position }}</span>
                    </td>
                    <td onclick="rowSelect(this)">
                        <span>{{ $player->height }}</span>
                    </td>
                    <td onclick="rowSelect(this)">
                        <span>{{ $player->age }}</span>
                    </td>
                    <td onclick="rowSelect(this)">
                        <span>{{ $player->overall_rating }}</span>
                    </td>
                    <td class="actions">
                        <a id="btnRegActions" class="btn btn-link dropdown-toggle" data-toggle="dropdown">
                            <i class="fas fa-ellipsis-h text-secondary"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right my-1" aria-labelledby="btnRegActions">
                            <a href="" class="btn-view dropdown-item text-secondary" data-toggle="modal" data-target="#viewModal" id="btnView{{ $player->id }}">
                                <i class="far fa-eye fa-fw mr-1"></i>
                                Visualizar
                            </a>
                            <a class="dropdown-item text-secondary" href="{{ route('admin.players.edit', $player->id) }}" id="btnEdit{{ $player->id }}">
                                <i class="fas fa-edit fa-fw mr-1"></i>
                                Editar
                            </a>
                            <a class="dropdown-item text-secondary" href="{{ route('admin.players.duplicate', $player->id) }}">
                                <i class="fas fa-clone fa-fw mr-1"></i>
                                Duplicar
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

    <div class="regs-info clearfix border-top p-3">
        <div class="regs-info2 float-left">Registros: {{ $players->firstItem() }}-{{ $players->lastItem() }} de {{ $players->total() }}</div>
        <div class="float-right">{!! $players->appends(Request::all())->render() !!}</div>
    </div>

    <form id="form-delete" action="{{ route('admin.players.destroy', ':PLAYER_ID') }}" method="post">
        {{ csrf_field() }}
        {{ method_field('delete') }}
    </form>

@endif
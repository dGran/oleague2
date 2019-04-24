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
    <table class="animated fadeIn">
        <colgroup>
            <col width="0%" />
            <col width="0%" />
            <col width="100%" />
            @if ($active_season->use_economy)
                <col width="0%" />
            @endif
            @if ($active_season->use_rosters)
                <col width="0%" />
            @endif
            <col width="0%" />
        </colgroup>

        <thead>
            <tr class="border-top">
                <th scope="col" colspan="8" class="p-3 bg-light">
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
                <th scope="col" colspan="2" onclick="$('#allMark').trigger('click');">Participante</th>
                @if ($active_season->use_economy)
                    <th scope="col" onclick="$('#allMark').trigger('click');"><i class="fas fa-piggy-bank" style="font-size: 1.25em"></i></th>
                @endif
                @if ($active_season->use_rosters)
                    <th scope="col" onclick="$('#allMark').trigger('click');"><i class="fas fa-user-shield" style="font-size: 1.25em"></i></th>
                @endif
                <th scope="col" class="text-right" onclick="$('#allMark').trigger('click');"></th>
            </tr>
        </thead>

        <tbody>
            @foreach ($participants as $participant)
                {{-- comentamos la linea por el data-allow-delete --}}
                {{-- <tr class="border-top" data-id="{{ $participant->id }}" data-name="{{ $participant->name }}" data-allow-delete="{{ $participant->teams->count() > 0 ? 0 : 1 }}"> --}}
                <tr class="border-top" data-id="{{ $participant->id }}" data-name="{{ $participant->name() }}" data-user-name="{{ $participant->user_id ? $participant->user->name : '' }}">

                    <td class="select">
                        <div class="pretty p-icon p-jelly mr-0">
                            <input type="checkbox" class="mark" value="{{ $participant->id }}" name="teamId[]" onchange="showHideRowOptions(this)">
                            <div class="state p-primary">
                                <i class="icon material-icons">done</i>
                                <label></label>
                            </div>
                        </div>
                    </td>

                    <td class="logo" onclick="rowSelect(this)">
                        <img src="{{ $participant->logo() }}" alt="" width="32">
                    </td>
                    <td onclick="rowSelect(this)">
                        <span class="name text-uppercase">{{ $participant->name() == 'undefined' ? '' : $participant->name() }}</span>
                        <br>
                        <small class="text-black-50">
                            @if ($participant->sub_name() == 'undefined')
                                <span class="badge badge-danger p-1 mt-1">SIN USUARIO</span>
                            @else
                                {{ $participant->sub_name() }}
                            @endif
                        </small>
                    </td>

                    @if ($active_season->use_economy)
                        <td class="text-nowrap text-right">
                            <small>{{ $participant->budget_formatted() }}</small>
                        </td>
                    @endif

                    @if ($active_season->use_rosters)
                        <td class="text-nowrap text-right">
                            @if ($participant->players)
                                <small>{{ $participant->players->count() }} jug.</small>
                            @else
                                <small>0 jug.</small>
                            @endif
                        </td>
                    @endif

                    <td class="actions">
                        <a id="btnRegActions" class="btn btn-link dropdown-toggle" data-toggle="dropdown">
                            <i class="fas fa-ellipsis-h text-secondary"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right my-1" aria-labelledby="btnRegActions">
                            <a class="dropdown-item text-secondary" href="{{ route('admin.season_participants.edit', $participant->id) }}" id="btnEdit{{ $participant->id }}">
                                <i class="fas fa-edit fa-fw mr-1"></i>
                                Editar
                            </a>
                            @if ($active_season->use_economy)
                                <a class="dropdown-item text-secondary" href="" data-toggle="modal" data-target="#cashHistoryModal" id="btnCashHistory{{ $participant->id }}"">
                                    <i class="fas fa-piggy-bank fa-fw mr-1"></i>
                                    Historial de economía
                                </a>
                            @endif
                            @if ($active_season->use_rosters)
                                <a class="dropdown-item text-secondary" href="" data-toggle="modal" data-target="#rosterModal" id="btnRoster{{ $participant->id }}"">
                                    <i class="fas fa-user-shield fa-fw mr-1"></i>
                                    Plantilla
                                </a>
                            @endif
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
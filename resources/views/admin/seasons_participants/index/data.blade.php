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
                <th scope="col" colspan="2" class="" onclick="$('#allMark').trigger('click');">Usuario</th>
                <th scope="col" colspan="2" class="d-none d-sm-table-cell" onclick="$('#allMark').trigger('click');">Equipo</th>
                <th scope="col" class="d-none d-xl-table-cell" onclick="$('#allMark').trigger('click');">Temporada</th>
                <th class="text-right" onclick="$('#allMark').trigger('click');"></th>
            </tr>
        </thead>

        <tbody>
            @foreach ($participants as $participant)
                {{-- comentamos la linea por el data-allow-delete --}}
                {{-- <tr class="border-top" data-id="{{ $participant->id }}" data-name="{{ $participant->name }}" data-allow-delete="{{ $participant->teams->count() > 0 ? 0 : 1 }}"> --}}
                <tr class="border-top" data-id="{{ $participant->id }}" data-name="{{ $participant->name }}">
                    <td class="select">
                        <div class="pretty p-icon p-jelly mr-0">
                            <input type="checkbox" class="mark" value="{{ $participant->id }}" name="teamId[]" onchange="showHideRowOptions(this)">
                            <div class="state p-primary">
                                <i class="icon material-icons">done</i>
                                <label></label>
                            </div>
                        </div>
                    </td>

                    @if ($participant->user_id)
                        <td onclick="rowSelect(this)">
                            <img src="{{ $participant->user->avatar() }}" alt="" width="38" class="rounded-circle">
                        </td>
                        <td class="text-nowrap" onclick="rowSelect(this)">
                            {{ $participant->user->name }}
                            @if ($participant->team_id)
                                <small class="d-table-cell d-sm-none">{{ $participant->team->name }}</small>
                            @else
                                <small class="d-table-cell d-sm-none">Equipo no definido</small>
                            @endif
                        </td>
                    @else
                        <td onclick="rowSelect(this)">
                            <img src="{{ asset('img/user_unknown.png') }}" alt="" width="38">
                        </td>
                        <td class="text-nowrap" onclick="rowSelect(this)">
                            No definido
                            @if ($participant->team_id)
                                <small class="d-table-cell d-sm-none">{{ $participant->team->name }}</small>
                            @else
                                <small class="d-table-cell d-sm-none">Equipo no definido</small>
                            @endif
                        </td>
                    @endif

                    @if ($participant->team_id)
                        <td onclick="rowSelect(this)" class="d-none d-sm-table-cell">
                            <img src="{{ $participant->team->getLogoFormatted() }}" alt="" width="38">
                        </td>
                        <td class="text-nowrap d-none d-sm-table-cell"  onclick="rowSelect(this)">
                            {{ $participant->team->name }}
                        </td>
                    @else
                        <td onclick="rowSelect(this)" class="d-none d-sm-table-cell">
                            <img src="{{ asset('img/team_no_image.png') }}" alt="" width="38">
                        </td>
                        <td class="text-nowrap d-none d-sm-table-cell" onclick="rowSelect(this)">
                            No definido
                        </td>
                    @endif

                    <td class="text-nowrap d-none d-xl-table-cell"  onclick="rowSelect(this)">
                        {{ $participant->season->name }}
                    </td>

                    <td class="actions">
                        <a id="btnRegActions" class="btn btn-link dropdown-toggle" data-toggle="dropdown">
                            <i class="fas fa-ellipsis-h text-secondary"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right my-1" aria-labelledby="btnRegActions">
                            <a class="dropdown-item text-secondary" href="{{ route('admin.season_participants.edit', $participant->id) }}" id="btnEdit{{ $participant->id }}">
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
        <div class="regs-info2 float-left">Registros: {{ $participants->firstItem() }}-{{ $participants->lastItem() }} de {{ $participants->total() }}</div>
        <div class="float-right">{!! $participants->appends(Request::all())->render() !!}</div>
    </div>

    <form id="form-delete" action="{{ route('admin.season_participants.destroy', ':PARTICIPANT_ID') }}" method="post">
        {{ csrf_field() }}
        {{ method_field('delete') }}
    </form>
@endif
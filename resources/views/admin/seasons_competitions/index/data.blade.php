@if ($competitions->count() == 0)
    <div class="text-center border-top py-4">
        @if ($filterSeason == null)
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
                <th scope="col" colspan="2" class="name" onclick="$('#allMark').trigger('click');">Competición</th>
                <th scope="col" onclick="$('#allMark').trigger('click');"></th>
            </tr>
        </thead>

        <tbody>
            @foreach ($competitions as $competition)
                {{-- <tr class="border-top" data-id="{{ $competition->id }}" data-name="{{ $competition->name }}" data-allow-delete="{{ $competition->teams->count() > 0 ? 0 : 1 }}"> --}}
                <tr class="border-top" data-id="{{ $competition->id }}" data-name="{{ $competition->name }}">
                    <td class="select">
                        <div class="pretty p-icon p-jelly mr-0">
                            <input type="checkbox" class="mark" value="{{ $competition->id }}" name="competitionId[]" onchange="showHideRowOptions(this)">
                            <div class="state p-primary">
                                <i class="icon material-icons">done</i>
                                <label></label>
                            </div>
                        </div>
                    </td>
                    <td onclick="rowSelect(this)">
                        <img src="{{ $competition->getImgFormatted() }}" alt="" width="38">
                    </td>
                    <td onclick="rowSelect(this)">
                        <span class="name">{{ $competition->name }}</span>
                        <small class="d-block">16 participantes</small>
                    </td>
                    <td>
                        <a href="" class="btn btn-primary">Fases</a>
                    </td>
                    <td class="actions">
                        <a id="btnRegActions" class="btn btn-link dropdown-toggle" data-toggle="dropdown">
                            <i class="fas fa-ellipsis-h text-secondary"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right my-1" aria-labelledby="btnRegActions">
                            <a class="dropdown-item text-secondary" href="{{ route('admin.season_competitions.edit', $competition->id) }}" id="btnEdit{{ $competition->id }}">
                                <i class="fas fa-edit fa-fw mr-1"></i>
                                Editar
                            </a>
                            {{-- <a class="dropdown-item text-secondary" href="{{ route('admin.season_competitions.duplicate', $competition->id) }}">
                                <i class="fas fa-clone fa-fw mr-1"></i>
                                Duplicar
                            </a> --}}
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
        <div class="regs-info2 float-left">Registros: {{ $competitions->firstItem() }}-{{ $competitions->lastItem() }} de {{ $competitions->total() }}</div>
        <div class="float-right">{!! $competitions->appends(Request::all())->render() !!}</div>
    </div>

    <form id="form-delete" action="{{ route('admin.season_competitions.destroy', ':COMPETITION_ID') }}" method="post">
        {{ csrf_field() }}
        {{ method_field('delete') }}
    </form>
@endif
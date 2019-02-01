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
                <th scope="col" colspan="3" class="name" onclick="$('#allMark').trigger('click');">Temporada</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($seasons as $season)
                {{-- mantengo la linea comentada por el data-allow-delete, crear un metodo que compruebe si tiene competiciones o participantes o plantillas (cualquier tabla que use su id)....para permitir o no eliminar --}}
                {{-- <tr class="border-top" data-id="{{ $season->id }}" data-name="{{ $season->name }}" data-allow-delete="{{ $season->teams->count() > 0 ? 0 : 1 }}"> --}}
                <tr class="border-top" data-id="{{ $season->id }}" data-name="{{ $season->name }}"">
                    <td class="select">
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
{{--                         @if ($season->hasTeams())
                            <small class="d-block">Equipos: {{ $season->teams->count() }}</small>
                        @endif --}}
                    </td>
                    <td class="actions">
                        <a id="btnRegActions" class="btn btn-link dropdown-toggle" data-toggle="dropdown">
                            <i class="fas fa-ellipsis-h text-secondary"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right my-1" aria-labelledby="btnRegActions">
                            <a class="dropdown-item text-secondary" href="{{ route('admin.seasons.edit', $season->id) }}" id="btnEdit{{ $season->id }}">
                                <i class="fas fa-edit fa-fw mr-1"></i>
                                Editar
                            </a>
                            <a class="dropdown-item text-secondary" href="{{ route('admin.seasons.duplicate', $season->id) }}">
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

    <div class="regs-info clearfix border-top p-3 px-md-0">
        <div class="regs-info2 float-left">Registros: {{ $seasons->firstItem() }}-{{ $seasons->lastItem() }} de {{ $seasons->total() }}</div>
        <div class="float-right">{!! $seasons->appends(Request::all())->render() !!}</div>
    </div>

    <form id="form-delete" action="{{ route('admin.seasons.destroy', ':SEASON_ID') }}" method="post">
        {{ csrf_field() }}
        {{ method_field('delete') }}
    </form>
@endif
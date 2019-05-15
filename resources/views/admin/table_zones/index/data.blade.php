@if ($table_zones->count() == 0)
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
                <th scope="col" colspan="3" class="name" onclick="$('#allMark').trigger('click');">Marcado de zonas</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($table_zones as $zone)
                <tr class="border-top" data-id="{{ $zone->id }}" data-name="{{ $zone->name }}">
                    <td class="select">
                        <div class="pretty p-icon p-jelly mr-0">
                            <input type="checkbox" class="mark" value="{{ $zone->id }}" name="zoneId[]" onchange="showHideRowOptions(this)">
                            <div class="state p-primary">
                                <i class="icon material-icons">done</i>
                                <label></label>
                            </div>
                        </div>
                    </td>
                    <td class="logo" onclick="rowSelect(this)">
                        <img src="{{ $zone->getImgFormatted() }}" alt="" width="32">
                    </td>
                    <td class="name" onclick="rowSelect(this)">
                        <span>{{ $zone->name }}</span>
                    </td>
                    <td class="actions">
                        <a id="btnRegActions" class="btn btn-link dropdown-toggle" data-toggle="dropdown">
                            <i class="fas fa-ellipsis-h text-secondary"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right my-1" aria-labelledby="btnRegActions">
                            <a class="dropdown-item text-secondary" href="{{ route('admin.table_zones.edit', $zone->id) }}" id="btnEdit{{ $zone->id }}">
                                <i class="fas fa-edit fa-fw mr-1"></i>
                                Editar
                            </a>
                            <a class="dropdown-item text-secondary" href="{{ route('admin.table_zones.duplicate', $zone->id) }}">
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
        <div class="regs-info2 float-left">Registros: {{ $table_zones->firstItem() }}-{{ $table_zones->lastItem() }} de {{ $table_zones->total() }}</div>
        <div class="float-right">{!! $table_zones->appends(Request::all())->render() !!}</div>
    </div>

    <form id="form-delete" action="{{ route('admin.table_zones.destroy', ':ZONE_ID') }}" method="post">
        {{ csrf_field() }}
        {{ method_field('delete') }}
    </form>
@endif
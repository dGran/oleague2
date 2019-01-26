@if ($logs->count() == 0)
    <div class="text-center border-top py-4">
        @if ($filterUser == null && $filterTable == null && $filterPosition == null)
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
            <col width="0%"/>
            <col width="100%" />
            <col width="0%" />
        </colgroup>

        <thead>
            <tr class="border-top">
                <th scope="col">Fecha</th>
                <th scope="col">Tabla</th>
                <th scope="col">Tipo</th>
                <th scope="col">Descripción</th>
                <th scope="col">Usuario</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($logs as $log)
                <tr class="border-top">
                    <td onclick="rowSelect(this)">
                        <small class="d-block">{{ \Carbon\Carbon::parse($log->created_at)->format('d/m/Y')}}</small>
                        <small>{{ \Carbon\Carbon::parse($log->created_at)->format('H:s')}}</small>
                    </td>
                    <td onclick="rowSelect(this)">
                        <span class="d-block text-nowrap">{{ $log->table }}</span>
                        <small class="d-block text-nowrap">Registro: #{{ $log->reg_id }}</small>
                    </td>
                    <td onclick="rowSelect(this)">
                        <span class="text-nowrap">
                            @if ($log->type == "INSERT")
                                <span class="badge badge-success">INSERT</span>
                            @elseif ($log->type == "UPDATE")
                                <span class="badge badge-light">UPDATE</span>
                            @elseif ($log->type == "DELETE")
                                <span class="badge badge-danger">DELETE</span>
                            @endif
                        </span>
                    </td>
                    <td onclick="rowSelect(this)">
                        <span>{{ $log->description }}</span>
                    </td>
                    <td onclick="rowSelect(this)">
                        <span class="text-nowrap">{{ $log->user->name }}</span>
                    </td>
{{--                     <td class="actions">
                        <a id="btnRegActions" class="btn btn-link dropdown-toggle" data-toggle="dropdown">
                            <i class="fas fa-ellipsis-h text-secondary"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right my-1" aria-labelledby="btnRegActions">
                            <a class="dropdown-item text-secondary" href="{{ route('admin.players_dbs.edit', $log->id) }}" id="btnEdit{{ $log->id }}">
                                <i class="fas fa-edit fa-fw mr-1"></i>
                                Editar
                            </a>
                            <a class="dropdown-item text-secondary" href="{{ route('admin.players_dbs.duplicate', $log->id) }}">
                                <i class="fas fa-clone fa-fw mr-1"></i>
                                Duplicar
                            </a>
                            <a href="" class="btn-delete dropdown-item text-danger" value="Eliminar">
                                <i class="fas fa-trash fa-fw mr-1"></i>
                                Eliminar
                            </a>
                        </div>
                    </td> --}}
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="regs-info clearfix border-top p-3 px-md-0">
        <div class="regs-info2 float-left">Registros: {{ $logs->firstItem() }}-{{ $logs->lastItem() }} de {{ $logs->total() }}</div>
        <div class="float-right">{!! $logs->appends(Request::all())->render() !!}</div>
    </div>

{{--     <form id="form-delete" action="{{ route('admin.players_dbs.destroy', ':LOG_ID') }}" method="post">
        {{ csrf_field() }}
        {{ method_field('delete') }}
    </form> --}}
@endif
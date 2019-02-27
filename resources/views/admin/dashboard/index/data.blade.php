@if ($logs->count() == 0)
    <div class="text-center border-top py-4">
        @if ($filterDescription == null && $filterUser == null && $filterTable == null && $filterType == null)
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
    <table class="animated fadeIn">

        <colgroup>
            <col width="0%" />
            <col width="100%" />
            <col width="0%"/>
            <col width="0%" />
            <col width="0%" />
        </colgroup>

        <thead>
            <tr class="border-top">
                <th scope="col" class="date">Fecha</th>
                <th scope="col">Descripción</th>
                <th scope="col" class="d-none d-sm-table-cell">Tipo</th>
                <th scope="col" class="d-none d-sm-table-cell">Tabla</th>
                <th scope="col" class="d-table-cell d-sm-none">Tabla</th>
                <th scope="col" class="user"></th>
            </tr>
        </thead>

        <tbody>
            @foreach ($logs as $log)
                <tr class="border-top">
                    <td class="date align-top">
                        <small class="d-block">{{ \Carbon\Carbon::parse($log->created_at)->format('d/m/Y')}}</small>
                        <small>{{ \Carbon\Carbon::parse($log->created_at)->format('H:m:s')}}</small>
                    </td>
                    <td class="description align-top">
                        <span>{{ $log->description }}</span>
                    </td>
                    <td class="d-none d-sm-table-cell">
                        <span class="text-nowrap">
                            @if ($log->type == "INSERT")
                                <span class="badge badge-success">INSERT</span>
                            @elseif ($log->type == "UPDATE")
                                <span class="badge badge-secondary">UPDATE</span>
                            @elseif ($log->type == "DELETE")
                                <span class="badge badge-danger">DELETE</span>
                            @endif
                        </span>
                    </td>
                    <td class="d-none d-sm-table-cell">
                        <small class="d-block text-nowrap">{{ $log->table }}</small>
                        <small class="d-block text-nowrap">Registro: #{{ $log->reg_id }}</small>
                    </td>
                    <td class="d-table-cell d-sm-none">
                        <small class="d-block text-nowrap">{{ $log->table }}</small>
                        <span class="text-nowrap mt-1">
                            @if ($log->type == "INSERT")
                                <span class="badge badge-success">INSERT</span>
                            @elseif ($log->type == "UPDATE")
                                <span class="badge badge-secondary">UPDATE</span>
                            @elseif ($log->type == "DELETE")
                                <span class="badge badge-danger">DELETE</span>
                            @endif
                        </span>
                    </td>
                    <td class="user">
                        @if ($log->user->hasProfile())
                            <a class="dropdown" id="dropdownUserMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <figure class="user-img m-0">
                                    <img src="{{ $log->user->profile->avatar }}" alt="" class="rounded-circle" width="32" data-container="body" data-toggle="popover" data-placement="left" data-content="{{ $log->user->name }}">
                                </figure>
                            </a>
                        @else
                            <a class="dropdown" id="dropdownUserMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <figure class="user-img m-0" data-container="body" data-toggle="popover" data-placement="left" data-content="{{ $log->user->name }}">
                                    <img src="{{ asset('img/avatars/default.png') }}" alt="" class="rounded-circle" width="32">
                                </figure>
                            </a>
                        @endif
                    </td>
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
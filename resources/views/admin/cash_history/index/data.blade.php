@if ($cash_histories->count() == 0)
    <div class="text-center border-top py-4">
        <figure>
            <img src="{{ asset('img/oops.png') }}" alt="" width="72">
        </figure>
        <strong>Oops!!!, </strong>no se han encontrado resultados
    </div>
@else
    <table class="animated fadeIn">
        <colgroup>
            <col width="0%" />
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
                <th scope="col" onclick="$('#allMark').trigger('click');">FECHA</th>
                <th scope="col" class="text-center" onclick="$('#allMark').trigger('click');">E/S</th>
                <th scope="col" onclick="$('#allMark').trigger('click');">DESCRIPCION</th>
                <th scope="col" class="text-right" onclick="$('#allMark').trigger('click');">CANTIDAD</th>
                <th scope="col" class="text-right" onclick="$('#allMark').trigger('click');"></th>
            </tr>
        </thead>

        <tbody>
            @foreach ($cash_histories as $cash)
                {{-- comentamos la linea por el data-allow-delete --}}
                {{-- <tr class="border-top" data-id="{{ $participant->id }}" data-name="{{ $participant->name }}" data-allow-delete="{{ $participant->teams->count() > 0 ? 0 : 1 }}"> --}}
                <tr class="border-top" data-id="{{ $cash->id }}" data-name="{{ $cash->description }}">

                    <td class="select">
                        <div class="pretty p-icon p-jelly mr-0">
                            <input type="checkbox" class="mark" value="{{ $cash->id }}" name="teamId[]" onchange="showHideRowOptions(this)">
                            <div class="state p-primary">
                                <i class="icon material-icons">done</i>
                                <label></label>
                            </div>
                        </div>
                    </td>
                    <td class="" onclick="rowSelect(this)">
                        <small class="d-block">{{ \Carbon\Carbon::parse($cash->created_at)->format('d/m/Y')}}</small>
                        <small class="d-block">{{ \Carbon\Carbon::parse($cash->created_at)->format('h:m')}}</small>
                    </td>
                    <td class="" onclick="rowSelect(this)">
                        @if ($cash->movement == "E")
                            <i class="fas fa-piggy-bank text-success mr-1"></i>
                        @else
                            <i class="fas fa-piggy-bank text-danger mr-1"></i>
                        @endif
                    </td>
                    <td onclick="rowSelect(this)">
                        <span class="d-block">{{ $cash->description }}</span>
                        <small class="text-muted">{{ $cash->participant->name() }}</small>
                    </td>
                    <td class="text-right" onclick="rowSelect(this)">
                        <div class="amount">
                            @if ($cash->movement == "S")
                            -
                            @endif
                            {{ $cash->amount }}
                        </div>
                    </td>

                    <td class="actions">
                        <a id="btnRegActions" class="btn btn-link dropdown-toggle" data-toggle="dropdown">
                            <i class="fas fa-ellipsis-h text-secondary"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right my-1" aria-labelledby="btnRegActions">
                            <a class="dropdown-item text-secondary" href="{{ route('admin.season_cash_history.edit', $cash->id) }}" id="btnEdit{{ $cash->id }}">
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
        <div class="regs-info2 float-left">Registros: {{ $cash_histories->firstItem() }}-{{ $cash_histories->lastItem() }} de {{ $cash_histories->total() }}</div>
        <div class="float-right">{!! $cash_histories->appends(Request::all())->render() !!}</div>
    </div>

    <form id="form-delete" action="{{ route('admin.season_cash_history.destroy', ':CASH_ID') }}" method="post">
        {{ csrf_field() }}
        {{ method_field('delete') }}
    </form>
@endif
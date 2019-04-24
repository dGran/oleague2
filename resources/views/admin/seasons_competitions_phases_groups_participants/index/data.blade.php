@if ($participants->count() == 0)
    <div class="text-center border-top py-4">
        <figure>
            <img src="{{ asset('img/table-empty.png') }}" alt="" width="72">
        </figure>
        Actualmente no existen registros
    </div>
@else
    <table class="animated fadeIn">
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
                <th scope="col" colspan="2" onclick="$('#allMark').trigger('click');">Participante</th>
                <th scope="col" class="text-right" onclick="$('#allMark').trigger('click');"></th>
            </tr>
        </thead>

        <tbody>
            @foreach ($participants as $participant)
                {{-- comentamos la linea por el data-allow-delete --}}
                {{-- <tr class="border-top" data-id="{{ $participant->id }}" data-name="{{ $participant->name }}" data-allow-delete="{{ $participant->teams->count() > 0 ? 0 : 1 }}"> --}}
                <tr class="border-top" data-id="{{ $participant->id }}" data-name="{{ $participant->participant->name() }}" data-user-name="{{ $participant->participant->user_id ? $participant->participant->user->name : '' }}">

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
                        <img src="{{ $participant->participant->logo() }}" alt="" width="32">
                    </td>
                    <td onclick="rowSelect(this)">
                        <span class="name text-uppercase">{{ $participant->participant->name() == 'undefined' ? '' : $participant->participant->name() }}</span>
                        <br>
                        <small class="text-black-50">
                            @if ($participant->participant->sub_name() == 'undefined')
                                <span class="badge badge-danger p-1 mt-1">SIN USUARIO</span>
                            @else
                                {{ $participant->participant->sub_name() }}
                            @endif
                        </small>
                    </td>

                    <td class="actions">
                        <a id="btnRegActions" class="btn btn-link dropdown-toggle" data-toggle="dropdown">
                            <i class="fas fa-ellipsis-h text-secondary"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right my-1" aria-labelledby="btnRegActions">
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
        <div class="regs-info2 float-left">Registros: {{ $participants->count() }}</div>
    </div>

    <form id="form-delete" action="{{ route('admin.season_participants.destroy', ':PARTICIPANT_ID') }}" method="post">
        {{ csrf_field() }}
        {{ method_field('delete') }}
    </form>
@endif
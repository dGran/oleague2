<div class="table-form-content col-12 animated fadeIn p-0 border-0">
    @if (!$playoff->rounds)
        <div class="text-center border-top py-4">
            <figure>
                <img src="{{ asset('img/table-empty.png') }}" alt="" width="72">
            </figure>
            Actualmente no existen rondas
        </div>
    @else
        <table class="table calendar">
{{--            <colgroup>
                <col width="50%" />
                <col width="0%" />
                <col width="0%" />
                <col width="0%" />
                <col width="50%" />
            </colgroup> --}}
            @foreach ($playoff->rounds as $round)
                @if ($round->clashes->count() == 0)
                    <tr class="days border">
                        <td colspan="6" class="p-2">
                            <strong class="text-uppercase float-left">{{ $round->name }}</strong>
                            <a class="float-right" href="{{ route('admin.season_competitions_phases_groups_playoffs.generate_clashes', $round->id) }}" class="btn btn-primary">
                                <i class="fas fa-dice"></i>
                            </a>
                            <a class="float-right mr-3" href="{{ route('admin.season_competitions_phases_groups_playoffs.generate_empty_clashes', $round->id) }}" class="btn btn-primary">
                                <i class="fas fa-magic"></i>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="9">
                            <div class="text-center">
                                <figure>
                                    <img src="{{ asset('img/table-empty.png') }}" alt="" width="72">
                                </figure>
                                Actualmente no existen emparejamientos
                            </div>
                        </td>
                    </tr>
                @else
                    <tr class="days border">
                        <td colspan="6" class="p-2">
                            <strong class="text-uppercase float-left">{{ $round->name }}</strong>
                            <a class="float-right" href="{{ route('admin.season_competitions_phases_groups_playoffs.generate_clashes', $round->id) }}" class="btn btn-primary">
                                <i class="fas fa-dice"></i>
                            </a>
                            <a class="float-right mr-3" href="{{ route('admin.season_competitions_phases_groups_playoffs.generate_empty_clashes', $round->id) }}" class="btn btn-primary">
                                <i class="fas fa-magic"></i>
                            </a>
                        </td>
                    </tr>
                    @foreach ($round->clashes->sortByDesc('order') as $clash)

                        <tr class="clashes" data-id="{{ $clash->id }}" data-name="{{ $clash->local_participant_name() . ' ' . $clash->local_score . '-' . $clash->visitor_score . ' ' . $clash->visitor_participant_name() }}">
                            <td class="text-right">
                                @if ($clash->local_participant)
                                    <span class="text-uppercase {{ $clash->sanctioned_id && $clash->local_id == $clash->sanctioned_id ? 'text-danger' : '' }}">{{ $clash->local_participant->participant->name() == 'undefined' ? '' : $clash->local_participant_name() }}</span>
                                    @if (($clash->sanctioned_id) && ($clash->local_id == $clash->sanctioned_id))
                                        <i class="fas fa-exclamation ml-1 text-danger"></i>
                                    @endif
                                    <small class="text-black-50 d-block">
                                        @if ($clash->local_participant->participant->sub_name() == 'undefined')
                                            <span class="badge badge-danger p-1 mt-1">SIN USUARIO</span>
                                        @else
                                            {{ $clash->local_participant->participant->sub_name() }}
                                        @endif
                                    </small>
                                    <a href="{{ route('admin.season_competitions_phases_groups_playoffs.clashes.liberate_local_participant', $clash->id) }}" class="d-block text-danger">
                                        <small>Liberar participante</small>
                                    </a>
                                @else
                                    <span class="text-uppercase">No definido</span>
                                    <a href="" data-toggle="modal" data-target="#assingLocalParticipantModal" class="d-block pt-1">
                                        <small>Asignar participante</small>
                                    </a>
                                @endif
                            </td>
                            <td class="img text-right" width="32">
                                @if ($clash->local_participant)
                                    <img src="{{ $clash->local_participant->participant->logo() }}" alt="">
                                @endif
                            </td>
                            <td class="score text-center" width="90">
                                @if (is_null($clash->local_score) && is_null($clash->visitor_score))
                                    <a href="" data-toggle="modal" data-target="#updateModal">
                                        <small class="bg-primary rounded px-3 py-1 text-white">
                                            EDITAR
                                        </small>
                                    </a>
                                @else
                                    <span class="bg-light rounded px-3 py-1 {{ $clash->sanctioned_id ? 'border text-danger' : '' }}">
                                        {{ $clash->local_score }} - {{ $clash->visitor_score }}
                                    </span>
    {{--                                <a href="{{ route('admin.season_competitions_phases_groups_leagues.reset_clash', [$group->phase->competition->slug, $group->phase->slug, $group->slug, $clash->id]) }}" class="btnReset">
                                        <i class="fas fa-undo-alt ml-1"></i>
                                    </a> --}}
                                @endif
                            </td>
                            <td class="img text-left" width="32">
                                @if ($clash->visitor_participant)
                                    <img src="{{ $clash->visitor_participant->participant->logo() }}" alt="">
                                @endif
                            </td>
                            <td class="text-left">
                                @if ($clash->visitor_participant)
                                    @if (($clash->sanctioned_id) && ($clash->visitor_id == $clash->sanctioned_id))
                                        <i class="fas fa-exclamation mr-1 text-danger"></i>
                                    @endif
                                    <span class="text-uppercase {{ $clash->sanctioned_id && $clash->visitor_id == $clash->sanctioned_id ? 'text-danger' : '' }}">{{ $clash->visitor_participant->participant->name() == 'undefined' ? '' : $clash->visitor_participant->participant->name() }}</span>
                                    <small class="text-black-50 d-block">
                                        @if ($clash->visitor_participant->participant->sub_name() == 'undefined')
                                            <span class="badge badge-danger p-1 mt-1">SIN USUARIO</span>
                                        @else
                                            {{ $clash->visitor_participant->participant->sub_name() }}
                                        @endif
                                    </small>
                                    <a href="{{ route('admin.season_competitions_phases_groups_playoffs.clashes.liberate_visitor_participant', $clash->id) }}" class="d-block text-danger">
                                        <small>Liberar participante</small>
                                    </a>
                                @else
                                    <span class="text-uppercase">No definido</span>
                                    <a href="" data-toggle="modal" data-target="#assingVisitorParticipantModal" class="d-block pt-1">
                                        <small>Asignar participante</small>
                                    </a>
                                @endif
                            </td>
                        </tr>
{{--                         @if ($round->round_trip && $clash->return_match)
                            <tr>
                                <td colspan="9">
                                    EQUIPO CLASIFICADO
                                </td>
                            </tr>
                        @endif --}}

                    @endforeach
                @endif
            @endforeach
        </table>

    @endif
</div>
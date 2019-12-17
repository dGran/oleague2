<div class="table-form-content col-12 animated fadeIn p-0 border-0">
    @if ($playoff->rounds->count()==0)
        <div class="text-center py-4">
            <figure>
                <img src="{{ asset('img/table-empty.png') }}" alt="" width="72">
            </figure>
            Actualmente no existen rondas
            <span class="p-2 d-block">
                Puedes generar las rondas desde <a href="{{ route('admin.season_competitions_phases_groups_playoffs', [$playoff->group->phase->competition->slug, $playoff->group->phase->slug, $playoff->group->slug]) }}">configuración</a>
            </span>
        </div>
    @else
        <table class="table calendar">
           <colgroup>
                <col width="50%" />
                <col width="0%" />
                <col width="0%" />
                <col width="50%" />
            </colgroup>
            @foreach ($playoff->rounds as $round)
                @if ($round->clashes->count() == 0)
                    <tr class="days border">
                        <td colspan="6" class="p-2">
                            <strong class="text-uppercase float-left">{{ $round->name }}</strong>
                            @if ($round->participants->count() > 0)
                                <a class="float-right" href="{{ route('admin.season_competitions_phases_groups_playoffs.generate_clashes', $round->id) }}" class="btn btn-primary">
                                    <i class="fas fa-dice"></i>
                                </a>
                                <a class="float-right mr-3" href="{{ route('admin.season_competitions_phases_groups_playoffs.generate_empty_clashes', $round->id) }}" class="btn btn-primary">
                                    <i class="fas fa-magic"></i>
                                </a>
                                <a class="float-right mr-3" href="{{ route('admin.season_competitions_phases_groups_playoffs.restore_clashes', $round->id) }}" class="btn btn-primary">
                                    <i class="fas fa-trash-restore"></i>
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td colspan="9">
                            <div class="text-center">
                                <figure>
                                    <img src="{{ asset('img/table-empty.png') }}" alt="" width="72">
                                </figure>
                                Actualmente no existen emparejamientos
                                @if ($round->participants->count() > 0)
                                    <div class="border-top text-left mt-3 p-3">
                                        <strong>Equipos clasificados para la ronda</strong>
                                        <ul class="mt-2">
                                            @foreach ($round->participants as $participant)
                                                <li>
                                                    <small>
                                                        {{ $participant->participant->participant->name() }}
                                                        <i class="angle-right"></i>
                                                        <i class="fa fa-angle-right mx-1 text-primary"></i>
                                                        <span class="text-muted">{{ $participant->participant->participant->sub_name() }}</span>
                                                    </small>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>
                        </td>
                    </tr>
                @else
                    <tr class="days border">
                        <td colspan="6" class="p-2">
                            <strong class="text-uppercase float-left">{{ $round->name }}</strong>
                            @if ($round->participants->count() > 0)
                                <a class="float-right" href="{{ route('admin.season_competitions_phases_groups_playoffs.generate_clashes', $round->id) }}" class="btn btn-primary">
                                    <i class="fas fa-dice"></i>
                                </a>
                                <a class="float-right mr-3" href="{{ route('admin.season_competitions_phases_groups_playoffs.generate_empty_clashes', $round->id) }}" class="btn btn-primary">
                                    <i class="fas fa-magic"></i>
                                </a>
                                <a class="float-right mr-3" href="{{ route('admin.season_competitions_phases_groups_playoffs.restore_clashes', $round->id) }}" class="btn btn-primary">
                                    <i class="fas fa-eraser"></i>
                                </a>
                            @endif
                        </td>
                    </tr>
                    @foreach ($round->clashes->sortBy('order') as $clash)

                        <tr>
                            <td colspan="9" class="p-2">
                                Eliminatoria {{$clash->order}}
                            </td>
                        </tr>

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
                                    <a href="{{ route('admin.season_competitions_phases_groups_playoffs.clashes.liberate_local_participant', $clash->id) }}" class="btnLiberate d-block text-danger">
                                        <small>Eliminar participante</small>
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
                                    <a href="{{ route('admin.season_competitions_phases_groups_playoffs.clashes.liberate_visitor_participant', $clash->id) }}" class="btnLiberate d-block text-danger">
                                        <small>Eliminar participante</small>
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
                        @if ($clash->matches->count() > 1)
                            <tr>
                                <td colspan="9" class="text-center">
                                    @foreach ($clash->matches as $match)
                                        @if ($match->order == 1)
                                            <div data-id="{{ $match->id }}">
                                                <strong class="d-block">Partido de ida</strong>
                                                <small>
                                                    {{ $match->local_participant->participant->name() }}
                                                    @if (is_null($match->local_score) && is_null($match->visitor_score))
                                                        <a href="" data-toggle="modal" data-target="#updateModal" class="mx-2">
                                                            <small class="bg-primary rounded px-3 py-1 text-white">
                                                                EDITAR
                                                            </small>
                                                        </a>
                                                    @else
                                                        <span class="px-1">{{ $match->local_score }} - {{ $match->visitor_score }}</span>
                                                    @endif
                                                    {{ $match->visitor_participant->participant->name() }}
                                                </small>
                                            </div>
                                        @elseif ($match->order == 2)
                                            <div class="pt-2" data-id="{{ $match->id }}">
                                                <strong class="d-block">Partido de vuelta</strong>
                                                <small>
                                                    {{ $match->local_participant->participant->name() }}
                                                    @if (is_null($match->local_score) && is_null($match->visitor_score))
                                                        <a href="" data-toggle="modal" data-target="#updateModal" class="mx-2">
                                                            <small class="bg-primary rounded px-3 py-1 text-white">
                                                                EDITAR
                                                            </small>
                                                        </a>
                                                    @else
                                                        <span class="bg-light rounded px-3 py-1 {{ $match->sanctioned_id ? 'border text-danger' : '' }}">
                                                            {{ $match->local_score }} - {{ $match->visitor_score }}
                                                        </span>
                                                    @endif
                                                    {{ $match->visitor_participant->participant->name() }}
                                                </small>
                                            </div>
                                        @endif
                                    @endforeach
                                </td>
                            </tr>
                        @elseif ($clash->matches->count()>0)
                            <tr>
                                <td colspan="9" class="text-center">
                                    <div data-id="{{ $clash->matches->first()->id }}">
                                        <small>
                                            {{ $clash->matches->first()->local_participant->participant->name() }}
                                            @if (is_null($clash->matches->first()->local_score) && is_null($clash->matches->first()->visitor_score))
                                                <a href="" data-toggle="modal" data-target="#updateModal" class="mx-2">
                                                    <small class="bg-primary rounded px-3 py-1 text-white">
                                                        EDITAR
                                                    </small>
                                                </a>
                                            @else
                                                <span class="px-1">{{ $clash->matches->first()->local_score }} - {{ $clash->matches->first()->visitor_score }}</span>
                                            @endif
                                            {{ $clash->matches->first()->visitor_participant->participant->name() }}
                                        </small>
                                    </div>
                                </td>
                            </tr>
                        @endif

                        <tr>
                            <td colspan="9" class="text-center">
                                @if (!$clash->winner() == 0)
                                    <span class="text-success">Clasificado: {{ $clash->winner()->name() }}</span>
                                @else
                                    <span class="text-warning">Eliminatoria no finalizada</span>
                                @endif
                            </td>
                        </tr>

                    @endforeach
                @endif
            @endforeach
        </table>

        no permitir actualizar el resultado de vuelta sin haber actualizado el de ida

    @endif
</div>
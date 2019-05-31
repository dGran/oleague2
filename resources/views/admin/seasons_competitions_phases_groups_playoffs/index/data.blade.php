<h4>Play Offs</h4>
<p>
    Hay que crear una tabla de rounds_participants para sacar los participantes de cada ronda de esa tabla y almacenar los que se vayan clasificando en siguientes rondas ahi tambien
</p>

<div class="table-form-content col-12 animated fadeIn p-0 border-0">
    @if ($playoff->rounds->count() == 0)
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
                            <a class="float-right" href="{{ route('admin.season_competitions_phases_groups_playoffs.generate_clashes', [$playoff->group->phase->competition->slug, $playoff->group->phase->slug, $playoff->group->slug, $round->id]) }}" class="btn btn-primary">Sortear emparejamientos</a>
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
                            <a class="float-right" href="{{ route('admin.season_competitions_phases_groups_playoffs.generate_clashes', [$playoff->group->phase->competition->slug, $playoff->group->phase->slug, $playoff->group->slug, $round->id]) }}" class="btn btn-primary">Sortear emparejamientos</a>
                        </td>
                    </tr>
                    @foreach ($round->clashes->sortByDesc('order') as $clash)

                        <tr class="clashes" data-id="{{ $clash->id }}" data-name="{{ $clash->local_participant->participant->name() . ' ' . $clash->local_score . '-' . $clash->visitor_score . ' ' . $clash->visitor_participant->participant->name() }}">
                            <td class="text-right">
                                <span class="text-uppercase {{ $clash->sanctioned_id && $clash->local_id == $clash->sanctioned_id ? 'text-danger' : '' }}">{{ $clash->local_participant->participant->name() == 'undefined' ? '' : $clash->local_participant->participant->name() }}</span>
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
                            </td>
                            <td class="img text-right" width="32">
                                <img src="{{ $clash->local_participant->participant->logo() }}" alt="">
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
                                <img src="{{ $clash->visitor_participant->participant->logo() }}" alt="">
                            </td>
                            <td class="text-left">
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
                            </td>
                        </tr>
                        @if ($round->round_trip && $clash->second_match)
                            <tr>
                                <td colspan="9">
                                    EQUIPO CLASIFICADO
                                </td>
                            </tr>
                        @endif

                    @endforeach
                @endif
            @endforeach
        </table>

    @endif
</div>
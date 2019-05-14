<div class="modal-content">
    <div class="modal-header bg-light">
    	Jornada {{ $match->day->order }} <span class="text-muted pt-0 ml-2">Partido #{{ $match->id }}</span>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

    <div class="modal-body">
        <form
            id="frmAdd"
            lang="{{ app()->getLocale() }}"
            role="form"
            method="POST"
            action="{{ route('admin.season_competitions_phases_groups_leagues.update_match', [$group->phase->competition->slug, $group->phase->slug, $group->slug, $match->id]) }}"
            enctype="multipart/form-data"
            data-toggle="validator"
            autocomplete="off">
            {{ method_field('PUT') }}
            {{ csrf_field() }}

            <input type="hidden" name="sanctioned_id" id="sanctioned_id">

            <div class="main-content">
                <table align="center">
                    <tr class="matches">
                        <td class="text-right">
                            <h5 class="text-uppercase m-0">
                                {{ $match->local_participant->participant->name() }}
                            </h5>
                            <small class="text-black-50 d-block">
                                @if ($match->local_participant->participant->sub_name() == 'undefined')
                                    <span class="badge badge-danger p-1 mt-1">SIN USUARIO</span>
                                @else
                                    {{ $match->local_participant->participant->sub_name() }}
                                @endif
                            </small>
                        </td>
                        <td class="img text-center">
                            <img src="{{ $match->local_participant->participant->logo() }}" alt="" width="48">
                        </td>
                        <td class="img text-center">
                            <img src="{{ $match->visitor_participant->participant->logo() }}" alt="" width="48">
                        </td>
                        <td class="text-left">
                            <h5 class="text-uppercase m-0">
                                {{ $match->visitor_participant->participant->name()}}
                            </h5>
                            <small class="text-black-50 d-block">
                                @if ($match->visitor_participant->participant->sub_name() == 'undefined')
                                    <span class="badge badge-danger p-1 mt-1">SIN USUARIO</span>
                                @else
                                    {{ $match->visitor_participant->participant->sub_name() }}
                                @endif
                            </small>
                        </td>
                    </tr>

                    <tr class="matches">
                        <td colspan="2" >
                            <input type="number" class="form-control float-right" name="local_score" id="local_score" value="0" min="0" step="1" style="width: 4em">
                        </td>
                        <td colspan="2" class="text-left">
                            <input type="number" class="form-control" name="visitor_score" id="visitor_score" value="0" min="0" step="1" style="width: 4em">
                        </td>
                    </tr>

                </table>

                <div id="accordion">
                    <div class="card">
                        <div class="card-header">
                            <a class="card-title accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#sanctions">Sancionar partido</a>
                        </div>

                        <div class="card-collapse collapse in" id="sanctions">
                            <div class="card-body">
                                <div class="d-block">
                                    <div class="pretty p-pulse p-default p-round p-fill text-right">
                                        <input type="checkbox" id="chk_local_sanctioned" onchange="sanction_local({{ $match->local_id }})"/>
                                        <div class="state p-danger">
                                            <label id="lb_local_sanctioned">
                                                <small>
                                                    <i class="icon-tribunal"></i>
                                                    Sancionar a {{ $match->local_participant->participant->name()}}
                                                </small>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-block mt-1">
                                    <div class="pretty p-default p-round p-fill">
                                        <input type="checkbox" id="chk_visitor_sanctioned" onchange="sanction_visitor({{ $match->visitor_id }})"/>
                                        <div class="state p-danger">
                                            <label id="lb_visitor_sanctioned" class="m-0">
                                                <small>
                                                    <i class="icon-tribunal"></i>
                                                    Sancionar a {{ $match->visitor_participant->participant->name()}}
                                                </small>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <a class="card-title accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#stats">Estadísticas</a>
                        </div>

                        <div class="card-collapse collapse" id="stats" >
                            <div class="card-body">
                                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                {{-- <ul class="nav nav-tabs" id="myTab" role="tablist"> --}}
                                    <li class="nav-item">
                                        <a class="nav-link active" id="local-tab" data-toggle="tab" href="#local" role="tab" aria-controls="local" aria-selected="true">{{ $match->local_participant->participant->name() }}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="visitor-tab" data-toggle="tab" href="#visitor" role="tab" aria-controls="visitor" aria-selected="false">{{ $match->visitor_participant->participant->name() }}</a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="local" role="tabpanel" aria-labelledby="local-tab">
                                        <table class="table">
                                            <tr>
                                                <td></td>
                                                <td class="text-center">
                                                    <small class="d-block">Goles</small>
                                                    <i class="fas fa-futbol"></i>
                                                </td>
                                                <td class="text-center">
                                                    <small class="d-block">Asis.</small>
                                                    <i class="icon-soccer_assist"></i>
                                                </td>
                                                <td class="text-center">
                                                    <small class="d-block">Amarilla</small>
                                                    <i class="icon-soccer_card text-warning"></i>
                                                </td>
                                                <td class="text-center">
                                                    <small class="d-block">Roja</small>
                                                    <i class="icon-soccer_card text-danger"></i>
                                                </td>
                                            </tr>
                                            @foreach ($match->local_participant->participant->players as $player)
                                                <tr>
                                                    <td width="100%">
                                                        <img src="{{ $player->player->getImgFormatted() }}" alt="" width="24">
                                                        <small>{{ $player->player->name }}</small>
                                                    </td>
                                                    <td>
                                                        <input type="number" class="form-control" style="font-size: 80%; width: 3em; padding: 0.25em 0.5em">
                                                    </td>
                                                    <td>
                                                        <input type="number" class="form-control" style="font-size: 80%; width: 3em; padding: 0.25em 0.5em">
                                                    </td>
                                                    <td>
                                                        <input type="number" class="form-control" style="font-size: 80%; width: 3em; padding: 0.25em 0.5em">
                                                    </td>
                                                    <td>
                                                        <input type="number" class="form-control" style="font-size: 80%; width: 3em; padding: 0.25em 0.5em">
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </table>
                                    </div>
                                    <div class="tab-pane fade" id="visitor" role="tabpanel" aria-labelledby="visitor-tab">
                                        <table>
                                            <tr>
                                                <td></td>
                                                <td>
                                                    <small>Cantidad</small>
                                                </td>
                                            </tr>
                                            @foreach ($match->visitor_participant->participant->players as $player)
                                                <tr>
                                                    <td>
                                                        <img src="{{ $player->player->getImgFormatted() }}" alt="" width="24">
                                                        <small>{{ $player->player->name }}</small>
                                                    </td>
                                                    <td>
                                                        <input type="number" class="form-control" style="font-size: 80%; width: 3.5em; padding: 0.25em 0.5em">
                                                    </td>
                                                    <td>
                                                        <input type="number" class="form-control" style="font-size: 80%; width: 3.5em; padding: 0.25em 0.5em">
                                                    </td>
                                                    <td>
                                                        <input type="number" class="form-control" style="font-size: 80%; width: 3.5em; padding: 0.25em 0.5em">
                                                    </td>
                                                    <td>
                                                        <input type="number" class="form-control" style="font-size: 80%; width: 3.5em; padding: 0.25em 0.5em">
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </table>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>

                </div>



            </div> {{-- main-content --}}

            <div class="border-top mt-2 py-3">
                <input type="submit" class="btn btn-primary" value="Enviar resultado">
            </div>
        </form>
    </div>
</div>
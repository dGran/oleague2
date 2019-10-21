<div class="modal-content">
    <div class="modal-header bg-primary text-white">
    	Jornada {{ $match->day->order }}
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

    <div class="modal-body p-0">
        <form
            id="frmAdd"
            lang="{{ app()->getLocale() }}"
            role="form"
            method="POST"
            action="{{ route('competitions.competition.calendar.match.update', [active_season()->slug, $competition->slug, $match->id]) }}"
            enctype="multipart/form-data"
            data-toggle="validator"
            autocomplete="off">
            {{ method_field('PUT') }}
            {{ csrf_field() }}

                <table class="my-3" align="center">
                    <tr class="matches">
                        <td class="text-right pr-2" width="50%">
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
                        <td class="img text-center pr-2">
                            <img src="{{ $match->local_participant->participant->logo() }}" alt="" width="32">
                        </td>
                        <td class="img text-center pl-2">
                            <img src="{{ $match->visitor_participant->participant->logo() }}" alt="" width="32">
                        </td>
                        <td class="text-left pl-2" width="50%">
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
                        <td colspan="2" class="pr-2 pt-2">
                            <input type="number" class="form-control float-right" name="local_score" id="local_score" value="0" min="0" step="1" style="width: 4em">
                        </td>
                        <td colspan="2" class="text-left pl-2 pt-2">
                            <input type="number" class="form-control" name="visitor_score" id="visitor_score" value="0" min="0" step="1" style="width: 4em">
                        </td>
                    </tr>

                </table>

            	@if ($match->day->league->group->phase->competition->season->use_rosters)
                	<div id="accordion" class="p-3">
                    	<div class="card mb-1 mt-3">
                        	<div class="card-header p-0 m-0 border-bottom-0">
                                <a class="card-title accordion-toggle d-block m-0 px-3 py-2 {{ !$match->day->league->has_stats() ? 'disabled' : '' }}" data-toggle="collapse" data-parent="#accordion" href="#stats">Estadísticas</a>
                            </div>

                            <div class="card-collapse collapse border-top" id="stats">
                                <div class="card-body" style="padding: 0">
                                    <ul class="nav nav-pills p-3" id="pills-tab" role="tablist" style="font-size: .9em">
                                        <li class="nav-item">
                                            <a class="nav-link active {{ $match->local_participant->participant->players->count()==0 ? "disabled" : "" }}" id="local-tab" data-toggle="tab" href="#local" role="tab" aria-controls="local" aria-selected="true">{{ $match->local_participant->participant->name() }}</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link {{ $match->visitor_participant->participant->players->count()==0 ? "disabled" : "" }}" id="visitor-tab" data-toggle="tab" href="#visitor" role="tab" aria-controls="visitor" aria-selected="false">{{ $match->visitor_participant->participant->name() }}</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link {{ $match->day->league->stats_mvp ? "" : "disabled" }}" id="mvp-tab" data-toggle="tab" href="#mvp" role="tab" aria-controls="mvp" aria-selected="false">MVP</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="myTabContent">

                                        <div class="tab-pane fade show active" id="local" role="tabpanel" aria-labelledby="local-tab">
                                            <table class="table">
                                                @if ($match->local_participant->participant->players->count() > 0)
                                                    <tr class="">
                                                        <td></td>
                                                        <td class="text-center">
                                                            {{-- <small class="d-block">Goles</small> --}}
                                                            <i class="fas fa-futbol"></i>
                                                        </td>
                                                        <td class="text-center">
                                                            {{-- <small class="d-block">Asis.</small> --}}
                                                            <i class="icon-soccer-assist"></i>
                                                        </td>
                                                        <td class="text-center">
                                                            {{-- <small class="d-block">Amarilla</small> --}}
                                                            <i class="icon-soccer-card text-warning"></i>
                                                        </td>
                                                        <td class="text-center">
                                                            {{-- <small class="d-block">Roja</small> --}}
                                                            <i class="icon-soccer-card text-danger"></i>
                                                        </td>
                                                    </tr>
                                                    @foreach ($match->local_participant->participant->players as $player)
                                                        <tr>
                                                            <td width="100%">
                                                                <img src="{{ $player->player->getImgFormatted() }}" alt="" width="24">
                                                                <small>{{ $player->player->name }}</small>
                                                            </td>
                                                            <td>
                                                                <input type="number" name="stats_goals_{{$player->id}}" class="form-control" style="font-size: 80%; width: 3em; padding: 0.25em 0.5em" {{ !$match->day->league->stats_goals ? 'disabled' : '' }}>
                                                            </td>
                                                            <td>
                                                                <input type="number" name="stats_assists_{{$player->id}}" class="form-control" style="font-size: 80%; width: 3em; padding: 0.25em 0.5em" {{ !$match->day->league->stats_assists ? 'disabled' : '' }}>
                                                            </td>
                                                            <td>
                                                                <input type="number" name="stats_yellow_cards_{{$player->id}}" class="form-control" style="font-size: 80%; width: 3em; padding: 0.25em 0.5em" {{ !$match->day->league->stats_yellow_cards ? 'disabled' : '' }}>
                                                            </td>
                                                            <td>
                                                                <input type="number" name="stats_red_cards_{{$player->id}}" class="form-control" style="font-size: 80%; width: 3em; padding: 0.25em 0.5em" {{ !$match->day->league->stats_red_cards ? 'disabled' : '' }}>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @else
                                                    <tr>
                                                        <td colspan="9" class="p-3 text-center">
                                                            {{ $match->local_participant->participant->name() }}
                                                            <br>
                                                            Plantilla vacía
                                                        </td>
                                                    </tr>
                                                @endif
                                            </table>
                                        </div> {{-- tab-pane --}}

                                        <div class="tab-pane fade show" id="visitor" role="tabpanel" aria-labelledby="visitor-tab">
                                            <table class="table">
                                                <tr>
                                                    <td></td>
                                                    <td class="text-center">
                                                        <small class="d-block">Goles</small>
                                                        <i class="fas fa-futbol"></i>
                                                    </td>
                                                    <td class="text-center">
                                                        <small class="d-block">Asis.</small>
                                                        <i class="icon-soccer-assist"></i>
                                                    </td>
                                                    <td class="text-center">
                                                        <small class="d-block">Amarilla</small>
                                                        <i class="icon-soccer-card text-warning"></i>
                                                    </td>
                                                    <td class="text-center">
                                                        <small class="d-block">Roja</small>
                                                        <i class="icon-soccer-card text-danger"></i>
                                                    </td>
                                                </tr>
                                                @foreach ($match->visitor_participant->participant->players as $player)
                                                    <tr>
                                                        <td width="100%">
                                                            <img src="{{ $player->player->getImgFormatted() }}" alt="" width="24">
                                                            <small>{{ $player->player->name }}</small>
                                                        </td>
                                                        <td>
                                                            <input type="number" name="stats_goals_{{$player->id}}" class="form-control" style="font-size: 80%; width: 3em; padding: 0.25em 0.5em" {{ !$match->day->league->stats_goals ? 'disabled' : '' }}>
                                                        </td>
                                                        <td>
                                                            <input type="number" name="stats_assists_{{$player->id}}" class="form-control" style="font-size: 80%; width: 3em; padding: 0.25em 0.5em" {{ !$match->day->league->stats_assists ? 'disabled' : '' }}>
                                                        </td>
                                                        <td>
                                                            <input type="number" name="stats_yellow_cards_{{$player->id}}" class="form-control" style="font-size: 80%; width: 3em; padding: 0.25em 0.5em" {{ !$match->day->league->stats_yellow_cards ? 'disabled' : '' }}>
                                                        </td>
                                                        <td>
                                                            <input type="number" name="stats_red_cards_{{$player->id}}" class="form-control" style="font-size: 80%; width: 3em; padding: 0.25em 0.5em" {{ !$match->day->league->stats_red_cards ? 'disabled' : '' }}>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </table>
                                        </div> {{-- tab-pane --}}

                                        <div class="tab-pane fade" id="mvp" role="tabpanel" aria-labelledby="mvp-tab">
                                            <select class="form-control" name="stats_mvp" id="stats_mvp" data-live-search="true" data-width="auto">
                                                <option value="0">Ninguno</option>
                                                <optgroup label="{{ $match->local_participant->participant->name() }}">
                                                @foreach ($match->local_participant->participant->players as $player)
                                                    <option value="{{ $player->id }}">{{ $player->player->name }}</option>
                                                @endforeach
                                                </optgroup>
                                                <optgroup label="{{ $match->visitor_participant->participant->name() }}">
                                                @foreach ($match->visitor_participant->participant->players as $player)
                                                    <option value="{{ $player->id }}">{{ $player->player->name }}</option>
                                                @endforeach
                                                </optgroup>
                                            </select>
                                        </div>  {{-- tab-pane --}}

                                    </div> {{-- tab-content --}}

                                </div> {{-- card-body --}}
                            </div> {{-- stats --}}
                    	</div> {{-- card --}}
                	</div> {{-- accordion --}}
            	@endif


            <div class="border-top p-3 bg-light">
                <input type="submit" class="btn btn-primary" value="Enviar resultado">
            </div>

        </form>
    </div> {{-- modal-body --}}
</div> {{-- modal-content --}}
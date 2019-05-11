<div class="modal-content">
    <div class="modal-header bg-light">
    	Partido #{{ $match->id }}
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


            <h5 class="border-bottom">Jornada {{ $match->day->order }}</h5>

            <div class="main-content">
                <table align="center" class="calendar">
                    <tr class="matches">
                        <td class="text-right">
                            <span class="name text-uppercase">
                                {{ $match->local_participant->participant->name() }}
                            </span>
                            <small class="text-black-50 d-block">
                                @if ($match->local_participant->participant->sub_name() == 'undefined')
                                    <span class="badge badge-danger p-1 mt-1">SIN USUARIO</span>
                                @else
                                    {{ $match->local_participant->participant->sub_name() }}
                                @endif
                            </small>
                        </td>
                        <td class="img text-center">
                            <img src="{{ $match->local_participant->participant->logo() }}" alt="">
                        </td>
                        <td class="img text-center">
                            <img src="{{ $match->visitor_participant->participant->logo() }}" alt="">
                        </td>
                        <td class="text-left">
                            <span class="name text-uppercase">
                                {{ $match->visitor_participant->participant->name()}}
                            </span>
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
                        <td>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="chk_local_sanctioned" onchange="sanction_local({{ $match->local_id }})">
                                <label class="custom-control-label pt-1" for="chk_local_sanctioned" id="lb_local_sanctioned">
                                    Sancionar a {{ $match->local_participant->participant->name() }}
                                </label>
                            </div>
                        </td>
                        <td>
                            <input type="number" class="form-control float-right" name="local_score" id="local_score" value="0" min="0" step="1" style="width: 4em">
                        </td>
                        <td class="text-left">
                            <input type="number" class="form-control" name="visitor_score" id="visitor_score" value="0" min="0" step="1" style="width: 4em">
                        </td>
                        <td class="text-left">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="chk_visitor_sanctioned" onchange="sanction_visitor({{ $match->visitor_id }})">
                                <label class="custom-control-label pt-1" for="chk_visitor_sanctioned" id="lb_visitor_sanctioned">
                                    Sancionar a {{ $match->visitor_participant->participant->name() }}
                                </label>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>

            <div class="border-top mt-2 py-3">
                <input type="submit" class="btn btn-primary" value="Enviar resultado">
            </div>
        </form>
    </div>
</div>
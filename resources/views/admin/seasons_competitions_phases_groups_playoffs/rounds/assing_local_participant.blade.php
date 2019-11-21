<div class="modal-content">
    <div class="modal-header bg-light">
    	Asignar participante local
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

    <div class="modal-body">
        <form
            id="frmDayLimit"
            lang="{{ app()->getLocale() }}"
            role="form"
            method="POST"
            action="{{ route('admin.season_competitions_phases_groups_playoffs.clashes.assing_local_participant.update', $clash->id) }}"
            enctype="multipart/form-data"
            data-toggle="validator"
            autocomplete="off">
            {{ method_field('PUT') }}
            {{ csrf_field() }}

            <div class="main-content">
                <div class="form-group">
                    <div class="col-12">
                        <label for="clash_participant">Participantes</label>
                        <select class=" form-control" name="clash_participant" id="clash_participant">
                            <option selected value="">Sin participante</option>
                            @foreach ($round_participants as $rpart)
                                <option value="{{ $rpart->participant_id }}">
                                    {{ $rpart->participant->participant->name() }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div> {{-- main-content --}}

            <div class="border-top mt-2 py-3">
                <input type="submit" class="btn btn-primary" value="Actualizar participante">
            </div>
        </form>
    </div> {{-- modal-body --}}
</div> {{-- modal-content --}}
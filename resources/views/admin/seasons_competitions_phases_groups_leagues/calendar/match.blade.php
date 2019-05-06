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


            <div>Jornada {{ $match->day->order }}</div>
            <div>{{ $match->local_participant->participant->name() }} vs {{ $match->visitor_participant->participant->name() }}</div>

            <label for="local_score">{{ $match->local_participant->participant->name() }}</label>
            <input type="number" name="local_score" value="0">

            <label for="visitor_score">{{ $match->visitor_participant->participant->name() }}</label>
            <input type="number" name="visitor_score" value="0">

            <input type="submit" value="Enviar">
        </form>
    </div>
</div>
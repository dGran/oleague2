<div class="modal-content">
    <div class="modal-header bg-light">
    	Jornada {{ $day->order }}
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
            action="{{ route('admin.season_competitions_phases_groups_leagues.calendar.day.update_limit', $day->id) }}"
            enctype="multipart/form-data"
            data-toggle="validator"
            autocomplete="off">
            {{ method_field('PUT') }}
            {{ csrf_field() }}

            <div class="main-content">
                <div class="form-group">
                    <label for="date_limit">Fecha límite de jornada</label>
                    <input type="datetime" class="form-control" name="date_limit" id="date_limit" value="{{ $day->date_limit }}">
                </div>
            </div> {{-- main-content --}}

            <div class="border-top mt-2 py-3">
                <input type="submit" class="btn btn-primary" value="Actualizar fecha límite">
            </div>
        </form>
    </div> {{-- modal-body --}}
</div> {{-- modal-content --}}
<form
    id="frmAdd"
    lang="{{ app()->getLocale() }}"
    role="form"
    method="POST"
    action="{{ route('admin.season_competitions_phases_groups_participants.save', [$group->phase->competition->slug, $group->phase->slug, $group->slug]) }}"
    enctype="multipart/form-data"
    data-toggle="validator"
    autocomplete="off">
    {{ csrf_field() }}

    <div class="table-form-content col-12 col-lg-8 col-xl-6 p-md-3 animated fadeIn">
        <div class="form-group row pt-2">
            <label for="user_id" class="col-sm-3 col-form-label">Usuario</label>
            <div class="col-sm-9">
                <select class="selectpicker form-control" name="participant_id" id="participant_id" data-live-search="true">
                    @foreach ($participants as $participant)
                        <option value="{{ $participant->id }}">{{ $participant->name() }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <div class="table-form-footer col-12 col-lg-8 col-xl-6 pt-3 px-3 px-md-0">
        <input type="submit" class="btn btn-primary border border-primary" value="Guardar" id="btnSave">
        <div class="no-close custom-control custom-checkbox mt-2">
            <input type="checkbox" class="custom-control-input" id="no_close" name="no_close">
            <label class="custom-control-label is-valid" for="no_close">Insertar nuevo registro</label>
        </div>
    </div>

</form>
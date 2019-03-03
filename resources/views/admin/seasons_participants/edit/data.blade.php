<form
    id="frmEdit"
    lang="{{ app()->getLocale() }}"
    role="form"
    method="POST"
    action="{{ route('admin.season_participants.update', $participant->id) }}"
    enctype="multipart/form-data"
    data-toggle="validator"
    autocomplete="off">
    {{ method_field('PUT') }}
    {{ csrf_field() }}

    <div class="table-form-content col-12 col-lg-8 col-xl-6 p-md-3 animated fadeIn">
        <div class="form-group row pt-2">
            <label for="user_id" class="col-sm-3 col-form-label">Usuario</label>
            <div class="col-sm-9">
                <select class="selectpicker form-control" name="user_id" id="user_id" data-size="3" data-live-search="true">
                    @if ($participant->user_id)
                        <option value="0">Ninguno</option>
                        <option selected value="{{ $participant->user_id }}">{{ $participant->user->name }}</option>
                    @else
                        <option selected value="0">Ninguno</option>
                    @endif
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label for="team_id" class="col-sm-3 col-form-label">Equipo</label>
            <div class="col-sm-9">
                <select class="selectpicker form-control" name="team_id" id="team_id" data-size="3" data-live-search="true">
                    @if ($participant->team_id)
                        <option value="0">Ninguno</option>
                        <option selected value="{{ $participant->team_id }}">{{ $participant->team->name }}</option>
                    @else
                        <option selected value="0">Ninguno</option>
                    @endif
                    @foreach ($teams as $team)
                        <option value="{{ $team->id }}">{{ $team->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

    </div>

    <div class="table-form-footer col-12 col-lg-8 col-xl-6 pt-3 px-3 px-md-0">
        <input type="submit" class="btn btn-primary border border-primary" value="Guardar" id="btnSave">
    </div>

</form>
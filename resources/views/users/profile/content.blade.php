<div class="row justify-content-center">
<div class="col-12 col-md-8 col-lg-6 p-0">
<div class="p-3 border my-0 my-md-4 shadow-sm">
    <form
          lang="{{ app()->getLocale() }}"
          role="form"
          method="POST"
          action="{{ route('profileUpdate', $profile->user->id) }}"
          enctype="multipart/form-data"
          autocomplete="off">
        {{ method_field('PUT') }}
        {{ csrf_field() }}

        <div class="form-group row">
            <label for="gamertag" class="col-sm-2 col-form-label">
                Gamertag
            </label>
            <div class="col-sm-10">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="addon-gamertag">
                            <i class="fab fa-xbox"></i>
                        </span>
                    </div>
                    <input type="text" class="form-control" id="gamertag" name="gamertag" placeholder="Nombre de usuario online" aria-describedby="addon-gamertag" value="{{ $profile->gamertag }}">
                </div> {{-- input-group --}}
            </div> {{-- col --}}
        </div> {{-- form-group --}}

        <div class="form-group row">
            <label for="slack_id" class="col-sm-2 col-form-label">
                Slack
            </label>
            <div class="col-sm-10">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="addon-slack">
                            <i class="fab fa-slack-hash"></i>
                        </span>
                    </div>
                    <input type="text" class="form-control" id="slack_id" name="slack_id" placeholder="Nombre de usuario en slack" aria-describedby="addon-slack" value="{{ $profile->slack_id }}">
                </div> {{-- input-group --}}
            </div> {{-- col --}}
        </div> {{-- form-group --}}


        {{-- <i class="fab fa-telegram-plane"></i> --}}

        <div class="form-group">
            <label for="country">Pais</label>
            <input type="text" class="form-control" id="country_id" name="country_id" placeholder="País de nacimiento"  value="{{ $profile->country_id }}">
        </div>
        <div class="form-group">
            <label for="location">Localidad</label>
            <input type="text" class="form-control" id="location" name="location" placeholder="Localidad donde resides"  value="{{ $profile->location }}">
        </div>
        <div class="form-group">
            <label for="avatar">Avatar</label>
            <input type="text" class="form-control" id="avatar" name="avatar" aria-describedby="avatarHelp" placeholder="Avatar"  value="{{ $profile->avatar }}">
            <small id="avatarHelp" class="form-text text-muted">Introduce una url válida para tu avatar.</small>
        </div>
        <div class="form-group">
            <label for="signature">Firma</label>
            <input type="text" class="form-control" id="signature" name="signature" aria-describedby="signatureHelp" placeholder="Firma"  value="{{ $profile->signature }}">
            <small id="signatureHelp" class="form-text text-muted">Introduce una url válida para tu firma en el foro.</small>
        </div>
        <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" id="slack_notifications" name="slack_notifications" {{ $profile->slack_notifications ? 'checked="checked" ' : '' }}>
            <label class="form-check-label" for="slack-notifications">Recibir notificaciones por slack</label>
        </div>
        <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" id="email_notifications" name="email_notifications" {{ $profile->email_notifications ? 'checked="checked" ' : '' }}>
            <label class="form-check-label" for="email-notifications">Recibir notificaciones por email</label>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>

    </form>
</div>
</div>
</div>
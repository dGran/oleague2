<div class="row justify-content-center">
    <div class="col-12 col-md-8 col-lg-6 p-0">
        <div class="p-3 border my-0 my-md-4 shadow-sm bg-white">
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
                    <label for="user_name" class="col-sm-3 col-form-label">
                        Nombre
                    </label>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="addon-user-name">
                                    <i class="fas fa-user"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control" id="user_name" name="user_name" placeholder="Nombre de usuario" aria-describedby="addon-user-name" value="{{ $profile->user->name }}">
                        </div> {{-- input-group --}}
                    </div> {{-- col --}}
                </div> {{-- form-group --}}

                <div class="form-group row">
                    <label for="avatar" class="col-sm-3 col-form-label">
                        Avatar
                    </label>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="addon-slack">
                                    <i class="fas fa-smile"></i>
                                </span>
                            </div>
                            <select name="avatar" id="avatar" class="form-control selectpicker show-tick" data-size="5">
                                @foreach ($avatars as $avatar)
                                    <option {{ $avatar == $profile->avatar ? 'selected' : '' }} title="<img class='mr-2' src='{{ asset($avatar) }}' width='24'>" data-content="<img class='mr-2' src='{{ asset($avatar) }}' width='32'>" value="{{ $avatar }}">
                                        {{ $avatar }}
                                    </option>
                                @endforeach
                            </select>
                        </div> {{-- input-group --}}
                        <small class="text-warning d-block mt-1">
                            Avatares personalizados proximamente
                        </small>
                    </div> {{-- col --}}
                </div> {{-- form-group --}}

                <div class="form-group row">
                    <label for="gamertag" class="col-sm-3 col-form-label">
                        Gamertag
                    </label>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="addon-gamertag">
                                    <i class="fab fa-xbox"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control" id="gamertag" name="gamertag" placeholder="Nombre de usuario xbox live" aria-describedby="addon-gamertag" value="{{ $profile->gamertag }}">
                        </div> {{-- input-group --}}
                    </div> {{-- col --}}
                </div> {{-- form-group --}}

                <div class="form-group row">
                    <label for="nation_id" class="col-sm-3 col-form-label">
                        Nacionalidad
                    </label>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="addon-slack">
                                    <i class="fas fa-globe"></i>
                                </span>
                            </div>
                            <select name="nation_id" id="nation_id" class="form-control selectpicker show-tick" data-size="5" data-live-search="true">
                                <option value="">No definida</option>
                                @foreach ($nations as $nation)
                                        <option {{ $nation->id == $profile->nation_id ? 'selected' : '' }} value="{{ $nation->id }}">{{ $nation->name }}</option>
                                @endforeach
                            </select>
                        </div> {{-- input-group --}}
                    </div> {{-- col --}}
                </div> {{-- form-group --}}

                <div class="form-group row">
                    <label for="location" class="col-sm-3 col-form-label">
                        Localidad
                    </label>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="addon-slack">
                                    <i class="fas fa-map-marker-alt"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control" id="location" name="location" placeholder="Localidad donde resides" aria-describedby="addon-slack" value="{{ $profile->location }}">
                        </div> {{-- input-group --}}
                    </div> {{-- col --}}
                </div> {{-- form-group --}}

                <div class="form-group row">
                    <label for="birthdate" class="col-sm-3 col-form-label">
                        Cumpleaños
                    </label>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="addon-slack">
                                    <i class="fas fa-birthday-cake"></i>
                                </span>
                            </div>
                            <input type="date" class="form-control" id="birthdate" name="birthdate" placeholder="Localidad donde resides" aria-describedby="addon-slack" value="{{ $profile->birthdate }}">
                        </div> {{-- input-group --}}
                    </div> {{-- col --}}
                </div> {{-- form-group --}}

                <div class="pretty p-switch p-fill mt-3">
                    <input type="checkbox" id="email_notifications" name="email_notifications" {{ $profile->email_notifications ? 'checked="checked" ' : '' }}/>
                    <div class="state p-primary">
                        <label for="email_notifications">Recibir notificaciones por email</label>
                    </div>
                    <small class="text-info d-block mt-2">
                        <i class="fas fa-info mr-1"></i>Marca la casilla para recibir por email las notificaciones
                    </small>
                </div>

                <div class="text-right border-top pt-3 mt-3">
                    <button type="submit" class="btn btn-primary">Actualizar perfil</button>
                </div>
            </form>
        </div>
    </div>
</div>
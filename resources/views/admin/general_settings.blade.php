@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            @include('admin.partials.menu')
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">General Settings</div>

                <div class="card-body">
                        <div class="form-group">
                            <label for="gamertag">Telegram - Canal ID</label>
                            <input type="text" class="form-control" id="gamertag" name="gamertag" placeholder="Nombre de usuario online" value="">
                        </div>
                        <div class="form-group">
                            <label for="slack_id">Telegram - Token</label>
                            <input type="text" class="form-control" id="slack_id" name="slack_id" placeholder="Nombre de usuario en slack"  value="">
                        </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
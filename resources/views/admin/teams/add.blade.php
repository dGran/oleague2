@extends('layouts.admin2')

@section('content')
{{-- <div class="container"> --}}
    <div class="row no-gutters">

        <div class="col-12 p-0 p-md-4">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin') }}">Admin</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.teams') }}">Equipos</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Nuevo</li>
                </ol>
            </nav>
        </div>


        <div class="col-12 col-xl-6 p-0 p-md-4">

        @if (session('error'))
            <div class="alert alert-danger autohide">
                {{ session('error') }}
            </div>
        @endif

        @if (session('status'))
            <div class="alert alert-info autohide">
                {{ session('status') }}
            </div>
        @endif

            <div class="card">
                <div class="card-header">
                    Nuevo equipo
                </div>

                <form
                      lang="{{ app()->getLocale() }}"
                      role="form"
                      method="POST"
                      action="{{ route('admin.teams.save') }}"
                      enctype="multipart/form-data"
                      data-toggle="validator"
                      autocomplete="off">
                    {{ csrf_field() }}
                <div class="card-body p-3">

                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label text-right ">
                                Nombre
                            </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="name" name="name" placeholder="Nombre" aria-describedby="addon-name">
                            </div> {{-- col --}}
                        </div> {{-- form-group --}}

                        <div class="form-group row">
                            <label for="logo" class="col-sm-2 col-form-label text-right">
                                Escudo
                            </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="logo" name="logo" placeholder="Http://..." aria-describedby="addon-logo">
                            </div> {{-- col --}}
                        </div> {{-- form-group --}}

                        <div class="form-group row">
                            <label for="logo" class="col-sm-2 col-form-label text-right">
                                Categoría
                            </label>
                            <div class="col-sm-10">
                                <select class="selectpicker" data-live-search="true" name="team_category_id" data-style="btn-light" show-tick>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div> {{-- col --}}
                        </div> {{-- form-group --}}

                        <div class="form-group row">
                            <label for="logo" class="col-sm-2 col-form-label text-right">
                                Escudo
                            </label>
                            <div class="col-sm-10">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="inputGroupFile04">
                                    <label class="custom-file-label" for="inputGroupFile04" placeholder="Selecciona la imagen"></label>
                                </div>
                            </div> {{-- col --}}
                        </div> {{-- form-group --}}


                </div> {{-- card-body --}}

                <div class="card-footer clearfix border-top p-3">
                    <div class="form-group form-check float-left p-0">

                        <div class="pretty p-switch p-fill">
                            <input type="checkbox" class="form-check-input" id="no_close" name="no_close">
                            <div class="state p-primary">
                                {{-- <i class="icon material-icons">done</i> --}}
                                <label>Insertar un nuevo registro</label>
                            </div>
                        </div>
                    </div>
                    <input type="submit" class="btn btn-primary float-right ml-1" value="Guardar" id="btnSave">
                    <a href="{{ URL::previous() }}" class="btn btn-secondary float-right" id="btnCancel">Cancelar</a>
                </div>

                </form>
            </div>
        </div>
    </div>
{{-- </div> --}}
@endsection

@section('js')
    <script>
        $(document).ready(function(){
            // $("#name").focus();

            Mousetrap.bind(['command+s', 'ctrl+s'], function() {
                var url = $("#btnSave").attr('href');
                $(location).attr('href', url);
                return false;
            });
            Mousetrap.bind(['command+c', 'ctrl+c'], function() {
                var url = $("#btnCancel").attr('href');
                $(location).attr('href', url);
                return false;
            });

        });
    </script>
@endsection
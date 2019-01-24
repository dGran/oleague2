@extends('layouts.admin-left-sidebar')

@section('content')
    <div class="row no-gutters">
        <div class="col-12 p-0 p-md-4">

            @include('admin.players_dbs.edit.page_browser')

            @include('admin.players_dbs.common.notifications')

            @include('admin.players_dbs.edit.data')

        </div> {{-- col --}}
    </div> {{-- row --}}
@endsection

@section('js')
    @include('admin.players_dbs.edit.javascript')
@endsection
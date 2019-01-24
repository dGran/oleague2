@extends('layouts.admin')

@section('content')
    <div class="row no-gutters">
        <div class="col-12 p-0 p-md-4">

            @include('admin.players_dbs.index.page_browser')

            @include('admin.players_dbs.common.notifications')

            @include('admin.players_dbs.index.toolbar_options')

            @include('admin.players_dbs.index.data')

        </div> {{-- col --}}
    </div> {{-- row --}}
@endsection

@section('right-side')
    @include('admin.players_dbs.index.right_side')
@endsection

@section('modal')
    @include('admin.players_dbs.index.filter_modal')
@endsection

@section('js')
    @include('admin.players_dbs.index.javascript')
@endsection


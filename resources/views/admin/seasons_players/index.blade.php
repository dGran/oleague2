@extends('layouts.admin')

@section('content')
    <div class="row no-gutters">
        <div class="col-12 p-0 p-md-4">

            @include('admin.seasons_players.index.page_browser')

            @include('admin.seasons_players.common.notifications')

            @include('admin.seasons_players.index.toolbar_options')

            @include('admin.seasons_players.index.data')

        </div> {{-- col --}}
    </div> {{-- row --}}
@endsection

@section('right-side')
    @include('admin.seasons_players.index.right_side')
@endsection

@section('modal')
    @include('admin.seasons_players.index.filter_modal')
    @include('admin.seasons_players.index.assign_modal')
    @include('admin.players.index.view_modal')
@endsection

@section('js')
    @include('admin.seasons_players.index.javascript')
@endsection


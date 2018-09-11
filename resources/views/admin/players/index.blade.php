@extends('layouts.admin')

@section('content')
    <div class="row no-gutters">
        <div class="col-12 p-0 p-md-4">

            @include('admin.players.index.page_browser')

            @include('admin.players.common.notifications')

            @include('admin.players.index.toolbar_options')

            @include('admin.players.index.data')

        </div> {{-- col --}}
    </div> {{-- row --}}
@endsection

@section('right-side')
    @include('admin.players.index.right_side')
@endsection

@section('modal')
    @include('admin.players.index.filter_modal')
    @include('admin.players.index.view_modal')
@endsection

@section('js')
    @include('admin.players.index.javascript')
@endsection


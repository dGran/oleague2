@extends('layouts.admin')

@section('content')
    <div class="row no-gutters">
        <div class="col-12 p-0 p-md-4">

            @include('admin.games.index.page_browser')

            @include('admin.games.common.notifications')

            @include('admin.games.index.toolbar_options')

            @include('admin.games.index.data')

        </div> {{-- col --}}
    </div> {{-- row --}}
@endsection

@section('right-side')
    @include('admin.games.index.right_side')
@endsection

@section('modal')
    @include('admin.games.index.filter_modal')
@endsection

@section('js')
    @include('admin.games.index.javascript')
@endsection


@extends('layouts.admin')

@section('content')
    <div class="row no-gutters">
        <div class="col-12 p-0 p-md-4">

            @include('admin.teams.index.page_browser')

            @include('admin.teams.common.notifications')

            @include('admin.teams.index.toolbar_options')

            @include('admin.teams.index.data')

        </div> {{-- col --}}
    </div> {{-- row --}}
@endsection

@section('right-side')
    @include('admin.teams.index.right_side')
@endsection

@section('modal')
    @include('admin.teams.index.filter_modal')
@endsection

@section('js')
    @include('admin.teams.index.javascript')
@endsection


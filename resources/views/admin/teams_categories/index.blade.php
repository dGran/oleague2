@extends('layouts.admin')

@section('content')
    <div class="row no-gutters">
        <div class="col-12 p-0 p-md-4">

            @include('admin.teams_categories.index.page_browser')

            @include('admin.teams_categories.common.notifications')

            @include('admin.teams_categories.index.toolbar_options')

            @include('admin.teams_categories.index.data')

        </div> {{-- col --}}
    </div> {{-- row --}}
@endsection

@section('right-side')
    @include('admin.teams_categories.index.right_side')
@endsection

@section('modal')
    @include('admin.teams_categories.index.filter_modal')
@endsection

@section('js')
    @include('admin.teams_categories.index.javascript')
@endsection


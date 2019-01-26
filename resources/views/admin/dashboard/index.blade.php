@extends('layouts.admin')

@section('content')
    <div class="row no-gutters">
        <div class="col-12 p-0 p-md-4">

            @include('admin.dashboard.index.page_browser')

            @include('admin.dashboard.common.notifications')

            {{-- @include('admin.dashboard.index.toolbar_options') --}}

            @include('admin.dashboard.index.data')

        </div> {{-- col --}}
    </div> {{-- row --}}
@endsection

@section('right-side')
    @include('admin.dashboard.index.right_side')
@endsection

@section('modal')
    {{-- @include('admin.dashboard.index.filter_modal') --}}
@endsection

@section('js')
    @include('admin.dashboard.index.javascript')
@endsection


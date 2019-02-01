@extends('layouts.admin')

@section('content')
    <div class="row no-gutters">
        <div class="col-12 p-0 p-md-4">

            @include('admin.seasons.index.page_browser')

            @include('admin.seasons.common.notifications')

            @include('admin.seasons.index.toolbar_options')

            @include('admin.seasons.index.data')

        </div> {{-- col --}}
    </div> {{-- row --}}
@endsection

@section('right-side')
    @include('admin.seasons.index.right_side')
@endsection

@section('modal')
    @include('admin.seasons.index.filter_modal')
@endsection

@section('js')
    @include('admin.seasons.index.javascript')
@endsection


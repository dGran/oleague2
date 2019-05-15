@extends('layouts.admin')

@section('content')
    <div class="row no-gutters">
        <div class="col-12 p-0 p-md-4">

            @include('admin.table_zones.index.page_browser')

            @include('admin.table_zones.common.notifications')

            @include('admin.table_zones.index.toolbar_options')

            @include('admin.table_zones.index.data')

        </div> {{-- col --}}
    </div> {{-- row --}}
@endsection

@section('right-side')
    @include('admin.table_zones.index.right_side')
@endsection

@section('modal')
    @include('admin.table_zones.index.filter_modal')
@endsection

@section('js')
    @include('admin.table_zones.index.javascript')
@endsection


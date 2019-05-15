@extends('layouts.admin-left-sidebar')

@section('content')
    <div class="row no-gutters">
        <div class="col-12 p-0 p-md-4">

            @include('admin.table_zones.add.page_browser')

            @include('admin.table_zones.common.notifications')

            @include('admin.table_zones.add.data')

        </div> {{-- col --}}
    </div> {{-- row --}}
@endsection

@section('js')
    @include('admin.table_zones.add.javascript')
@endsection
@extends('layouts.admin-left-sidebar')

@section('content')
    <div class="row no-gutters">
        <div class="col-12 p-0 p-md-4">

            @include('admin.seasons.add.page_browser')

            @include('admin.seasons.common.notifications')

            @include('admin.seasons.add.data')

        </div> {{-- col --}}
    </div> {{-- row --}}
@endsection

@section('js')
    @include('admin.seasons.add.javascript')
@endsection
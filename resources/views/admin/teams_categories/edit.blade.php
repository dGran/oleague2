@extends('layouts.admin-left-sidebar')

@section('content')
    <div class="row no-gutters">
        <div class="col-12 p-0 p-md-4">

            @include('admin.teams_categories.edit.page_browser')

            @include('admin.teams_categories.common.notifications')

            @include('admin.teams_categories.edit.data')

        </div> {{-- col --}}
    </div> {{-- row --}}
@endsection

@section('js')
    @include('admin.teams_categories.edit.javascript')
@endsection
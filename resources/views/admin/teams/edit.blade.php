@extends('layouts.admin-left-sidebar')

@section('content')
    <div class="row no-gutters">
        <div class="col-12 p-0 p-md-4">

            @include('admin.teams.edit.page_browser')

            @include('admin.teams.common.notifications')

            @include('admin.teams.edit.data')

        </div> {{-- col --}}
    </div> {{-- row --}}
@endsection

@section('js')
    @include('admin.teams.edit.javascript')
@endsection
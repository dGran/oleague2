@extends('layouts.admin-left-sidebar')

@section('content')
    <div class="row no-gutters">
        <div class="col-12 p-0 p-md-4">

            @include('admin.seasons_participants.edit.page_browser')

            @include('admin.seasons_participants.common.notifications')

            @include('admin.seasons_participants.edit.data')

        </div> {{-- col --}}
    </div> {{-- row --}}
@endsection

@section('js')
    @include('admin.seasons_participants.edit.javascript')
@endsection
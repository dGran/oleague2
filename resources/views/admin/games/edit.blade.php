@extends('layouts.admin-left-sidebar')

@section('content')
    <div class="row no-gutters">
        <div class="col-12 p-0 p-md-4">

            @include('admin.games.edit.page_browser')

            @include('admin.games.common.notifications')

            @include('admin.games.edit.data')

        </div> {{-- col --}}
    </div> {{-- row --}}
@endsection

@section('js')
    @include('admin.games.edit.javascript')
@endsection
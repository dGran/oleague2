@extends('layouts.admin-left-sidebar')

@section('content')
    <div class="row no-gutters">
        <div class="col-12 p-0 p-md-4">

            @include('admin.players.add.page_browser')

            @include('admin.players.common.notifications')

            @include('admin.players.add.data')

        </div> {{-- col --}}
    </div> {{-- row --}}
@endsection

@section('js')
    @include('admin.players.add.javascript')
@endsection
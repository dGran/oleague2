@extends('layouts.admin')

@section('content')
    <div class="row no-gutters">
        <div class="col-12 p-0 p-md-4">

            @include('admin.seasons_participants.index.page_browser')

            @include('admin.seasons_participants.common.notifications')

            @include('admin.seasons_participants.index.toolbar_options')

            @include('admin.seasons_participants.index.data')

        </div> {{-- col --}}
    </div> {{-- row --}}
@endsection

@section('right-side')
    @include('admin.seasons_participants.index.right_side')
@endsection

@section('modal')
    @include('admin.seasons_participants.index.filter_modal')
    @include('admin.seasons_participants.index.cash_history_modal')
    @include('admin.seasons_participants.index.roster_modal')
@endsection

@section('js')
    @include('admin.seasons_participants.index.javascript')
@endsection


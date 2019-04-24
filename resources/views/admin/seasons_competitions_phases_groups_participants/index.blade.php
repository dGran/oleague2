@extends('layouts.admin')

@section('content')
    <div class="row no-gutters">
        <div class="col-12 p-0 p-md-4">

            @include('admin.seasons_competitions_phases_groups_participants.index.page_browser')

            @include('admin.seasons_competitions_phases_groups_participants.common.notifications')

            @include('admin.seasons_competitions_phases_groups_participants.index.toolbar_options')

            @include('admin.seasons_competitions_phases_groups_participants.index.data')

        </div> {{-- col --}}
    </div> {{-- row --}}
@endsection

@section('right-side')
    @include('admin.seasons_competitions_phases_groups_participants.index.right_side')
@endsection

@section('js')
    @include('admin.seasons_competitions_phases_groups_participants.index.javascript')
@endsection


@extends('layouts.admin-left-sidebar')

@section('content')
    <div class="row no-gutters">
        <div class="col-12 p-0 p-md-4">

            @include('admin.seasons_competitions_phases_groups_leagues.calendar.page_browser')

            @include('admin.seasons_competitions_phases_groups_leagues.partials.menu')

            @include('admin.seasons_competitions_phases_groups_leagues.common.notifications')

            @include('admin.seasons_competitions_phases_groups_leagues.calendar.data')

        </div> {{-- col --}}
    </div> {{-- row --}}
@endsection

@section('modal')
    @include('admin.seasons_competitions_phases_groups_leagues.calendar.update_modal')
@endsection

@section('js')
    @include('admin.seasons_competitions_phases_groups_leagues.calendar.javascript')
@endsection
@extends('layouts.admin')

@section('content')
    <div class="row no-gutters">
        <div class="col-12 p-0 p-md-4">

            @include('admin.seasons_competitions_phases.index.page_browser')

            @include('admin.seasons_competitions_phases.common.notifications')

            @include('admin.seasons_competitions_phases.index.toolbar_options')

            @include('admin.seasons_competitions_phases.index.data')

        </div> {{-- col --}}
    </div> {{-- row --}}
@endsection

@section('right-side')
    @include('admin.seasons_competitions_phases.index.right_side')
@endsection

@section('js')
    @include('admin.seasons_competitions_phases.index.javascript')
@endsection


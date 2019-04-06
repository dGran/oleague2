@extends('layouts.admin')

@section('content')
    <div class="row no-gutters">
        <div class="col-12 p-0 p-md-4">

            @include('admin.seasons_competitions.index.page_browser')

            @include('admin.seasons_competitions.common.notifications')

            {{-- @include('admin.seasons_competitions.index.toolbar_options') --}}

            @include('admin.seasons_competitions.index.data')

        </div> {{-- col --}}
    </div> {{-- row --}}
@endsection

@section('right-side')
    @include('admin.seasons_competitions.index.right_side')
@endsection

@section('modal')
    {{-- @include('admin.seasons_competitions.index.filter_modal') --}}
@endsection

@section('js')
    @include('admin.seasons_competitions.index.javascript')
@endsection


@extends('layouts.admin')

@section('content')
    <div class="row no-gutters">
        <div class="col-12 p-0 p-md-4">

            @include('admin.cash_history.index.page_browser')

            @include('admin.cash_history.common.notifications')

            @include('admin.cash_history.index.toolbar_options')

            @include('admin.cash_history.index.data')

        </div> {{-- col --}}
    </div> {{-- row --}}
@endsection

@section('right-side')
    @include('admin.cash_history.index.right_side')
@endsection

@section('modal')
    @include('admin.cash_history.index.filter_modal')
@endsection

@section('js')
    @include('admin.cash_history.index.javascript')
@endsection


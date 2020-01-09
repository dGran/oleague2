@extends('layouts.admin-left-sidebar')

@section('content')
    <div class="row no-gutters">
        <div class="col-12 p-0 p-md-4">

            @include('admin.cash_history.add.page_browser')

            @include('admin.cash_history.common.notifications')

            @include('admin.cash_history.add.data')

        </div> {{-- col --}}
    </div> {{-- row --}}
@endsection

@section('js')
    @include('admin.cash_history.add.javascript')
@endsection
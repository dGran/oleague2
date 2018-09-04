@extends('layouts.admin')

@section('top-menu')
    <div class="row no-gutters">
        <div class="col-2" style="line-height: 23px">
            <figure class="p-1">
                <img src="{{ asset('img/logo.png') }}" alt="" height="32" width="auto">
            </figure>
        </div>
        <div class="col-8 text-center">
            <h4 class="text-uppercase" style="line-height: 45px">dashboard</h4>
        </div>
        <div class="col-2 text-right">
            <figure class="p-1">
                <img src="https://upload.wikimedia.org/wikipedia/commons/b/be/Lineage_OS_Logo.png" alt="" height="32" width="auto">
            </figure>
        </div>
    </div>
@endsection

@section('content')
<div class="row no-gutters">
    <div class="col-12">
        <div class="p-3">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Neque aspernatur nihil perspiciatis hic, id nobis, accusamus animi necessitatibus cumque est fugit incidunt rerum repudiandae eius et quas, aperiam ratione tempore!
        </div>

    </div>
</div>

@endsection

@section('right-menu')
    Menu derecha
@endsection
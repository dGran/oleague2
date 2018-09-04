<div class="tableOptions animated fadeIn">
    <a href="{{ route('admin.teams.add') }}" class="btn btn-primary" id="btnAdd">
        <span>Nuevo equipo</span>
    </a>
    <ul class="list-group border-top mt-3">
        <li class="list-group-item border-0 px-0">
            <a href="{{ route('admin.teams.export.file',['type'=>'xls']) }}">
                <span class="fas fa-file-export fa-fw mr-1"></span>
                <span>Exportar (.xls)</span>
            </a>
        </li>
        <li class="list-group-item border-0 px-0">
            <a href="{{ route('admin.teams.export.file',['type'=>'xlsx']) }}">
                <span class="fas fa-file-export fa-fw mr-1"></span>
                <span>Exportar (.xlsx)</span>
            </a>
        </li>
        <li class="list-group-item border-0 px-0">
            <a href="{{ route('admin.teams.export.file',['type'=>'csv']) }}">
                <span class="fas fa-file-export fa-fw mr-1"></span>
                <span>Exportar (.csv)</span>
            </a>
        </li>
        <li class="list-group-item border-0 px-0">
            <a href="">
               <form
                id="frmImport"
                    lang="{{ app()->getLocale() }}"
                    role="form"
                    method="POST"
                    action="{{ route('admin.teams.import.file') }}"
                    enctype="multipart/form-data"
                    data-toggle="validator"
                    autocomplete="off">
                    {{ csrf_field() }}
                    <input type="file" name="import_file" id="import_file" class="d-none">
                    <span class="fas fa-file-import fa-fw mr-1"></span>
                    <span onclick="import_file()">Importar</span>

    {{--             <a href="">
                    <span class="fas fa-file-import fa-fw mr-1"></span>
                    <span>Importar</span>
                </a> --}}
                </form>

            </a>
        </li>
    </ul>
</div>

<div class="rowOptions animated fadeIn d-none">
    <a href="" class="btn btn-danger" onclick="destroyMany()">
        <span>Eliminar</span>
    </a>
    <ul class="list-group border-top mt-3">
        <li class="list-group-item border-0 px-0">
            <a href="" onclick="duplicateMany()">
                <span class="fas fa-clone fa-fw mr-1"></span>
                <span>Duplicar</span>
            </a>
        </li>
        <li class="list-group-item border-0 px-0">
            <a href="{{ route('admin.teams.export.file',['type'=>'xls', $filterCategory, $filterName]) }}">
                <span class="fas fa-file-export fa-fw mr-1"></span>
                <span>Exportar (.xls)</span>
            </a>
        </li>
        <li class="list-group-item border-0 px-0">
            <a href="{{ route('admin.teams.export.file',['type'=>'xlsx', $filterCategory, $filterName]) }}">
                <span class="fas fa-file-export fa-fw mr-1"></span>
                <span>Exportar (.xlsx)</span>
            </a>
        </li>
        <li class="list-group-item border-0 px-0">
            <a href="{{ route('admin.teams.export.file',['type'=>'csv', $filterCategory, $filterName]) }}">
                <span class="fas fa-file-export fa-fw mr-1"></span>
                <span>Exportar (.csv)</span>
            </a>
        </li>
    </ul>
</div>

<form class="frmFilter" role="search" method="get" action="{{ route('admin.teams') }}">

{{-- search --}}
<div class="form-group row my-3">
    <div class="col">
    <div class="searchbox">
        <label class="search-icon" for="search-by"><i class="fas fa-search"></i></label>
        <input class="search-input form-control mousetrap filterName" name="filterName" type="text" placeholder="Buscar..." value="{{ $filterName ? $filterName : '' }}" autocomplete="off">
        <span class="search-clear"><i class="fas fa-times"></i></span>
        </div>
    </div>
</div>

<div class="mt-4">
    @if ($filterName || $filterCategory)
        <ul class="nav mb-2">
            @if ($filterName)
                <li class="nav-item">
                    <a href="" class="badge badge-secondary mr-1" onclick="cancelFilterName()">
                        <span class="r-1">Nombre</span>
                        <i class="fas fa-times"></i>
                    </a>
                </li>
            @endif
            @if ($filterCategory)
                <li class="nav-item">
                    <a href="" class="badge badge-secondary mr-1" onclick="cancelFilterCategory()">
                        <span class="r-1">Categoría</span>
                        <i class="fas fa-times"></i>
                    </a>
                </li>
            @endif
        </ul>
    @endif
    <h4 class="p-2 bg-light">Filtros</h4>
    <div class="form-group row">
        <div class="col-sm-12">
            <label for="filterCategoryLarge" class="mb-1">Categoría de equipos</label>
            <select name="filterCategory" id="filterCategoryLarge" class="selectpicker form-control filterCategory" onchange="applyfilterCategory()">
                <option value="">Todas las categorías</option>
                @foreach ($categories as $category)
                    @if ($category->id == $filterCategory)
                        <option selected value="{{ $category->id }}">{{ $category->name }}</option>
                    @else
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>
</div>

<div class="mt-4">
    <h4 class="p-2 bg-light">Orden</h4>
    <div class="form-group row">
        <div class="col-sm-12">
            <select name="order" class="selectpicker show-tick form-control order" onchange="applyOrder()">
                <option value="default" {{ $order == 'default' ? 'selected' : '' }}>Por defecto</option>
                <option value="date_desc" {{ $order == 'date_desc' ? 'selected' : '' }} data-icon="fas fa-sort-amount-up">Los últimos al principio</option>
                <option value="date" {{ $order == 'date' ? 'selected' : '' }} data-icon="fas fa-sort-amount-down">Los últimos al final</option>
                <option value="name" {{ $order == 'name' ? 'selected' : '' }} data-icon="fas fa-sort-alpha-up">Por nombre</option>
                <option value="name_desc" {{ $order == 'name_desc' ? 'selected' : '' }} data-icon="fas fa-sort-alpha-down">Por nombre</option>
            </select>
        </div>
    </div>
</div>

<div class="mt-4">
    <h4 class="p-2 bg-light">Visualización</h4>
    <div class="form-group row">
        <div class="col-sm-12">
            <select name="pagination" class="selectpicker show-tick form-control pagination" onchange="applyDisplay()">
                <option value="all" {{ $pagination == 'all' ? 'selected' : '' }}>Todos los registros</option>
                <option value="5" {{ $pagination == '5' ? 'selected' : '' }}>5 registros / pagina</option>
                <option value="10" {{ $pagination == '10' ? 'selected' : '' }}>10 registros / pagina</option>
                <option value="15" {{ $pagination == '15' || !$pagination ? 'selected' : '' }}>15 registros / pagina</option>
                <option value="20" {{ $pagination == '20' ? 'selected' : '' }}>20 registros / pagina</option>
            </select>
        </div>
    </div>
</div>

</form>
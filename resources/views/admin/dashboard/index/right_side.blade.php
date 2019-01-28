<div class="tableOptions animated fadeIn">
    <ul class="list-group border-top mt-3">
        <li class="list-group-item border-0 px-0">
            <a href="" onclick="export_file('xls')">
                <span class="fas fa-file-export fa-fw mr-1"></span>
                <span>Exportar (.xls)</span>
            </a>
        </li>
        <li class="list-group-item border-0 px-0">
            <a href="" onclick="export_file('xlsx')">
                <span class="fas fa-file-export fa-fw mr-1"></span>
                <span>Exportar (.xlsx)</span>
            </a>
        </li>
        <li class="list-group-item border-0 px-0">
            <a href="" onclick="export_file('csv')">
                <span class="fas fa-file-export fa-fw mr-1"></span>
                <span>Exportar (.csv)</span>
            </a>
        </li>
{{--         <li class="list-group-item border-0 px-0">
            <a href="" onclick="import_file()">
               <form
                id="frmImport"
                    lang="{{ app()->getLocale() }}"
                    role="form"
                    method="POST"
                    action="{{ route('admin.players_dbs.import.file') }}"
                    enctype="multipart/form-data"
                    data-toggle="validator"
                    autocomplete="off">
                    {{ csrf_field() }}
                    <input type="file" name="import_file" id="import_file" class="d-none">
                    <span class="fas fa-file-import fa-fw mr-1"></span>
                    <span>Importar</span>
                </form>
            </a>
        </li> --}}
    </ul>
</div>

<form class="frmFilter" role="search" method="get" action="{{ route('admin') }}">

{{-- search --}}
<div class="form-group row my-3">
    <div class="col">
    <div class="searchbox">
        <label class="search-icon" for="search-by"><i class="fas fa-search"></i></label>
        <input class="search-input form-control mousetrap filterDescription" name="filterDescription" type="text" placeholder="Buscar por descripción" value="{{ $filterDescription ? $filterDescription : '' }}" autocomplete="off" onkeypress="submitFilterForm()">
        <span class="search-clear"><i class="fas fa-times"></i></span>
        </div>
    </div>
</div>

<div class="mt-4">
    @if ($filterDescription || $filterUser || $filterTable || $filterType)
        <ul class="nav mb-2">
            @if ($filterDescription)
                <li class="nav-item">
                    <a href="" class="badge badge-secondary mr-1" onclick="cancelFilterDescription()">
                        <span class="r-1">Descripción</span>
                        <i class="fas fa-times"></i>
                    </a>
                </li>
            @endif
            @if ($filterUser)
                <li class="nav-item">
                    <a href="" class="badge badge-secondary mr-1" onclick="cancelFilterUser()">
                        <span class="r-1">Usuario</span>
                        <i class="fas fa-times"></i>
                    </a>
                </li>
            @endif
            @if ($filterTable)
                <li class="nav-item">
                    <a href="" class="badge badge-secondary mr-1" onclick="cancelFilterTable()">
                        <span class="r-1">Tabla</span>
                        <i class="fas fa-times"></i>
                    </a>
                </li>
            @endif
            @if ($filterType)
                <li class="nav-item">
                    <a href="" class="badge badge-secondary mr-1" onclick="cancelFilterType()">
                        <span class="r-1">Tipo</span>
                        <i class="fas fa-times"></i>
                    </a>
                </li>
            @endif
        </ul>
    @endif
    <h4 class="p-2 bg-light">Filtros</h4>
    <div class="form-group row">
        <div class="col-sm-12">
            <label for="filterUserLarge" class="mb-1">Usuarios</label>
            <select name="filterUser" id="filterUser" class="selectpicker form-control filterUser" onchange="applyfilterUser()">
                <option value="">Todas los usuarios</option>
                @foreach ($adminUsers as $admin)
                    @if ($admin->id == $filterUser)
                        <option selected value="{{ $admin->id }}">{{ $admin->name }}</option>
                    @else
                        <option value="{{ $admin->id }}">{{ $admin->name }}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-group row">
        <div class="col-sm-12">
            <label for="filterTable" class="mb-1">Tabla</label>
            <input class="filterTable-input form-control mousetrap filterTable" id="filterTable" name="filterTable" type="text" placeholder="Tabla..." value="{{ $filterTable ? $filterTable : '' }}" autocomplete="off" onkeypress="submitFilterForm()">
        </div>
    </div>

    <div class="form-group row">
        <div class="col-sm-12">
            <label for="filterType" class="mb-1">Tipo</label>
            <input class="filterType-input form-control mousetrap filterType" id="filterType" name="filterType" type="text" placeholder="Tipo..." value="{{ $filterType ? $filterType : '' }}" autocomplete="off" onkeypress="submitFilterForm()">
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
            </select>
        </div>
    </div>
</div>

<div class="mt-4">
    <h4 class="p-2 bg-light">Visualización</h4>
    <div class="form-group row">
        <div class="col-sm-12">
            <select name="pagination" class="selectpicker show-tick form-control pagination" onchange="applyDisplay()">
                <option value="6" {{ $pagination == '6' ? 'selected' : '' }}>6 registros / pagina</option>
                <option value="12" {{ $pagination == '12' || !$pagination ? 'selected' : '' }}>12 registros / pagina</option>
                <option value="20" {{ $pagination == '20' ? 'selected' : '' }}>20 registros / pagina</option>
                <option value="50" {{ $pagination == '50' ? 'selected' : '' }}>50 registros / pagina</option>
                <option value="100" {{ $pagination == '100' ? 'selected' : '' }}>100 registros / pagina</option>
            </select>
        </div>
    </div>
</div>

</form>
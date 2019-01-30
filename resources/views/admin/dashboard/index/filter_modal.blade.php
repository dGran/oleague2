<div class="modal fade" id="filterModal" tabindex="-1" role="dialog" aria-labelledby="filterModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="frmFilter" role="search" method="get" action="{{ route('admin') }}">
                <div class="modal-header bg-light">
                    <h4 class="m-0">Opciones de tabla</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                    <div class="py-2 m-0 clearfix">
                        <div class="float-left">
                            <h5 class="m-0 p-0">
                                <i class="fas fa-filter mr-1"></i>
                                Filtros
                            </h5>
                        </div>
                        <div class="float-right">
                            @if ($filterDescription || $filterUser || $filterTable || $filterType)
                                <ul class="nav">
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
                        </div>
                    </div>

                    <div class="py-3 border-top">
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label for="filterDescription" class="mb-1">Descripción</label>
                                <input class="form-control" name="filterDescription" id="filterDescription" type="text" value="{{ $filterDescription ? $filterDescription : '' }}" aria-describedby="filterDescriptionHelp">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label for="filterUserLarge" class="mb-1">Usuarios</label>
                                <select name="filterUser" id="filterUserLarge" class="selectpicker form-control filterUser">
                                    <option value="">Todos los usuarios</option>
                                        @foreach ($adminUsers as $admin)
                                            @if ($admin->user->id == $filterUser)
                                                <option selected value="{{ $admin->user->id }}">{{ $admin->user->name }}</option>
                                            @else
                                                <option value="{{ $admin->user->id }}">{{ $admin->user->name }}</option>
                                            @endif
                                        @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label for="filterTable" class="mb-1">Tabla</label>
                                <input class="form-control" name="filterTable" id="filterTable" type="text" value="{{ $filterTable ? $filterTable : '' }}" aria-describedby="filterTableHelp">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label for="filterType" class="mb-1">Tipo</label>
                                <input class="form-control" name="filterType" id="filterType" type="text" value="{{ $filterType ? $filterType : '' }}" aria-describedby="filterTypeHelp">
                            </div>
                        </div>
                    </div>

                    <h5 class="py-2 m-0">
                        <i class="fas fa-sort-numeric-up mr-1"></i>
                        Orden
                    </h5>
                    <div class="py-2 border-top">
                        <div class="form-group row">
                            <div class="col-sm-12 mt-2">
                                <select name="order" class="selectpicker show-tick form-control order">
                                    <option value="default" {{ $order == 'default' ? 'selected' : '' }}>Por defecto</option>
                                    <option value="date_desc" {{ $order == 'date_desc' ? 'selected' : '' }} data-icon="fas fa-sort-amount-up">Los últimos al principio</option>
                                    <option value="date" {{ $order == 'date' ? 'selected' : '' }} data-icon="fas fa-sort-amount-down">Los últimos al final</option>
                                    <option value="name" {{ $order == 'name' ? 'selected' : '' }} data-icon="fas fa-sort-alpha-up">Por nombre</option>
                                    <option value="name_desc" {{ $order == 'name_desc' ? 'selected' : '' }} data-icon="fas fa-sort-alpha-down">Por nombre</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <h5 class="py-2 m-0">
                        <i class="far fa-eye mr-1"></i>
                        Visualización
                    </h5>
                    <div class="py-2 border-top">
                        <div class="form-group row">
                            <div class="col-sm-12 mt-2">
                                <select name="pagination" class="selectpicker show-tick form-control pagination">
                                    <option value="6" {{ $pagination == '6' ? 'selected' : '' }}>6 registros / pagina</option>
                                    <option value="12" {{ $pagination == '12' || !$pagination ? 'selected' : '' }}>12 registros / pagina</option>
                                    <option value="20" {{ $pagination == '20' ? 'selected' : '' }}>20 registros / pagina</option>
                                    <option value="50" {{ $pagination == '50' ? 'selected' : '' }}>50 registros / pagina</option>
                                    <option value="100" {{ $pagination == '100' ? 'selected' : '' }}>100 registros / pagina</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Aplicar...</button>
                </div>
            </form>
        </div>
    </div>
</div>
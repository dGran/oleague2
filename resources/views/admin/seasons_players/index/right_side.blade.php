<div class="tableOptions animated fadeIn">
    <a href="{{ route('admin.season_players.add', $active_season->id) }}" class="btn btn-primary" id="btnAdd">
        <i class="fas fa-plus mr-2"></i><span>Nuevo</span>
    </a>
    <ul class="list-group border-top mt-3">
        <li class="list-group-item border-0 px-0">
            <a href="{{ route('admin.season_players.reset', $filterSeason) }}" onclick="reset()" id="btnReset">
                <span class="fas fa-sync-alt fa-fw mr-1"></span>
                <span>Resetar</span>
            </a>
        </li>
        <li class="list-group-item border-0 px-0">
            <a href="" onclick="import_file()">
               <form
                id="frmImport"
                    lang="{{ app()->getLocale() }}"
                    role="form"
                    method="POST"
                    action="{{ route('admin.season_players.import.file') }}"
                    enctype="multipart/form-data"
                    data-toggle="validator"
                    autocomplete="off">
                    {{ csrf_field() }}
                    <input type="file" name="import_file" id="import_file" class="d-none">
                    <span class="fas fa-file-import fa-fw mr-1"></span>
                    <span>Importar</span>
                </form>
            </a>
        </li>
        @if ($players->count()>0)
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
        @endif
    </ul>
</div>

<div class="rowOptions animated fadeIn d-none">
    <a href="" class="btn btn-danger" onclick="destroyMany()">
        <i class="fas fa-trash mr-2"></i>Eliminar
    </a>
    <ul class="list-group border-top mt-3">
        <li class="rowOptions-View list-group-item border-0 px-0 d-none">
            <a href="" onclick="view(this)">
                <span class="far fa-eye fa-fw mr-1"></span>
                <span>Visualizar</span>
            </a>
        </li>
        {{-- 1 player selected --}}
        <li class="rowOptions-Desactivate list-group-item border-0 px-0 d-none">
            <a href="" onclick="desactivate(this)">
                <span class="fas fa-toggle-off fa-fw mr-1"></span>
                <span>Desactivar</span>
            </a>
        </li>
        <li class="rowOptions-Activate list-group-item border-0 px-0 d-none">
            <a href="" onclick="activate(this)">
                <span class="fas fa-toggle-on fa-fw mr-1"></span>
                <span>Activar</span>
            </a>
        </li>
        {{-- many players selected --}}
        <li class="rowOptions-DesactivateMany list-group-item border-0 px-0 d-none">
            <a href="" onclick="desactivateMany(this)">
                <span class="fas fa-toggle-off fa-fw mr-1"></span>
                <span>Desactivar</span>
            </a>
        </li>
        <li class="rowOptions-ActivateMany list-group-item border-0 px-0 d-none">
            <a href="" onclick="activateMany(this)">
                <span class="fas fa-toggle-on fa-fw mr-1"></span>
                <span>Activar</span>
            </a>
        </li>
        <li class="rowOptions-Edit list-group-item border-0 px-0 d-none">
            <a href="" onclick="edit(this)">
                <span class="fas fa-edit fa-fw mr-1"></span>
                <span>Editar</span>
            </a>
        </li>
        <li class="rowOptions-ResetMany list-group-item border-0 px-0">
            <a href="" onclick="resetMany()">
                <span class="fas fa-sync-alt fa-fw mr-1"></span>
                <span>Resetar</span>
            </a>
        </li>
        <li class="list-group-item border-0 px-0">
            <a href="" onclick="export_file_selected('xls')">
                <span class="fas fa-file-export fa-fw mr-1"></span>
                <span>Exportar (.xls)</span>
            </a>
        </li>
        <li class="list-group-item border-0 px-0">
            <a href="" onclick="export_file_selected('xlsx')">
                <span class="fas fa-file-export fa-fw mr-1"></span>
                <span>Exportar (.xlsx)</span>
            </a>
        </li>
        <li class="list-group-item border-0 px-0">
            <a href="" onclick="export_file_selected('csv')">
                <span class="fas fa-file-export fa-fw mr-1"></span>
                <span>Exportar (.csv)</span>
            </a>
        </li>
        <li class="list-group-item border-0 px-0">
            <label for="participant_id">Asignar participante</label>
            <select class="selectpicker form-control" name="participant_id" id="participant_id" data-size="3" data-live-search="true">
                <option value="0">LIBRE</option>
                @foreach ($participants as $participant)
                    <option value="{{ $participant->id }}">{{ $participant->name() }}</option>
                @endforeach
            </select>
        </li>
        <li class="list-group-item border-0 px-0">
            <label for="salary">Editar salario</label>
            <input type="number" class="form-control" id="salary" name="salary" placeholder="Salario" min="0.5" step="0.5" value="0.5">
        </li>
    </ul>
</div>

<form class="frmFilter" role="search" method="get" action="{{ route('admin.season_players') }}">
<input type="hidden" name="filtering" value="true"> {{-- field for controller --}}

{{-- search --}}
<div class="form-group row my-3">
    <div class="col">
    <div class="searchbox">
        <label class="search-icon" for="search-by"><i class="fas fa-search"></i></label>
        <input class="search-input form-control mousetrap filterName" name="filterName" type="text" placeholder="Buscar..." value="{{ $filterName ? $filterName : '' }}" autocomplete="off" onkeypress="submitFilterForm()">
        <span class="search-clear"><i class="fas fa-times"></i></span>
        </div>
    </div>
</div>

<div class="mt-4">
    @if ($filterName || $filterParticipant || $filterTeam || $filterNation || $filterPosition)
        <ul class="nav mb-2">
            @if ($filterName)
                <li class="nav-item">
                    <a href="" class="badge badge-secondary mr-1" onclick="cancelFilterName()">
                        <span class="r-1">Nombre</span>
                        <i class="fas fa-times"></i>
                    </a>
                </li>
            @endif
            @if ($filterParticipant)
                <li class="nav-item">
                    <a href="" class="badge badge-secondary mr-1" onclick="cancelFilterParticipant()">
                        <span class="r-1">Participante</span>
                        <i class="fas fa-times"></i>
                    </a>
                </li>
            @endif
            @if ($filterTeam)
                <li class="nav-item">
                    <a href="" class="badge badge-secondary mr-1" onclick="cancelFilterTeam()">
                        <span class="r-1">Equipo</span>
                        <i class="fas fa-times"></i>
                    </a>
                </li>
            @endif
            @if ($filterNation)
                <li class="nav-item">
                    <a href="" class="badge badge-secondary mr-1" onclick="cancelFilterNation()">
                        <span class="r-1">País</span>
                        <i class="fas fa-times"></i>
                    </a>
                </li>
            @endif
            @if ($filterPosition)
                <li class="nav-item">
                    <a href="" class="badge badge-secondary mr-1" onclick="cancelFilterPosition()">
                        <span class="r-1">Posición</span>
                        <i class="fas fa-times"></i>
                    </a>
                </li>
            @endif
        </ul>
    @endif
    <h4 class="p-2 bg-light">Filtros</h4>
    <div class="form-group row">
        <div class="col-sm-12">
            <label for="filterSeasonLarge" class="mb-1">Temporadas</label>
            <select name="filterSeason" id="filterSeasonLarge" class="selectpicker form-control filterSeason" onchange="applyfilterSeason()">
                @foreach ($seasons as $season)
                    @if ($season->id == $filterSeason)
                        <option selected value="{{ $season->id }}">{{ $season->name }}</option>
                    @else
                        <option value="{{ $season->id }}">{{ $season->name }}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-group row">
        <div class="col-sm-12">
            <label for="filterParticipantLarge" class="mb-1">Participantes</label>
            <select name="filterParticipant" id="filterParticipantLarge" class="selectpicker form-control filterParticipant" onchange="applyfilterParticipant()">
                <option value="">Todos los participantes</option>
                @foreach ($participants as $participant)
                    @if ($participant->id == $filterParticipant)
                        <option selected value="{{ $participant->id }}">{{ $participant->name() }}</option>
                    @else
                        <option value="{{ $participant->id }}">{{ $participant->name() }}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-group row">
        <div class="col-sm-12">
            <label for="filterTeam" class="mb-1">Equipo</label>
            <input class="filterTeam-input form-control mousetrap filterTeam" id="filterTeam" name="filterTeam" type="text" placeholder="Equipo..." value="{{ $filterTeam ? $filterTeam : '' }}" autocomplete="off" onkeypress="submitFilterForm()">
        </div>
    </div>

    <div class="form-group row">
        <div class="col-sm-12">
            <label for="filterTeam" class="mb-1">País</label>
            <input class="filterNation-input form-control mousetrap filterNation" id="filterNation" name="filterNation" type="text" placeholder="País..." value="{{ $filterNation ? $filterNation : '' }}" autocomplete="off" onkeypress="submitFilterForm()">
        </div>
    </div>

    <div class="form-group row">
        <div class="col-sm-12">
            <label for="filterTeam" class="mb-1">Posición</label>
            <input class="filterPosition-input form-control mousetrap filterPosition" id="filterPosition" name="filterPosition" type="text" placeholder="Posición..." value="{{ $filterPosition ? $filterPosition : '' }}" autocomplete="off" onkeypress="submitFilterForm()">
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
                <option value="overall" {{ $order == 'overall' ? 'selected' : '' }} data-icon="fas fa-sort-numeric-up">Por media</option>
                <option value="overall_desc" {{ $order == 'overall_desc' ? 'selected' : '' }} data-icon="fas fa-sort-numeric-down">Por media</option>
                <option value="age" {{ $order == 'age' ? 'selected' : '' }} data-icon="fas fa-sort-numeric-up">Por edad</option>
                <option value="age_desc" {{ $order == 'age_desc' ? 'selected' : '' }} data-icon="fas fa-sort-numeric-down">Por edad</option>
                <option value="height" {{ $order == 'height' ? 'selected' : '' }} data-icon="fas fa-sort-numeric-up">Por altura</option>
                <option value="height_desc" {{ $order == 'height_desc' ? 'selected' : '' }} data-icon="fas fa-sort-numeric-down">Por altura</option>
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
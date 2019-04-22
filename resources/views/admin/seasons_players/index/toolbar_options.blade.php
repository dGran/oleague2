<div class="general-options">

    <div class="btn-toolbar px-3 pb-3 d-block d-md-none" role="toolbar">
        <div class="btn-group tableOptions" role="group">
            <button id="addon-new" onclick="location.href='{{ route('admin.season_players.add', $active_season->id) }}'" type="button" class="btn btn-primary" data-toggle="button">
                <i class="fas fa-plus mr-2"></i>Nuevo
            </button>
            <button id="addon-filter" type="button" class="filter btn input-group-text border-left-0 {{ $filterSeason ? 'active' : '' }}" data-toggle="modal" data-target="#filterModal">
                <i class="fas fa-filter"></i>
            </button>
            @if ($players->count()>0)
                <button id="addon-reset" type="button" class="btn input-group-text" data-toggle="button" onclick="reset()">
                    <i class="fas fa-sync-alt"></i>
                </button>
            @endif
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
            </form>
                <button id="addon-import" type="button" class="btn input-group-text border-left-0" data-toggle="button" onclick="import_file()">
                    <i class="fas fa-file-import"></i>
                </button>

            @if ($players->count()>0)
                <button id="addon-export" type="button" class="btn input-group-text dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-file-export"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right my-1" aria-labelledby="addon-export">
                    <a class="dropdown-item text-secondary" href="" onclick="export_file('xls')">
                        <span class="fas fa-file-export fa-fw mr-1"></span>
                        <span>Exportar (.xls)</span>
                    </a>
                    <a class="dropdown-item text-secondary" href="" onclick="export_file('xlsx')">
                        <span class="fas fa-file-export fa-fw mr-1"></span>
                        <span>Exportar (.xlsx)</span>
                    </a>
                    <a class="dropdown-item text-secondary" href="" onclick="export_file('csv')">
                        <span class="fas fa-file-export fa-fw mr-1"></span>
                        <span>Exportar (.csv)</span>
                    </a>
                </div>
            @endif

        </div>

        <div class="btn-group d-none rowOptions" role="group">
            <button type="button" class="btn btn-danger" data-toggle="button" onclick="destroyMany()">
                <i class="fas fa-trash mr-2"></i>Eliminar
            </button>
            <button type="button" class="rowOptions-Assign btn btn-outline-secondary input-group-text border-left-0" data-toggle="modal" data-target="#assignModal">
                <i class="fas fa-exchange-alt"></i>
            </button>
            <button type="button" class="rowOptions-View btn btn-outline-secondary input-group-text border-left-0" data-toggle="button" onclick="view(this)">
                <i class="fas fa-id-card"></i>
            </button>
            <button type="button" class="rowOptions-Edit btn btn-outline-secondary input-group-text" data-toggle="button" onclick="edit(this)">
                <i class="fas fa-edit"></i>
            </button>
            {{-- 1 player selected --}}
            <button type="button" class="rowOptions-Desactivate btn btn-outline-secondary input-group-text" data-toggle="button" onclick="desactivate(this)">
                <i class="fas fa-toggle-off"></i>
            </button>
            <button type="button" class="rowOptions-Activate btn btn-outline-secondary input-group-text" data-toggle="button" onclick="activate(this)">
                <i class="fas fa-toggle-on"></i>
            </button>
            {{-- end --}}
            {{-- many players selected --}}
            <button type="button" class="rowOptions-DesactivateMany btn btn-outline-secondary input-group-text" data-toggle="button" onclick="desactivateMany(this)">
                <i class="fas fa-toggle-off"></i>
            </button>
            <button type="button" class="rowOptions-ActivateMany btn btn-outline-secondary input-group-text" data-toggle="button" onclick="activateMany(this)">
                <i class="fas fa-toggle-on"></i>
            </button>
            {{-- end --}}
            <button type="button" class="rowOptions-ResetMany btn input-group-text" data-toggle="button" onclick="resetMany()">
                <i class="fas fa-sync-alt"></i>
            </button>
            <button id="row-addon-export" type="button" class="btn btn-outline-secondary input-group-text dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-file-export"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-right my-1" aria-labelledby="row-addon-export">
                <a class="dropdown-item text-secondary" href="" onclick="export_file_selected('xls')">
                    <span class="fas fa-file-export fa-fw mr-1"></span>
                    <span>Exportar (.xls)</span>
                </a>
                <a class="dropdown-item text-secondary" href="" onclick="export_file_selected('xlsx')">
                    <span class="fas fa-file-export fa-fw mr-1"></span>
                    <span>Exportar (.xlsx)</span>
                </a>
                <a class="dropdown-item text-secondary" href="" onclick="export_file_selected('csv')">
                    <span class="fas fa-file-export fa-fw mr-1"></span>
                    <span>Exportar (.csv)</span>
                </a>
            </div>
        </div>
    </div> {{-- toolbar --}}

</div> {{-- general-options --}}
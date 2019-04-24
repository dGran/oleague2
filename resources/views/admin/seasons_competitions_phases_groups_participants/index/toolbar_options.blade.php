<div class="general-options">

    <div class="btn-toolbar px-3 pb-3 d-block d-md-none" role="toolbar">
        <div class="btn-group tableOptions" role="group">
            <button id="addon-new" onclick="location.href='{{ route('admin.season_competitions_phases_groups_participants.add', [$group->phase->competition->slug, $group->phase->slug, $group->slug]) }}'" type="button" class="btn btn-primary" data-toggle="button">
                <i class="fas fa-plus mr-2"></i>Nuevo
            </button>
           <form
            id="frmImport"
                lang="{{ app()->getLocale() }}"
                role="form"
                method="POST"
                action="{{ route('admin.season_competitions_phases_groups_participants.import.file', [$group->phase->competition->slug, $group->phase->slug, $group->slug]) }}"
                enctype="multipart/form-data"
                data-toggle="validator"
                autocomplete="off">
                {{ csrf_field() }}
                <input type="file" name="import_file" id="import_file" class="d-none">
            </form>
                <button id="addon-import" type="button" class="btn input-group-text border-left-0" data-toggle="button" onclick="import_file()">
                    <i class="fas fa-file-import"></i>
                </button>

            @if ($participants->count()>0)
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
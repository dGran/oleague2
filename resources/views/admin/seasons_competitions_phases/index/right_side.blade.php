<div class="tableOptions animated fadeIn">
    <a href="{{ route('admin.season_competitions_phases.add', $competition->slug) }}" class="btn btn-primary" id="btnAdd">
        <i class="fas fa-plus mr-2"></i><span>Nueva</span>
    </a>

    <ul class="list-group border-top mt-3">
        <li class="list-group-item border-0 px-0">
            <a href="" onclick="import_file()">
               <form
                id="frmImport"
                    lang="{{ app()->getLocale() }}"
                    role="form"
                    method="POST"
                    action="{{ route('admin.season_competitions_phases.import.file', $competition->slug) }}"
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
        @if ($phases->count()>0)
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
        <li class="rowOptions-Groups list-group-item border-0 px-0 d-none">
            <a href="" onclick="groups(this)">
                <span class="fas fa-users-cog fa-fw mr-1"></span>
                <span>Grupos</span>
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
    </ul>
</div>
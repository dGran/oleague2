<div class="tableOptions animated fadeIn">
    <a href="{{ route('admin.season_competitions_phases_groups_participants.add', [$group->phase->competition->slug, $group->phase->slug, $group->slug]) }}" class="btn btn-primary {{ $participants->count() >= $group->num_participants ? 'disabled' : '' }}" id="btnAdd">
        <i class="fas fa-plus mr-2"></i><span>Nuevo</span>
    </a>
    <ul class="list-group border-top mt-3">
        <li class="list-group-item border-0 px-0">
            @if ($participants->count() >= $group->num_participants)
                <span class="fas fa-dice fa-fw mr-1"></span>
                <span>Completar por sorteo</span>
            @else
                <a href="" onclick="raffle()">
                    <span class="fas fa-dice fa-fw mr-1"></span>
                    <span>Completar por sorteo</span>
                </a>
            @endif
        </li>
        <li class="list-group-item border-0 px-0">
            @if ($participants->count() >= $group->num_participants)
                <span class="fas fa-file-import fa-fw mr-1 text-muted"></span>
                <span class="text-muted">Importar</span>
            @else
                <a href="" onclick="import_file()">
                   <form
                    id="frmImport"
                        lang="{{ app()->getLocale() }}"
                        role="form"
                        method="POST"
                        action="{{ route('admin.season_participants.import.file', [$group->phase->competition->slug, $group->phase->slug, $group->slug]) }}"
                        enctype="multipart/form-data"
                        data-toggle="validator"
                        autocomplete="off">
                        {{ csrf_field() }}
                        <input type="file" name="import_file" id="import_file" class="d-none">
                        <span class="fas fa-file-import fa-fw mr-1"></span>
                        <span>Importar</span>
                    </form>
                </a>
            @endif
        </li>
        @if ($participants->count()>0)
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
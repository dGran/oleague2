@extends('layouts.admin')

@section('content')

<div class="row no-gutters">
    <div class="col-12 p-0 p-md-4">

        <div class="px-3 px-md-0 py-2">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb p-0 m-0 mb-1" style="font-size: .9em">
                    <li class="breadcrumb-item"><a href="{{ route('admin') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Equipos</li>
                </ol>
            </nav>
            <h5 class="text-uppercase m-0"><strong>Equipos</strong></h5>
        </div>

        <div class="px-3 px-md-0">
            @if (session('error'))
                <div class="alert alert-danger autohide">
                    {{ session('error') }}
                </div>
            @endif

            @if (session('status'))
                <div class="alert alert-info autohide">
                    {{ session('status') }}
                </div>
            @endif
        </div>

        <div class="general-options">

            <form id="frmFilter" role="search" method="get" action="{{ route('admin.teams') }}">
                <div class="row filters d-none m-0 border-bottom {{ $filterCategory ? 'd-block' : '' }}">
                    <div class="col-12 col-sm-7 col-md-6 col-xl-4 p-3">
                        <h5 class="p-0">Filtros</h5>
                        <select name="filterCategory" id="filterCategory" class="form-control" onchange="setCategoryFilter()">
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

                {{-- <div class="actions"> --}}
                <div class="btn-toolbar px-3 d-block d-md-none" role="toolbar">
                    <div class="btn-group tableOptions" role="group">
                        <button id="addon-new" onclick="location.href='{{ route('admin.teams.add') }}'" type="button" class="btn btn-primary mr-1" data-toggle="button">
                            Nuevo
                        </button>
                        <button id="addon-filter" type="button" class="btn input-group-text {{ $filterCategory ? 'active' : '' }}" data-toggle="button" aria-pressed="{{ $filterCategory ? 'true' : 'false' }}" autocomplete="off" onclick="showHideFilters()">
                            <i class="fas fa-filter"></i>
                        </button>
                        <button id="addon-import" type="button" class="btn input-group-text" data-toggle="button" onclick="">
                            <i class="fas fa-file-import"></i>
                        </button>
                        <button id="addon-export" type="button" class="btn input-group-text dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-file-export"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right my-1" aria-labelledby="addon-export">
                            <a class="dropdown-item text-secondary" href="{{ route('admin.teams.export.file',['type'=>'xls']) }}">
                                <span class="fas fa-file-export fa-fw mr-1"></span>
                                <span>Exportar (.xls)</span>
                            </a>
                            <a class="dropdown-item text-secondary" href="{{ route('admin.teams.export.file',['type'=>'xlsx']) }}">
                                <span class="fas fa-file-export fa-fw mr-1"></span>
                                <span>Exportar (.xlsx)</span>
                            </a>
                            <a class="dropdown-item text-secondary" href="{{ route('admin.teams.export.file',['type'=>'csv']) }}">
                                <span class="fas fa-file-export fa-fw mr-1"></span>
                                <span>Exportar (.csv)</span>
                            </a>
                        </div>

  <div class="input-group ml-1">
    <input type="text" class="form-control" placeholder="Buscar..." aria-label="Input group example" aria-describedby="btnGroupAddon">
    <div class="input-group-append">
      <div class="input-group-text" id="btnGroupAddon">
          <i class="fas fa-search"></i>
      </div>
    </div>
  </div>
                    </div>

                    <div class="btn-group d-none rowOptions" role="group">
                        <button type="button" class="btn btn-danger mr-1" data-toggle="button" onclick="destroyMany()">
                            <i class="fas fa-trash mr-2"></i>Eliminar
                        </button>
                        <button type="button" class="btn btn-outline-secondary input-group-text" data-toggle="button" onclick="duplicateMany()">
                            <i class="fas fa-clone"></i>
                        </button>
                        <button id="row-addon-export" type="button" class="btn btn-outline-secondary input-group-text dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-file-export"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right my-1" aria-labelledby="row-addon-export">
                            <a class="dropdown-item text-secondary" href="{{ route('admin.teams.export.file',['type'=>'xls']) }}">
                                <span class="fas fa-file-export fa-fw mr-1"></span>
                                <span>Exportar (.xls)</span>
                            </a>
                            <a class="dropdown-item text-secondary" href="{{ route('admin.teams.export.file',['type'=>'xlsx']) }}">
                                <span class="fas fa-file-export fa-fw mr-1"></span>
                                <span>Exportar (.xlsx)</span>
                            </a>
                            <a class="dropdown-item text-secondary" href="{{ route('admin.teams.export.file',['type'=>'csv']) }}">
                                <span class="fas fa-file-export fa-fw mr-1"></span>
                                <span>Exportar (.csv)</span>
                            </a>
                        </div>
                    </div>

                </div> {{-- toolbar --}}
                <span class="text-muted rowCountSelected px-3 d-block d-md-none" style="font-size: .8em"></span>

            </form>

        </div> {{-- general-options --}}

        <table class="table table-borderless mb-0">

            <thead>
                <tr class="border-top">
                    <th width="1" scope="col" class="pr-0">
                        <div class="pretty p-icon p-jelly">
                            <input type="checkbox" id="allMark" onchange="showHideAllRowOptions()">
                            <div class="state p-primary">
                                <i class="icon material-icons">done</i>
                                <label></label>
                            </div>
                        </div>
                    </th>
                    <th scope="col" colspan="2" class="pl-0">Equipo</th>
                    <th width="32" scope="col"></th>
                </tr>
            </thead>

            @foreach ($teams as $team)
                <tr class="border-top animated fadeIn">
                    <td width="1" class="select align-middle pr-0">
                        <div class="pretty p-icon p-jelly">
                            <input type="checkbox" class="mark" value="{{ $team->id }}" name="teamId[]" onchange="showHideRowOptions(this)">
                            <div class="state p-primary">
                                <i class="icon material-icons">done</i>
                                <label></label>
                            </div>
                        </div>
                    </td>
                    <td width="32" class="logo align-middle px-0" onclick="rowSelect(this)">
                        @if ($team->logo)
                            <img src="{{ @get_headers(asset($team->logo)) ? asset($team->logo) : asset('img/teams/broken.png') }}" alt="" width="32">
                        @else
                            <img src="{{ asset('img/no-photo.png') }}" alt="" width="32">
                        @endif
                    </td>
                    <td class="name align-middle" onclick="rowSelect(this)">
                        <span class="name d-inline-block text-truncate" style="max-width: 165px">{{ $team->name }}</span>
                        <span class="d-block">
                            <small class="text-black-50 text-uppercase">{{ $team->category->name }}</small>
                        </span>
                    </td>
                    <td class="actions align-middle">
                        <a id="btnRegActions" class="btn btn-link dropdown-toggle" data-toggle="dropdown">
                            <i class="fas fa-ellipsis-h text-secondary"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right my-1" aria-labelledby="btnRegActions">
                            <a class="dropdown-item text-secondary" href="{{ route('admin.teams.duplicate', $team->id) }}">
                                <i class="fas fa-clone fa-fw mr-1"></i>
                                Duplicar
                            </a>
                            <a class="dropdown-item text-secondary" href="">
                                <i class="fas fa-edit fa-fw mr-1"></i>
                                Editar
                            </a>
                            <form id="formDelete{{ $team->id }}" action="{{ route('admin.teams.destroy', $team->id) }}" method="post" class="d-inline">
                                {{ csrf_field() }}
                                {{ method_field('delete') }}
                                <a class="dropdown-item text-danger" onclick="destroy('{{ $team->id }}', '{{ $team->name }}' )" value="Eliminar">
                                    <i class="fas fa-trash fa-fw mr-1"></i>
                                    Eliminar
                                </a>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </table>

        <div class="clearfix border-top p-3 regs-info">
            @if ($teams->count() > 0)
                <div class="float-left regs-info align-baseline">Registros: {{ $teams->firstItem() }}-{{ $teams->lastItem() }} de {{ $teams->total() }}</div>
                <div class="float-right">{!! $teams->appends(Request::all())->render() !!}</div>
            @else
                <div class="text-center">
                    No se han encontrado registros
                </div>
            @endif
        </div>
    </div> {{-- col --}}
</div> {{-- row --}}

@endsection


@section('right-side')
    <span class="d-block py-3 text-muted rowCountSelected">Elementos seleccionados</span>
    <div class="tableOptions animated fadeIn">
        <div class="text-center">
            <a href="{{ route('admin.teams.add') }}" class="btn btn-primary btn-block" id="btnAdd">
                <span>Crear nuevo equipo</span>
            </a>
        </div>
        <ul class="list-group border-top mt-3">
            <li class="list-group-item border-0">
                <a href="{{ route('admin.teams.export.file',['type'=>'xls']) }}">
                    <span class="fas fa-file-export fa-fw mr-1"></span>
                    <span>Exportar (.xls)</span>
                </a>
            </li>
            <li class="list-group-item border-0">
                <a href="{{ route('admin.teams.export.file',['type'=>'xlsx']) }}">
                    <span class="fas fa-file-export fa-fw mr-1"></span>
                    <span>Exportar (.xlsx)</span>
                </a>
            </li>
            <li class="list-group-item border-0">
                <a href="{{ route('admin.teams.export.file',['type'=>'csv']) }}">
                    <span class="fas fa-file-export fa-fw mr-1"></span>
                    <span>Exportar (.csv)</span>
                </a>
            </li>
            <li class="list-group-item border-0">
                <a href="">
                    <span class="fas fa-file-import fa-fw mr-1"></span>
                    <span>Importar</span>
                </a>
            </li>
        </ul>
    </div>

    <div class="rowOptions animated fadeIn d-none">
        <div class="text-center">
            <a href="" class="btn btn-danger btn-block" onclick="destroyMany()">
                <span>Eliminar</span>
            </a>
        </div>
        <ul class="list-group border-top mt-3">
            <li class="list-group-item border-0">
                <a href="" onclick="duplicateMany()">
                    <span class="fas fa-clone fa-fw mr-1"></span>
                    <span>Duplicar</span>
                </a>
            </li>
            <li class="list-group-item border-0">
                <a href="{{ route('admin.teams.export.file',['type'=>'xls', $filterCategory, $filterName]) }}">
                    <span class="fas fa-file-export fa-fw mr-1"></span>
                    <span>Exportar (.xls)</span>
                </a>
            </li>
            <li class="list-group-item border-0">
                <a href="{{ route('admin.teams.export.file',['type'=>'xlsx', $filterCategory, $filterName]) }}">
                    <span class="fas fa-file-export fa-fw mr-1"></span>
                    <span>Exportar (.xlsx)</span>
                </a>
            </li>
            <li class="list-group-item border-0">
                <a href="{{ route('admin.teams.export.file',['type'=>'csv', $filterCategory, $filterName]) }}">
                    <span class="fas fa-file-export fa-fw mr-1"></span>
                    <span>Exportar (.csv)</span>
                </a>
            </li>
        </ul>
    </div>

@endsection


@section('js')
<script>
    $(document).ready(function() {
        $("#inpSearch").focus(function(){
            $(this).select();
        });
        Mousetrap.bind(['command+a', 'ctrl+a'], function() {
            var url = $("#btnAdd").attr('href');
            $(location).attr('href', url);
            return false;
        });
        Mousetrap.bind(['command+f', 'ctrl+f'], function() {
            $('#filterName').focus();
            return false;
        });
    });

    function showHideFilters() {
        if ($(".filters").is(':visible')) {
            $(".filters").removeClass('d-block fadeIn');
            $(".filters").addClass('d-none');
        } else {
            $(".filters").removeClass('d-none');
            $(".filters").addClass('d-block fadeIn');
        }
    }

    function setCategoryFilter() {
        $("#frmFilter").submit();
    }

    function destroy(id, name) {
        swal({
            title: "¿Estás seguro?",
            text: 'Se va a eliminar el equipo "' + name + '". No se podrán deshacer los cambios!',
            buttons: {
                confirm: {
                    text: "Sí, estoy seguro",
                    value: true,
                    visible: true,
                    className: "btn btn-danger",
                    closeModal: true
                },
                cancel: {
                    text: "No, cancelar",
                    value: null,
                    visible: true,
                    className: "btn btn-secondary",
                    closeModal: true,
                }
            },
            closeOnClickOutside: false,
        })
        .then((value) => {
            if (value) {
                $("#formDelete"+id).submit();
            }
        });
    }

    function destroyMany() {
        window.event.preventDefault();
        disabledActionsButtons();
        swal({
            title: "¿Estás seguro?",
            text: 'Se van a eliminar los equipos seleccionados. No se podrán deshacer los cambios!',
            buttons: {
                confirm: {
                    text: "Sí, estoy seguro",
                    value: true,
                    visible: true,
                    className: "btn btn-danger",
                    closeModal: true
                },
                cancel: {
                    text: "No, cancelar",
                    value: null,
                    visible: true,
                    className: "btn btn-secondary",
                    closeModal: true,
                }
            },
            closeOnClickOutside: false,
        })
        .then((value) => {
            if (value) {
                var ids = [];
                $(".mark:checked").each(function() {
                    ids.push($(this).val());
                });
                var url = '{{ route("admin.teams.destroy.many", ":ids") }}';
                url = url.replace(':ids', ids);
                window.location.href=url;
            } else {
                enabledActionsButtons();
            }
        });
    }

    function duplicateMany() {
        window.event.preventDefault();
        disabledActionsButtons();
        var ids = [];
        $(".mark:checked").each(function() {
            ids.push($(this).val());
        });
        var url = '{{ route("admin.teams.duplicate.many", ":ids") }}';
        url = url.replace(':ids', ids);
        window.location.href=url;
    }

    function rowSelect(element) {
        $(element).siblings('.select').find('.mark').trigger('click');
    }

    function showHideRowOptions(element) {
        if ($(element).is(':checked')) {
            $(element).parents('tr').addClass('selected');
        } else {
            $(element).parents('tr').removeClass('selected');
        }

        if ($(".mark:checked").length > 0) {
            if (!$(".rowOptions").is(':visible')) {
                $(".rowOptions").removeClass('d-none');
                $(".tableOptions").addClass('d-none');
            }
        } else {
            if ($(".rowOptions").is(':visible')) {
                $(".rowOptions").addClass('d-none');
                $(".tableOptions").removeClass('d-none');
            }
        }
        if ($(".mark:checked").length > 0) {
            $(".rowCountSelected").text('Elementos seleccionados: ' + $(".mark:checked").length);
        } else {
            $(".rowCountSelected").text('Elementos seleccionados');
        }
    }

    function showHideAllRowOptions() {
        if ($("#allMark").is(':checked')) {
            $(".mark").prop('checked', true);
            $(".mark").parents('tr').addClass('selected');
        } else {
            $(".mark").prop('checked', false);
            $(".mark").parents('tr').removeClass('selected');
        }
        showHideRowOptions();
    }

    function disabledActionsButtons() {
        $('a').addClass('disabled');
        $('button').attr("disabled", "disabled");
    }

    function enabledActionsButtons() {
        $('a').removeClass('disabled');
        $('button').removeAttr("disabled");
    }
</script>
@endsection
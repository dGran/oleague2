<script>
    var filterUser = {!! json_encode($filterUser) !!};
    var filterTable = {!! json_encode($filterTable) !!};
    var filterType = {!! json_encode($filterType) !!};
    var order = {!! json_encode($order) !!};
    var pagination = {!! json_encode($pagination) !!};

    $(function() {
        Mousetrap.bind(['command+f', 'ctrl+f'], function() {
            $('.search-input').focus();
            return false;
        });

        $('.search-clear').on("click", function() {
            $('.search-input').val('');
            $('.frmFilter').submit();
        });
        $('.search-input').on("blur", function() {
            // $(this).val(filterName);
        });

    });

    function applyDisplay() {
        $('.frmFilter').submit();
    }

    function applyOrder() {
        $('.frmFilter').submit();
    }

    function cancelFilterName() {
        window.event.preventDefault();
        $('.filterName').val('');
        if (order || pagination) {
            $('.frmFilter').submit();
        } else {
            cancelFilters();
        }
    }

    function cancelFilters() {
        window.location.href = '{{ route("admin") }}';
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
            if ($(".mark:checked").length == 1) {
                $(".rowOptions-Edit").removeClass('d-none');
                $(".rowOptions-View").removeClass('d-none');
            } else {
                $(".rowOptions-Edit").addClass('d-none');
                $(".rowOptions-View").addClass('d-none');
            }
        } else {
            if ($(".rowOptions").is(':visible')) {
                $(".rowOptions").addClass('d-none');
                $(".tableOptions").removeClass('d-none');
            }
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

    function export_file(type) {
        window.event.preventDefault();

        swal({
            title: "Exportar todos los registros",
            text: 'Introduce nombre del archivo (opcional)',
            content: "input",
            buttons: {
                cancel: {
                    text: "Cancelar",
                    value: null,
                    visible: true,
                    className: "btn btn-secondary",
                    closeModal: true,
                },
                confirm: {
                    text: "Continuar",
                    value: true,
                    visible: true,
                    className: "btn btn-primary",
                    closeModal: true
                }
            },
        })
        .then((value) => {
            if (value) {
                var filename = `${value}`;
                if (!filename ) {
                    var time = Math.floor(new Date().getTime() / 1000);
                    var filename = 'logs_export' + time;
                }
                $(location).attr('href', 'databases_jugadores/exportar/' + filename + '/' + type + '/' + filterUser + '/' + filterTeam '/' + filterType '/' + order);
            }
        });
    }

    function export_file_selected(type) {
        window.event.preventDefault();

        var ids = [];
        $(".mark:checked").each(function() {
            ids.push($(this).val());
        });

        swal({
            title: "Exportar los registros seleccionados",
            text: 'Introduce nombre del archivo (opcional)',
            content: "input",
            buttons: {
                cancel: {
                    text: "Cancelar",
                    value: null,
                    visible: true,
                    className: "btn btn-secondary",
                    closeModal: true,
                },
                confirm: {
                    text: "Continuar",
                    value: true,
                    visible: true,
                    className: "btn btn-primary",
                    closeModal: true
                }
            },
        })
        .then((value) => {
            if (value) {
                var filename = `${value}`;
                if (!filename ) {
                    var time = Math.floor(new Date().getTime() / 1000);
                    var filename = 'databases_jugadores_export' + time;
                }
                $(location).attr('href', 'databases_jugadores/exportar/' + filename + '/' + type + '/' + filterUser + '/' + filterTable + '/' + filterType + '/' + order + '/' + ids);
            }
        });
    }

    function import_file() {
        window.event.preventDefault();
        swal({
            title: "Importar datos",
            text: 'Se van a importar los datos del archivo seleccionado, pulsa continuar y selecciona el archivo que contiene los datos (.xls, .xlsx, .csv).',
            buttons: {
                cancel: {
                    text: "Cancelar",
                    value: null,
                    visible: true,
                    className: "btn btn-secondary",
                    closeModal: true,
                },
                confirm: {
                    text: "Continuar",
                    value: true,
                    visible: true,
                    className: "btn btn-primary",
                    closeModal: true
                }
            },
            closeOnClickOutside: false,
        })
        .then((value) => {
            if (value) {
                $("#import_file").trigger('click');
            }
        });
    }

    $('#import_file').change(function(){
        $("#frmImport").submit();
    });

</script>
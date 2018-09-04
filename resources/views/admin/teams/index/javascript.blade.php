<script>
    var filterName = {!! json_encode($filterName) !!};
    var filterCategory = {!! json_encode($filterCategory) !!};
    var order = {!! json_encode($order) !!};
    var pagination = {!! json_encode($pagination) !!};

    $(function() {
        Mousetrap.bind(['command+a', 'ctrl+a'], function() {
            var url = $("#btnAdd").attr('href');
            $(location).attr('href', url);
            return false;
        });
        Mousetrap.bind(['command+f', 'ctrl+f'], function() {
            $('.search-input').focus();
            return false;
        });

        $('.search-clear').on("click", function() {
            $('.search-input').val('');
            $('.frmFilter').submit();
        });
        $('.search-input').on("blur", function() {
            $(this).val(filterName);
        });
    });

    function applyDisplay() {
        $('.frmFilter').submit();
    }

    function applyOrder() {
        $('.frmFilter').submit();
    }

    function applyfilterCategory() {
        $('.frmFilter').submit();
    }

    function cancelFilterName() {
        window.event.preventDefault();
        $('.filterName').val('');
        if (filterCategory) {
            $('.frmFilter').submit();
        } else {
            cancelFilters();
        }
    }

    function cancelFilterCategory() {
        window.event.preventDefault();
        $('.filterCategory').val('0');
        if (filterName) {
            $('.frmFilter').submit();
        } else {
            cancelFilters();
        }
    }

    function cancelFilters() {
        window.location.href = '{{ route("admin.teams") }}';
    }

    function destroy(id, name) {
        window.event.preventDefault();
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

    function import_file() {
        swal({
            title: "¿Estás seguro?",
            text: 'Se van a importar los datos del archivo seleccionado.',
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
                $("#import_file").trigger('click');
                $("#import_file").change(function() {
                    $("#frmImport").submit();
                });
            }
        });
    }

    function import_file_load() {
    }
</script>
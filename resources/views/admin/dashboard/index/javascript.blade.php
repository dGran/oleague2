<script>
    var filterDescription = {!! json_encode($filterDescription) !!};
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
            $(this).val(filterDescription);
        });

        $('[data-toggle="popover"]').popover();

    });

    function applyDisplay() {
        $('.frmFilter').submit();
    }

    function applyOrder() {
        $('.frmFilter').submit();
    }

    function applyfilterUser() {
        $('.frmFilter').submit();
    }

    function cancelFilterDescription() {
        window.event.preventDefault();
        $('.filterDescription').val('');
        if (filterUser || filterTable || filterType || order || pagination) {
            $('.frmFilter').submit();
        } else {
            cancelFilters();
        }
    }

    function cancelFilterUser() {
        window.event.preventDefault();
        $('.filterUser').val('0');
        if (filterDescription || filterTable || filterType || order || pagination) {
            $('.frmFilter').submit();
        } else {
            cancelFilters();
        }
    }

    function cancelFilterTable() {
        window.event.preventDefault();
        $('.filterTable').val('');
        if (filterDescription || filterUser || filterType || order || pagination) {
            $('.frmFilter').submit();
        } else {
            cancelFilters();
        }
    }

    function cancelFilterType() {
        window.event.preventDefault();
        $('.filterType').val('');
        if (filterDescription || filterUser || filterTable || order || pagination) {
            $('.frmFilter').submit();
        } else {
            cancelFilters();
        }
    }

    function cancelFilters() {
        window.location.href = '{{ route("admin") }}';
    }

    function submitFilterForm() {
        $('input').keypress(function (e) {
            if (e.which == 13) {
                $('.frmFilter').submit();
            }
        });
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
                    closeModal: true,
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
                $(location).attr('href', 'admin/logs/exportar/' + filename + '/' + type + '/' + filterDescription + '/' + filterUser + '/' + filterTable + '/' + filterType + '/' + order);
            }
        });
    }

</script>
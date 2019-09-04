<script>
    $('.search-clear').on("click", function() {
        if ($('.search-input').val() != '') {
            $('.search-input').val('');
            $('.frmFilter').submit();
        }
    });
    $('.search-input').keydown(function(e){
        if (e.keyCode == 27) {
            $(this).val('');
        }
    });

    $('#viewModal').on('show.bs.modal', function(e) {
        var id = $(e.relatedTarget).attr("data-id");
        var url = '{{ route("market.playerView", ":id") }}';
        url = url.replace(':id', id);
        $.ajax({
            url         : url,
            type        : 'GET',
            datatype    : 'html',
        }).done(function(data){
            $('#modal-dialog-view').html(data);
        });
    });

    $("#viewModal").on("hidden.bs.modal", function(){
        $('#modal-dialog-view').html("");
    });

    function ApplyFilters() {
        window.event.preventDefault();
        disabledActionsButtons();
        $('.frmFilter').submit();
    }

    function matchFilterName() {
        $('.filterName').val($('.filterName').val());
    }

    function submitFilterForm() {
        matchFilterName();
        $('.filterName').keypress(function (e) {
            if (e.which == 13) {
                $('.frmFilter').submit();
            }
        });
    }
</script>
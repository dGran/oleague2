<script>
    var filterOverallRangeFrom = {!! json_encode($filterOverallRangeFrom) !!};
    var filterOverallRangeTo = {!! json_encode($filterOverallRangeTo) !!};
    var filterClauseRangeFrom = {!! json_encode($filterClauseRangeFrom) !!};
    var filterClauseRangeTo = {!! json_encode($filterClauseRangeTo) !!};
    var filterAgeRangeFrom = {!! json_encode($filterAgeRangeFrom) !!};
    var filterAgeRangeTo = {!! json_encode($filterAgeRangeTo) !!};
    var filterHeightRangeFrom = {!! json_encode($filterHeightRangeFrom) !!};
    var filterHeightRangeTo = {!! json_encode($filterHeightRangeTo) !!};

    $("#overall_range").ionRangeSlider({
        skin: "big",
        type: "double",
        grid: true,
        min: 50,
        max: 99,
        step: 1,
        from: filterOverallRangeFrom,
        to: filterOverallRangeTo,
        grid: true,
        grid_num: 6,
    });

    function setBallOverallRange(from, to) {
        $("#overall_range").data("ionRangeSlider").update({
            from: from,
            to: to
        });
    }

    $("#clause_range").ionRangeSlider({
        skin: "big",
        type: "double",
        grid: true,
        min: 0,
        max: 500,
        step: 1,
        from: filterClauseRangeFrom,
        to: filterClauseRangeTo,
        grid: true,
        grid_num: 10,
        prefix: "mill. "
    });

    $("#age_range").ionRangeSlider({
        skin: "big",
        type: "double",
        grid: true,
        min: 15,
        max: 45,
        step: 1,
        from: filterAgeRangeFrom,
        to: filterAgeRangeTo,
        grid: true,
        grid_num: 10,
        prefix: "años "
    });

    function setAgeRange(from, to) {
        $("#age_range").data("ionRangeSlider").update({
            from: from,
            to: to
        });
    }

    $("#height_range").ionRangeSlider({
        skin: "big",
        type: "double",
        grid: true,
        min: 150,
        max: 210,
        step: 1,
        from: filterHeightRangeFrom,
        to: filterHeightRangeTo,
        grid: true,
        grid_num: 10,
        prefix: "cm "
    });

    function setHeightRange(from, to) {
        $("#height_range").data("ionRangeSlider").update({
            from: from,
            to: to
        });
    }

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
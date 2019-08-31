<script>
    var filterOverallRangeFrom = {!! json_encode($filterOverallRangeFrom) !!};
    var filterOverallRangeTo = {!! json_encode($filterOverallRangeTo) !!};
    var filterSalePriceRangeFrom = {!! json_encode($filterSalePriceRangeFrom) !!};
    var filterSalePriceRangeTo = {!! json_encode($filterSalePriceRangeTo) !!};

    $("#overall_range").ionRangeSlider({
        skin: "big",
        type: "double",
        grid: true,
        min: 70,
        max: 99,
        step: 1,
        from: filterOverallRangeFrom,
        to: filterOverallRangeTo,
        grid: true,
        grid_num: 6,
        // prefix: "€"
    });

    $("#sale_price_range").ionRangeSlider({
        skin: "big",
        type: "double",
        grid: true,
        min: 0,
        max: 500,
        step: 5,
        from: filterSalePriceRangeFrom,
        to: filterSalePriceRangeTo,
        grid: true,
        grid_num: 10,
        // prefix: "€"
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
        // var low = $('#overall_range').data().from;
        // var high = $('#overall_range').data().to;
        $('.frmFilter').submit();
    }
</script>
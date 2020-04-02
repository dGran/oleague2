<script>
    var season_slug = {!! json_encode(active_season()->slug) !!};

    $(function() {
        // $('#matchDetailsModal').on('show.bs.modal', function(e) {

        // });

        $("#matchDetailsModal").on("hidden.bs.modal", function(){
            $('#modal-dialog-match-details').html("");
        });

    });

    function item_enter(id) {
        $('#competition_link'+id).addClass('d-block');
    }

    function item_leave(id) {
        $('#competition_link'+id).removeClass('d-block');
    }

	function view_match_detail(element) {
		window.event.preventDefault();
		var url = $(element).attr('href');
		$('#matchDetailsModal').modal('show');
        $.ajax({
            url         : url,
            type        : 'GET',
            datatype    : 'html',
        }).done(function(data){
            $('#modal-dialog-match-details').html(data);
        });
	}

</script>
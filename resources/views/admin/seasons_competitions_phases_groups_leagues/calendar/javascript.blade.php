<script>
    var competition_slug = {!! json_encode($group->phase->competition->slug) !!};
    var phase_slug = {!! json_encode($group->phase->slug) !!};
    var group_slug = {!! json_encode($group->slug) !!};

    $(function() {
    	$("#second_round").click(function(){
    		// $("#inverse_order").attr('disabled', !$("#inverse_order").attr('disabled'));
	    	if ($("#second_round").prop('checked')) {
	    		$("#inverse_order").attr('disabled', false);
	    		$("#lbinverse_order").removeClass('text-muted');
	    	} else {
	    		$("#inverse_order").attr('disabled', true);
	    		$("#inverse_order").prop('checked', false);
	    		$("#lbinverse_order").addClass('text-muted');
	    	}
    	});

        $('#updateModal').on('show.bs.modal', function(e) {
            var row = $(e.relatedTarget).parents('tr');
            var id = row.attr("data-id");
            $.ajax({
                url: 'calendario/partido/' + id,
                type        : 'GET',
                datatype    : 'html',
            }).done(function(data){
                $('#modal-dialog-update').html(data);
            });
        });

        $("#updateModal").on("hidden.bs.modal", function(){
            $('#modal-dialog-update').html("");
        });

    });

    function generate() {
		window.event.preventDefault();
		$('#frmGenerate').submit();
    }

</script>
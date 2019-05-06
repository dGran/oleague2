<script>
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

    });

    function generate() {
		window.event.preventDefault();
		$('#frmGenerate').submit();
    }

</script>
<script>
	$(document).ready(function() {
		$('#frmSendOffer').submit(function(){
			$('.btn_submit').prop('disabled', true);
		});
 	});

 	function submit_cesion() {
 		$('#cesion').val(1);
 		$('#frmSendOffer').submit();
 	}
</script>
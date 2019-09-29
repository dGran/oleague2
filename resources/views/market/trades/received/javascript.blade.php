<script>
	$("#btn_accept").click(function(){
		window.event.preventDefault();

		disabledActionsButtons();
		var url = $("#btn_accept").attr('href');
		window.location.href = url;
	});

	$("#btn_decline").click(function(){
		window.event.preventDefault();

		disabledActionsButtons();
		var url = $("#btn_decline").attr('href');
		window.location.href = url;
	});
</script>

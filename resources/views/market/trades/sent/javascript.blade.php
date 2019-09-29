<script>
	$("#btn_delete").click(function(){
		window.event.preventDefault();

		disabledActionsButtons();
		var url = $("#btn_delete").attr('href');
		window.location.href = url;
	});

	$("#btn_retire").click(function(){
		window.event.preventDefault();

		disabledActionsButtons();
		var url = $("#btn_retire").attr('href');
		window.location.href = url;
	});
</script>

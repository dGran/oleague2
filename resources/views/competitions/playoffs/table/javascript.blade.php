<script>
	$("#show_button").click(function() {
		if ($('.final-results').hasClass('compressed')) {
			$('.final-results').removeClass('compressed');
			$(this).text('Vista comprimida');
		} else {
			$('.final-results').addClass('compressed');
			$(this).text('Resultados completos');
		}
	});
</script>
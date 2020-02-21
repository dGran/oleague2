<script>
	jQuery(function($) {
		$('#season_selector').on('change', function() {
			var url = $(this).val();
			if (url) {
				window.location = url;
			}
			return false;
		});
	});
</script>
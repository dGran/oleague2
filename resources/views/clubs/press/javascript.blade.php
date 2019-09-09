<script>
	{{--
	$(document).ready(function () {
		$('#description').summernote({
		  toolbar: [
		    ['style', ['bold', 'italic', 'underline', 'clear']],
		    ['font', ['strikethrough', 'superscript', 'subscript']],
		    ['fontsize', ['fontsize']],
		    ['color', ['color']],
		    ['para', ['ul', 'ol', 'paragraph']],
		    ['height', ['height']]
		  ]
		});
	});
	--}}

    function titleCounterFocus() {
        $('#title_counter').removeClass('d-none');
    }

    function titleCounter() {
        $('#title_counter').text($('#title').val().length + ' / 40');
    }

    function titleCounterBlur() {
        $('#title_counter').addClass('d-none');
    }

    function descriptionCounterFocus() {
        $('#description_counter').removeClass('d-none');
    }

    function descriptionCounter() {
        $('#description_counter').text($('#description').val().length + ' / 120');
    }

    function descriptionCounterBlur() {
        $('#description_counter').addClass('d-none');
    }
</script>
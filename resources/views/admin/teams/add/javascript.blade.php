<script>
    $(function() {
        Mousetrap.bind(['command+s', 'ctrl+s'], function() {
            $("#frmAdd").submit();
            return false;
        });
        Mousetrap.bind(['command+c', 'ctrl+c'], function() {
            var url = $("#btnCancel").attr('href');
            $(location).attr('href', url);
            return false;
        });

        $('#new_parent').change(function(){
            if ($('#new_parent').is(':checked')) {
                $('#team_category_id').parent().removeClass('d-inline-block');
                $('#team_category_id').parent().addClass('d-none');
                $('#team_category_name').removeClass('d-none');
                $('#team_category_name').addClass('d-inline-block');
                $('#team_category_name').focus();
            } else {
                $('#team_category_id').parent().removeClass('d-none');
                $('#team_category_id').parent().addClass('d-inline-block');
                $('#team_category_name').removeClass('d-inline-block');
                $('#team_category_name').addClass('d-none');
            }
        });

        var animationEnd = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
        // logo preview
        $('#logo_field').change(function(){
            var reader = new FileReader();
            reader.onload = function (e) {
                // get loaded data and render thumbnail.
                $('.preview').removeClass('d-none').addClass('d-block animated bounceIn').one(animationEnd, function() {
                    $(this).removeClass('animated bounceIn');
                });
                $('#logo_preview').attr('src', e.target.result);
            };
            // read the image file as a data URL.
            reader.readAsDataURL(this.files[0]);
            $('#logo_remove').removeClass('d-none').addClass('d-inline-block');
        });
        // logo preview remove
        $('#logo_remove').click(function(){
            $('.preview').addClass('animated bounceOut').one(animationEnd, function() {
                $(this).removeClass('d-block animated bounceOut').addClass('d-none');
                $("#logo_field").val("");
                $('#logo_preview').attr('src', '');
                $('#logo_remove').removeClass('d-inline-block').addClass('d-none');
            });
        });


        $("#frmAdd").submit(function(event) {
            $("#btnSave").attr("disabled", "disabled");
        });
    });

</script>
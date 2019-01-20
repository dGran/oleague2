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
                $('#players_db_id').parent().removeClass('d-inline-block');
                $('#players_db_id').parent().addClass('d-none');
                $('#players_db_name').removeClass('d-none');
                $('#players_db_name').addClass('d-inline-block');
                $('#players_db_name').focus();
            } else {
                $('#players_db_id').parent().removeClass('d-none');
                $('#players_db_id').parent().addClass('d-inline-block');
                $('#players_db_name').removeClass('d-inline-block');
                $('#players_db_name').addClass('d-none');
            }
        });

        var animationEnd = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
        // img preview
        $('#img_field').change(function(){
            var reader = new FileReader();
            reader.onload = function (e) {
                // get loaded data and render thumbnail.
                $('.preview').removeClass('d-none').addClass('d-block animated bounceIn').one(animationEnd, function() {
                    $(this).removeClass('animated bounceIn');
                });
                $('#img_preview').attr('src', e.target.result);
            };
            // read the image file as a data URL.
            reader.readAsDataURL(this.files[0]);
            $('#img_remove').removeClass('d-none').addClass('d-inline-block');
        });
        // img preview remove
        $('#img_remove').click(function(){
            $('.preview').addClass('animated bounceOut').one(animationEnd, function() {
                $(this).removeClass('d-block animated bounceOut').addClass('d-none');
                $("#img_field").val("");
                $('#img_preview').attr('src', '');
                $('#img_remove').removeClass('d-inline-block').addClass('d-none');
            });
        });


        $("#frmAdd").submit(function(event) {
            $("#btnSave").attr("disabled", "disabled");
        });
    });

</script>
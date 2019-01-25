<script>
    $(function() {
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

        $("#frmAdd").submit(function(event) {
            $("#btnSave").attr("disabled", "disabled");
        });
    });

</script>
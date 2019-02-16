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

        $("#frmImport").submit(function(event) {
            $("#loading").removeClass('d-none');
            $("#loading-info").removeClass('d-none');
            $("#btnSave").attr("disabled", "disabled");
            $("#btnSave").val('Importando, por favor espere..');
        });

        $('#import_file').change(function(){
            $("#file_name").removeClass('text-black-50');
            $("#file_name").addClass('text-success');
            $("#file_name").text(this.files[0].name);
        });
    });

</script>
<script>
    $("#frmDuplicate").submit(function(event) {
        $("#loading").removeClass('d-none');
        $("#loading-info").removeClass('d-none');
        $("#btnSave").attr("disabled", "disabled");
        $("#btnSave").val('Duplicando temporada, por favor espere..');
    });

</script>
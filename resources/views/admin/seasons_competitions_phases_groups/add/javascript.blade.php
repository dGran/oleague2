<script>
    $(function() {
        Mousetrap.bind(['command+s', 'ctrl+s'], function() {
            $("#frmAdd").submit();
            return false;
        });

        $("#frmAdd").submit(function(event) {
            $("#btnSave").attr("disabled", "disabled");
        });
    });

</script>
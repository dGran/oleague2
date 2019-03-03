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

        $("#frmAdd").submit(function(event) {
            $("#btnSave").attr("disabled", "disabled");
            if ($("#use_rosters").prop('checked')) {
                if ($("#players_db_id").val() > 0) {
                    $("#loading").removeClass('d-none');
                    $("#btnSave").val('Importando jugadores, por favor espere..');
                }
            } else {
                $("#players_db_id").val(0);
            }
        });

        $("#use_economy").click(function(){
            $(".initial_budget").toggleClass('d-none');
        });

        $("#use_rosters").click(function(){
            $(".roster_options").toggleClass('d-none');
        });
    });

</script>
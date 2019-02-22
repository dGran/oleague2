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
        });

        $("#use_economy").click(function(){
            $(".initial_budget").toggleClass('d-none');
        });

        $("#use_rosters").click(function(){
            $(".max_min_players").toggleClass('d-none');
        });
    });

</script>
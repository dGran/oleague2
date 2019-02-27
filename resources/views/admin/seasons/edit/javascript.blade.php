<script>
    $(function() {
        Mousetrap.bind(['command+s', 'ctrl+s'], function() {
            $("#frmEdit").submit();
            return false;
        });
        Mousetrap.bind(['command+c', 'ctrl+c'], function() {
            var url = $("#btnCancel").attr('href');
            $(location).attr('href', url);
            return false;
        });

        $("#frmEdit").submit(function(event) {
            $("#btnSave").attr("disabled", "disabled");
        });

        $("#use_economy").click(function(){
            if( $('#use_economy').prop('checked') ) {
                $(".initial_budget").removeClass('d-none');
                $(".initial_budget").addClass('d-block');
            } else {
                $(".initial_budget").addClass('d-none');
                $(".initial_budget").removeClass('d-block');
            }
        });

        $("#use_rosters").click(function(){
            if( $('#use_rosters').prop('checked') ) {
                $(".max_min_players").removeClass('d-none');
                $(".max_min_players").addClass('d-block');
            } else {
                $(".max_min_players").addClass('d-none');
                $(".max_min_players").removeClass('d-block');
            }
        });
    });

</script>
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

        $("#frmEdit").submit(function(event) {
            $("#btnSave").attr("disabled", "disabled");
        });

        $("#salary").keyup(function(){
            salaryChange();
        });

        $("#salary").change(function(){
            salaryChange();
        });

        $("#price").keyup(function(){
            priceChange();
        });

        $("#price").change(function(){
            priceChange();
        });

        function salaryChange() {
            if ($("#salary").val() == null || $("#salary").val() < 0.5) {
                $("#salary").val('0.5');
            }
            $("#price").val($("#salary").val() * 10);
        }

        function priceChange() {
            if ($("#price").val() == null || $("#price").val() < 5) {
                $("#price").val('5');
            }
            $("#salary").val($("#price").val() / 10);
        }
    });

</script>
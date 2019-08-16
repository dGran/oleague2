<script>
    $('#viewModal').on('show.bs.modal', function(e) {
        var id = $(e.relatedTarget).attr("data-id");
        $.ajax({
            url: 'mi-equipo/jugador/' + id,
            type        : 'GET',
            datatype    : 'html',
        }).done(function(data){
            $('#modal-dialog-view').html(data);
        });
    });

    $("#viewModal").on("hidden.bs.modal", function(){
        $('#modal-dialog-view').html("");
    });

    $('#editModal').on('show.bs.modal', function(e) {
        var id = $(e.relatedTarget).attr("data-id");
        $.ajax({
            url: 'mi-equipo/jugador/editar/' + id,
            type        : 'GET',
            datatype    : 'html',
        }).done(function(data){
            $('#modal-dialog-edit').html(data);
        });
    });

    $("#editModal").on("hidden.bs.modal", function(){
        $('#modal-dialog-edit').html("");
    });


    function changeSalary() {
        var value = $('#salary').val();
        var min = $('#salary').attr('min');
        var max = $('#salary').attr('max');

        if (value < min) {
            $('#salary').val(min);
        }
        if (value > max) {
            $('#salary').val(max);
        }

        $('#price').val($('#salary').val() * 10);
    }

    function changePrice() {
        var value = $('#price').val();
        var min = $('#salary').attr('min') * 10;

        if (value < min) {
            $('#price').val(min);
        }
        $('#salary').val($('#price').val() / 10);
    }
</script>
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

        console.log('salario maximo = ' + max);
        console.log('salario minimo = ' + min);

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

    function enableDisableSale() {
        if ($('#transferable').prop('checked') == true) {

            $('#untransferable').prop('checked', false);


            $('#sale_price').prop('disabled', false);
            $('#sale_auto_accept').prop('disabled', false);
            $('#sale_price').focus();
        } else {
            $('#sale_price').val('0');
            $('#sale_price').prop('disabled', true);
            $('#sale_auto_accept').prop('checked', false);
            $('#sale_auto_accept').prop('disabled', true);
        }
    }

    function untransferableChange() {
        if ($('#untransferable').prop('checked') == true) {
            $('#transferable').prop('checked', false);
            $('#sale_price').val('0');
            $('#sale_price').prop('disabled', true);
            $('#sale_auto_accept').prop('checked', false);
            $('#sale_auto_accept').prop('disabled', true);
        }
    }

    function phraseCounterFocus() {
        $('#phrase_counter').removeClass('d-none');
    }

    function phraseCounter() {
        $('#phrase_counter').text($('#market_phrase').val().length + ' / 80');
    }

    function phraseCounterBlur() {
        $('#phrase_counter').addClass('d-none');
    }
</script>
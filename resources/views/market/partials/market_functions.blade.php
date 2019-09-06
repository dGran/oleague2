<script>
    function addFavorite(player_id, participant_id) {
        disabledActionsButtons();
        var url = '{{ route("market.favorite_player.add", [":player_id", ":participant_id"]) }}';
        url = url.replace(':player_id', player_id);
        url = url.replace(':participant_id', participant_id);
        $('#player_favorite'+player_id+' i').removeClass('fab fa-gratipay');
        $('#player_favorite'+player_id+' i ').addClass('fas fa-spinner');
        $.ajax({
            url         : url,
            type        : 'GET',
            datatype    : 'html',
        }).done(function(data){
            $('#player_favorite'+player_id).html(data);
            $('#player_favorite'+player_id+' i').removeClass('fas fa-spinner');
            $('#player_favorite'+player_id+' i').addClass('fab fa-gratipay');
        });
        enabledActionsButtons();
    }

    function removeFavorite(player_id, participant_id) {
        disabledActionsButtons();
        var url = '{{ route("market.favorite_player.remove", [":player_id", ":participant_id"]) }}';
        url = url.replace(':player_id', player_id);
        url = url.replace(':participant_id', participant_id);
        $('#player_favorite'+player_id+' i').removeClass('fab fa-gratipay');
        $('#player_favorite'+player_id+' i').addClass('fas fa-spinner');
        $.ajax({
            url         : url,
            type        : 'GET',
            datatype    : 'html',
        }).done(function(data){
            $('#player_favorite'+player_id).html(data);
            $('#player_favorite'+player_id+' i').removeClass('fas fa-spinner');
            $('#player_favorite'+player_id+' i').addClass('fab fa-gratipay');
        });
        enabledActionsButtons();
    }

    function sign_free_player(id, name, remuneration) {
        window.event.preventDefault();
        swal({
            title: 'Fichar a "' + name + '"',
            text: 'Coste: ' + remuneration + ' millones.',
            buttons: {
                confirm: {
                    text: "Sí, estoy seguro",
                    value: true,
                    visible: true,
                    className: "btn btn-danger btn-sm",
                    closeModal: true
                },
                cancel: {
                    text: "No, cancelar",
                    value: null,
                    visible: true,
                    className: "btn btn-secondary btn-sm",
                    closeModal: true,
                }
            },
            closeOnClickOutside: false,
            closeOnEsc: false,
        })
        .then((value) => {
            if (value) {
                var url = '{{ route("market.sign_free_player", ":id") }}';
                url = url.replace(':id', id);
                window.location.href = url;
            }
        });
    }

    function pay_clause_player(id, name, remuneration) {
        window.event.preventDefault();
        value = parseFloat(remuneration);
        value_tax = value * 0.10;
        swal({
            title: 'Pagar claúsula de "' + name + '"',
            text: 'Coste: ' + value + ' + ' + value_tax  + ' millones.',
            buttons: {
                confirm: {
                    text: "Sí, estoy seguro",
                    value: true,
                    visible: true,
                    className: "btn btn-danger btn-sm",
                    closeModal: true
                },
                cancel: {
                    text: "No, cancelar",
                    value: null,
                    visible: true,
                    className: "btn btn-secondary btn-sm",
                    closeModal: true,
                }
            },
            closeOnClickOutside: false,
            closeOnEsc: false,
        })
        .then((value) => {
            if (value) {
                var url = '{{ route("market.pay_clause_player", ":id") }}';
                url = url.replace(':id', id);
                window.location.href = url;
            }
        });
    }
</script>
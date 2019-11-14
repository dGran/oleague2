<script>
    $(function() {
        $("#btnGenerateRounds").click(function(){
            window.event.preventDefault();
            var unique_round = $("#unique_round").prop('checked');
            var num_rounds = 0;
            var playoff_id = $(this).attr("data-id");

            swal({
                title: "¿Estás seguro?",
                text: 'Se van a generar las rondas.',
                buttons: {
                    confirm: {
                        text: "Sí, estoy seguro",
                        value: true,
                        visible: true,
                        className: "btn btn-danger",
                        closeModal: true
                    },
                    cancel: {
                        text: "No, cancelar",
                        value: null,
                        visible: true,
                        className: "btn btn-secondary",
                        closeModal: true,
                    }
                },
                closeOnClickOutside: false,
            })
            .then((value) => {
                if (value) {
                    var url = '{{ route("admin.season_competitions_phases_groups_playoffs.generate_rounds", [":playoff_id", ":num_rounds"]) }}';
                    url = url.replace(':playoff_id', playoff_id);
                    if (unique_round) {
                        num_rounds = 1;
                    }
                    url = url.replace(':num_rounds', num_rounds);
                    $(location).attr('href', url);
                }
            });
        });

        $("#btnResetRounds").click(function(){
            window.event.preventDefault();
            var playoff_id = $(this).attr("data-id");

            swal({
                title: "¿Estás seguro?",
                text: 'Se van a resetear todas las rondas y todos sus emparejamientos',
                buttons: {
                    confirm: {
                        text: "Sí, estoy seguro",
                        value: true,
                        visible: true,
                        className: "btn btn-danger",
                        closeModal: true
                    },
                    cancel: {
                        text: "No, cancelar",
                        value: null,
                        visible: true,
                        className: "btn btn-secondary",
                        closeModal: true,
                    }
                },
                closeOnClickOutside: false,
            })
            .then((value) => {
                if (value) {
                    var url = '{{ route("admin.season_competitions_phases_groups_playoffs.reset_rounds", ":playoff_id") }}';
                    url = url.replace(':playoff_id', playoff_id);
                    $(location).attr('href', url);
                }
            });
        });
    });

</script>
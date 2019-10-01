<script>
	$("#btn_accept").click(function(){
		window.event.preventDefault();
        swal({
            title: 'Confirmación',
            text: '¿Estás seguro que deseas aceptar la oferta?',
            buttons: {
                confirm: {
                    text: "Sí, estoy seguro",
                    value: true,
                    visible: true,
                    className: "btn btn-primary btn-sm",
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
				disabledActionsButtons();
				var url = $("#btn_accept").attr('href');
				window.location.href = url;
            }
        });
	});

	$("#btn_decline").click(function(){
		window.event.preventDefault();
        swal({
            title: 'Confirmación',
            text: '¿Estás seguro que deseas rechazar la oferta?',
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
				disabledActionsButtons();
				var url = $("#btn_decline").attr('href');
				window.location.href = url;
            }
        });
	});
</script>

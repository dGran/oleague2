<script>
	$("#btn_delete").click(function(){
		window.event.preventDefault();
        swal({
            title: 'Confirmación',
            text: '¿Estás seguro que deseas eliminar la oferta?',
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
				var url = $("#btn_delete").attr('href');
				window.location.href = url;
            }
        });
	});

	$("#btn_retire").click(function(){
		window.event.preventDefault();
        swal({
            title: 'Confirmación',
            text: '¿Estás seguro que deseas retirar la oferta?',
            buttons: {
                confirm: {
                    text: "Sí, estoy seguro",
                    value: true,
                    visible: true,
                    className: "btn btn-warning btn-sm text-white",
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
				var url = $("#btn_retire").attr('href');
				window.location.href = url;
            }
        });
	});
</script>

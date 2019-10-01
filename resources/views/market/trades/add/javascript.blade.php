<script>
	$(document).ready(function() {
		$('#frmSendOffer').submit(function(){
			$('.btn_submit').prop('disabled', true);
		});
 	});

 	function submit_cesion() {
		window.event.preventDefault();
        swal({
            title: 'Confirmación',
            text: '¿Estás seguro que deseas enviar la oferta de cesión?',
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
		 		$('#cesion').val(1);
 				$('#frmSendOffer').submit();
            }
        });
 	}

 	function submit_change() {
		window.event.preventDefault();
        swal({
            title: 'Confirmación',
            text: '¿Estás seguro que deseas enviar la oferta de intercambio?',
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
 				$('#frmSendOffer').submit();
            }
        });
 	}
</script>
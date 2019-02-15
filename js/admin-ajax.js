$ = jQuery.noConflict();

$(document).ready(function(){
	// obtener la url de admin-ajax.php
	//console.log(url_eliminar.ajaxurl)

	$('.borrar_registro').on('click', function(e){
		//previene el evento por default de un elemento determinado como la etiqueta a
		e.preventDefault()

		var id = $(this).attr('data-reservaciones')

		$.ajax({
			type: 'post',
			data: {
				'action' : 'lapizzeria_eliminar',
				'id' : id,
				'tipo' : 'eliminar'
			},
			url: url_eliminar.ajaxurl,
			success: function(data){
				//console.log(data)
				// convertir un json de php a un objeto javascript
				var resultado = JSON.parse(data)
				if (resultado.respuesta == 1) {
					$("[data-reservaciones='"+ resultado.id + "']").parent().parent().remove()
				} 
			}

		})
	})
})
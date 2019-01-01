<?php

function lapizzeria_guardar()
{
	global $wpdb;

	if (isset($_POST['enviar']) && $_POST['oculto'] == "1"):

		$nombre = sanitize_text_field( $_POST['nombre'] );
		$fecha = sanitize_text_field( $_POST['fecha'] );
		$correo = sanitize_text_field( $_POST['correo'] );
		$telefono = sanitize_text_field( $_POST['telefono'] );
		$mensaje = sanitize_text_field( $_POST['mensaje'] );

		$tabla = $wpdb->prefix . 'reservaciones';

		$datos = array(
		'nombre' => $nombre,
		'fecha' => $fecha,
		'correo' => $correo,
		'telefono' => $telefono,
		'mensaje' => $mensaje
		);

		$formato = array(
			'%s',
			'%s',
			'%s',
			'%s',
			'%s'
		);

		$wpdb->insert($tabla, $datos, $formato);

		$url = get_page_by_title( 'Gracias por su reserva' );
		wp_redirect( get_permalink($url->ID) );

		exit();

	endif;

}

//initi se ejecuta todo el tiempo que wordpress este ejecutandose
add_action( 'init', 'lapizzeria_guardar' );
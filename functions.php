<?php

function lapizzeria_styles()
{
	// REGISTRAR LOS ESTILOS
	wp_register_style('normalize', get_template_directory_uri() . '/css/normalize.css', array(), '8.0.1');

	//que cargue primero normalize
	wp_register_style('style', get_template_directory_uri() . '/style.css', array('normalize'), '1.0');
	
	// LLAMAR A LOS ESTILOS
	wp_enqueue_style('normalize');
	wp_enqueue_style('style');
}

add_action('wp_enqueue_scripts', 'lapizzeria_styles');
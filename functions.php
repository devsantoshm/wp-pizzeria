<?php

require get_template_directory() . '/inc/database.php';
// Funciones para las reservaciones
require get_template_directory() . '/inc/reservaciones.php';
// Crear opciones para el template
require get_template_directory() . '/inc/opciones.php';

function lapizzeria_setup()
{
	//habilitar imagen destacada en wp backend 
	add_theme_support( 'post-thumbnails' );
	
	add_image_size( 'nosotros', 367, 251, true );
	add_image_size( 'especialidades', 468, 315, true );
	add_image_size( 'especialidades_portrait', 435, 510, true );

	//Cambiar tamaño de imagenes por default thumbnail=small 
	update_option('thumbnail_size_w', 253);
	update_option('thumbnail_size_h', 164);
}

add_action( 'after_setup_theme', 'lapizzeria_setup' );

function lapizzeria_custom_logo()
{
	$logo = array(
		'height' => 220,
		'width' => 280
	);

	add_theme_support( 'custom-logo', $logo );
}

add_action( 'after_setup_theme', 'lapizzeria_custom_logo' );

function lapizzeria_styles()
{
	// REGISTRAR LOS ESTILOS
	wp_register_style('normalize', get_template_directory_uri() . '/css/normalize.css', array(), '8.0.1');
	wp_register_style( 'google_fonts', 'https://fonts.googleapis.com/css?family=Open+Sans|Raleway:400,700,900', array(), '1.0.0' );
	//que cargue primero normalize
	wp_register_style('fontawesome', get_template_directory_uri() . '/css/font-awesome.min.css', array('normalize'), '5.5.0');
	wp_register_style('fluidboxcss', get_template_directory_uri() . '/css/fluidbox.min.css', array('normalize'), '5.5.0');

	//que cargue primero normalize
	wp_register_style('style', get_template_directory_uri() . '/style.css', array('normalize'), '1.0');
	
	// LLAMAR A LOS ESTILOS
	wp_enqueue_style('normalize');
	wp_enqueue_style('fontawesome');
	wp_enqueue_style('fluidboxcss');
	wp_enqueue_style('style');

	// REGISTRAR JS con true le indicamos que cargue el js en el footer
	wp_register_script('fluidbox', get_template_directory_uri() . '/js/jquery.fluidbox.min.js', array(), '1.0.0', true);
	wp_register_script('scripts', get_template_directory_uri() . '/js/scripts.js', array(), '1.0.0', true);

	wp_enqueue_script('jquery');
	wp_enqueue_script('fluidbox');
	wp_enqueue_script('scripts');

	/*//PASAR VARIABLES DE PHP A JAVASCRIPT
	wp_localize_script( 
		'scripts', 
		'opciones',
		array(
			'latitud' => get_option( 'lapizzeria_direccion' )
		) 
	);*/
}

add_action('wp_enqueue_scripts', 'lapizzeria_styles');

// CREACIÓN DE MENUS
function lapizzeria_menus()
{
	register_nav_menus( array(
		'header-menu' => __('Header Menu', 'lapizzeria'),
		'social-menu' => __('Social Menu', 'lapizzeria')
	) );
}

add_action( 'init', 'lapizzeria_menus' );

add_action( 'init', 'lapizzeria_especialidades' );

function lapizzeria_especialidades() {
	//son etiquetas parte de la interfaz
	$labels = array(
		'name'               => _x( 'Pizzas', 'lapizzeria' ),
		'singular_name'      => _x( 'Pizzas', 'post type singular name', 'lapizzeria' ),
		'menu_name'          => _x( 'Pizzas', 'admin menu', 'lapizzeria' ),
		'name_admin_bar'     => _x( 'Pizzas', 'add new on admin bar', 'lapizzeria' ),
		'add_new'            => _x( 'Add New', 'book', 'lapizzeria' ),
		'add_new_item'       => __( 'Add New Pizza', 'lapizzeria' ),
		'new_item'           => __( 'New Pizzas', 'lapizzeria' ),
		'edit_item'          => __( 'Edit Pizzas', 'lapizzeria' ),
		'view_item'          => __( 'View Pizzas', 'lapizzeria' ),
		'all_items'          => __( 'All Pizzas', 'lapizzeria' ),
		'search_items'       => __( 'Search Pizzas', 'lapizzeria' ),
		'parent_item_colon'  => __( 'Parent Pizzas:', 'lapizzeria' ),
		'not_found'          => __( 'No Pizzases found.', 'lapizzeria' ),
		'not_found_in_trash' => __( 'No Pizzases found in Trash.', 'lapizzeria' )
	);

	$args = array(
		'labels'             => $labels,
    	'description'        => __( 'Description.', 'lapizzeria' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'especialidades' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 6,
		'supports'           => array( 'title', 'editor', 'thumbnail' ),
    	'taxonomies'          => array( 'category' ),
	);

	register_post_type( 'especialidades', $args );
}

/*WIDGETS*/
function lapizzeria_widgets(){
	register_sidebar( array(
		'name' => 'Blog Sidebar',
		'id' => 'blog_sidebar',
		'before_widget' => '<div class="widget">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>'
	) );
}

add_action( 'widgets_init', 'lapizzeria_widgets' );

// advanced custom fields
define('ACF_LITE', true);

include_once('advanced-custom-fields/acf.php');

if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array(
	'key' => 'group_5c01dd3d5bfe9',
	'title' => 'Especialidades',
	'fields' => array(
		array(
			'key' => 'field_5c01dd7326e05',
			'label' => 'Precio',
			'name' => 'precio',
			'type' => 'text',
			'instructions' => 'Agregar precio del platillo',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'especialidades',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => 1,
	'description' => '',
));

acf_add_local_field_group(array(
	'key' => 'group_5c4b9e922d380',
	'title' => 'inicio',
	'fields' => array(
		array(
			'key' => 'field_5c4b9ef1cac42',
			'label' => 'Contenido',
			'name' => 'contenido',
			'type' => 'wysiwyg',
			'instructions' => 'Agregue la descripción',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'tabs' => 'all',
			'toolbar' => 'full',
			'media_upload' => 1,
			'delay' => 0,
		),
		array(
			'key' => 'field_5c4b9f2ccac43',
			'label' => 'imagen',
			'name' => 'imagen',
			'type' => 'image',
			'instructions' => 'Agregue la imagen',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'return_format' => 'url',
			'preview_size' => 'thumbnail',
			'library' => 'all',
			'min_width' => '',
			'min_height' => '',
			'min_size' => '',
			'max_width' => '',
			'max_height' => '',
			'max_size' => '',
			'mime_types' => '',
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'page',
				'operator' => '==',
				'value' => '94',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => 1,
	'description' => '',
));

acf_add_local_field_group(array(
	'key' => 'group_5bfc3180a7614',
	'title' => 'Sobre Nosotros',
	'fields' => array(
		array(
			'key' => 'field_5bfc31cdb9cbd',
			'label' => 'imagen 1',
			'name' => 'imagen_1',
			'type' => 'image',
			'instructions' => 'subir una imagen',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'return_format' => 'id',
			'preview_size' => 'thumbnail',
			'library' => 'all',
			'min_width' => '',
			'min_height' => '',
			'min_size' => '',
			'max_width' => '',
			'max_height' => '',
			'max_size' => '',
			'mime_types' => '',
		),
		array(
			'key' => 'field_5bfc32beb9cc0',
			'label' => 'descripcion 1',
			'name' => 'descripcion_1',
			'type' => 'wysiwyg',
			'instructions' => 'Agregar descripcion',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'tabs' => 'all',
			'toolbar' => 'full',
			'media_upload' => 1,
			'delay' => 0,
		),
		array(
			'key' => 'field_5bfc327eb9cbe',
			'label' => 'imagen 2',
			'name' => 'imagen_2',
			'type' => 'image',
			'instructions' => 'subir una imagen',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'return_format' => 'id',
			'preview_size' => 'thumbnail',
			'library' => 'all',
			'min_width' => '',
			'min_height' => '',
			'min_size' => '',
			'max_width' => '',
			'max_height' => '',
			'max_size' => '',
			'mime_types' => '',
		),
		array(
			'key' => 'field_5bfc3308b9cc1',
			'label' => 'descripcion 2',
			'name' => 'descripcion_2',
			'type' => 'wysiwyg',
			'instructions' => 'Agregar descripcion',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'tabs' => 'all',
			'toolbar' => 'full',
			'media_upload' => 1,
			'delay' => 0,
		),
		array(
			'key' => 'field_5bfc328eb9cbf',
			'label' => 'imagen 3',
			'name' => 'imagen_3',
			'type' => 'image',
			'instructions' => 'subir una imagen',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'return_format' => 'id',
			'preview_size' => 'thumbnail',
			'library' => 'all',
			'min_width' => '',
			'min_height' => '',
			'min_size' => '',
			'max_width' => '',
			'max_height' => '',
			'max_size' => '',
			'mime_types' => '',
		),
		array(
			'key' => 'field_5bfc3314b9cc2',
			'label' => 'descripcion 3',
			'name' => 'descripcion_3',
			'type' => 'wysiwyg',
			'instructions' => 'Agregar descripcion',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'tabs' => 'all',
			'toolbar' => 'full',
			'media_upload' => 1,
			'delay' => 0,
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'page',
				'operator' => '==',
				'value' => '7',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => 1,
	'description' => '',
));

endif;
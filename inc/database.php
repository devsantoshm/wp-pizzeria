<?php
// inicializa la creación de las tablas nuevas
function lapizzeria_database()
{
	// wpdb no da los métodos para trabajar con tablas
	global $wpdb;
	global $lapizzeria_dbversion;
	$lapizzeria_dbversion = '0.2';

	$tabla = $wpdb->prefix . 'reservaciones';
	// obtenemos  el collation de la instalación
	$charset_collate = $wpdb->get_charset_collate();

	$sql = "CREATE TABLE $tabla (
			id int(9) NOT NULL AUTO_INCREMENT,
			nombre varchar(50) NOT NULL,
			fecha datetime NOT NULL,
			correo varchar(50) DEFAULT '' NOT NULL,
			telefono varchar(10) NOT NULL,
			mensaje longtext NOT NULL,
			PRIMARY KEY (id)
	) $charset_collate; ";

	// Se necesita dbDelta para ejecutar el sql
	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	dbDelta($sql);

	// Agregamos la versión de la BD para compararla son futuras actualizaciones
	add_option( 'lapizzeria_dbversion', $lapizzeria_dbversion );

	//ACTUALIZAR EN CASO DE SER NECESARIO
	$version_actual = get_option('lapizzeria_dbversion');

	//comparar las 2 versiones
	if ($lapizzeria_dbversion != $version_actual) {
		
		$tabla = $wpdb->prefix . 'reservaciones';

		$sql = "CREATE TABLE $tabla (
				id int(9) NOT NULL AUTO_INCREMENT,
				nombre varchar(50) NOT NULL,
				fecha datetime NOT NULL,
				correo varchar(50) DEFAULT '' NOT NULL,
				telefono varchar(10) NOT NULL,
				telefono2 varchar(10) NOT NULL,
				mensaje longtext NOT NULL,
				PRIMARY KEY (id)
		) $charset_collate; ";

		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		dbDelta($sql);

		//Actualizamos a la version actual en caso de que asi sea
		update_option( 'lapizzeria_dbversion', $lapizzeria_dbversion );
	}
}

add_action( 'after_setup_theme', 'lapizzeria_database' );

// función para comprobar que la versión instalada es igual a la bd nueva
function lapizzeriadb_revisar()
{
	global $lapizzeria_dbversion;
	if (get_site_option('lapizzeria_dbversion') != $lapizzeria_dbversion) {
		lapizzeria_database();
	}
}

add_action( 'plugins_loaded', 'lapizzeriadb_revisar' );
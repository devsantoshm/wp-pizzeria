<?php

function lapizzeria_ajustes()
{
	add_menu_page( 'La Pizzeria', 'La Pizzeria Ajustes', 'administrator', 'lapizzeria_ajustes', 'lapizzeria_opciones', '', 20 );
	add_submenu_page( 'lapizzeria_ajustes', 'Reservaciones', 'Reservaciones', 'administrator', 'lapizzeria_reservaciones', 'lapizzeria_reservaciones' );

  //llamar al registro de las opciones de nuestro theme
  add_action( 'admin_init', 'lapizzeria_registrar_opciones' );
}

add_action( 'admin_menu', 'lapizzeria_ajustes' );

function lapizzeria_registrar_opciones(){
  // Registrar opciones, una por campo
  register_setting( 'lapizzeria_opciones_grupo', 'lapizzeria_direccion' );
  register_setting( 'lapizzeria_opciones_grupo', 'lapizzeria_telefono' );
}

function lapizzeria_opciones(){
?>
  <div class="wrap">
    <h1>Ajustes la Pizzeria</h1>
    <form action="options.php" method="post">

      <?php settings_fields( 'lapizzeria_opciones_grupo' ); ?>
      <?php do_settings_sections( 'lapizzeria_opciones_grupo' ); ?>
      
      <table class="form-table">
        <tr valign="top">
          <th scope="row">Dirección</th>
          <td><input type="text" name="lapizzeria_direccion" value="<?php echo esc_attr(get_option( 'lapizzeria_direccion' )); ?>"></td>
        </tr>
        <tr valign="top">
          <th scope="row">Teléfono</th>
          <td><input type="text" name="lapizzeria_telefono" value="<?php echo esc_attr(get_option( 'lapizzeria_telefono' )); ?>"></td>
        </tr>
      </table>
      <?php submit_button(); ?>
    </form>
  </div>

<?php
}

function lapizzeria_reservaciones(){

?>

  <div class="wrap">
    <h1>Reservations</h1>
    <table class="wp-list-table widefat striped">
      	<thead>
	    	<tr>
	          <th class="manage-column">ID</th>
	          <th class="manage-column">Name</th>
	          <th class="manage-column">Date of Reservation</th>
	          <th class="manage-column">Email</th>
	          <th class="manage-column">Phone Number</th>
	          <th class="manage-column">Message</th>
	        </tr>
       	</thead>

        <tbody>
          <?php
            global $wpdb;
            $table = $wpdb->prefix . 'reservaciones';
            //devuelve un array asociativo
            $reservations = $wpdb->get_results("SELECT * FROM $table", ARRAY_A);
            foreach ($reservations as $reservation) : ?>

              <tr>
                <td><?php echo $reservation['id']; ?></td>
                <td><?php echo $reservation['nombre']; ?></td>
                <td><?php echo $reservation['fecha']; ?></td>
                <td><?php echo $reservation['correo']; ?></td>
                <td><?php echo $reservation['telefono']; ?></td>
                <td><?php echo $reservation['mensaje']; ?></td>
              </tr>

            <?php endforeach; ?>
        </tbody>
    </table>
  </div>

<?php  

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>pizzeria</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body>
	<header class="encabezado-sitio">
		<div class="contenedor">
			<div class="logo">
				<a href="<?php echo esc_url(home_url('/')); ?>">
					<img src="<?php echo get_template_directory_uri(); ?>/img/logo.svg">
				</a>
			</div>
			<div class="informacion-encabezado">
				<div class="redes-sociales">
					<?php 
						$args = array(
							'theme_location' => 'social-menu',
							'container' => 'nav',
							'container_class' => 'menu-social',
							'container_id' => 'menu-social',
							'link_before' => '<span class="sr-text">',
							'link_after' => '</span>'
						); 

						wp_nav_menu( $args );
					?>
				</div>
				<div class="direccion">
					<p>3434 bay acend mubfyeeff, ca 343</p>
					<p>teledon: +3-34-3434-3434</p>
				</div>
			</div>
		</div>
	</header>
	<nav class="menu-sitio">
		<div class="contenedor navegacion">
			<?php  
				$args = array(
					'theme_location' => 'header-menu',
					'container' => 'nav',
					'container_class' => 'menu-sitio'
				);

				wp_nav_menu( $args );
			?>
		</div>
	</nav>
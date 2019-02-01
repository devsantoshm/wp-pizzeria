<?php get_header(); ?>

	<?php while(have_posts()): the_post(); ?>
		
		<div class="hero" style="background-image: url(<?php echo get_the_post_thumbnail_url(); ?>);">
			<div class="contenido-hero">
				<div class="texto-hero">
					<h1><?php echo esc_html(get_option('blogdescription')); ?></h1>
					<?php the_content(); ?>	

					<?php $url = get_page_by_title( 'Sobre Nosotros' ); ?>
					<a class="button naranja" href="<?php echo get_permalink($url->ID); ?>">Leer más</a>
				</div>
			</div>
		</div>

	<?php endwhile; ?>
		
		<div class="principal contenedor">
			<main class="contenedor-grid">
				<h2 class="rojo texto-centrado">Nuestras Especialidades</h2>
				<?php  
				$args = array(
					'posts_per_page' => 3,
					'orderby' => 'rand',
					'post_type' => 'especialidades',
					'category_name' => 'pizzas'
				);

				$especialidades = new WP_Query($args);

				while ($especialidades->have_posts()): $especialidades->the_post();
				?>

				<div class="especialidad columnas1-3">
					<div class="contenido-especialidad">
						<?php the_post_thumbnail('especialidades_portrait'); ?>
						<div class="informacion-platillo">
							<?php the_title('<h3>', '</h3>'); ?>
							<?php the_content(); ?>
							<p class="precio">$<?php the_field('precio'); ?></p>
							<a href="<?php the_permalink(); ?>" class="button">Leer más</a>
						</div>
					</div>
				</div>
				
				<?php endwhile; wp_reset_postdata(); ?>

			</main>
		</div>

		<section class="ingredientes">
			<div class="contenedor">
				<div class="contenedor-grid">
					<?php while(have_posts()): the_post(); ?>
					<div class="columnas2-4">
						<?php the_field('contenido') ?>
						<?php $url = get_page_by_title( 'Sobre Nosotros' ); ?>
						<a class="button naranja" href="<?php echo get_permalink($url->ID); ?>">Leer más</a>
					</div>
					<div class="columnas2-4 imagen">
						<img src="<?php the_field('imagen') ?>">
					</div>
					<?php endwhile; ?>
				</div>
			</div>
		</section>

		<section class="contenedor">
			<h2 class="texto-rojo texto-centrado">Galería de Imágenes</h2>
			<?php $url = get_page_by_title( 'galeria' ); ?>
			<?php echo get_post_gallery($url->ID); ?>
		</section>

		<section class="ubicacion-reservacion">
			
			<div class="contenedor-grid">
				<?php while(have_posts()): the_post(); ?>
				<div class="columnas2-4">
					<div id="mapa">
						<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3838.2917857756042!2d-70.02663369020645!3d-15.84125437502293!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x915d69eb4013ddbd%3A0xde99b3eca4371e4b!2sPlaza+de+Armas!5e0!3m2!1ses!2spe!4v1548637965767" frameborder="0" style="border:0" allowfullscreen></iframe>	
					</div>
				</div>
				<div class="columnas2-4 imagen">
					<?php get_template_part('templates/formulario', 'reservacion') ?>
				</div>
				<?php endwhile; ?>
			</div>
			
		</section>

<?php get_footer(); ?>
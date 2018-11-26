		<footer>
			<?php  
				$args = array(
					'theme_location' => 'header-menu',
					'container' => 'nav',
					'after' => '<span class="separador"> | </span>'
				);

				wp_nav_menu( $args );
			?>
			<div class="ubicacion">
				<p>3434 bay acend mubfyeeff, ca 343</p>
				<p>teledon: +3-34-3434-3434</p>
			</div>

			<p class="copyright">Todos los derechos reservados <?php echo date('Y') ?></p>
		</footer>
		
		<?php wp_footer(); ?>
	</body>
</html>
<form class="reserva-contacto" method="post">
	<h2>Realiza una reservación</h2>
	<div class="campo">
		<input type="text" name="nombre" placeholder="Nombre" required>
	</div>
	<div class="campo">
		<input type="datetime-local" name="fecha" placeholder="Fecha" required>
	</div>
	<div class="campo">
		<input type="email" name="correo" placeholder="Correo" required>
	</div>
	<div class="campo">
		<input type="tel" name="telefono" placeholder="Teléfono" required>
	</div>
	<div class="campo">
		<textarea name="mensaje" placeholder="Mensaje" required></textarea>
	</div>
	<div class="g-recaptcha" data-sitekey="6Ldk2ZIUAAAAAAYnTcxMUsIgV9g08BxhUI-NwHZi"></div>
	<input type="submit" name="enviar" class="button">
	<input type="hidden" name="oculto" value="1">
</form>
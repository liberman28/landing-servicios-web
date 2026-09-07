<?php
/**
 * Pie: bloque de cierre y barra inferior.
 *
 * @package Liberman
 */

?>
</main>

<footer class="foot wrap" id="contact">
	<div class="cta rv">
		<h2><?php echo esc_html( liberman_option( 'cta_titulo', 'Servicios adaptados a lo que tu negocio necesita' ) ); ?></h2>
		<a href="<?php echo esc_url( liberman_option( 'cta_enlace', home_url( '/contacto/' ) ) ); ?>" class="btn-hire">
			<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 1.5 14.4 9l7.6 3-7.6 3-2.4 7.5L9.6 15 2 12l7.6-3L12 1.5Z" fill="#ff6c0a"/></svg>
			<?php echo esc_html( liberman_option( 'cta_boton', 'Trabajemos juntos' ) ); ?>
		</a>
		<div class="cta-by"><i></i> <?php echo esc_html( liberman_option( 'cta_firma', 'Liberman González — Diseño y desarrollo web' ) ); ?></div>
	</div>

	<div class="foot-bar">
		<span>&copy; <?php echo esc_html( get_bloginfo( 'name' ) . ' ' . wp_date( 'Y' ) ); ?></span>
		<nav aria-label="<?php esc_attr_e( 'Enlaces del pie', 'liberman' ); ?>">
			<?php liberman_menu( 'pie' ); ?>
		</nav>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>

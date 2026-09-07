<?php
/**
 * Página no encontrada.
 *
 * @package Liberman
 */

get_header();
?>

<section class="sec wrap page-top">
	<div class="head rv"><h2><?php esc_html_e( 'Aquí no hay nada', 'liberman' ); ?></h2></div>
	<p class="sec-desc rv"><?php esc_html_e( 'La página que buscas se movió o nunca existió.', 'liberman' ); ?></p>
	<p class="more-wrap rv" style="justify-content:flex-start">
		<a class="btn-more" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Volver al inicio', 'liberman' ); ?></a>
	</p>
</section>

<?php
get_footer();

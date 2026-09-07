<?php
/**
 * Listado de proyectos. Reutiliza las cards apiladas de la portada.
 *
 * @package Liberman
 */

get_header();
?>

<section class="sec wrap page-top">
	<div class="head rv"><h2><?php post_type_archive_title(); ?></h2></div>
	<?php
	$lb_desc = get_the_archive_description();
	if ( $lb_desc ) :
		?>
		<p class="sec-desc rv"><?php echo wp_kses_post( $lb_desc ); ?></p>
	<?php endif; ?>
</section>

<section class="work wrap">
	<?php
	if ( have_posts() ) :
		$lb_i = 0;
		while ( have_posts() ) :
			the_post();
			liberman_card_proyecto( $lb_i );
			$lb_i++;
		endwhile;
	else :
		?>
		<p class="sec-desc rv"><?php esc_html_e( 'Aún no hay proyectos publicados.', 'liberman' ); ?></p>
		<?php
	endif;
	?>
</section>

<div class="wrap"><?php liberman_paginacion(); ?></div>

<?php
get_footer();

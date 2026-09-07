<?php
/**
 * Listado del blog.
 *
 * @package Liberman
 */

get_header();
?>

<section class="sec wrap page-top">
	<div class="head rv">
		<h2><?php echo esc_html( is_home() && get_option( 'page_for_posts' ) ? get_the_title( get_option( 'page_for_posts' ) ) : __( 'Notas', 'liberman' ) ); ?></h2>
	</div>

	<div class="posts">
		<?php if ( have_posts() ) : ?>
			<?php
			$lb_n = 0;
			while ( have_posts() ) :
				the_post();
				$lb_n++;
				?>
				<a href="<?php the_permalink(); ?>" class="row rv">
					<div class="post-l">
						<?php if ( has_post_thumbnail() ) : ?>
							<div class="thumb"><?php the_post_thumbnail( 'liberman-nota', array( 'alt' => esc_attr( get_the_title() ) ) ); ?></div>
						<?php else : ?>
							<div class="thumb th-<?php echo (int) ( ( $lb_n - 1 ) % 3 + 1 ); ?>"></div>
						<?php endif; ?>
						<div class="post-meta">
							<span><?php echo esc_html( get_the_date() ); ?></span>
							<h3><?php the_title(); ?></h3>
						</div>
					</div>
				</a>
				<?php
			endwhile;
			?>
		<?php else : ?>
			<p class="sec-desc rv"><?php esc_html_e( 'Todavía no hay nada publicado por aquí.', 'liberman' ); ?></p>
		<?php endif; ?>
	</div>

	<?php liberman_paginacion(); ?>
</section>

<?php
get_footer();

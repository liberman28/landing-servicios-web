<?php
/**
 * Proyecto.
 *
 * @package Liberman
 */

get_header();

while ( have_posts() ) :
	the_post();

	$lb_stats = array(
		array( get_post_meta( get_the_ID(), '_lb_stat1_label', true ), get_post_meta( get_the_ID(), '_lb_stat1_valor', true ) ),
		array( get_post_meta( get_the_ID(), '_lb_stat2_label', true ), get_post_meta( get_the_ID(), '_lb_stat2_valor', true ) ),
	);
	?>
	<article <?php post_class( 'wrap entry page-top' ); ?>>
		<header class="entry-head rv">
			<h1 class="entry-title"><?php the_title(); ?></h1>
			<?php if ( has_excerpt() ) : ?>
				<p class="entry-lead"><?php echo esc_html( get_the_excerpt() ); ?></p>
			<?php endif; ?>
		</header>

		<?php if ( has_post_thumbnail() ) : ?>
			<div class="entry-media rv"><?php the_post_thumbnail( 'large' ); ?></div>
		<?php endif; ?>

		<?php if ( array_filter( array_merge( ...$lb_stats ) ) ) : ?>
			<div class="entry-stats rv">
				<?php foreach ( $lb_stats as $lb_s ) : ?>
					<?php if ( $lb_s[0] || $lb_s[1] ) : ?>
						<div class="stat"><span><?php echo esc_html( $lb_s[0] ); ?></span><b><?php echo esc_html( $lb_s[1] ); ?></b></div>
					<?php endif; ?>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>

		<div class="prose rv"><?php the_content(); ?></div>

		<nav class="entry-nav rv" aria-label="<?php esc_attr_e( 'Más proyectos', 'liberman' ); ?>">
			<?php previous_post_link( '%link', '&larr; %title' ); ?>
			<?php next_post_link( '%link', '%title &rarr;' ); ?>
		</nav>
	</article>
	<?php
endwhile;

get_footer();

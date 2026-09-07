<?php
/**
 * Página estándar.
 *
 * @package Liberman
 */

get_header();

while ( have_posts() ) :
	the_post();
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

		<div class="prose rv">
			<?php the_content(); ?>
		</div>
	</article>
	<?php
endwhile;

get_footer();

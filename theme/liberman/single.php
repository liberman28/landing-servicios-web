<?php
/**
 * Entrada del blog.
 *
 * @package Liberman
 */

get_header();

while ( have_posts() ) :
	the_post();
	?>
	<article <?php post_class( 'wrap entry page-top' ); ?>>
		<header class="entry-head rv">
			<span class="entry-meta"><?php echo esc_html( get_the_date() ); ?></span>
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
			<?php wp_link_pages( array( 'before' => '<p class="entry-pages">', 'after' => '</p>' ) ); ?>
		</div>

		<nav class="entry-nav rv" aria-label="<?php esc_attr_e( 'Más notas', 'liberman' ); ?>">
			<?php previous_post_link( '%link', '&larr; %title' ); ?>
			<?php next_post_link( '%link', '%title &rarr;' ); ?>
		</nav>
	</article>

	<?php
	if ( comments_open() || get_comments_number() ) {
		echo '<div class="wrap prose">';
		comments_template();
		echo '</div>';
	}
endwhile;

get_footer();

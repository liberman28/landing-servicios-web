<?php
/**
 * Cabecera: capa de luz, grano y navegación.
 *
 * @package Liberman
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="skip-link" href="#contenido"><?php esc_html_e( 'Saltar al contenido', 'liberman' ); ?></a>

<?php // Luz ambiental: fija al viewport, deriva con el scroll y con el tiempo. ?>
<div class="glow-layer" aria-hidden="true">
	<div class="hero-glows" id="glow"><i class="g-blue"></i><i class="g-grey"></i><i class="g-teal"></i></div>
</div>
<div class="grain" aria-hidden="true"></div>

<header class="nav" id="nav">
	<div class="wrap nav-inner">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo" aria-label="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
			<?php if ( has_custom_logo() ) : ?>
				<?php the_custom_logo(); ?>
			<?php else : ?>
				<svg viewBox="0 0 36 38" fill="none" aria-hidden="true">
					<path d="M17.4 1.6c1.6.6 2.1 2 1.4 4.2-1.5 4.7-4.6 9.9-9.3 15.6-3.6 4.4-6.6 7.2-8.2 6.4-1.4-.7-1.2-2.6.4-5.6C4.9 15.6 9.4 8.8 14 3.5c1.3-1.5 2.4-2.2 3.4-1.9Z" fill="currentColor"/>
					<path d="M33.6 10c1.6.6 2.1 2 1.4 4.2-1.5 4.7-4.6 9.9-9.3 15.6-3.6 4.4-6.6 7.2-8.2 6.4-1.4-.7-1.2-2.6.4-5.6C21.1 24 25.6 17.2 30.2 11.9c1.3-1.5 2.4-2.2 3.4-1.9Z" fill="currentColor" opacity=".92"/>
				</svg>
			<?php endif; ?>
		</a>

		<nav class="nav-links" id="menu" aria-label="<?php esc_attr_e( 'Principal', 'liberman' ); ?>">
			<?php liberman_menu( 'principal' ); ?>
		</nav>

		<button class="nav-toggle" id="toggle" aria-label="<?php esc_attr_e( 'Menú', 'liberman' ); ?>" aria-expanded="false"><span></span></button>
	</div>
</header>

<main id="contenido">

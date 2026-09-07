<?php
/**
 * Configuración del tema Liberman.
 *
 * Sin build ni dependencias: CSS y JS a mano, encolados desde aquí.
 *
 * @package Liberman
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'LIBERMAN_VERSION', '1.0.0' );

/* -------------------------------------------------------------------------
 * Soporte del tema
 * ---------------------------------------------------------------------- */

add_action( 'after_setup_theme', 'liberman_setup' );
/**
 * Registra soportes, menús y tamaños de imagen.
 */
function liberman_setup() {
	load_theme_textdomain( 'liberman', get_template_directory() . '/languages' );

	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'custom-logo', array(
		'height'      => 47,
		'width'       => 44,
		'flex-height' => true,
		'flex-width'  => true,
	) );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );

	register_nav_menus( array(
		'principal' => __( 'Principal', 'liberman' ),
		'pie'       => __( 'Pie', 'liberman' ),
	) );

	// Card de proyecto: 428x243 en la maqueta, x2 para pantallas densas.
	add_image_size( 'liberman-card', 856, 486, true );
	// Miniatura de nota: 192x128 en la maqueta.
	add_image_size( 'liberman-nota', 384, 256, true );
}

/* -------------------------------------------------------------------------
 * Estilos y scripts
 * ---------------------------------------------------------------------- */

add_action( 'wp_enqueue_scripts', 'liberman_assets' );
/**
 * Encola tipografías, hoja de estilo y el JS de interacciones.
 */
function liberman_assets() {
	// Satoshi no está en Google Fonts; viene de Fontshare.
	wp_enqueue_style(
		'liberman-satoshi',
		'https://api.fontshare.com/v2/css?f%5B%5D=satoshi@400,500,700&display=swap',
		array(),
		null
	);
	wp_enqueue_style(
		'liberman-google',
		'https://fonts.googleapis.com/css2?family=Hanken+Grotesk:wght@400;500&family=Inter:wght@400;500;600&display=swap',
		array(),
		null
	);
	wp_enqueue_style( 'liberman', get_stylesheet_uri(), array(), LIBERMAN_VERSION );

	wp_enqueue_script( 'liberman', get_template_directory_uri() . '/assets/app.js', array(), LIBERMAN_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_filter( 'wp_resource_hints', 'liberman_resource_hints', 10, 2 );
/**
 * Preconecta con los dominios de tipografías.
 *
 * @param array  $urls Recursos.
 * @param string $rel  Relación.
 * @return array
 */
function liberman_resource_hints( $urls, $rel ) {
	if ( 'preconnect' === $rel ) {
		$urls[] = array( 'href' => 'https://fonts.gstatic.com', 'crossorigin' => '' );
		$urls[] = array( 'href' => 'https://api.fontshare.com', 'crossorigin' => '' );
	}
	return $urls;
}

/* -------------------------------------------------------------------------
 * Tipo de contenido: proyectos
 * ---------------------------------------------------------------------- */

add_action( 'init', 'liberman_registrar_caso' );
/**
 * Registra el tipo de contenido «Proyecto».
 *
 * Conserva la ruta /casos-de-estudio/ que ya está indexada.
 */
function liberman_registrar_caso() {
	register_post_type( 'caso', array(
		'labels'       => array(
			'name'          => __( 'Proyectos', 'liberman' ),
			'singular_name' => __( 'Proyecto', 'liberman' ),
			'add_new_item'  => __( 'Añadir proyecto', 'liberman' ),
			'edit_item'     => __( 'Editar proyecto', 'liberman' ),
			'all_items'     => __( 'Todos los proyectos', 'liberman' ),
		),
		'public'       => true,
		'has_archive'  => 'casos-de-estudio',
		'rewrite'      => array( 'slug' => 'casos-de-estudio', 'with_front' => false ),
		'menu_icon'    => 'dashicons-portfolio',
		'menu_position' => 20,
		'supports'     => array( 'title', 'editor', 'thumbnail', 'excerpt', 'revisions', 'page-attributes' ),
		'show_in_rest' => true,
	) );
}

/* -------------------------------------------------------------------------
 * Métricas del proyecto
 * ---------------------------------------------------------------------- */

/**
 * Campos de métricas que se muestran en la card.
 *
 * @return array
 */
function liberman_campos_metricas() {
	return array(
		'_lb_stat1_label' => __( 'Métrica 1 · etiqueta', 'liberman' ),
		'_lb_stat1_valor' => __( 'Métrica 1 · valor', 'liberman' ),
		'_lb_stat2_label' => __( 'Métrica 2 · etiqueta', 'liberman' ),
		'_lb_stat2_valor' => __( 'Métrica 2 · valor', 'liberman' ),
	);
}

add_action( 'add_meta_boxes', 'liberman_metabox' );
/**
 * Añade la caja de métricas al editor de proyectos.
 */
function liberman_metabox() {
	add_meta_box( 'liberman-metricas', __( 'Métricas de la card', 'liberman' ), 'liberman_metabox_html', 'caso', 'side', 'default' );
}

/**
 * Pinta la caja de métricas.
 *
 * @param WP_Post $post Entrada actual.
 */
function liberman_metabox_html( $post ) {
	wp_nonce_field( 'liberman_metricas', 'liberman_metricas_nonce' );
	echo '<p style="margin-top:0;color:#666">' . esc_html__( 'Dos cifras cortas. El valor se muestra grande: máximo 8 caracteres.', 'liberman' ) . '</p>';
	foreach ( liberman_campos_metricas() as $clave => $etiqueta ) {
		printf(
			'<p><label for="%1$s" style="display:block;font-weight:600">%2$s</label>
			 <input type="text" id="%1$s" name="%1$s" value="%3$s" class="widefat"></p>',
			esc_attr( $clave ),
			esc_html( $etiqueta ),
			esc_attr( (string) get_post_meta( $post->ID, $clave, true ) )
		);
	}
}

add_action( 'save_post_caso', 'liberman_guardar_metricas' );
/**
 * Guarda las métricas.
 *
 * @param int $post_id Entrada.
 */
function liberman_guardar_metricas( $post_id ) {
	if ( ! isset( $_POST['liberman_metricas_nonce'] )
		|| ! wp_verify_nonce( sanitize_key( wp_unslash( $_POST['liberman_metricas_nonce'] ) ), 'liberman_metricas' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}
	foreach ( array_keys( liberman_campos_metricas() ) as $clave ) {
		if ( isset( $_POST[ $clave ] ) ) {
			$valor = sanitize_text_field( wp_unslash( $_POST[ $clave ] ) );
			if ( '' === $valor ) {
				delete_post_meta( $post_id, $clave );
			} else {
				update_post_meta( $post_id, $clave, $valor );
			}
		}
	}
}

/* -------------------------------------------------------------------------
 * Ayudantes
 * ---------------------------------------------------------------------- */

/**
 * Devuelve un ajuste del personalizador con valor por defecto.
 *
 * @param string $clave    Clave.
 * @param string $defecto  Valor por defecto.
 * @return string
 */
function liberman_option( $clave, $defecto = '' ) {
	$valor = get_theme_mod( 'liberman_' . $clave, $defecto );
	return '' === $valor ? $defecto : $valor;
}

/**
 * Imprime un menú como enlaces sueltos, sin <ul> ni <li>.
 *
 * El CSS del tema espera <a> como hijos directos del contenedor flex,
 * así que no sirve la salida por defecto de wp_nav_menu().
 *
 * @param string $ubicacion Ubicación registrada.
 */
function liberman_menu( $ubicacion ) {
	$ubicaciones = get_nav_menu_locations();

	if ( empty( $ubicaciones[ $ubicacion ] ) ) {
		liberman_menu_fallback( $ubicacion );
		return;
	}

	$items = wp_get_nav_menu_items( $ubicaciones[ $ubicacion ] );
	if ( ! $items ) {
		liberman_menu_fallback( $ubicacion );
		return;
	}

	foreach ( $items as $item ) {
		if ( (int) $item->menu_item_parent !== 0 ) {
			continue; // Un solo nivel.
		}
		$clases = array_filter( (array) $item->classes );
		$destino = $item->target ? ' target="' . esc_attr( $item->target ) . '" rel="noopener"' : '';
		printf(
			'<a href="%1$s"%2$s%3$s>%4$s</a>',
			esc_url( $item->url ),
			$clases ? ' class="' . esc_attr( implode( ' ', $clases ) ) . '"' : '',
			$destino, // phpcs:ignore WordPress.Security.EscapeOutput -- ya escapado arriba.
			esc_html( $item->title )
		);
	}
}

/**
 * Enlaces por defecto mientras no haya menú creado en WordPress.
 *
 * @param string $ubicacion Ubicación.
 */
function liberman_menu_fallback( $ubicacion ) {
	if ( 'pie' === $ubicacion ) {
		printf( '<a href="%s">%s</a>', esc_url( home_url( '/' ) ), esc_html__( 'Inicio', 'liberman' ) );
		printf( '<a href="%s">%s</a>', esc_url( get_post_type_archive_link( 'caso' ) ), esc_html__( 'Proyectos', 'liberman' ) );
		printf( '<a href="%s">%s</a>', esc_url( home_url( '/contacto/' ) ), esc_html__( 'Contacto', 'liberman' ) );
		return;
	}

	$enlaces = array(
		array( get_post_type_archive_link( 'caso' ), __( 'Proyectos', 'liberman' ), '' ),
		array( home_url( '/servicios/' ), __( 'Servicios', 'liberman' ), '' ),
		array( get_permalink( get_option( 'page_for_posts' ) ) ? get_permalink( get_option( 'page_for_posts' ) ) : home_url( '/notas/' ), __( 'Notas', 'liberman' ), '' ),
		array( home_url( '/contacto/' ), __( 'Hablemos', 'liberman' ), 'nav-pill' ),
	);

	foreach ( $enlaces as $enlace ) {
		printf(
			'<a href="%1$s"%2$s>%3$s</a>',
			esc_url( $enlace[0] ),
			$enlace[2] ? ' class="' . esc_attr( $enlace[2] ) . '"' : '',
			esc_html( $enlace[1] )
		);
	}
}

/**
 * Pinta la card de un proyecto tal como aparece en la portada.
 *
 * @param int $indice Posición, para el tinte de color (1-4).
 */
function liberman_card_proyecto( $indice ) {
	$n     = ( $indice % 4 ) + 1;
	$stats = array(
		array( get_post_meta( get_the_ID(), '_lb_stat1_label', true ), get_post_meta( get_the_ID(), '_lb_stat1_valor', true ) ),
		array( get_post_meta( get_the_ID(), '_lb_stat2_label', true ), get_post_meta( get_the_ID(), '_lb_stat2_valor', true ) ),
	);
	?>
	<article class="case case-<?php echo (int) $n; ?> rv">
		<div class="case-l">
			<h3 class="case-title"><?php the_title(); ?></h3>
			<p class="case-desc"><?php echo esc_html( get_the_excerpt() ); ?></p>
			<div class="case-cta">
				<a href="<?php the_permalink(); ?>" class="btn-case"><?php esc_html_e( 'Ver proyecto', 'liberman' ); ?></a>
			</div>
		</div>
		<div class="case-r">
			<div class="shot">
				<?php if ( has_post_thumbnail() ) : ?>
					<?php the_post_thumbnail( 'liberman-card', array( 'alt' => esc_attr( get_the_title() ) ) ); ?>
				<?php else : ?>
					<i class="art-<?php echo (int) $n; ?>"></i>
				<?php endif; ?>
			</div>
			<div class="stats">
				<?php foreach ( $stats as $stat ) : ?>
					<?php if ( $stat[0] || $stat[1] ) : ?>
						<div class="stat"><span><?php echo esc_html( $stat[0] ); ?></span><b><?php echo esc_html( $stat[1] ); ?></b></div>
					<?php endif; ?>
				<?php endforeach; ?>
			</div>
		</div>
	</article>
	<?php
}

add_filter( 'excerpt_more', 'liberman_excerpt_more' );
/**
 * Corta el extracto sin puntos suspensivos con enlace.
 *
 * @return string
 */
function liberman_excerpt_more() {
	return '…';
}

add_filter( 'excerpt_length', 'liberman_excerpt_length' );
/**
 * Extracto corto: la card sólo tiene sitio para tres líneas.
 *
 * @return int
 */
function liberman_excerpt_length() {
	return 26;
}

/**
 * Paginación con el aspecto de los chips del tema.
 */
function liberman_paginacion() {
	$enlaces = paginate_links( array(
		'type'      => 'array',
		'prev_text' => '&larr;',
		'next_text' => '&rarr;',
	) );

	if ( ! $enlaces ) {
		return;
	}

	echo '<nav class="pagination" aria-label="' . esc_attr__( 'Paginación', 'liberman' ) . '">';
	foreach ( $enlaces as $enlace ) {
		echo wp_kses_post( $enlace );
	}
	echo '</nav>';
}

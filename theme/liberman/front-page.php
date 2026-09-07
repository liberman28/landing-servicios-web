<?php
/**
 * Portada.
 *
 * @package Liberman
 */

get_header();
?>
<!-- ===================== HERO ===================== -->
<section class="hero">
  <div class="wrap hero-inner">
    <div class="avatar-wrap">
      <div class="avatar" aria-hidden="true">
        <svg viewBox="0 0 108 108">
          <defs>
            <clipPath id="cc"><circle cx="54" cy="54" r="54"/></clipPath>
          </defs>
          <g clip-path="url(#cc)">
            <rect width="108" height="108" fill="#1f2830"/>
            <circle cx="54" cy="30" r="34" fill="#2b3742" opacity=".55"/>
            <path d="M6 108c0-20 21-32 48-32s48 12 48 32H6Z" fill="#3a4a56"/>
            <path d="M54 74c10 0 16 8 16 17v17H38V91c0-9 6-17 16-17Z" fill="#556775"/>
            <ellipse cx="54" cy="44" rx="24" ry="27" fill="#e9c8ac"/>
            <path d="M54 14c16 0 25 10 25 22 0 5-1 10-2 10-1-8-5-14-11-15-9-1-16 3-24 1-5-1-8-4-8-4 0-8 5-14 20-14Z" fill="#2c2118"/>
            <ellipse cx="45" cy="45" rx="7" ry="5.5" fill="none" stroke="#1d1d1d" stroke-width="1.8"/>
            <ellipse cx="64" cy="45" rx="7" ry="5.5" fill="none" stroke="#1d1d1d" stroke-width="1.8"/>
            <path d="M52 45h5" stroke="#1d1d1d" stroke-width="1.8"/>
            <path d="M46 58c5 3 11 3 16 0" stroke="#c69a7c" stroke-width="2" fill="none" stroke-linecap="round"/>
          </g>
        </svg>
      </div>
      <div class="badge">
        <svg viewBox="0 0 14 14" aria-hidden="true"><circle cx="7" cy="7" r="4" fill="#16a34a"/></svg>
        Disponible para proyectos
      </div>
    </div>

    <h1 class="hero-title"><?php echo esc_html( liberman_option( 'hero_titulo', 'Lleva tu negocio al siguiente nivel con soluciones web.' ) ); ?></h1>
    <p class="hero-sub"><?php echo esc_html( liberman_option( 'hero_sub', 'Diseño y construyo páginas web y tiendas online para que tu negocio se vea profesional y crezca.' ) ); ?></p>

    <div class="hero-cta">
      <a href="<?php echo esc_url( liberman_option( 'cta_enlace', home_url( '/contacto/' ) ) ); ?>" class="btn-glow">Cuéntame tu proyecto</a>
      <a href="#work" class="btn-ghost">Ver proyectos</a>
    </div>
  </div>
</section>

<!-- ===================== TOOL MARQUEE ===================== -->
<section class="tools" aria-label="Tools I work with">
  <div class="mq" id="mq"></div>
</section>

<?php // Proyectos: se alimentan del tipo de contenido, no del HTML. ?>
<section class="work wrap" id="work">
<?php
$lb_proyectos = new WP_Query( array(
	'post_type'      => 'caso',
	'posts_per_page' => 4,
	'orderby'        => 'menu_order date',
	'order'          => 'ASC',
) );

if ( $lb_proyectos->have_posts() ) :
	$lb_i = 0;
	while ( $lb_proyectos->have_posts() ) :
		$lb_proyectos->the_post();
		liberman_card_proyecto( $lb_i );
		$lb_i++;
	endwhile;
	wp_reset_postdata();
else :
	?>
	<p class="sec-desc rv"><?php esc_html_e( 'Aún no hay proyectos publicados.', 'liberman' ); ?></p>
	<?php
endif;
?>
</section>

<!-- ===================== BIO ===================== -->
<section class="bio">
  <div class="rings" aria-hidden="true">
    <i style="width:290px;height:290px"></i>
    <i style="width:570px;height:570px"></i>
    <i style="width:850px;height:850px"></i>
    <i style="width:1130px;height:1130px"></i>
    <i style="width:1410px;height:1410px"></i>
    <i style="width:1690px;height:1690px"></i>
  </div>
  <div class="wrap">
    <p class="bio-copy rv">Diseño y construyo
      <span class="chip"><u><span>páginas web<br>tiendas online<br>landings<br>sitios corporativos<br>rediseños<br>páginas web</span></u></span>
      para negocios que necesitan verse profesionales y vender mejor.
      <span class="chip"><u><span>3 años<br>3 años<br>3 años<br>3 años<br>3 años<br>3 años</span></u></span> de práctica sobre una base de seis en
      marketing y diseño. Trabajo cerca del
      <span class="chip"><u><span>código<br>HTML<br>CSS<br>componente<br>handoff<br>código</span></u></span>
      y de la medición. Base en
      <span class="chip"><u><span>Medellín<br>Colombia<br>Medellín<br>Colombia<br>Medellín<br>Medellín</span></u></span>, modalidad remota.
    </p>
  </div>
</section>

<!-- ===================== CLIENTS ===================== -->
<section class="clients">
  <div class="wrap clients-grid rv">
    <div class="client">
      <div class="client-logo">
        <svg viewBox="0 0 200 34" fill="currentColor" aria-hidden="true">
          <path d="M4 24 12 4l8 20-8-6-8 6Z"/><path d="M20 24 28 8l6 16-6-4-8 4Z" opacity=".6"/>
          <text x="42" y="26" font-family="Satoshi,sans-serif" font-size="24" font-weight="700">Guardianes</text>
        </svg>
      </div>
      <q>Plataforma de conservación, cuatro páginas de cero a producción</q>
    </div>
    <div class="client">
      <div class="client-logo">
        <svg viewBox="0 0 180 34" fill="currentColor" aria-hidden="true">
          <path d="M17 2a15 15 0 1 0 15 15h-6a9 9 0 1 1-9-9V2Z"/>
          <text x="40" y="26" font-family="Satoshi,sans-serif" font-size="24" font-weight="700">Growthia</text>
        </svg>
      </div>
      <q>Sitio de agencia con landing y páginas de servicio</q>
    </div>
    <div class="client">
      <div class="client-logo">
        <svg viewBox="0 0 120 34" fill="currentColor" aria-hidden="true">
          <path d="M17 2a15 15 0 0 1 0 30 15 15 0 0 1 0-30Zm0 6a9 9 0 1 0 0 18 9 9 0 0 0 0-18Z"/>
          <circle cx="17" cy="17" r="4"/>
          <text x="40" y="26" font-family="Satoshi,sans-serif" font-size="24" font-weight="700">Ubi</text>
        </svg>
      </div>
      <q>Red de domicilios explicada en una sola página</q>
    </div>
  </div>
</section>

<!-- ===================== WHAT I DO ===================== -->
<section class="sec wrap" id="services">
  <div class="head rv"><h2>Servicios</h2></div>
  <p class="sec-desc rv">Diseño y construyo páginas web y tiendas online a la medida: nueva presencia, rediseño o tu primera venta.</p>

  <div class="services">
    <div class="row rv"><h3>Diseño web</h3><div class="tags"><span>Landing</span><span>Sitio corporativo</span><span>Rediseño</span><span>Responsivo</span></div></div>
    <div class="row rv"><h3>Desarrollo</h3><div class="tags"><span>WordPress</span><span>HTML y CSS</span><span>Integraciones</span><span>Rendimiento</span></div></div>
    <div class="row rv"><h3>E-commerce</h3><div class="tags"><span>Catálogo</span><span>Checkout</span><span>Confianza</span><span>Móvil</span></div></div>
    <div class="row rv"><h3>Automatización</h3><div class="tags"><span>Formularios</span><span>Conexiones</span><span>Reportes</span><span>Medición</span></div></div>
  </div>
</section>

<!-- ===================== SKILLS ===================== -->
<section class="sec wrap" id="skills">
  <div class="head rv"><h2>Stack</h2></div>
  <ul class="chips rv">
    <li>Diseño web</li><li>Landing pages</li><li>Tiendas online</li><li>Rediseño</li><li>Diseño responsivo</li><li>WordPress</li><li>Elementor</li><li>HTML y CSS</li><li>Design systems</li><li>SEO on-page</li><li>Google Analytics 4</li><li>Search Console</li><li>Automatizaciones</li><li>Arquitectura de información</li><li>Mantenimiento</li><li class="more">+ Más</li>
  </ul>
</section>

<!-- ===================== EXPERIENCE ===================== -->
<section class="sec wrap" id="experience">
  <div class="head rv"><h2>Proceso</h2></div>
  <div class="exp">
    <div class="row rv"><h3>Descubrir</h3><div class="meta"><span>Etapa 01</span><time>Objetivos, usuarios, procesos y restricciones</time></div></div>
    <div class="row rv"><h3>Definir</h3><div class="meta"><span>Etapa 02</span><time>Funcionalidades, flujos, arquitectura y prioridades</time></div></div>
    <div class="row rv"><h3>Diseñar</h3><div class="meta"><span>Etapa 03</span><time>Pantallas, componentes y estados</time></div></div>
    <div class="row rv"><h3>Construir y mejorar</h3><div class="meta"><span>Etapa 04</span><time>Desarrollo, automatización y ajustes</time></div></div>
  </div>
</section>

<?php // Notas: últimas entradas del blog. ?>
<section class="sec wrap" id="blog">
	<div class="head rv"><h2><?php esc_html_e( 'Notas', 'liberman' ); ?></h2></div>
	<div class="posts">
	<?php
	$lb_notas = new WP_Query( array( 'posts_per_page' => 3, 'ignore_sticky_posts' => true ) );

	if ( $lb_notas->have_posts() ) :
		$lb_n = 0;
		while ( $lb_notas->have_posts() ) :
			$lb_notas->the_post();
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
		wp_reset_postdata();
		?>
		<div class="more-wrap rv">
			<a href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ?: home_url( '/' ) ); ?>" class="btn-more"><?php esc_html_e( 'Ver más', 'liberman' ); ?></a>
		</div>
		<?php
	else :
		?>
		<p class="sec-desc rv"><?php esc_html_e( 'Aún no hay notas publicadas.', 'liberman' ); ?></p>
		<?php
	endif;
	?>
	</div>
</section>

<!-- ===================== FAQ ===================== -->
<section class="sec wrap" id="faq">
  <div class="head rv"><h2>Preguntas frecuentes</h2></div>
  <div class="faq-list">
    <div class="faq-item rv">
      <button class="faq-q" aria-expanded="false">¿Qué tipo de proyectos web tomas?
        <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="m9 5 7 7-7 7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
      </button>
      <div class="faq-a"><div><p>Landings para validar una idea, sitios corporativos de varias páginas, rediseños de un sitio que ya existe y tiendas online. Cuando el proyecto necesita una aplicación web o mobile, lo trabajo con un equipo especializado.</p></div></div>
    </div>
    <div class="faq-item rv">
      <button class="faq-q" aria-expanded="false">¿Cómo es el proceso?
        <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="m9 5 7 7-7 7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
      </button>
      <div class="faq-a"><div><p>Cuatro etapas. Descubrir: objetivos del negocio, usuarios y restricciones. Definir: funcionalidades, flujos y prioridades antes de construir. Diseñar: pantallas, componentes y estados. Construir y mejorar: desarrollo, automatizaciones y ajustes con la medición ya puesta.</p></div></div>
    </div>
    <div class="faq-item rv">
      <button class="faq-q" aria-expanded="false">¿Trabajas en remoto?
        <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="m9 5 7 7-7 7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
      </button>
      <div class="faq-a"><div><p>Sí. Base en Medellín, Colombia, modalidad remota, disponible por proyecto o por contrato. Si tienes una idea, un sitio que se quedó corto o una tienda que no está vendiendo, escríbeme y lo revisamos.</p></div></div>
    </div>
  </div>
</section>

<?php
get_footer();

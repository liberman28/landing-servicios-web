# Athos Dark — recreación en un solo archivo

Recreación del diseño de una landing oscura de portfolio (referencia: `athos-dark.framer.ai`)
como **un único archivo HTML autocontenido**, sin build, sin framework y sin dependencias locales.

**En vivo:** https://liberman28.github.io/landing-servicios-web/

```
index.html   ← todo: markup + CSS + JS
```

Abrir con doble clic o servir con cualquier static server.

## Contenido

Landing de una sola página para **servicios de diseño y desarrollo web**: páginas web,
tiendas online y automatizaciones.

La estructura visual está tomada de una landing oscura de portfolio (referencia:
`athos-dark.framer.ai`): layout, escala tipográfica, ritmo vertical, iluminación y movimiento.

El contenido es propio, en español neutro, redactado a partir de
[libermangonzalez.site/servicios](https://libermangonzalez.site/servicios/) — propuesta,
proyectos, stack y proceso. Toda la gráfica (avatar, artworks, thumbnails, marcas de proyecto,
iconos del marquee) está generada con CSS y SVG inline; no hay imágenes externas.

### Secciones

| Sección | Contenido |
|---|---|
| Hero | Propuesta de valor + CTA a contacto |
| Marquee | Stack: Figma, WordPress, Elementor, HTML/CSS, Git, VS Code, GA4, Search Console |
| Proyectos | Trico, Prexy, Ubi (con enlace) y Growthia (*Próximamente*) |
| Bio | Quién, con qué y desde dónde |
| Marcas | Guardianes del Amazonas, Growthia, Ubi |
| Servicios | Diseño web · Desarrollo · E-commerce · Automatización |
| Stack | 15 capacidades + "Más" |
| Proceso | Descubrir · Definir · Diseñar · Construir y mejorar |
| Notas | Tres posturas sobre tienda, proceso y checkout |
| FAQ | Tipo de proyectos, proceso, modalidad |

### Pendientes

- **Growthia** está marcado como *Próximamente*: cambiar `is-soon` por un `<a>` cuando exista
  la página de caso.
- **Marcas de proyecto** son líneas factuales, no testimonios. Si consigues citas reales de
  clientes, ese es el lugar.
- **Notas** enlaza a `/servicios/`. Cuando exista el blog, apuntar a cada post y cambiar el
  índice `01/02/03` por fechas.

## Sistema de diseño

Tokens en `:root`, al inicio del `<style>`:

| Token | Valor | Uso |
|---|---|---|
| `--bg` | `#000` | fondo |
| `--panel` | `#141414` | cards, chips, pill de nav |
| `--t-1 … --t-4` | `#e6e6e6` → `rgba(209,218,224,.5)` | escala de texto |
| `--line` | `rgba(255,255,255,.10)` | separadores |
| `--accent` | `#ff6c0a` | viñeta de sección |
| `--wrap` | `1016px` | ancho de la columna de contenido |

Tipografías: **Satoshi** (display + UI), **Hanken Grotesk** (botones), **Inter** (badge).

Escala: h1 46/1.2 ls -1.38 · título de sección 38/45.6 ls -0.7 · título de card 30/42 ls -0.5 ·
fila 24/33.6 ls -0.5 · cuerpo 18-20/25-28 · meta 14/16.8 ls -0.2.

## Interacciones

Reproducidas a partir de una auditoría de la referencia con Chrome headless. La referencia
no declara **ninguna** transición CSS: Framer anima por JS con estilos inline, así que todo
se midió por comportamiento (diferencia de píxeles y de estilo computado), no leyendo su CSS.

| Interacción | Qué hace |
|---|---|
| Luz ambiental | Capa `fixed` al viewport que tiñe toda la página. Deriva con el **scroll** y con el **tiempo** (tres pools con duraciones distintas) |
| Apilado de proyectos | Las cards son `sticky` en `top:210px`; la cubierta sube, se encoge y se apaga |
| Botón de proyecto | Invierte a fondo claro con texto oscuro |
| Fila de servicio | El título toma el color de acento |
| Filas de proceso y notas | El título se aclara y la línea inferior gana contraste |
| Chips de la bio | Rotación vertical de palabras + barrido de luz (`mask-position`, 5 s) |
| Marquee | Desplazamiento infinito, se pausa al pasar el cursor |
| Reveals | `IntersectionObserver`, una sola vez por elemento |
| Acordeón | `grid-template-rows: 0fr → 1fr`, sin medir alturas a mano |
| Enlaces | Nav y footer se atenúan |

Todo respeta `prefers-reduced-motion: reduce`. El apilado se desactiva bajo 1000 px.

## Tema de WordPress (en curso)

El diseño se está convirtiendo en un tema propio, en `theme/liberman/`. Elementor se retira:
la landing pasa a ser la portada y el resto del sitio hereda el mismo sistema.

```
theme/liberman/
  style.css          CSS de la portada + estilos de páginas internas
  functions.php      soportes, menús, encolado, tipo "Proyecto", métricas, paginación
  header.php         capa de luz + grano + nav
  footer.php         bloque de cierre + barra inferior
  front-page.php     la landing (proyectos y notas ya salen de la base de datos)
  index.php          listado del blog
  single.php         entrada
  page.php           página estándar
  archive-caso.php   listado de proyectos (reutiliza las cards apiladas)
  single-caso.php    proyecto, con sus métricas
  archive.php  search.php  404.php
  assets/app.js      interacciones
```

### Decisiones tomadas

- **Los proyectos son un tipo de contenido propio** (`caso`) con ruta `casos-de-estudio`,
  la que ya está indexada. Las métricas de la card (`+2.000`, `6 pasos`) son campos del
  editor, así que las cards se generan solas.
- **El menú se imprime como enlaces sueltos**, no como `<ul><li>`: el CSS del nav espera
  `<a>` como hijos directos del contenedor flex. Hay respaldo por si aún no existe el menú.
- **Título y subtítulo del hero, y el bloque de cierre, salen del personalizador**, con el
  texto actual como valor por defecto.

### Pendiente

- [ ] Verificar el render con un *shim* de PHP y pasar el harness de 28 anclas sobre la salida
- [ ] `comments.php` (ahora `single.php` cae en la plantilla de compatibilidad de WordPress)
- [ ] Estilar el formulario de contacto con los tokens del tema
- [ ] Plan de migración: importar las páginas actuales, revisar permalinks y retirar Elementor
- [ ] Empaquetar el tema en `.zip` para subirlo

## Cómo se verificó

El diseño no se ajustó "a ojo". Se midió el render de referencia con Chrome headless y se
iteró contra tres controles:

1. **Geometría** — 28 anclas de layout (y de cada sección, altura total) comparadas contra el
   original a 1440×900. Estado final: las 28 dentro de ±6px.
2. **Color de fondo** — muestreo de una grilla de píxeles sobre el hero para calibrar los tres
   pools de luz. Diferencia RGB media ≤9 en todos los puntos de fondo.
3. **Comportamiento** — 1440 / 820 / 390px: sin errores de consola, sin overflow horizontal
   (`scrollWidth == clientWidth` en los tres), acordeón, menú móvil, marquee, chips rotativos
   y reveals de scroll comprobados.

## Accesibilidad y rendimiento

- Un solo request de documento; cero JS de terceros. Las únicas peticiones externas son las
  webfonts (Fontshare + Google Fonts).
- `prefers-reduced-motion: reduce` desactiva animaciones y muestra todo el contenido.
- Acordeón con `<button>` + `aria-expanded`; menú móvil con `aria-expanded`.
- Sin overflow horizontal en ningún breakpoint.

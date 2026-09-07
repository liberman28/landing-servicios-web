# Athos Dark — recreación en un solo archivo

Recreación del diseño de una landing oscura de portfolio (referencia: `athos-dark.framer.ai`)
como **un único archivo HTML autocontenido**, sin build, sin framework y sin dependencias locales.

```
index.html   ← todo: markup + CSS + JS
```

Abrir con doble clic o servir con cualquier static server.

## Contenido

La estructura visual está tomada de una landing oscura de portfolio (referencia:
`athos-dark.framer.ai`): layout, escala tipográfica, ritmo vertical, iluminación y movimiento.

El contenido es propio, en español neutro, redactado a partir de
[libermangonzalez.site](https://libermangonzalez.site) — casos de estudio, servicios, stack
y principios de trabajo. Toda la gráfica (avatar, artworks, thumbnails, marcas de proyecto,
iconos del marquee) está generada con CSS y SVG inline; no hay imágenes externas.

Los enlaces a casos de estudio, contacto y redes apuntan al sitio real.

### Notas sobre secciones

- **Casos** — Trico, Prexy y Ubi enlazan a su caso de estudio. El cuarto (Growthia) está
  marcado como *Próximamente*; cambiar `is-soon` por un `<a>` cuando exista la página.
- **Proyectos** — bajo la bio hay tres marcas con una línea factual cada una, no testimonios.
  Si consigues citas reales de clientes, ese es el lugar.
- **Experiencia** — listada por proyecto y alcance. Si prefieres un CV cronológico, cambiar
  `<time>` por fechas.
- **Ideas** — usa los tres principios de la página *Sobre mí*. Cuando exista el blog,
  reemplazar el índice `01/02/03` por fechas y apuntar a cada post.

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

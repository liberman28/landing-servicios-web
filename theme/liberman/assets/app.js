/* ---------- tool marquee (built once, then duplicated) ---------- */
(function(){
  var tools=[
    ['Figma','Diseño de interfaz y sistema de componentes','<circle cx="9" cy="5.5" r="3.5" fill="currentColor"/><circle cx="15" cy="12" r="3.5" fill="currentColor" opacity=".7"/><circle cx="9" cy="12" r="3.5" fill="currentColor" opacity=".85"/><circle cx="9" cy="18.5" r="3.5" fill="currentColor" opacity=".6"/>'],
    ['FigJam','Mapas de flujo y arquitectura del sitio','<rect x="3" y="3" width="8" height="8" rx="2" fill="currentColor"/><rect x="13" y="3" width="8" height="8" rx="2" fill="currentColor" opacity=".55"/><rect x="3" y="13" width="18" height="8" rx="2" fill="currentColor" opacity=".8"/>'],
    ['WordPress','El CMS donde vive el sitio y lo administras tú','<circle cx="12" cy="12" r="9.2" fill="none" stroke="currentColor" stroke-width="1.7"/><path d="M4 10h5l3 9 2-6-2-3h4l3 9 2-9" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"/>'],
    ['Elementor','Maquetación editable sin romper el diseño','<rect x="4" y="3" width="4" height="18" rx="1" fill="currentColor"/><rect x="11" y="3" width="9" height="5" rx="1" fill="currentColor" opacity=".75"/><rect x="11" y="10" width="9" height="5" rx="1" fill="currentColor" opacity=".6"/><rect x="11" y="17" width="9" height="4" rx="1" fill="currentColor" opacity=".45"/>'],
    ['HTML y CSS','Lo suficiente para no adivinar en el detalle','<path d="M3 6h4l2.5 7L12 6h3l2.5 7L20 6h1l-4 12h-3l-2.5-6.5L9 18H6L3 6Z" fill="currentColor"/>'],
    ['Git','Control de versiones del proyecto','<path d="M3 14 10 21M3 9l12 12M4 4l16 16M9 3l12 12M15 3l6 6" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/>'],
    ['VS Code','Donde se escribe y se ajusta el código','<rect x="4" y="3" width="16" height="18" rx="2" fill="none" stroke="currentColor" stroke-width="1.7"/><path d="M9 8v8l6-8v8" stroke="currentColor" stroke-width="1.7" fill="none" stroke-linejoin="round"/>'],
    ['Claude Code','Agentes de código para iterar más rápido','<path d="M4 12 12 3l8 9-8 9-8-9Z" fill="none" stroke="currentColor" stroke-width="1.8"/><path d="M12 7v10" stroke="currentColor" stroke-width="1.8"/>'],
    ['Cursor','Editor con IA para pasar de diseño a código','<path d="M6 3l12 8-5 1.4L16 19l-2.6 1.2-3-6.4L6 17V3Z" fill="currentColor"/>'],
    ['Analytics 4','Medición de comportamiento y conversión','<path d="M6 20V8m6 12V4m6 16v-7" stroke="currentColor" stroke-width="2.4" stroke-linecap="round"/>'],
    ['Search Console','Rendimiento en búsqueda y SEO on-page','<circle cx="11" cy="11" r="7" fill="none" stroke="currentColor" stroke-width="1.9"/><path d="m16.5 16.5 4 4" stroke="currentColor" stroke-width="1.9" stroke-linecap="round"/>'],
    ['PostHog','Analítica de producto y embudos','<path d="M12 21s-8-4.7-8-10a4.6 4.6 0 0 1 8-3 4.6 4.6 0 0 1 8 3c0 5.3-8 10-8 10Z" fill="currentColor"/>']
  ];
  var html='';
  tools.forEach(function(t){
    html+='<div class="tile"><span class="tip"><b>'+t[0]+'</b>'+t[1]+'</span>'+
          '<svg viewBox="0 0 24 24" fill="none" style="color:#f2f2f2">'+t[2]+'</svg></div>';
  });
  document.getElementById('mq').innerHTML=html+html;
})();

/* ---------- scroll reveal ---------- */
(function(){
  var els=document.querySelectorAll('.rv');
  if(!('IntersectionObserver' in window)){els.forEach(function(e){e.classList.add('in')});return}
  var io=new IntersectionObserver(function(entries){
    entries.forEach(function(en){
      if(en.isIntersecting){en.target.classList.add('in');io.unobserve(en.target)}
    });
  },{rootMargin:'0px 0px -12% 0px',threshold:.08});
  els.forEach(function(e,i){e.style.transitionDelay=(i%4)*70+'ms';io.observe(e)});
})();

/* ---------- faq accordion ---------- */
document.querySelectorAll('.faq-q').forEach(function(btn){
  btn.addEventListener('click',function(){
    var item=btn.parentElement, open=item.classList.contains('open');
    document.querySelectorAll('.faq-item.open').forEach(function(o){
      o.classList.remove('open');o.querySelector('.faq-q').setAttribute('aria-expanded','false');
    });
    if(!open){item.classList.add('open');btn.setAttribute('aria-expanded','true')}
  });
});

/* ---------- luz ambiental + apilado de cards, en un solo rAF ---------- */
(function(){
  var glow=document.getElementById('glow');
  var cards=[].slice.call(document.querySelectorAll('.case'));
  var reduce=matchMedia('(prefers-reduced-motion: reduce)').matches;
  var stack=matchMedia('(min-width: 1001px)').matches;
  var TOP=210, RANGE=548, ticking=false, nat=[];

  /* offsetTop de un elemento sticky ya trae el desplazamiento pegado,
     asi que la posicion natural se mide desactivando sticky un instante */
  function measure(){
    var prev=cards.map(function(c){var v=c.style.position;c.style.position='static';return v});
    nat=cards.map(function(c){return Math.round(c.getBoundingClientRect().top+window.pageYOffset)});
    cards.forEach(function(c,i){c.style.position=prev[i]||''});
  }

  function frame(){
    ticking=false;
    var y=window.pageYOffset;

    /* el punto de luz viaja de lado a lado con el scroll, no se queda quieto */
    if(glow && !reduce){
      glow.style.transform='translate3d('+(Math.sin(y/1400)*170).toFixed(1)+'px,'
        +(Math.sin(y/900)*55).toFixed(1)+'px,0)';
    }

    /* cada card sube, se encoge y se apaga cuando la siguiente la cubre */
    if(stack && !reduce){
      for(var i=0;i<cards.length;i++){
        var over=TOP-(nat[i]-y);
        var t=over<=0?0:(over>RANGE?1:over/RANGE);
        if(t){
          cards[i].style.transform='translateY('+(-t*106).toFixed(1)+'px) scale('+(1-t*0.055).toFixed(4)+')';
          cards[i].style.filter='brightness('+(1-t*0.22).toFixed(3)+')';
        }else{
          cards[i].style.transform='';
          cards[i].style.filter='';
        }
      }
    }
  }
  function onScroll(){ if(!ticking){ ticking=true; requestAnimationFrame(frame); } }
  addEventListener('scroll',onScroll,{passive:true});
  addEventListener('resize',function(){
    stack=matchMedia('(min-width: 1001px)').matches;
    if(!stack) cards.forEach(function(c){c.style.transform='';c.style.filter=''});
    measure(); onScroll();
  },{passive:true});
  addEventListener('load',function(){measure();onScroll()});
  measure(); frame();
})();

/* ---------- nav ---------- */
(function(){
  var nav=document.getElementById('nav'), tog=document.getElementById('toggle');
  addEventListener('scroll',function(){nav.classList.toggle('stuck',scrollY>20)},{passive:true});
  tog.addEventListener('click',function(){
    var open=document.body.classList.toggle('menu');
    tog.setAttribute('aria-expanded',open?'true':'false');
  });
  document.querySelectorAll('#menu a').forEach(function(a){
    a.addEventListener('click',function(){document.body.classList.remove('menu');tog.setAttribute('aria-expanded','false')});
  });
})();

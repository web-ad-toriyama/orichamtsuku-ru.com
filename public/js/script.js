// font
(function(d) {
  var config = {
    kitId: 'tbp6hcd',
    scriptTimeout: 3000,
    async: true
  },
  h=d.documentElement,t=setTimeout(function(){h.className=h.className.replace(/\bwf-loading\b/g,"")+" wf-inactive";},config.scriptTimeout),tk=d.createElement("script"),f=false,s=d.getElementsByTagName("script")[0],a;h.className+=" wf-loading";tk.src='https://use.typekit.net/'+config.kitId+'.js';tk.async=true;tk.onload=tk.onreadystatechange=function(){a=this.readyState;if(f||a&&a!="complete"&&a!="loaded")return;f=true;clearTimeout(t);try{Typekit.load(config)}catch(e){}};s.parentNode.insertBefore(tk,s)
})(document);

// #を消す記述
window.onhashchange = () => {
  if (window.location.hash === '#top') {
    window.history.replaceState(null, '', window.location.pathname + window.location.search);
  }
};

// スマホでhoverを無効にする記述
var touch = 'ontouchstart' in document.documentElement
            || navigator.maxTouchPoints > 0
            || navigator.msMaxTouchPoints > 0;

if (touch) { // remove all :hover stylesheets
    try { // prevent exception on browsers not supporting DOM styleSheets properly
        for (var si in document.styleSheets) {
            var styleSheet = document.styleSheets[si];
            if (!styleSheet.rules) continue;

            for (var ri = styleSheet.rules.length - 1; ri >= 0; ri--) {
                if (!styleSheet.rules[ri].selectorText) continue;

                if (styleSheet.rules[ri].selectorText.match(':hover')) {
                    styleSheet.deleteRule(ri);
                }
            }
        }
    } catch (ex) {}
}

// ハンバーガーメニューを開いている時はbodyにoverflow:hiddenをかける
document.getElementById('menu-btn').addEventListener('click', function(){
  document.body.classList.toggle('open')
});

// メインビジュアルのスライダー
const swiper = new Swiper('.mainvisual', {
  loop: true,
  slidesPerView: 1,
  autoplay: {
  delay: 4000,
  },
  pagination: {
  el: '.swiper-pagination',
  type: 'bullets',
  clickable: true,
  },
  speed: 2000,
  effect: 'slide',
  fadeEffect: {
  crossFade: true
  },
});
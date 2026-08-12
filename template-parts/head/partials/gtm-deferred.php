<!--
Google Tag Manager
Needed for analytics (GA/gtag is loaded by the GTM container — do not add a separate gtag snippet).
Deferred until first interaction or idle so it does not compete with LCP.
-->
<script>
(function(w,d,s,l,i){
  w[l]=w[l]||[];
  w[l].push({'gtm.start': new Date().getTime(), event:'gtm.js'});
  var loaded=false;
  function loadGTM(){
    if (loaded) return;
    loaded=true;
    var f=d.getElementsByTagName(s)[0], j=d.createElement(s), dl=l!='dataLayer'?'&l='+l:'';
    j.async=true;
    j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;
    f.parentNode.insertBefore(j,f);
  }
  function arm(){
    loadGTM();
    ['scroll','click','touchstart','keydown','pointerdown'].forEach(function(evt){
      w.removeEventListener(evt, arm, {passive:true});
    });
  }
  ['scroll','click','touchstart','keydown','pointerdown'].forEach(function(evt){
    w.addEventListener(evt, arm, {passive:true});
  });
  if ('requestIdleCallback' in w) {
    requestIdleCallback(loadGTM, { timeout: 6000 });
  } else {
    w.addEventListener('load', function(){ setTimeout(loadGTM, 4000); });
  }
})(window,document,'script','dataLayer','GTM-KSB2XVQ');
</script>
<!-- End Google Tag Manager -->

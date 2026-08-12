<?php
// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

// Bebas is not needed for LCP (hero uses Euclid). Inject after load so W3TC
// cannot turn it into an extra render-blocking stylesheet.
$bebas = 'https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap';
?>
<link href="https://fonts.googleapis.com" rel="preconnect">
<link href="https://fonts.gstatic.com" rel="preconnect" crossorigin="anonymous">
<script>
(function(){
  function loadBebas(){
    var l=document.createElement('link');
    l.rel='stylesheet';
    l.href=<?php echo json_encode( $bebas ); ?>;
    document.head.appendChild(l);
  }
  if (window.requestIdleCallback) {
    requestIdleCallback(loadBebas, { timeout: 4000 });
  } else {
    window.addEventListener('load', function(){ setTimeout(loadBebas, 2000); });
  }
})();
</script>
<script type="text/javascript">!function(o,c){var n=c.documentElement,t=" w-mod-";n.className+=t+"js",("ontouchstart"in o||o.DocumentTouch&&c instanceof DocumentTouch)&&(n.className+=t+"touch")}(window,document);</script>

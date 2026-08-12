<script type="text/javascript">var $ = window.jQuery;</script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/trafigura-staging.js?v=1786536781" type="text/javascript"></script>
<?php
// Homepage: keep Webflow staging sync for nav; load GSAP/Swiper/animations
// after window load so they do not compete with LCP (hero poster + fonts).
$vendor = trailingslashit( get_template_directory_uri() . '/assets/js/vendor' );
$code   = trailingslashit( get_template_directory_uri() . '/code' );
$srcs   = [
	$vendor . 'gsap.min.js',
	$vendor . 'ScrollTrigger.min.js',
	$vendor . 'CustomEase.min.js',
	$vendor . 'swiper-bundle.min.js',
	$code . 'script.js?v=1786548000',
];
?>
<script>
(function () {
  var srcs = <?php echo wp_json_encode( $srcs ); ?>;
  function loadChain(i) {
    if (i >= srcs.length) return;
    var s = document.createElement('script');
    s.src = srcs[i];
    s.onload = function () { loadChain(i + 1); };
    s.onerror = function () { loadChain(i + 1); };
    document.body.appendChild(s);
  }
  function start() {
    if ('requestIdleCallback' in window) {
      requestIdleCallback(function () { loadChain(0); }, { timeout: 2000 });
    } else {
      setTimeout(function () { loadChain(0); }, 1);
    }
  }
  if (document.readyState === 'complete') start();
  else window.addEventListener('load', start);
})();
</script>

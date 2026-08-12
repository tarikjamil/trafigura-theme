<meta charset="utf-8">
<meta content="Home" name="twitter:title">
<meta content="width=device-width, initial-scale=1" name="viewport">
<?php wp_enqueue_style('normalize', get_template_directory_uri() . '/assets/css/normalize.css', [], '1786536781'); ?>
<?php wp_enqueue_style('components', get_template_directory_uri() . '/assets/css/components.css', [], '1786536781'); ?>
<?php wp_enqueue_style('trafigura-staging', get_template_directory_uri() . '/assets/css/trafigura-staging.css', [], '1786536781'); ?>
<link href="https://fonts.googleapis.com" rel="preconnect">
<link href="https://fonts.gstatic.com" rel="preconnect" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js" type="text/javascript"></script>
<script type="text/javascript">WebFont.load({
google: {
families: ["Bebas Neue:300,400,500,600,700"]
}});</script>
<script type="text/javascript">!function(o,c){var n=c.documentElement,t=" w-mod-";n.className+=t+"js",("ontouchstart"in o||o.DocumentTouch&&c instanceof DocumentTouch)&&(n.className+=t+"touch")}(window,document);</script>
<link href="<?php echo get_template_directory_uri(); ?>/assets/images/favicon.png?v=1786536781" rel="shortcut icon" type="image/x-icon">
<link href="<?php echo get_template_directory_uri(); ?>/assets/images/webclip.png?v=1786536781" rel="apple-touch-icon">
<link rel="preload" as="image" href="<?php echo esc_url( get_template_directory_uri() . '/assets/images/home-hero-poster.jpg' ); ?>" fetchpriority="high">
<!--
Google Tag Manager (deferred until idle/load to protect LCP)
-->
<script>
(function(w,d,s,l,i){
  w[l]=w[l]||[];
  w[l].push({'gtm.start': new Date().getTime(), event:'gtm.js'});
  function loadGTM(){
    var f=d.getElementsByTagName(s)[0], j=d.createElement(s), dl=l!='dataLayer'?'&l='+l:'';
    j.async=true;
    j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;
    f.parentNode.insertBefore(j,f);
  }
  if ('requestIdleCallback' in w) {
    requestIdleCallback(loadGTM, { timeout: 3500 });
  } else {
    w.addEventListener('load', function(){ setTimeout(loadGTM, 1500); });
  }
})(window,document,'script','dataLayer','GTM-KSB2XVQ');
</script>
<!--
End Google Tag Manager
-->
<link href="https://trafigura-code.netlify.app/style.css" rel="stylesheet">
<style>
  .hero-poster {
    z-index: 0;
    object-fit: cover;
  }
  .hero-video-wrap {
    z-index: 1;
  }
  .hero-video-wrap[hidden] {
    display: none !important;
  }
  .hero-video {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }
  @media (max-width: 991px) {
    .hero-video-wrap {
      display: none !important;
    }
  }
</style>
<meta charset="utf-8">
<meta content="Home" name="twitter:title">
<meta content="width=device-width, initial-scale=1" name="viewport">
<?php wp_enqueue_style('normalize', get_template_directory_uri() . '/assets/css/normalize.css', [], '1786541200'); ?>
<?php wp_enqueue_style('components', get_template_directory_uri() . '/assets/css/components.css', [], '1786541200'); ?>
<?php wp_enqueue_style('trafigura-staging', get_template_directory_uri() . '/assets/css/trafigura-staging.css', [], '1786541200'); ?>
<link href="https://fonts.googleapis.com" rel="preconnect">
<link href="https://fonts.gstatic.com" rel="preconnect" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js" type="text/javascript"></script>
<script type="text/javascript">WebFont.load({
google: {
families: ["Bebas Neue:300,400,500,600,700"]
}});</script>
<script type="text/javascript">!function(o,c){var n=c.documentElement,t=" w-mod-";n.className+=t+"js",("ontouchstart"in o||o.DocumentTouch&&c instanceof DocumentTouch)&&(n.className+=t+"touch")}(window,document);</script>
<link href="<?php echo get_template_directory_uri(); ?>/assets/images/favicon.png?v=1786541200" rel="shortcut icon" type="image/x-icon">
<link href="<?php echo get_template_directory_uri(); ?>/assets/images/webclip.png?v=1786541200" rel="apple-touch-icon">
<link rel="preload" as="image" href="<?php echo esc_url( get_template_directory_uri() . '/assets/images/home-hero-poster.jpg' ); ?>" fetchpriority="high">
<?php get_template_part('template-parts/head/partials/gtm-deferred'); ?>

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
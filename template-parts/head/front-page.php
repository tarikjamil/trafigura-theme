<meta charset="utf-8">
<meta content="Home" name="twitter:title">
<meta content="width=device-width, initial-scale=1" name="viewport">
<?php wp_enqueue_style('normalize', get_template_directory_uri() . '/assets/css/normalize.css', [], '1786542500'); ?>
<?php wp_enqueue_style('components', get_template_directory_uri() . '/assets/css/components.css', [], '1786542500'); ?>
<?php wp_enqueue_style('trafigura-staging', get_template_directory_uri() . '/assets/css/trafigura-staging.css', [], '1786542500'); ?>
<?php get_template_part('template-parts/head/partials/bebas-font'); ?>
<link href="<?php echo get_template_directory_uri(); ?>/assets/images/favicon.png?v=1786542500" rel="shortcut icon" type="image/x-icon">
<link href="<?php echo get_template_directory_uri(); ?>/assets/images/webclip.png?v=1786542500" rel="apple-touch-icon">
<link rel="preload" as="image" href="<?php echo esc_url( get_template_directory_uri() . '/assets/images/home-hero-poster.jpg' ); ?>" fetchpriority="high">
<?php get_template_part('template-parts/head/partials/gtm-deferred'); ?>

<style>.main-wrapper{opacity:0}</style>
<link rel="preload" href="<?php echo get_template_directory_uri(); ?>/code/style.css?v=1786542500" as="style" onload="this.onload=null;this.rel='stylesheet'">
<noscript><link href="<?php echo get_template_directory_uri(); ?>/code/style.css?v=1786542500" rel="stylesheet"></noscript>
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
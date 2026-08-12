<meta charset="utf-8">
<meta content="Home" name="twitter:title">
<meta content="width=device-width, initial-scale=1" name="viewport">
<?php wp_enqueue_style('trafigura-bundle', get_template_directory_uri() . '/assets/css/trafigura-bundle.css', [], '1786545000'); ?>
<?php get_template_part('template-parts/head/partials/bebas-font'); ?>
<link href="<?php echo get_template_directory_uri(); ?>/assets/images/favicon.png?v=1786545000" rel="shortcut icon" type="image/x-icon">
<link href="<?php echo get_template_directory_uri(); ?>/assets/images/webclip.png?v=1786545000" rel="apple-touch-icon">
<link rel="preload" as="image" href="<?php echo esc_url( get_template_directory_uri() . '/assets/images/home-hero-poster-960.webp' ); ?>" type="image/webp" fetchpriority="high">
<link rel="preload" as="font" href="<?php echo esc_url( get_template_directory_uri() . '/assets/fonts/euclid-circular-b-medium.woff2' ); ?>" type="font/woff2" crossorigin>
<?php get_template_part('template-parts/head/partials/gtm-deferred'); ?>

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
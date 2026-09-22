<meta charset="utf-8">
<meta content="width=device-width, initial-scale=1" name="viewport">
<?php wp_enqueue_style('trafigura-bundle', get_template_directory_uri() . '/assets/css/trafigura-bundle.css', [], '1789407000'); ?>
<?php get_template_part('template-parts/head/partials/bebas-font'); ?>
<link href="<?php echo get_template_directory_uri(); ?>/assets/images/favicon.png?v=1786555000" rel="shortcut icon" type="image/x-icon">
<link href="<?php echo get_template_directory_uri(); ?>/assets/images/webclip.png?v=1786555000" rel="apple-touch-icon">
<link rel="preload" as="image" href="<?php echo esc_url( get_template_directory_uri() . '/assets/images/home-hero-poster-960.webp' ); ?>" type="image/webp" fetchpriority="high">
<link rel="preload" as="font" href="<?php echo esc_url( get_template_directory_uri() . '/assets/fonts/euclid-circular-b-medium.woff2' ); ?>" type="font/woff2" crossorigin>
<?php get_template_part('template-parts/head/partials/gtm-deferred'); ?>

<style>
  /* Critical hero layout — paint LCP poster before trafigura-bundle.css */
  .section.is--home-hero {
    position: relative;
    color: #fff;
    text-align: center;
  }
  .hero-image-wrapper {
    aspect-ratio: 1440 / 634;
    justify-content: center;
    align-items: center;
    width: 100%;
    position: absolute;
    inset: 0 auto auto 0;
  }
  .img--absolute {
    object-fit: cover;
    width: 100%;
    height: 100%;
    position: absolute;
    inset: auto auto 0% 0%;
  }
  .hero-poster {
    z-index: 0;
    object-fit: cover;
  }
  .hero-overlay {
    z-index: 2;
    pointer-events: none;
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
    .hero-image-wrapper {
      aspect-ratio: 390 / 510;
    }
    .hero-video-wrap {
      display: none !important;
    }
  }
</style>

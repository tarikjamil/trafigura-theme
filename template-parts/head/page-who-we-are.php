<meta charset="utf-8">
<meta content="width=device-width, initial-scale=1" name="viewport">
<?php wp_enqueue_style('trafigura-bundle', get_template_directory_uri() . '/assets/css/trafigura-bundle.css', [], '1789407000'); ?>
<?php get_template_part('template-parts/head/partials/bebas-font'); ?>
<link href="<?php echo get_template_directory_uri(); ?>/assets/images/favicon.png?v=1786555000" rel="shortcut icon" type="image/x-icon">
<link href="<?php echo get_template_directory_uri(); ?>/assets/images/webclip.png?v=1786555000" rel="apple-touch-icon">
<link rel="preload" as="image" href="<?php echo esc_url( get_template_directory_uri() . '/assets/images/01.WHO-WE-ARE-800.webp' ); ?>" type="image/webp" media="(max-width: 991px)" fetchpriority="high">
<link rel="preload" as="image" href="<?php echo esc_url( get_template_directory_uri() . '/assets/images/01.WHO-WE-ARE_101.WHO-WE-ARE.webp' ); ?>" type="image/webp" media="(min-width: 992px)" fetchpriority="high">
<?php get_template_part('template-parts/head/partials/gtm-deferred'); ?>

<style>
  /* Critical hero layout — paint LCP image before trafigura-bundle.css */
  .hero-image-wrapper {
    aspect-ratio: 1440 / 634;
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
  @media screen and (max-width: 991px) {
    .hero-image-wrapper {
      aspect-ratio: 390 / 510;
    }
  }
</style>

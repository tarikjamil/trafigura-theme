<meta charset="utf-8">
<meta content="width=device-width, initial-scale=1" name="viewport">
<?php wp_enqueue_style('trafigura-bundle', get_template_directory_uri() . '/assets/css/trafigura-bundle.css', [], '1793780000'); ?>
<?php get_template_part('template-parts/head/partials/bebas-font'); ?>
<link href="<?php echo get_template_directory_uri(); ?>/assets/images/favicon.png?v=1786555000" rel="shortcut icon" type="image/x-icon">
<link href="<?php echo get_template_directory_uri(); ?>/assets/images/webclip.png?v=1786555000" rel="apple-touch-icon">
<?php
// Shared head for Areas hub + area-of-work singles — preload only the LCP that will paint.
$area_hero_preload = function_exists( 'trafigura_area_hero_image' ) ? trafigura_area_hero_image() : null;
if ( $area_hero_preload ) :
	$area_hero_800 = preg_replace( '/-1080\.webp$/', '-800.webp', $area_hero_preload->src );
?>
<link rel="preload" as="image" href="<?php echo esc_url( $area_hero_800 ); ?>" type="image/webp" media="(max-width: 991px)" fetchpriority="high">
<link rel="preload" as="image" href="<?php echo esc_url( $area_hero_preload->src ); ?>" type="image/webp" media="(min-width: 992px)" fetchpriority="high">
<style id="area-hero-critical">
.section.is--storytemplate-hero{position:relative}
.template-image-wrapper{position:relative;overflow:hidden;aspect-ratio:1440/634}
@media screen and (max-width:991px){.template-image-wrapper{aspect-ratio:390/510}}
.template-image-wrapper .img--absolute{position:absolute;inset:0;width:100%;height:100%;object-fit:cover}
</style>
<?php else : ?>
<link rel="preload" as="image" href="<?php echo esc_url( get_template_directory_uri() . '/assets/images/04.AREAS-OF-WORK-800.webp' ); ?>" type="image/webp" media="(max-width: 991px)" fetchpriority="high">
<link rel="preload" as="image" href="<?php echo esc_url( get_template_directory_uri() . '/assets/images/04.AREAS-OF-WORK-1440.webp' ); ?>" type="image/webp" media="(min-width: 992px)" fetchpriority="high">
<?php get_template_part('template-parts/head/partials/hero-critical-css'); ?>
<?php endif; ?>
<?php get_template_part('template-parts/head/partials/gtm-deferred'); ?>

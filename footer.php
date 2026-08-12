<?php
// Exit if accessed directly
defined( 'ABSPATH' ) || exit;
?>
<?php

$args = wp_parse_args($args, [
        'footer' => 'footer/front-page',
]);

// jQuery must load before theme/GSAP/Swiper/Netlify scripts below,
// but stay out of <head> so it is not render-blocking.
if ( function_exists( 'wp_scripts' ) ) {
        wp_enqueue_script( 'jquery' );
        wp_print_scripts( 'jquery' );
}

get_template_part('template-parts/' . $args['footer']);

wp_footer();   

?>
    </body>
</html>

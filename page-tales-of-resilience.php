<?php
/**
 * Page template for /tales-of-resilience/ (slug after resistence → resilience rename).
 * Reuses the Tales of Resilience content/head/footer partials from the original export name.
 */

$args = [
	'wfPage' => '67f3ec4bd1e7bbdc4df938be',
	'body'   => 'body--blue',
	'head'   => 'head/page-tales-of-resistence',
];

if ( function_exists( 'udesly_set_frontend_editor_data' ) ) {
	udesly_set_frontend_editor_data( 'page-tales-of-resistence' );
}

get_header( '', $args );

while ( have_posts() ) :
	the_post();
	udesly_get_content_template( 'page-tales-of-resistence' );
endwhile;

$args = [
	'footer' => 'footer/page-tales-of-resistence',
];

if ( function_exists( 'udesly_output_frontend_editor_data' ) ) {
	udesly_output_frontend_editor_data( 'page-tales-of-resistence' );
}

get_footer( '', $args );

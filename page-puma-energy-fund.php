<?php
/**
 * Page template for /puma-energy-fund/
 * Intro + short copy linking to the Puma Energy Fund website.
 */

$args = [
	'wfPage' => '65f6da4b3eae060f246a6dce',
	'body'   => '',
	'head'   => 'head/page-puma-energy-fund',
];

if ( function_exists( 'udesly_set_frontend_editor_data' ) ) {
	udesly_set_frontend_editor_data( 'page-puma-energy-fund' );
}

get_header( '', $args );

while ( have_posts() ) :
	the_post();
	udesly_get_content_template( 'page-puma-energy-fund' );
endwhile;

$args = [
	'footer' => 'footer/page-puma-energy-fund',
];

if ( function_exists( 'udesly_output_frontend_editor_data' ) ) {
	udesly_output_frontend_editor_data( 'page-puma-energy-fund' );
}

get_footer( '', $args );

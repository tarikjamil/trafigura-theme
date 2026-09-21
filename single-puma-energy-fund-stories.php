<?php
/**
 * Single Puma Energy Fund story.
 */

$args = [
	'wfPage' => '65f6c3ae3ad798ab04d846bf',
	'body'   => '',
	'head'   => 'head/page-areas-of-work',
];

if ( function_exists( 'udesly_set_frontend_editor_data' ) ) {
	udesly_set_frontend_editor_data( 'single-puma-energy-fund-stories' );
}

get_header( '', $args );

while ( have_posts() ) :
	the_post();
	udesly_get_content_template( 'single-puma-energy-fund-stories' );
endwhile;

$args = [
	'footer' => 'footer/single-puma-energy-fund-stories',
];

if ( function_exists( 'udesly_output_frontend_editor_data' ) ) {
	udesly_output_frontend_editor_data( 'single-puma-energy-fund-stories' );
}

get_footer( '', $args );

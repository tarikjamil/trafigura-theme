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
	udesly_set_frontend_editor_data( 'single-puma-fund-story' );
}

get_header( '', $args );

while ( have_posts() ) :
	the_post();
	udesly_get_content_template( 'single-puma-fund-story' );
endwhile;

$args = [
	'footer' => 'footer/single-puma-fund-story',
];

if ( function_exists( 'udesly_output_frontend_editor_data' ) ) {
	udesly_output_frontend_editor_data( 'single-puma-fund-story' );
}

get_footer( '', $args );

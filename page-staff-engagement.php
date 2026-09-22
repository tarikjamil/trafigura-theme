<?php
/**
 * Staff Engagement — public layout (Voices of Impact + Staff in Action).
 * Former parallel redesign; /staff-engagement-new/ 301s here.
 */

$args = [
	'wfPage' => '6608419d9296b283f0db2302',
	'body'   => '',
	'head'   => 'head/page-staff-engagement',
];

if ( function_exists( 'udesly_set_frontend_editor_data' ) ) {
	udesly_set_frontend_editor_data( 'page-staff-engagement' );
}

get_header( '', $args );

while ( have_posts() ) :
	the_post();
	udesly_get_content_template( 'page-staff-engagement' );
endwhile;

$args = [
	'footer' => 'footer/page-staff-engagement',
];

if ( function_exists( 'udesly_output_frontend_editor_data' ) ) {
	udesly_output_frontend_editor_data( 'page-staff-engagement' );
}

get_footer( '', $args );

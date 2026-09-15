<?php
/**
 * Page template for /staff-engagement-new/
 * New Staff Engagement layout (video, Voices of Impact, Staff in Action map).
 */

$args = [
	'wfPage' => '6608419d9296b283f0db2302',
	'body'   => '',
	'head'   => 'head/page-staff-engagement-new',
];

if ( function_exists( 'udesly_set_frontend_editor_data' ) ) {
	udesly_set_frontend_editor_data( 'page-staff-engagement-new' );
}

get_header( '', $args );

while ( have_posts() ) :
	the_post();
	udesly_get_content_template( 'page-staff-engagement-new' );
endwhile;

$args = [
	'footer' => 'footer/page-staff-engagement-new',
];

if ( function_exists( 'udesly_output_frontend_editor_data' ) ) {
	udesly_output_frontend_editor_data( 'page-staff-engagement-new' );
}

get_footer( '', $args );

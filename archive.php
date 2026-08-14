<?php
/**
 * Fallback archive template.
 *
 * Never render the homepage here — that created soft-404 / duplicate-content
 * URLs (e.g. /tales/ indexed with homepage HTML). Prefer 301s to the public hub.
 */
defined( 'ABSPATH' ) || exit;

$target = home_url( '/' );
$code   = 301;

if ( is_post_type_archive( 'tales' ) ) {
	$target = home_url( '/tales-of-resilience/' );
} elseif ( is_post_type_archive( 'news' ) ) {
	$target = home_url( '/content-hub/' );
} elseif ( is_post_type_archive( 'partner-stories' ) ) {
	$target = home_url( '/partners-stories/' );
} elseif ( is_post_type_archive( 'area-of-work' ) || is_tax( 'areas' ) ) {
	$target = home_url( '/areas-of-work/' );
} elseif ( is_post_type_archive( 'team' ) ) {
	$target = home_url( '/who-we-are/' );
} elseif ( is_search() ) {
	// Search has no real results UI; send users to Content Hub.
	$target = home_url( '/content-hub/' );
	$code   = 302;
}

wp_safe_redirect( $target, $code );
exit;

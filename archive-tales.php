<?php
/**
 * Tales CPT archive → public Tales of Resilience page.
 */
defined( 'ABSPATH' ) || exit;

wp_safe_redirect( home_url( '/tales-of-resilience/' ), 301 );
exit;

<?php
/**
 * Legacy parallel URL — redesign now lives at /staff-engagement/.
 */
defined( 'ABSPATH' ) || exit;
wp_safe_redirect( home_url( '/staff-engagement/' ), 301 );
exit;

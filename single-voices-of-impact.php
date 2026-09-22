<?php
/**
 * Voices of Impact singles are not public pages (noindex, not in sitemap).
 */
defined( 'ABSPATH' ) || exit;
wp_safe_redirect( home_url( '/staff-engagement/' ), 301 );
exit;

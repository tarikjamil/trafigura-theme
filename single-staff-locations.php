<?php
/**
 * Staff location singles are data for the Staff Engagement map, not public pages.
 */
defined( 'ABSPATH' ) || exit;

wp_safe_redirect( home_url( '/staff-engagement/' ), 301 );
exit;

<?php
/**
 * Voices of Impact singles are not public — open the Staff Engagement New hub.
 */
defined( 'ABSPATH' ) || exit;
wp_safe_redirect( home_url( '/staff-engagement/' ), 301 );
exit;

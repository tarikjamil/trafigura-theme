<?php
// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

// Bebas Neue only has regular (400). Load non-blocking — do not use webfont.js.
$bebas = 'https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap';
?>
<link href="https://fonts.googleapis.com" rel="preconnect">
<link href="https://fonts.gstatic.com" rel="preconnect" crossorigin="anonymous">
<link rel="preload" as="style" href="<?php echo esc_url( $bebas ); ?>">
<link rel="stylesheet" href="<?php echo esc_url( $bebas ); ?>" media="print" onload="this.media='all'">
<noscript><link rel="stylesheet" href="<?php echo esc_url( $bebas ); ?>"></noscript>
<script type="text/javascript">!function(o,c){var n=c.documentElement,t=" w-mod-";n.className+=t+"js",("ontouchstart"in o||o.DocumentTouch&&c instanceof DocumentTouch)&&(n.className+=t+"touch")}(window,document);</script>

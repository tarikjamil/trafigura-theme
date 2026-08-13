<?php
// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

// Rem root MUST be in <head> before rem-based CSS paints.
// Leaving it only in body embeds causes a late snap → CLS + delayed LCP.
?>
<style id="trafigura-rem-root">
html{font-size:calc(100vw/1480)}
@media screen and (min-width:1480px){html{font-size:1px}}
@media screen and (min-width:768px) and (max-width:991px){html{font-size:calc(100vw/768)}}
@media screen and (min-width:480px) and (max-width:767px){html{font-size:calc(100vw/480)}}
@media screen and (max-width:479px){html{font-size:calc(100vw/375)}}
/* Desktop: reserve sidebar width early so #smooth-content does not shift horizontally */
@media screen and (min-width:992px){
  .navbar{width:272rem;min-width:272rem;flex:none;flex-shrink:0}
  .content--page{min-width:0;flex:1}
}
</style>

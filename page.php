<?php


$args = [
    'wfPage' => '66016ca6117044a2bf79486f',
    'body' => '',
    'head' => 'head/page',
];   

if (function_exists('udesly_set_frontend_editor_data')) {
    udesly_set_frontend_editor_data('page');
}
     
get_header('', $args);

/* Start the Loop */
while ( have_posts() ) :
    the_post();
    udesly_get_content_template( 'page' );
endwhile;
// End of the loop.

$args = [
  'footer' => 'footer/page-contact',
];  

if (function_exists('udesly_output_frontend_editor_data')) {
     udesly_output_frontend_editor_data('page');
}

get_footer('', $args);

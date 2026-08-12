<?php


$args = [
    'wfPage' => '67f4046dbc882691d53d7e51',
    'body' => 'body--blue',
    'head' => 'head/single-tales',
];   

if (function_exists('udesly_set_frontend_editor_data')) {
    udesly_set_frontend_editor_data('single-tales');
}
     
get_header('', $args);

/* Start the Loop */
while ( have_posts() ) :
    the_post();
    udesly_get_content_template( 'single-tales' );
endwhile;
// End of the loop.

$args = [
  'footer' => 'footer/single-tales',
];  

if (function_exists('udesly_output_frontend_editor_data')) {
     udesly_output_frontend_editor_data('single-tales');
}

get_footer('', $args);

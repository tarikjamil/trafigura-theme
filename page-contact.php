<?php


$args = [
    'wfPage' => '65f714d2af797839258b64f9',
    'body' => '',
    'head' => 'head/page-contact',
];   

if (function_exists('udesly_set_frontend_editor_data')) {
    udesly_set_frontend_editor_data('page-contact');
}
     
get_header('', $args);

/* Start the Loop */
while ( have_posts() ) :
    the_post();
    udesly_get_content_template( 'page-contact' );
endwhile;
// End of the loop.

$args = [
  'footer' => 'footer/page-contact',
];  

if (function_exists('udesly_output_frontend_editor_data')) {
     udesly_output_frontend_editor_data('page-contact');
}

get_footer('', $args);

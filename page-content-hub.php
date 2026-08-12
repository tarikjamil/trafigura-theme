<?php


$args = [
    'wfPage' => '65f79aa0da0ebbf122772ddf',
    'body' => '',
    'head' => 'head/page-content-hub',
];   

if (function_exists('udesly_set_frontend_editor_data')) {
    udesly_set_frontend_editor_data('page-content-hub');
}
     
get_header('', $args);

/* Start the Loop */
while ( have_posts() ) :
    the_post();
    udesly_get_content_template( 'page-content-hub' );
endwhile;
// End of the loop.

$args = [
  'footer' => 'footer/page-content-hub',
];  

if (function_exists('udesly_output_frontend_editor_data')) {
     udesly_output_frontend_editor_data('page-content-hub');
}

get_footer('', $args);

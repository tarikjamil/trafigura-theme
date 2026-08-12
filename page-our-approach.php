<?php


$args = [
    'wfPage' => '65fae47061ac24eacbf37990',
    'body' => '',
    'head' => 'head/page-our-approach',
];   

if (function_exists('udesly_set_frontend_editor_data')) {
    udesly_set_frontend_editor_data('page-our-approach');
}
     
get_header('', $args);

/* Start the Loop */
while ( have_posts() ) :
    the_post();
    udesly_get_content_template( 'page-our-approach' );
endwhile;
// End of the loop.

$args = [
  'footer' => 'footer/page-contact',
];  

if (function_exists('udesly_output_frontend_editor_data')) {
     udesly_output_frontend_editor_data('page-our-approach');
}

get_footer('', $args);

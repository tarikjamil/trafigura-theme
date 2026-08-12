<?php


$args = [
    'wfPage' => '65fad0c3b8980ceff106c775',
    'body' => '',
    'head' => 'head/page-areas-of-work',
];   

if (function_exists('udesly_set_frontend_editor_data')) {
    udesly_set_frontend_editor_data('single-area-of-work');
}
     
get_header('', $args);

/* Start the Loop */
while ( have_posts() ) :
    the_post();
    udesly_get_content_template( 'single-area-of-work' );
endwhile;
// End of the loop.

$args = [
  'footer' => 'footer/single-area-of-work',
];  

if (function_exists('udesly_output_frontend_editor_data')) {
     udesly_output_frontend_editor_data('single-area-of-work');
}

get_footer('', $args);

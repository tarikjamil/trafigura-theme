<?php


$args = [
    'wfPage' => '65f6c3ae3ad798ab04d846be',
    'body' => 'body--white',
    'head' => 'head/page-areas-of-work',
];   

if (function_exists('udesly_set_frontend_editor_data')) {
    udesly_set_frontend_editor_data('single-news');
}
     
get_header('', $args);

/* Start the Loop */
while ( have_posts() ) :
    the_post();
    udesly_get_content_template( 'single-news' );
endwhile;
// End of the loop.

$args = [
  'footer' => 'footer/single-news',
];  

if (function_exists('udesly_output_frontend_editor_data')) {
     udesly_output_frontend_editor_data('single-news');
}

get_footer('', $args);

<?php


$args = [
    'wfPage' => '65f6da4b3eae060f246a6dce',
    'body' => '',
    'head' => 'head/page-partners-stories',
];   

if (function_exists('udesly_set_frontend_editor_data')) {
    udesly_set_frontend_editor_data('page-partners-stories');
}
     
get_header('', $args);

/* Start the Loop */
while ( have_posts() ) :
    the_post();
    udesly_get_content_template( 'page-partners-stories' );
endwhile;
// End of the loop.

$args = [
  'footer' => 'footer/page-partners-stories',
];  

if (function_exists('udesly_output_frontend_editor_data')) {
     udesly_output_frontend_editor_data('page-partners-stories');
}

get_footer('', $args);

<?php


$args = [
    'wfPage' => '65f6c3ae3ad798ab04d846c2',
    'body' => '',
    'head' => 'head/page-do-not-delete',
];   

if (function_exists('udesly_set_frontend_editor_data')) {
    udesly_set_frontend_editor_data('page-do-not-delete');
}
     
get_header('', $args);

/* Start the Loop */
while ( have_posts() ) :
    the_post();
    udesly_get_content_template( 'page-do-not-delete' );
endwhile;
// End of the loop.

$args = [
  'footer' => 'footer/page-do-not-delete',
];  

if (function_exists('udesly_output_frontend_editor_data')) {
     udesly_output_frontend_editor_data('page-do-not-delete');
}

get_footer('', $args);

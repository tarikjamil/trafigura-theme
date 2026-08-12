<?php


$args = [
    'wfPage' => '65f83ef74e26082bfd2ebc15',
    'body' => '',
    'head' => 'head/page-who-we-are',
];   

if (function_exists('udesly_set_frontend_editor_data')) {
    udesly_set_frontend_editor_data('page-who-we-are');
}
     
get_header('', $args);

/* Start the Loop */
while ( have_posts() ) :
    the_post();
    udesly_get_content_template( 'page-who-we-are' );
endwhile;
// End of the loop.

$args = [
  'footer' => 'footer/page-contact',
];  

if (function_exists('udesly_output_frontend_editor_data')) {
     udesly_output_frontend_editor_data('page-who-we-are');
}

get_footer('', $args);

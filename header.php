<?php
// Exit if accessed directly
defined( 'ABSPATH' ) || exit;
?>
<!DOCTYPE html>
<?php

    $args = wp_parse_args($args, [
        'wfPage' => '65f6c491b11f2cc9f4e4fc78',
        'head' => 'head/front-page',
        'body' => ''
    ]);

?>
<html data-wf-page="<?php echo $args['wfPage'] ?>" data-wf-site="65f6c3ae3ad798ab04d846c3" lang="en" <?php language_attributes(); ?>><head><?php get_template_part( 'template-parts/head/partials/rem-root' ); ?><?php get_template_part( 'template-parts/' . $args['head'] );  ?><?php wp_enqueue_script('jquery'); wp_head(); ?></head>
<body <?php body_class($args["body"]); ?>>
<?php wp_body_open(); ?>
 
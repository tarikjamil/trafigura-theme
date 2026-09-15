<?php
// Exit if accessed directly
defined( 'ABSPATH' ) || exit;
?>
<?php
            if (function_exists('udesly_set_frontend_editor_data') && wp_doing_ajax()) {
              udesly_set_frontend_editor_data('page-staff-engagement-new');
          }
?>
<?php

        if (isset($_GET['p_id'])) {
          $paged = $_GET['p_id'];
        } else {
          $paged = isset($args['paged']) ? $args['paged'] : 1;
        }



$args = [
  "post_type" => "staff-locations",
  "posts_per_page" => -1,
  "orderby" => "date",
  "order" => "ASC",
  "paged" => $paged
];

$args = apply_filters('udesly/posts/staff-locations', $args);

        $query = new WP_Query($args);
?>
<div class="collection-list-wrapper-3 w-dyn-list" udy-collection="staff-locations">
                <?php if ( $query->have_posts() ) : ?><div class="w-dyn-items">
                  <?php while ($query->have_posts()) : $query->the_post(); global $post;
                    $loc_img = udesly_get_image();
                    $loc_city = get_the_title();
                    $loc_continent = udesly_get_custom_post_field( $post->ID, "continent", "Option" );
                    $loc_alt = function_exists( 'trafigura_image_alt' ) ? trafigura_image_alt( $loc_img->alt ?? '', $loc_city ) : ( $loc_img->alt ?? $loc_city );
                  ?><div class="w-dyn-item" data-city="<?php echo esc_attr( $loc_city ); ?>" data-continent="<?php echo esc_attr( $loc_continent ); ?>"><img class="skip-lazy no-lazy" data-no-lazy="1" src="<?php echo esc_url( $loc_img->src ); ?>" loading="eager" alt="<?php echo esc_attr( $loc_alt ); ?>" data-city="<?php echo esc_attr( $loc_city ); ?>" data-continent="<?php echo esc_attr( $loc_continent ); ?>" data-img="i317f733b" srcset="<?php echo esc_attr( $loc_img->srcset ); ?>" sizes="<?php echo esc_attr( $loc_img->sizes ?? '' ); ?>"></div><?php endwhile; ?>
                </div>
                <?php endif; ?>
              </div>
<?php wp_reset_postdata(); ?>

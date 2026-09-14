<?php
// Exit if accessed directly
defined( 'ABSPATH' ) || exit;
?>
<?php
            if (function_exists('udesly_set_frontend_editor_data') && wp_doing_ajax()) {
              udesly_set_frontend_editor_data('page-staff-engagement');
          }
?>
<?php

        if (isset($_GET['p_id'])) {
          $paged = $_GET['p_id'];
        } else {
          $paged = isset($args['paged']) ? $args['paged'] : 1;
        }



$args = [
  "post_type" => "partner-stories",
  "posts_per_page" => 6,
  "order" => "DESC",
  "orderby" => "date",
  "paged" => $paged
];

$args = apply_filters('udesly/posts/partner-stories-max-6-sorted-by-post_date-v0', $args);

        $query = new WP_Query($args);
?>
<div class="swiper is--slider-resources w-dyn-list" udy-collection="partner-stories">
                <?php if ( $query->have_posts() ) : ?><div class="swiper-wrapper w-dyn-items">
                  <?php while ($query->have_posts()) : $query->the_post(); global $post; ?><div class="swiper-slide is--nomax w-dyn-item">
                    <a href="<?php the_permalink() ?>" class="partner-item is--voice w-inline-block">
                      <?php $card_img = trafigura_card_image( '(max-width: 767px) 92vw, 467px' ); ?>
                      <div class="case-image-wrapper is--min260"><img src="<?php echo esc_url( $card_img->src ); ?>" loading="lazy" alt="<?php echo esc_attr( $card_img->alt ); ?>" class="img--absolute" data-img="i317f733b" srcset="<?php echo esc_attr( $card_img->srcset ); ?>" sizes="<?php echo esc_attr( $card_img->sizes ); ?>"></div>
                      <div class="case-bottom">
                        <div class="flexv">
                          <h3 class="heading-32 is--red"><?php the_title() ?></h3>
                        </div>
                      </div>
                    </a>
                  </div><?php endwhile; ?>
                </div>
                <?php endif; ?>
              </div>
<?php wp_reset_postdata(); ?>

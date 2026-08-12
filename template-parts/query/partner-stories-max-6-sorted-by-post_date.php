<?php
// Exit if accessed directly
defined( 'ABSPATH' ) || exit;
?>
<?php
            if (function_exists('udesly_set_frontend_editor_data') && wp_doing_ajax()) {
              udesly_set_frontend_editor_data('front-page');
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

$args = apply_filters('udesly/posts/partner-stories-max-6-sorted-by-post_date', $args);

        $query = new WP_Query($args);
?>
<div class="swiper is--slider-resources w-dyn-list" udy-collection="partner-stories">
                <?php if ( $query->have_posts() ) : ?><div class="swiper-wrapper w-dyn-items">
                  <?php while ($query->have_posts()) : $query->the_post(); global $post; ?><div role="listitem" class="swiper-slide is--nomax w-dyn-item">
                    <a href="<?php the_permalink() ?>" class="partner-item w-inline-block">
                      <?php $card_img = trafigura_card_image(); ?>
                      <div class="case-image-wrapper is--min260"><img src="<?php echo esc_url( $card_img->src ); ?>" loading="lazy" alt="<?php echo esc_attr( $card_img->alt ); ?>" class="img--absolute" data-img="i317f733b" srcset="<?php echo esc_attr( $card_img->srcset ); ?>" sizes="<?php echo esc_attr( $card_img->sizes ); ?>">
                        <div class="tags-wrapper">
                          <div class="tag-category-1">
                            <div class=""><?php echo udesly_get_custom_post_field( $post->ID, "place", "PlainText" ) ?></div>
                          </div>
                          <div class="ongoing">
                            <div class=""><?php echo udesly_get_custom_post_field( $post->ID, "state", "Option" ) ?></div>
                          </div>
                        </div>
                      </div>
                      <div class="case-bottom">
                        <div class="flexv">
                          <h3 class="heading-32 is--black2"><?php the_title() ?></h3>
                          <p class=""><?php echo udesly_get_custom_post_field( $post->ID, "description", "PlainText" ) ?></p>
                          <div sym-bind="9c5a8f75-3069-a8ef-e7a1-03c5306e8470" class="text-date"><?php echo get_the_date('F d, Y') ?></div>
                        </div>
                        <div class="btn is--ghost-blue">
                          <div class="btn-arrow is--shadow"><svg xmlns="http://www.w3.org/2000/svg" width="100%" viewBox="0 0 17.589 13.87" class="icon-arrow">
                              <path id="Tracé_42314" data-name="Tracé 42314" d="M8.769,0V3.97H0V9.9H8.769v3.97l8.819-6.935Z" transform="translate(0 0)" fill="currentColor"></path>
                            </svg></div>
                          <div>
                            <div class="max106">Read this story</div>
                          </div>
                        </div>
                      </div>
                    </a>
                  </div><?php endwhile; ?>
                </div>
                <?php else : ?><div class="w-dyn-empty">
                  <div>No items found.</div>
                </div><?php endif; ?>
              </div>
<?php wp_reset_postdata(); ?>
 
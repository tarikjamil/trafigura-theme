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
  "post_type" => "voices-of-impact",
  "posts_per_page" => -1,
  "order" => "DESC",
  "orderby" => "date",
  "paged" => $paged
];

$args = apply_filters('udesly/posts/voices-of-impacts', $args);

        $query = new WP_Query($args);
?>
<div class="swiper is--slider-resources w-dyn-list" udy-collection="voices-of-impact">
                <?php if ( $query->have_posts() ) : ?><div role="list" class="swiper-wrapper w-dyn-items">
                  <?php while ($query->have_posts()) : $query->the_post(); global $post;
                    $voice_video = trafigura_voice_video_url( $post->ID );
                    $card_img = trafigura_card_image( '(max-width: 767px) 92vw, 467px' );
                  ?><div role="listitem" class="swiper-slide is--nomax w-dyn-item">
                    <div class="partner-item is--voice" role="button" tabindex="0" data-video="<?php echo esc_attr( $voice_video ); ?>"<?php echo $voice_video ? '' : ' aria-disabled="true"'; ?>>
                      <div class="case-image-wrapper is--min260"><img src="<?php echo esc_url( $card_img->src ); ?>" loading="lazy" alt="<?php echo esc_attr( $card_img->alt ); ?>" class="img--absolute" data-img="i317f733b" srcset="<?php echo esc_attr( $card_img->srcset ); ?>" sizes="<?php echo esc_attr( $card_img->sizes ); ?>"><svg xmlns="http://www.w3.org/2000/svg" width="100%" viewBox="0 0 40 46" class="svg--play" aria-hidden="true">
                          <path id="Polygon_40" d="M23,0,46,40H0Z" transform="translate(40) rotate(90)" fill="currentColor"></path>
                        </svg></div>
                      <div class="case-bottom">
                        <div class="flexv">
                          <h3 class="heading-32 is--red"><?php the_title() ?></h3>
                        </div>
                      </div>
                    </div>
                  </div><?php endwhile; ?>
                </div>
                <?php endif; ?>
              </div>
<?php wp_reset_postdata(); ?>

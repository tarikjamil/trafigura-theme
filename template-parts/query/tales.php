<?php
// Exit if accessed directly
defined( 'ABSPATH' ) || exit;
?>
<?php
            if (function_exists('udesly_set_frontend_editor_data') && wp_doing_ajax()) {
              udesly_set_frontend_editor_data('page-tales-of-resistence');
          }
?>
<?php

        if (isset($_GET['p_id'])) {
          $paged = $_GET['p_id'];
        } else {
          $paged = isset($args['paged']) ? $args['paged'] : 1;
        }



$args = [
  "post_type" => "tales",
  "paged" => $paged
];

$args = apply_filters('udesly/posts/tales', $args);

        $query = new WP_Query($args);
?>
<div class="swiper is--tales-slider w-dyn-list" udy-collection="tales">
              <?php if ( $query->have_posts() ) : ?><div role="list" class="swiper-wrapper w-dyn-items">
                <?php while ($query->have_posts()) : $query->the_post(); global $post; ?><div role="listitem" class="swiper-slide is--nomax w-dyn-item">
                  <div class="tale--card-parent">
                    <div class="tale--card-top"><img src="<?php echo udesly_get_custom_post_field( $post->ID, "thumbnail", "ImageRef" )->src ?>" loading="lazy" alt="<?php echo udesly_get_custom_post_field( $post->ID, "thumbnail", "ImageRef" )->alt ?>" class="tale--card-img" data-img="i317f733b" srcset="<?php echo udesly_get_custom_post_field( $post->ID, "thumbnail", "ImageRef" )->srcset ?>">
                      <div id="w-node-_150d23a2-2573-98ca-80ad-1339f37482f1-4df938be" class="div-block-8">
                        <div class="tale--card-flex">
                          <div class="tale--card-number">
                            <div>ép.</div>
                            <div>&nbsp;</div>
                            <div class=""><?php echo udesly_get_custom_post_field( $post->ID, "episode-number", "PlainText" ) ?></div>
                          </div>
                        </div>
                        <div class="tale--card-flex is--2">
                          <div class="tales--card-name"><?php echo udesly_get_custom_post_field( $post->ID, "country", "PlainText" ) ?></div><img src="<?php echo udesly_get_custom_post_field( $post->ID, "country-flag", "ImageRef" )->src ?>" loading="lazy" alt="<?php echo udesly_get_custom_post_field( $post->ID, "country-flag", "ImageRef" )->alt ?>" class="flag--img" data-img="i317f733b" srcset="<?php echo udesly_get_custom_post_field( $post->ID, "country-flag", "ImageRef" )->srcset ?>">
                        </div>
                        <h2 class="heading--tales-card"><?php the_title() ?></h2>
                        <div class="div-block-10"><svg xmlns="http://www.w3.org/2000/svg" width="100%" viewBox="0 0 21.214 20.581" data-dir="prev" class="tales--arrow">
                            <g id="Group_4727" transform="translate(0 -15.801)">
                              <path id="Path_5" d="M47.641,264.284l14.792,8.54a1.747,1.747,0,0,0,2.621-1.513V254.23a1.747,1.747,0,0,0-2.621-1.513l-14.792,8.54a1.747,1.747,0,0,0,0,3.027" transform="translate(-43.841 -236.679)" fill="#00d8ff"></path>
                              <path id="Path_6" d="M1.644,273.06h0a1.645,1.645,0,0,0,1.645-1.645V254.125a1.645,1.645,0,0,0-3.29,0v17.291a1.645,1.645,0,0,0,1.645,1.645" transform="translate(0.001 -236.679)" fill="#00d8ff"></path>
                            </g>
                          </svg><svg xmlns="http://www.w3.org/2000/svg" width="100%" viewBox="0 0 52.183 52.183" class="tales--play">
                            <path id="Path_4" d="M693.288,0A26.091,26.091,0,1,0,719.38,26.091,26.091,26.091,0,0,0,693.288,0m10.5,27.671-14.792,8.54A1.747,1.747,0,0,1,686.37,34.7V17.617a1.747,1.747,0,0,1,2.621-1.513l14.792,8.54a1.747,1.747,0,0,1,0,3.027" transform="translate(-667.197)" fill="#00d8ff"></path>
                          </svg><svg xmlns="http://www.w3.org/2000/svg" width="100%" viewBox="0 0 21.214 20.581" data-dir="next" class="tales--arrow">
                            <g id="Group_4727" transform="translate(-114.48 -15.801)">
                              <path id="Path_7" d="M1846.649,264.284l-14.792,8.54a1.747,1.747,0,0,1-2.621-1.513V254.23a1.747,1.747,0,0,1,2.621-1.513l14.792,8.54a1.747,1.747,0,0,1,0,3.027" transform="translate(-1714.756 -236.679)" fill="currentColor"></path>
                              <path id="Path_8" d="M2117.282,273.06h0a1.645,1.645,0,0,1-1.645-1.645V254.125a1.645,1.645,0,0,1,3.29,0v17.291a1.645,1.645,0,0,1-1.645,1.645" transform="translate(-1983.232 -236.679)" fill="currentColor"></path>
                            </g>
                          </svg></div>
                      </div>
                    </div>
                    <div class="tale--card-bottom">
                      <div data-textarea="ta107e0caa"><?php echo _u('ta107e0caa', 'textarea'); ?></div>
                      <p>Scaling up community-led ecosystem-based adaptation in Indonesia</p>
                    </div>
                    <div class="tales--video-swiper"><?php echo udesly_get_custom_post_field( $post->ID, "video-link", "PlainText" ) ?></div>
                  </div>
                </div><?php endwhile; ?>
              </div>
              <?php else : ?><div class="w-dyn-empty">
                <div>No items found.</div>
              </div><?php endif; ?>
            </div>
<?php wp_reset_postdata(); ?>
 
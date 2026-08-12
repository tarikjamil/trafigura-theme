<?php
// Exit if accessed directly
defined( 'ABSPATH' ) || exit;
?>
<?php
            if (function_exists('udesly_set_frontend_editor_data') && wp_doing_ajax()) {
              udesly_set_frontend_editor_data('single-partner-stories');
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
  "order" => "ASC",
  "orderby" => "date",
  "post__not_in" => [
    get_the_ID()
  ],
  "paged" => $paged
];

$args = apply_filters('udesly/posts/partner-stories-where-id-ne-current-sorted-by-post_date', $args);

        $query = new WP_Query($args);
?>
<div class="w-dyn-list" udy-collection="partner-stories">
              <?php if ( $query->have_posts() ) : ?><div role="list" class="partner-grid w-dyn-items">
                <?php while ($query->have_posts()) : $query->the_post(); global $post; ?><div role="listitem" class="partner--item w-dyn-item">
                  <a href="<?php the_permalink() ?>" class="partner-item w-inline-block">
                    <div class="case-image-wrapper"><img src="<?php echo udesly_get_image()->src ?>" loading="lazy" alt="<?php echo udesly_get_image()->alt ?>" class="img--absolute" data-img="i317f733b" srcset="<?php echo udesly_get_image()->srcset ?>">
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
                        <div class="heading-32 is--black2"><?php the_title() ?></div>
                        <p class=""><?php echo udesly_get_custom_post_field( $post->ID, "description", "PlainText" ) ?></p>
                      </div>
                      <div class="btn-purple">
                        <div class="btn-arrow is--shadow"><svg xmlns="http://www.w3.org/2000/svg" width="100%" viewBox="0 0 17.589 13.87" class="icon-arrow">
                            <path id="Tracé_42314" data-name="Tracé 42314" d="M8.769,0V3.97H0V9.9H8.769v3.97l8.819-6.935Z" transform="translate(0 0)" fill="currentColor"></path>
                          </svg></div>
                        <div class="max106">
                          <div>Read this story</div>
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
 
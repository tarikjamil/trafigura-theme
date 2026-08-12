<?php
// Exit if accessed directly
defined( 'ABSPATH' ) || exit;
?>
<?php
            if (function_exists('udesly_set_frontend_editor_data') && wp_doing_ajax()) {
              udesly_set_frontend_editor_data('page-areas-of-work');
          }
?>
<?php

        if (isset($_GET['p_id'])) {
          $paged = $_GET['p_id'];
        } else {
          $paged = isset($args['paged']) ? $args['paged'] : 1;
        }



$args = [
  "post_type" => "area-of-work",
  "order" => "ASC",
  "orderby" => "date",
  "paged" => $paged
];

$args = apply_filters('udesly/posts/areas-of-works-sorted-by-post_date', $args);

        $query = new WP_Query($args);
?>
<div class="collection-list-wrapper w-dyn-list" udy-collection="area-of-work">
              <?php if ( $query->have_posts() ) : ?><div role="list" class="areas-grid w-dyn-items">
                <?php while ($query->have_posts()) : $query->the_post(); global $post; ?><div role="listitem" class="areas--item-parent w-dyn-item">
                  <a href="<?php the_permalink() ?>" class="area--item w-inline-block">
                    <div class="areas-image-wrapper"><img src="<?php echo udesly_get_image()->src ?>" loading="lazy" alt="<?php echo udesly_get_image()->alt ?>" class="img--absolute" data-img="in34614736" srcset="<?php echo udesly_get_image()->srcset ?>"></div>
                    <div class="areas-bottm">
                      <div class="areas-btn">
                        <div class="btn is--ghost-orange">
                          <div class="btn-arrow is--shadow"><svg xmlns="http://www.w3.org/2000/svg" width="100%" viewBox="0 0 17.589 13.87" class="icon-arrow">
                              <path id="Tracé_42314" data-name="Tracé 42314" d="M8.769,0V3.97H0V9.9H8.769v3.97l8.819-6.935Z" transform="translate(0 0)" fill="currentColor"></path>
                            </svg></div>
                          <div>
                            <div class="max106">DISCOVER</div>
                          </div>
                        </div>
                        <h3 class="heading-28 is--orange is--twoline"><?php the_title() ?></h3>
                      </div>
                      <p class="balanted--text"><?php echo udesly_get_custom_post_field( $post->ID, "summary", "PlainText" ) ?></p>
                    </div>
                  </a>
                </div><?php endwhile; ?>
              </div>
              <?php else : ?><div class="w-dyn-empty">
                <div>No items found.</div>
              </div><?php endif; ?>
            </div>
<?php wp_reset_postdata(); ?>
 
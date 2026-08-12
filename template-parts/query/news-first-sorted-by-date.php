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
  "post_type" => "news",
  "posts_per_page" => 1,
  "order" => "DESC",
  "orderby" => "meta_value",
  "meta_key" => "date",
  "paged" => $paged
];

$args = apply_filters('udesly/posts/news-first-sorted-by-date', $args);

        $query = new WP_Query($args);
?>
<div class="w-dyn-list" udy-collection="news">
                <?php if ( $query->have_posts() ) : ?><div role="list" class="news-highlight w-dyn-items">
                  <?php while ($query->have_posts()) : $query->the_post(); global $post; ?><div role="listitem" class="w-dyn-item">
                    <a href="<?php the_permalink() ?>" class="news-highlight-item w-inline-block">
                      <div id="w-node-f6dfbafa-4c74-d23a-798a-b0b2a9731a57-f4e4fc78" class="highlight-image-wrapper"><img src="<?php echo udesly_get_image()->src ?>" loading="lazy" alt="<?php echo udesly_get_image()->alt ?>" class="img--absolute" data-img="i317f733b" srcset="<?php echo udesly_get_image()->srcset ?>"></div>
                      <div class="news-highlight-right">
                        <?php if (udesly_get_custom_post_field( $post->ID, "news-type", "Option" )) : ?><div class="tag-category is--purple is--left">
                          <div class=""><?php echo udesly_get_custom_post_field( $post->ID, "news-type", "Option" ) ?></div>
                        </div><?php endif  ?>
                        <div class="flexv">
                          <p sym-bind="c3cdb1b1-733b-267a-4b10-31cc57688282" class="text-date"><?php echo date_format(date_create(udesly_get_custom_post_field( $post->ID, "date", "Date" )), "n/d/Y"); ?></p>
                          <p class=""><?php the_title() ?></p>
                        </div>
                        <div class="btn is--ghost-white">
                          <div class="btn-arrow"><svg xmlns="http://www.w3.org/2000/svg" width="100%" viewBox="0 0 17.589 13.87" class="icon-arrow">
                              <path id="Tracé_42314" data-name="Tracé 42314" d="M8.769,0V3.97H0V9.9H8.769v3.97l8.819-6.935Z" transform="translate(0 0)" fill="currentColor"></path>
                            </svg></div>
                          <div>
                            <div class="max106">read more</div>
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
 
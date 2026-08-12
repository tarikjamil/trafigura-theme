<?php
// Exit if accessed directly
defined( 'ABSPATH' ) || exit;
?>
<?php
            if (function_exists('udesly_set_frontend_editor_data') && wp_doing_ajax()) {
              udesly_set_frontend_editor_data('single-news');
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
  "posts_per_page" => 3,
  "order" => "DESC",
  "orderby" => "meta_value",
  "meta_key" => "date",
  "post__not_in" => [
    get_the_ID()
  ],
  "paged" => $paged
];

$args = apply_filters('udesly/posts/news-max-3-where-id-ne-current-sorted-by-date', $args);

        $query = new WP_Query($args);
?>
<div class="w-dyn-list" udy-collection="news">
              <?php if ( $query->have_posts() ) : ?><div role="list" class="news-grid w-dyn-items">
                <?php while ($query->have_posts()) : $query->the_post(); global $post; ?><div role="listitem" class="w-dyn-item">
                  <a href="<?php the_permalink() ?>" class="news-item w-inline-block">
                    <div class="news-image-wrapper"><img src="<?php echo udesly_get_image()->src ?>" loading="lazy" alt="<?php echo udesly_get_image()->alt ?>" class="img--absolute" data-img="i317f733b" srcset="<?php echo udesly_get_image()->srcset ?>">
                      <?php if (udesly_get_custom_post_field( $post->ID, "news-type", "Option" )) : ?><div class="tag-category">
                        <div class=""><?php echo udesly_get_custom_post_field( $post->ID, "news-type", "Option" ) ?></div>
                      </div><?php endif  ?>
                    </div>
                    <div class="flexv">
                      <p sym-bind="d645a748-a982-bf6d-6257-29c0bc2b04fc" class="text-date"><?php echo date_format(date_create(udesly_get_custom_post_field( $post->ID, "date", "Date" )), "n/d/Y"); ?></p>
                      <p class="heading-28 is--medium"><?php the_title() ?></p>
                    </div>
                  </a>
                </div><?php endwhile; ?>
              </div>
              <?php else : ?><div class="w-dyn-empty">
                <div>No items found.</div>
              </div><?php endif; ?>
            </div>
<?php wp_reset_postdata(); ?>
 
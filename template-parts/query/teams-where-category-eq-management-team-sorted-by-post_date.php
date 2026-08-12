<?php
// Exit if accessed directly
defined( 'ABSPATH' ) || exit;
?>
<?php
            if (function_exists('udesly_set_frontend_editor_data') && wp_doing_ajax()) {
              udesly_set_frontend_editor_data('page-who-we-are');
          }
?>
<?php

        if (isset($_GET['p_id'])) {
          $paged = $_GET['p_id'];
        } else {
          $paged = isset($args['paged']) ? $args['paged'] : 1;
        }



$args = [
  "post_type" => "team",
  "order" => "ASC",
  "orderby" => "date",
  "meta_query" => [
    "relation" => "AND",
    [
      "key" => "category",
      "value" => "Management Team",
      "compare" => "="
    ]
  ],
  "paged" => $paged
];

$args = apply_filters('udesly/posts/teams-where-category-eq-management-team-sorted-by-post_date', $args);

        $query = new WP_Query($args);
?>
<div class="w-dyn-list" udy-collection="team">
                  <?php if ( $query->have_posts() ) : ?><div role="list" class="team-wrapper w-dyn-items">
                    <?php while ($query->have_posts()) : $query->the_post(); global $post; ?><div role="listitem" class="collection-item w-dyn-item">
                      <div class="team-item">
                        <div class="team-image-wrapper"><img loading="lazy" alt="<?php echo udesly_get_image()->alt ?>" src="<?php echo udesly_get_image()->src ?>" class="img--absolute" data-img="i317f733b" srcset="<?php echo udesly_get_image()->srcset ?>"></div>
                        <div>
                          <div class="text-20"><?php echo udesly_get_custom_post_field( $post->ID, "first-name", "PlainText" ) ?></div>
                          <div class="text-20"><?php echo udesly_get_custom_post_field( $post->ID, "last-name", "PlainText" ) ?></div>
                        </div>
                        <div class="is--grey3"><?php echo udesly_get_custom_post_field( $post->ID, "position", "PlainText" ) ?></div>
                        <div class="team--richtext-wrapper">
                          <div class="richtext--team w-richtext" data-richtext="r3fbe8166"><?php the_content() ?></div>
                        </div>
                      </div>
                      <div class="team--popup-item">
                        <div class="team--popup-bg"></div>
                        <div class="team-popup-content"><img loading="lazy" alt="<?php echo udesly_get_image()->alt ?>" src="<?php echo udesly_get_image()->src ?>" class="team-popup-img" data-img="i317f733b" srcset="<?php echo udesly_get_image()->srcset ?>">
                          <div class="orange--text">
                            <div class="heading-18"><?php echo udesly_get_custom_post_field( $post->ID, "first-name", "PlainText" ) ?></div>
                            <div class="heading-18"><?php echo udesly_get_custom_post_field( $post->ID, "last-name", "PlainText" ) ?></div>
                          </div>
                          <div class="w-richtext" data-richtext="r3fbe8166"><?php the_content() ?></div>
                          <div class="popup--close"><svg xmlns="http://www.w3.org/2000/svg" width="100%" viewBox="0 0 8.707 8.707" class="svg">
                              <g id="Group_4454" data-name="Group 4454" transform="translate(-1555.646 -1338.646)">
                                <line id="Line_122" data-name="Line 122" y1="8" x2="8" transform="translate(1556 1339)" fill="none" stroke="currentColor" stroke-width="1"></line>
                                <line id="Line_123" data-name="Line 123" x2="8" y2="8" transform="translate(1556 1339)" fill="none" stroke="currentColor" stroke-width="1"></line>
                              </g>
                            </svg></div>
                        </div>
                      </div>
                    </div><?php endwhile; ?>
                  </div>
                  <?php else : ?><div class="w-dyn-empty">
                    <div>No items found.</div>
                  </div><?php endif; ?>
                </div>
<?php wp_reset_postdata(); ?>
 
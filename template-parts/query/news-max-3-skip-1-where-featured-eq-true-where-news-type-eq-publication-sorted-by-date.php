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
  "posts_per_page" => 3,
  "offset" => 1,
  "order" => "ASC",
  "orderby" => "meta_value",
  "meta_key" => "date",
  "meta_query" => [
    "relation" => "AND",
    "featured" => [
                "relation" => "OR",
      [
        "key" => "featured",
        "value" => true,
        "type" => "BOOLEAN",
        "compare" => "="
      ]
    ],
    [
      "key" => "news-type",
      "value" => "Publication",
      "compare" => "="
    ]
  ],
  "paged" => $paged
];

$args = apply_filters('udesly/posts/news-max-3-skip-1-where-featured-eq-true-where-news-type-eq-publication-sorted-by-date', $args);

        $query = new WP_Query($args);
?>
<div class="w-dyn-list" udy-collection="news">
                  <?php if ( $query->have_posts() ) : ?><div role="list" class="pub-right-grid w-dyn-items">
                    <?php while ($query->have_posts()) : $query->the_post(); global $post; ?><div role="listitem" class="w-dyn-item">
                      <div animation="fadefromright" class="pub-item">
                        <div class="pub-image-wrapper"><img src="<?php echo udesly_get_image()->src ?>" loading="lazy" alt="<?php echo udesly_get_image()->alt ?>" class="img--absolute" data-img="i317f733b" srcset="<?php echo udesly_get_image()->srcset ?>"></div>
                        <div class="pub-info">
                          <div class="flexv">
                            <div class="heading-16"><?php the_title() ?></div>
                            <p sym-bind="d7ac3d6f-5024-725c-d41d-a58d1c3a10a5" class="text-14 is--date"><?php echo date_format(date_create(udesly_get_custom_post_field( $post->ID, "date", "Date" )), "d/n/Y"); ?></p>
                          </div>
                          <div class="flexv is--4gap">
                            <div class="flexh is--gap4">
                              <p class="text-14 is--pdf">PDF</p>
                              <div class="flexh is--gap4">
                                <p class="text-14 is--grey"><?php echo udesly_get_custom_post_field( $post->ID, "size", "PlainText" ) ?></p>
                                <p class="text-14 is--grey">MO</p>
                              </div>
                            </div>
                            <a href="<?php echo wp_get_attachment_url( udesly_get_custom_post_field( $post->ID, "document", "FileRef" ) ) ?>" class="btn-download">download</a>
                          </div>
                        </div>
                      </div>
                    </div><?php endwhile; ?>
                  </div>
                  <?php else : ?><div class="w-dyn-empty">
                    <div>No items found.</div>
                  </div><?php endif; ?>
                </div>
<?php wp_reset_postdata(); ?>
 
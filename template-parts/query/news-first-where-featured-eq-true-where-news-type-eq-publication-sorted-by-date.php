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

$args = apply_filters('udesly/posts/news-first-where-featured-eq-true-where-news-type-eq-publication-sorted-by-date', $args);

        $query = new WP_Query($args);
?>
<div class="w-dyn-list" udy-collection="news">
                  <?php if ( $query->have_posts() ) : ?><div role="list" class="w-dyn-items">
                    <?php while ($query->have_posts()) : $query->the_post(); global $post; ?><div role="listitem" class="w-dyn-item">
                      <div class="flexv is--gap24">
                        <?php $card_img = trafigura_card_image( '(max-width: 767px) 92vw, 420px' ); ?>
                        <div class="document-h-image-wrapper"><img src="<?php echo esc_url( $card_img->src ); ?>" loading="lazy" alt="<?php echo esc_attr( $card_img->alt ); ?>" class="img--absolute" data-img="i317f733b" srcset="<?php echo esc_attr( $card_img->srcset ); ?>" sizes="<?php echo esc_attr( $card_img->sizes ); ?>"></div>
                        <h3 class="heading-46"><?php the_title() ?></h3>
                        <div class="flexv is--4gap">
                          <div class="flexh is--gap8">
                            <div class="flexh is--gap4">
                              <p sym-bind="bf51a401-2908-cd19-d2c5-36fffa991856" class="text-14 is--date"><?php echo date_format(date_create(udesly_get_custom_post_field( $post->ID, "date", "Date" )), "d/n/Y"); ?></p>
                              <p class="text-14 is--pdf">PDF</p>
                            </div>
                            <div class="flexh is--gap4">
                              <p class="text-14 is--grey"><?php echo udesly_get_custom_post_field( $post->ID, "size", "PlainText" ) ?></p>
                              <p class="text-14 is--grey">MO</p>
                            </div>
                          </div>
                          <a href="<?php echo wp_get_attachment_url( udesly_get_custom_post_field( $post->ID, "document", "FileRef" ) ) ?>" class="btn-download">download</a>
                        </div>
                      </div>
                    </div><?php endwhile; ?>
                  </div>
                  <?php else : ?><div class="w-dyn-empty">
                    <div>No items found.</div>
                  </div><?php endif; ?>
                </div>
<?php wp_reset_postdata(); ?>
 
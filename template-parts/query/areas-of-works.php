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
  "paged" => $paged
];

$args = apply_filters('udesly/posts/areas-of-works', $args);

        $query = new WP_Query($args);
?>
<div class="w-dyn-list" udy-collection="area-of-work">
                <?php if ( $query->have_posts() ) : ?><div role="list" class="w-dyn-items">
                  <?php while ($query->have_posts()) : $query->the_post(); global $post; ?><div role="listitem" class="w-dyn-item">
                    <a track="navbar" href="<?php the_permalink() ?>" class="navlink w-inline-block">
                      <div class=""><?php the_title() ?></div><svg xmlns="http://www.w3.org/2000/svg" width="100%" viewBox="0 0 7 6" class="nav--arrow"><svg xmlns="http://www.w3.org/2000/svg" width="100%" viewBox="0 0 6 7">
                          <path id="Polygone_4" data-name="Polygone 4" d="M3.5,0,7,6H0Z" transform="translate(6) rotate(90)" fill="currentColor"></path>
                        </svg></svg>
                    </a>
                  </div><?php endwhile; ?>
                </div>
                <?php else : ?><div class="w-dyn-empty">
                  <div>No items found.</div>
                </div><?php endif; ?>
              </div>
<?php wp_reset_postdata(); ?>
 
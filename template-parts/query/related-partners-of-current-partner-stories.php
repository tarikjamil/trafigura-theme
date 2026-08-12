<?php
// Exit if accessed directly
defined( 'ABSPATH' ) || exit;
?>
<?php

            if (function_exists('udesly_set_frontend_editor_data') && wp_doing_ajax()) {
              udesly_set_frontend_editor_data('single-partner-stories');
          }

                global $post;
                $sub_posts_ids = get_the_terms( $post->ID, "related-partners");
                $sub_posts = [];
                $limit = 100;
                $i = 1;
                if (is_array($sub_posts_ids)) {
                  foreach ($sub_posts_ids as $sub_posts_id) {
                    if ($i > $limit) {
                      break;
                    }
                    $sub_posts[] = get_term($sub_posts_id);
                    $i++;
                  }
                }
                $count = count($sub_posts);

            ?>
                <div class="collection-list-wrapper-2 w-dyn-list" udy-collection="related-partners">
              <?php if ( $count > 0 ) : ?><div role="list" class="w-dyn-items">
                <?php foreach ($sub_posts as $term) : ?><div role="listitem" class="w-dyn-item">
                  <div class="partner-related-text"><?php echo $term->name; ?></div>
                </div><?php endforeach ?>
              </div>
              <?php else : ?><div class="w-dyn-empty">
                <div>No items found.</div>
              </div><?php endif; ?>
            </div>
 
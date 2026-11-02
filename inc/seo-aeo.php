<?php
/**
 * SEO / AEO helpers: meta description fallback, Organization schema, FAQ blocks,
 * robots.txt for Bing/answer engines, IndexNow pings, news → partner story links.
 * Loaded from functions.php. Must survive Udesly re-exports (see theme-updates rule).
 */

/* -------------------------------------------------------------------------
 * Meta description fallback (news + partner stories)
 * Yoast's post-type template outputs the 2007 boilerplate when an editor
 * leaves the description empty. Replace it with the story's own intro.
 * ---------------------------------------------------------------------- */

function trafigura_is_boilerplate_metadesc( $desc ) {
    $desc = trim( (string) $desc );
    return $desc === '' || stripos( $desc, 'Established in 2007' ) === 0;
}

function trafigura_trim_metadesc( $text, $max = 155 ) {
    $text = trim( preg_replace( '/\s+/u', ' ', wp_strip_all_tags( html_entity_decode( (string) $text, ENT_QUOTES, 'UTF-8' ) ) ) );
    if ( mb_strlen( $text ) <= $max ) {
        return $text;
    }
    $cut  = mb_substr( $text, 0, $max - 1 );
    $last = mb_strrpos( $cut, ' ' );
    if ( $last !== false && $last > 80 ) {
        $cut = mb_substr( $cut, 0, $last );
    }
    return rtrim( $cut, " ,;:—-" ) . '…';
}

function trafigura_story_intro_text( $post_id ) {
    if ( has_excerpt( $post_id ) ) {
        return get_the_excerpt( $post_id );
    }
    if ( get_post_type( $post_id ) === 'news' && function_exists( 'udesly_get_custom_post_field' ) ) {
        $summary = udesly_get_custom_post_field( $post_id, 'summary', 'PlainText' );
        if ( is_string( $summary ) && mb_strlen( trim( $summary ) ) >= 60 ) {
            return $summary;
        }
    }
    $content = strip_shortcodes( (string) get_post_field( 'post_content', $post_id ) );
    if ( preg_match_all( '#<p[^>]*>(.*?)</p>#is', $content, $m ) ) {
        foreach ( $m[1] as $para ) {
            $para = trim( wp_strip_all_tags( $para ) );
            if ( mb_strlen( $para ) >= 60 ) {
                return $para;
            }
        }
    }
    foreach ( preg_split( '/\n\s*\n/', wp_strip_all_tags( $content ) ) as $chunk ) {
        if ( mb_strlen( trim( $chunk ) ) >= 60 ) {
            return $chunk;
        }
    }
    return '';
}

function trafigura_fallback_metadesc( $desc ) {
    if ( ! is_singular( [ 'news', 'partner-stories' ] ) || ! trafigura_is_boilerplate_metadesc( $desc ) ) {
        return $desc;
    }
    $intro = trafigura_story_intro_text( get_queried_object_id() );
    return $intro !== '' ? trafigura_trim_metadesc( $intro ) : $desc;
}
add_filter( 'wpseo_metadesc', 'trafigura_fallback_metadesc', 20 );

/* -------------------------------------------------------------------------
 * Organization schema (Yoast graph)
 * ---------------------------------------------------------------------- */

function trafigura_schema_organization( $data ) {
    if ( ! is_array( $data ) ) {
        return $data;
    }
    $data['@type']        = [ 'Organization', 'NGO' ];
    $data['description']  = 'The Trafigura Foundation is an independent philanthropic foundation that invests in catalytic solutions for climate adaptation, helping vulnerable communities and ecosystems in low- and middle-income countries become resilient to climate change.';
    $data['foundingDate'] = '2007';
    $data['founder']      = [
        '@type' => 'Organization',
        'name'  => 'Trafigura Group',
        'url'   => 'https://www.trafigura.com/',
    ];
    $data['address'] = [
        '@type'           => 'PostalAddress',
        'streetAddress'   => '1, rue de Jargonnant',
        'postalCode'      => '1207',
        'addressLocality' => 'Geneva',
        'addressCountry'  => 'CH',
    ];
    $data['telephone']    = '+41 22 594 69 00';
    $data['contactPoint'] = [
        '@type'       => 'ContactPoint',
        'contactType' => 'general enquiries',
        'telephone'   => '+41 22 594 69 00',
        'url'         => home_url( '/contact/' ),
    ];
    $data['areaServed'] = [ 'Africa', 'Asia', 'Latin America' ];
    $data['knowsAbout'] = [
        'Climate adaptation',
        'Climate resilience',
        'Disaster risk reduction',
        'Anticipatory action',
        'Nature-based solutions',
        'Ecosystem-based adaptation',
        'Blue carbon',
        'Sustainable livelihoods',
        'Impact investing',
    ];
    $same_as = isset( $data['sameAs'] ) && is_array( $data['sameAs'] ) ? $data['sameAs'] : [];
    $data['sameAs'] = array_values( array_unique( array_merge( $same_as, [
        'https://www.linkedin.com/company/trafigurafoundation/',
    ] ) ) );
    return $data;
}
add_filter( 'wpseo_schema_organization', 'trafigura_schema_organization', 20 );

/* -------------------------------------------------------------------------
 * FAQ blocks — visible <details> accordions + matching FAQPage JSON-LD.
 * Never hide FAQ text (display:none / hidden): schema must match visible content.
 * ---------------------------------------------------------------------- */

function trafigura_faq_items( $key ) {
    static $data = null;
    if ( $data === null ) {
        $data = include get_template_directory() . '/inc/faq-data.php';
    }
    return isset( $data[ $key ] ) ? $data[ $key ] : [];
}

function trafigura_render_faq( $key, $title = 'Frequently asked questions' ) {
    $items = trafigura_faq_items( $key );
    if ( ! $items ) {
        return;
    }
    $heading_id = 'faq-' . sanitize_title( $key );
    $allowed    = [ 'p' => [], 'a' => [ 'href' => [] ], 'strong' => [], 'em' => [], 'ul' => [], 'li' => [] ];
    $schema     = [
        '@context'   => 'https://schema.org',
        '@type'      => 'FAQPage',
        'mainEntity' => [],
    ];
    ?>
    <section class="section is--faq" aria-labelledby="<?php echo esc_attr( $heading_id ); ?>">
      <div class="container--1440">
        <h2 id="<?php echo esc_attr( $heading_id ); ?>" class="heading-28 faq-title"><?php echo esc_html( $title ); ?></h2>
        <div class="faq-list">
          <?php foreach ( $items as $item ) :
              $schema['mainEntity'][] = [
                  '@type'          => 'Question',
                  'name'           => $item['q'],
                  'acceptedAnswer' => [
                      '@type' => 'Answer',
                      'text'  => trim( wp_strip_all_tags( $item['a'] ) ),
                  ],
              ];
          ?>
          <details class="faq-item">
            <summary class="faq-question"><?php echo esc_html( $item['q'] ); ?></summary>
            <div class="faq-answer"><div class="faq-answer-inner"><?php echo wp_kses( $item['a'], $allowed ); ?></div></div>
          </details>
          <?php endforeach; ?>
        </div>
      </div>
      <script type="application/ld+json"><?php echo wp_json_encode( $schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ); ?></script>
    </section>
    <?php
    trafigura_faq_animation_script();
}

/**
 * Eased open/close for FAQ <details> (same curve as the site's GSAP "smooth" ease).
 * Without JS the native toggle still works.
 */
function trafigura_faq_animation_script() {
    static $printed = false;
    if ( $printed ) {
        return;
    }
    $printed = true;
    ?>
    <script>
    (function () {
      var ease = "cubic-bezier(0.38, 0.005, 0.215, 1)";
      var reduce = window.matchMedia && window.matchMedia("(prefers-reduced-motion: reduce)").matches;
      document.querySelectorAll(".faq-item").forEach(function (item) {
        var summary = item.querySelector(".faq-question");
        var panel = item.querySelector(".faq-answer");
        var anim = null;
        if (!summary || !panel || !panel.animate || reduce) return;
        summary.addEventListener("click", function (e) {
          e.preventDefault();
          var start = item.open ? panel.getBoundingClientRect().height : 0;
          if (anim) anim.cancel();
          if (!item.open || item.classList.contains("is-closing")) {
            item.classList.remove("is-closing");
            item.open = true;
            anim = panel.animate(
              { height: [start + "px", panel.scrollHeight + "px"], opacity: [start ? 1 : 0, 1] },
              { duration: 450, easing: ease }
            );
          } else {
            item.classList.add("is-closing");
            anim = panel.animate(
              { height: [start + "px", "0px"], opacity: [1, 0] },
              { duration: 350, easing: ease }
            );
          }
          anim.onfinish = function () {
            if (item.classList.contains("is-closing")) {
              item.open = false;
              item.classList.remove("is-closing");
            }
            anim = null;
          };
        });
      });
    })();
    </script>
    <?php
}

/* -------------------------------------------------------------------------
 * robots.txt — drop Crawl-delay (Google ignores it; Bing, whose index feeds
 * ChatGPT search and Copilot, obeys it and crawls up to 10× slower).
 * Only affects the virtual robots.txt; a physical file in the web root wins.
 * ---------------------------------------------------------------------- */

function trafigura_robots_txt_for_answer_engines( $output ) {
    $output = preg_replace( '/^[ \t]*Crawl-delay:.*(\R|$)/mi', '', (string) $output );
    $output = preg_replace( '/(^|\R)User-agent:[ \t]*\*[ \t]*\s*$/i', '$1', $output );
    return rtrim( $output ) . "\n";
}
add_filter( 'robots_txt', 'trafigura_robots_txt_for_answer_engines', PHP_INT_MAX );

/* -------------------------------------------------------------------------
 * IndexNow — tells Bing (and Yandex, Seznam, Naver) about new/updated URLs
 * within minutes. Key file is served at /{key}.txt.
 * ---------------------------------------------------------------------- */

define( 'TRAFIGURA_INDEXNOW_KEY', '8145752a3c514a4beb817aa3b1f06ee8' );

function trafigura_indexnow_serve_key() {
    $path = trim( (string) wp_parse_url( $_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH ), '/' );
    if ( $path !== TRAFIGURA_INDEXNOW_KEY . '.txt' ) {
        return;
    }
    status_header( 200 );
    header( 'Content-Type: text/plain; charset=utf-8' );
    header( 'X-Robots-Tag: noindex' );
    echo TRAFIGURA_INDEXNOW_KEY;
    exit;
}
add_action( 'init', 'trafigura_indexnow_serve_key', 0 );

function trafigura_indexnow_post_types() {
    return [ 'news', 'partner-stories', 'area-of-work', 'page' ];
}

function trafigura_indexnow_ping( $new_status, $old_status, $post ) {
    if ( $new_status !== 'publish' || wp_is_post_revision( $post ) || wp_is_post_autosave( $post ) ) {
        return;
    }
    if ( ! in_array( $post->post_type, trafigura_indexnow_post_types(), true ) ) {
        return;
    }
    if ( in_array( $post->post_name, [ 'tales-of-resilience', 'tales-of-resistence', 'do-not-delete' ], true ) ) {
        return;
    }
    $host = wp_parse_url( home_url(), PHP_URL_HOST );
    if ( $host !== 'trafigurafoundation.org' ) {
        return;
    }
    $throttle = 'trafigura_indexnow_' . $post->ID;
    if ( get_transient( $throttle ) ) {
        return;
    }
    set_transient( $throttle, 1, 10 * MINUTE_IN_SECONDS );

    wp_remote_post( 'https://api.indexnow.org/indexnow', [
        'blocking' => false,
        'timeout'  => 5,
        'headers'  => [ 'Content-Type' => 'application/json; charset=utf-8' ],
        'body'     => wp_json_encode( [
            'host'        => $host,
            'key'         => TRAFIGURA_INDEXNOW_KEY,
            'keyLocation' => home_url( '/' . TRAFIGURA_INDEXNOW_KEY . '.txt' ),
            'urlList'     => [ get_permalink( $post ) ],
        ] ),
    ] );
}
add_action( 'transition_post_status', 'trafigura_indexnow_ping', 20, 3 );

/* -------------------------------------------------------------------------
 * Old staging host. 48 links in 18 news stories (Nov 2026) still point to
 * trafigurafoundation.une.ch, which no longer resolves. Rewrite on output
 * until the database is search-replaced (Better Search Replace, wp_posts).
 * ---------------------------------------------------------------------- */

function trafigura_rewrite_staging_host( $content ) {
    if ( ! is_string( $content ) || stripos( $content, '.une.ch' ) === false ) {
        return $content;
    }
    return preg_replace( '#https?://trafigurafoundation\.une\.ch/?#i', trailingslashit( home_url() ), $content );
}
add_filter( 'the_content', 'trafigura_rewrite_staging_host', 5 );

/* -------------------------------------------------------------------------
 * News → partner story links. First plain-text mention of a portfolio
 * partner in a news story links to its partner story (once per partner,
 * skipped when the story already links there, never inside links/headings).
 * Longer names first so "Blue Catalyst Fund" wins over "Catalyst Fund".
 * ---------------------------------------------------------------------- */

function trafigura_partner_link_map() {
    return [
        'Alliance for Responsible Mining'      => 'alliance-for-responsible-mining-arm',
        'Climate Smart Forest Economy Program' => 'climate-smart-forest-economy-program',
        'Natural Climate Solutions Accelerator' => 'the-nature-conservancy-natural-climate-solutions-accelerator',
        'International Rescue Committee'       => 'the-international-rescue-committee-irc',
        'Partnership for Central America'      => 'partnership-for-central-america-pca',
        'Wildlife Conservation Society'        => 'wildlife-conservation-society-wcs',
        'Africa Forest Carbon Catalyst'        => 'the-nature-conservancy-2',
        'Global Resilience Partnership'        => 'global-resilience-partnership',
        'Slum Dwellers International'          => 'slum-dwellers-international-sdi',
        'Education for Employment'             => 'education-for-employment',
        'Peace Dividend Initiative'            => 'peace-dividend-initiative-pdi',
        'Bridges to Prosperity'                => 'bridges-to-prosperity',
        'Blue Catalyst Fund'                   => 'blue-catalyst-fund',
        'New Energy Nexus'                     => 'new-energy-nexus-nex',
        'Eternal Mongolia'                     => 'the-nature-conservancy-eternal-mongolia',
        'Planet Indonesia'                     => 'planet-indonesia',
        'The HALO Trust'                       => 'the-halo-trust',
        'Blue Alliance'                        => 'blue-alliance',
        'Catalyst Fund'                        => 'catalyst-fund',
        'Root Capital'                         => 'root-capital',
        'Start Ready'                          => 'start-network-start-ready',
        'Start Fund'                           => 'start-network-start-fund',
        'Outrigger'                            => 'outrigger',
        'Sumatoria'                            => 'sumatoria',
        'Maliasili'                            => 'maliasili',
        'Plan Vivo'                            => 'plan-vivo',
        'Clim-Eat'                             => 'clim-eat',
        'COMACO'                               => 'comaco',
        'BOMA'                                 => 'boma',
        'Nuru'                                 => 'nuru',
    ];
}

function trafigura_link_partners_in_news( $content ) {
    if ( ! is_singular( 'news' ) || ! in_the_loop() || ! is_main_query() || ! is_string( $content ) || $content === '' ) {
        return $content;
    }

    $map = trafigura_partner_link_map();
    uksort( $map, static function ( $a, $b ) {
        return mb_strlen( $b ) - mb_strlen( $a );
    } );

    foreach ( $map as $name => $slug ) {
        $post_id = udesly_theme_utils_get_post_id_by_slug( $slug, 'partner-stories' );
        if ( ! $post_id || get_post_status( $post_id ) !== 'publish' ) {
            continue;
        }
        $url = get_permalink( $post_id );
        if ( stripos( $content, '/partner-stories/' . $slug . '/' ) !== false ) {
            continue;
        }
        $lookbehind = $name === 'Catalyst Fund' ? '(?<!Blue )' : '';
        $pattern    = '/' . $lookbehind . '(?<![\w-])' . preg_quote( $name, '/' ) . '(?![\w-])/u';

        $parts = wp_html_split( $content );
        $skip  = 0;
        $done  = false;
        foreach ( $parts as $i => $part ) {
            if ( $part === '' ) {
                continue;
            }
            if ( $part[0] === '<' ) {
                if ( preg_match( '#^<(a|h[1-6]|script|style|figcaption|button)\b#i', $part ) ) {
                    $skip++;
                } elseif ( preg_match( '#^</(a|h[1-6]|script|style|figcaption|button)>#i', $part ) ) {
                    $skip = max( 0, $skip - 1 );
                }
                continue;
            }
            if ( $skip > 0 || $done ) {
                continue;
            }
            $replaced = preg_replace( $pattern, '<a href="' . esc_url( $url ) . '">' . esc_html( $name ) . '</a>', $part, 1, $count );
            if ( $count ) {
                $parts[ $i ] = $replaced;
                $done        = true;
                break;
            }
        }
        if ( $done ) {
            $content = implode( '', $parts );
        }
    }

    return $content;
}
add_filter( 'the_content', 'trafigura_link_partners_in_news', 99 );

<?php

    function udesly_theme_utils_get_term_id_by_slug( $slug, $type ) {
        $term = get_term_by("slug", $slug, $type);

        if ($term) {
            return $term->term_id;
        }
        return 0;
    }

    function udesly_theme_utils_get_post_id_by_slug( $slug, $type ) {
        $post = get_page_by_path($slug, OBJECT, $type);

        if ($post) {
            return $post->ID;
        }
        return 0;
    }

    /**
     * Permalink for an area-of-work CPT by slug, or empty string if missing.
     */
    function trafigura_area_of_work_url( $slug ) {
        $id = udesly_theme_utils_get_post_id_by_slug( $slug, 'area-of-work' );
        return $id ? get_permalink( $id ) : '';
    }

    /**
     * Turn PlainText area labels (comma/semicolon separated) into pillar links.
     */
    function trafigura_link_areas_of_work_text( $text ) {
        if ( ! $text ) {
            return '';
        }

        $map = [
            'sustainable livelihoods' => 'sustainable-livelihoods',
            'thriving nature'         => 'thriving-nature',
            'prepared communities'    => 'prepared-communities',
        ];

        $parts = preg_split( '/\s*[,;]\s*/', wp_strip_all_tags( $text ) );
        $out   = [];

        foreach ( $parts as $part ) {
            $label = trim( $part );
            if ( $label === '' ) {
                continue;
            }

            $key = strtolower( preg_replace( '/\s+/', ' ', $label ) );
            $key = str_replace( 'livelihhods', 'livelihoods', $key );

            if ( isset( $map[ $key ] ) ) {
                $url = trafigura_area_of_work_url( $map[ $key ] );
                if ( $url ) {
                    $out[] = '<a href="' . esc_url( $url ) . '">' . esc_html( $label ) . '</a>';
                    continue;
                }
            }

            $out[] = esc_html( $label );
        }

        return implode( ', ', $out );
    }

    /**
     * Theme-local compressed overrides for known heavy media-library files.
     * Keys match a substring of the attachment basename.
     */
    function trafigura_optimized_image_override( $thumb_id ) {
        if ( ! $thumb_id ) {
            return null;
        }

        $file = get_attached_file( $thumb_id );
        if ( ! $file ) {
            return null;
        }

        $base = basename( $file );
        $map  = [
            'OceanImageBank_AriphRasheed_07' => [
                // Default to mobile card size (~23 KiB); larger slots via srcset.
                'src'    => 'OceanImageBank_AriphRasheed_07-400.webp',
                'srcset' => [
                    'OceanImageBank_AriphRasheed_07-400.webp 400w',
                    'OceanImageBank_AriphRasheed_07-736.webp 736w',
                ],
            ],
        ];

        foreach ( $map as $needle => $files ) {
            if ( stripos( $base, $needle ) === false ) {
                continue;
            }
            $uri = get_template_directory_uri() . '/assets/images/optimized/';
            return (object) [
                'src'    => $uri . $files['src'],
                'srcset' => implode( ', ', array_map( static function ( $entry ) use ( $uri ) {
                    [ $name, $w ] = explode( ' ', $entry, 2 );
                    return $uri . $name . ' ' . $w;
                }, $files['srcset'] ) ),
            ];
        }

        return null;
    }

    /**
     * Card/listing image attrs: prefer medium_large src + sizes so mobile
     * does not fetch full-resolution featured images. Uses theme optimized
     * assets when a known override exists (e.g. OceanImageBank).
     *
     * @return object{src:string,srcset:string,alt:string,sizes:string}
     */
    function trafigura_card_image( $sizes = '(max-width: 767px) 92vw, (max-width: 991px) 45vw, 420px' ) {
        $img = function_exists( 'udesly_get_image' ) ? udesly_get_image() : null;
        $src = $img->src ?? '';
        $srcset = $img->srcset ?? '';
        $alt = $img->alt ?? '';

        $thumb_id = get_post_thumbnail_id();
        if ( $thumb_id ) {
            $override = trafigura_optimized_image_override( $thumb_id );
            if ( $override ) {
                $src    = $override->src;
                $srcset = $override->srcset;
            } else {
                $medium = wp_get_attachment_image_src( $thumb_id, 'medium_large' );
                if ( ! empty( $medium[0] ) ) {
                    $src = $medium[0];
                }
                $generated_srcset = wp_get_attachment_image_srcset( $thumb_id, 'medium_large' );
                if ( $generated_srcset ) {
                    $srcset = $generated_srcset;
                }
            }
            if ( $alt === '' ) {
                $alt = (string) get_post_meta( $thumb_id, '_wp_attachment_image_alt', true );
            }
        }

        return (object) [
            'src'    => $src,
            'srcset' => $srcset,
            'alt'    => $alt,
            'sizes'  => $sizes,
        ];
    }

    /**
     * URI for files in theme /code (formerly trafigura-code.netlify.app).
     */
    function trafigura_code_uri( $path ) {
        return get_template_directory_uri() . '/code/' . ltrim( (string) $path, '/' );
    }

    /**
     * Drop unused render-blocking CSS that plugins inject on every page.
     * Runs late so Elementor cannot re-enqueue after us.
     */
    function trafigura_dequeue_unused_assets() {
        // Gutenberg block library unused on Udesly/Webflow templates.
        wp_dequeue_style( 'wp-block-library' );
        wp_dequeue_style( 'wp-block-library-theme' );
        wp_dequeue_style( 'wc-blocks-style' );
        wp_dequeue_style( 'classic-theme-styles' );
        wp_dequeue_style( 'global-styles' );

        // Elementor ships Roboto by default; this site uses Euclid + Bebas Neue.
        wp_dequeue_style( 'elementor-gf-local-roboto' );
        wp_dequeue_style( 'elementor-gf-local-robotoslab' );
        wp_deregister_style( 'elementor-gf-local-roboto' );
        wp_deregister_style( 'elementor-gf-local-robotoslab' );

        // Homepage / Udesly templates do not render Elementor widgets — kit CSS is dead weight.
        if ( ! trafigura_page_needs_elementor_css() ) {
            foreach ( [
                'elementor-frontend',
                'elementor-frontend-css',
                'elementor-icons',
                'elementor-animations',
                'e-animations',
                'e-swiper',
                'swiper',
                'base-desktop',
                'base-mobile',
            ] as $handle ) {
                wp_dequeue_style( $handle );
            }

            // Kit + per-post Elementor CSS (e.g. post-28904 kit).
            global $wp_styles;
            if ( $wp_styles instanceof WP_Styles ) {
                foreach ( $wp_styles->registered as $handle => $obj ) {
                    if ( strpos( $handle, 'elementor-post-' ) === 0 ) {
                        wp_dequeue_style( $handle );
                    }
                }
            }
        }
    }
    add_action( 'wp_enqueue_scripts', 'trafigura_dequeue_unused_assets', 9999 );
    add_action( 'elementor/frontend/after_enqueue_styles', 'trafigura_dequeue_unused_assets', 9999 );
    add_filter( 'elementor/frontend/print_google_fonts', '__return_false' );

    /**
     * Defer non-critical plugin CSS so it is not render-blocking.
     */
    function trafigura_defer_noncritical_css( $html, $handle, $href, $media ) {
        $defer = [
            'wpa_css',
            'wpa',
            'udesly-common',
            'udesly_common',
            'udesly-frontend',
        ];
        // Match by handle or URL path.
        $href_l = (string) $href;
        if (
            in_array( $handle, $defer, true )
            || strpos( $href_l, '/honeypot/' ) !== false
            || strpos( $href_l, '/udesly-wp-app/' ) !== false && strpos( $href_l, 'common.css' ) !== false
        ) {
            return '<link rel="preload" href="' . esc_url( $href ) . '" as="style" onload="this.onload=null;this.rel=\'stylesheet\'">'
                . '<noscript><link rel="stylesheet" href="' . esc_url( $href ) . '"></noscript>';
        }
        return $html;
    }
    add_filter( 'style_loader_tag', 'trafigura_defer_noncritical_css', 10, 4 );

    /**
     * True when the current singular page has real Elementor content.
     * Kit-only / empty _elementor_data pages return false.
     */
    function trafigura_page_needs_elementor_css() {
        if ( ! is_singular() ) {
            return false;
        }
        $data = get_post_meta( get_the_ID(), '_elementor_data', true );
        if ( ! $data || $data === '[]' || $data === 'null' ) {
            return false;
        }
        // Non-empty JSON array with at least one element.
        if ( is_string( $data ) ) {
            $decoded = json_decode( $data, true );
            return is_array( $decoded ) && count( $decoded ) > 0;
        }
        return is_array( $data ) && count( $data ) > 0;
    }

    /**
     * Keep jQuery out of <head> (not render-blocking).
     * footer.php prints it with wp_print_scripts('jquery') immediately
     * before GSAP/Swiper/theme scripts so animations still work.
     */
    function trafigura_jquery_in_footer( $scripts ) {
        if ( is_admin() ) {
            return;
        }
        foreach ( [ 'jquery', 'jquery-core', 'jquery-migrate' ] as $handle ) {
            if ( isset( $scripts->registered[ $handle ] ) ) {
                $scripts->add_data( $handle, 'group', 1 );
            }
        }
    }
    add_action( 'wp_default_scripts', 'trafigura_jquery_in_footer' );

        
    function udesly_trafigura_setup() {
        
/*
 * Switch default core markup for search form, comment form, and comments
 * to output valid HTML5.
 */
        add_theme_support(
            'html5',
                array(
                    'comment-form',
                    'comment-list',
                    'gallery',
                    'caption',
                    'style',
                    'script',
                    'navigation-widgets',
                )
        );
        
        add_theme_support('woocommerce');

/**
 * Add support for core custom logo.
 *
 * @link https://codex.wordpress.org/Theme_Logo
 */
        $logo_width  = 300;
        $logo_height = 100;

        add_theme_support(
            'custom-logo',
                array(
                    'height'               => $logo_height,
                    'width'                => $logo_width,
                    'flex-width'           => true,
                    'flex-height'          => true,
                    'unlink-homepage-logo' => true,
                )
        );

        add_theme_support( 'title-tag' );
        
        add_theme_support( 'menus' );

        // Add theme support for selective refresh for widgets.
        add_theme_support( 'customize-selective-refresh-widgets' );

        // Add support for Block Styles.
        add_theme_support( 'wp-block-styles' );

        // Add support for full and wide align images.
        add_theme_support( 'align-wide' );

        // Add support for editor styles.
        add_theme_support( 'editor-styles' );
        
        // Add support for responsive embedded content.
        add_theme_support( 'responsive-embeds' );
         
        add_theme_support( 'post-thumbnails' ); 
    }
    
    add_action( 'after_setup_theme', 'udesly_trafigura_setup' );

    add_action( 'admin_notices', function() {
        if (function_exists("udesly_define_post_type")) {
            return;
        }
        $class = 'notice notice-error';
        $message = 'The theme will not work properly without the Udesly App plugin installed!';
        printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), esc_html( $message ) ); 
    });
    
    
    
    require_once get_template_directory() . '/tgm-plugin/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'udesly_register_required_plugins' );

function udesly_register_required_plugins() {

    $plugins = array(

        array(
            'name'      => 'Udesly App',
            'slug'      => 'udesly-wp-app',
            'source'    => 'https://github.com/udesly-adapter/udesly-wp-app/archive/master.zip',
        ),
        
    );

    /*
     * Array of configuration settings. Amend each line as needed.
     *
     * TGMPA will start providing localized text strings soon. If you already have translations of our standard
     * strings available, please help us make TGMPA even better by giving us access to these translations or by
     * sending in a pull-request with .po file(s) with the translations.
     *
     * Only uncomment the strings in the config array if you want to customize the strings.
     */
    $config = array(
        'id'           => 'udesly',                 // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => '',                      // Default absolute path to bundled plugins.
        'menu'         => 'tgmpa-install-plugins', // Menu slug.
        'parent_slug'  => 'themes.php',            // Parent menu slug.
        'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.
    );

    tgmpa( $plugins, $config );
}




   

    function define_post_types_for_trafigura() {

        if (!function_exists('udesly_define_post_type')) {
            return;
        }
        
        udesly_define_post_type("tales", [
        "labels" => [
            "name" => __("Tales"),
            "singular_name" => __("Tale"),
        ],
        "rewrite" => [
            "name" => __("tales"),
        ],
    ]);
udesly_define_post_type("area-of-work", [
        "labels" => [
            "name" => __("Areas of works"),
            "singular_name" => __("Areas of work"),
        ],
        "rewrite" => [
            "name" => __("area-of-work"),
        ],
    ]);
udesly_define_post_type("team", [
        "labels" => [
            "name" => __("Teams"),
            "singular_name" => __("Team"),
        ],
        "rewrite" => [
            "name" => __("team"),
        ],
    ]);
udesly_define_post_type("supply", [
        "labels" => [
            "name" => __("Supplies"),
            "singular_name" => __("Supply"),
        ],
        "rewrite" => [
            "name" => __("supply"),
        ],
    ]);
udesly_define_post_type("news", [
        "labels" => [
            "name" => __("News"),
            "singular_name" => __("News"),
        ],
        "rewrite" => [
            "name" => __("news"),
        ],
    ]);
udesly_define_post_type("partner-stories", [
        "labels" => [
            "name" => __("Partner Stories"),
            "singular_name" => __("Partner Story"),
        ],
        "rewrite" => [
            "name" => __("partner-stories"),
        ],
    ]);
        
        udesly_define_taxonomy("related-partners", [
        "labels" => [
            "name" => __("Related partners"),
            "singular_name" => __("Related partner"),
        ],
        "rewrite" => [
            "name" => __("related-partners"),
        ],
    ], ["partner-stories"]);
udesly_define_taxonomy("areas", [
        "labels" => [
            "name" => __("Areas"),
            "singular_name" => __("Area"),
        ],
        "rewrite" => [
            "name" => __("areas"),
        ],
    ], ["partner-stories"]);
    
    }


   
    
    add_action('init', 'define_post_types_for_trafigura');
    
    
    function udesly_referenced_items_contains($array_a, $array_b) {
    
       if (!$array_a || sizeof($array_a) == 0 || !$array_b || sizeof($array_b) == 0) {
         return false;
       }
       
       foreach($array_a as $item) {
         $slug = $item->slug ? $item->slug : $item->post_name;
         if (in_array($slug, $array_b)) {
           return true;
         }
       }
    
       return false;
    }
    
    function udesly_referenced_item_contains($item, $array_b) {
    
       if (!$array_b || sizeof($array_b) == 0) {
         return false;
       }
       
         $slug = $item->slug ? $item->slug : $item->post_name;
         if (in_array($slug, $array_b)) {
           return true;
         }
       
    
       return false;
    }
    

 function udesly_theme_set_images_items_lightbox_script($id, $field, $type) {
	$images = udesly_get_custom_post_field( $id, $field, $type );
	
	$items_to_json = [];
	
	foreach ($images as $imageItem) {
		$image = $imageItem["image"];
		$items_to_json[] = [
			"type" => "image",
			"url" => $image->src,
			"caption" => $image->caption
		];
	}
		
	echo json_encode($items_to_json);
}
      

        
        add_action('acf/init', function() {

            if (!function_exists('udesly_custom_field_text')) {
                return;
            }
        
            udesly_register_custom_fields_for_post_type('tales',[
         udesly_custom_field_image([
            "name" => "thumbnail", 
            "label" => "thumbnail", 
            "instructions" => "", 
            ]),   
udesly_custom_field_text([
            "name" => "episode-number", 
            "label" => "Episode number", 
            "instructions" => "", 
            ]),   
udesly_custom_field_text([
            "name" => "country", 
            "label" => "Country", 
            "instructions" => "", 
            ]),   
udesly_custom_field_image([
            "name" => "country-flag", 
            "label" => "country flag", 
            "instructions" => "", 
            ]),   
udesly_custom_field_text([
            "name" => "challenge-resume", 
            "label" => "Challenge resume", 
            "instructions" => "", 
            ]),   
udesly_custom_field_rich_text([
            "name" => "challenge", 
            "label" => "Challenge", 
            "instructions" => "", 
            ]),   
udesly_custom_field_rich_text([
            "name" => "core-pillars", 
            "label" => "Core Pillars", 
            "instructions" => "", 
            ]),   
udesly_custom_field_rich_text([
            "name" => "impact", 
            "label" => "Impact", 
            "instructions" => "", 
            ]),   
udesly_custom_field_text([
            "name" => "video-link", 
            "label" => "video link", 
            "instructions" => "", 
            ]),   
udesly_custom_field_checkbox([
            "name" => "_noSearch",
            "label" => "No Search",
            "instructions" => ""
            ])
    ]);        
udesly_register_custom_fields_for_taxonomy('related-partners', [
            udesly_custom_field_checkbox([
            "name" => "_noSearch",
            "label" => "No Search",
            "instructions" => ""
            ])
        ]);        
udesly_register_custom_fields_for_taxonomy('areas', [
            udesly_custom_field_checkbox([
            "name" => "_noSearch",
            "label" => "No Search",
            "instructions" => ""
            ])
        ]);        
udesly_register_custom_fields_for_post_type('area-of-work',[
         udesly_custom_field_image([
            "name" => "image---hero", 
            "label" => "Image - Hero", 
            "instructions" => "", 
            ]),   
udesly_custom_field_text([
            "name" => "summary", 
            "label" => "Summary", 
            "instructions" => "", 
            ]),   
udesly_custom_field_checkbox([
            "name" => "_noSearch",
            "label" => "No Search",
            "instructions" => ""
            ])
    ]);        
udesly_register_custom_fields_for_post_type('team',[
         udesly_custom_field_text([
            "name" => "first-name", 
            "label" => "First name", 
            "instructions" => "", 
            ]),   
udesly_custom_field_text([
            "name" => "last-name", 
            "label" => "Last name", 
            "instructions" => "", 
            ]),   
udesly_custom_field_text([
            "name" => "position", 
            "label" => "Position", 
            "instructions" => "", 
            ]),   
udesly_custom_field_select([
            "name" => "category", 
            "label" => "Category", 
            "instructions" => "", 
            "choices" => [
                "Management Team" => "Management Team",
            "Board Members" => "Board Members",
            
               ]
            ]),   
udesly_custom_field_checkbox([
            "name" => "_noSearch",
            "label" => "No Search",
            "instructions" => ""
            ])
    ]);        
udesly_register_custom_fields_for_post_type('supply',[
         udesly_custom_field_checkbox([
            "name" => "_noSearch",
            "label" => "No Search",
            "instructions" => ""
            ])
    ]);        
udesly_register_custom_fields_for_post_type('news',[
         udesly_custom_field_text([
            "name" => "summary", 
            "label" => "Summary", 
            "instructions" => "", 
            ]),   
udesly_custom_field_select([
            "name" => "news-type", 
            "label" => "News type", 
            "instructions" => "", 
            "choices" => [
                "News" => "News",
            "Insight" => "Insight",
            "Publication" => "Publication",
            "Field Visit" => "Field Visit",
            "Video" => "Video",
            
               ]
            ]),   
udesly_custom_field_date([
            "name" => "date",
            "label" => "Date",
            "instructions" => ""
            ]),   
udesly_custom_field_text([
            "name" => "quote", 
            "label" => "Quote", 
            "instructions" => "", 
            ]),   
udesly_custom_field_image([
            "name" => "author-s-image", 
            "label" => "Author's Image", 
            "instructions" => "", 
            ]),   
udesly_custom_field_text([
            "name" => "author-s-name", 
            "label" => "Author's Name", 
            "instructions" => "", 
            ]),   
udesly_custom_field_text([
            "name" => "author-s-position", 
            "label" => "Author's Position", 
            "instructions" => "", 
            ]),   
udesly_custom_field_text([
            "name" => "text-s-bottom", 
            "label" => "Outro Text", 
            "instructions" => "", 
            ]),   
udesly_custom_field_set([
            "name" => "gallery-2", 
            "label" => "Gallery", 
            "instructions" => "",
            ]),   
udesly_custom_field_text([
            "name" => "gallery---text", 
            "label" => "Gallery - text", 
            "instructions" => "", 
            ]),   
udesly_custom_field_file([
            "name" => "document", 
            "label" => "Document", 
            "instructions" => "", 
            ]),   
udesly_custom_field_text([
            "name" => "size", 
            "label" => "size", 
            "instructions" => "", 
            ]),   
udesly_custom_field_checkbox([
            "name" => "featured",
            "label" => "Featured",
            "instructions" => ""
            ]),   
udesly_custom_field_checkbox([
            "name" => "_noSearch",
            "label" => "No Search",
            "instructions" => ""
            ])
    ]);        
udesly_register_custom_fields_for_post_type('partner-stories',[
         udesly_custom_field_text([
            "name" => "description", 
            "label" => "Description", 
            "instructions" => "", 
            ]),   
udesly_custom_field_text([
            "name" => "place", 
            "label" => "Country", 
            "instructions" => "", 
            ]),   
udesly_custom_field_select([
            "name" => "state", 
            "label" => "State", 
            "instructions" => "", 
            "choices" => [
                "Ongoing" => "Ongoing",
            "New" => "New",
            "Ended" => "Ended",
            
               ]
            ]),   
udesly_custom_field_text([
            "name" => "area-of-work", 
            "label" => "Area of Work", 
            "instructions" => "", 
            ]),   
udesly_custom_field_set([
            "name" => "gallery-2", 
            "label" => "Gallery", 
            "instructions" => "",
            ]),   
udesly_custom_field_text([
            "name" => "slider-text-3", 
            "label" => "Text under slider", 
            "instructions" => "", 
            ]),   
udesly_custom_field_checkbox([
            "name" => "_noSearch",
            "label" => "No Search",
            "instructions" => ""
            ])
    ]);
        
        });
        
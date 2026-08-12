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
        
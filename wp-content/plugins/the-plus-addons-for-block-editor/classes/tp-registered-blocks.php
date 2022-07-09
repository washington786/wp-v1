<?php 
/**
 * The Plus Blocks Registered Lists
 *
 * @since   1.0.0
 * @package TPGB
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

function tpgb_registered_blocks(){
	// Blocks class map
	$load_blocks_css_js = [
		TPGB_CATEGORY.'/tp-row' => [
			'dependency' => [
				'css' => [
					TPGB_PATH . DIRECTORY_SEPARATOR .'classes/blocks/tp-row/style.css',
				],
				'js' => [
					TPGB_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/tp-row/tpgb-row.min.js',
				],
			],
		],
		TPGB_CATEGORY.'/tp-column' => [
			'dependency' => [
				'css' => [
					TPGB_PATH . DIRECTORY_SEPARATOR .'classes/blocks/tp-column/style.css',
				],
			],
		],
		TPGB_CATEGORY.'/tp-pro-paragraph' => [
			'dependency' => [
				'css' => [
					TPGB_PATH . DIRECTORY_SEPARATOR .'classes/blocks/tp-pro-paragraph/style.css',
				],
			],
		],
		TPGB_CATEGORY.'/tp-accordion' => [
			'dependency' => [
				'css' => [
					TPGB_PATH . DIRECTORY_SEPARATOR .'classes/blocks/tp-accordion/style.css',
				],
				'js' => [
					TPGB_PATH . DIRECTORY_SEPARATOR .'assets/js/main/accordion/tpgb-accordion.min.js',
				],
			],
		],
		
		TPGB_CATEGORY.'/tp-button' => [
			'dependency' => [
				'css' => [
					TPGB_PATH . DIRECTORY_SEPARATOR .'classes/blocks/tp-button/style.css',
				],
			],
		],
		TPGB_CATEGORY.'/tp-countdown' => [
			'dependency' => [
				'css' => [
					TPGB_PATH . DIRECTORY_SEPARATOR .'classes/blocks/tp-countdown/style.css',
				],
				'js' => [
					TPGB_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/countdown/countdown.min.js',
				],
			],
		],
		'countdown-style-1' => [
			'dependency' => [
				'js' => [
					TPGB_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/jquery.downCount.js',
				],
			],
		],
		
		TPGB_CATEGORY.'/tp-data-table' => [
			'dependency' => [
				'css' => [
					TPGB_PATH . DIRECTORY_SEPARATOR .'classes/blocks/tp-data-table/style.css',
				],
				'js' => [
					TPGB_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/jquery.datatables.min.js',
					TPGB_PATH . DIRECTORY_SEPARATOR .'assets/js/main/data-table/tpgb-data-table.min.js',
				],
			],
		],
		TPGB_CATEGORY.'/tp-dark-mode' => [
			'dependency' => [
				'css' => [
					TPGB_PATH . DIRECTORY_SEPARATOR .'classes/blocks/tp-dark-mode/style.css',
				],
				'js' => [
					TPGB_PATH . DIRECTORY_SEPARATOR .'assets/js/main/dark-mode/tpgb-dark-mode.min.js',
				],
			],
		],
		TPGB_CATEGORY.'/tp-draw-svg' => [
			'dependency' => [
				'css' => [
					TPGB_PATH . DIRECTORY_SEPARATOR .'classes/blocks/tp-draw-svg/style.css',
				],
				'js' => [
					TPGB_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/vivus.min.js',
					TPGB_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/draw-svg/tpgb-draw-svg.min.js',
				],
			],
		],
		TPGB_CATEGORY.'/tp-messagebox' => [
			'dependency' => [
				'css' => [
					TPGB_PATH . DIRECTORY_SEPARATOR .'classes/blocks/tp-messagebox/style.css',
				],
				'js' => [
					TPGB_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/messagebox/tpgb-messagebox.js',
				],
			],
		],
		
		TPGB_CATEGORY.'/tp-testimonials' => [
			'dependency' => [
				'css' => [
					TPGB_PATH . DIRECTORY_SEPARATOR .'assets/css/extra/bootstrap-grid.min.css',
					TPGB_PATH . DIRECTORY_SEPARATOR .'assets/css/extra/splide.min.css',
					TPGB_PATH . DIRECTORY_SEPARATOR .'assets/css/main/post-listing/splide-carousel.min.css',
					TPGB_PATH . DIRECTORY_SEPARATOR .'classes/blocks/tp-testimonials/style.css',
				],
				'js' => [
					TPGB_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/splide.min.js',
					TPGB_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/post-listing/post-splide.min.js',
				],
			],
		],
		TPGB_CATEGORY.'/tp-stylist-list' => [
			'dependency' => [
				'css' => [
					TPGB_PATH . DIRECTORY_SEPARATOR .'classes/blocks/tp-stylist-list/style.css',
				],
				'js' => [
					TPGB_PATH . DIRECTORY_SEPARATOR .'assets/js/main/stylist-list/tp-stylist-list.min.js',
				],
			],
		],
		TPGB_CATEGORY.'/tp-empty-space' => [
			'dependency' => [
				'css' => [
					TPGB_PATH . DIRECTORY_SEPARATOR .'classes/blocks/tp-empty-space/style.css',
				],
			],
		],
		TPGB_CATEGORY.'/tp-external-form-styler' => [
			'dependency' => [
				'css' => [
					TPGB_PATH . DIRECTORY_SEPARATOR .'assets/css/extra/bootstrap-grid.min.css',
					TPGB_PATH . DIRECTORY_SEPARATOR .'classes/blocks/tp-external-form-styler/style.css',
				],
				'js' => [
					TPGB_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/external-form-styler/tpgb-cf7.min.js',
				],
			],
		],
		'tpgb-caldera-form' => [
			'dependency' => [
				'js' => [
					TPGB_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/external-form-styler/tpgb-caldera-form.min.js',
				],
			],
		],
		'tpgb-everest-form' => [
			'dependency' => [
				'js' => [
					TPGB_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/external-form-styler/tpgb-everest-form.min.js',
				],
			],
		],
		'tpgb-gravity-form' => [
			'dependency' => [
				'js' => [
					TPGB_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/external-form-styler/tpgb-gravity-form.min.js',
				],
			],
		],
		'tpgb-wp-form' => [
			'dependency' => [
				'js' => [
					TPGB_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/external-form-styler/tpgb-wp-form.min.js',
				],
			],
		],
		TPGB_CATEGORY.'/tp-hovercard' => [
			'dependency' => [
				'css' => [
					TPGB_PATH . DIRECTORY_SEPARATOR .'classes/blocks/tp-hovercard/style.css',
				],
			],
		],
		
		TPGB_CATEGORY.'/tp-heading-title' => [
			'dependency' => [
				'css' => [
					TPGB_PATH . DIRECTORY_SEPARATOR .'classes/blocks/tp-heading-title/style.css',
				],
			],
		],
		TPGB_CATEGORY.'/tp-progress-bar' => [
			'dependency' => [
				'css' => [
					TPGB_PATH . DIRECTORY_SEPARATOR .'classes/blocks/tp-progress-bar/style.css',
				],
				'js' => [
					TPGB_PATH . DIRECTORY_SEPARATOR .'assets/js/extra/jquery.waypoints.min.js',
					TPGB_PATH . DIRECTORY_SEPARATOR .'assets/js/extra/circle-progress.js',
					TPGB_PATH . DIRECTORY_SEPARATOR .'assets/js/main/progress-bar/plus-progress-bar.min.js',
				],
			],
		],
		TPGB_CATEGORY.'/tp-pricing-list' => [
			'dependency' => [
				'css' => [
					TPGB_PATH . DIRECTORY_SEPARATOR .'classes/blocks/tp-pricing-list/style.css',
				],
			],
		],
		TPGB_CATEGORY.'/tp-number-counter' => [
			'dependency' => [
				'css' => [
					TPGB_PATH . DIRECTORY_SEPARATOR .'classes/blocks/tp-number-counter/style.css',
				],
				'js' => [
					TPGB_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/numscroller.js',
				],
			],
		],
		TPGB_CATEGORY.'/tp-infobox' => [
			'dependency' => [
				'css' => [
					TPGB_PATH . DIRECTORY_SEPARATOR .'classes/blocks/tp-infobox/style.css',
				],
			],
		],
		TPGB_CATEGORY.'/tp-flipbox' => [
			'dependency' => [
				'css' => [
					TPGB_PATH . DIRECTORY_SEPARATOR .'classes/blocks/tp-flipbox/style.css',
				],
			],
		],
		TPGB_CATEGORY.'/tp-google-map' => [
			'dependency' => [
				'css' => [
					TPGB_PATH . DIRECTORY_SEPARATOR .'classes/blocks/tp-google-map/style.css',
				],
				'js' => [
					TPGB_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/google-map/tpgb-google-map.min.js',
				],
			],
		],
		
		TPGB_CATEGORY.'/tp-tabs-tours'  => [
			'dependency' => [
				'css' => [
					TPGB_PATH . DIRECTORY_SEPARATOR .'classes/blocks/tp-tabs-tours/style.css',
				],
				'js' => [
					TPGB_PATH . DIRECTORY_SEPARATOR .'assets/js/main/tabs-tours/plus-tabs-tours.min.js',
				],
			],
		],
		TPGB_CATEGORY.'/tp-blockquote' => [
			'dependency' => [
				'css' => [
					TPGB_PATH . DIRECTORY_SEPARATOR .'classes/blocks/tp-blockquote/style.css',
				],
			],
		],
		TPGB_CATEGORY.'/tp-breadcrumbs' => [
			'dependency' => [
				'css' => [
					TPGB_PATH . DIRECTORY_SEPARATOR .'classes/blocks/tp-breadcrumbs/style.css',
				],
			],
		],
		TPGB_CATEGORY.'/tp-video' => [
			'dependency' => [
				'css' => [
					TPGB_PATH . DIRECTORY_SEPARATOR .'assets/css/extra/jquery.fancybox.min.css',
					TPGB_PATH . DIRECTORY_SEPARATOR .'classes/blocks/tp-video/style.css',
				],
				'js' => [
					TPGB_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/jquery.fancybox.min.js',
					TPGB_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/video/plus-video-player.min.js',
				],
			],
		],
		TPGB_CATEGORY.'/tp-creative-image' => [
			'dependency' => [
				'css' => [
					TPGB_PATH . DIRECTORY_SEPARATOR .'classes/blocks/tp-creative-image/style.css',
				],
				'js' => [
					TPGB_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/creative-image/plus-image-factory.min.js',
				],
			],
		],
		TPGB_CATEGORY.'/tp-social-icons' => [
			'dependency' => [
				'css' => [
					TPGB_PATH . DIRECTORY_SEPARATOR .'classes/blocks/tp-social-icons/style.css',
				],
			],
		],
		TPGB_CATEGORY.'/tp-post-title' => [
			'dependency' => [
				'css' => [
					TPGB_PATH . DIRECTORY_SEPARATOR .'classes/blocks/tp-post-title/style.css',
				],
			],
		],
		TPGB_CATEGORY.'/tp-post-content' => [
			'dependency' => [
				'css' => [
					TPGB_PATH . DIRECTORY_SEPARATOR .'classes/blocks/tp-post-content/style.css',
				],
			],
		],
		TPGB_CATEGORY.'/tp-post-image' => [
			'dependency' => [
				'css' => [
					TPGB_PATH . DIRECTORY_SEPARATOR .'classes/blocks/tp-post-image/style.css',
				],
				'js' => [
					TPGB_PATH . DIRECTORY_SEPARATOR .'assets/js/main/tp-post-image/tpgb-post-image.min.js',
				],
			],
		],
		TPGB_CATEGORY.'/tp-post-listing' => [
			'dependency' => [
				'css' => [
					TPGB_PATH . DIRECTORY_SEPARATOR .'assets/css/extra/bootstrap-grid.min.css',
					TPGB_PATH . DIRECTORY_SEPARATOR .'classes/blocks/tp-post-listing/style.css',
				],
				'js' => [
					TPGB_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/isotope.pkgd.min.js',
					TPGB_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/post-listing/post-masonry.min.js',
					TPGB_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/post-listing/post-listing.min.js',
				],
			],
		],
		'tpgb-pagination' => [
			'dependency' => [
				'css' => [
					TPGB_PATH . DIRECTORY_SEPARATOR .'assets/css/main/post-listing/tpgb-pagination.css',
				],
			],
		],
		TPGB_CATEGORY.'/tp-post-author' => [
			'dependency' => [
				'css' => [
					TPGB_PATH . DIRECTORY_SEPARATOR .'classes/blocks/tp-post-author/style.css',
				],
			],
		],
		TPGB_CATEGORY.'/tp-post-meta' => [
			'dependency' => [
				'css' => [
					TPGB_PATH . DIRECTORY_SEPARATOR .'classes/blocks/tp-post-meta/style.css',
				],
			],
		],
		TPGB_CATEGORY.'/tp-post-comment' => [
			'dependency' => [
				'css' => [
					TPGB_PATH . DIRECTORY_SEPARATOR .'assets/css/extra/bootstrap-grid.min.css',
					TPGB_PATH . DIRECTORY_SEPARATOR .'classes/blocks/tp-post-comment/style.css',
				],
			],
		],
		TPGB_CATEGORY.'/tp-search-bar' => [
			'dependency' => [
				'css' => [
					TPGB_PATH . DIRECTORY_SEPARATOR .'assets/css/extra/bootstrap-grid.min.css',
					TPGB_PATH . DIRECTORY_SEPARATOR .'assets/css/main/post-listing/tpgb-post-load.css',
					TPGB_PATH . DIRECTORY_SEPARATOR .'classes/blocks/tp-search-bar/style.css',
				],
				'js' => [
					TPGB_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/search-bar/tpgb-search-bar.min.js', 
				],
			],
		],
		TPGB_CATEGORY.'/tp-site-logo' => [
			'dependency' => [
				'css' => [
					TPGB_PATH . DIRECTORY_SEPARATOR .'classes/blocks/tp-site-logo/style.css',
				],
			],
		],
		TPGB_CATEGORY.'/tp-smooth-scroll' => [
			'dependency' => [
				'css' => [
					TPGB_PATH . DIRECTORY_SEPARATOR .'classes/blocks/tp-smooth-scroll/style.css',
				],
				'js' => [
					TPGB_PATH . DIRECTORY_SEPARATOR .'assets/js/extra/smoothscroll.min.js',
					TPGB_PATH . DIRECTORY_SEPARATOR .'assets/js/main/smooth-scroll/tpgb-smooth-scroll.min.js',
				],
			],
		],
		TPGB_CATEGORY.'/tp-pricing-table' => [
			'dependency' => [
				'css' => [
					TPGB_PATH . DIRECTORY_SEPARATOR .'classes/blocks/tp-pricing-table/style.css',
				],
			],
		],
		'carouselSlider' => [
			'dependency' => [
				'css' => [
					TPGB_PATH . DIRECTORY_SEPARATOR .'assets/css/extra/splide.min.css',
					TPGB_PATH . DIRECTORY_SEPARATOR .'assets/css/main/post-listing/splide-carousel.min.css',
				],
				'js' => [
					TPGB_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/splide.min.js',
					TPGB_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/post-listing/post-splide.min.js',
				],
			],
		],
		
		'content-hover-effect' => [
			'dependency' => [
				'css' => [
					TPGB_PATH . DIRECTORY_SEPARATOR .'assets/css/main/plus-extras/plus-content-hover-effect.css',
				],
			],
		],
		'tpgb-group-button' => [
			'dependency' => [
				'css' => [
					TPGB_PATH . DIRECTORY_SEPARATOR .'assets/css/main/plus-extras/plus-group-button.css',
				],
			],
		],
		'tpgb-animation' => [
			'dependency' => [
				'css' => [
					TPGB_PATH . DIRECTORY_SEPARATOR .'assets/css/extra/animate.min.css',
				],
				'js' => [
					TPGB_PATH . DIRECTORY_SEPARATOR .'assets/js/extra/jquery.waypoints.min.js',
					TPGB_PATH . DIRECTORY_SEPARATOR .'assets/js/main/plus-extras/plus-animation.min.js',
				],
			],
		],
		'tpgb-draw-svg' => [
			'dependency' => [
				'js' => [
					TPGB_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/vivus.min.js',
					TPGB_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/draw-svg/tpgb-draw-svg.min.js',
				],
			],
		],
		'tpgb-fancy-box' => [
			'dependency' => [
				'css' => [
					TPGB_PATH . DIRECTORY_SEPARATOR .'assets/css/extra/jquery.fancybox.min.css',
				],
				'js' => [
					TPGB_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/jquery.fancybox.min.js',
				],
			],
		],
		'tpgb-row-column-link' => [
			'dependency' => [
				'js' => [
					TPGB_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/tp-row/tpgb-link.min.js'
				],
			],
		],
	];
	
	if(has_filter('tpgb_blocks_register')) {
		$load_blocks_css_js = apply_filters('tpgb_blocks_register', $load_blocks_css_js);
	}
	
	return $load_blocks_css_js;
}


Class Tpgb_Library {
	/**
	 * A reference to an instance of this class.
	 *
	 * @since 1.0.0
	 * @var   object
	 */	
	private static $instance = null;
	
	public $tpgb_registered_blocks;
	
	public $transient_blocks;
	
	public $plus_uid = null;
	public $requires_update;
	
	private static $blocks_list = [];
	private static $blocks_render = [];
	
    /**
     *  Return array of registered elements.
     *
     * @todo filter output
     */	 
    public function get_registered_blocks(){
        return $this->tpgb_registered_blocks = tpgb_registered_blocks();
    }

    /**
     * Return saved settings
     *
     * @since 1.1.1
     */
    public function get_plus_block_settings($block = null){
		
		$replace = [
			TPGB_CATEGORY.'/tp-accordion' => TPGB_CATEGORY.'/tp-accordion',
			TPGB_CATEGORY.'/tp-blockquote' => TPGB_CATEGORY.'/tp-blockquote',
			TPGB_CATEGORY.'/tp-breadcrumbs' => TPGB_CATEGORY.'/tp-breadcrumbs',
			TPGB_CATEGORY.'/tp-button' => TPGB_CATEGORY.'/tp-button',
			TPGB_CATEGORY.'/tp-column' => TPGB_CATEGORY.'/tp-column',
			TPGB_CATEGORY.'/tp-countdown' => TPGB_CATEGORY.'/tp-countdown',
			TPGB_CATEGORY.'/tp-creative-image' => TPGB_CATEGORY.'/tp-creative-image',
			TPGB_CATEGORY.'/tp-data-table' => TPGB_CATEGORY.'/tp-data-table',
			TPGB_CATEGORY.'/tp-dark-mode' => TPGB_CATEGORY.'/tp-dark-mode',
			TPGB_CATEGORY.'/tp-draw-svg' => TPGB_CATEGORY.'/tp-draw-svg',
			TPGB_CATEGORY.'/tp-empty-space' => TPGB_CATEGORY.'/tp-empty-space',
			TPGB_CATEGORY.'/tp-external-form-styler' => TPGB_CATEGORY.'/tp-external-form-styler',
			TPGB_CATEGORY.'/tp-flipbox' => TPGB_CATEGORY.'/tp-flipbox',
			TPGB_CATEGORY.'/tp-google-map' => TPGB_CATEGORY.'/tp-google-map',
			TPGB_CATEGORY.'/tp-heading-title' => TPGB_CATEGORY.'/tp-heading-title',
			TPGB_CATEGORY.'/tp-hovercard' => TPGB_CATEGORY.'/tp-hovercard',
			TPGB_CATEGORY.'/tp-infobox' => TPGB_CATEGORY.'/tp-infobox',
			TPGB_CATEGORY.'/tp-messagebox' => TPGB_CATEGORY.'/tp-messagebox',
			TPGB_CATEGORY.'/tp-number-counter' => TPGB_CATEGORY.'/tp-number-counter',
			TPGB_CATEGORY.'/tp-pricing-list' => TPGB_CATEGORY.'/tp-pricing-list',
			TPGB_CATEGORY.'/tp-pricing-table' => TPGB_CATEGORY.'/tp-pricing-table',
			TPGB_CATEGORY.'/tp-pro-paragraph' => TPGB_CATEGORY.'/tp-pro-paragraph',
			TPGB_CATEGORY.'/tp-progress-bar' => TPGB_CATEGORY.'/tp-progress-bar',
			TPGB_CATEGORY.'/tp-row' => TPGB_CATEGORY.'/tp-row',
			TPGB_CATEGORY.'/tp-search-bar' => TPGB_CATEGORY.'/tp-search-bar',
			TPGB_CATEGORY.'/tp-stylist-list' => TPGB_CATEGORY.'/tp-stylist-list',
			TPGB_CATEGORY.'/tp-social-icons' => TPGB_CATEGORY.'/tp-social-icons',
			TPGB_CATEGORY.'/tp-tabs-tours' => TPGB_CATEGORY.'/tp-tabs-tours',
			TPGB_CATEGORY.'/tp-testimonials' => TPGB_CATEGORY.'/tp-testimonials',
			TPGB_CATEGORY.'/tp-video' => TPGB_CATEGORY.'/tp-video',
			TPGB_CATEGORY.'/tp-post-title' => TPGB_CATEGORY.'/tp-post-title',
			TPGB_CATEGORY.'/tp-post-content' => TPGB_CATEGORY.'/tp-post-content',
			TPGB_CATEGORY.'/tp-post-image' => TPGB_CATEGORY.'/tp-post-image',
			TPGB_CATEGORY.'/tp-post-author' => TPGB_CATEGORY.'/tp-post-author',
			TPGB_CATEGORY.'/tp-post-listing' => TPGB_CATEGORY.'/tp-post-listing',
			TPGB_CATEGORY.'/tp-post-meta' => TPGB_CATEGORY.'/tp-post-meta',
			TPGB_CATEGORY.'/tp-post-comment' => TPGB_CATEGORY.'/tp-post-comment',
			TPGB_CATEGORY.'/tp-site-logo' => TPGB_CATEGORY.'/tp-site-logo',
			TPGB_CATEGORY.'/tp-smooth-scroll' => TPGB_CATEGORY.'/tp-smooth-scroll',
		];
		
		if(has_filter('tpgb_blocks_register_render')) {
			$replace = apply_filters('tpgb_blocks_register_render', $replace);
		}
		
		$blocks = WP_Block_Type_Registry::get_instance()->get_all_registered();
		
		//Plus Extras Options Array
		$plus_extras = array('content-hover-effect','tpgb-group-button','carouselSlider','countdown-style-1','tpgb-animation', 'tpgb-pagination', 'tpgb-caldera-form', 'tpgb-everest-form', 'tpgb-gravity-form', 'tpgb-wp-form', 'tpgb-draw-svg', 'tpgb-fancy-box','tpgb-row-column-link');
		
		if(has_filter('tpgb_exrta_conditions_blocks_register')) {
			$plus_extras = apply_filters('tpgb_exrta_conditions_blocks_register', $plus_extras);
		}
		
		if(empty($blocks)){
			$blocks = array_keys($replace);
		}else{
			$blocks = array_keys($blocks);
		}
		
		$blocks = array_map(function ($val) use ($replace) {
			return (array_key_exists($val, $replace) ? $replace[$val] : '');
        }, $blocks);
		
		$plus_extras =array_unique($plus_extras);
		$blocks =array_merge( $plus_extras, $blocks );
		
		$load_blocks = (isset($block) ? (isset($blocks[$block]) ? $blocks[$block] : 0) : array_filter($blocks));
		
		return $load_blocks;
	}
	
	/**
     * Check if block editor preview mode or not 
	 * @since 1.0.0
     */
    public function is_preview_mode() {
        require_once(ABSPATH . 'wp-admin/includes/screen.php');
        if (! is_null ( get_current_screen() ) && get_current_screen()->is_block_editor()) {
            return true;
        }
		
        return false;
    }
	
	/**
     * Check if cache files exists
     *
     * @since 1.0.0
     */
    public function check_cache_files($post_type = null, $post_id = null)
    {
        $css_url = TPGB_ASSET_PATH . DIRECTORY_SEPARATOR . ($post_type ? 'theplus-' . $post_type : 'theplus') . ($post_id ? '-' . $post_id : '') . '.min.css';
        $js_url = TPGB_ASSET_PATH . DIRECTORY_SEPARATOR . ($post_type ? 'theplus-' . $post_type : 'theplus') . ($post_id ? '-' . $post_id : '') . '.min.js';

        if (is_readable($this->secure_path_url($css_url)) && is_readable($this->secure_path_url($js_url))) {
			return true;
        }
        return false;
    }
	
	/**
     * Check if cache files exists
     *
     * @since 1.3.1
     */
    public function check_css_js_cache_files($post_type = null, $post_id = null, $type = 'css')
    {
		if( empty( $type) ){
			return false;
		}

		if($type == 'css'){
			$css_url = TPGB_ASSET_PATH . DIRECTORY_SEPARATOR . ($post_type ? 'theplus-' . $post_type : 'theplus') . ($post_id ? '-' . $post_id : '') . '.min.css';
			if ( is_readable($this->secure_path_url($css_url)) ) {
				return true;
			}
		}else if($type == 'js'){
			$js_url = TPGB_ASSET_PATH . DIRECTORY_SEPARATOR . ($post_type ? 'theplus-' . $post_type : 'theplus') . ($post_id ? '-' . $post_id : '') . '.min.js';
			if ( is_readable($this->secure_path_url($js_url)) ) {
				return true;
			}
		}
		return false;
	}

    /**
     * Generate scripts and combine minify.
     *
     * @since 1.0.0
     */
    public function plus_generate_scripts($elements, $file_name = null)
    {

        if (empty($elements)) {
            return;
        }
		
        if (!file_exists(TPGB_ASSET_PATH)) {
            wp_mkdir_p(TPGB_ASSET_PATH);
        }

        // default load js and css
        $js_url = array();
        $css_url = array(
			TPGB_PATH . DIRECTORY_SEPARATOR . "/assets/css/main/general/tpgb-common.css",
		);
		
        // collect library scripts & styles
        $js_url = array_merge($js_url, $this->plus_dependency_widgets($elements, 'js'));
        $css_url = array_merge($css_url, $this->plus_dependency_widgets($elements, 'css'));

        // merge files widgets
		if( !empty($css_url) ){
        	$this->plus_merge_files($css_url, ($file_name ? $file_name : 'theplus') . '.min.css','css');
		}
		if( !empty($js_url) ){
        	$this->plus_merge_files($js_url, ($file_name ? $file_name : 'theplus') . '.min.js','js');
		}
    }
	
	
	/**
     * Widgets dependency for modules
     *
     * @since 1.0.0
     */
    public function plus_dependency_widgets(array $elements, $type)
    {
        $paths = [];

        foreach ($elements as $element) {
            if (isset($this->tpgb_registered_blocks[$element])) {
                if (!empty($this->tpgb_registered_blocks[$element]['dependency'][$type])) {
                    foreach ($this->tpgb_registered_blocks[$element]['dependency'][$type] as $path) {
                        $paths[] = $path;
                    }
                }
            }
        }
        return array_unique($paths);
    }
	
	/**
     * Merge all Files Load
     *
     * @since 1.0.0
     */
    public function plus_merge_files($paths = array(), $file = 'theplus-style.min.css',$type='') {
        $output = '';

        if (!empty($paths)) {
            foreach ($paths as $path) {
                $output .= file_get_contents($this->secure_path_url($path));
            }
        }
		if(!empty($type) && $type=='css'){
			
			// Remove comments
			$output = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $output);
			// Remove space after colons
			$output = str_replace(': ', ':', $output);
			// Remove whitespace
			$output = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $output);
			//Remove Last Semi colons
			$output = preg_replace('/;}/', '}', $output);
		}
		if( !empty( $output ) ){
        	return file_put_contents($this->secure_path_url(TPGB_ASSET_PATH . DIRECTORY_SEPARATOR . $file), $output);
		}
		return false;
    }
	
	public function plus_template_load_parse_blocks($blocks){
		
		$parse_content_template =[];
		if(!empty($blocks) && isset($blocks) && !empty($this->plus_template_blocks)){
			if($this->plus_template_blocks){
				$template_post_id = array_unique($this->plus_template_blocks);
				
				foreach($template_post_id as $id){
					$block_post = get_post( $id );
					$parse_content_template[] = parse_blocks( $block_post->post_content );
				}
			}
			$blocks = array_merge($parse_content_template, $blocks);
			
			return $blocks;
		}else{
			return $blocks; 
		}
	}
	
	public function tpgb_get_load_template_id(){
		return $this->plus_template_blocks;
	}
	
	/*
	 * Template Post Do block
	 * @since 1.1.2
	 */
	public function plus_do_block($post_id=''){
		if(!empty($post_id) && isset($post_id)){
			$block_post = get_post( $post_id );
			if ( ! is_wp_error( $block_post ) ) {
				$this->plus_template_blocks[] = $post_id;
				$content =  (isset($block_post->post_content)) ? $block_post->post_content : '';
				if(isset($content)){
					return do_blocks( $content );
				}else{
					return;
				}
			}
		}else{
			return; 
		}
	}
	
	public function wp_footer(){
		if(empty($this->plus_template_blocks)){
			return;
		}
		
		$template_post_id = array_unique($this->plus_template_blocks);
		
		$queried_obj = get_queried_object_id();
		if(is_search()){
			$queried_obj = 'search';
		}
		if(is_404()){
			$queried_obj = '404';
		}
		
		$optionName = 'tpgb-load-templates-list';
		$get_opt = get_option($optionName);
		
		if( $get_opt === false ){
			add_option($optionName, [ $queried_obj => $template_post_id ] );
		}else if( $get_opt !== false && !empty($get_opt) ){
			if( !isset( $get_opt[ $queried_obj ] ) ){
				$get_opt[ $queried_obj ] = $template_post_id;
				update_option($optionName, $get_opt, false );
			}else{
				if($get_opt[$queried_obj] != $template_post_id){
					$get_opt[ $queried_obj] = $template_post_id;
					update_option($optionName, $get_opt , false );
				}
			}
		}
		
		foreach($template_post_id as $post_id){
			$upload_dir			= wp_get_upload_dir();
			$upload_base_dir 	= trailingslashit($upload_dir['basedir']);
			$css_path			= $upload_base_dir . "theplus_gutenberg/plus-css-{$post_id}.css";
			
			$plus_version=get_post_meta( $post_id, '_block_css', true );
			if(empty($plus_version)){
				$plus_version = TPGB_VERSION;
			}

			if (file_exists($css_path)) {
				$css_file_url = trailingslashit($upload_dir['baseurl']);
				$css_url     = $css_file_url . "theplus_gutenberg/plus-css-{$post_id}.css";
				wp_enqueue_style("plus-post-{$post_id}", $css_url, false, $plus_version);
			}else if(!file_exists($css_path)){
				$tp_core = new Tp_Core_Init_Blocks();
				$tp_core->make_block_css_by_post_id($post_id);
			}
		}
		
	}
	/**
     * Generate single post scripts
     *
     * @since 1.0.0
     */
    public function generate_scripts_frontend()
    {
		if ($this->is_background_running()) {
            return;
        }

        if ($this->plus_uid === null) {
            return;
        }

        if ($this->is_preview_mode()) {
            return;
        }
		
        if (!$this->requires_update) {
            return;
        }
		
		if(get_option('tpgb_save_updated_at') === false){
			update_option('tpgb_save_updated_at', strtotime('now'), false);
		}
		
		if (get_option('tpgb_save_updated_at') == get_option($this->plus_uid . '_updated_at')) {
            return;
        }
		
		if(has_filter('tpgb_extra_load_css_js')) {
			$this->transient_blocks = apply_filters('tpgb_extra_load_css_js', $this->transient_blocks );
		}
		
		if(!empty($this->transient_blocks)){
			$this->transient_blocks = array_unique($this->transient_blocks);
		}
        $replace = array();
		
        $elements = array_map(function ($val) use ($replace) {
		    return (array_key_exists($val, $replace) ? $replace[$val] : $val);
        }, $this->transient_blocks);
        $elements = array_intersect(array_keys($this->tpgb_registered_blocks), $elements);
		
        $elements = array_unique($elements);
		
		sort($elements);
		
		global $wp_query;
        if (is_home() || is_singular() || is_archive() || is_search() || (isset( $wp_query ) && (bool) $wp_query->is_posts_page) || is_404()) {
			
            $queried_object = get_queried_object_id();
			if(is_search()){
				$queried_object = 'search';
			}
			if(is_404()){
				$queried_object = '404';
			}
            $post_type = (is_singular() ? 'post' : 'term');
            
			update_option($this->plus_uid . '_blocks', $elements, false);
			update_option($this->plus_uid . '_updated_at', get_option('tpgb_save_updated_at'), false);
			
            $this->remove_files_unlink($post_type, $queried_object);
			
			// if no cache files, generate new
            if (!$this->check_cache_files($post_type, $queried_object)) {
                $this->plus_generate_scripts($elements, 'theplus-' . $post_type . '-' . $queried_object);
            }
        }
    }
	
	//Frontend Load Plus Styles and Scripts
	public function enqueue_frontend_load($post_type, $queried_obj) {
		if (!$this->is_preview_mode()) {
		
			if ($this->requires_update) {
				$elements = array_keys($this->tpgb_registered_blocks);
            } else {
				$elements = get_option($this->plus_uid . '_blocks');
				
				if (!$this->check_css_js_cache_files($post_type, $queried_obj,'css') && !$this->check_css_js_cache_files($post_type, $queried_obj,'js') && !empty($elements)) {
					update_post_meta($queried_obj, '_block_css',time());
					$this->plus_generate_scripts($elements, 'theplus-' . $post_type . '-' . $queried_obj);
				}
            }

            // if no widget in page, return
            if (empty($elements)) {
                return;
            }
			
			$tpgb_url = TPGB_URL;
			if (defined('TPGBP_VERSION') && defined('TPGBP_URL')) {
				$tpgb_url = TPGBP_URL;
			}
			
			if ($this->requires_update){
				if (file_exists(TPGB_ASSET_PATH . '/theplus.min.css') && file_exists(TPGB_ASSET_PATH . '/theplus.min.js')) {
					$css_file = TPGB_ASSET_URL . '/theplus.min.css';
					$js_file = TPGB_ASSET_URL . '/theplus.min.js';
				}else{
					$css_file = $tpgb_url . 'assets/css/main/general/theplus.min.css';
					$js_file =  $tpgb_url . 'assets/js/main/general/theplus.min.js';
				}
			}else{
				if ($this->check_css_js_cache_files($post_type, $queried_obj, 'css') || $this->check_css_js_cache_files($post_type, $queried_obj, 'js')) {
					$css_file = TPGB_ASSET_URL . '/theplus-' . $post_type . '-' . $queried_obj . '.min.css';
					$js_file = TPGB_ASSET_URL . '/theplus-' . $post_type . '-' . $queried_obj . '.min.js';
				} else {
					if (file_exists(TPGB_ASSET_PATH . '/theplus.min.css') && file_exists(TPGB_ASSET_PATH . '/theplus.min.js')) {
						$css_file = TPGB_ASSET_URL . '/theplus.min.css';
						$js_file = TPGB_ASSET_URL . '/theplus.min.js';
					}else{
						$css_file = $tpgb_url . 'assets/css/main/general/theplus.min.css';
						$js_file = $tpgb_url . 'assets/js/main/general/theplus.min.js';
					}
				}
			}
			
			//fontawesome icon load frontend
			$fontawesome_load = Tp_Blocks_Helper::get_extra_option('fontawesome_load');
			$fontawesome_pro = Tp_Blocks_Helper::get_extra_option('fontawesome_pro_kit');
			if((empty($fontawesome_load) || $fontawesome_load=='enable' || empty($fontawesome_pro) || !defined('TPGBP_VERSION')) && $fontawesome_load!='disable'){
				wp_enqueue_style('tpgb-fontawesome', TPGB_URL.'assets/css/extra/fontawesome.min.css', array());
			}
			if ( is_admin_bar_showing() ) {
				wp_enqueue_script(
					'tpgb-purge-js',
					TPGB_URL."assets/js/main/general/tpgb-purge.js",
					['jquery'],
					TPGB_VERSION,
					true
				);
			}
			$plus_version=get_post_meta( $queried_obj, '_block_css', true );
			if(empty($plus_version)){
				$plus_version=time();
			}
			
			$upload_dir			= wp_get_upload_dir();
			$upload_base_dir	= trailingslashit($upload_dir['basedir']);
			$global_path		= $upload_base_dir . "theplus_gutenberg/plus-global.css";
			$css_file_url		= trailingslashit($upload_dir['baseurl']);
			if( isset($_GET['preview']) && $_GET['preview'] == true){
				$global_path = $upload_base_dir . "theplus_gutenberg/plus-global-preview.css";
				if (file_exists($global_path) && !$this->is_editor_screen()) {
					$global_url	= $css_file_url . "theplus_gutenberg/plus-global-preview.css";
					wp_enqueue_style("plus-global-preview", $global_url, false, $plus_version);
				}else if (file_exists($upload_base_dir . "theplus_gutenberg/plus-global.css") && !$this->is_editor_screen()) {
					$global_url	= $css_file_url . "theplus_gutenberg/plus-global.css";
					wp_enqueue_style("plus-global", $global_url, false, $plus_version);
				}
			}else if (file_exists($global_path) && !$this->is_editor_screen()) {
				$global_url	= $css_file_url . "theplus_gutenberg/plus-global.css";
				wp_enqueue_style("plus-global", $global_url, false, $plus_version);
			}
			
			$load_comp = ['jquery'];
			if(has_block( 'tpgb/tp-coupon-code' )){
				wp_enqueue_script('jquery-ui-draggable');
				wp_enqueue_script('jquery-touch-punch');
				array_push($load_comp,"jquery-ui-draggable");
			}
			
			wp_enqueue_style('tpgb-plus-block-front-css', tpgb_library()->pathurl_security($css_file), false, $plus_version );

			$load_localize = 'tpgb-purge-js';
			if( $this->check_css_js_cache_files($post_type, $queried_obj, 'js') ){
				wp_enqueue_script('tpgb-plus-block-front-js', tpgb_library()->pathurl_security($js_file), $load_comp, $plus_version, true);
				$load_localize = 'tpgb-plus-block-front-js';
			}

			wp_localize_script(
				$load_localize, 'tpgb_config', array(
					'ajax_url' => esc_url( admin_url('admin-ajax.php') ),
					'tpgb_nonce' => wp_create_nonce("tpgb-addons"),
				)
			);
			
		}
	}
	
	private function is_editor_screen(){
		if (!empty($_GET['action']) &&  $_GET['action'] === 'wppb_editor') {
			return true;
		}
		return false;
	}
	
	/**
     * Generate secure path url
     * @since 1.0.0
     */
    public function secure_path_url($path_url)
    {
        $path_url = str_replace(['//', '\\\\'], ['/', '\\'], $path_url);

        return str_replace(['/', '\\'], DIRECTORY_SEPARATOR, $path_url);
    }
	
	/**
	 * Generate secure path url
	 *
	 * @since 1.0.0
	 */
	public function pathurl_security($url) {
        return preg_replace(['/^http:/', '/^https:/', '/(?!^)\/\//'], ['', '', '/'], $url);
    }
	
	/**
		* Add menu in admin bar.
	 *
	 * Adds "Plus Clear Cache" items to the WordPress admin bar.
	 *
	 * Fired by `admin_bar_menu` filter.
	 *
	 * @since 1.0.0
	 */
	public function add_tpgb_clear_cache_admin_bar( \WP_Admin_Bar $wp_admin_bar ) {
		
		global $wp_admin_bar;

		if ( ! is_super_admin()
			 || ! is_object( $wp_admin_bar ) 
			 || ! function_exists( 'is_admin_bar_showing' ) 
			 || ! is_admin_bar_showing() ) {
			return;
		}
		
		$queried_obj = get_queried_object_id();
		if(is_search()){
			$queried_obj = 'search';
		}
		if(is_404()){
			$queried_obj = '404';
		}
		$post_type = (is_singular() ? 'post' : 'term');
		
		if (file_exists(TPGB_ASSET_PATH . '/theplus-' . $post_type . '-' . $queried_obj . '.min.css') || file_exists(TPGB_ASSET_PATH . '/theplus-' . $post_type . '-' . $queried_obj . '.min.js')) {
		
				//Parent
				$wp_admin_bar->add_node( [
					'id'	=> 'tpda-purge-clear',
					'meta'	=> array(
						'class' => 'tpda-purge-clear',
					),
					'title' => esc_html__( 'TPAG Performance', 'tpgb' ),
					
				] );
				
				//Child Item
				$args = array();
				array_push($args,array(
					'id'		=>	'tpda-purge-all-pages',
					'title'		=>	esc_html__( 'Purge All Pages', 'tpgb' ),
					'href'		=> 	'#tpda-clear-gutenberg-all',
					'parent'	=>	'tpda-purge-clear',
					'meta'   	=> 	array( 'class' => 'tpda-purge-all-pages' ),
				));

				array_push($args,array(
					'id'     	=>	'tpda-purge-current-page',
					'title'		=>	esc_html__( 'Purge Current Page', 'tpgb' ),
					'href'		=>	'#tpda-clear-theplus-' . $post_type . '-' . $queried_obj,
					'parent' 	=>	'tpda-purge-clear',
					'meta'   	=>	array( 'class' => 'tpda-purge-current-page' ),
				));
				
				sort($args);
				foreach( $args as $each_arg) {
					$wp_admin_bar->add_node($each_arg);
				}

				if(!defined('NEXTER_EXT')){
					//Parent
					$wp_admin_bar->add_node( [
						'id'	=> 'tpgb_edit_template',
						'meta'	=> array(
							'class' => 'tpgb_edit_template',
						),
						'title' => esc_html__( 'Edit Template', 'tpgb' ),
					] );
				}
		}
	}
	
	/**
     * Remove all Clear cache files
     *
     * @since 1.0.0
     */
    public function tpgb_smart_perf_clear_cache()
    {
		check_ajax_referer('tpgb-addons', 'security');

        // clear cache files
		$this->remove_dir_files(TPGB_ASSET_PATH);

		wp_send_json(true);
    }
	
	/**
     * Remove all Dynamic Style files
     *
     * @since 1.1.3
     */
    public function tpgb_dynamic_style_cache() {
		check_ajax_referer('tpgb-addons', 'security');

        // clear cache files
		$this->remove_dir_dynamic_style_files(TPGB_ASSET_PATH);

		wp_send_json(true);
    }
	
	/**
     * After Save Block Remove Clear cache files
     *
     * @since 1.0.0
     */
    public function tpgb_backend_clear_cache()
    {
		check_ajax_referer('tpgb-addons', 'security');

        // clear cache files
		$this->remove_backend_dir_files();

		wp_send_json(true);
    }
	
	/**
     * Current Page Clear cache files
     *
     * @since 1.0.0
     */
    public function tpgb_current_page_clear_cache()
    {
		check_ajax_referer('tpgb-addons', 'security');
		
		$plus_name='';
		if(isset($_POST['plus_name']) && !empty($_POST['plus_name'])){
			$plus_name = sanitize_text_field(wp_unslash($_POST['plus_name']));
		}
		if($plus_name== 'gutenberg-all') {
			// All clear cache files
			$this->remove_dir_files(TPGB_ASSET_PATH);		
		}else {
			// Current Page cache files
			if($this->plus_uid){
				delete_option( $this->plus_uid . '_blocks' );
			}
			$this->remove_current_page_dir_files( TPGB_ASSET_PATH, $plus_name );
		}
		wp_send_json(true);
    }
	
	 /**
     * Remove files
     * @since 1.0.0
     */
    public function remove_files_unlink($post_type = null, $post_id = null)
    {
        $css_path_url = $this->secure_path_url(TPGB_ASSET_PATH . DIRECTORY_SEPARATOR . ($post_type ? 'theplus-' . $post_type : 'theplus') . ($post_id ? '-' . $post_id : '') . '.min.css');
        $js_path_url = $this->secure_path_url(TPGB_ASSET_PATH . DIRECTORY_SEPARATOR . ($post_type ? 'theplus-' . $post_type : 'theplus') . ($post_id ? '-' . $post_id : '') . '.min.js');

        if (file_exists($css_path_url)) {
            unlink($css_path_url);
        }

        if (file_exists($js_path_url)) {
            unlink($js_path_url);
        }
    }
	
	/**
     * Remove in Dynamic Styles files
     * @since 1.1.3
     */
    public function remove_dir_dynamic_style_files($path_url) {
        if (!is_dir($path_url) || !file_exists($path_url)) {
            return;
        }

        foreach (scandir($path_url) as $item) {
            if ($item == '.' || $item == '..') {
                continue;
            }

			if (strpos($item, 'plus-global') !== false || strpos($item, 'theplus') !== false || strpos($item, 'plus-json-') !== false) {
			}else{
				unlink($this->secure_path_url($path_url . DIRECTORY_SEPARATOR . $item));
			}
        }
    }
	
	/**
     * Remove in directory files
     * @since 1.0.0
     */
    public function remove_dir_files($path_url)
    {
        if (!is_dir($path_url) || !file_exists($path_url)) {
            return;
        }
		if(get_option('tpgb_backend_cache_at') === false){
			add_option('tpgb_backend_cache_at', strtotime('now'),false);
		}else{
			update_option('tpgb_backend_cache_at', strtotime('now'),false);
		}
        foreach (scandir($path_url) as $item) {
            if ($item == '.' || $item == '..') {
                continue;
            }

			if (strpos($item, 'plus-global') !== false || strpos($item, 'plus-css-') !== false || strpos($item, 'plus-json-') !== false) {
			}else{
				unlink($this->secure_path_url($path_url . DIRECTORY_SEPARATOR . $item));
			}
        }
    }
	
	/**
     * Remove backend in directory files
     * @since 1.0.0
     */
    public function remove_backend_dir_files()
    {
		if (file_exists(TPGB_ASSET_PATH . '/theplus.min.css')) {
			unlink($this->secure_path_url(TPGB_ASSET_PATH . DIRECTORY_SEPARATOR . '/theplus.min.css'));
		}
		if(file_exists(TPGB_ASSET_PATH . '/theplus.min.js')){
			unlink($this->secure_path_url(TPGB_ASSET_PATH . DIRECTORY_SEPARATOR . '/theplus.min.js'));
		}
		if(get_option('tpgb_backend_cache_at') === false){
			add_option('tpgb_backend_cache_at', strtotime('now'),false);
		}else{
			update_option('tpgb_backend_cache_at', strtotime('now'),false);
		}
    }
	
	/**
     * Remove current Page in directory files
     * @since 1.0.0
     */
    public function remove_current_page_dir_files( $path_url, $plus_name = '' ) {
	
		if ((!is_dir($path_url) || !file_exists($path_url)) && empty($plus_name)) {
            return;
        }
		
		if (file_exists($path_url . '/'. $plus_name. '.min.css')) {
			unlink($this->secure_path_url($path_url . DIRECTORY_SEPARATOR . '/'. $plus_name . '.min.css'));
		}
		if(file_exists($path_url . '/'. $plus_name. '.min.js')){
			unlink($this->secure_path_url($path_url. DIRECTORY_SEPARATOR . '/'. $plus_name . '.min.js'));
		}
		
    }
	
	/*
	 * Dynamic Style Forcely Remove In Version
	 * @since 1.1.3
	 */
	public function dynamic_style_version_clear_cache(){
		$option_name = 'tpgb_version_dynamic_cache';
		$get_version = get_option( $option_name );
		$versions = [ TPGB_VERSION ];
			
		if($get_version === false){
			add_option( $option_name, $versions );
			$this->remove_dir_files(TPGB_ASSET_PATH);
			$this->remove_dir_dynamic_style_files(TPGB_ASSET_PATH);
		}
		if( $get_version !== false ){
			//1.1.3
			if( version_compare( TPGB_VERSION, '1.1.3', '==' ) && !in_array( '1.1.3', $get_version ) ){
				$this->remove_dir_files(TPGB_ASSET_PATH);
				$this->remove_dir_dynamic_style_files( TPGB_ASSET_PATH );
				$versions = array_unique( array_merge( $get_version, $versions ) );
				update_option( $option_name, $versions );
			}
			//1.2.1
			if( version_compare( TPGB_VERSION, '1.2.1', '==' ) && !in_array( '1.2.1', $get_version ) ){
				$this->remove_dir_files(TPGB_ASSET_PATH);
				$versions = array_unique( array_merge( $get_version, $versions ) );
				update_option( $option_name, $versions );
			}
			//1.3.0.1
			if( version_compare( TPGB_VERSION, '1.3.0.1', '==' ) && !in_array( '1.3.0.1', $get_version ) ){
				$this->remove_dir_files(TPGB_ASSET_PATH);
				$versions = array_unique( array_merge( $get_version, $versions ) );
				update_option( $option_name, $versions );
			}
		}
	}
	
	/**
	 * Returns the instance.
	 * @since  1.0.0
	 */
	public static function get_instance( $shortcodes = array() ) {
		
		if ( null == self::$instance ) {
			self::$instance = new self( $shortcodes );
		}
		return self::$instance;
	}
	
	/**
	 * Filters the content of a single block.
	 *
	 * @since 1.3.0.2
	 * @access public
	 * @param string $block_content The block content about to be appended.
	 * @param array  $block         The full block, including name and attributes.
	 * @return string               Returns $block_content unaltered.
	 */
	public function render_block( $block_content, $block ) {
		
		if ( $block['blockName'] ) {
			$options = (!empty($block['attrs'])) ? $block['attrs'] : '';
			$this->plus_blocks_options( $options, $block['blockName'] );
			$this->transient_blocks[] = $block['blockName'];
			
			if( !preg_match('/\btpgb\/\b/', $block['blockName']) && isset($options['tpgbDisrule']) && !empty($options[ 'tpgbDisrule' ]) ){
				$global_blocks = Tpgb_Blocks_Global_Options::get_instance();
				$options = array_merge($global_blocks::render_block_default_attributes(), $options);
				$block_content = $global_blocks::block_row_conditional_render($options,$block_content);
			}
			
			//check content shortcode
			if (  !empty($block_content) && preg_match_all( '/'. get_shortcode_regex() .'/s', $block_content, $matches ) ) {
				if(!empty($matches) && array_key_exists( 2, $matches ) && has_shortcode( $block_content, $matches[2][0] )){
					$attrs=shortcode_parse_atts($matches[3][0]);
					if(!empty($attrs) && isset($attrs['id']) && !empty($attrs['id'])){
						if ( class_exists( 'Tp_Core_Init_Blocks' ) ) {
							$css_file = Tp_Core_Init_Blocks::get_instance();
							if ( !empty($css_file) && is_callable( array( $css_file, 'enqueue_post_css' ) ) ) {
								$css_file->enqueue_post_css( $attrs['id'] );
							}
						}
					}
				}
			}

			// Get Dynamic Content
			if(class_exists('Tpgbp_Pro_Blocks_Helper')){
				$blocks_helper = Tpgbp_Pro_Blocks_Helper::get_instance();
				if ( !empty($blocks_helper) && is_callable( array( $blocks_helper, 'tpgb_dynamic_val' ) ) ) {
					$block_content = $blocks_helper::tpgb_dynamic_val($block_content, $block);
				}
			}

			//Full site editing compatibility
			if(preg_match('/\btpgb\/\b/', $block['blockName']) && !empty($block) && !empty($block['innerHTML'])){
				$styletag = '/<style>(.*?)<\/style>/m';
				if(preg_match_all( $styletag , $block['innerHTML'], $style_matches )){
					$style = ($style_matches[0] && $style_matches[0][0]) ? $style_matches[0][0] : '';
					$block_content = $block_content.$style;
				}
			}
		}
		return $block_content;
	}
	
	/*
	 * List of Blocks Condition Check
	 *
	 * @since 1.1.1
	 */
	public function plus_blocks_options($options='' , $blockname=''){
		
		if(!empty($options) && !empty($options['contentHoverEffect'])){
			$this->transient_blocks[] = 'content-hover-effect';
		}
		if(!empty($options) && !empty($options['globalAnim']) && ((!empty($options['globalAnim']['md']) && $options['globalAnim']['md']!='none') || (!empty($options['globalAnim']['sm']) && $options['globalAnim']['sm']!='none') || (!empty($options['globalAnim']['xs']) && $options['globalAnim']['xs']!='none'))){
			$this->transient_blocks[] = 'tpgb-animation';
		}
		
		// Row Column Link Js
        if(($blockname=='tpgb/tp-row' || $blockname=='tpgb/tp-column') && !empty($options) && !empty($options['wrapLink']) && $options['wrapLink'] == true ) {
            $this->transient_blocks[] = 'tpgb-row-column-link';
        }

		if(!empty($options) && !empty($options['layoutType']) && $options['layoutType']=='carousel'){	//infobox / flipbox
			$this->transient_blocks[] = 'carouselSlider';
		}
		if(!empty($options) && !empty($options['extBtnshow'])){
			$this->transient_blocks[] = 'tpgb-group-button';
		}
		
		if($blockname=='tpgb/tp-countdown') {
			$this->transient_blocks[] = 'countdown-style-1';
		}
		if($blockname=='tpgb/tp-flipbox' && !empty($options) && (!empty($options['backBtn']) || !empty($options['backCarouselBtn']))){
			$this->transient_blocks[] = 'tpgb-group-button';
		}
		
		//Post Listing
		if($blockname=='tpgb/tp-post-listing') {
			if(!empty($options) && !empty($options['postLodop']) && $options['postLodop'] == 'pagination' ){
				$this->transient_blocks[] = 'tpgb-pagination';
			} 
		}
		
		//External-Form-Styler
		if($blockname=='tpgb/tp-external-form-styler') {
			if( !empty($options) && !empty($options['formType']) && $options['formType'] == 'caldera-form'){  // Caldera Form
				$this->transient_blocks[] = 'tpgb-caldera-form';
			}

			if( !empty($options) && !empty($options['formType']) && $options['formType'] == 'everest-form'){  // Everest Form
				$this->transient_blocks[] = 'tpgb-everest-form';
			}

			if( !empty($options) && !empty($options['formType']) && $options['formType'] == 'gravity-form'){  // Gravity Form
				$this->transient_blocks[] = 'tpgb-gravity-form';
			}

			if( !empty($options) && !empty($options['formType']) && $options['formType'] == 'wp-form'){  // Wp=Form
				$this->transient_blocks[] = 'tpgb-wp-form';
			}
		}
		//Svg Icon Load 
		if( ($blockname=='tpgb/tp-flipbox' && !empty($options) && !empty($options['iconType']) && $options['iconType'] == 'svg') || ($blockname=='tpgb/tp-infobox' && !empty($options) && !empty($options['iconType']) && $options['iconType'] == 'svg') || ($blockname=='tpgb/tp-number-counter' && !empty($options) && !empty($options['iconType']) && $options['iconType'] == 'svg') || ($blockname=='tpgb/tp-pricing-table' && !empty($options) && !empty($options['iconType']) && $options['iconType'] == 'svg') ){
			$this->transient_blocks[] = 'tpgb-draw-svg';
		}
		
		// tpgb-fancy-box
		if($blockname=='tpgb/tp-post-image' && !empty($options) && !empty($options['fancyBox']) && $options['fancyBox'] == true ) {
			$this->transient_blocks[] = 'tpgb-fancy-box';
		}
		if($blockname=='tpgb/tp-creative-image' && !empty($options) && !empty($options['fancyBox']) && $options['fancyBox'] == true ) {
			$this->transient_blocks[] = 'tpgb-fancy-box';
		}
		
		if(has_filter('tpgb_has_blocks_condition')) {
			$this->transient_blocks = apply_filters('tpgb_has_blocks_condition', $this->transient_blocks, $options, $blockname );
		}
	}
	
	public function plus_post_save_transient( $post_id, $post, $update ){
		update_option('tpgb_save_updated_at', strtotime('now'), false);
	}
	
	public function init_post_request_data(){
		
		if (is_admin()) {
            return;
        }
		
		if ($this->is_background_running()) {
            return;
        }
		
		$uid = null;
		
		if (!$this->is_preview_mode()) {
			if (is_home() || is_singular() || is_archive() || is_search() || (isset( $wp_query ) && (bool) $wp_query->is_posts_page) || is_404()) {
				$queried_obj = get_queried_object_id();
				
				if(is_search()){
					$queried_obj = 'search';
				}
				if(is_404()){
					$queried_obj = '404';
				}
				$post_type = (is_singular() ? 'post' : 'term');
				$uid = 'theplus-' . $post_type . '-' . $queried_obj;
			}
		}else{
			$uid = 'theplus';
		}
		
		if ($uid && $this->plus_uid == null) {
            $this->plus_uid = $uid;
            $this->requires_update = $this->requires_update();
        }
	}
	
	public function requires_update(){
		
		$blocks = get_option($this->plus_uid . '_blocks');
        $save_updated_at = get_option('tpgb_save_updated_at');
        $post_updated_at = get_option($this->plus_uid . '_updated_at');

        if ($blocks === false) {
            return true;
        }
        if ($save_updated_at === false) {
            return true;
        }
        if ($post_updated_at === false) {
            return true;
        }
        if ($save_updated_at != $post_updated_at) {
            return true;
        }

		return false;
	}
	
	/**
     * Check if wp running in background
     *
     * @since 1.0.0
     */
    public function is_background_running() {
        if (wp_doing_cron()) {
            return true;
        }

        if (wp_doing_ajax()) {
            return true;
        }
        
        /*if (isset($_REQUEST['action'])) {
            return true;
        }*/

        return false;
    }
	
	/**
	 * Constructor
	 */
	public function __construct() {
		$this->get_registered_blocks();
		$this->transient_blocks = [];
		$this->plus_template_blocks = [];
		
		add_filter( 'render_block', [ $this, 'render_block' ], 1000, 2 );
		add_filter('plus_template_parse_blocks', [ $this, 'plus_template_load_parse_blocks']);
		add_action('wp_print_footer_scripts', array($this, 'generate_scripts_frontend'));

		add_action( 'save_post', array($this,'plus_post_save_transient'), 10,3 );
		
		add_action('wp', [$this, 'init_post_request_data']);
		
		add_action( 'admin_bar_menu', [ $this, 'add_tpgb_clear_cache_admin_bar' ], 300 );
		add_action('wp_ajax_tpda_purge_current_clear', array($this, 'tpgb_current_page_clear_cache'));
		
		add_action( 'wp_footer', [ $this, 'wp_footer' ] );
		
		if (is_admin()) {
			add_action('admin_init', array($this, 'dynamic_style_version_clear_cache'));
			add_action('wp_ajax_tpgb_all_perf_clear_cache', array($this, 'tpgb_smart_perf_clear_cache'));
			add_action('wp_ajax_tpgb_all_dynamic_clear_style', array($this, 'tpgb_dynamic_style_cache'));
			add_action('wp_ajax_tpgb_backend_clear_cache', array($this, 'tpgb_backend_clear_cache'));
		}
	}
}

/**
 * Returns instance of Tpgb_Library
 */
function tpgb_library() {
	return Tpgb_Library::get_instance();
}
?>
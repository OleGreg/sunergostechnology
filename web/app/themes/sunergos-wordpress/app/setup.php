<?php

/**
 * Theme setup.
 */

namespace App;

use function Roots\bundle;

/**
 * Register the theme assets.
 *
 * @return void
 */
add_action('wp_enqueue_scripts', function () {
    bundle('app')->enqueue();
}, 100);

/**
 * Register the theme assets with the block editor.
 *
 * @return void
 */
add_action('enqueue_block_editor_assets', function () {
    bundle('editor')->enqueue();
    bundle('blocks/animated-flowers')->enqueue();
    bundle('blocks/sunergos-footer-cta')->enqueue();
    bundle('blocks/slideshows')->enqueue();
}, 100);

/**
 * Initialize the animated-flowers block
 */

add_action('init', function() {
    $attributes_args = [
        'default' => 'echinacea',
        'type'    => 'string'
    ];
    register_block_type('sage/animated-flowers', [
        'attributes' => array(
            'flower_type' => $attributes_args
        ),
        'render_callback' => function($attributes) {
            if($attributes['flower_type'] == 'lavender') {
                return view('blocks.lavender')->render();
            }
            else {
                return view('blocks.echinacea')->render();
            }
        }
    ]);
});

/**
 * Initialize the slideshows block
 */

 add_action('init', function() {
    $attributes_args = [
        'default' => 'sd_slideshow',
        'type'    => 'string'
    ];
    register_block_type('sage/slideshows', [
        'attributes' => array(
            'slideshow_type' => $attributes_args
        ),
        'render_callback' => function($attributes) {
            if($attributes['slideshow_type'] == 'sd_slideshow') {
                return view('blocks.sd_slideshow')->render();
            }
            if($attributes['slideshow_type'] == 'md_slideshow') {
                return view('blocks.md_slideshow')->render();
            }
            if($attributes['slideshow_type'] == 'dm_slideshow') {
                return view('blocks.dm_slideshow')->render();
            }
        }
    ]);
 }); 

/**
 * Add all custom styles to editor as well
 */

 add_action('after_setup_theme', function () {
    add_theme_support('editor-styles');
    add_editor_style(asset('app.css')->relativePath(get_theme_file_path()));
});

/**
 * Register the initial theme setup.
 *
 * @return void
 */
add_action('after_setup_theme', function () {
    /**
     * Disable full-site editing support.
     *
     * @link https://wptavern.com/gutenberg-10-5-embeds-pdfs-adds-verse-block-color-options-and-introduces-new-patterns
     */
    remove_theme_support('block-templates');

    /**
     * Register the navigation menus.
     *
     * @link https://developer.wordpress.org/reference/functions/register_nav_menus/
     */
    register_nav_menus([
        'primary_navigation' => __('Primary Navigation', 'sage'),
        'footer_navigation'  => __('Footer Navigation', 'sage'),
    ]);

    /**
     * Disable the default block patterns.
     *
     * @link https://developer.wordpress.org/block-editor/developers/themes/theme-support/#disabling-the-default-block-patterns
     */
    remove_theme_support('core-block-patterns');

    /**
     * Enable plugins to manage the document title.
     *
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#title-tag
     */
    add_theme_support('title-tag');

    /**
     * Enable post thumbnail support.
     *
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support('post-thumbnails');

    /**
     * Enable responsive embed support.
     *
     * @link https://developer.wordpress.org/block-editor/how-to-guides/themes/theme-support/#responsive-embedded-content
     */
    add_theme_support('responsive-embeds');

    /**
     * Enable HTML5 markup support.
     *
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#html5
     */
    add_theme_support('html5', [
        'caption',
        'comment-form',
        'comment-list',
        'gallery',
        'search-form',
        'script',
        'style',
    ]);

    /**
     * Enable selective refresh for widgets in customizer.
     *
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#customize-selective-refresh-widgets
     */
    add_theme_support('customize-selective-refresh-widgets');
}, 20);

/**
 * Register the theme sidebars.
 *
 * @return void
 */
add_action('widgets_init', function () {
    $config = [
        'before_widget' => '<section class="widget %1$s %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ];

    register_sidebar([
        'name' => __('Primary', 'sage'),
        'id' => 'sidebar-primary',
    ] + $config);

    register_sidebar([
        'name' => __('Footer', 'sage'),
        'id' => 'sidebar-footer',
    ] + $config);
});

/**
 * Create Software Development Slides Custom Post Type
 *
 * @see get_post_type_labels() for label keys.
 */

 function initialize_software_development_slides() {
	$labels = array(
		'name'                  => _x( 'Software Development Slides', 'Post type general name', 'textdomain' ),
		'singular_name'         => _x( 'Software Development Slide', 'Post type singular name', 'textdomain' ),
		'menu_name'             => _x( 'Software Development Slides', 'Admin Menu text', 'textdomain' ),
		'name_admin_bar'        => _x( 'Software Development Slide', 'Add New on Toolbar', 'textdomain' ),
		'add_new'               => __( 'Add New', 'textdomain' ),
		'add_new_item'          => __( 'Add New Software Development Slide', 'textdomain' ),
		'new_item'              => __( 'New Software Development Slide', 'textdomain' ),
		'edit_item'             => __( 'Edit Software Development Slide', 'textdomain' ),
		'view_item'             => __( 'View Software Development Slide', 'textdomain' ),
		'all_items'             => __( 'All Software Development Slides', 'textdomain' ),
		'search_items'          => __( 'Search Software Development Slides', 'textdomain' ),
		'parent_item_colon'     => __( 'Parent Software Development Slides:', 'textdomain' ),
		'not_found'             => __( 'No slides found.', 'textdomain' ),
		'not_found_in_trash'    => __( 'No slides found in Trash.', 'textdomain' ),
		'featured_image'        => _x( 'Software Development Slide Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'textdomain' ),
		'set_featured_image'    => _x( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
		'remove_featured_image' => _x( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
		'use_featured_image'    => _x( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
		'archives'              => _x( 'Software Development Slide archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'textdomain' ),
		'insert_into_item'      => _x( 'Insert into slide', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'textdomain' ),
		'uploaded_to_this_item' => _x( 'Uploaded to this slide', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'textdomain' ),
		'filter_items_list'     => _x( 'Filter slides list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'textdomain' ),
		'items_list_navigation' => _x( 'Software Development Slides list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'textdomain' ),
		'items_list'            => _x( 'Software Development Slides list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'textdomain' ),
	);

	$args = array(
		'labels'             => $labels,
        'description'        => 'Slides to be displayed wherever the software development slideshow block is placed',
		'public'             => false,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
        'menu_icon'          => 'dashicons-slides',
		'rewrite'            => array( 'slug' => 'software-development-slides' ),
		'capability_type'    => 'post',
		'has_archive'        => false,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'thumbnail' ),
	);

	register_post_type( 'sd_slides', $args );
}

add_action( 'init', __NAMESPACE__ . '\\initialize_software_development_slides' );

/**
 * Create Multimedia Design Slides Custom Post Type
 *
 * @see get_post_type_labels() for label keys.
 */

 function initialize_multimedia_design_slides() {
	$labels = array(
		'name'                  => _x( 'Multimedia Design Slides', 'Post type general name', 'textdomain' ),
		'singular_name'         => _x( 'Multimedia Design Slide', 'Post type singular name', 'textdomain' ),
		'menu_name'             => _x( 'Multimedia Design Slides', 'Admin Menu text', 'textdomain' ),
		'name_admin_bar'        => _x( 'Multimedia Design Slide', 'Add New on Toolbar', 'textdomain' ),
		'add_new'               => __( 'Add New', 'textdomain' ),
		'add_new_item'          => __( 'Add New Multimedia Design Slide', 'textdomain' ),
		'new_item'              => __( 'New Multimedia Design Slide', 'textdomain' ),
		'edit_item'             => __( 'Edit Multimedia Design Slide', 'textdomain' ),
		'view_item'             => __( 'View Multimedia Design Slide', 'textdomain' ),
		'all_items'             => __( 'All Multimedia Design Slides', 'textdomain' ),
		'search_items'          => __( 'Search Multimedia Design Slides', 'textdomain' ),
		'parent_item_colon'     => __( 'Parent Multimedia Design Slides:', 'textdomain' ),
		'not_found'             => __( 'No slides found.', 'textdomain' ),
		'not_found_in_trash'    => __( 'No slides found in Trash.', 'textdomain' ),
		'featured_image'        => _x( 'Multimedia Design Slide Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'textdomain' ),
		'set_featured_image'    => _x( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
		'remove_featured_image' => _x( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
		'use_featured_image'    => _x( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
		'archives'              => _x( 'Multimedia Design Slide archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'textdomain' ),
		'insert_into_item'      => _x( 'Insert into slide', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'textdomain' ),
		'uploaded_to_this_item' => _x( 'Uploaded to this slide', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'textdomain' ),
		'filter_items_list'     => _x( 'Filter slides list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'textdomain' ),
		'items_list_navigation' => _x( 'Multimedia Design Slides list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'textdomain' ),
		'items_list'            => _x( 'Multimedia Design Slides list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'textdomain' ),
	);

	$args = array(
		'labels'             => $labels,
        'description'        => 'Slides to be displayed wherever the multimedia design slideshow block is placed',
		'public'             => false,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
        'menu_icon'          => 'dashicons-slides',
		'rewrite'            => array( 'slug' => 'multimedia-development-slides' ),
		'capability_type'    => 'post',
		'has_archive'        => false,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'thumbnail' ),
	);

	register_post_type( 'md_slides', $args );
}

add_action( 'init', __NAMESPACE__ . '\\initialize_multimedia_design_slides' );

/**
 * Create Digital Marketing Slides Custom Post Type
 *
 * @see get_post_type_labels() for label keys.
 */

 function initialize_digital_marketing_slides() {
	$labels = array(
		'name'                  => _x( 'Digital Marketing Slides', 'Post type general name', 'textdomain' ),
		'singular_name'         => _x( 'Digital Marketing Slide', 'Post type singular name', 'textdomain' ),
		'menu_name'             => _x( 'Digital Marketing Slides', 'Admin Menu text', 'textdomain' ),
		'name_admin_bar'        => _x( 'Digital Marketing Slide', 'Add New on Toolbar', 'textdomain' ),
		'add_new'               => __( 'Add New', 'textdomain' ),
		'add_new_item'          => __( 'Add New Digital Marketing Slide', 'textdomain' ),
		'new_item'              => __( 'New Digital Marketing Slide', 'textdomain' ),
		'edit_item'             => __( 'Edit Digital Marketing Slide', 'textdomain' ),
		'view_item'             => __( 'View Digital Marketing Slide', 'textdomain' ),
		'all_items'             => __( 'All Digital Marketing Slides', 'textdomain' ),
		'search_items'          => __( 'Search Digital Marketing Slides', 'textdomain' ),
		'parent_item_colon'     => __( 'Parent Digital Marketing Slides:', 'textdomain' ),
		'not_found'             => __( 'No slides found.', 'textdomain' ),
		'not_found_in_trash'    => __( 'No slides found in Trash.', 'textdomain' ),
		'featured_image'        => _x( 'Digital Marketing Slide Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'textdomain' ),
		'set_featured_image'    => _x( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
		'remove_featured_image' => _x( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
		'use_featured_image'    => _x( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
		'archives'              => _x( 'Digital Marketing Slide archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'textdomain' ),
		'insert_into_item'      => _x( 'Insert into slide', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'textdomain' ),
		'uploaded_to_this_item' => _x( 'Uploaded to this slide', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'textdomain' ),
		'filter_items_list'     => _x( 'Filter slides list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'textdomain' ),
		'items_list_navigation' => _x( 'Digital Marketing Slides list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'textdomain' ),
		'items_list'            => _x( 'Digital Marketing Slides list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'textdomain' ),
	);

	$args = array(
		'labels'             => $labels,
        'description'        => 'Slides to be displayed wherever the digital marketing slideshow block is placed',
		'public'             => false,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
        'menu_icon'          => 'dashicons-slides',
		'rewrite'            => array( 'slug' => 'digital-marketing-slides' ),
		'capability_type'    => 'post',
		'has_archive'        => false,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'thumbnail' ),
	);

	register_post_type( 'dm_slides', $args );
}

add_action( 'init', __NAMESPACE__ . '\\initialize_digital_marketing_slides' );

/**
 * Clear the sitemap cache
 */

add_action('init', function() {
    function clear_sitemap_cache() {
        if (function_exists('wp_sitemaps_get_server')) {
            wp_sitemaps_get_server()->renderer->cache->invalidate('all');
        }
    }
});

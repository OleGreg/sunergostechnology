<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class Post extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'partials.page-header',
        'partials.content',
        'partials.content-*',
    ];

    /**
     * Data to be passed to view before rendering, but after merging.
     *
     * @return array
     */
    public function override()
    {
        return [
            'title' => $this->title(),
            'pagination' => $this->pagination(),
            'imageUrl' => $this->imageUrl(),
            'imageAlt' => $this->imageAlt(),
            'postCategories' => $this->postCategories(),
        ];
    }

    /**
     * Retrieve the post title.
     *
     * @return string
     */
    public function title()
    {
        if ($this->view->name() !== 'partials.page-header') {
            return get_the_title();
        }

        if (is_home()) {
            if ($home = get_option('page_for_posts', true)) {
                return get_the_title($home);
            }

            return __('Latest Posts', 'sage');
        }

        if(is_author()) {
            add_filter('get_the_archive_title_prefix', function() {
                return 'Articles by Author:';
            });
            return get_the_archive_title();
        }

        if (is_archive()) {
            return get_the_archive_title();
        }

        if (is_search()) {
            return sprintf(
                /* translators: %s is replaced with the search query */
                __('Search Results for %s', 'sage'),
                get_search_query()
            );
        }

        if (is_404()) {
            return __('Not Found', 'sage');
        }

        return get_the_title();
    }

    /**
     * Retrieve the Featured Image URL.
     *
     * @return string
     */
    public function imageUrl()
    {
        global $post;
        $featured_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
        if(empty($featured_image_url)) {
            $featured_image_url = \Roots\asset('images/roses.png');
        } else {
            $featured_image_url = $featured_image_url[0];
        }
        return $featured_image_url;
    }

    /**
     * Retrieve the Featured Image Alt text.
     *
     * @return string
     */
    public function imageAlt()
    {
        $image_id = get_post_thumbnail_id();
        $image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', TRUE);

        return $image_alt;
    }

    /**
     * Retrieve the post categories.
     *
     * @return string
     */
    public function postCategories()
    {
        $categories_object = get_the_category();
        $categories_html = '';
        $last_key = array_key_last($categories_object);

        foreach($categories_object as $key => $category_object) {

            if($key < $last_key) {
                $category_element = '<span itemprop="about" itemscope itemtype="https://schema.org/Thing"><p data-category-id="' . $category_object->cat_ID .'" class="post-category-label active leading-[100%] max-md:text-center" itemprop="name">' . $category_object->cat_name . '</p></span>';
                $category_element .= '<p data-category-id="' . $category_object->cat_ID .'" class="post-category-label active leading-[100%] mr-1">,</p>';
            } else {
                $category_element = '<span itemprop="about" itemscope itemtype="https://schema.org/Thing"><p data-category-id="' . $category_object->cat_ID .'" class="post-category-label active leading-[100%] max-md:text-center" itemprop="name">' . $category_object->cat_name . '</p></span>';
            }
            $categories_html = $categories_html . $category_element;
        }

        return $categories_html;
    }

    /**
     * Retrieve the pagination links.
     *
     * @return string
     */
    public function pagination()
    {
        return wp_link_pages([
            'echo' => 0,
            'before' => '<p>'.__('Pages:', 'sage'),
            'after' => '</p>',
        ]);
    }
}

<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class PostIndex extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'index',
    ];

    /**
     * Data to be passed to view before rendering, but after merging.
     *
     * @return array
     */
    public function override()
    {
        return [
            'pagination'      => $this->pagination(),
            'categoryButtons' => $this->categoryButtons(),
        ];
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

    /**
     * Generate category buttons.
     *
     * @return string
     */
    public function categoryButtons() {
        $category_objects = get_categories();
        $category_buttons = '<button data-category-id="0" class="category-button active"><span>All Categories</span></button>';

        foreach($category_objects as $key => $category_object) {
            $new_button = '<button data-category-id="' . $category_object->cat_ID . '" class="category-button" itemscope itemtype="https://schema.org/ListItem">
            <meta itemprop="position" content="' . ($key + 1) . '" />
            <span itemprop="name">' . $category_object->cat_name . '</span>
            </button>';
            $category_buttons = $category_buttons . $new_button;
        }

        if(!empty(get_categories())) {
            return '<div class="flex flex-row gap-5 justify-center my-10 flex-wrap" itemscope itemtype="https://schema.org/ItemList">
            <meta itemprop="name" content="Blog Categories" />
            <meta itemprop="numberOfItems" content="' . count($category_objects) . '" />
            <meta itemprop="itemListOrder" content="Unordered" />
            ' . $category_buttons . '</div>';
        } else {
            return null;
        }

    }
}

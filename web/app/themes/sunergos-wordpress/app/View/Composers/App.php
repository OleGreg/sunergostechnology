<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class App extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        '*',
    ];

    /**
     * Data to be passed to view before rendering.
     *
     * @return array
     */
    public function with()
    {
        return [
            'siteName' => $this->siteName(),
            'isFrontPage' => $this->isFrontPage(),
            'sunergosBreadcrumbs' => $this->sunergosBreadcrumbs()
        ];
    }

    /**
     * Returns the site name.
     *
     * @return string
     */
    public function siteName()
    {
        return get_bloginfo('name', 'display');
    }

    /**
     * Returns the boolen of the wordpress function, is_front_page().
     *
     * @return boolean
     */
    public function isFrontPage()
    {
        return is_front_page();
    }

    /**
     * Returns site breadcrumbs
     */

    public function sunergosBreadcrumbs() {
        /* Change according to your needs */
        $delimiter = '<span class="delimeter">»</span>';
    
        /* Don't change values below */
        global $post;
        $post_parent_ids = get_post_ancestors( $post->ID );
        $post_parent_ids = array_reverse($post_parent_ids);
        $menu_position = 1;
    
        //Set breadcrumbs with schema
        $breadcrumbs = '<ol id="breadcrumbs" class="breadcrumbs" vocab="http://schema.org" typeof="BreadcrumbList">';

        //loop through post parent ids and create their marked up links
        foreach($post_parent_ids as $post_parent_id) {
            $breadcrumbs .= '<li property="itemListElement" typeof="ListItem">
            <a property="item" typeof="WebPage" href="' . get_permalink($post_parent_id) . '">
            <span property="name">' . get_the_title($post_parent_id) . '</span>
            </a>
            <meta property="position" content="'. $menu_position .'"></li>' . $delimiter;
            $menu_position++;
        }

        //Add the article page as an ancestor in case of the blog
        if(is_single()) {
            $breadcrumbs .= '<li property="itemListElement" typeof="ListItem">
            <a property="item" typeof="WebPage" href="/articles">
            <span property="name">Articles</span>
            </a>
            <meta property="position" content="1"></li>' . $delimiter;

            //Set menu position to 2 in case this is for posts, to hard code it
            $menu_position = '2';
        }
            
        $breadcrumbs .= '<li class="current" property="itemListElement" typeof="ListItem"><span property="name">' . $post->post_title . '</span><meta property="position" content="'. $menu_position .'"></li>';
    
        $breadcrumbs .= '</ol>';

        if($post->post_parent || is_single()) {
            return $breadcrumbs;
        }
        else {
            return null;
        }
    }
}

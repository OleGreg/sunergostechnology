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
            'sunergosBreadcrumbs' => $this->sunergosBreadcrumbs(),
            'socialShareButtons' => $this->socialShareButtons(),
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
            <a property="item" typeof="WebPage" href="' . get_permalink( get_option( 'page_for_posts' ) ) . '">
            <span property="name">' . get_the_title( get_option('page_for_posts') ) . '</span>
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

    public function socialShareButtons()
    {
        $url = esc_url(get_permalink());
        $title = urlencode(html_entity_decode(get_the_title(), ENT_COMPAT, 'UTF-8'));

        $linked_in_svg = '<svg width="32" height="30" viewBox="0 0 32 30" fill="none" xmlns="http://www.w3.org/2000/svg" alt="Linkedin Logo, Image link to Share Sunergos Articles on Linkedin" aria-label="Share this Article to Linkedin">
            <path d="M22 10C24.3869 10 26.6761 10.9482 28.364 12.636C30.0518 14.3239 31 16.6131 31 19V29.5H25V19C25 18.2044 24.6839 17.4413 24.1213 16.8787C23.5587 16.3161 22.7956 16 22 16C21.2044 16 20.4413 16.3161 19.8787 16.8787C19.3161 17.4413 19 18.2044 19 19V29.5H13V19C13 16.6131 13.9482 14.3239 15.636 12.636C17.3239 10.9482 19.6131 10 22 10Z" stroke="#26619C" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M7 11.5H1V29.5H7V11.5Z" stroke="#26619C" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M4 7C5.65685 7 7 5.65685 7 4C7 2.34315 5.65685 1 4 1C2.34315 1 1 2.34315 1 4C1 5.65685 2.34315 7 4 7Z" stroke="#26619C" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>';

        $facebook_svg = '<svg width="18" height="32" viewBox="0 0 18 32" fill="none" xmlns="http://www.w3.org/2000/svg"  alt="Facebook Logo, Image link to Share Sunergos Articles on Facebook" aria-label="Share this to Facebook">
            <path d="M17 1H12.5C10.5109 1 8.60322 1.79018 7.1967 3.1967C5.79018 4.60322 5 6.51088 5 8.5V13H0.5V19H5V31H11V19H15.5L17 13H11V8.5C11 8.10218 11.158 7.72064 11.4393 7.43934C11.7206 7.15804 12.1022 7 12.5 7H17V1Z" stroke="#26619C" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>';

        $x_svg = '<svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg" >
            <path d="M17.6309 12.5004L17.4749 12.6777L17.6106 12.871L29.4228 29.6939H21.2248L13.1332 18.1714L12.914 17.8594L12.6623 18.1458L2.51009 29.6939H0.66341L11.9363 16.8777L12.0923 16.7004L11.9565 16.5071L0.577319 0.306104H8.77525L16.4341 11.2068L16.6531 11.5186L16.9048 11.2325L26.5144 0.306104H28.361L17.6309 12.5004ZM13.9843 16.9996L13.9848 17.0003L22.0685 28.309L22.1582 28.4345H22.3126H26.3788H26.962L26.6228 27.9601L16.7163 14.1031L16.7161 14.1028L15.5276 12.4451L15.5273 12.4446L7.9072 1.77646L7.81747 1.65083H7.66308H3.59683H3.01341L3.35283 2.12536L12.8016 15.3353L12.8021 15.3361L13.9843 16.9996Z" stroke="#26619C" stroke-width="0.6"/>
        </svg>
        ';

        $social_networks = array(
            $facebook_svg => 'https://facebook.com/sharer/sharer.php?u='. $url,
            $linked_in_svg => 'https://www.linkedin.com/shareArticle?url=' . $url . '&title=' . $title,
            $x_svg => 'https://twitter.com/intent/tweet?url=' . $url . '&text=' . $title,
        );

        $share_buttons = '<div class="social-share-buttons">';

        foreach($social_networks as $network => $share_url) {
            $share_buttons .= '<a class="social-share-button" href="' . $share_url . '" target="_blank" rel="noopener">' . $network . '</a>';
        }

        // Close the share buttons HTML
        $share_buttons .= '</div>';

        return $share_buttons;
    }    
}

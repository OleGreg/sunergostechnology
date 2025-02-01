<?php

/**
 * Theme filters.
 */

namespace App;

/**
 * Add "… Continued" to the excerpt.
 *
 * @return string
 */
add_filter('excerpt_more', function () {
    return sprintf(' &hellip; <a href="%s">%s</a>', get_permalink(), __('Continued', 'sage'));
});

add_filter('render_block', function ($block_content, $block) {
    // Target only the 'core/button' block
    if ($block['blockName'] === 'core/button') {
        // Add a custom class to the button
        $block_content = str_replace('wp-block-button__link', 'wp-block-button__link sunergos-cta', $block_content);
        $link_end_position = strpos($block_content, '</a>');
        $additional_content = 
            '<svg class="arrow" width="19" height="14" viewBox="0 0 19 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0.583862 7.2485H18.9292M18.9292 7.2485L12.7553 1.07459M18.9292 7.2485L12.7553 13.4224" stroke="#26619C" stroke-width="1.05839" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>';
        $block_content = substr_replace($block_content, $additional_content, $link_end_position, 0);
    }
    return $block_content;
}, 10, 2);

/**
 * Remove Taxonomies and Users from Wordpress Sitemap
 */

 add_filter('wp_sitemaps_add_provider', function($provider, $name) {
    if (in_array($name, ['taxonomies', 'users'])) {
        return false; // Disable category and user sitemaps
    }
    return $provider;
}, 10, 2);
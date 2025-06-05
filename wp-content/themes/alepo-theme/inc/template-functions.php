<?php
/**
 * Template Functions
 *
 * @package Alepo
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Custom template tags for this theme
 */
function alepo_posted_on() {
    $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
    if (get_the_time('U') !== get_the_modified_time('U')) {
        $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
    }

    $time_string = sprintf($time_string,
        esc_attr(get_the_date(DATE_W3C)),
        esc_html(get_the_date()),
        esc_attr(get_the_modified_date(DATE_W3C)),
        esc_html(get_the_modified_date())
    );

    echo '<span class="posted-on">' . $time_string . '</span>';
}

/**
 * Custom excerpt length
 */
function alepo_custom_excerpt_length($length) {
    return 20;
}
add_filter('excerpt_length', 'alepo_custom_excerpt_length', 999);

/**
 * Custom excerpt more
 */
function alepo_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'alepo_excerpt_more');
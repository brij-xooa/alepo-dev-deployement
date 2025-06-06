<?php
/**
 * Theme Customizer
 *
 * @package Alepo
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Note: alepo_customize_register is already defined in functions.php
// This file contains additional customizer functions only

/**
 * Render the site title for the selective refresh partial
 */
function alepo_customize_partial_blogname() {
    bloginfo('name');
}

/**
 * Render the site tagline for the selective refresh partial
 */
function alepo_customize_partial_blogdescription() {
    bloginfo('description');
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously
 */
function alepo_customize_preview_js() {
    wp_enqueue_script('alepo-customizer', get_template_directory_uri() . '/js/customizer.js', array('customize-preview'), '1.0.0', true);
}
add_action('customize_preview_init', 'alepo_customize_preview_js');
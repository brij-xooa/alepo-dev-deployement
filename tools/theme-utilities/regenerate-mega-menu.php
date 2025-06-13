<?php
/**
 * Regenerate Mega Menu Content 
 * Use this to update mega menu content with fixed button formatting
 */

// Include WordPress
require_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/wp-config.php');

// Include the gutenberg mega menu functions
require_once('inc/gutenberg-mega-menu.php');

echo "Regenerating mega menu content...\n";

// First, register the post type
alepo_register_mega_menu_content();

// Delete existing mega menu posts
$existing_posts = get_posts(array(
    'post_type' => 'mega_menu_content',
    'numberposts' => -1,
    'post_status' => 'any'
));

foreach ($existing_posts as $post) {
    wp_delete_post($post->ID, true);
    echo "Deleted: {$post->post_title}\n";
}

// Create the updated content
alepo_create_default_mega_menu_content();

echo "✅ Mega menu content regenerated with fixed buttons and spacing!\n";

// List created posts
$posts = get_posts(array(
    'post_type' => 'mega_menu_content',
    'numberposts' => -1,
    'post_status' => 'publish'
));

echo "\nCreated mega menu posts:\n";
foreach ($posts as $post) {
    echo "- {$post->post_title} (ID: {$post->ID})\n";
}
?>
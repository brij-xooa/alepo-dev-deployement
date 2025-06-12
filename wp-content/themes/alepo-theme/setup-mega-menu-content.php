<?php
/**
 * Setup Mega Menu Content Posts
 * Run this script to create editable mega menu content in WordPress admin
 */

// Include WordPress
require_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/wp-config.php');

// Include the gutenberg mega menu functions
require_once('inc/gutenberg-mega-menu.php');

echo "Setting up mega menu content...\n";

// Register the post type first
alepo_register_mega_menu_content();

// Create the default content
alepo_create_default_mega_menu_content();

echo "✅ Mega menu content setup complete!\n";
echo "You can now edit mega menus at: wp-admin → Mega Menus\n";

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
<?php
/**
 * Debug Page Content - Check what's happening with our pages
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

function alepo_debug_page_content() {
    echo "<h2>Debug Page Content</h2>\n";
    
    // Get all our Claude-generated pages
    $pages = get_pages(['meta_key' => '_alepo_custom_generated', 'meta_value' => true]);
    
    echo "<h3>Claude-Generated Pages Found: " . count($pages) . "</h3>\n";
    
    foreach ($pages as $page) {
        echo "<div style='border: 1px solid #ccc; margin: 10px 0; padding: 15px;'>\n";
        echo "<h4>Page: {$page->post_title}</h4>\n";
        echo "<strong>ID:</strong> {$page->ID}<br>\n";
        echo "<strong>Slug:</strong> {$page->post_name}<br>\n";
        echo "<strong>Parent:</strong> " . ($page->post_parent ? get_the_title($page->post_parent) . " (ID: {$page->post_parent})" : "None") . "<br>\n";
        echo "<strong>URL:</strong> <a href='" . get_permalink($page->ID) . "' target='_blank'>" . get_permalink($page->ID) . "</a><br>\n";
        echo "<strong>Content Preview:</strong> " . substr(strip_tags($page->post_content), 0, 200) . "...<br>\n";
        echo "<strong>Custom Generated:</strong> " . (get_post_meta($page->ID, '_alepo_custom_generated', true) ? 'Yes' : 'No') . "<br>\n";
        echo "</div>\n";
    }
    
    // Test specific URL resolution
    echo "<h3>URL Testing</h3>\n";
    $test_urls = [
        '/products/digital-bss/',
        '/products/aaa-solutions/'
    ];
    
    foreach ($test_urls as $url) {
        $page_id = url_to_postid(home_url($url));
        echo "<strong>URL:</strong> {$url} → ";
        if ($page_id) {
            echo "Page ID: {$page_id} (" . get_the_title($page_id) . ")<br>\n";
        } else {
            echo "No page found<br>\n";
        }
    }
    
    // Check front page setting
    echo "<h3>Front Page Settings</h3>\n";
    echo "<strong>Show on front:</strong> " . get_option('show_on_front') . "<br>\n";
    echo "<strong>Page on front:</strong> " . get_option('page_on_front') . " (" . get_the_title(get_option('page_on_front')) . ")<br>\n";
    
    // Check permalink structure
    echo "<h3>Permalink Structure</h3>\n";
    echo "<strong>Permalink structure:</strong> " . get_option('permalink_structure') . "<br>\n";
}

// If accessed directly via URL, run the function
if (isset($_GET['debug_pages']) && $_GET['debug_pages'] === 'yes') {
    alepo_debug_page_content();
}
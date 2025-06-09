<?php
/**
 * Fix Permalinks and Page Routing
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

function alepo_fix_permalinks() {
    echo "<h2>Fixing Permalinks and Page Routing</h2>\n";
    
    // First, let's check what pages we have
    $pages = get_pages(['meta_key' => '_alepo_custom_generated', 'meta_value' => true]);
    
    echo "<h3>Current Pages:</h3>\n";
    foreach ($pages as $page) {
        echo "- {$page->post_title} (ID: {$page->ID}) - URL: " . get_permalink($page->ID) . "<br>\n";
    }
    
    // Force flush rewrite rules
    echo "<h3>Flushing Rewrite Rules...</h3>\n";
    flush_rewrite_rules(true);
    echo "✅ Rewrite rules flushed<br>\n";
    
    // Check URL to post ID mapping
    echo "<h3>Testing URL Resolution:</h3>\n";
    $test_urls = [
        home_url('/products/digital-bss/'),
        home_url('/products/aaa-solutions/')
    ];
    
    foreach ($test_urls as $url) {
        $post_id = url_to_postid($url);
        echo "URL: {$url} → Post ID: {$post_id}";
        if ($post_id) {
            echo " (" . get_the_title($post_id) . ")";
        }
        echo "<br>\n";
    }
    
    // Check if pages have correct hierarchy
    echo "<h3>Page Hierarchy Check:</h3>\n";
    $products_page = get_page_by_path('products');
    if ($products_page) {
        echo "Products page exists: ID {$products_page->ID}<br>\n";
        
        $child_pages = get_pages(['child_of' => $products_page->ID]);
        echo "Child pages: " . count($child_pages) . "<br>\n";
        foreach ($child_pages as $child) {
            echo "- {$child->post_title} (ID: {$child->ID}) - URL: " . get_permalink($child->ID) . "<br>\n";
        }
    } else {
        echo "❌ Products page not found<br>\n";
    }
    
    // Force refresh WordPress cache
    if (function_exists('wp_cache_flush')) {
        wp_cache_flush();
        echo "✅ Cache flushed<br>\n";
    }
    
    echo "<h3>✅ Permalink fix complete!</h3>\n";
    echo "<p>Try visiting your pages now:</p>\n";
    echo "<ul>\n";
    echo "<li><a href='" . home_url('/products/digital-bss/') . "' target='_blank'>" . home_url('/products/digital-bss/') . "</a></li>\n";
    echo "<li><a href='" . home_url('/products/aaa-solutions/') . "' target='_blank'>" . home_url('/products/aaa-solutions/') . "</a></li>\n";
    echo "</ul>\n";
}

// If accessed directly via URL, run the function
if (isset($_GET['fix_permalinks']) && $_GET['fix_permalinks'] === 'yes') {
    alepo_fix_permalinks();
}
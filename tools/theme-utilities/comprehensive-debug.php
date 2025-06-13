<?php
/**
 * Comprehensive Debug Script - Find Root Cause of Page Routing Issue
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

function alepo_comprehensive_debug() {
    echo "<h2>🔍 Comprehensive Debug Analysis</h2>\n";
    
    // Step 1: Check what page WordPress thinks we're on
    echo "<h3>Step 1: Current Page Detection</h3>\n";
    global $wp_query;
    
    echo "<strong>Current URL:</strong> " . $_SERVER['REQUEST_URI'] . "<br>\n";
    echo "<strong>Is Front Page:</strong> " . (is_front_page() ? 'Yes' : 'No') . "<br>\n";
    echo "<strong>Is Page:</strong> " . (is_page() ? 'Yes' : 'No') . "<br>\n";
    echo "<strong>Is Home:</strong> " . (is_home() ? 'Yes' : 'No') . "<br>\n";
    echo "<strong>Current Post ID:</strong> " . get_the_ID() . "<br>\n";
    echo "<strong>Current Post Title:</strong> " . get_the_title() . "<br>\n";
    echo "<strong>Template Being Used:</strong> " . get_page_template_slug() . "<br>\n";
    
    // Step 2: Check all our pages and their URLs
    echo "<h3>Step 2: All Claude Pages Analysis</h3>\n";
    $pages = get_pages(['meta_key' => '_alepo_custom_generated', 'meta_value' => true]);
    
    foreach ($pages as $page) {
        echo "<div style='border: 1px solid #ddd; margin: 10px 0; padding: 10px;'>\n";
        echo "<strong>Title:</strong> {$page->post_title}<br>\n";
        echo "<strong>ID:</strong> {$page->ID}<br>\n";
        echo "<strong>Slug:</strong> {$page->post_name}<br>\n";
        echo "<strong>Parent ID:</strong> {$page->post_parent}<br>\n";
        
        if ($page->post_parent) {
            $parent = get_post($page->post_parent);
            echo "<strong>Parent Title:</strong> {$parent->post_title}<br>\n";
            echo "<strong>Parent Slug:</strong> {$parent->post_name}<br>\n";
        }
        
        $permalink = get_permalink($page->ID);
        echo "<strong>WordPress Permalink:</strong> <a href='{$permalink}' target='_blank'>{$permalink}</a><br>\n";
        
        // Test URL resolution
        $test_id = url_to_postid($permalink);
        echo "<strong>URL Resolution Test:</strong> " . ($test_id == $page->ID ? "✅ PASS" : "❌ FAIL (resolves to: {$test_id})") . "<br>\n";
        
        echo "</div>\n";
    }
    
    // Step 3: Check WordPress settings that might affect routing
    echo "<h3>Step 3: WordPress Settings Check</h3>\n";
    echo "<strong>Permalink Structure:</strong> " . get_option('permalink_structure') . "<br>\n";
    echo "<strong>Show on Front:</strong> " . get_option('show_on_front') . "<br>\n";
    echo "<strong>Page on Front:</strong> " . get_option('page_on_front') . " (" . get_the_title(get_option('page_on_front')) . ")<br>\n";
    echo "<strong>Posts Page:</strong> " . get_option('page_for_posts') . " (" . get_the_title(get_option('page_for_posts')) . ")<br>\n";
    
    // Step 4: Test specific problematic URLs
    echo "<h3>Step 4: URL Resolution Testing</h3>\n";
    $test_urls = [
        '/products/digital-bss/',
        '/products/aaa-solutions/',
        '/products/',
        '/'
    ];
    
    foreach ($test_urls as $url) {
        $full_url = home_url($url);
        $page_id = url_to_postid($full_url);
        echo "<strong>URL:</strong> {$url} → ";
        if ($page_id) {
            $title = get_the_title($page_id);
            $is_claude = get_post_meta($page_id, '_alepo_custom_generated', true);
            echo "Page ID: {$page_id} ({$title}) - Claude Generated: " . ($is_claude ? 'Yes' : 'No') . "<br>\n";
        } else {
            echo "❌ No page found<br>\n";
        }
    }
    
    // Step 5: Check query vars and rewrite rules
    echo "<h3>Step 5: WordPress Query Analysis</h3>\n";
    global $wp_rewrite;
    echo "<strong>Rewrite Rules Count:</strong> " . count($wp_rewrite->wp_rewrite_rules()) . "<br>\n";
    
    // Check if our URLs are in rewrite rules
    $rules = $wp_rewrite->wp_rewrite_rules();
    $found_rules = 0;
    foreach ($rules as $pattern => $replacement) {
        if (strpos($pattern, 'products') !== false) {
            echo "<strong>Products Rule:</strong> {$pattern} → {$replacement}<br>\n";
            $found_rules++;
        }
    }
    echo "<strong>Products-related rules found:</strong> {$found_rules}<br>\n";
    
    // Step 6: Check what template is being loaded
    echo "<h3>Step 6: Template Loading Analysis</h3>\n";
    $template_hierarchy = [
        'page.php',
        'front-page.php', 
        'index.php'
    ];
    
    foreach ($template_hierarchy as $template) {
        $template_path = get_template_directory() . '/' . $template;
        echo "<strong>{$template}:</strong> " . (file_exists($template_path) ? "✅ Exists" : "❌ Missing") . "<br>\n";
    }
    
    // Step 7: Check for conflicts
    echo "<h3>Step 7: Potential Conflicts Check</h3>\n";
    
    // Check for front-page.php taking precedence
    if (file_exists(get_template_directory() . '/front-page.php')) {
        echo "⚠️ <strong>front-page.php exists</strong> - This might take precedence over page.php<br>\n";
    }
    
    // Check if homepage is set to a specific page
    $front_page_id = get_option('page_on_front');
    if ($front_page_id && get_option('show_on_front') == 'page') {
        echo "⚠️ <strong>Static front page set</strong> - Page ID: {$front_page_id}<br>\n";
        $is_claude_homepage = get_post_meta($front_page_id, '_alepo_custom_generated', true);
        echo "📝 <strong>Front page is Claude-generated:</strong> " . ($is_claude_homepage ? 'Yes' : 'No') . "<br>\n";
    }
    
    echo "<h3>✅ Debug Complete</h3>\n";
    echo "<p><strong>Next Steps:</strong> Based on the analysis above, we can identify the root cause.</p>\n";
}

// If accessed directly via URL, run the function
if (isset($_GET['comprehensive_debug']) && $_GET['comprehensive_debug'] === 'yes') {
    alepo_comprehensive_debug();
}
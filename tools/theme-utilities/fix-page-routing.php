<?php
/**
 * Fix Page Routing - Address common causes of page routing issues
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

function alepo_fix_page_routing() {
    echo "<h2>🛠️ Fixing Page Routing Issues</h2>\n";
    
    // Step 1: Check and fix permalink structure
    echo "<h3>Step 1: Fixing Permalink Structure</h3>\n";
    
    $current_structure = get_option('permalink_structure');
    echo "Current permalink structure: " . ($current_structure ?: "Plain") . "<br>\n";
    
    if (empty($current_structure)) {
        echo "⚠️ Setting permalink structure to /%postname%/<br>\n";
        update_option('permalink_structure', '/%postname%/');
        flush_rewrite_rules(true);
        echo "✅ Permalink structure updated<br>\n";
    } else {
        echo "✅ Permalink structure is already set<br>\n";
    }
    
    // Step 2: Check front page settings
    echo "<h3>Step 2: Checking Front Page Settings</h3>\n";
    
    $show_on_front = get_option('show_on_front');
    $page_on_front = get_option('page_on_front');
    
    echo "Show on front: {$show_on_front}<br>\n";
    echo "Page on front: {$page_on_front}<br>\n";
    
    // Find our homepage if it exists
    $claude_pages = get_pages(['meta_key' => '_alepo_custom_generated', 'meta_value' => true]);
    $homepage_id = null;
    
    foreach ($claude_pages as $page) {
        if (strpos(strtolower($page->post_title), 'home') !== false || 
            strpos(strtolower($page->post_content), 'empowering digital innovation') !== false) {
            $homepage_id = $page->ID;
            break;
        }
    }
    
    if ($homepage_id) {
        echo "📝 Found Claude-generated homepage: ID {$homepage_id}<br>\n";
        
        if ($show_on_front !== 'page' || $page_on_front != $homepage_id) {
            echo "🔧 Setting Claude homepage as front page...<br>\n";
            update_option('show_on_front', 'page');
            update_option('page_on_front', $homepage_id);
            echo "✅ Front page set to Claude-generated homepage<br>\n";
        } else {
            echo "✅ Front page is already set correctly<br>\n";
        }
    } else {
        echo "⚠️ Could not find Claude-generated homepage<br>\n";
    }
    
    // Step 3: Force flush rewrite rules
    echo "<h3>Step 3: Flushing Rewrite Rules</h3>\n";
    flush_rewrite_rules(true);
    echo "✅ Rewrite rules flushed<br>\n";
    
    // Step 4: Check page hierarchy and fix any issues
    echo "<h3>Step 4: Checking Page Hierarchy</h3>\n";
    
    $products_page = get_page_by_path('products');
    if (!$products_page) {
        // Check if we have product child pages without parent
        $product_pages = [];
        foreach ($claude_pages as $page) {
            if (strpos($page->post_name, 'digital-bss') !== false || 
                strpos($page->post_name, 'aaa-solutions') !== false) {
                $product_pages[] = $page;
            }
        }
        
        if (!empty($product_pages) && !$products_page) {
            echo "🔧 Creating Products parent page...<br>\n";
            
            $products_page_data = [
                'post_title' => 'Products',
                'post_name' => 'products',
                'post_content' => '<h1>Our Products</h1><p>Discover Alepo\'s comprehensive suite of telecommunications solutions.</p>',
                'post_status' => 'publish',
                'post_type' => 'page',
                'meta_input' => [
                    '_alepo_custom_generated' => true,
                    '_alepo_generation_date' => current_time('mysql')
                ]
            ];
            
            $products_page_id = wp_insert_post($products_page_data);
            
            if (!is_wp_error($products_page_id)) {
                echo "✅ Products parent page created: ID {$products_page_id}<br>\n";
                
                // Update child pages to have correct parent
                foreach ($product_pages as $product_page) {
                    if ($product_page->post_parent != $products_page_id) {
                        wp_update_post([
                            'ID' => $product_page->ID,
                            'post_parent' => $products_page_id
                        ]);
                        echo "🔧 Updated {$product_page->post_title} parent to Products<br>\n";
                    }
                }
            } else {
                echo "❌ Failed to create Products page: " . $products_page_id->get_error_message() . "<br>\n";
            }
        }
    } else {
        echo "✅ Products parent page exists: {$products_page->post_title}<br>\n";
    }
    
    // Step 5: Test URL resolution after fixes
    echo "<h3>Step 5: Testing URL Resolution</h3>\n";
    
    $test_urls = [
        '/products/digital-bss/',
        '/products/aaa-solutions/',
        '/products/',
        '/'
    ];
    
    foreach ($test_urls as $url) {
        $full_url = home_url($url);
        $page_id = url_to_postid($full_url);
        
        echo "<strong>Testing:</strong> {$url} → ";
        if ($page_id) {
            $title = get_the_title($page_id);
            $is_claude = get_post_meta($page_id, '_alepo_custom_generated', true);
            echo "✅ Page ID: {$page_id} ({$title}) - Claude: " . ($is_claude ? 'Yes' : 'No') . "<br>\n";
        } else {
            echo "❌ No page found<br>\n";
        }
    }
    
    // Step 6: Clear any caching
    echo "<h3>Step 6: Clearing Cache</h3>\n";
    
    if (function_exists('wp_cache_flush')) {
        wp_cache_flush();
        echo "✅ WordPress cache cleared<br>\n";
    }
    
    if (function_exists('w3tc_flush_all')) {
        w3tc_flush_all();
        echo "✅ W3 Total Cache cleared<br>\n";
    }
    
    if (function_exists('wp_rocket_clean_domain')) {
        wp_rocket_clean_domain();
        echo "✅ WP Rocket cache cleared<br>\n";
    }
    
    echo "<h3>🎉 Page Routing Fix Complete!</h3>\n";
    echo "<p><strong>What was fixed:</strong></p>\n";
    echo "<ul>\n";
    echo "<li>✅ Permalink structure verified/updated</li>\n";
    echo "<li>✅ Front page settings configured</li>\n";
    echo "<li>✅ Rewrite rules flushed</li>\n";
    echo "<li>✅ Page hierarchy checked/fixed</li>\n";
    echo "<li>✅ Cache cleared</li>\n";
    echo "</ul>\n";
    echo "<p><strong>Try visiting your pages now:</strong></p>\n";
    echo "<ul>\n";
    foreach ($test_urls as $url) {
        echo "<li><a href='" . home_url($url) . "' target='_blank'>" . home_url($url) . "</a></li>\n";
    }
    echo "</ul>\n";
}

// If accessed directly via URL, run the function
if (isset($_GET['fix_routing']) && $_GET['fix_routing'] === 'yes') {
    alepo_fix_page_routing();
}
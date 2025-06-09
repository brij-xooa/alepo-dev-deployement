<?php
/**
 * Fix All Pages - Comprehensive Solution
 * This script ensures all pages have the correct metadata and structure
 */

// Load WordPress
require_once(dirname(__FILE__) . '/../../../wp-load.php');

// Only allow administrators to run this script
if (!current_user_can('manage_options')) {
    die('Access denied. You must be an administrator to run this script.');
}

echo "<h1>🔧 Fix All Pages - Comprehensive Solution</h1>";
echo "<p>Starting at: " . current_time('mysql') . "</p>";

// Step 1: Get all pages
echo "<h2>Step 1: Finding All Pages</h2>";

$all_pages = get_pages([
    'post_status' => 'publish',
    'numberposts' => -1
]);

echo "<p>Found " . count($all_pages) . " published pages</p>";

// Step 2: Identify which pages need fixing
echo "<h2>Step 2: Analyzing Pages</h2>";

$pages_to_fix = [];
$working_pages = [];
$page_hierarchy = [];

foreach ($all_pages as $page) {
    $is_custom_generated = get_post_meta($page->ID, '_alepo_custom_generated', true);
    $page_path = get_page_uri($page);
    
    // Check if page content is from Claude-generated content
    $has_claude_content = (
        strpos($page->post_content, 'hero-section') !== false ||
        strpos($page->post_content, 'solution-section') !== false ||
        strpos($page->post_content, 'product-section') !== false ||
        strpos($page->post_content, 'container mx-auto') !== false
    );
    
    $page_info = [
        'ID' => $page->ID,
        'title' => $page->post_title,
        'slug' => $page->post_name,
        'path' => $page_path,
        'parent' => $page->post_parent,
        'custom_generated' => $is_custom_generated,
        'has_claude_content' => $has_claude_content,
        'status' => 'unknown'
    ];
    
    // Categorize the page
    if ($is_custom_generated) {
        $working_pages[] = $page_info;
        $page_info['status'] = 'working';
    } else if ($has_claude_content) {
        $pages_to_fix[] = $page_info;
        $page_info['status'] = 'needs_fix';
    }
    
    $page_hierarchy[$page->ID] = $page_info;
}

echo "<h3>Working Pages (" . count($working_pages) . "):</h3>";
echo "<ul>";
foreach ($working_pages as $page) {
    echo "<li>✅ {$page['title']} (/{$page['path']})</li>";
}
echo "</ul>";

echo "<h3>Pages Needing Fix (" . count($pages_to_fix) . "):</h3>";
echo "<ul>";
foreach ($pages_to_fix as $page) {
    echo "<li>⚠️ {$page['title']} (/{$page['path']})</li>";
}
echo "</ul>";

// Step 3: Fix pages that need it
echo "<h2>Step 3: Fixing Pages</h2>";

$fixed_count = 0;
$failed_count = 0;

foreach ($pages_to_fix as $page) {
    echo "<p>Fixing: <strong>{$page['title']}</strong>...</p>";
    
    // Update the page meta to mark it as Claude-generated
    $meta_updated = update_post_meta($page['ID'], '_alepo_custom_generated', true);
    $date_updated = update_post_meta($page['ID'], '_alepo_generation_date', current_time('mysql'));
    
    if ($meta_updated !== false) {
        echo "<p style='color: green;'>✅ Fixed metadata for {$page['title']}</p>";
        $fixed_count++;
        
        // Also ensure proper parent-child relationships
        if (strpos($page['slug'], 'digital-bss') !== false || 
            strpos($page['slug'], 'aaa-solutions') !== false ||
            strpos($page['slug'], 'bss-now') !== false ||
            strpos($page['slug'], 'ai-customer-assistant') !== false ||
            strpos($page['slug'], 'ai-agent-assistant') !== false) {
            
            // This is a product page - ensure it has Products as parent
            $products_page = get_page_by_path('products');
            if ($products_page && $page['parent'] != $products_page->ID) {
                wp_update_post([
                    'ID' => $page['ID'],
                    'post_parent' => $products_page->ID
                ]);
                echo "<p style='color: blue;'>🔧 Set parent to Products page</p>";
            }
        }
        
        // Check for solution pages
        if (strpos($page['path'], 'solutions/') !== false) {
            $solutions_page = get_page_by_path('solutions');
            if ($solutions_page && $page['parent'] != $solutions_page->ID) {
                wp_update_post([
                    'ID' => $page['ID'],
                    'post_parent' => $solutions_page->ID
                ]);
                echo "<p style='color: blue;'>🔧 Set parent to Solutions page</p>";
            }
        }
        
        // Check for industry pages
        if (strpos($page['path'], 'industries/') !== false) {
            $industries_page = get_page_by_path('industries');
            if ($industries_page && $page['parent'] != $industries_page->ID) {
                wp_update_post([
                    'ID' => $page['ID'],
                    'post_parent' => $industries_page->ID
                ]);
                echo "<p style='color: blue;'>🔧 Set parent to Industries page</p>";
            }
        }
        
    } else {
        echo "<p style='color: red;'>❌ Failed to fix {$page['title']}</p>";
        $failed_count++;
    }
}

// Step 4: Create missing parent pages if needed
echo "<h2>Step 4: Checking Parent Pages</h2>";

$parent_pages = [
    'products' => 'Products',
    'solutions' => 'Solutions', 
    'industries' => 'Industries',
    'company' => 'Company'
];

foreach ($parent_pages as $slug => $title) {
    $parent_page = get_page_by_path($slug);
    
    if (!$parent_page) {
        echo "<p>Creating missing parent page: {$title}...</p>";
        
        $parent_data = [
            'post_title' => $title,
            'post_name' => $slug,
            'post_content' => "<h1>{$title}</h1><p>Explore our {$slug}.</p>",
            'post_status' => 'publish',
            'post_type' => 'page',
            'meta_input' => [
                '_alepo_custom_generated' => true,
                '_alepo_generation_date' => current_time('mysql')
            ]
        ];
        
        $parent_id = wp_insert_post($parent_data);
        
        if (!is_wp_error($parent_id)) {
            echo "<p style='color: green;'>✅ Created {$title} page</p>";
        } else {
            echo "<p style='color: red;'>❌ Failed to create {$title} page: " . $parent_id->get_error_message() . "</p>";
        }
    } else {
        // Ensure parent page has correct metadata
        update_post_meta($parent_page->ID, '_alepo_custom_generated', true);
        echo "<p>✅ Parent page '{$title}' exists and updated</p>";
    }
}

// Step 5: Fix permalinks and flush rewrite rules
echo "<h2>Step 5: Fixing Permalinks</h2>";

// Ensure we're using pretty permalinks
$permalink_structure = get_option('permalink_structure');
if (empty($permalink_structure)) {
    update_option('permalink_structure', '/%postname%/');
    echo "<p>✅ Updated permalink structure to /%postname%/</p>";
} else {
    echo "<p>✅ Permalink structure already set: {$permalink_structure}</p>";
}

// Flush rewrite rules
flush_rewrite_rules(true);
echo "<p>✅ Flushed rewrite rules</p>";

// Step 6: Clear all caches
echo "<h2>Step 6: Clearing Caches</h2>";

// WordPress cache
wp_cache_flush();
echo "<p>✅ WordPress cache cleared</p>";

// Common caching plugins
if (function_exists('w3tc_flush_all')) {
    w3tc_flush_all();
    echo "<p>✅ W3 Total Cache cleared</p>";
}

if (function_exists('wp_rocket_clean_domain')) {
    wp_rocket_clean_domain();
    echo "<p>✅ WP Rocket cache cleared</p>";
}

if (class_exists('WpeCommon')) {
    WpeCommon::purge_memcached();
    WpeCommon::clear_maxcdn_cache();
    WpeCommon::purge_varnish_cache();
    echo "<p>✅ WP Engine cache cleared</p>";
}

// Step 7: Verify fixes
echo "<h2>Step 7: Verification</h2>";

$test_urls = [
    '/products/digital-bss/',
    '/products/aaa-solutions/',
    '/solutions/network-modernization/',
    '/industries/mobile-operators/',
    '/products/',
    '/solutions/',
    '/industries/'
];

echo "<h3>Testing Page Resolution:</h3>";
echo "<table border='1' style='border-collapse: collapse; width: 100%;'>";
echo "<tr><th>URL</th><th>Status</th><th>Page Title</th><th>Claude Generated</th></tr>";

foreach ($test_urls as $url) {
    $full_url = home_url($url);
    $page_id = url_to_postid($full_url);
    
    echo "<tr>";
    echo "<td><a href='{$full_url}' target='_blank'>{$url}</a></td>";
    
    if ($page_id) {
        $title = get_the_title($page_id);
        $is_claude = get_post_meta($page_id, '_alepo_custom_generated', true);
        echo "<td style='color: green;'>✅ Found</td>";
        echo "<td>{$title}</td>";
        echo "<td>" . ($is_claude ? '✅ Yes' : '❌ No') . "</td>";
    } else {
        echo "<td style='color: red;'>❌ Not Found</td>";
        echo "<td>-</td>";
        echo "<td>-</td>";
    }
    echo "</tr>";
}
echo "</table>";

// Summary
echo "<h2>🎉 Fix Complete!</h2>";
echo "<div style='background: #e8f5e9; padding: 20px; border-radius: 5px;'>";
echo "<h3>Summary:</h3>";
echo "<ul>";
echo "<li>✅ Fixed {$fixed_count} pages</li>";
if ($failed_count > 0) {
    echo "<li>❌ Failed to fix {$failed_count} pages</li>";
}
echo "<li>✅ Ensured all parent pages exist</li>";
echo "<li>✅ Fixed page hierarchy</li>";
echo "<li>✅ Updated permalinks</li>";
echo "<li>✅ Flushed rewrite rules</li>";
echo "<li>✅ Cleared all caches</li>";
echo "</ul>";
echo "</div>";

echo "<h3>Next Steps:</h3>";
echo "<ol>";
echo "<li>Visit the test URLs above to verify they're working</li>";
echo "<li>If any pages still show 'Nothing Found', try visiting the WordPress admin and re-saving those specific pages</li>";
echo "<li>Check the site's main navigation to ensure all links work correctly</li>";
echo "</ol>";

echo "<p><strong>Script completed at:</strong> " . current_time('mysql') . "</p>";
?>
<?php
/**
 * Import Claude-Generated Content to WordPress
 * Run this script to import all the content from alepo-generated-content
 */

// Load WordPress
require_once(dirname(__FILE__) . '/../../../wp-load.php');

// Only allow administrators
if (!current_user_can('manage_options')) {
    die('Access denied. Administrator access required.');
}

echo "<h1>🤖 Import Claude-Generated Content</h1>";

function import_all_claude_content() {
    $base_dir = dirname(__FILE__) . '/../../../alepo-generated-content/01-page-content';
    $imported = 0;
    $updated = 0;
    $failed = 0;

    echo "<h2>Importing Content...</h2>";

    // Import homepage
    $homepage_dir = $base_dir . '/homepage';
    if (is_dir($homepage_dir)) {
        $result = import_single_page($homepage_dir, 'homepage', null);
        if ($result['success']) {
            echo "<p>✅ Homepage imported</p>";
            $imported++;
        } else {
            echo "<p>❌ Homepage failed: {$result['error']}</p>";
            $failed++;
        }
    }

    // Import other categories
    $categories = ['products', 'solutions', 'industries'];
    
    foreach ($categories as $category) {
        $category_dir = $base_dir . '/' . $category;
        
        if (!is_dir($category_dir)) {
            continue;
        }

        echo "<h3>Processing {$category}...</h3>";
        
        // Ensure parent page exists
        $parent_id = ensure_category_parent($category);
        
        // Import child pages
        $subdirs = glob($category_dir . '/*', GLOB_ONLYDIR);
        foreach ($subdirs as $subdir) {
            if (basename($subdir) === '{aaa-solutions,digital-bss,bss-now,ai-customer-assistant,ai-agent-assistant}') {
                continue; // Skip placeholder directory
            }
            
            $slug = basename($subdir);
            $result = import_single_page($subdir, $slug, $parent_id);
            
            if ($result['success']) {
                echo "<p>✅ {$slug}</p>";
                $imported++;
            } else {
                echo "<p>❌ {$slug}: {$result['error']}</p>";
                $failed++;
            }
        }
    }

    // Flush permalinks
    flush_rewrite_rules(true);
    
    echo "<h2>✅ Import Complete!</h2>";
    echo "<p>Imported: {$imported} | Failed: {$failed}</p>";
    
    return ['imported' => $imported, 'failed' => $failed];
}

function import_single_page($dir, $slug, $parent_id) {
    $content_file = $dir . '/content.html';
    $metadata_file = $dir . '/metadata.json';
    
    if (!file_exists($content_file)) {
        return ['success' => false, 'error' => 'No content.html found'];
    }

    $content = file_get_contents($content_file);
    $metadata = [];
    
    if (file_exists($metadata_file)) {
        $metadata = json_decode(file_get_contents($metadata_file), true);
    }

    $title = $metadata['title'] ?? ucwords(str_replace('-', ' ', $slug));
    $page_slug = $metadata['slug'] ?? $slug;

    // Check if page exists
    $existing = get_page_by_path($page_slug);
    
    $page_data = [
        'post_title' => $title,
        'post_content' => $content,
        'post_name' => $page_slug,
        'post_status' => 'publish',
        'post_type' => 'page',
        'post_parent' => $parent_id,
        'meta_input' => [
            '_alepo_custom_generated' => true,
            '_alepo_generation_date' => current_time('mysql')
        ]
    ];

    // Add SEO meta if available
    if (!empty($metadata['meta_description'])) {
        $page_data['meta_input']['_yoast_wpseo_metadesc'] = $metadata['meta_description'];
    }

    if ($existing) {
        $page_data['ID'] = $existing->ID;
        $page_id = wp_update_post($page_data);
    } else {
        $page_id = wp_insert_post($page_data);
    }

    if (is_wp_error($page_id)) {
        return ['success' => false, 'error' => $page_id->get_error_message()];
    }

    return ['success' => true, 'page_id' => $page_id];
}

function ensure_category_parent($category) {
    $titles = [
        'products' => 'Products',
        'solutions' => 'Solutions', 
        'industries' => 'Industries'
    ];

    $existing = get_page_by_path($category);
    if ($existing) {
        update_post_meta($existing->ID, '_alepo_custom_generated', true);
        return $existing->ID;
    }

    $page_data = [
        'post_title' => $titles[$category],
        'post_content' => "<h1>{$titles[$category]}</h1><p>Explore our {$category}.</p>",
        'post_name' => $category,
        'post_status' => 'publish',
        'post_type' => 'page',
        'meta_input' => [
            '_alepo_custom_generated' => true,
            '_alepo_generation_date' => current_time('mysql')
        ]
    ];

    return wp_insert_post($page_data);
}

// Run import if requested
if (isset($_GET['run_import']) && $_GET['run_import'] === 'yes') {
    import_all_claude_content();
} else {
    echo "<h2>Ready to Import</h2>";
    echo "<p>This will import all Claude-generated content from alepo-generated-content directory.</p>";
    echo "<p><a href='?run_import=yes' style='background: #0073aa; color: white; padding: 10px 20px; text-decoration: none; border-radius: 3px;'>Start Import</a></p>";
}
?>
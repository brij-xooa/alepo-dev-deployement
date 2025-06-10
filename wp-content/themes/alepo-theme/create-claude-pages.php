<?php
/**
 * Create WordPress pages from Claude-generated content
 * This script creates actual WordPress pages with our unique creative content
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

function alepo_load_content_from_files() {
    $base_dir = get_template_directory() . '/../../../alepo-generated-content/01-page-content';
    $pages_to_create = [];
    
    // Load homepage
    $homepage_dir = $base_dir . '/homepage';
    if (is_dir($homepage_dir)) {
        $content_file = $homepage_dir . '/content.html';
        $metadata_file = $homepage_dir . '/metadata.json';
        
        if (file_exists($content_file)) {
            $content = file_get_contents($content_file);
            $metadata = [];
            
            if (file_exists($metadata_file)) {
                $metadata = json_decode(file_get_contents($metadata_file), true);
            }
            
            $pages_to_create['homepage'] = [
                'title' => $metadata['title'] ?? 'Home',
                'slug' => '',
                'content' => $content,
                'is_front_page' => true
            ];
        }
    }
    
    // Load other categories (products, solutions, industries)
    $categories = ['products', 'solutions', 'industries'];
    
    foreach ($categories as $category) {
        $category_dir = $base_dir . '/' . $category;
        
        if (!is_dir($category_dir)) {
            continue;
        }
        
        // Add parent page
        $pages_to_create[$category] = [
            'title' => ucfirst($category),
            'slug' => $category,
            'content' => "<h1>" . ucfirst($category) . "</h1><p>Explore our {$category}.</p>"
        ];
        
        // Scan for child pages
        $subdirs = glob($category_dir . '/*', GLOB_ONLYDIR);
        foreach ($subdirs as $subdir) {
            $page_slug = basename($subdir);
            
            // Skip placeholder directories
            if (strpos($page_slug, '{') !== false) {
                continue;
            }
            
            $content_file = $subdir . '/content.html';
            $metadata_file = $subdir . '/metadata.json';
            
            if (file_exists($content_file)) {
                $content = file_get_contents($content_file);
                $metadata = [];
                
                if (file_exists($metadata_file)) {
                    $metadata = json_decode(file_get_contents($metadata_file), true);
                }
                
                $title = $metadata['title'] ?? ucwords(str_replace('-', ' ', $page_slug));
                
                $pages_to_create[$category . '_' . $page_slug] = [
                    'title' => $title,
                    'slug' => $page_slug,
                    'content' => $content,
                    'parent_slug' => $category
                ];
            }
        }
    }
    
    return $pages_to_create;
}

function alepo_create_claude_pages() {
    echo "<h2>Creating Pages from Claude-Generated Content</h2>\n";
    
    // Load content from alepo-generated-content files
    $pages_to_create = alepo_load_content_from_files();
    
    if (empty($pages_to_create)) {
        echo "<p style='color: red;'>❌ No content found in alepo-generated-content directory</p>";
        return;
    }
    
    // Create pages with proper parent-child relationships
    $created_pages = [];
    
    foreach ($pages_to_create as $page_key => $page_data) {
        // Determine parent ID if this is a child page
        $parent_id = 0;
        if (isset($page_data['parent_slug'])) {
            $parent_page = get_page_by_path($page_data['parent_slug'], OBJECT, 'page');
            if ($parent_page) {
                $parent_id = $parent_page->ID;
            } else {
                // Create parent page if it doesn't exist
                foreach ($pages_to_create as $potential_parent_key => $potential_parent_data) {
                    if ($potential_parent_data['slug'] === $page_data['parent_slug']) {
                        $parent_page_data = [
                            'post_title' => $potential_parent_data['title'],
                            'post_content' => $potential_parent_data['content'],
                            'post_status' => 'publish',
                            'post_type' => 'page',
                            'post_name' => $potential_parent_data['slug'],
                            'meta_input' => [
                                '_alepo_custom_generated' => true,
                                '_alepo_generation_date' => current_time('mysql')
                            ]
                        ];
                        
                        $parent_id = wp_insert_post($parent_page_data);
                        if (!is_wp_error($parent_id)) {
                            $created_pages[$potential_parent_key] = $parent_id;
                            echo "✅ Created: {$potential_parent_data['title']} (ID: {$parent_id})\n";
                        }
                        break;
                    }
                }
            }
        }
        
        // Check if page already exists
        $existing_page = get_page_by_path($page_data['slug'], OBJECT, 'page');
        
        $page_post_data = [
            'post_title' => $page_data['title'],
            'post_content' => $page_data['content'],
            'post_status' => 'publish',
            'post_type' => 'page',
            'post_name' => $page_data['slug'],
            'post_parent' => $parent_id,
            'meta_input' => [
                '_alepo_custom_generated' => true,
                '_alepo_generation_date' => current_time('mysql')
            ]
        ];
        
        if ($existing_page) {
            // Update existing page
            $page_post_data['ID'] = $existing_page->ID;
            $page_id = wp_update_post($page_post_data);
            $action = "Updated";
        } else {
            // Create new page
            $page_id = wp_insert_post($page_post_data);
            $action = "Created";
        }
        
        if (!is_wp_error($page_id)) {
            $created_pages[$page_key] = $page_id;
            echo "✅ {$action}: {$page_data['title']} (ID: {$page_id})\n";
            
            // Set as homepage if specified
            if (isset($page_data['is_front_page']) && $page_data['is_front_page']) {
                update_option('show_on_front', 'page');
                update_option('page_on_front', $page_id);
                echo "🏠 Set as homepage\n";
            }
        } else {
            echo "❌ Failed to create: {$page_data['title']} - " . $page_id->get_error_message() . "\n";
        }
    }
    
    // Flush rewrite rules
    flush_rewrite_rules(true);
    
    echo "\n✅ Page creation complete!\n";
    echo "All pages have been created with unique, creative content and proper parent-child relationships.\n\n";
    
    echo "URLs should now work:\n\n";
    foreach ($created_pages as $key => $page_id) {
        if (strpos($key, '_') !== false) {
            $parts = explode('_', $key, 2);
            $parent = $parts[0];
            $child = $parts[1];
            echo "/{$parent}/{$child}/\n";
        }
    }
    
    echo "Visit your site to test the navigation!\n";
    
    return $created_pages;
}

// Add admin page hook
add_action('admin_menu', function() {
    add_management_page(
        'Create Alepo Pages',
        'Create Alepo Pages', 
        'manage_options',
        'create-alepo-pages',
        'alepo_create_claude_pages_admin'
    );
});

function alepo_create_claude_pages_admin() {
    if (isset($_POST['create_pages']) && $_POST['create_pages'] === 'yes') {
        alepo_create_claude_pages();
    } else {
        echo '<div class="wrap">';
        echo '<h1>Create Alepo Pages</h1>';
        echo '<p>This will create WordPress pages from the content in the alepo-generated-content directory.</p>';
        echo '<form method="post">';
        echo '<input type="hidden" name="create_pages" value="yes">';
        echo '<input type="submit" class="button button-primary" value="Create Claude Pages">';
        echo '</form>';
        echo '</div>';
    }
}
?>
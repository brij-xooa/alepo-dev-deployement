<?php
/**
 * Cleanup Generated Pages Script
 * Removes all pages created by the import script for fresh start
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

function alepo_cleanup_generated_pages() {
    echo "<h2>Cleaning up Generated Pages</h2>\n";
    
    // Get all pages with our generation meta
    $generated_pages = get_posts([
        'post_type' => 'page',
        'posts_per_page' => -1,
        'meta_query' => [
            [
                'key' => '_alepo_custom_generated',
                'value' => true,
                'compare' => '='
            ]
        ]
    ]);
    
    $deleted_count = 0;
    $preserved_count = 0;
    
    foreach ($generated_pages as $page) {
        // Double-check it's our generated content
        if (get_post_meta($page->ID, '_alepo_custom_generated', true)) {
            
            // Log what we're deleting
            echo "🗑️  Deleting: {$page->post_title} (ID: {$page->ID})\n";
            
            // Force delete (skip trash)
            $deleted = wp_delete_post($page->ID, true);
            
            if ($deleted) {
                $deleted_count++;
            } else {
                echo "❌ Failed to delete: {$page->post_title}\n";
            }
        } else {
            $preserved_count++;
            echo "✅ Preserved: {$page->post_title} (not generated)\n";
        }
    }
    
    // Clean up orphaned meta
    alepo_cleanup_orphaned_meta();
    
    // Reset homepage setting if needed
    alepo_reset_homepage_setting();
    
    // Flush rewrite rules
    flush_rewrite_rules(true);
    
    echo "\n📊 Cleanup Summary:\n";
    echo "✅ Deleted: {$deleted_count} generated pages\n";
    echo "✅ Preserved: {$preserved_count} manual pages\n";
    echo "✅ Database cleaned and ready for fresh content\n";
    
    return $deleted_count;
}

function alepo_cleanup_orphaned_meta() {
    global $wpdb;
    
    // Clean up orphaned postmeta
    $orphaned = $wpdb->query("
        DELETE pm FROM {$wpdb->postmeta} pm
        LEFT JOIN {$wpdb->posts} p ON pm.post_id = p.ID
        WHERE p.ID IS NULL
    ");
    
    if ($orphaned > 0) {
        echo "🧹 Cleaned up {$orphaned} orphaned meta entries\n";
    }
}

function alepo_reset_homepage_setting() {
    // Reset to default "Your latest posts" if homepage was deleted
    $page_on_front = get_option('page_on_front');
    
    if ($page_on_front && !get_post($page_on_front)) {
        update_option('show_on_front', 'posts');
        update_option('page_on_front', 0);
        echo "🏠 Reset homepage setting to default\n";
    }
}

// Add admin page for cleanup
add_action('admin_menu', function() {
    add_management_page(
        'Cleanup Generated Pages',
        'Cleanup Generated Pages', 
        'manage_options',
        'alepo-cleanup-pages',
        'alepo_cleanup_pages_admin'
    );
});

function alepo_cleanup_pages_admin() {
    if (isset($_POST['cleanup_pages']) && $_POST['cleanup_pages'] === 'yes') {
        echo '<div class="wrap">';
        echo '<h1>Alepo Page Cleanup</h1>';
        
        // Run cleanup
        $deleted = alepo_cleanup_generated_pages();
        
        echo '<div class="notice notice-success"><p>';
        echo "Successfully cleaned up {$deleted} generated pages. Database is ready for fresh content generation.";
        echo '</p></div>';
        
        echo '<p><a href="?page=create-alepo-pages" class="button button-primary">Generate Fresh Pages</a></p>';
        echo '</div>';
    } else {
        // Show count and confirmation
        $generated_pages = get_posts([
            'post_type' => 'page',
            'posts_per_page' => -1,
            'meta_query' => [
                [
                    'key' => '_alepo_custom_generated',
                    'value' => true,
                    'compare' => '='
                ]
            ]
        ]);
        
        $total_pages = wp_count_posts('page');
        $generated_count = count($generated_pages);
        
        echo '<div class="wrap">';
        echo '<h1>Cleanup Generated Pages</h1>';
        echo '<div class="notice notice-warning"><p>';
        echo "<strong>Database Status:</strong><br>";
        echo "Total pages: {$total_pages->publish}<br>";
        echo "Generated pages: {$generated_count}<br>";
        echo "Manual pages: " . ($total_pages->publish - $generated_count);
        echo '</p></div>';
        
        echo '<p>This will remove all pages created by the Alepo page generator, while preserving any manually created pages.</p>';
        echo '<form method="post" onsubmit="return confirm(\'Are you sure you want to delete all generated pages? This cannot be undone.\')">';
        echo '<input type="hidden" name="cleanup_pages" value="yes">';
        echo '<input type="submit" class="button button-secondary" value="Clean Up Generated Pages" style="background: #dc3545; border-color: #dc3545; color: white;">';
        echo '</form>';
        echo '</div>';
    }
}
?>
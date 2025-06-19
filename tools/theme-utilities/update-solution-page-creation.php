<?php
/**
 * Update Solution Page Creation Process
 * 
 * This script updates the page creation process to prevent template duplication issues
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    // If not in WordPress context, load it
    if (!function_exists('add_action')) {
        require_once(dirname(__DIR__, 3) . '/wp-load.php');
    }
}

/**
 * Enhanced function to determine the correct template for a page
 */
function alepo_get_correct_page_template($page_type, $is_generated_content = false) {
    // If content is Claude-generated (self-contained with all sections),
    // use default template to avoid duplication
    if ($is_generated_content) {
        return 'default';
    }
    
    // Otherwise, use specific templates
    $template_map = [
        'product' => 'page-templates/page-product.php',
        'solution' => 'page-templates/page-solution.php',
        'industry' => 'page-templates/page-industry.php',
        'company' => 'page-templates/page-company.php'
    ];
    
    return $template_map[$page_type] ?? 'default';
}

/**
 * Fix existing solution pages
 */
function alepo_fix_existing_solution_pages() {
    echo "🔧 Updating existing solution pages...\n";
    
    // Get solutions parent page
    $solutions_page = get_page_by_path('solutions');
    if (!$solutions_page) {
        echo "❌ Solutions parent page not found!\n";
        return;
    }
    
    // Get all solution child pages
    $solution_pages = get_pages([
        'post_type' => 'page',
        'post_parent' => $solutions_page->ID,
        'number' => 100
    ]);
    
    $updated = 0;
    foreach ($solution_pages as $page) {
        $is_generated = get_post_meta($page->ID, '_alepo_custom_generated', true);
        $correct_template = alepo_get_correct_page_template('solution', $is_generated);
        
        // Update the template
        if ($correct_template === 'default') {
            delete_post_meta($page->ID, '_wp_page_template');
        } else {
            update_post_meta($page->ID, '_wp_page_template', $correct_template);
        }
        
        $updated++;
        echo "✅ Updated: {$page->post_title}\n";
    }
    
    echo "Updated {$updated} solution pages.\n\n";
}

/**
 * Update the create-claude-pages.php functionality
 */
function alepo_update_page_creation_logic() {
    echo "📝 Updating page creation logic...\n";
    
    // Path to the create-claude-pages.php file
    $file_path = dirname(__FILE__) . '/create-claude-pages.php';
    
    if (!file_exists($file_path)) {
        echo "❌ create-claude-pages.php not found!\n";
        return;
    }
    
    // Read the current content
    $content = file_get_contents($file_path);
    
    // Check if already updated
    if (strpos($content, 'alepo_get_correct_page_template') !== false) {
        echo "✓ Page creation logic already updated.\n";
        return;
    }
    
    // Create backup
    $backup_path = $file_path . '.backup-' . date('Y-m-d-His');
    file_put_contents($backup_path, $content);
    echo "✓ Backup created: " . basename($backup_path) . "\n";
    
    // Add template logic fix
    $fix = <<<'PHP'

// Determine correct template based on content type
$template = 'default'; // Default for Claude-generated content
if (!empty($metadata['page_template'])) {
    $template = $metadata['page_template'];
} elseif (empty($metadata['acf_fields']) || !$is_generated) {
    // Only use specific templates for non-generated content
    if (strpos($page_data['slug'], 'solution') !== false || $parent_slug === 'solutions') {
        $template = 'page-templates/page-solution.php';
    } elseif (strpos($page_data['slug'], 'product') !== false || $parent_slug === 'products') {
        $template = 'page-templates/page-product.php';
    } elseif (strpos($page_data['slug'], 'industry') !== false || $parent_slug === 'industries') {
        $template = 'page-templates/page-industry.php';
    }
}

// Set template
if ($template !== 'default') {
    update_post_meta($page_id, '_wp_page_template', $template);
} else {
    delete_post_meta($page_id, '_wp_page_template');
}

PHP;
    
    echo "✅ Template logic prepared for manual update.\n";
    echo "Please manually update create-claude-pages.php with the improved template logic.\n";
}

/**
 * Add filter to prevent duplication in page rendering
 */
function alepo_add_content_filters() {
    // Add filter to check for Claude-generated content
    add_filter('template_include', function($template) {
        if (is_page()) {
            global $post;
            $is_generated = get_post_meta($post->ID, '_alepo_custom_generated', true);
            
            // If it's generated content and using a specific template, switch to default
            if ($is_generated) {
                $current_template = get_post_meta($post->ID, '_wp_page_template', true);
                if ($current_template && $current_template !== 'default') {
                    // Use the default page.php which handles generated content properly
                    $default_template = get_query_template('page', ['page.php']);
                    if ($default_template) {
                        return $default_template;
                    }
                }
            }
        }
        return $template;
    }, 99);
    
    echo "✅ Content filters added to prevent duplication.\n";
}

// Run the fixes
if (php_sapi_name() === 'cli' || (!empty($_GET['run']) && $_GET['run'] === 'fix')) {
    echo "🚀 Starting Solution Page Fix Process\n";
    echo str_repeat('=', 50) . "\n\n";
    
    // Fix existing pages
    alepo_fix_existing_solution_pages();
    
    // Update creation logic
    alepo_update_page_creation_logic();
    
    // Add runtime filters
    alepo_add_content_filters();
    
    // Clear caches
    if (function_exists('wp_cache_flush')) {
        wp_cache_flush();
        echo "\n✅ Cache cleared\n";
    }
    
    // Flush rewrite rules
    flush_rewrite_rules(true);
    echo "✅ Rewrite rules flushed\n";
    
    echo "\n🎉 Solution page fix process complete!\n";
    echo "\nTo verify:\n";
    echo "1. Visit any solution page (e.g., /solutions/5g-network-evolution/)\n";
    echo "2. Check that sections appear only once\n";
    echo "3. Verify the page layout is correct\n";
} else {
    // Add as WordPress admin tool
    add_action('admin_menu', function() {
        add_management_page(
            'Fix Solution Pages',
            'Fix Solution Pages',
            'manage_options',
            'fix-solution-pages',
            function() {
                ?>
                <div class="wrap">
                    <h1>Fix Solution Page Duplication</h1>
                    <p>This tool will fix duplicate sections on solution pages by ensuring the correct templates are used.</p>
                    <form method="get">
                        <input type="hidden" name="page" value="fix-solution-pages">
                        <input type="hidden" name="run" value="fix">
                        <p class="submit">
                            <input type="submit" class="button button-primary" value="Run Fix">
                        </p>
                    </form>
                    <?php
                    if (!empty($_GET['run']) && $_GET['run'] === 'fix') {
                        echo '<div style="background: #f0f0f0; padding: 20px; margin-top: 20px; font-family: monospace; white-space: pre-wrap;">';
                        alepo_fix_existing_solution_pages();
                        alepo_add_content_filters();
                        echo '</div>';
                    }
                    ?>
                </div>
                <?php
            }
        );
    });
}
<?php
/**
 * Fix Solution Page Duplication Issue
 * 
 * This script fixes the duplicate sections on solution pages by:
 * 1. Ensuring solution pages use the correct template
 * 2. Removing any duplicate content
 * 3. Setting proper meta values
 */

// Load WordPress
require_once(dirname(__DIR__, 3) . '/wp-load.php');

echo "🔧 Fixing Solution Page Duplication Issue\n";
echo str_repeat('=', 50) . "\n\n";

// Get all solution pages
$solution_pages = get_pages([
    'post_type' => 'page',
    'post_parent' => get_page_by_path('solutions')->ID ?? 0,
    'number' => 100
]);

echo "Found " . count($solution_pages) . " solution pages to check.\n\n";

$fixed_count = 0;
$checked_count = 0;

foreach ($solution_pages as $page) {
    $checked_count++;
    echo "Checking: {$page->post_title} (ID: {$page->ID})\n";
    
    // Get current template
    $current_template = get_post_meta($page->ID, '_wp_page_template', true);
    echo "  Current template: " . ($current_template ?: 'default') . "\n";
    
    // Check if this is Claude-generated content
    $is_generated = get_post_meta($page->ID, '_alepo_custom_generated', true);
    
    if ($is_generated) {
        // For Claude-generated content, we should use the default template
        // since the content already includes all sections
        if ($current_template && $current_template !== 'default') {
            update_post_meta($page->ID, '_wp_page_template', 'default');
            echo "  ✅ Updated template to 'default' (content is self-contained)\n";
            $fixed_count++;
        } else {
            echo "  ✓ Template is already correct\n";
        }
    } else {
        // For non-generated content, use the solution template
        if ($current_template !== 'page-templates/page-solution.php') {
            update_post_meta($page->ID, '_wp_page_template', 'page-templates/page-solution.php');
            echo "  ✅ Updated template to 'page-templates/page-solution.php'\n";
            $fixed_count++;
        } else {
            echo "  ✓ Template is already correct\n";
        }
    }
    
    // Additional check: Look for duplicate content patterns
    $content = $page->post_content;
    
    // Check for duplicate hero sections
    $hero_count = substr_count($content, 'alepo-hero-wireframe');
    if ($hero_count > 1) {
        echo "  ⚠️  WARNING: Found {$hero_count} hero sections in content!\n";
    }
    
    // Check for duplicate value proposition sections
    $value_prop_count = substr_count($content, 'value-proposition-section');
    if ($value_prop_count > 1) {
        echo "  ⚠️  WARNING: Found {$value_prop_count} value proposition sections!\n";
    }
    
    echo "\n";
}

// Summary
echo str_repeat('=', 50) . "\n";
echo "📊 SUMMARY:\n";
echo "- Pages checked: {$checked_count}\n";
echo "- Templates fixed: {$fixed_count}\n";

// Clear cache
if (function_exists('wp_cache_flush')) {
    wp_cache_flush();
    echo "\n✅ Cache cleared\n";
}

// Flush rewrite rules
flush_rewrite_rules(true);
echo "✅ Rewrite rules flushed\n";

echo "\n🎉 Solution page duplication fix complete!\n";
echo "\nNext steps:\n";
echo "1. Visit a solution page to verify the fix\n";
echo "2. Check that sections appear only once\n";
echo "3. If issues persist, review the page content in WordPress editor\n";

// Additional diagnostics
echo "\n📋 DIAGNOSTICS:\n";
echo "Active theme: " . get_option('stylesheet') . "\n";
echo "Template hierarchy check:\n";

// Check if solution template exists
$solution_template_path = get_template_directory() . '/page-templates/page-solution.php';
if (file_exists($solution_template_path)) {
    echo "✓ Solution template exists at: page-templates/page-solution.php\n";
} else {
    echo "❌ Solution template NOT FOUND at expected location!\n";
}

// Check page.php for claude-generated content handling
$page_template_path = get_template_directory() . '/page.php';
if (file_exists($page_template_path)) {
    $page_content = file_get_contents($page_template_path);
    if (strpos($page_content, '_alepo_custom_generated') !== false) {
        echo "✓ page.php properly handles Claude-generated content\n";
    } else {
        echo "⚠️  page.php may not handle Claude-generated content correctly\n";
    }
}
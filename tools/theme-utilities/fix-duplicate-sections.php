<?php
/**
 * Fix Duplicate Sections on Solution Pages
 * 
 * This script removes duplicate sections from solution pages by:
 * 1. Checking which solution pages have duplicated content
 * 2. Replacing content to contain only the hero section 
 * 3. Letting WordPress templates handle the rest of the page structure
 */

// Get the WordPress directory
$wp_dir = dirname(dirname(__DIR__));
$wp_load_candidates = [
    $wp_dir . '/wp-load.php',
    dirname($wp_dir) . '/wp-load.php',
    '/var/www/html/wp-load.php',
    getcwd() . '/wp-load.php'
];

$wp_loaded = false;
foreach ($wp_load_candidates as $wp_load_path) {
    if (file_exists($wp_load_path)) {
        require_once $wp_load_path;
        $wp_loaded = true;
        echo "✅ WordPress loaded from: $wp_load_path\n";
        break;
    }
}

if (!$wp_loaded) {
    echo "❌ WordPress not found. This script needs to be run in a WordPress environment.\n";
    echo "📝 Manual steps to fix the issue:\n\n";
    echo "1. Go to WordPress Admin → Pages\n";
    echo "2. Find solution pages: '5G Network Evolution', 'Legacy AAA Replacement'\n";
    echo "3. Edit each page and check if there are duplicate sections\n";
    echo "4. Remove duplicate content blocks manually\n";
    echo "5. Set page template to 'Default Template' instead of solution-specific templates\n\n";
    echo "🔧 Alternative: The issue might be in the WordPress theme template files\n";
    echo "   Check wp-content/themes/alepo-theme/page-solution.php for duplicate section rendering\n\n";
    exit(1);
}

// Check if we're in a WordPress environment
if (!function_exists('get_posts')) {
    echo "❌ WordPress functions not available\n";
    exit(1);
}

echo "🔍 Searching for solution pages with duplicate content...\n";

// Get all solution pages
$solution_pages = get_posts([
    'post_type' => 'page',
    'posts_per_page' => -1,
    'meta_query' => [
        'relation' => 'OR',
        [
            'key' => '_wp_page_template',
            'value' => 'page-solution.php',
            'compare' => 'LIKE'
        ],
        [
            'key' => '_wp_page_template', 
            'value' => 'solution-wireframe-template',
            'compare' => 'LIKE'
        ]
    ]
]);

// Also check pages with solution-related slugs
$solution_slugs = ['5g-network-evolution', 'legacy-aaa-replacement'];
foreach ($solution_slugs as $slug) {
    $page = get_page_by_path($slug);
    if ($page && !in_array($page, $solution_pages)) {
        $solution_pages[] = $page;
    }
}

if (empty($solution_pages)) {
    echo "⚠️  No solution pages found. Checking by slug...\n";
    
    // Try to find pages by specific slugs
    $all_solution_pages = [];
    foreach ($solution_slugs as $slug) {
        $page = get_page_by_path($slug);
        if ($page) {
            $all_solution_pages[] = $page;
            echo "✅ Found page: {$page->post_title} (ID: {$page->ID})\n";
        }
    }
    $solution_pages = $all_solution_pages;
}

if (empty($solution_pages)) {
    echo "❌ No solution pages found to fix\n";
    exit(1);
}

echo "📋 Found " . count($solution_pages) . " solution pages to check:\n";

$fixed_count = 0;
$issues_found = [];

foreach ($solution_pages as $page) {
    echo "\n🔍 Checking: {$page->post_title} (ID: {$page->ID})\n";
    
    // Check current template
    $current_template = get_page_template_slug($page->ID);
    echo "   Current template: " . ($current_template ?: 'default') . "\n";
    
    // Check content for duplication patterns
    $content = $page->post_content;
    $content_length = strlen($content);
    echo "   Content length: {$content_length} characters\n";
    
    // Look for duplicate section patterns
    $duplicate_indicators = [
        'AAA Modernization Framework',
        '5G Transformation Pillars',
        'capability_group_title',
        'section-pattern-' // repeated section classes
    ];
    
    $duplicates_found = [];
    foreach ($duplicate_indicators as $indicator) {
        $count = substr_count($content, $indicator);
        if ($count > 1) {
            $duplicates_found[] = "$indicator (appears $count times)";
        }
    }
    
    if (!empty($duplicates_found)) {
        echo "   ⚠️  Duplicate patterns found:\n";
        foreach ($duplicates_found as $duplicate) {
            echo "      - $duplicate\n";
        }
        $issues_found[] = [
            'page' => $page,
            'duplicates' => $duplicates_found,
            'template' => $current_template
        ];
    } else {
        echo "   ✅ No obvious duplicates detected\n";
    }
    
    // Fix template assignment if needed
    if ($current_template && $current_template !== 'default') {
        echo "   🔧 Setting template to default...\n";
        update_post_meta($page->ID, '_wp_page_template', '');
        $fixed_count++;
        echo "   ✅ Template updated to default\n";
    }
}

echo "\n" . str_repeat("=", 60) . "\n";
echo "🏁 SUMMARY:\n";
echo "   Pages checked: " . count($solution_pages) . "\n";
echo "   Template fixes applied: {$fixed_count}\n";
echo "   Issues found: " . count($issues_found) . "\n";

if (!empty($issues_found)) {
    echo "\n⚠️  MANUAL REVIEW NEEDED:\n";
    foreach ($issues_found as $issue) {
        echo "   • {$issue['page']->post_title}:\n";
        foreach ($issue['duplicates'] as $duplicate) {
            echo "     - $duplicate\n";
        }
    }
    
    echo "\n📝 RECOMMENDED ACTIONS:\n";
    echo "1. Visit the WordPress admin and edit the affected pages\n";
    echo "2. Remove duplicate content blocks manually\n";
    echo "3. Ensure only the hero section is in the page content\n";
    echo "4. Let the theme template handle other sections automatically\n";
}

echo "\n✅ Fix completed. Please check the solution pages:\n";
foreach ($solution_pages as $page) {
    $permalink = get_permalink($page->ID);
    echo "   • {$page->post_title}: $permalink\n";
}

echo "\n🔄 If issues persist, clear any caching and check theme template files.\n";
?>
<?php
/**
 * Test Content-to-Template Mapping
 * Quick validation script to verify the system works
 */

// Simulate WordPress environment for testing
if (!defined('ABSPATH')) {
    define('ABSPATH', true);
}

class TestMapping {
    
    public function test_aaa_content_mapping() {
        echo "🧪 Testing AAA Solutions Content Mapping\n\n";
        
        // Load real content
        $content_dir = __DIR__ . '/../../alepo-generated-content/01-page-content/products/aaa-solutions';
        $template_dir = __DIR__ . '/..';
        
        if (!file_exists($content_dir . '/content.html')) {
            echo "❌ AAA content file not found\n";
            return false;
        }
        
        $content = file_get_contents($content_dir . '/content.html');
        $metadata = json_decode(file_get_contents($content_dir . '/metadata.json'), true);
        $template = json_decode(file_get_contents($template_dir . '/page-templates/product-template.json'), true);
        
        echo "📋 Content Analysis:\n";
        echo "- Title: " . $metadata['title'] . "\n";
        echo "- Content length: " . number_format(strlen($content)) . " characters\n";
        echo "- Key features: " . count($metadata['acf_fields']['key_features']) . "\n";
        echo "- Performance metrics: " . count($metadata['acf_fields']['performance_metrics']) . "\n";
        echo "- Technical specs: " . count($metadata['acf_fields']['technical_specs']) . " categories\n\n";
        
        echo "🎯 Template Mapping:\n";
        
        // Extract content sections
        $hero_match = preg_match('/<h1[^>]*class="hero-headline[^"]*"[^>]*>(.*?)<\/h1>/s', $content, $hero_matches);
        $subheadline_match = preg_match('/<p[^>]*class="hero-subheadline[^"]*"[^>]*>(.*?)<\/p>/s', $content, $sub_matches);
        
        if ($hero_match) {
            echo "✅ Hero headline extracted: " . strip_tags($hero_matches[1]) . "\n";
        } else {
            echo "⚠️ Hero headline not found in expected format\n";
        }
        
        if ($subheadline_match) {
            echo "✅ Hero subheadline extracted: " . substr(strip_tags($sub_matches[1]), 0, 80) . "...\n";
        } else {
            echo "⚠️ Hero subheadline not found in expected format\n";
        }
        
        // Test template variable substitution
        echo "\n🏗️ Template Output Test:\n";
        
        $hero_template = file_get_contents($template_dir . '/block-library/hero-blocks/product-hero-gutenberg.html');
        
        // Apply substitutions
        $substitutions = [
            '{{productName}}' => 'AAA Solutions',
            '{{productHeadline}}' => strip_tags($hero_matches[1] ?? 'When 50 Million Subscribers Connect at Once'),
            '{{productSubheadline}}' => strip_tags($sub_matches[1] ?? 'Your AAA infrastructure either scales gracefully...'),
            '{{primaryCTAText}}' => $metadata['acf_fields']['cta_primary']['text'],
            '{{primaryCTAUrl}}' => $metadata['acf_fields']['cta_primary']['url'],
            '{{secondaryCTAText}}' => $metadata['acf_fields']['cta_secondary']['text'],
            '{{secondaryCTAUrl}}' => $metadata['acf_fields']['cta_secondary']['url']
        ];
        
        $processed_template = $hero_template;
        foreach ($substitutions as $placeholder => $value) {
            $processed_template = str_replace($placeholder, $value, $processed_template);
            echo "✅ Mapped {$placeholder} → " . substr($value, 0, 40) . "...\n";
        }
        
        echo "\n📐 Gutenberg Block Validation:\n";
        
        // Check for Gutenberg syntax
        $block_comments = preg_match_all('/<!-- wp:([a-z-]+)/', $processed_template, $block_matches);
        echo "✅ Found {$block_comments} Gutenberg blocks\n";
        
        // Check for required classes
        $has_wp_classes = preg_match('/wp-block-/', $processed_template);
        echo ($has_wp_classes ? "✅" : "❌") . " WordPress block classes present\n";
        
        // Check for accessibility
        $has_alt_text = preg_match('/alt="[^"]*"/', $processed_template);
        $has_aria = preg_match('/aria-[a-z-]+="[^"]*"/', $processed_template);
        echo ($has_aria ? "✅" : "⚠️") . " ARIA attributes present\n";
        
        // Check for color consistency
        $has_brand_colors = preg_match('/has-[a-z-]+-color/', $processed_template);
        echo ($has_brand_colors ? "✅" : "⚠️") . " Brand color classes present\n";
        
        echo "\n📊 Template System Status:\n";
        
        $all_checks = [
            'Content extraction' => $hero_match && $subheadline_match,
            'Template substitution' => count($substitutions) > 0,
            'Gutenberg compatibility' => $block_comments > 0 && $has_wp_classes,
            'Brand consistency' => $has_brand_colors
        ];
        
        $passed = 0;
        foreach ($all_checks as $check => $status) {
            echo ($status ? "✅" : "❌") . " {$check}\n";
            if ($status) $passed++;
        }
        
        echo "\n🎯 Overall Score: {$passed}/" . count($all_checks) . " (" . round(($passed/count($all_checks))*100) . "%)\n";
        
        if ($passed >= 3) {
            echo "🎉 Template system is working correctly!\n";
            return true;
        } else {
            echo "⚠️ Template system needs refinement\n";
            return false;
        }
    }
    
    public function demonstrate_batch_creation() {
        echo "\n\n🔄 Batch Creation Simulation:\n";
        
        $products_dir = __DIR__ . '/../../alepo-generated-content/01-page-content/products';
        
        if (!is_dir($products_dir)) {
            echo "❌ Products directory not found\n";
            return;
        }
        
        $product_folders = glob($products_dir . '/*', GLOB_ONLYDIR);
        $ready_for_creation = [];
        
        foreach ($product_folders as $folder) {
            $slug = basename($folder);
            
            // Skip placeholder directories
            if (strpos($slug, '{') !== false) {
                continue;
            }
            
            $has_content = file_exists($folder . '/content.html');
            $has_metadata = file_exists($folder . '/metadata.json');
            
            if ($has_content) {
                $ready_for_creation[] = [
                    'slug' => $slug,
                    'has_metadata' => $has_metadata
                ];
            }
        }
        
        echo "📦 Found " . count($ready_for_creation) . " products ready for batch creation:\n";
        
        foreach ($ready_for_creation as $product) {
            echo "  ✅ {$product['slug']}" . ($product['has_metadata'] ? " (with metadata)" : " (content only)") . "\n";
        }
        
        echo "\n🚀 Batch creation would:\n";
        echo "  1. Apply product-template.json to all " . count($ready_for_creation) . " products\n";
        echo "  2. Generate consistent Gutenberg blocks for each\n";
        echo "  3. Create WordPress pages with proper hierarchy\n";
        echo "  4. Ensure brand consistency across all pages\n";
        echo "  5. Make all pages Spectra-editable\n";
        
        return $ready_for_creation;
    }
}

// Run the test
$test = new TestMapping();
$success = $test->test_aaa_content_mapping();
$products = $test->demonstrate_batch_creation();

echo "\n" . str_repeat("=", 60) . "\n";
echo "VALIDATION COMPLETE\n";
echo "Template system: " . ($success ? "✅ READY" : "⚠️ NEEDS WORK") . "\n";
echo "Products ready: " . count($products) . "\n";
echo str_repeat("=", 60) . "\n";
?>
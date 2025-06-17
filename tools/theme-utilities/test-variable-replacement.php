<?php
/**
 * Test script to verify variable replacement is working
 */

// Mock WordPress functions
function get_template_directory() {
    return '/mnt/d/Website Works/alepo-new-website-project/wp-content/themes/alepo-theme';
}

function sanitize_title($title) {
    return strtolower(str_replace(' ', '-', $title));
}

// Load the metadata
$metadata_file = '/mnt/d/Website Works/alepo-new-website-project/alepo-generated-content/01-page-content/solutions/5g-network-evolution/metadata.json';
$metadata = json_decode(file_get_contents($metadata_file), true);

echo "=== VARIABLE REPLACEMENT TEST ===\n\n";

// Test 1: Check if wireframe_variables exist
echo "1. Checking wireframe_variables in metadata...\n";
if (!empty($metadata['wireframe_variables'])) {
    echo "✅ wireframe_variables found with " . count($metadata['wireframe_variables']) . " variables\n";
    
    // Show some key variables
    $key_vars = ['solutionHeadline', 'valueProposition', 'customerQuote'];
    foreach ($key_vars as $var) {
        if (isset($metadata['wireframe_variables'][$var])) {
            echo "   - {$var}: " . substr($metadata['wireframe_variables'][$var], 0, 50) . "...\n";
        } else {
            echo "   - {$var}: NOT FOUND\n";
        }
    }
} else {
    echo "❌ wireframe_variables not found in metadata\n";
}

echo "\n";

// Test 2: Load a hero template and test replacement
echo "2. Testing template variable replacement...\n";

$hero_template_file = '/mnt/d/Website Works/alepo-new-website-project/alepo-templates/block-library/hero-blocks/solution-hero-wireframe.html';

if (file_exists($hero_template_file)) {
    echo "✅ Hero template found\n";
    
    $template_content = file_get_contents($hero_template_file);
    
    // Count total variables in template
    preg_match_all('/\{\{([^}]+)\}\}/', $template_content, $matches);
    $template_vars = array_unique($matches[1]);
    echo "   Template has " . count($template_vars) . " variables: " . implode(', ', array_slice($template_vars, 0, 5)) . "...\n";
    
    // Test replacement with our metadata
    if (!empty($metadata['wireframe_variables'])) {
        $replaced_content = $template_content;
        $replaced_count = 0;
        
        foreach ($metadata['wireframe_variables'] as $key => $value) {
            if (strpos($replaced_content, '{{' . $key . '}}') !== false) {
                $replaced_content = str_replace('{{' . $key . '}}', $value, $replaced_content);
                $replaced_count++;
            }
        }
        
        echo "   ✅ Replaced {$replaced_count} variables successfully\n";
        
        // Check for remaining unreplaced variables
        preg_match_all('/\{\{([^}]+)\}\}/', $replaced_content, $remaining_matches);
        $remaining_vars = array_unique($remaining_matches[1]);
        
        if (count($remaining_vars) > 0) {
            echo "   ⚠️  Unreplaced variables: " . implode(', ', $remaining_vars) . "\n";
        } else {
            echo "   ✅ All variables replaced successfully!\n";
        }
        
        // Show a sample of replaced content
        echo "\n   Sample replaced content:\n";
        $lines = explode("\n", $replaced_content);
        foreach (array_slice($lines, 20, 5) as $line) {
            if (trim($line) && !strpos($line, '<!--')) {
                echo "   " . trim(strip_tags($line)) . "\n";
                break;
            }
        }
        
    } else {
        echo "   ❌ No wireframe_variables to test replacement\n";
    }
    
} else {
    echo "❌ Hero template not found at: {$hero_template_file}\n";
}

echo "\n";

// Test 3: Check if the issue might be with WordPress page generation
echo "3. WordPress Integration Check...\n";
echo "   Metadata file location: {$metadata_file}\n";
echo "   File exists: " . (file_exists($metadata_file) ? 'YES' : 'NO') . "\n";
echo "   File readable: " . (is_readable($metadata_file) ? 'YES' : 'NO') . "\n";
echo "   File size: " . filesize($metadata_file) . " bytes\n";

echo "\n=== TEST COMPLETE ===\n";
echo "\nNext steps:\n";
echo "1. If variables are found but not replacing, the issue is in WordPress page generation\n";
echo "2. If variables are missing, the metadata.json structure needs adjustment\n";
echo "3. If template not found, the block template loading logic needs fixing\n";
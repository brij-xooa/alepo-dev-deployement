<?php
/**
 * Update Alepo Page Creator to Use Enhanced Templates
 * 
 * This file updates the existing page creator to automatically
 * use the enhanced templates with Alepo Components
 */

// Update the template assignment for solution pages
add_filter('alepo_page_creator_template', 'update_solution_template', 10, 3);

function update_solution_template($template, $section, $page_slug) {
    // Apply enhanced template to solution pages
    if ($section === 'solutions') {
        // Update the WordPress template to use the enhanced version
        if (isset($template['wordpress_template'])) {
            $template['wordpress_template'] = 'page-templates/page-solution-enhanced.php';
        }
        
        // Add flag to use enhanced components
        $template['use_enhanced_components'] = true;
        
        // Ensure hero section uses new template
        if (isset($template['sections']) && isset($template['sections'][0])) {
            $template['sections'][0]['template'] = 'hero-blocks/solution-hero-wireframe.html';
        }
        
        // Add CSS and JS dependencies
        $template['dependencies'] = [
            'css' => ['alepo-components'],
            'js' => ['alepo-components']
        ];
    }
    
    return $template;
}

// Update metadata to include component flags
add_filter('alepo_page_creator_metadata', 'add_component_metadata', 10, 3);

function add_component_metadata($metadata, $section, $page_slug) {
    if ($section === 'solutions') {
        // Add flags for enhanced components
        $metadata['use_enhanced_components'] = true;
        $metadata['hero_style'] = 'gradient-modern';
        
        // Ensure background image is set
        if (empty($metadata['heroBackgroundImage'])) {
            $metadata['heroBackgroundImage'] = 'https://alepo.com/wp-content/uploads/2024/03/landing_Solution-Brief-Digital-MVNO-in-a-Box.png';
            $metadata['heroBackgroundAlt'] = 'Solution infrastructure visualization';
            $metadata['heroDimRatio'] = 70;
        }
    }
    
    return $metadata;
}

// Add enhanced styles to generated content
add_filter('alepo_page_creator_content', 'enhance_solution_content', 10, 3);

function enhance_solution_content($content, $section, $metadata) {
    if ($section === 'solutions') {
        // Add background effects at the beginning
        $background_effects = '
<!-- Alepo Enhanced Background Effects -->
<div class="alepo-gradient-mesh"></div>
<div class="alepo-curved-lines"></div>
<div class="alepo-particles-bg"></div>

';
        
        // Add FAB at the end
        $fab_button = '
<!-- Floating Action Button -->
<button class="alepo-fab">
    <svg viewBox="0 0 24 24">
        <path d="M7 14l5-5 5 5" />
    </svg>
</button>
';
        
        // Wrap content with effects
        $content = $background_effects . $content . $fab_button;
        
        // Replace capability sections with enhanced version
        $content = str_replace(
            'class="key-capabilities-section"',
            'class="key-capabilities-section alepo-bg-gray-50 alepo-py-11"',
            $content
        );
        
        // Add animation classes to hero elements
        $content = str_replace(
            'class="wp-block-heading"',
            'class="wp-block-heading alepo-fade-in-up"',
            $content
        );
        
        // Convert basic cards to enhanced cards
        $content = preg_replace_callback(
            '/<div class="capability-block".*?<\/div>\s*<!-- \/wp:column -->/s',
            'convert_to_enhanced_card',
            $content
        );
    }
    
    return $content;
}

// Convert basic capability blocks to enhanced cards
function convert_to_enhanced_card($matches) {
    $block = $matches[0];
    
    // Extract title
    preg_match('/<h2[^>]*>(.*?)<\/h2>/', $block, $title_match);
    $title = isset($title_match[1]) ? strip_tags($title_match[1]) : 'Capability';
    
    // Extract description from list items
    preg_match_all('/<li>(.*?)<\/li>/', $block, $features);
    $description = isset($features[1]) ? implode('. ', array_slice($features[1], 0, 2)) . '.' : '';
    
    // Determine icon based on title
    $icon_map = [
        'migration' => '<path d="M12 2L2 7L12 12L22 7L12 2Z" /><path d="M2 17L12 22L22 17" /><path d="M2 12L12 17L22 12" />',
        'performance' => '<path d="M13 2L3 14H12L11 22L21 10H12L13 2Z" />',
        'security' => '<path d="M12 2L3.5 7V11.5C3.5 16.5 6.5 21 12 22C17.5 21 20.5 16.5 20.5 11.5V7L12 2Z" /><path d="M9 12L11 14L15 10" />',
        'authentication' => '<path d="M12 2L3.5 7V11.5C3.5 16.5 6.5 21 12 22C17.5 21 20.5 16.5 20.5 11.5V7L12 2Z" /><path d="M9 12L11 14L15 10" />',
    ];
    
    $title_lower = strtolower($title);
    $icon = '<circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/>'; // default
    
    foreach ($icon_map as $key => $svg) {
        if (strpos($title_lower, $key) !== false) {
            $icon = $svg;
            break;
        }
    }
    
    // Return enhanced card HTML
    return '
<div class="alepo-feature-card">
    <div class="alepo-aim-dot"></div>
    <div class="alepo-mouse-gradient"></div>
    <div class="alepo-icon-wrapper">
        <svg class="alepo-icon" viewBox="0 0 24 24">
            ' . $icon . '
        </svg>
    </div>
    <h3 class="alepo-feature-title">' . esc_html($title) . '</h3>
    <p class="alepo-feature-description">' . esc_html($description) . '</p>
</div>';
}

// Hook into the page creator process
add_action('alepo_before_page_create', 'setup_enhanced_components');

function setup_enhanced_components() {
    // Ensure components are loaded
    if (!wp_script_is('alepo-components', 'enqueued')) {
        wp_enqueue_style('alepo-components');
        wp_enqueue_script('alepo-components');
    }
}

// Add admin notice about enhanced templates
add_action('admin_notices', 'alepo_enhanced_templates_notice');

function alepo_enhanced_templates_notice() {
    $screen = get_current_screen();
    if ($screen && strpos($screen->id, 'alepo-page-creator') !== false) {
        ?>
        <div class="notice notice-info">
            <p><strong>Enhanced Templates Active:</strong> Solution pages will automatically use the new Alepo Components with advanced hover effects, parallax scrolling, and animations.</p>
        </div>
        <?php
    }
}

// Make sure this update is loaded
if (!function_exists('alepo_load_page_creator_updates')) {
    function alepo_load_page_creator_updates() {
        // This function ensures the updates are applied
        return true;
    }
    
    add_action('init', 'alepo_load_page_creator_updates');
}
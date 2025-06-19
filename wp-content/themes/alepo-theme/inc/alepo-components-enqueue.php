<?php
/**
 * Alepo Components Enqueue Script
 * Add this to your theme's functions.php or include it
 */

/**
 * Enqueue Alepo Components CSS and JS
 */
function alepo_enqueue_components() {
    // Enqueue CSS
    wp_enqueue_style(
        'alepo-components',
        get_template_directory_uri() . '/assets/css/alepo-components.css',
        array(), // Dependencies (none needed as it uses CSS variables from main style.css)
        '1.0.0'
    );
    
    // Enqueue JS
    wp_enqueue_script(
        'alepo-components',
        get_template_directory_uri() . '/assets/js/alepo-components.js',
        array(), // No dependencies
        '1.0.0',
        true // Load in footer
    );
}

// Enqueue on frontend
add_action('wp_enqueue_scripts', 'alepo_enqueue_components');

// Enqueue in admin (for block editor)
add_action('admin_enqueue_scripts', 'alepo_enqueue_components');

/**
 * Add Alepo Components to Block Editor
 */
function alepo_components_block_editor_assets() {
    // Add components CSS to block editor
    wp_enqueue_style(
        'alepo-components-editor',
        get_template_directory_uri() . '/assets/css/alepo-components.css',
        array('wp-edit-blocks'),
        '1.0.0'
    );
    
    // Add components JS to block editor
    wp_enqueue_script(
        'alepo-components-editor',
        get_template_directory_uri() . '/assets/js/alepo-components.js',
        array('wp-blocks', 'wp-dom-ready'),
        '1.0.0',
        true
    );
}
add_action('enqueue_block_editor_assets', 'alepo_components_block_editor_assets');

/**
 * Register Block Patterns for Alepo Components
 */
function alepo_register_component_patterns() {
    // Feature Cards Pattern
    register_block_pattern(
        'alepo/feature-cards-pattern',
        array(
            'title'         => __('Alepo Feature Cards', 'alepo'),
            'description'   => __('Advanced feature cards with hover effects and animations', 'alepo'),
            'content'       => '<!-- wp:html -->
<div class="alepo-flex-column">
    <div class="alepo-feature-card">
        <div class="alepo-aim-dot"></div>
        <div class="alepo-mouse-gradient"></div>
        <div class="alepo-icon-wrapper">
            <svg class="alepo-icon" viewBox="0 0 24 24">
                <path d="M12 2L2 7L12 12L22 7L12 2Z" />
                <path d="M2 17L12 22L22 17" />
                <path d="M2 12L12 17L22 12" />
            </svg>
        </div>
        <h3 class="alepo-feature-title">Zero-Downtime Migration</h3>
        <p class="alepo-feature-description">Seamlessly transition from legacy systems to modern architecture.</p>
    </div>
    <div class="alepo-feature-card">
        <div class="alepo-aim-dot"></div>
        <div class="alepo-mouse-gradient"></div>
        <div class="alepo-icon-wrapper">
            <svg class="alepo-icon" viewBox="0 0 24 24">
                <path d="M13 2L3 14H12L11 22L21 10H12L13 2Z" />
            </svg>
        </div>
        <h3 class="alepo-feature-title">Performance Amplification</h3>
        <p class="alepo-feature-description">10x performance improvement with cloud-native architecture.</p>
    </div>
    <div class="alepo-feature-card">
        <div class="alepo-aim-dot"></div>
        <div class="alepo-mouse-gradient"></div>
        <div class="alepo-icon-wrapper">
            <svg class="alepo-icon" viewBox="0 0 24 24">
                <path d="M12 2L3.5 7V11.5C3.5 16.5 6.5 21 12 22C17.5 21 20.5 16.5 20.5 11.5V7L12 2Z" />
                <path d="M9 12L11 14L15 10" />
            </svg>
        </div>
        <h3 class="alepo-feature-title">Security Enhancement</h3>
        <p class="alepo-feature-description">Advanced threat detection and zero-trust principles.</p>
    </div>
</div>
<!-- /wp:html -->',
            'categories'    => array('alepo-components'),
        )
    );

    // Diagram Container Pattern
    register_block_pattern(
        'alepo/diagram-container-pattern',
        array(
            'title'         => __('Alepo Diagram Container', 'alepo'),
            'description'   => __('Sticky diagram container with particles and parallax effects', 'alepo'),
            'content'       => '<!-- wp:html -->
<div class="alepo-sticky-container">
    <div class="alepo-sticky-wrapper">
        <h2 class="alepo-fade-in-up" style="font-size: var(--font-size-h3); font-weight: var(--font-weight-semibold); color: var(--c-gray-900); margin-bottom: var(--space-5);">
            Solution Architecture
        </h2>
        <div class="alepo-diagram-container" style="min-height: 500px;">
            <div class="alepo-bg-gradient-light" style="height: 100%; border-radius: 12px; display: flex; align-items: center; justify-content: center; position: relative; overflow: hidden;">
                <div class="alepo-particle-container"></div>
                <div style="position: relative; z-index: 2; color: var(--c-gray-600); text-align: center;">
                    <p style="font-size: var(--font-size-body-lg); margin-bottom: var(--space-3);">Solution Diagram</p>
                    <p style="font-size: var(--font-size-small);">[Your diagram content here]</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /wp:html -->',
            'categories'    => array('alepo-components'),
        )
    );

    // Feature Cards + Diagram Grid Pattern
    register_block_pattern(
        'alepo/features-diagram-grid-pattern',
        array(
            'title'         => __('Alepo Features + Diagram Grid', 'alepo'),
            'description'   => __('Complete features and diagram layout with advanced effects', 'alepo'),
            'content'       => '<!-- wp:html -->
<div class="alepo-gradient-mesh"></div>
<div class="alepo-curved-lines"></div>
<div class="alepo-particles-bg"></div>

<div class="alepo-container">
    <h1 class="alepo-text-center alepo-mb-9 alepo-title-underline">
        <span class="alepo-title-gradient">Solution</span> Framework
    </h1>
    
    <div class="alepo-grid-2">
        <div class="alepo-flex-column">
            <div class="alepo-feature-card">
                <div class="alepo-aim-dot"></div>
                <div class="alepo-mouse-gradient"></div>
                <div class="alepo-icon-wrapper">
                    <svg class="alepo-icon" viewBox="0 0 24 24">
                        <path d="M12 2L2 7L12 12L22 7L12 2Z" />
                        <path d="M2 17L12 22L22 17" />
                        <path d="M2 12L12 17L22 12" />
                    </svg>
                </div>
                <h3 class="alepo-feature-title">Migration Excellence</h3>
                <p class="alepo-feature-description">Zero-downtime transition with proven methodology.</p>
            </div>
            <div class="alepo-feature-card">
                <div class="alepo-aim-dot"></div>
                <div class="alepo-mouse-gradient"></div>
                <div class="alepo-icon-wrapper">
                    <svg class="alepo-icon" viewBox="0 0 24 24">
                        <path d="M13 2L3 14H12L11 22L21 10H12L13 2Z" />
                    </svg>
                </div>
                <h3 class="alepo-feature-title">Performance Boost</h3>
                <p class="alepo-feature-description">10x capacity improvement with cloud scaling.</p>
            </div>
        </div>
        
        <div class="alepo-sticky-container">
            <div class="alepo-sticky-wrapper">
                <h2 class="alepo-fade-in-up" style="font-size: var(--font-size-h3); font-weight: var(--font-weight-semibold); color: var(--c-gray-900); margin-bottom: var(--space-5);">
                    Architecture Overview
                </h2>
                <div class="alepo-diagram-container" style="min-height: 500px;">
                    <div class="alepo-bg-gradient-light" style="height: 100%; border-radius: 12px; display: flex; align-items: center; justify-content: center; position: relative; overflow: hidden;">
                        <div class="alepo-particle-container"></div>
                        <div style="position: relative; z-index: 2; color: var(--c-gray-600); text-align: center;">
                            <p style="font-size: var(--font-size-body-lg); margin-bottom: var(--space-3);">Solution Visualization</p>
                            <p style="font-size: var(--font-size-small);">[Your content here]</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<button class="alepo-fab">
    <svg viewBox="0 0 24 24">
        <path d="M7 14l5-5 5 5" />
    </svg>
</button>
<!-- /wp:html -->',
            'categories'    => array('alepo-components'),
        )
    );
}

/**
 * Register Block Pattern Category
 */
function alepo_register_component_pattern_category() {
    if (function_exists('register_block_pattern_category')) {
        register_block_pattern_category(
            'alepo-components',
            array(
                'label' => __('Alepo Components', 'alepo'),
            )
        );
    }
}

// Register patterns and categories
add_action('init', 'alepo_register_component_pattern_category');
add_action('init', 'alepo_register_component_patterns');

/**
 * Add inline styles for component typography
 */
function alepo_components_inline_styles() {
    $css = '
    .alepo-feature-title {
        font-size: var(--font-size-h3);
        font-weight: var(--font-weight-semibold);
        line-height: var(--line-height-snug);
        color: var(--c-gray-900);
        margin-bottom: var(--space-4);
    }
    
    .alepo-feature-description {
        font-size: var(--font-size-body);
        line-height: var(--line-height-relaxed);
        color: var(--c-gray-600);
        margin: 0;
    }
    ';
    
    wp_add_inline_style('alepo-components', $css);
}
add_action('wp_enqueue_scripts', 'alepo_components_inline_styles');

/**
 * Add body class for component pages
 */
function alepo_components_body_class($classes) {
    global $post;
    
    if (isset($post->post_content) && (
        strpos($post->post_content, 'alepo-feature-card') !== false ||
        strpos($post->post_content, 'alepo-diagram-container') !== false ||
        strpos($post->post_content, 'alepo-gradient-mesh') !== false
    )) {
        $classes[] = 'has-alepo-components';
    }
    
    return $classes;
}
add_filter('body_class', 'alepo_components_body_class');
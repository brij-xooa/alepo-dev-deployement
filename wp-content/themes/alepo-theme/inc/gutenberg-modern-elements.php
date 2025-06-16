<?php
/**
 * Gutenberg Modern Design Elements
 * 
 * Provides drag-drop capable modern design elements like floating badges,
 * overlays, and absolutely positioned elements for marketing team use.
 */

// Register custom block category for modern elements
function alepo_register_modern_elements_category($categories, $post) {
    return array_merge(
        array(
            array(
                'slug' => 'alepo-modern-elements',
                'title' => __('Alepo Modern Elements', 'alepo'),
                'icon' => 'admin-customizer',
            ),
        ),
        $categories
    );
}
add_filter('block_categories_all', 'alepo_register_modern_elements_category', 10, 2);

// Register modern element blocks
function alepo_register_modern_element_blocks() {
    // Register script for block editor
    wp_register_script(
        'alepo-modern-elements-editor',
        get_template_directory_uri() . '/assets/js/blocks/modern-elements.js',
        array('wp-blocks', 'wp-element', 'wp-editor', 'wp-components', 'wp-i18n'),
        filemtime(get_template_directory() . '/assets/js/blocks/modern-elements.js')
    );

    // Register editor styles
    wp_register_style(
        'alepo-modern-elements-editor',
        get_template_directory_uri() . '/assets/css/blocks/modern-elements-editor.css',
        array('wp-edit-blocks'),
        filemtime(get_template_directory() . '/assets/css/blocks/modern-elements-editor.css')
    );

    // Register frontend styles
    wp_register_style(
        'alepo-modern-elements-frontend',
        get_template_directory_uri() . '/assets/css/blocks/modern-elements-frontend.css',
        array(),
        filemtime(get_template_directory() . '/assets/css/blocks/modern-elements-frontend.css')
    );

    // 1. Floating Badge Block
    register_block_type('alepo/floating-badge', array(
        'editor_script' => 'alepo-modern-elements-editor',
        'editor_style' => 'alepo-modern-elements-editor',
        'style' => 'alepo-modern-elements-frontend',
        'attributes' => array(
            'badgeText' => array(
                'type' => 'string',
                'default' => 'NEW'
            ),
            'badgePosition' => array(
                'type' => 'string',
                'default' => 'top-left'
            ),
            'badgeStyle' => array(
                'type' => 'string',
                'default' => 'angled'
            ),
            'badgeColor' => array(
                'type' => 'string',
                'default' => '#17a2b8'
            ),
            'textColor' => array(
                'type' => 'string',
                'default' => '#ffffff'
            ),
            'fontSize' => array(
                'type' => 'number',
                'default' => 24
            ),
            'rotation' => array(
                'type' => 'number',
                'default' => -45
            )
        ),
        'render_callback' => 'alepo_render_floating_badge_block'
    ));

    // 2. Image with Overlay Block
    register_block_type('alepo/image-overlay', array(
        'editor_script' => 'alepo-modern-elements-editor',
        'editor_style' => 'alepo-modern-elements-editor',
        'style' => 'alepo-modern-elements-frontend',
        'attributes' => array(
            'imageUrl' => array(
                'type' => 'string',
                'default' => ''
            ),
            'imageId' => array(
                'type' => 'number',
                'default' => 0
            ),
            'overlayType' => array(
                'type' => 'string',
                'default' => 'badge'
            ),
            'overlayText' => array(
                'type' => 'string',
                'default' => 'Featured'
            ),
            'overlayPosition' => array(
                'type' => 'string',
                'default' => 'top-left'
            ),
            'overlayStyle' => array(
                'type' => 'object',
                'default' => array(
                    'backgroundColor' => '#0056b3',
                    'textColor' => '#ffffff',
                    'padding' => '10px 20px',
                    'borderRadius' => '4px'
                )
            )
        ),
        'render_callback' => 'alepo_render_image_overlay_block'
    ));

    // 3. Floating Info Card Block
    register_block_type('alepo/floating-info', array(
        'editor_script' => 'alepo-modern-elements-editor',
        'editor_style' => 'alepo-modern-elements-editor',
        'style' => 'alepo-modern-elements-frontend',
        'attributes' => array(
            'title' => array(
                'type' => 'string',
                'default' => 'Info Title'
            ),
            'content' => array(
                'type' => 'string',
                'default' => 'Info content goes here'
            ),
            'position' => array(
                'type' => 'object',
                'default' => array(
                    'x' => 50,
                    'y' => 50
                )
            ),
            'cardStyle' => array(
                'type' => 'object',
                'default' => array(
                    'backgroundColor' => '#ffffff',
                    'borderColor' => '#dee2e6',
                    'shadow' => true,
                    'arrow' => true
                )
            )
        ),
        'render_callback' => 'alepo_render_floating_info_block'
    ));

    // 4. Modern CTA Button with Effects
    register_block_type('alepo/modern-cta', array(
        'editor_script' => 'alepo-modern-elements-editor',
        'editor_style' => 'alepo-modern-elements-editor',
        'style' => 'alepo-modern-elements-frontend',
        'attributes' => array(
            'text' => array(
                'type' => 'string',
                'default' => 'Get Started'
            ),
            'url' => array(
                'type' => 'string',
                'default' => '#'
            ),
            'style' => array(
                'type' => 'string',
                'default' => 'gradient-shift'
            ),
            'icon' => array(
                'type' => 'string',
                'default' => 'arrow-right'
            ),
            'iconPosition' => array(
                'type' => 'string',
                'default' => 'after'
            )
        ),
        'render_callback' => 'alepo_render_modern_cta_block'
    ));
}
add_action('init', 'alepo_register_modern_element_blocks');

// Render callbacks for each block
function alepo_render_floating_badge_block($attributes) {
    $badge_classes = array(
        'alepo-floating-badge',
        'position-' . esc_attr($attributes['badgePosition']),
        'style-' . esc_attr($attributes['badgeStyle'])
    );

    $badge_styles = array(
        'background-color' => $attributes['badgeColor'],
        'color' => $attributes['textColor'],
        'font-size' => $attributes['fontSize'] . 'px',
        'transform' => 'rotate(' . $attributes['rotation'] . 'deg)'
    );

    $style_string = '';
    foreach ($badge_styles as $property => $value) {
        $style_string .= $property . ':' . $value . ';';
    }

    return sprintf(
        '<div class="%s" style="%s">%s</div>',
        esc_attr(implode(' ', $badge_classes)),
        esc_attr($style_string),
        esc_html($attributes['badgeText'])
    );
}

function alepo_render_image_overlay_block($attributes) {
    if (empty($attributes['imageUrl'])) {
        return '<div class="alepo-image-overlay-placeholder">Select an image</div>';
    }

    $overlay_html = '';
    if ($attributes['overlayType'] === 'badge') {
        $overlay_html = sprintf(
            '<div class="alepo-overlay-badge position-%s" style="background-color:%s;color:%s;">%s</div>',
            esc_attr($attributes['overlayPosition']),
            esc_attr($attributes['overlayStyle']['backgroundColor']),
            esc_attr($attributes['overlayStyle']['textColor']),
            esc_html($attributes['overlayText'])
        );
    }

    return sprintf(
        '<div class="alepo-image-overlay-container">
            <img src="%s" alt="" class="alepo-overlay-image" />
            %s
        </div>',
        esc_url($attributes['imageUrl']),
        $overlay_html
    );
}

function alepo_render_floating_info_block($attributes) {
    $card_classes = array('alepo-floating-info');
    if ($attributes['cardStyle']['shadow']) {
        $card_classes[] = 'has-shadow';
    }
    if ($attributes['cardStyle']['arrow']) {
        $card_classes[] = 'has-arrow';
    }

    $position_style = sprintf(
        'left:%s%%;top:%s%%;',
        esc_attr($attributes['position']['x']),
        esc_attr($attributes['position']['y'])
    );

    return sprintf(
        '<div class="%s" style="%s;background-color:%s;border-color:%s;">
            <h4 class="alepo-floating-info-title">%s</h4>
            <p class="alepo-floating-info-content">%s</p>
        </div>',
        esc_attr(implode(' ', $card_classes)),
        esc_attr($position_style),
        esc_attr($attributes['cardStyle']['backgroundColor']),
        esc_attr($attributes['cardStyle']['borderColor']),
        esc_html($attributes['title']),
        esc_html($attributes['content'])
    );
}

function alepo_render_modern_cta_block($attributes) {
    $cta_classes = array(
        'alepo-modern-cta',
        'style-' . esc_attr($attributes['style']),
        'icon-' . esc_attr($attributes['iconPosition'])
    );

    $icon_html = '';
    if (!empty($attributes['icon'])) {
        $icon_html = sprintf(
            '<span class="alepo-cta-icon dashicons dashicons-%s"></span>',
            esc_attr($attributes['icon'])
        );
    }

    $content = ($attributes['iconPosition'] === 'before') 
        ? $icon_html . ' ' . esc_html($attributes['text'])
        : esc_html($attributes['text']) . ' ' . $icon_html;

    return sprintf(
        '<a href="%s" class="%s">%s</a>',
        esc_url($attributes['url']),
        esc_attr(implode(' ', $cta_classes)),
        $content
    );
}

// Register block patterns for quick insertion
function alepo_register_modern_element_patterns() {
    // Pattern 1: Hero with floating badge
    register_block_pattern(
        'alepo/hero-with-badge',
        array(
            'title' => __('Hero Section with Floating Badge', 'alepo'),
            'description' => __('A hero section with an image and floating badge overlay', 'alepo'),
            'categories' => array('alepo-modern-elements'),
            'content' => '<!-- wp:group {"className":"alepo-hero-pattern"} -->
<div class="wp-block-group alepo-hero-pattern">
    <!-- wp:alepo/image-overlay {"imageUrl":"' . get_template_directory_uri() . '/assets/images/placeholder-hero.jpg","overlayText":"NEW","overlayPosition":"top-left"} /-->
    <!-- wp:heading {"level":1} -->
    <h1>Welcome to Modern Design</h1>
    <!-- /wp:heading -->
    <!-- wp:paragraph -->
    <p>Experience the power of modern design elements with Gutenberg.</p>
    <!-- /wp:paragraph -->
    <!-- wp:alepo/modern-cta {"text":"Get Started","style":"gradient-shift"} /-->
</div>
<!-- /wp:group -->'
        )
    );

    // Pattern 2: Feature card with floating info
    register_block_pattern(
        'alepo/feature-with-info',
        array(
            'title' => __('Feature Card with Floating Info', 'alepo'),
            'description' => __('A feature section with floating information cards', 'alepo'),
            'categories' => array('alepo-modern-elements'),
            'content' => '<!-- wp:group {"className":"alepo-feature-pattern"} -->
<div class="wp-block-group alepo-feature-pattern">
    <!-- wp:image -->
    <figure class="wp-block-image"><img src="' . get_template_directory_uri() . '/assets/images/placeholder-feature.jpg" alt=""/></figure>
    <!-- /wp:image -->
    <!-- wp:alepo/floating-info {"title":"Key Feature","content":"This innovative feature will transform your workflow","position":{"x":70,"y":30}} /-->
    <!-- wp:alepo/floating-badge {"badgeText":"HOT","badgePosition":"top-right","badgeColor":"#dc3545"} /-->
</div>
<!-- /wp:group -->'
        )
    );
}
add_action('init', 'alepo_register_modern_element_patterns');

// Add drag-drop enhancement for block editor
function alepo_enqueue_block_editor_drag_drop() {
    wp_enqueue_script(
        'alepo-drag-drop-enhancements',
        get_template_directory_uri() . '/assets/js/admin/drag-drop-enhancements.js',
        array('wp-blocks', 'wp-dom-ready', 'wp-edit-post'),
        filemtime(get_template_directory() . '/assets/js/admin/drag-drop-enhancements.js')
    );
}
add_action('enqueue_block_editor_assets', 'alepo_enqueue_block_editor_drag_drop');

// Add custom block styles for existing blocks
function alepo_register_enhanced_block_styles() {
    // Enhanced image styles with overlay capabilities
    register_block_style('core/image', array(
        'name' => 'with-corner-badge',
        'label' => __('Corner Badge', 'alepo'),
        'inline_style' => '.wp-block-image.is-style-with-corner-badge { position: relative; }
            .wp-block-image.is-style-with-corner-badge::before {
                content: attr(data-badge-text, "NEW");
                position: absolute;
                top: 10px;
                left: 10px;
                background: #17a2b8;
                color: white;
                padding: 5px 15px;
                border-radius: 20px;
                font-size: 12px;
                font-weight: 600;
                z-index: 2;
            }'
    ));

    register_block_style('core/image', array(
        'name' => 'with-diagonal-banner',
        'label' => __('Diagonal Banner', 'alepo'),
        'inline_style' => '.wp-block-image.is-style-with-diagonal-banner { position: relative; overflow: hidden; }
            .wp-block-image.is-style-with-diagonal-banner::after {
                content: attr(data-banner-text, "FEATURED");
                position: absolute;
                top: 20px;
                right: -30px;
                background: #dc3545;
                color: white;
                padding: 5px 40px;
                transform: rotate(45deg);
                font-size: 11px;
                font-weight: 700;
                letter-spacing: 1px;
                z-index: 2;
            }'
    ));

    // Enhanced group styles with modern backgrounds
    register_block_style('core/group', array(
        'name' => 'gradient-mesh',
        'label' => __('Gradient Mesh Background', 'alepo'),
        'inline_style' => '.wp-block-group.is-style-gradient-mesh {
            background: linear-gradient(45deg, rgba(0,86,179,0.05) 0%, rgba(23,162,184,0.05) 100%);
            position: relative;
        }
        .wp-block-group.is-style-gradient-mesh::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: 
                radial-gradient(circle at 20% 50%, rgba(0,86,179,0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(23,162,184,0.1) 0%, transparent 50%);
            z-index: -1;
        }'
    ));
}
add_action('init', 'alepo_register_enhanced_block_styles');
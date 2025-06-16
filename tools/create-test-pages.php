<?php
/**
 * Create Test Pages for Modern Elements Demo
 * 
 * This script creates dummy test pages to demonstrate the modern design elements
 * without modifying any existing pages.
 */

// Include WordPress functions
if (!defined('ABSPATH')) {
    // Set up WordPress environment for CLI execution
    $wp_load_paths = [
        '../wp-load.php',
        '../../wp-load.php',
        '../../../wp-load.php',
        dirname(__DIR__) . '/wp-load.php',
        dirname(dirname(__DIR__)) . '/wp-load.php',
    ];
    
    foreach ($wp_load_paths as $path) {
        if (file_exists($path)) {
            require_once $path;
            break;
        }
    }
    
    if (!defined('ABSPATH')) {
        echo "WordPress not found. Tested paths:\n";
        foreach ($wp_load_paths as $path) {
            echo "- " . realpath($path) . " (exists: " . (file_exists($path) ? 'yes' : 'no') . ")\n";
        }
        echo "\nPlease run this script from the WordPress root directory or ensure wp-load.php is accessible.\n";
        echo "Current directory: " . getcwd() . "\n";
        exit(1);
    }
}

/**
 * Create test pages with modern elements content
 */
function alepo_create_test_pages() {
    echo "Creating test pages for modern elements demo...\n";
    
    // Test pages to create
    $test_pages = [
        'modern-elements-demo' => [
            'title' => 'Modern Elements Demo',
            'content' => alepo_get_demo_page_content(),
            'status' => 'publish'
        ],
        'floating-badges-test' => [
            'title' => 'Floating Badges Test',
            'content' => alepo_get_badges_test_content(),
            'status' => 'publish'
        ],
        'image-overlays-test' => [
            'title' => 'Image Overlays Test', 
            'content' => alepo_get_image_overlay_test_content(),
            'status' => 'publish'
        ],
        'floating-info-test' => [
            'title' => 'Floating Info Cards Test',
            'content' => alepo_get_floating_info_test_content(),
            'status' => 'publish'
        ],
        'modern-cta-test' => [
            'title' => 'Modern CTA Buttons Test',
            'content' => alepo_get_modern_cta_test_content(),
            'status' => 'publish'
        ]
    ];
    
    foreach ($test_pages as $slug => $page_data) {
        // Check if page already exists
        $existing_page = get_page_by_path($slug);
        
        if ($existing_page) {
            echo "⚠️  Page '{$page_data['title']}' already exists. Updating...\n";
            
            wp_update_post([
                'ID' => $existing_page->ID,
                'post_content' => $page_data['content'],
                'post_status' => $page_data['status']
            ]);
            
            echo "✅ Updated page: {$page_data['title']} (ID: {$existing_page->ID})\n";
        } else {
            $page_id = wp_insert_post([
                'post_title' => $page_data['title'],
                'post_name' => $slug,
                'post_content' => $page_data['content'],
                'post_status' => $page_data['status'],
                'post_type' => 'page',
                'meta_input' => [
                    '_alepo_test_page' => true,
                    '_alepo_modern_elements' => true
                ]
            ]);
            
            if ($page_id && !is_wp_error($page_id)) {
                echo "✅ Created page: {$page_data['title']} (ID: {$page_id})\n";
            } else {
                echo "❌ Failed to create page: {$page_data['title']}\n";
                if (is_wp_error($page_id)) {
                    echo "   Error: " . $page_id->get_error_message() . "\n";
                }
            }
        }
    }
    
    echo "\n📋 Test pages created! You can now:\n";
    echo "1. Go to WordPress Admin > Pages\n";
    echo "2. Look for pages marked with 'Test' in the title\n";
    echo "3. Edit them to see and test the modern elements\n";
    echo "4. Use the 'Alepo Modern Elements' block category in Gutenberg\n\n";
}

/**
 * Get demo page content with all modern elements
 */
function alepo_get_demo_page_content() {
    return '<!-- wp:group {"className":"demo-hero-section"} -->
<div class="wp-block-group demo-hero-section">
    <!-- wp:heading {"level":1} -->
    <h1>Modern Elements Demo Page</h1>
    <!-- /wp:heading -->
    
    <!-- wp:paragraph -->
    <p>This page demonstrates all the modern design elements you can drag and drop in Gutenberg. Test the floating badges, image overlays, info cards, and modern CTAs below.</p>
    <!-- /wp:paragraph -->
</div>
<!-- /wp:group -->

<!-- wp:group {"className":"demo-floating-badges"} -->
<div class="wp-block-group demo-floating-badges">
    <!-- wp:heading {"level":2} -->
    <h2>Floating Badges</h2>
    <!-- /wp:heading -->
    
    <!-- wp:alepo/floating-badge {"badgeText":"G6","badgePosition":"top-left","badgeColor":"#17a2b8","rotation":-45} /-->
    
    <!-- wp:alepo/floating-badge {"badgeText":"NEW","badgePosition":"top-right","badgeColor":"#dc3545","rotation":45} /-->
    
    <!-- wp:alepo/floating-badge {"badgeText":"HOT","badgePosition":"bottom-left","badgeColor":"#fd7e14","rotation":-30} /-->
</div>
<!-- /wp:group -->

<!-- wp:group {"className":"demo-image-overlays"} -->
<div class="wp-block-group demo-image-overlays">
    <!-- wp:heading {"level":2} -->
    <h2>Image with Overlays</h2>
    <!-- /wp:heading -->
    
    <!-- wp:alepo/image-overlay {"overlayText":"Featured Product","overlayPosition":"top-left"} /-->
</div>
<!-- /wp:group -->

<!-- wp:group {"className":"demo-floating-info"} -->
<div class="wp-block-group demo-floating-info">
    <!-- wp:heading {"level":2} -->
    <h2>Floating Info Cards (Drag to Reposition)</h2>
    <!-- /wp:heading -->
    
    <!-- wp:alepo/floating-info {"title":"Key Innovation","content":"This feature revolutionizes telecom infrastructure","position":{"x":25,"y":30}} /-->
    
    <!-- wp:alepo/floating-info {"title":"Performance Boost","content":"99.999% uptime guaranteed","position":{"x":75,"y":60}} /-->
</div>
<!-- /wp:group -->

<!-- wp:group {"className":"demo-modern-cta"} -->
<div class="wp-block-group demo-modern-cta">
    <!-- wp:heading {"level":2} -->
    <h2>Modern CTA Buttons</h2>
    <!-- /wp:heading -->
    
    <!-- wp:alepo/modern-cta {"text":"Get Started","style":"gradient-shift","icon":"arrow-right"} /-->
    
    <!-- wp:alepo/modern-cta {"text":"Download Now","style":"glow","icon":"download"} /-->
    
    <!-- wp:alepo/modern-cta {"text":"Learn More","style":"slide","icon":"external"} /-->
    
    <!-- wp:alepo/modern-cta {"text":"Contact Sales","style":"pulse","icon":"arrow-right-alt"} /-->
</div>
<!-- /wp:group -->';
}

/**
 * Get badges test content
 */
function alepo_get_badges_test_content() {
    return '<!-- wp:heading {"level":1} -->
<h1>Floating Badges Test Page</h1>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Test different floating badge configurations. Each badge can be customized with different text, positions, colors, and rotation angles.</p>
<!-- /wp:paragraph -->

<!-- wp:group {"className":"badge-test-container","style":{"spacing":{"padding":{"top":"40px","bottom":"40px"}}}} -->
<div class="wp-block-group badge-test-container" style="padding-top:40px;padding-bottom:40px">
    <!-- wp:heading {"level":3} -->
    <h3>Different Positions</h3>
    <!-- /wp:heading -->
    
    <!-- wp:alepo/floating-badge {"badgeText":"TOP-LEFT","badgePosition":"top-left","badgeColor":"#0056b3"} /-->
    <!-- wp:alepo/floating-badge {"badgeText":"TOP-RIGHT","badgePosition":"top-right","badgeColor":"#17a2b8"} /-->
    <!-- wp:alepo/floating-badge {"badgeText":"BOTTOM-LEFT","badgePosition":"bottom-left","badgeColor":"#28a745"} /-->
    <!-- wp:alepo/floating-badge {"badgeText":"BOTTOM-RIGHT","badgePosition":"bottom-right","badgeColor":"#dc3545"} /-->
</div>
<!-- /wp:group -->

<!-- wp:group {"className":"badge-styles-test","style":{"spacing":{"padding":{"top":"40px","bottom":"40px"}}}} -->
<div class="wp-block-group badge-styles-test" style="padding-top:40px;padding-bottom:40px">
    <!-- wp:heading {"level":3} -->
    <h3>Different Styles</h3>
    <!-- /wp:heading -->
    
    <!-- wp:alepo/floating-badge {"badgeText":"ANGLED","badgeStyle":"angled","badgeColor":"#6f42c1","rotation":-30} /-->
    <!-- wp:alepo/floating-badge {"badgeText":"ROUNDED","badgeStyle":"rounded","badgeColor":"#e83e8c","rotation":0} /-->
    <!-- wp:alepo/floating-badge {"badgeText":"SQUARE","badgeStyle":"square","badgeColor":"#fd7e14","rotation":15} /-->
</div>
<!-- /wp:group -->';
}

/**
 * Get image overlay test content
 */
function alepo_get_image_overlay_test_content() {
    return '<!-- wp:heading {"level":1} -->
<h1>Image Overlays Test Page</h1>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Test image overlay functionality. Upload images and add customizable overlay elements like badges, tags, and labels.</p>
<!-- /wp:paragraph -->

<!-- wp:group {"className":"image-overlay-examples"} -->
<div class="wp-block-group image-overlay-examples">
    <!-- wp:heading {"level":3} -->
    <h3>Product Showcase with Overlays</h3>
    <!-- /wp:heading -->
    
    <!-- wp:alepo/image-overlay {"overlayText":"5G READY","overlayPosition":"top-left","overlayStyle":{"backgroundColor":"#0056b3","textColor":"#ffffff","padding":"12px 20px","borderRadius":"6px"}} /-->
    
    <!-- wp:alepo/image-overlay {"overlayText":"NEW RELEASE","overlayPosition":"top-right","overlayStyle":{"backgroundColor":"#dc3545","textColor":"#ffffff","padding":"8px 16px","borderRadius":"20px"}} /-->
    
    <!-- wp:alepo/image-overlay {"overlayText":"BEST SELLER","overlayPosition":"bottom-left","overlayStyle":{"backgroundColor":"#28a745","textColor":"#ffffff","padding":"10px 18px","borderRadius":"4px"}} /-->
</div>
<!-- /wp:group -->

<!-- wp:group {"className":"overlay-positions-demo"} -->
<div class="wp-block-group overlay-positions-demo">
    <!-- wp:heading {"level":3} -->
    <h3>Different Overlay Positions</h3>
    <!-- /wp:heading -->
    
    <!-- wp:alepo/image-overlay {"overlayText":"CENTER","overlayPosition":"center","overlayStyle":{"backgroundColor":"#17a2b8","textColor":"#ffffff","padding":"15px 25px","borderRadius":"8px"}} /-->
</div>
<!-- /wp:group -->';
}

/**
 * Get floating info test content  
 */
function alepo_get_floating_info_test_content() {
    return '<!-- wp:heading {"level":1} -->
<h1>Floating Info Cards Test Page</h1>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Test draggable floating information cards. These cards can be repositioned by dragging them around the container.</p>
<!-- /wp:paragraph -->

<!-- wp:group {"className":"floating-info-demo","style":{"spacing":{"padding":{"all":"40px"}},"color":{"background":"#f8f9fa"}}} -->
<div class="wp-block-group floating-info-demo has-background" style="background-color:#f8f9fa;padding:40px">
    <!-- wp:heading {"level":3} -->
    <h3>Drag the Cards Below to Reposition Them</h3>
    <!-- /wp:heading -->
    
    <!-- wp:alepo/floating-info {"title":"Network Performance","content":"Monitor real-time network metrics and performance indicators","position":{"x":20,"y":25}} /-->
    
    <!-- wp:alepo/floating-info {"title":"Security Features","content":"Advanced threat detection and prevention capabilities","position":{"x":70,"y":35}} /-->
    
    <!-- wp:alepo/floating-info {"title":"5G Integration","content":"Seamless integration with 5G network infrastructure","position":{"x":45,"y":65}} /-->
    
    <!-- wp:alepo/floating-info {"title":"Analytics Dashboard","content":"Comprehensive analytics and reporting tools","position":{"x":25,"y":80}} /-->
</div>
<!-- /wp:group -->

<!-- wp:group {"className":"info-card-styles"} -->
<div class="wp-block-group info-card-styles">
    <!-- wp:heading {"level":3} -->
    <h3>Different Card Styles</h3>
    <!-- /wp:heading -->
    
    <!-- wp:alepo/floating-info {"title":"With Shadow","content":"This card has a shadow effect","cardStyle":{"backgroundColor":"#ffffff","borderColor":"#dee2e6","shadow":true,"arrow":false},"position":{"x":30,"y":40}} /-->
    
    <!-- wp:alepo/floating-info {"title":"With Arrow","content":"This card has a pointer arrow","cardStyle":{"backgroundColor":"#ffffff","borderColor":"#dee2e6","shadow":false,"arrow":true},"position":{"x":70,"y":40}} /-->
</div>
<!-- /wp:group -->';
}

/**
 * Get modern CTA test content
 */
function alepo_get_modern_cta_test_content() {
    return '<!-- wp:heading {"level":1} -->
<h1>Modern CTA Buttons Test Page</h1>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Test different modern call-to-action button styles with various effects and animations.</p>
<!-- /wp:paragraph -->

<!-- wp:group {"className":"cta-effects-demo"} -->
<div class="wp-block-group cta-effects-demo">
    <!-- wp:heading {"level":3} -->
    <h3>Button Effects</h3>
    <!-- /wp:heading -->
    
    <!-- wp:group {"layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between"}} -->
    <div class="wp-block-group">
        <!-- wp:alepo/modern-cta {"text":"Gradient Shift","style":"gradient-shift","icon":"arrow-right"} /-->
        <!-- wp:alepo/modern-cta {"text":"Glow Effect","style":"glow","icon":"star-filled"} /-->
        <!-- wp:alepo/modern-cta {"text":"Slide Effect","style":"slide","icon":"arrow-right-alt"} /-->
        <!-- wp:alepo/modern-cta {"text":"Pulse Effect","style":"pulse","icon":"heart"} /-->
    </div>
    <!-- /wp:group -->
</div>
<!-- /wp:group -->

<!-- wp:group {"className":"cta-icons-demo"} -->
<div class="wp-block-group cta-icons-demo">
    <!-- wp:heading {"level":3} -->
    <h3>Different Icons & Positions</h3>
    <!-- /wp:heading -->
    
    <!-- wp:group {"layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between"}} -->
    <div class="wp-block-group">
        <!-- wp:alepo/modern-cta {"text":"Download","icon":"download","iconPosition":"before","style":"gradient-shift"} /-->
        <!-- wp:alepo/modern-cta {"text":"External Link","icon":"external","iconPosition":"after","style":"glow"} /-->
        <!-- wp:alepo/modern-cta {"text":"No Icon","icon":"","style":"slide"} /-->
    </div>
    <!-- /wp:group -->
</div>
<!-- /wp:group -->

<!-- wp:group {"className":"cta-use-cases"} -->
<div class="wp-block-group cta-use-cases">
    <!-- wp:heading {"level":3} -->
    <h3>Real-World Use Cases</h3>
    <!-- /wp:heading -->
    
    <!-- wp:group {"layout":{"type":"flex","orientation":"vertical","justifyContent":"center"}} -->
    <div class="wp-block-group">
        <!-- wp:alepo/modern-cta {"text":"Request Demo","url":"#demo","style":"gradient-shift","icon":"arrow-right"} /-->
        <!-- wp:alepo/modern-cta {"text":"Download Datasheet","url":"#download","style":"glow","icon":"download"} /-->
        <!-- wp:alepo/modern-cta {"text":"Contact Sales","url":"#contact","style":"pulse","icon":"phone"} /-->
        <!-- wp:alepo/modern-cta {"text":"View Documentation","url":"#docs","style":"slide","icon":"external"} /-->
    </div>
    <!-- /wp:group -->
</div>
<!-- /wp:group -->';
}

/**
 * Delete test pages (cleanup function)
 */
function alepo_delete_test_pages() {
    echo "Deleting test pages...\n";
    
    $test_pages = get_posts([
        'post_type' => 'page',
        'meta_key' => '_alepo_test_page',
        'meta_value' => true,
        'posts_per_page' => -1,
        'post_status' => 'any'
    ]);
    
    foreach ($test_pages as $page) {
        wp_delete_post($page->ID, true);
        echo "🗑️  Deleted test page: {$page->post_title} (ID: {$page->ID})\n";
    }
    
    echo "✅ Test page cleanup complete!\n";
}

// Handle command line arguments
if (php_sapi_name() === 'cli') {
    $action = isset($argv[1]) ? $argv[1] : 'create';
    
    switch ($action) {
        case 'create':
            alepo_create_test_pages();
            break;
        case 'delete':
            alepo_delete_test_pages();
            break;
        case 'recreate':
            alepo_delete_test_pages();
            alepo_create_test_pages();
            break;
        default:
            echo "Usage: php create-test-pages.php [create|delete|recreate]\n";
            echo "  create   - Create test pages for modern elements\n";
            echo "  delete   - Delete all test pages\n";
            echo "  recreate - Delete and recreate test pages\n";
            break;
    }
} else {
    // Web execution
    if (current_user_can('manage_options')) {
        alepo_create_test_pages();
    } else {
        echo "Permission denied. Administrator access required.\n";
    }
}
?>
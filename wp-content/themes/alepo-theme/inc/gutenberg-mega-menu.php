<?php
/**
 * Gutenberg-Compatible Mega Menu Content
 * Creates editable blocks for mega menu content in WordPress admin
 */

/**
 * Register mega menu content as custom post type for editing
 */
function alepo_register_mega_menu_content() {
    register_post_type('mega_menu_content', array(
        'labels' => array(
            'name' => 'Mega Menu Content',
            'singular_name' => 'Mega Menu',
            'add_new' => 'Add New Menu',
            'add_new_item' => 'Add New Mega Menu',
            'edit_item' => 'Edit Mega Menu',
            'menu_name' => 'Mega Menus'
        ),
        'public' => false,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_rest' => true,
        'supports' => array('title', 'editor', 'custom-fields'),
        'menu_icon' => 'dashicons-menu-alt3',
        'menu_position' => 25,
        'capability_type' => 'post',
        'has_archive' => false,
        'hierarchical' => false,
    ));
}
add_action('init', 'alepo_register_mega_menu_content');

/**
 * Create default mega menu content posts
 */
function alepo_create_default_mega_menu_content() {
    // Check if content already exists
    $existing = get_posts(array(
        'post_type' => 'mega_menu_content',
        'numberposts' => 1,
        'post_status' => 'any'
    ));
    
    if (!empty($existing)) {
        return; // Content already exists
    }
    
    // Solutions Mega Menu Content
    $solutions_content = alepo_generate_solutions_gutenberg_content();
    wp_insert_post(array(
        'post_title' => 'Solutions Mega Menu',
        'post_name' => 'solutions-mega-menu',
        'post_type' => 'mega_menu_content',
        'post_status' => 'publish',
        'post_content' => $solutions_content,
        'meta_input' => array(
            '_mega_menu_type' => 'solutions',
            '_mega_menu_columns' => '4'
        )
    ));
    
    // Industries Mega Menu Content
    $industries_content = alepo_generate_industries_gutenberg_content();
    wp_insert_post(array(
        'post_title' => 'Industries Mega Menu',
        'post_name' => 'industries-mega-menu',
        'post_type' => 'mega_menu_content',
        'post_status' => 'publish',
        'post_content' => $industries_content,
        'meta_input' => array(
            '_mega_menu_type' => 'industries',
            '_mega_menu_columns' => '2'
        )
    ));
    
    // Resources Mega Menu Content
    $resources_content = alepo_generate_resources_gutenberg_content();
    wp_insert_post(array(
        'post_title' => 'Resources Mega Menu',
        'post_name' => 'resources-mega-menu',
        'post_type' => 'mega_menu_content',
        'post_status' => 'publish',
        'post_content' => $resources_content,
        'meta_input' => array(
            '_mega_menu_type' => 'resources',
            '_mega_menu_columns' => '2'
        )
    ));
    
    // Customers Mega Menu Content
    $customers_content = alepo_generate_customers_gutenberg_content();
    wp_insert_post(array(
        'post_title' => 'Customers Mega Menu',
        'post_name' => 'customers-mega-menu',
        'post_type' => 'mega_menu_content',
        'post_status' => 'publish',
        'post_content' => $customers_content,
        'meta_input' => array(
            '_mega_menu_type' => 'customers',
            '_mega_menu_columns' => '2'
        )
    ));
}

/**
 * Generate Solutions mega menu as Gutenberg blocks
 */
function alepo_generate_solutions_gutenberg_content() {
    return '<!-- wp:group {"className":"mega-menu-header","style":{"spacing":{"padding":{"top":"var(--wp--preset--spacing--50)","bottom":"var(--wp--preset--spacing--30)"}}}} -->
<div class="wp-block-group mega-menu-header" style="padding-top:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--30)">
    <!-- wp:heading {"level":2,"className":"mega-menu-title","style":{"typography":{"fontSize":"0.875rem","textTransform":"uppercase","letterSpacing":"0.05em"},"color":{"text":"#666666"}}} -->
    <h2 class="wp-block-heading mega-menu-title has-text-color" style="color:#666666;font-size:0.875rem;text-transform:uppercase;letter-spacing:0.05em">OUR SOLUTION PORTFOLIO</h2>
    <!-- /wp:heading -->
</div>
<!-- /wp:group -->

<!-- wp:columns {"className":"solutions-grid","style":{"spacing":{"blockGap":{"top":"var(--wp--preset--spacing--50)","left":"var(--wp--preset--spacing--50)"}}}} -->
<div class="wp-block-columns solutions-grid">
    <!-- wp:column {"className":"product-column"} -->
    <div class="wp-block-column product-column">
        <!-- wp:group {"className":"product-header","style":{"spacing":{"margin":{"bottom":"var(--wp--preset--spacing--30)"}}}} -->
        <div class="wp-block-group product-header" style="margin-bottom:var(--wp--preset--spacing--30)">
            <!-- wp:paragraph {"className":"product-icon","style":{"typography":{"fontSize":"1.75rem"}}} -->
            <p class="product-icon" style="font-size:1.75rem">🛡️</p>
            <!-- /wp:paragraph -->
            
            <!-- wp:heading {"level":3,"style":{"typography":{"fontSize":"1rem","fontWeight":"600"},"color":{"text":"#2C3E50"}}} -->
            <h3 class="wp-block-heading has-text-color" style="color:#2C3E50;font-size:1rem;font-weight:600">NETWORK ACCESS CONTROL</h3>
            <!-- /wp:heading -->
        </div>
        <!-- /wp:group -->
        
        <!-- wp:paragraph {"className":"product-tagline","style":{"typography":{"fontSize":"0.8125rem"},"color":{"text":"#666666"},"spacing":{"margin":{"bottom":"var(--wp--preset--spacing--40)"}}}} -->
        <p class="product-tagline has-text-color" style="color:#666666;margin-bottom:var(--wp--preset--spacing--40);font-size:0.8125rem">Secure Every Connection</p>
        <!-- /wp:paragraph -->
        
        <!-- wp:button {"className":"product-overview-btn","style":{"border":{"radius":"8px"},"color":{"text":"#0066CC","background":"#F0F7FF"},"typography":{"fontSize":"0.8125rem","fontWeight":"500"},"spacing":{"padding":{"top":"8px","bottom":"8px","left":"16px","right":"16px"},"margin":{"bottom":"var(--wp--preset--spacing--40)"}}}} -->
        <div class="wp-block-button product-overview-btn"><a class="wp-block-button__link has-text-color has-background wp-element-button" href="/solutions/network-access-control" style="border-radius:8px;color:#0066CC;background-color:#F0F7FF;padding-top:8px;padding-right:16px;padding-bottom:8px;padding-left:16px;margin-bottom:var(--wp--preset--spacing--40);font-size:0.8125rem;font-weight:500">Solution Overview</a></div>
        <!-- /wp:button -->
        
        <!-- wp:heading {"level":4,"style":{"typography":{"fontSize":"0.8125rem","fontWeight":"600"},"spacing":{"margin":{"bottom":"var(--wp--preset--spacing--20)"}}}} -->
        <h4 class="wp-block-heading" style="margin-bottom:var(--wp--preset--spacing--20);font-size:0.8125rem;font-weight:600">Highlights:</h4>
        <!-- /wp:heading -->
        
        <!-- wp:list {"className":"feature-list","style":{"typography":{"fontSize":"0.8125rem"},"spacing":{"padding":{"left":"0"}}}} -->
        <ul class="wp-block-list feature-list" style="padding-left:0;font-size:0.8125rem">
            <!-- wp:list-item -->
            <li><a href="/products/aaa-server">AAA Server</a></li>
            <!-- /wp:list-item -->
            
            <!-- wp:list-item -->
            <li>RADIUS, Diameter, TACACS+</li>
            <!-- /wp:list-item -->
            
            <!-- wp:list-item -->
            <li><a href="/products/5g-ausf">AUSF for 5G Authentication</a></li>
            <!-- /wp:list-item -->
            
            <!-- wp:list-item -->
            <li>99.999% Uptime</li>
            <!-- /wp:list-item -->
        </ul>
        <!-- /wp:list -->
        
        <!-- wp:group {"className":"stat-card","style":{"spacing":{"padding":{"top":"var(--wp--preset--spacing--40)","bottom":"var(--wp--preset--spacing--40)","left":"var(--wp--preset--spacing--40)","right":"var(--wp--preset--spacing--40)"},"margin":{"top":"var(--wp--preset--spacing--40)"}},\"border\":{\"radius\":\"10px\"},\"color\":{\"background\":\"#E3F2FD\"}}} -->
        <div class="wp-block-group stat-card has-background" style="border-radius:10px;background-color:#E3F2FD;margin-top:var(--wp--preset--spacing--40);padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)">
            <!-- wp:paragraph {"align":"center","className":"stat","style":{"typography":{"fontSize":"1.5rem","fontWeight":"700"},"color":{"text":"#0066CC"}}} -->
            <p class="has-text-align-center stat has-text-color" style="color:#0066CC;font-size:1.5rem;font-weight:700">36,000 TPS</p>
            <!-- /wp:paragraph -->
            
            <!-- wp:paragraph {"align":"center","className":"label","style":{"typography":{"fontSize":"0.75rem","fontWeight":"500"},"color":{"text":"#666666"}}} -->
            <p class="has-text-align-center label has-text-color" style="color:#666666;font-size:0.75rem;font-weight:500">Transaction Speed</p>
            <!-- /wp:paragraph -->
        </div>
        <!-- /wp:group -->
    </div>
    <!-- /wp:column -->
    
    <!-- wp:column {"className":"product-column"} -->
    <div class="wp-block-column product-column">
        <!-- wp:group {"className":"product-header","style":{"spacing":{"margin":{"bottom":"var(--wp--preset--spacing--30)"}}}} -->
        <div class="wp-block-group product-header" style="margin-bottom:var(--wp--preset--spacing--30)">
            <!-- wp:paragraph {"className":"product-icon","style":{"typography":{"fontSize":"1.75rem"}}} -->
            <p class="product-icon" style="font-size:1.75rem">💼</p>
            <!-- /wp:paragraph -->
            
            <!-- wp:heading {"level":3,"style":{"typography":{"fontSize":"1rem","fontWeight":"600"},"color":{"text":"#2C3E50"}}} -->
            <h3 class="wp-block-heading has-text-color" style="color:#2C3E50;font-size:1rem;font-weight:600">DIGITAL BSS</h3>
            <!-- /wp:heading -->
        </div>
        <!-- /wp:group -->
        
        <!-- wp:paragraph {"className":"product-tagline","style":{"typography":{"fontSize":"0.8125rem"},"color":{"text":"#666666"},"spacing":{"margin":{"bottom":"var(--wp--preset--spacing--40)"}}}} -->
        <p class="product-tagline has-text-color" style="color:#666666;margin-bottom:var(--wp--preset--spacing--40);font-size:0.8125rem">Complete Business Support System</p>
        <!-- /wp:paragraph -->
        
        <!-- wp:button {"className":"product-overview-btn","style":{"border":{"radius":"8px"},"color":{"text":"#0066CC","background":"#F0F7FF"},"typography":{"fontSize":"0.8125rem","fontWeight":"500"},"spacing":{"padding":{"top":"8px","bottom":"8px","left":"16px","right":"16px"},"margin":{"bottom":"var(--wp--preset--spacing--40)"}}}} -->
        <div class="wp-block-button product-overview-btn"><a class="wp-block-button__link has-text-color has-background wp-element-button" href="/products/digital-bss" style="border-radius:8px;color:#0066CC;background-color:#F0F7FF;padding-top:8px;padding-right:16px;padding-bottom:8px;padding-left:16px;margin-bottom:var(--wp--preset--spacing--40);font-size:0.8125rem;font-weight:500">Solution Overview</a></div>
        <!-- /wp:button -->
        
        <!-- wp:heading {"level":4,"style":{"typography":{"fontSize":"0.8125rem","fontWeight":"600"},"spacing":{"margin":{"bottom":"var(--wp--preset--spacing--20)"}}}} -->
        <h4 class="wp-block-heading" style="margin-bottom:var(--wp--preset--spacing--20);font-size:0.8125rem;font-weight:600">Highlights:</h4>
        <!-- /wp:heading -->
        
        <!-- wp:list {"className":"feature-list","style":{"typography":{"fontSize":"0.8125rem"},"spacing":{"padding":{"left":"0"}}}} -->
        <ul class="wp-block-list feature-list" style="padding-left:0;font-size:0.8125rem">
            <!-- wp:list-item -->
            <li>Convergent Charging</li>
            <!-- /wp:list-item -->
            
            <!-- wp:list-item -->
            <li>Customer Management</li>
            <!-- /wp:list-item -->
            
            <!-- wp:list-item -->
            <li>Product Catalog</li>
            <!-- /wp:list-item -->
            
            <!-- wp:list-item -->
            <li>Real-time Analytics</li>
            <!-- /wp:list-item -->
        </ul>
        <!-- /wp:list -->
        
        <!-- wp:group {"className":"stat-card bss-now","style":{"spacing":{"padding":{"top":"var(--wp--preset--spacing--40)","bottom":"var(--wp--preset--spacing--40)","left":"var(--wp--preset--spacing--40)","right":"var(--wp--preset--spacing--40)"},"margin":{"top":"var(--wp--preset--spacing--40)"}},\"border\":{\"radius\":\"10px\"},\"color\":{\"background\":\"#E8F5E9\"}}} -->
        <div class="wp-block-group stat-card bss-now has-background" style="border-radius:10px;background-color:#E8F5E9;margin-top:var(--wp--preset--spacing--40);padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)">
            <!-- wp:paragraph {"align":"center","className":"stat","style":{"typography":{"fontSize":"1.5rem","fontWeight":"700"},"color":{"text":"#00C851"}}} -->
            <p class="has-text-align-center stat has-text-color" style="color:#00C851;font-size:1.5rem;font-weight:700">BSS Now</p>
            <!-- /wp:paragraph -->
            
            <!-- wp:paragraph {"align":"center","className":"label","style":{"typography":{"fontSize":"0.75rem","fontWeight":"500"},"color":{"text":"#666666"}}} -->
            <p class="has-text-align-center label has-text-color" style="color:#666666;font-size:0.75rem;font-weight:500">SaaS - Launch in 30 days</p>
            <!-- /wp:paragraph -->
        </div>
        <!-- /wp:group -->
    </div>
    <!-- /wp:column -->
    
    <!-- wp:column {"className":"product-column"} -->
    <div class="wp-block-column product-column">
        <!-- wp:group {"className":"product-header","style":{"spacing":{"margin":{"bottom":"var(--wp--preset--spacing--30)"}}}} -->
        <div class="wp-block-group product-header" style="margin-bottom:var(--wp--preset--spacing--30)">
            <!-- wp:paragraph {"className":"product-icon","style":{"typography":{"fontSize":"1.75rem"}}} -->
            <p class="product-icon" style="font-size:1.75rem">🤖</p>
            <!-- /wp:paragraph -->
            
            <!-- wp:heading {"level":3,"style":{"typography":{"fontSize":"1rem","fontWeight":"600"},"color":{"text":"#2C3E50"}}} -->
            <h3 class="wp-block-heading has-text-color" style="color:#2C3E50;font-size:1rem;font-weight:600">AI-POWERED CX</h3>
            <!-- /wp:heading -->
        </div>
        <!-- /wp:group -->
        
        <!-- wp:paragraph {"className":"product-tagline","style":{"typography":{"fontSize":"0.8125rem"},"color":{"text":"#666666"},"spacing":{"margin":{"bottom":"var(--wp--preset--spacing--40)"}}}} -->
        <p class="product-tagline has-text-color" style="color:#666666;margin-bottom:var(--wp--preset--spacing--40);font-size:0.8125rem">Transform Customer Engagement</p>
        <!-- /wp:paragraph -->
        
        <!-- wp:button {"className":"product-overview-btn","style":{"border":{"radius":"8px"},"color":{"text":"#0066CC","background":"#F0F7FF"},"typography":{"fontSize":"0.8125rem","fontWeight":"500"},"spacing":{"padding":{"top":"8px","bottom":"8px","left":"16px","right":"16px"},"margin":{"bottom":"var(--wp--preset--spacing--40)"}}}} -->
        <div class="wp-block-button product-overview-btn"><a class="wp-block-button__link has-text-color has-background wp-element-button" href="/products/ai-customer-assistant" style="border-radius:8px;color:#0066CC;background-color:#F0F7FF;padding-top:8px;padding-right:16px;padding-bottom:8px;padding-left:16px;margin-bottom:var(--wp--preset--spacing--40);font-size:0.8125rem;font-weight:500">Solution Overview</a></div>
        <!-- /wp:button -->
        
        <!-- wp:heading {"level":4,"style":{"typography":{"fontSize":"0.8125rem","fontWeight":"600"},"spacing":{"margin":{"bottom":"var(--wp--preset--spacing--20)"}}}} -->
        <h4 class="wp-block-heading" style="margin-bottom:var(--wp--preset--spacing--20);font-size:0.8125rem;font-weight:600">Highlights:</h4>
        <!-- /wp:heading -->
        
        <!-- wp:list {"className":"feature-list","style":{"typography":{"fontSize":"0.8125rem"},"spacing":{"padding":{"left":"0"}}}} -->
        <ul class="wp-block-list feature-list" style="padding-left:0;font-size:0.8125rem">
            <!-- wp:list-item -->
            <li>AI Customer Assistant</li>
            <!-- /wp:list-item -->
            
            <!-- wp:list-item -->
            <li>AI Agent Assistant</li>
            <!-- /wp:list-item -->
            
            <!-- wp:list-item -->
            <li>Digital Self-Care Suite</li>
            <!-- /wp:list-item -->
            
            <!-- wp:list-item -->
            <li>100+ Language Support</li>
            <!-- /wp:list-item -->
        </ul>
        <!-- /wp:list -->
        
        <!-- wp:group {"className":"stat-card","style":{"spacing":{"padding":{"top":"var(--wp--preset--spacing--40)","bottom":"var(--wp--preset--spacing--40)","left":"var(--wp--preset--spacing--40)","right":"var(--wp--preset--spacing--40)"},"margin":{"top":"var(--wp--preset--spacing--40)"}},\"border\":{\"radius\":\"10px\"},\"color\":{\"background\":\"#E3F2FD\"}}} -->
        <div class="wp-block-group stat-card has-background" style="border-radius:10px;background-color:#E3F2FD;margin-top:var(--wp--preset--spacing--40);padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)">
            <!-- wp:paragraph {"align":"center","className":"stat","style":{"typography":{"fontSize":"1.5rem","fontWeight":"700"},"color":{"text":"#0066CC"}}} -->
            <p class="has-text-align-center stat has-text-color" style="color:#0066CC;font-size:1.5rem;font-weight:700">90%</p>
            <!-- /wp:paragraph -->
            
            <!-- wp:paragraph {"align":"center","className":"label","style":{"typography":{"fontSize":"0.75rem","fontWeight":"500"},"color":{"text":"#666666"}}} -->
            <p class="has-text-align-center label has-text-color" style="color:#666666;font-size:0.75rem;font-weight:500">Resolution Rate</p>
            <!-- /wp:paragraph -->
        </div>
        <!-- /wp:group -->
    </div>
    <!-- /wp:column -->
    
    <!-- wp:column {"className":"quick-links-section"} -->
    <div class="wp-block-column quick-links-section">
        <!-- wp:group {"className":"quick-links-header","style":{"spacing":{"padding":{"top":"var(--wp--preset--spacing--40)","bottom":"var(--wp--preset--spacing--40)","left":"var(--wp--preset--spacing--50)","right":"var(--wp--preset--spacing--50)"}},\"color\":{\"background\":\"#34495E\"}}} -->
        <div class="wp-block-group quick-links-header has-background" style="background-color:#34495E;padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--50)">
            <!-- wp:heading {"level":3,"style":{"typography":{"fontSize":"0.9375rem","fontWeight":"600"},"color":{"text":"#ffffff"}}} -->
            <h3 class="wp-block-heading has-text-color" style="color:#ffffff;font-size:0.9375rem;font-weight:600">🚀 Quick Access</h3>
            <!-- /wp:heading -->
        </div>
        <!-- /wp:group -->
        
        <!-- wp:group {"className":"quick-links-content","style":{"spacing":{"padding":{"top":"var(--wp--preset--spacing--30)","bottom":"var(--wp--preset--spacing--30)","left":"var(--wp--preset--spacing--30)","right":"var(--wp--preset--spacing--30)"}},\"color\":{\"background\":\"#2C3E50\"}}} -->
        <div class="wp-block-group quick-links-content has-background" style="background-color:#2C3E50;padding-top:var(--wp--preset--spacing--30);padding-right:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--30);padding-left:var(--wp--preset--spacing--30)">
            <!-- wp:list {"className":"quick-links-list","style":{"typography":{"fontSize":"0.875rem"},"spacing":{"padding":{"left":"0"}}}} -->
            <ul class="wp-block-list quick-links-list" style="padding-left:0;font-size:0.875rem">
                <!-- wp:list-item -->
                <li><a href="/resources/roi-calculator" style="color:#ffffff;text-decoration:none">📊 ROI Calculator</a></li>
                <!-- /wp:list-item -->
                
                <!-- wp:list-item -->
                <li><a href="/request-demo" style="color:#ffffff;text-decoration:none">📅 Schedule Consultation</a></li>
                <!-- /wp:list-item -->
                
                <!-- wp:list-item -->
                <li><a href="/resources/solution-finder" style="color:#ffffff;text-decoration:none">📄 Solution Finder Quiz</a></li>
                <!-- /wp:list-item -->
                
                <!-- wp:list-item -->
                <li><a href="/security" style="color:#ffffff;text-decoration:none">🔒 Security</a></li>
                <!-- /wp:list-item -->
                
                <!-- wp:list-item -->
                <li><a href="/integrations" style="color:#ffffff;text-decoration:none">🔗 Integrations</a></li>
                <!-- /wp:list-item -->
                
                <!-- wp:list-item -->
                <li><a href="/contact" style="color:#ffffff;text-decoration:none">💬 Live Chat</a></li>
                <!-- /wp:list-item -->
            </ul>
            <!-- /wp:list -->
        </div>
        <!-- /wp:group -->
    </div>
    <!-- /wp:column -->
</div>
<!-- /wp:columns -->

<!-- wp:group {"className":"solutions-mega-footer","style":{"spacing":{"padding":{"top":"var(--wp--preset--spacing--50)","bottom":"var(--wp--preset--spacing--50)","left":"var(--wp--preset--spacing--50)","right":"var(--wp--preset--spacing--50)"}},\"color\":{\"background\":\"#E8F2FF\"}}} -->
<div class="wp-block-group solutions-mega-footer has-background" style="background-color:#E8F2FF;padding-top:var(--wp--preset--spacing--50);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--50)">
    <!-- wp:paragraph {"align":"center","style":{"typography":{"fontWeight":"600"},"color":{"text":"#2C3E50"}}} -->
    <p class="has-text-align-center has-text-color" style="color:#2C3E50;font-weight:600">Other Solutions: 
        <a href="/solutions/carrier-wifi" style="color:#0066CC;margin:0 8px">Carrier Wi-Fi</a>
        <a href="/solutions/pcf" style="color:#0066CC;margin:0 8px">PCF</a>
        <a href="/solutions/sdm" style="color:#0066CC;margin:0 8px">SDM</a>
    </p>
    <!-- /wp:paragraph -->
</div>
<!-- /wp:group -->';
}

/**
 * Generate other mega menu content functions
 */
function alepo_generate_industries_gutenberg_content() {
    return '<!-- wp:group {"className":"mega-menu-header","style":{"spacing":{"padding":{"top":"var(--wp--preset--spacing--50)","bottom":"var(--wp--preset--spacing--30)"}}}} -->
<div class="wp-block-group mega-menu-header" style="padding-top:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--30)">
    <!-- wp:heading {"level":2,"className":"mega-menu-title","style":{"typography":{"fontSize":"0.875rem","textTransform":"uppercase","letterSpacing":"0.05em"},"color":{"text":"#666666"}}} -->
    <h2 class="wp-block-heading mega-menu-title has-text-color" style="color:#666666;font-size:0.875rem;text-transform:uppercase;letter-spacing:0.05em">SOLUTIONS BY INDUSTRY</h2>
    <!-- /wp:heading -->
</div>
<!-- /wp:group -->

<!-- wp:columns {"className":"industries-grid","style":{"spacing":{"blockGap":{"top":"var(--wp--preset--spacing--50)","left":"var(--wp--preset--spacing--50)"}}}} -->
<div class="wp-block-columns industries-grid">
    <!-- wp:column {"className":"industry-card"} -->
    <div class="wp-block-column industry-card">
        <!-- wp:paragraph {"className":"industry-icon","style":{"typography":{"fontSize":"3rem"}}} -->
        <p class="industry-icon" style="font-size:3rem">📱</p>
        <!-- /wp:paragraph -->
        
        <!-- wp:heading {"level":4,"style":{"typography":{"fontSize":"0.875rem","fontWeight":"600"},"color":{"text":"#2C3E50"}}} -->
        <h4 class="wp-block-heading has-text-color" style="color:#2C3E50;font-size:0.875rem;font-weight:600">Mobile Network Operators</h4>
        <!-- /wp:heading -->
        
        <!-- wp:paragraph {"style":{"typography":{"fontSize":"0.75rem"},"color":{"text":"#666666"}}} -->
        <p class="has-text-color" style="color:#666666;font-size:0.75rem">Tier-1 to regional MNOs</p>
        <!-- /wp:paragraph -->
        
        <!-- wp:paragraph -->
        <p><a href="/industries/mobile-operators">View MNO Solutions</a></p>
        <!-- /wp:paragraph -->
    </div>
    <!-- /wp:column -->
    
    <!-- wp:column {"className":"industry-card"} -->
    <div class="wp-block-column industry-card">
        <!-- wp:paragraph {"className":"industry-icon","style":{"typography":{"fontSize":"3rem"}}} -->
        <p class="industry-icon" style="font-size:3rem">🌐</p>
        <!-- /wp:paragraph -->
        
        <!-- wp:heading {"level":4,"style":{"typography":{"fontSize":"0.875rem","fontWeight":"600"},"color":{"text":"#2C3E50"}}} -->
        <h4 class="wp-block-heading has-text-color" style="color:#2C3E50;font-size:0.875rem;font-weight:600">ISPs</h4>
        <!-- /wp:heading -->
        
        <!-- wp:paragraph {"style":{"typography":{"fontSize":"0.75rem"},"color":{"text":"#666666"}}} -->
        <p class="has-text-color" style="color:#666666;font-size:0.75rem">Regional & national providers</p>
        <!-- /wp:paragraph -->
        
        <!-- wp:paragraph -->
        <p><a href="/industries/internet-service-providers">View ISP Solutions</a></p>
        <!-- /wp:paragraph -->
    </div>
    <!-- /wp:column -->
    
    <!-- wp:column {"className":"industry-card"} -->
    <div class="wp-block-column industry-card">
        <!-- wp:paragraph {"className":"industry-icon","style":{"typography":{"fontSize":"3rem"}}} -->
        <p class="industry-icon" style="font-size:3rem">📡</p>
        <!-- /wp:paragraph -->
        
        <!-- wp:heading {"level":4,"style":{"typography":{"fontSize":"0.875rem","fontWeight":"600"},"color":{"text":"#2C3E50"}}} -->
        <h4 class="wp-block-heading has-text-color" style="color:#2C3E50;font-size:0.875rem;font-weight:600">Cable & Broadband</h4>
        <!-- /wp:heading -->
        
        <!-- wp:paragraph {"style":{"typography":{"fontSize":"0.75rem"},"color":{"text":"#666666"}}} -->
        <p class="has-text-color" style="color:#666666;font-size:0.75rem">Fiber & cable operators</p>
        <!-- /wp:paragraph -->
        
        <!-- wp:paragraph -->
        <p><a href="/industries/cable-broadband">View Cable Solutions</a></p>
        <!-- /wp:paragraph -->
    </div>
    <!-- /wp:column -->
    
    <!-- wp:column {"className":"industry-card"} -->
    <div class="wp-block-column industry-card">
        <!-- wp:paragraph {"className":"industry-icon","style":{"typography":{"fontSize":"3rem"}}} -->
        <p class="industry-icon" style="font-size:3rem">🚀</p>
        <!-- /wp:paragraph -->
        
        <!-- wp:heading {"level":4,"style":{"typography":{"fontSize":"0.875rem","fontWeight":"600"},"color":{"text":"#2C3E50"}}} -->
        <h4 class="wp-block-heading has-text-color" style="color:#2C3E50;font-size:0.875rem;font-weight:600">MVNOs</h4>
        <!-- /wp:heading -->
        
        <!-- wp:paragraph {"style":{"typography":{"fontSize":"0.75rem"},"color":{"text":"#666666"}}} -->
        <p class="has-text-color" style="color:#666666;font-size:0.75rem">Quick launch solutions</p>
        <!-- /wp:paragraph -->
        
        <!-- wp:paragraph -->
        <p><a href="/industries/mvno">View MVNO Solutions</a></p>
        <!-- /wp:paragraph -->
    </div>
    <!-- /wp:column -->
    
    <!-- wp:column {"className":"industry-card"} -->
    <div class="wp-block-column industry-card">
        <!-- wp:paragraph {"className":"industry-icon","style":{"typography":{"fontSize":"3rem"}}} -->
        <p class="industry-icon" style="font-size:3rem">🎧</p>
        <!-- /wp:paragraph -->
        
        <!-- wp:heading {"level":4,"style":{"typography":{"fontSize":"0.875rem","fontWeight":"600"},"color":{"text":"#2C3E50"}}} -->
        <h4 class="wp-block-heading has-text-color" style="color:#2C3E50;font-size:0.875rem;font-weight:600">CCaaS</h4>
        <!-- /wp:heading -->
        
        <!-- wp:paragraph {"style":{"typography":{"fontSize":"0.75rem"},"color":{"text":"#666666"}}} -->
        <p class="has-text-color" style="color:#666666;font-size:0.75rem">Enhances service with Voice AI</p>
        <!-- /wp:paragraph -->
        
        <!-- wp:paragraph -->
        <p><a href="/industries/ccaas">View CCaaS Solutions</a></p>
        <!-- /wp:paragraph -->
    </div>
    <!-- /wp:column -->
    
    <!-- wp:column {"className":"industry-card"} -->
    <div class="wp-block-column industry-card">
        <!-- wp:paragraph {"className":"industry-icon","style":{"typography":{"fontSize":"3rem"}}} -->
        <p class="industry-icon" style="font-size:3rem">🏛️</p>
        <!-- /wp:paragraph -->
        
        <!-- wp:heading {"level":4,"style":{"typography":{"fontSize":"0.875rem","fontWeight":"600"},"color":{"text":"#2C3E50"}}} -->
        <h4 class="wp-block-heading has-text-color" style="color:#2C3E50;font-size:0.875rem;font-weight:600">Gov & Smart Cities</h4>
        <!-- /wp:heading -->
        
        <!-- wp:paragraph {"style":{"typography":{"fontSize":"0.75rem"},"color":{"text":"#666666"}}} -->
        <p class="has-text-color" style="color:#666666;font-size:0.75rem">Secure citizen services</p>
        <!-- /wp:paragraph -->
        
        <!-- wp:paragraph -->
        <p><a href="/industries/government-smart-cities">View Gov Solutions</a></p>
        <!-- /wp:paragraph -->
    </div>
    <!-- /wp:column -->
</div>
<!-- /wp:columns -->

<!-- wp:group {"className":"success-story","style":{"spacing":{"padding":{"top":"var(--wp--preset--spacing--50)","bottom":"var(--wp--preset--spacing--50)","left":"var(--wp--preset--spacing--50)","right":"var(--wp--preset--spacing--50)"},"margin":{"top":"var(--wp--preset--spacing--50)"}},"color":{"background":"#F5F7FA"}}} -->
<div class="wp-block-group success-story has-background" style="background-color:#F5F7FA;margin-top:var(--wp--preset--spacing--50);padding-top:var(--wp--preset--spacing--50);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--50)">
    <!-- wp:columns -->
    <div class="wp-block-columns">
        <!-- wp:column {"width":"140px"} -->
        <div class="wp-block-column" style="flex-basis:140px">
            <!-- wp:group {"className":"story-logo","style":{"spacing":{"padding":{"top":"var(--wp--preset--spacing--40)","bottom":"var(--wp--preset--spacing--40)","left":"var(--wp--preset--spacing--40)","right":"var(--wp--preset--spacing--40)"}},"color":{"background":"#ffffff"},"border":{"radius":"12px"}}} -->
            <div class="wp-block-group story-logo has-background" style="border-radius:12px;background-color:#ffffff;padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)">
                <!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"1.5rem","fontWeight":"700"},"color":{"text":"#0066CC"}}} -->
                <p class="has-text-align-center has-text-color" style="color:#0066CC;font-size:1.5rem;font-weight:700">SaskTel</p>
                <!-- /wp:paragraph -->
            </div>
            <!-- /wp:group -->
        </div>
        <!-- /wp:column -->
        
        <!-- wp:column -->
        <div class="wp-block-column">
            <!-- wp:paragraph {"className":"story-quote","style":{"typography":{"fontStyle":"italic","fontSize":"1rem","fontWeight":"500"},"color":{"text":"#2C3E50"}}} -->
            <p class="story-quote has-text-color" style="color:#2C3E50;font-size:1rem;font-style:italic;font-weight:500">"Alepo\'s solutions enabled us to reduce operational costs by 40% while improving customer satisfaction to 65% NPS"</p>
            <!-- /wp:paragraph -->
            
            <!-- wp:paragraph {"className":"story-attribution","style":{"typography":{"fontSize":"0.875rem"},"color":{"text":"#666666"}}} -->
            <p class="story-attribution has-text-color" style="color:#666666;font-size:0.875rem"><strong>CTO, Major Operator</strong> • Saskatchewan, Canada</p>
            <!-- /wp:paragraph -->
            
            <!-- wp:button {"className":"story-cta","style":{"color":{"text":"#0066CC","background":"#ffffff"},"border":{"radius":"6px"},"spacing":{"padding":{"top":"8px","bottom":"8px","left":"16px","right":"16px"}}}} -->
            <div class="wp-block-button story-cta"><a class="wp-block-button__link has-text-color has-background wp-element-button" href="/case-studies/sasktel" style="border-radius:6px;color:#0066CC;background-color:#ffffff;padding-top:8px;padding-right:16px;padding-bottom:8px;padding-left:16px">Read Full Case Study →</a></div>
            <!-- /wp:button -->
        </div>
        <!-- /wp:column -->
    </div>
    <!-- /wp:columns -->
</div>
<!-- /wp:group -->';
}

function alepo_generate_resources_gutenberg_content() {
    return '<!-- wp:group {"className":"mega-menu-header","style":{"spacing":{"padding":{"top":"var(--wp--preset--spacing--50)","bottom":"var(--wp--preset--spacing--30)"}}}} -->
<div class="wp-block-group mega-menu-header" style="padding-top:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--30)">
    <!-- wp:heading {"level":2,"className":"mega-menu-title","style":{"typography":{"fontSize":"0.875rem","textTransform":"uppercase","letterSpacing":"0.05em"},"color":{"text":"#666666"}}} -->
    <h2 class="wp-block-heading mega-menu-title has-text-color" style="color:#666666;font-size:0.875rem;text-transform:uppercase;letter-spacing:0.05em">EXPLORE OUR RESOURCES</h2>
    <!-- /wp:heading -->
</div>
<!-- /wp:group -->

<!-- wp:columns {"className":"resources-grid","style":{"spacing":{"blockGap":{"top":"var(--wp--preset--spacing--50)","left":"var(--wp--preset--spacing--50)"}}}} -->
<div class="wp-block-columns resources-grid">
    <!-- wp:column {"className":"resources-section clean-nav"} -->
    <div class="wp-block-column resources-section clean-nav">
        <!-- wp:list {"className":"clean-nav-list","style":{"typography":{"fontSize":"0.875rem"},"spacing":{"padding":{"left":"0"}}}} -->
        <ul class="wp-block-list clean-nav-list" style="padding-left:0;font-size:0.875rem">
            <!-- wp:list-item -->
            <li><a href="/resources">Resource Library</a></li>
            <!-- /wp:list-item -->
            
            <!-- wp:list-item -->
            <li><a href="/resources/blog">Blog</a></li>
            <!-- /wp:list-item -->
            
            <!-- wp:list-item -->
            <li><a href="/resources/roi-calculator">ROI Tools</a></li>
            <!-- /wp:list-item -->
            
            <!-- wp:list-item -->
            <li><a href="/events">Events</a></li>
            <!-- /wp:list-item -->
            
            <!-- wp:list-item -->
            <li><a href="/news">News</a></li>
            <!-- /wp:list-item -->
        </ul>
        <!-- /wp:list -->
    </div>
    <!-- /wp:column -->
    
    <!-- wp:column {"className":"resources-section featured-blog"} -->
    <div class="wp-block-column resources-section featured-blog">
        <!-- wp:group {"className":"featured-blog-post","style":{"spacing":{"margin":{"bottom":"var(--wp--preset--spacing--40)"}},"border":{"radius":"8px"},"color":{"background":"#F8F9FA"}}} -->
        <div class="wp-block-group featured-blog-post has-background" style="border-radius:8px;background-color:#F8F9FA;margin-bottom:var(--wp--preset--spacing--40)">
            <!-- wp:paragraph {"className":"featured-badge","style":{"typography":{"fontSize":"0.75rem","fontWeight":"600"},"color":{"text":"#0066CC","background":"#E3F2FD"},"spacing":{"padding":{"top":"4px","bottom":"4px","left":"8px","right":"8px"}},"border":{"radius":"4px"}}} -->
            <p class="featured-badge has-text-color has-background" style="border-radius:4px;color:#0066CC;background-color:#E3F2FD;padding-top:4px;padding-right:8px;padding-bottom:4px;padding-left:8px;font-size:0.75rem;font-weight:600">FEATURED</p>
            <!-- /wp:paragraph -->
            
            <!-- wp:group {"className":"blog-image-placeholder","style":{"spacing":{"padding":{"top":"var(--wp--preset--spacing--50)","bottom":"var(--wp--preset--spacing--50)"}},"color":{"background":"#E8F2FF"},"border":{"radius":"6px"}}} -->
            <div class="wp-block-group blog-image-placeholder has-background" style="border-radius:6px;background-color:#E8F2FF;padding-top:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50)">
                <!-- wp:paragraph {"align":"center","style":{"color":{"text":"#666666"}}} -->
                <p class="has-text-align-center has-text-color" style="color:#666666">[Blog Image]</p>
                <!-- /wp:paragraph -->
            </div>
            <!-- /wp:group -->
            
            <!-- wp:group {"className":"blog-content","style":{"spacing":{"padding":{"top":"var(--wp--preset--spacing--30)","bottom":"var(--wp--preset--spacing--30)","left":"var(--wp--preset--spacing--30)","right":"var(--wp--preset--spacing--30)"}}}} -->
            <div class="wp-block-group blog-content" style="padding-top:var(--wp--preset--spacing--30);padding-right:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--30);padding-left:var(--wp--preset--spacing--30)">
                <!-- wp:heading {"level":4,"style":{"typography":{"fontSize":"0.875rem","fontWeight":"600"},"color":{"text":"#2C3E50"}}} -->
                <h4 class="wp-block-heading has-text-color" style="color:#2C3E50;font-size:0.875rem;font-weight:600">How AI is Revolutionizing Telecom Customer Service</h4>
                <!-- /wp:heading -->
                
                <!-- wp:paragraph {"style":{"typography":{"fontSize":"0.75rem"},"color":{"text":"#666666"}}} -->
                <p class="has-text-color" style="color:#666666;font-size:0.75rem">5 min read • Dec 2024</p>
                <!-- /wp:paragraph -->
            </div>
            <!-- /wp:group -->
        </div>
        <!-- /wp:group -->
        
        <!-- wp:group {"className":"featured-blog-post","style":{"spacing":{"margin":{"bottom":"var(--wp--preset--spacing--40)"}},"border":{"radius":"8px"},"color":{"background":"#F8F9FA"}}} -->
        <div class="wp-block-group featured-blog-post has-background" style="border-radius:8px;background-color:#F8F9FA;margin-bottom:var(--wp--preset--spacing--40)">
            <!-- wp:paragraph {"className":"featured-badge","style":{"typography":{"fontSize":"0.75rem","fontWeight":"600"},"color":{"text":"#0066CC","background":"#E3F2FD"},"spacing":{"padding":{"top":"4px","bottom":"4px","left":"8px","right":"8px"}},"border":{"radius":"4px"}}} -->
            <p class="featured-badge has-text-color has-background" style="border-radius:4px;color:#0066CC;background-color:#E3F2FD;padding-top:4px;padding-right:8px;padding-bottom:4px;padding-left:8px;font-size:0.75rem;font-weight:600">FEATURED</p>
            <!-- /wp:paragraph -->
            
            <!-- wp:group {"className":"blog-image-placeholder","style":{"spacing":{"padding":{"top":"var(--wp--preset--spacing--50)","bottom":"var(--wp--preset--spacing--50)"}},"color":{"background":"#E8F2FF"},"border":{"radius":"6px"}}} -->
            <div class="wp-block-group blog-image-placeholder has-background" style="border-radius:6px;background-color:#E8F2FF;padding-top:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50)">
                <!-- wp:paragraph {"align":"center","style":{"color":{"text":"#666666"}}} -->
                <p class="has-text-align-center has-text-color" style="color:#666666">[ROI Tool Image]</p>
                <!-- /wp:paragraph -->
            </div>
            <!-- /wp:group -->
            
            <!-- wp:group {"className":"blog-content","style":{"spacing":{"padding":{"top":"var(--wp--preset--spacing--30)","bottom":"var(--wp--preset--spacing--30)","left":"var(--wp--preset--spacing--30)","right":"var(--wp--preset--spacing--30)"}}}} -->
            <div class="wp-block-group blog-content" style="padding-top:var(--wp--preset--spacing--30);padding-right:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--30);padding-left:var(--wp--preset--spacing--30)">
                <!-- wp:heading {"level":4,"style":{"typography":{"fontSize":"0.875rem","fontWeight":"600"},"color":{"text":"#2C3E50"}}} -->
                <h4 class="wp-block-heading has-text-color" style="color:#2C3E50;font-size:0.875rem;font-weight:600">Featured ROI tool and Description here</h4>
                <!-- /wp:heading -->
                
                <!-- wp:paragraph {"style":{"typography":{"fontSize":"0.75rem"},"color":{"text":"#666666"}}} -->
                <p class="has-text-color" style="color:#666666;font-size:0.75rem">Interactive calculator • Nov 2024</p>
                <!-- /wp:paragraph -->
            </div>
            <!-- /wp:group -->
        </div>
        <!-- /wp:group -->
    </div>
    <!-- /wp:column -->
</div>
<!-- /wp:columns -->

<!-- wp:group {"className":"resources-mega-footer","style":{"spacing":{"padding":{"top":"var(--wp--preset--spacing--50)","bottom":"var(--wp--preset--spacing--50)","left":"var(--wp--preset--spacing--50)","right":"var(--wp--preset--spacing--50)"}},"color":{"background":"#E8F2FF"}}} -->
<div class="wp-block-group resources-mega-footer has-background" style="background-color:#E8F2FF;padding-top:var(--wp--preset--spacing--50);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--50)">
    <!-- wp:columns -->
    <div class="wp-block-columns">
        <!-- wp:column {"width":"60%"} -->
        <div class="wp-block-column" style="flex-basis:60%">
            <!-- wp:heading {"level":4,"style":{"typography":{"fontSize":"1rem","fontWeight":"600"},"color":{"text":"#2C3E50"}}} -->
            <h4 class="wp-block-heading has-text-color" style="color:#2C3E50;font-size:1rem;font-weight:600">📧 Stay Updated</h4>
            <!-- /wp:heading -->
            
            <!-- wp:paragraph {"style":{"typography":{"fontSize":"0.875rem"},"color":{"text":"#666666"}}} -->
            <p class="has-text-color" style="color:#666666;font-size:0.875rem">Get the latest telco insights delivered to your inbox</p>
            <!-- /wp:paragraph -->
        </div>
        <!-- /wp:column -->
        
        <!-- wp:column {"width":"40%"} -->
        <div class="wp-block-column" style="flex-basis:40%">
            <!-- wp:group {"className":"newsletter-form","style":{"spacing":{"blockGap":"var(--wp--preset--spacing--20)"}}} -->
            <div class="wp-block-group newsletter-form">
                <!-- wp:html -->
                <input type="email" placeholder="Enter your email address" class="email-input" style="width: 100%; padding: 8px 12px; border: 1px solid #ddd; border-radius: 4px; margin-bottom: 8px;">
                <!-- /wp:html -->
                
                <!-- wp:button {"className":"subscribe-btn","style":{"color":{"text":"#ffffff","background":"#0066CC"},"border":{"radius":"4px"},"spacing":{"padding":{"top":"8px","bottom":"8px","left":"16px","right":"16px"}}}} -->
                <div class="wp-block-button subscribe-btn"><a class="wp-block-button__link has-text-color has-background wp-element-button" style="border-radius:4px;color:#ffffff;background-color:#0066CC;padding-top:8px;padding-right:16px;padding-bottom:8px;padding-left:16px">Subscribe</a></div>
                <!-- /wp:button -->
            </div>
            <!-- /wp:group -->
        </div>
        <!-- /wp:column -->
    </div>
    <!-- /wp:columns -->
</div>
<!-- /wp:group -->';
}

function alepo_generate_customers_gutenberg_content() {
    return '<!-- wp:group {"className":"mega-menu-header","style":{"spacing":{"padding":{"top":"var(--wp--preset--spacing--50)","bottom":"var(--wp--preset--spacing--30)"}}}} -->
<div class="wp-block-group mega-menu-header" style="padding-top:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--30)">
    <!-- wp:heading {"level":2,"className":"mega-menu-title","style":{"typography":{"fontSize":"0.875rem","textTransform":"uppercase","letterSpacing":"0.05em"},"color":{"text":"#666666"}}} -->
    <h2 class="wp-block-heading mega-menu-title has-text-color" style="color:#666666;font-size:0.875rem;text-transform:uppercase;letter-spacing:0.05em">OUR GLOBAL CUSTOMERS</h2>
    <!-- /wp:heading -->
</div>
<!-- /wp:group -->

<!-- wp:columns {"className":"customers-grid","style":{"spacing":{"blockGap":{"top":"var(--wp--preset--spacing--50)","left":"var(--wp--preset--spacing--50)"}}}} -->
<div class="wp-block-columns customers-grid">
    <!-- wp:column {"className":"customers-section"} -->
    <div class="wp-block-column customers-section">
        <!-- wp:heading {"level":3,"style":{"typography":{"fontSize":"1.125rem","fontWeight":"600"},"color":{"text":"#2C3E50"},"spacing":{"margin":{"bottom":"var(--wp--preset--spacing--40)"}}}} -->
        <h3 class="wp-block-heading has-text-color" style="color:#2C3E50;margin-bottom:var(--wp--preset--spacing--40);font-size:1.125rem;font-weight:600">🌟 Case Studies</h3>
        <!-- /wp:heading -->
        
        <!-- wp:group {"className":"customer-story","style":{"spacing":{"padding":{"top":"var(--wp--preset--spacing--40)","bottom":"var(--wp--preset--spacing--40)","left":"var(--wp--preset--spacing--40)","right":"var(--wp--preset--spacing--40)"},"margin":{"bottom":"var(--wp--preset--spacing--30)"}},"color":{"background":"#F8F9FA"},"border":{"radius":"8px"}}} -->
        <div class="wp-block-group customer-story has-background" style="border-radius:8px;background-color:#F8F9FA;margin-bottom:var(--wp--preset--spacing--30);padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)">
            <!-- wp:heading {"level":4,"style":{"typography":{"fontSize":"0.875rem","fontWeight":"600"},"color":{"text":"#0066CC"},"spacing":{"margin":{"bottom":"var(--wp--preset--spacing--20)"}}}} -->
            <h4 class="wp-block-heading has-text-color" style="color:#0066CC;margin-bottom:var(--wp--preset--spacing--20);font-size:0.875rem;font-weight:600">Lüm Mobile (SaskTel)</h4>
            <!-- /wp:heading -->
            
            <!-- wp:paragraph {"style":{"typography":{"fontSize":"0.8125rem"},"color":{"text":"#666666"},"spacing":{"margin":{"bottom":"var(--wp--preset--spacing--20)"}}}} -->
            <p class="has-text-color" style="color:#666666;margin-bottom:var(--wp--preset--spacing--20);font-size:0.8125rem">AI transformation success: 70% support automation, 25% churn reduction</p>
            <!-- /wp:paragraph -->
            
            <!-- wp:paragraph {"style":{"typography":{"fontSize":"0.8125rem","fontWeight":"500"}}} -->
            <p style="font-size:0.8125rem;font-weight:500"><a href="/customers/case-studies/lum-mobile" style="color:#0066CC;text-decoration:none">Read Case Study →</a></p>
            <!-- /wp:paragraph -->
        </div>
        <!-- /wp:group -->
        
        <!-- wp:group {"className":"customer-story","style":{"spacing":{"padding":{"top":"var(--wp--preset--spacing--40)","bottom":"var(--wp--preset--spacing--40)","left":"var(--wp--preset--spacing--40)","right":"var(--wp--preset--spacing--40)"},"margin":{"bottom":"var(--wp--preset--spacing--30)"}},"color":{"background":"#F8F9FA"},"border":{"radius":"8px"}}} -->
        <div class="wp-block-group customer-story has-background" style="border-radius:8px;background-color:#F8F9FA;margin-bottom:var(--wp--preset--spacing--30);padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)">
            <!-- wp:heading {"level":4,"style":{"typography":{"fontSize":"0.875rem","fontWeight":"600"},"color":{"text":"#0066CC"},"spacing":{"margin":{"bottom":"var(--wp--preset--spacing--20)"}}}} -->
            <h4 class="wp-block-heading has-text-color" style="color:#0066CC;margin-bottom:var(--wp--preset--spacing--20);font-size:0.875rem;font-weight:600">STC</h4>
            <!-- /wp:heading -->
            
            <!-- wp:paragraph {"style":{"typography":{"fontSize":"0.8125rem"},"color":{"text":"#666666"},"spacing":{"margin":{"bottom":"var(--wp--preset--spacing--20)"}}}} -->
            <p class="has-text-color" style="color:#666666;margin-bottom:var(--wp--preset--spacing--20);font-size:0.8125rem">BSS modernization: Unified platform for fiber & mobile services</p>
            <!-- /wp:paragraph -->
            
            <!-- wp:paragraph {"style":{"typography":{"fontSize":"0.8125rem","fontWeight":"500"}}} -->
            <p style="font-size:0.8125rem;font-weight:500"><a href="/customers/case-studies/stc" style="color:#0066CC;text-decoration:none">Read Case Study →</a></p>
            <!-- /wp:paragraph -->
        </div>
        <!-- /wp:group -->
        
        <!-- wp:group {"className":"customer-story","style":{"spacing":{"padding":{"top":"var(--wp--preset--spacing--40)","bottom":"var(--wp--preset--spacing--40)","left":"var(--wp--preset--spacing--40)","right":"var(--wp--preset--spacing--40)"}},"color":{"background":"#F8F9FA"},"border":{"radius":"8px"}}} -->
        <div class="wp-block-group customer-story has-background" style="border-radius:8px;background-color:#F8F9FA;padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)">
            <!-- wp:heading {"level":4,"style":{"typography":{"fontSize":"0.875rem","fontWeight":"600"},"color":{"text":"#0066CC"},"spacing":{"margin":{"bottom":"var(--wp--preset--spacing--20)"}}}} -->
            <h4 class="wp-block-heading has-text-color" style="color:#0066CC;margin-bottom:var(--wp--preset--spacing--20);font-size:0.875rem;font-weight:600">Global Tier-1 Operator</h4>
            <!-- /wp:heading -->
            
            <!-- wp:paragraph {"style":{"typography":{"fontSize":"0.8125rem"},"color":{"text":"#666666"},"spacing":{"margin":{"bottom":"var(--wp--preset--spacing--20)"}}}} -->
            <p class="has-text-color" style="color:#666666;margin-bottom:var(--wp--preset--spacing--20);font-size:0.8125rem">Zero-downtime AAA migration for 50M+ subscribers</p>
            <!-- /wp:paragraph -->
            
            <!-- wp:paragraph {"style":{"typography":{"fontSize":"0.8125rem","fontWeight":"500"}}} -->
            <p style="font-size:0.8125rem;font-weight:500"><a href="/customers/case-studies/tier1-operator" style="color:#0066CC;text-decoration:none">Read Case Study →</a></p>
            <!-- /wp:paragraph -->
        </div>
        <!-- /wp:group -->
    </div>
    <!-- /wp:column -->
    
    <!-- wp:column {"className":"customers-right"} -->
    <div class="wp-block-column customers-right">
        <!-- wp:heading {"level":3,"style":{"typography":{"fontSize":"1.125rem","fontWeight":"600"},"color":{"text":"#2C3E50"},"spacing":{"margin":{"bottom":"var(--wp--preset--spacing--40)"}}}} -->
        <h3 class="wp-block-heading has-text-color" style="color:#2C3E50;margin-bottom:var(--wp--preset--spacing--40);font-size:1.125rem;font-weight:600">🌍 Client Experience</h3>
        <!-- /wp:heading -->
        
        <!-- wp:group {"style":{"spacing":{"padding":{"top":"var(--wp--preset--spacing--80)","bottom":"var(--wp--preset--spacing--80)","left":"var(--wp--preset--spacing--40)","right":"var(--wp--preset--spacing--40)"},"margin":{"bottom":"var(--wp--preset--spacing--40)"}},"color":{"background":"#F8F9FA"},"border":{"radius":"8px"}}} -->
        <div class="wp-block-group has-background" style="border-radius:8px;background-color:#F8F9FA;margin-bottom:var(--wp--preset--spacing--40);padding-top:var(--wp--preset--spacing--80);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--80);padding-left:var(--wp--preset--spacing--40)">
            <!-- wp:paragraph {"align":"center","style":{"color":{"text":"#666666"}}} -->
            <p class="has-text-align-center has-text-color" style="color:#666666">[Interactive World Map]</p>
            <!-- /wp:paragraph -->
        </div>
        <!-- /wp:group -->
        
        <!-- wp:columns {"style":{"spacing":{"blockGap":{"top":"var(--wp--preset--spacing--30)","left":"var(--wp--preset--spacing--30)"},"margin":{"bottom":"var(--wp--preset--spacing--40)"}}}} -->
        <div class="wp-block-columns" style="margin-bottom:var(--wp--preset--spacing--40)">
            <!-- wp:column -->
            <div class="wp-block-column">
                <!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"2rem","fontWeight":"700"},"color":{"text":"#0066CC"}}} -->
                <p class="has-text-align-center has-text-color" style="color:#0066CC;font-size:2rem;font-weight:700">100+</p>
                <!-- /wp:paragraph -->
                
                <!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"0.875rem"},"color":{"text":"#666666"}}} -->
                <p class="has-text-align-center has-text-color" style="color:#666666;font-size:0.875rem">Service Providers</p>
                <!-- /wp:paragraph -->
            </div>
            <!-- /wp:column -->
            
            <!-- wp:column -->
            <div class="wp-block-column">
                <!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"2rem","fontWeight":"700"},"color":{"text":"#0066CC"}}} -->
                <p class="has-text-align-center has-text-color" style="color:#0066CC;font-size:2rem;font-weight:700">6</p>
                <!-- /wp:paragraph -->
                
                <!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"0.875rem"},"color":{"text":"#666666"}}} -->
                <p class="has-text-align-center has-text-color" style="color:#666666;font-size:0.875rem">Continents</p>
                <!-- /wp:paragraph -->
            </div>
            <!-- /wp:column -->
        </div>
        <!-- /wp:columns -->
        
        <!-- wp:paragraph {"style":{"typography":{"fontSize":"0.875rem"},"color":{"text":"#666666"}}} -->
        <p class="has-text-color" style="color:#666666;font-size:0.875rem">Trusted by leading operators worldwide including STC, Digicel, Orange, Zain, SaskTel, and many more.</p>
        <!-- /wp:paragraph -->
    </div>
    <!-- /wp:column -->
</div>
<!-- /wp:columns -->

<!-- wp:group {"className":"mega-menu-footer","style":{"spacing":{"padding":{"top":"var(--wp--preset--spacing--40)","bottom":"var(--wp--preset--spacing--40)","left":"var(--wp--preset--spacing--50)","right":"var(--wp--preset--spacing--50)"}},"color":{"background":"#E8F2FF"}}} -->
<div class="wp-block-group mega-menu-footer has-background" style="background-color:#E8F2FF;padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--50)">
    <!-- wp:paragraph {"style":{"typography":{"fontSize":"0.875rem","fontWeight":"500"},"color":{"text":"#2C3E50"}}} -->
    <p class="has-text-color" style="color:#2C3E50;font-size:0.875rem;font-weight:500">🛠️ Customer Support: Access our global technical assistance center → <a href="/support" style="color:#0066CC;text-decoration:none">Get Support</a></p>
    <!-- /wp:paragraph -->
</div>
<!-- /wp:group -->';
}

/**
 * Get mega menu content by type
 */
function alepo_get_mega_menu_content($menu_type) {
    $posts = get_posts(array(
        'post_type' => 'mega_menu_content',
        'meta_key' => '_mega_menu_type',
        'meta_value' => $menu_type,
        'numberposts' => 1,
        'post_status' => 'publish'
    ));
    
    if (!empty($posts)) {
        return apply_filters('the_content', $posts[0]->post_content);
    }
    
    return '';
}

// Auto-create mega menu content on theme activation
add_action('after_switch_theme', 'alepo_create_default_mega_menu_content');

/**
 * Add admin notice about mega menu functionality
 */
function alepo_mega_menu_admin_notice() {
    $posts = get_posts(array(
        'post_type' => 'mega_menu_content',
        'numberposts' => 1,
        'post_status' => 'any'
    ));
    
    if (!empty($posts)) {
        echo '<div class="notice notice-info is-dismissible">';
        echo '<p><strong>Alepo Mega Menus:</strong> You can now edit your website\'s mega menu content in the <a href="' . admin_url('edit.php?post_type=mega_menu_content') . '">Mega Menus</a> section. Each menu dropdown is now fully editable using the WordPress block editor!</p>';
        echo '</div>';
    }
}
add_action('admin_notices', 'alepo_mega_menu_admin_notice');
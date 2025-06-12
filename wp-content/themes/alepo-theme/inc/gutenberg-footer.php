<?php
/**
 * Gutenberg-Compatible Footer Content
 * Creates editable blocks for footer content in WordPress admin
 */

/**
 * Register footer content as custom post type for editing
 */
function alepo_register_footer_content() {
    register_post_type('footer_content', array(
        'labels' => array(
            'name' => 'Footer Content',
            'singular_name' => 'Footer Section',
            'add_new' => 'Add New Section',
            'add_new_item' => 'Add New Footer Section',
            'edit_item' => 'Edit Footer Section',
            'menu_name' => 'Footer Content'
        ),
        'public' => false,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_rest' => true,
        'supports' => array('title', 'editor', 'custom-fields'),
        'menu_icon' => 'dashicons-admin-page',
        'menu_position' => 26,
        'capability_type' => 'post',
        'has_archive' => false,
        'hierarchical' => false,
    ));
}
add_action('init', 'alepo_register_footer_content');

/**
 * Create default footer content posts
 */
function alepo_create_default_footer_content() {
    // Check if content already exists
    $existing = get_posts(array(
        'post_type' => 'footer_content',
        'numberposts' => 1,
        'post_status' => 'any'
    ));
    
    if (!empty($existing)) {
        return; // Content already exists
    }
    
    // Company Info Footer Section
    $company_content = alepo_generate_company_footer_content();
    wp_insert_post(array(
        'post_title' => 'Company Info & Contact',
        'post_name' => 'company-footer',
        'post_type' => 'footer_content',
        'post_status' => 'publish',
        'post_content' => $company_content,
        'meta_input' => array(
            '_footer_section_type' => 'company',
            '_footer_section_order' => '1'
        )
    ));
    
    // Solutions Footer Section
    $solutions_content = alepo_generate_solutions_footer_content();
    wp_insert_post(array(
        'post_title' => 'Solutions Links',
        'post_name' => 'solutions-footer',
        'post_type' => 'footer_content',
        'post_status' => 'publish',
        'post_content' => $solutions_content,
        'meta_input' => array(
            '_footer_section_type' => 'solutions',
            '_footer_section_order' => '2'
        )
    ));
    
    // Products & Industries Footer Section
    $products_content = alepo_generate_products_footer_content();
    wp_insert_post(array(
        'post_title' => 'Products & Industries',
        'post_name' => 'products-footer',
        'post_type' => 'footer_content',
        'post_status' => 'publish',
        'post_content' => $products_content,
        'meta_input' => array(
            '_footer_section_type' => 'products',
            '_footer_section_order' => '3'
        )
    ));
    
    // Resources & Company Footer Section
    $resources_content = alepo_generate_resources_footer_content();
    wp_insert_post(array(
        'post_title' => 'Resources & Company',
        'post_name' => 'resources-footer',
        'post_type' => 'footer_content',
        'post_status' => 'publish',
        'post_content' => $resources_content,
        'meta_input' => array(
            '_footer_section_type' => 'resources',
            '_footer_section_order' => '4'
        )
    ));
    
    // Newsletter & CTA Footer Section
    $newsletter_content = alepo_generate_newsletter_footer_content();
    wp_insert_post(array(
        'post_title' => 'Newsletter & CTA',
        'post_name' => 'newsletter-footer',
        'post_type' => 'footer_content',
        'post_status' => 'publish',
        'post_content' => $newsletter_content,
        'meta_input' => array(
            '_footer_section_type' => 'newsletter',
            '_footer_section_order' => '5'
        )
    ));

    // Footer Bottom Section
    $bottom_content = alepo_generate_footer_bottom_content();
    wp_insert_post(array(
        'post_title' => 'Footer Bottom (Copyright & Legal)',
        'post_name' => 'footer-bottom',
        'post_type' => 'footer_content',
        'post_status' => 'publish',
        'post_content' => $bottom_content,
        'meta_input' => array(
            '_footer_section_type' => 'bottom',
            '_footer_section_order' => '6'
        )
    ));
}

/**
 * Generate Company footer content as Gutenberg blocks
 */
function alepo_generate_company_footer_content() {
    return '<!-- wp:group {"className":"footer-branding","style":{"spacing":{"margin":{"bottom":"var(--wp--preset--spacing--40)"}}}} -->
<div class="wp-block-group footer-branding" style="margin-bottom:var(--wp--preset--spacing--40)">
    <!-- wp:site-logo {"width":180,"shouldSyncIcon":false} -->
    <div class="wp-block-site-logo"><a href="/" class="custom-logo-link" rel="home"><img width="180" src="#" alt="Alepo" /></a></div>
    <!-- /wp:site-logo -->
</div>
<!-- /wp:group -->

<!-- wp:paragraph {"className":"footer-description","style":{"color":{"text":"rgba(255,255,255,0.8)"},"spacing":{"margin":{"bottom":"var(--wp--preset--spacing--50)"}}}} -->
<p class="footer-description has-text-color" style="color:rgba(255,255,255,0.8);margin-bottom:var(--wp--preset--spacing--50)">Leading provider of telecom software solutions for 5G, BSS, and network modernization.</p>
<!-- /wp:paragraph -->

<!-- wp:group {"className":"footer-contact","style":{"spacing":{"margin":{"bottom":"var(--wp--preset--spacing--50)"}}}} -->
<div class="wp-block-group footer-contact" style="margin-bottom:var(--wp--preset--spacing--50)">
    <!-- wp:group {"className":"contact-item","style":{"spacing":{"margin":{"bottom":"var(--wp--preset--spacing--20)"}}}} -->
    <div class="wp-block-group contact-item" style="margin-bottom:var(--wp--preset--spacing--20)">
        <!-- wp:paragraph {"style":{"color":{"text":"rgba(255,255,255,0.9)"}}} -->
        <p class="has-text-color" style="color:rgba(255,255,255,0.9)">📞 +1 (555) 123-4567</p>
        <!-- /wp:paragraph -->
    </div>
    <!-- /wp:group -->
    
    <!-- wp:group {"className":"contact-item"} -->
    <div class="wp-block-group contact-item">
        <!-- wp:paragraph {"style":{"color":{"text":"rgba(255,255,255,0.9)"}}} -->
        <p class="has-text-color" style="color:rgba(255,255,255,0.9)">✉️ <a href="mailto:info@alepo.com" style="color:inherit;text-decoration:none;">info@alepo.com</a></p>
        <!-- /wp:paragraph -->
    </div>
    <!-- /wp:group -->
</div>
<!-- /wp:group -->

<!-- wp:group {"className":"footer-social","style":{"spacing":{"blockGap":"var(--wp--preset--spacing--30)"}}} -->
<div class="wp-block-group footer-social">
    <!-- wp:paragraph {"style":{"typography":{"fontSize":"1.25rem"}}} -->
    <p style="font-size:1.25rem"><a href="#" class="social-link" aria-label="LinkedIn" style="display:inline-flex;align-items:center;justify-content:center;width:40px;height:40px;background:rgba(255,255,255,0.1);border-radius:8px;text-decoration:none;">💼</a></p>
    <!-- /wp:paragraph -->
    
    <!-- wp:paragraph {"style":{"typography":{"fontSize":"1.25rem"}}} -->
    <p style="font-size:1.25rem"><a href="#" class="social-link" aria-label="Twitter" style="display:inline-flex;align-items:center;justify-content:center;width:40px;height:40px;background:rgba(255,255,255,0.1);border-radius:8px;text-decoration:none;">🐦</a></p>
    <!-- /wp:paragraph -->
    
    <!-- wp:paragraph {"style":{"typography":{"fontSize":"1.25rem"}}} -->
    <p style="font-size:1.25rem"><a href="#" class="social-link" aria-label="YouTube" style="display:inline-flex;align-items:center;justify-content:center;width:40px;height:40px;background:rgba(255,255,255,0.1);border-radius:8px;text-decoration:none;">📺</a></p>
    <!-- /wp:paragraph -->
</div>
<!-- /wp:group -->';
}

/**
 * Generate Solutions footer content as Gutenberg blocks
 */
function alepo_generate_solutions_footer_content() {
    return '<!-- wp:heading {"level":3,"className":"footer-title","style":{"color":{"text":"#ffffff"},"typography":{"fontWeight":"600"},"spacing":{"margin":{"bottom":"var(--wp--preset--spacing--40)"}}}} -->
<h3 class="wp-block-heading footer-title has-text-color" style="color:#ffffff;margin-bottom:var(--wp--preset--spacing--40);font-weight:600">Solutions</h3>
<!-- /wp:heading -->

<!-- wp:list {"className":"footer-menu","style":{"spacing":{"padding":{"left":"0"}},"color":{"text":"rgba(255,255,255,0.8)"}},"fontSize":"small"} -->
<ul class="wp-block-list footer-menu has-text-color has-small-font-size" style="color:rgba(255,255,255,0.8);padding-left:0">
    <!-- wp:list-item -->
    <li><a href="/solutions/legacy-aaa-replacement" style="color:rgba(255,255,255,0.8);text-decoration:none;">Legacy AAA Replacement</a></li>
    <!-- /wp:list-item -->
    
    <!-- wp:list-item -->
    <li><a href="/solutions/5g-network-evolution" style="color:rgba(255,255,255,0.8);text-decoration:none;">5G Network Evolution</a></li>
    <!-- /wp:list-item -->
    
    <!-- wp:list-item -->
    <li><a href="/solutions/bss-modernization" style="color:rgba(255,255,255,0.8);text-decoration:none;">BSS Modernization</a></li>
    <!-- /wp:list-item -->
    
    <!-- wp:list-item -->
    <li><a href="/solutions/ai-driven-automation" style="color:rgba(255,255,255,0.8);text-decoration:none;">AI-Driven Automation</a></li>
    <!-- /wp:list-item -->
    
    <!-- wp:list-item -->
    <li><a href="/solutions/5g-monetization" style="color:rgba(255,255,255,0.8);text-decoration:none;">5G Monetization</a></li>
    <!-- /wp:list-item -->
    
    <!-- wp:list-item -->
    <li><a href="/solutions/omnichannel-cx" style="color:rgba(255,255,255,0.8);text-decoration:none;">Omnichannel CX</a></li>
    <!-- /wp:list-item -->
    
    <!-- wp:list-item -->
    <li><a href="/solutions" style="color:rgba(255,255,255,0.8);text-decoration:none;">View All Solutions</a></li>
    <!-- /wp:list-item -->
</ul>
<!-- /wp:list -->';
}

/**
 * Generate Products footer content as Gutenberg blocks
 */
function alepo_generate_products_footer_content() {
    return '<!-- wp:heading {"level":3,"className":"footer-title","style":{"color":{"text":"#ffffff"},"typography":{"fontWeight":"600"},"spacing":{"margin":{"bottom":"var(--wp--preset--spacing--40)"}}}} -->
<h3 class="wp-block-heading footer-title has-text-color" style="color:#ffffff;margin-bottom:var(--wp--preset--spacing--40);font-weight:600">Products</h3>
<!-- /wp:heading -->

<!-- wp:list {"className":"footer-menu","style":{"spacing":{"padding":{"left":"0"}},"color":{"text":"rgba(255,255,255,0.8)"}},"fontSize":"small"} -->
<ul class="wp-block-list footer-menu has-text-color has-small-font-size" style="color:rgba(255,255,255,0.8);padding-left:0">
    <!-- wp:list-item -->
    <li><a href="/products/aaa-server" style="color:rgba(255,255,255,0.8);text-decoration:none;">AAA Authentication Server</a></li>
    <!-- /wp:list-item -->
    
    <!-- wp:list-item -->
    <li><a href="/products/digital-bss" style="color:rgba(255,255,255,0.8);text-decoration:none;">Digital BSS Platform</a></li>
    <!-- /wp:list-item -->
    
    <!-- wp:list-item -->
    <li><a href="/products/pcrf" style="color:rgba(255,255,255,0.8);text-decoration:none;">Policy Control (PCRF)</a></li>
    <!-- /wp:list-item -->
    
    <!-- wp:list-item -->
    <li><a href="/products/ai-customer-assistant" style="color:rgba(255,255,255,0.8);text-decoration:none;">AI Customer Assistant</a></li>
    <!-- /wp:list-item -->
    
    <!-- wp:list-item -->
    <li><a href="/products/ai-agent-assistant" style="color:rgba(255,255,255,0.8);text-decoration:none;">AI Agent Assistant</a></li>
    <!-- /wp:list-item -->
</ul>
<!-- /wp:list -->

<!-- wp:heading {"level":3,"className":"footer-title footer-title-secondary","style":{"color":{"text":"#ffffff"},"typography":{"fontWeight":"600"},"spacing":{"margin":{"top":"var(--wp--preset--spacing--50)","bottom":"var(--wp--preset--spacing--40)"}}}} -->
<h3 class="wp-block-heading footer-title footer-title-secondary has-text-color" style="color:#ffffff;margin-top:var(--wp--preset--spacing--50);margin-bottom:var(--wp--preset--spacing--40);font-weight:600">Industries</h3>
<!-- /wp:heading -->

<!-- wp:list {"className":"footer-menu","style":{"spacing":{"padding":{"left":"0"}},"color":{"text":"rgba(255,255,255,0.8)"}},"fontSize":"small"} -->
<ul class="wp-block-list footer-menu has-text-color has-small-font-size" style="color:rgba(255,255,255,0.8);padding-left:0">
    <!-- wp:list-item -->
    <li><a href="/industries/mobile-operators" style="color:rgba(255,255,255,0.8);text-decoration:none;">Mobile Operators</a></li>
    <!-- /wp:list-item -->
    
    <!-- wp:list-item -->
    <li><a href="/industries/internet-service-providers" style="color:rgba(255,255,255,0.8);text-decoration:none;">Internet Service Providers</a></li>
    <!-- /wp:list-item -->
    
    <!-- wp:list-item -->
    <li><a href="/industries/enterprise-private-networks" style="color:rgba(255,255,255,0.8);text-decoration:none;">Enterprise & Private Networks</a></li>
    <!-- /wp:list-item -->
    
    <!-- wp:list-item -->
    <li><a href="/industries" style="color:rgba(255,255,255,0.8);text-decoration:none;">View All Industries</a></li>
    <!-- /wp:list-item -->
</ul>
<!-- /wp:list -->';
}

/**
 * Generate Resources footer content as Gutenberg blocks
 */
function alepo_generate_resources_footer_content() {
    return '<!-- wp:heading {"level":3,"className":"footer-title","style":{"color":{"text":"#ffffff"},"typography":{"fontWeight":"600"},"spacing":{"margin":{"bottom":"var(--wp--preset--spacing--40)"}}}} -->
<h3 class="wp-block-heading footer-title has-text-color" style="color:#ffffff;margin-bottom:var(--wp--preset--spacing--40);font-weight:600">Resources</h3>
<!-- /wp:heading -->

<!-- wp:list {"className":"footer-menu","style":{"spacing":{"padding":{"left":"0"}},"color":{"text":"rgba(255,255,255,0.8)"}},"fontSize":"small"} -->
<ul class="wp-block-list footer-menu has-text-color has-small-font-size" style="color:rgba(255,255,255,0.8);padding-left:0">
    <!-- wp:list-item -->
    <li><a href="/resources/blog" style="color:rgba(255,255,255,0.8);text-decoration:none;">Blog & Insights</a></li>
    <!-- /wp:list-item -->
    
    <!-- wp:list-item -->
    <li><a href="/resources/case-studies" style="color:rgba(255,255,255,0.8);text-decoration:none;">Case Studies</a></li>
    <!-- /wp:list-item -->
    
    <!-- wp:list-item -->
    <li><a href="/resources/whitepapers" style="color:rgba(255,255,255,0.8);text-decoration:none;">Whitepapers</a></li>
    <!-- /wp:list-item -->
    
    <!-- wp:list-item -->
    <li><a href="/resources/webinars" style="color:rgba(255,255,255,0.8);text-decoration:none;">Webinars & Events</a></li>
    <!-- /wp:list-item -->
    
    <!-- wp:list-item -->
    <li><a href="/support/documentation" style="color:rgba(255,255,255,0.8);text-decoration:none;">Documentation</a></li>
    <!-- /wp:list-item -->
    
    <!-- wp:list-item -->
    <li><a href="/support/training" style="color:rgba(255,255,255,0.8);text-decoration:none;">Training</a></li>
    <!-- /wp:list-item -->
</ul>
<!-- /wp:list -->

<!-- wp:heading {"level":3,"className":"footer-title footer-title-secondary","style":{"color":{"text":"#ffffff"},"typography":{"fontWeight":"600"},"spacing":{"margin":{"top":"var(--wp--preset--spacing--50)","bottom":"var(--wp--preset--spacing--40)"}}}} -->
<h3 class="wp-block-heading footer-title footer-title-secondary has-text-color" style="color:#ffffff;margin-top:var(--wp--preset--spacing--50);margin-bottom:var(--wp--preset--spacing--40);font-weight:600">Company</h3>
<!-- /wp:heading -->

<!-- wp:list {"className":"footer-menu","style":{"spacing":{"padding":{"left":"0"}},"color":{"text":"rgba(255,255,255,0.8)"}},"fontSize":"small"} -->
<ul class="wp-block-list footer-menu has-text-color has-small-font-size" style="color:rgba(255,255,255,0.8);padding-left:0">
    <!-- wp:list-item -->
    <li><a href="/company/about" style="color:rgba(255,255,255,0.8);text-decoration:none;">About Alepo</a></li>
    <!-- /wp:list-item -->
    
    <!-- wp:list-item -->
    <li><a href="/company/leadership" style="color:rgba(255,255,255,0.8);text-decoration:none;">Leadership Team</a></li>
    <!-- /wp:list-item -->
    
    <!-- wp:list-item -->
    <li><a href="/company/careers" style="color:rgba(255,255,255,0.8);text-decoration:none;">Careers</a></li>
    <!-- /wp:list-item -->
    
    <!-- wp:list-item -->
    <li><a href="/company/news" style="color:rgba(255,255,255,0.8);text-decoration:none;">Press & News</a></li>
    <!-- /wp:list-item -->
    
    <!-- wp:list-item -->
    <li><a href="/partners" style="color:rgba(255,255,255,0.8);text-decoration:none;">Partners</a></li>
    <!-- /wp:list-item -->
    
    <!-- wp:list-item -->
    <li><a href="/contact" style="color:rgba(255,255,255,0.8);text-decoration:none;">Contact Us</a></li>
    <!-- /wp:list-item -->
</ul>
<!-- /wp:list -->';
}

/**
 * Generate Newsletter footer content as Gutenberg blocks
 */
function alepo_generate_newsletter_footer_content() {
    return '<!-- wp:heading {"level":3,"className":"footer-title","style":{"color":{"text":"#ffffff"},"typography":{"fontWeight":"600"},"spacing":{"margin":{"bottom":"var(--wp--preset--spacing--40)"}}}} -->
<h3 class="wp-block-heading footer-title has-text-color" style="color:#ffffff;margin-bottom:var(--wp--preset--spacing--40);font-weight:600">Stay Connected</h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"newsletter-description","style":{"color":{"text":"rgba(255,255,255,0.8)"},"spacing":{"margin":{"bottom":"var(--wp--preset--spacing--40)"}},"typography":{"fontSize":"0.875rem"}}} -->
<p class="newsletter-description has-text-color" style="color:rgba(255,255,255,0.8);margin-bottom:var(--wp--preset--spacing--40);font-size:0.875rem">Get the latest insights on telecom innovation, 5G trends, and industry best practices.</p>
<!-- /wp:paragraph -->

<!-- wp:group {"className":"newsletter-form","style":{"spacing":{"margin":{"bottom":"var(--wp--preset--spacing--60)"}}}} -->
<div class="wp-block-group newsletter-form" style="margin-bottom:var(--wp--preset--spacing--60)">
    <!-- wp:html -->
    <form class="newsletter-form" action="#" method="post">
        <div class="form-group">
            <input type="email" name="email" placeholder="Enter your email" required style="flex:1;padding:12px 16px;border:1px solid rgba(255,255,255,0.2);border-radius:4px;background:rgba(255,255,255,0.1);color:#ffffff;font-size:0.875rem;height:44px;box-sizing:border-box;line-height:1.4;">
            <button type="submit" class="btn-newsletter" style="padding:12px 16px;background:#0066CC;color:#ffffff;border:none;border-radius:4px;font-size:0.875rem;font-weight:500;cursor:pointer;height:44px;box-sizing:border-box;line-height:1.4;display:flex;align-items:center;justify-content:center;">Subscribe</button>
        </div>
        <p class="form-disclaimer" style="font-size:0.75rem;color:rgba(255,255,255,0.6);line-height:1.4;margin-top:8px;">By subscribing, you agree to our Privacy Policy and consent to receive updates from our company.</p>
    </form>
    <!-- /wp:html -->
</div>
<!-- /wp:group -->

<!-- wp:group {"className":"footer-cta","style":{"spacing":{"padding":{"top":"var(--wp--preset--spacing--50)","bottom":"var(--wp--preset--spacing--50)","left":"var(--wp--preset--spacing--50)","right":"var(--wp--preset--spacing--50)"}},"color":{"background":"rgba(255,255,255,0.05)"},"border":{"radius":"8px","color":"rgba(255,255,255,0.1)","width":"1px"}}} -->
<div class="wp-block-group footer-cta has-background has-border-color" style="border-color:rgba(255,255,255,0.1);border-width:1px;border-radius:8px;background-color:rgba(255,255,255,0.05);padding-top:var(--wp--preset--spacing--50);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--50)">
    <!-- wp:heading {"level":4,"className":"cta-title","textAlign":"center","style":{"color":{"text":"#ffffff"},"spacing":{"margin":{"bottom":"var(--wp--preset--spacing--40)"}}}} -->
    <h4 class="wp-block-heading cta-title has-text-align-center has-text-color" style="color:#ffffff;margin-bottom:var(--wp--preset--spacing--40)">Ready to Transform Your Network?</h4>
    <!-- /wp:heading -->
    
    <!-- wp:button {"textAlign":"center","className":"btn-footer-cta","style":{"color":{"background":"#0066CC","text":"#ffffff"},"spacing":{"margin":{"bottom":"var(--wp--preset--spacing--30)"}},"border":{"radius":"4px"}}} -->
    <div class="wp-block-button btn-footer-cta has-text-align-center" style="margin-bottom:var(--wp--preset--spacing--30)"><a class="wp-block-button__link has-text-color has-background wp-element-button" href="/request-demo" style="border-radius:4px;color:#ffffff;background-color:#0066CC">Request Demo</a></div>
    <!-- /wp:button -->
    
    <!-- wp:button {"textAlign":"center","className":"btn-footer-secondary","style":{"color":{"text":"#ffffff"},"border":{"color":"rgba(255,255,255,0.3)","width":"1px","radius":"4px"}}} -->
    <div class="wp-block-button btn-footer-secondary has-text-align-center"><a class="wp-block-button__link has-text-color has-border-color wp-element-button" href="/contact" style="border-color:rgba(255,255,255,0.3);border-width:1px;border-radius:4px;color:#ffffff">Talk to Expert</a></div>
    <!-- /wp:button -->
</div>
<!-- /wp:group -->';
}

/**
 * Generate Footer bottom content as Gutenberg blocks
 */
function alepo_generate_footer_bottom_content() {
    return '<!-- wp:group {"className":"footer-copyright"} -->
<div class="wp-block-group footer-copyright">
    <!-- wp:paragraph {"style":{"color":{"text":"rgba(255,255,255,0.7)"},"typography":{"fontSize":"0.875rem"}}} -->
    <p class="has-text-color" style="color:rgba(255,255,255,0.7);font-size:0.875rem">© 2024 Alepo. All rights reserved.</p>
    <!-- /wp:paragraph -->
</div>
<!-- /wp:group -->

<!-- wp:group {"className":"footer-legal"} -->
<div class="wp-block-group footer-legal">
    <!-- wp:list {"className":"footer-legal-menu","style":{"spacing":{"padding":{"left":"0"}},"color":{"text":"rgba(255,255,255,0.7)"}},"fontSize":"small"} -->
    <ul class="wp-block-list footer-legal-menu has-text-color has-small-font-size" style="color:rgba(255,255,255,0.7);padding-left:0">
        <!-- wp:list-item -->
        <li><a href="/privacy-policy" style="color:rgba(255,255,255,0.7);text-decoration:none;">Privacy Policy</a></li>
        <!-- /wp:list-item -->
        
        <!-- wp:list-item -->
        <li><a href="/terms-of-service" style="color:rgba(255,255,255,0.7);text-decoration:none;">Terms of Service</a></li>
        <!-- /wp:list-item -->
        
        <!-- wp:list-item -->
        <li><a href="/cookie-policy" style="color:rgba(255,255,255,0.7);text-decoration:none;">Cookie Policy</a></li>
        <!-- /wp:list-item -->
        
        <!-- wp:list-item -->
        <li><a href="/sitemap.xml" style="color:rgba(255,255,255,0.7);text-decoration:none;">Sitemap</a></li>
        <!-- /wp:list-item -->
    </ul>
    <!-- /wp:list -->
</div>
<!-- /wp:group -->

<!-- wp:group {"className":"footer-certifications"} -->
<div class="wp-block-group footer-certifications">
    <!-- wp:paragraph {"className":"certification-badge","style":{"color":{"text":"rgba(255,255,255,0.8)","background":"rgba(255,255,255,0.1)"},"spacing":{"padding":{"top":"4px","bottom":"4px","left":"8px","right":"8px"}},"border":{"radius":"4px"},"typography":{"fontSize":"0.75rem"}}} -->
    <p class="certification-badge has-text-color has-background" style="border-radius:4px;color:rgba(255,255,255,0.8);background-color:rgba(255,255,255,0.1);padding-top:4px;padding-right:8px;padding-bottom:4px;padding-left:8px;font-size:0.75rem">🔒 ISO 27001</p>
    <!-- /wp:paragraph -->
    
    <!-- wp:paragraph {"className":"certification-badge","style":{"color":{"text":"rgba(255,255,255,0.8)","background":"rgba(255,255,255,0.1)"},"spacing":{"padding":{"top":"4px","bottom":"4px","left":"8px","right":"8px"}},"border":{"radius":"4px"},"typography":{"fontSize":"0.75rem"}}} -->
    <p class="certification-badge has-text-color has-background" style="border-radius:4px;color:rgba(255,255,255,0.8);background-color:rgba(255,255,255,0.1);padding-top:4px;padding-right:8px;padding-bottom:4px;padding-left:8px;font-size:0.75rem">✅ SOC 2</p>
    <!-- /wp:paragraph -->
    
    <!-- wp:paragraph {"className":"certification-badge","style":{"color":{"text":"rgba(255,255,255,0.8)","background":"rgba(255,255,255,0.1)"},"spacing":{"padding":{"top":"4px","bottom":"4px","left":"8px","right":"8px"}},"border":{"radius":"4px"},"typography":{"fontSize":"0.75rem"}}} -->
    <p class="certification-badge has-text-color has-background" style="border-radius:4px;color:rgba(255,255,255,0.8);background-color:rgba(255,255,255,0.1);padding-top:4px;padding-right:8px;padding-bottom:4px;padding-left:8px;font-size:0.75rem">🛡️ GDPR Compliant</p>
    <!-- /wp:paragraph -->
</div>
<!-- /wp:group -->';
}

/**
 * Get footer content by type
 */
function alepo_get_footer_content($section_type) {
    $posts = get_posts(array(
        'post_type' => 'footer_content',
        'meta_key' => '_footer_section_type',
        'meta_value' => $section_type,
        'numberposts' => 1,
        'post_status' => 'publish'
    ));
    
    if (!empty($posts)) {
        return apply_filters('the_content', $posts[0]->post_content);
    }
    
    return '';
}

/**
 * Add admin notice about footer functionality
 */
function alepo_footer_admin_notice() {
    $posts = get_posts(array(
        'post_type' => 'footer_content',
        'numberposts' => 1,
        'post_status' => 'any'
    ));
    
    if (!empty($posts)) {
        echo '<div class="notice notice-info is-dismissible">';
        echo '<p><strong>Alepo Footer Content:</strong> You can now edit your website\'s footer content in the <a href="' . admin_url('edit.php?post_type=footer_content') . '">Footer Content</a> section. Each footer section is now fully editable using the WordPress block editor!</p>';
        echo '</div>';
    }
}
add_action('admin_notices', 'alepo_footer_admin_notice');

// Auto-create footer content on theme activation
add_action('after_switch_theme', 'alepo_create_default_footer_content');
<?php
/**
 * Alepo Page Creation Script
 * Automatically creates all 47 core pages with proper structure and ACF fields
 * 
 * Usage: Run this file once to populate the WordPress site with all pages
 * Warning: This will create pages - run only on a fresh WordPress installation
 * 
 * @package Alepo
 * @version 1.0.0
 */

// Security check
if (!defined('ABSPATH')) {
    // Load WordPress if running standalone
    require_once(dirname(__FILE__) . '/../../../wp-load.php');
}

// Check if user has permission
if (!current_user_can('manage_options')) {
    wp_die('You do not have permission to run this script.');
}

/**
 * Main page creation function
 */
function alepo_create_all_pages() {
    echo "<h1>Alepo Website Page Creation</h1>\n";
    echo "<p>Creating all 47 core pages with content and ACF fields...</p>\n";
    
    $created_pages = 0;
    $errors = array();
    
    // Get all page definitions
    $pages_data = alepo_get_pages_data();
    
    echo "<p>Debug: Retrieved " . count($pages_data) . " page definitions</p>\n";
    
    foreach ($pages_data as $index => $page_data) {
        echo "<h3>Processing page " . ($index + 1) . " of " . count($pages_data) . "</h3>\n";
        try {
            $page_id = alepo_create_single_page($page_data);
            if ($page_id) {
                echo "<div style='color: green;'>✓ Created: {$page_data['title']} (ID: {$page_id})</div>\n";
                $created_pages++;
            } else {
                $errors[] = "Failed to create: {$page_data['title']}";
            }
        } catch (Exception $e) {
            $errors[] = "Error creating {$page_data['title']}: " . $e->getMessage();
        }
    }
    
    // Create navigation menus
    alepo_create_navigation_menus();
    
    // Set homepage
    alepo_set_homepage();
    
    echo "<br><h2>Summary</h2>\n";
    echo "<p><strong>Pages Created:</strong> {$created_pages}</p>\n";
    
    if (!empty($errors)) {
        echo "<h3 style='color: red;'>Errors:</h3>\n";
        foreach ($errors as $error) {
            echo "<div style='color: red;'>✗ {$error}</div>\n";
        }
    }
    
    echo "<br><p><strong>✅ Page creation completed!</strong></p>\n";
    echo "<p><a href='" . admin_url() . "'>Go to WordPress Admin</a> | <a href='" . home_url() . "'>View Site</a></p>\n";
}

/**
 * Create a single page with content and ACF fields
 */
function alepo_create_single_page($page_data) {
    // Debug output
    echo "<br>Attempting to create page: {$page_data['title']} (slug: {$page_data['slug']})<br>\n";
    
    // Check if page already exists
    $existing_page = get_page_by_path($page_data['slug']);
    if ($existing_page) {
        echo "Page already exists with ID: {$existing_page->ID}<br>\n";
        return $existing_page->ID; // Return existing page ID
    }
    
    // Prepare page data for WordPress
    $post_data = array(
        'post_title'    => $page_data['title'],
        'post_name'     => $page_data['slug'],
        'post_content'  => $page_data['content'],
        'post_status'   => 'publish',
        'post_type'     => 'page',
        'post_author'   => 1,
        'meta_input'    => array(
            '_wp_page_template' => $page_data['template'] ?? 'page.php'
        )
    );
    
    // Set parent page if specified
    if (!empty($page_data['parent_slug'])) {
        $parent_page = get_page_by_path($page_data['parent_slug']);
        if ($parent_page) {
            $post_data['post_parent'] = $parent_page->ID;
        }
    }
    
    // Debug: Show post data
    echo "Post data prepared. Creating page...<br>\n";
    
    // Create the page
    $page_id = wp_insert_post($post_data);
    
    if (is_wp_error($page_id)) {
        echo "<span style='color: red;'>Error creating page: " . $page_id->get_error_message() . "</span><br>\n";
        throw new Exception($page_id->get_error_message());
    }
    
    echo "Page created successfully with ID: {$page_id}<br>\n";
    
    // Add ACF fields if they exist
    if (!empty($page_data['acf_fields']) && function_exists('update_field')) {
        foreach ($page_data['acf_fields'] as $field_name => $field_value) {
            update_field($field_name, $field_value, $page_id);
        }
    }
    
    // Add SEO meta if Yoast is available
    if (!empty($page_data['meta_description'])) {
        update_post_meta($page_id, '_yoast_wpseo_metadesc', $page_data['meta_description']);
    }
    
    if (!empty($page_data['focus_keyword'])) {
        update_post_meta($page_id, '_yoast_wpseo_focuskw', $page_data['focus_keyword']);
    }
    
    return $page_id;
}

/**
 * Get all page data definitions
 */
function alepo_get_pages_data() {
    return array(
        // Homepage
        array(
            'title' => 'Home',
            'slug' => 'home',
            'content' => alepo_get_homepage_content(),
            'template' => 'front-page.php',
            'meta_description' => 'Leading provider of telecom software solutions for 5G, BSS, and network modernization. Transform your network with Alepo.',
            'focus_keyword' => 'telecom software solutions',
            'acf_fields' => array(
                'hero_headline' => 'Transform Your Network with Future-Ready Telecom Solutions',
                'hero_subheadline' => 'Comprehensive AAA, BSS, and AI-powered solutions for 5G networks, digital transformation, and customer experience excellence.',
                'hero_cta_primary' => 'Explore Solutions',
                'hero_cta_primary_url' => '/solutions',
                'hero_cta_secondary' => 'Request Demo',
                'hero_cta_secondary_url' => '/request-demo'
            )
        ),
        
        // Solution Pages
        array(
            'title' => 'Legacy AAA Replacement',
            'slug' => 'solutions/legacy-aaa-replacement',
            'content' => alepo_get_solution_content('legacy_aaa'),
            'template' => 'page-templates/page-solution.php',
            'meta_description' => 'Modernize legacy AAA infrastructure with cloud-native solutions. Reduce costs, improve scalability, and enable 5G services.',
            'focus_keyword' => 'legacy AAA replacement',
            'acf_fields' => array(
                'hero_headline' => 'Modernize Your Legacy AAA Infrastructure',
                'hero_subheadline' => 'Seamlessly migrate from legacy systems to cloud-native AAA solutions with zero downtime and immediate ROI.',
                'challenge_addressed' => 'Legacy AAA systems limit scalability, increase operational costs, and prevent 5G service deployment.',
                'target_audience' => array('csps', 'mvnos', 'isps'),
                'implementation_time' => '6-8 weeks',
                'roi_metrics' => array(
                    array('roi_metric' => '50%', 'roi_description' => 'Reduction in operational costs'),
                    array('roi_metric' => '99.999%', 'roi_description' => 'Improved system uptime'),
                    array('roi_metric' => '3x', 'roi_description' => 'Faster service deployment')
                )
            )
        ),
        
        array(
            'title' => '5G Network Evolution',
            'slug' => 'solutions/5g-network-evolution',
            'content' => alepo_get_solution_content('5g_evolution'),
            'template' => 'page-templates/page-solution.php',
            'meta_description' => '5G network evolution solutions for seamless transition from 4G to 5G. Enable new services and monetization opportunities.',
            'focus_keyword' => '5G network evolution',
            'acf_fields' => array(
                'hero_headline' => 'Accelerate Your 5G Network Evolution',
                'hero_subheadline' => 'Enable next-generation services and unlock new revenue streams with our comprehensive 5G solutions.',
                'challenge_addressed' => 'Complex 5G migration, service orchestration challenges, and monetization difficulties.',
                'target_audience' => array('csps', 'mvnos'),
                'implementation_time' => '8-12 weeks'
            )
        ),
        
        array(
            'title' => 'Cloud Migration',
            'slug' => 'solutions/cloud-migration',
            'content' => alepo_get_solution_content('cloud_migration'),
            'template' => 'page-templates/page-solution.php',
            'meta_description' => 'Migrate telecom infrastructure to cloud with confidence. Reduce costs, increase agility, and improve scalability.',
            'focus_keyword' => 'telecom cloud migration'
        ),
        
        array(
            'title' => 'BSS Modernization',
            'slug' => 'solutions/bss-modernization',
            'content' => alepo_get_solution_content('bss_modernization'),
            'template' => 'page-templates/page-solution.php',
            'meta_description' => 'Modernize legacy BSS systems with digital-first platforms. Improve customer experience and operational efficiency.',
            'focus_keyword' => 'BSS modernization'
        ),
        
        array(
            'title' => 'AI-Driven Automation',
            'slug' => 'solutions/ai-driven-automation',
            'content' => alepo_get_solution_content('ai_automation'),
            'template' => 'page-templates/page-solution.php',
            'meta_description' => 'Implement AI-driven automation for telecom operations. Reduce manual tasks and improve network efficiency.',
            'focus_keyword' => 'AI telecom automation'
        ),
        
        array(
            'title' => 'API Gateway Solutions',
            'slug' => 'solutions/api-gateway',
            'content' => alepo_get_solution_content('api_gateway'),
            'template' => 'page-templates/page-solution.php',
            'meta_description' => 'Secure API gateway solutions for telecom services. Enable partner ecosystems and digital service delivery.',
            'focus_keyword' => 'telecom API gateway'
        ),
        
        array(
            'title' => '5G Monetization',
            'slug' => 'solutions/5g-monetization',
            'content' => alepo_get_solution_content('5g_monetization'),
            'template' => 'page-templates/page-solution.php',
            'meta_description' => 'Unlock 5G revenue opportunities with advanced monetization platforms. Dynamic pricing and service orchestration.',
            'focus_keyword' => '5G monetization'
        ),
        
        array(
            'title' => 'Digital Services Enablement',
            'slug' => 'solutions/digital-services-enablement',
            'content' => alepo_get_solution_content('digital_services'),
            'template' => 'page-templates/page-solution.php',
            'meta_description' => 'Enable digital services delivery with modern platforms. Accelerate time-to-market for new offerings.',
            'focus_keyword' => 'digital services enablement'
        ),
        
        array(
            'title' => 'Partner Ecosystem Management',
            'slug' => 'solutions/partner-ecosystem-management',
            'content' => alepo_get_solution_content('partner_ecosystem'),
            'template' => 'page-templates/page-solution.php',
            'meta_description' => 'Manage partner ecosystems efficiently. Enable seamless collaboration and revenue sharing.',
            'focus_keyword' => 'partner ecosystem management'
        ),
        
        array(
            'title' => 'Omnichannel Customer Experience',
            'slug' => 'solutions/omnichannel-cx',
            'content' => alepo_get_solution_content('omnichannel_cx'),
            'template' => 'page-templates/page-solution.php',
            'meta_description' => 'Deliver exceptional omnichannel customer experiences. AI-powered support and personalized interactions.',
            'focus_keyword' => 'omnichannel customer experience'
        ),
        
        array(
            'title' => 'Self-Service Portals',
            'slug' => 'solutions/self-service-portals',
            'content' => alepo_get_solution_content('self_service'),
            'template' => 'page-templates/page-solution.php',
            'meta_description' => 'Modern self-service portals for customers and partners. Reduce support costs and improve satisfaction.',
            'focus_keyword' => 'self-service portals'
        ),
        
        array(
            'title' => 'MNO/MVNO Solutions',
            'slug' => 'solutions/mno-mvno',
            'content' => alepo_get_solution_content('mno_mvno'),
            'template' => 'page-templates/page-solution.php',
            'meta_description' => 'Complete solutions for mobile network operators and MVNOs. Accelerate launch and improve operations.',
            'focus_keyword' => 'MNO MVNO solutions'
        ),
        
        array(
            'title' => 'ISP Solutions',
            'slug' => 'solutions/isp',
            'content' => alepo_get_solution_content('isp'),
            'template' => 'page-templates/page-solution.php',
            'meta_description' => 'Comprehensive platforms for internet service providers. Streamline operations and enhance customer experience.',
            'focus_keyword' => 'ISP solutions'
        ),
        
        array(
            'title' => 'Enterprise Private Networks',
            'slug' => 'solutions/enterprise-private-networks',
            'content' => alepo_get_solution_content('enterprise_private'),
            'template' => 'page-templates/page-solution.php',
            'meta_description' => 'Private network solutions for enterprises. Secure, dedicated connectivity with advanced management.',
            'focus_keyword' => 'enterprise private networks'
        ),
        
        array(
            'title' => 'Wholesale Operators',
            'slug' => 'solutions/wholesale-operators',
            'content' => alepo_get_solution_content('wholesale'),
            'template' => 'page-templates/page-solution.php',
            'meta_description' => 'Scalable platforms for wholesale service providers. Efficient partner management and billing.',
            'focus_keyword' => 'wholesale operators'
        ),
        
        // Product Pages
        array(
            'title' => 'AAA Authentication Server',
            'slug' => 'products/aaa-server',
            'content' => alepo_get_product_content('aaa_server'),
            'template' => 'page-templates/page-product.php',
            'meta_description' => 'Next-generation AAA authentication server for 5G and WiFi networks. RADIUS and Diameter support with 99.999% uptime.',
            'focus_keyword' => 'AAA authentication server',
            'acf_fields' => array(
                'product_icon' => '🔐',
                'product_category' => 'aaa',
                'key_features' => array(
                    array('feature_title' => 'RADIUS & Diameter Support', 'feature_description' => 'Full protocol support for legacy and modern networks'),
                    array('feature_title' => '5G & WiFi Authentication', 'feature_description' => 'Seamless authentication across all network types'),
                    array('feature_title' => 'Policy Control & Management', 'feature_description' => 'Dynamic policy enforcement and real-time updates'),
                    array('feature_title' => 'Security & Fraud Management', 'feature_description' => 'Advanced security features and fraud detection')
                ),
                'performance_metrics' => array(
                    array('metric_value' => '99.999%', 'metric_label' => 'Uptime SLA'),
                    array('metric_value' => '36,000', 'metric_label' => 'Transactions/Second'),
                    array('metric_value' => '<10ms', 'metric_label' => 'Response Time')
                )
            )
        ),
        
        array(
            'title' => 'Digital BSS Platform',
            'slug' => 'products/digital-bss',
            'content' => alepo_get_product_content('digital_bss'),
            'template' => 'page-templates/page-product.php',
            'meta_description' => 'Comprehensive digital BSS platform for modern service providers. Order management, billing, and customer lifecycle.',
            'focus_keyword' => 'digital BSS platform',
            'acf_fields' => array(
                'product_icon' => '💼',
                'product_category' => 'bss'
            )
        ),
        
        array(
            'title' => 'Policy Control (PCRF)',
            'slug' => 'products/pcrf',
            'content' => alepo_get_product_content('pcrf'),
            'template' => 'page-templates/page-product.php',
            'meta_description' => 'Advanced Policy Control and Charging Rules Function (PCRF) for real-time policy management and QoS control.',
            'focus_keyword' => 'PCRF policy control',
            'acf_fields' => array(
                'product_icon' => '⚙️',
                'product_category' => 'aaa'
            )
        ),
        
        array(
            'title' => 'AI-Powered Customer Assistant',
            'slug' => 'products/ai-customer-assistant',
            'content' => alepo_get_product_content('ai_customer'),
            'template' => 'page-templates/page-product.php',
            'meta_description' => 'AI-powered customer assistant for automated support and personalized service delivery.',
            'focus_keyword' => 'AI customer assistant',
            'acf_fields' => array(
                'product_icon' => '🤖',
                'product_category' => 'ai'
            )
        ),
        
        array(
            'title' => 'AI-Powered Agent Assistant',
            'slug' => 'products/ai-agent-assistant',
            'content' => alepo_get_product_content('ai_agent'),
            'template' => 'page-templates/page-product.php',
            'meta_description' => 'AI-powered agent assistant to enhance support team productivity and customer satisfaction.',
            'focus_keyword' => 'AI agent assistant',
            'acf_fields' => array(
                'product_icon' => '👥',
                'product_category' => 'ai'
            )
        ),
        
        // Industry Pages
        array(
            'title' => 'Mobile Network Operators (MNOs)',
            'slug' => 'industries/mobile-operators',
            'content' => alepo_get_industry_content('mobile_operators'),
            'template' => 'page-templates/page-industry.php',
            'meta_description' => 'Telecom solutions for mobile network operators. 5G deployment, network modernization, and customer experience.',
            'focus_keyword' => 'mobile network operators',
            'acf_fields' => array(
                'industry_icon' => '📱',
                'market_size' => '$1.7 trillion',
                'key_challenges' => array(
                    array('challenge_title' => '5G network deployment costs'),
                    array('challenge_title' => 'Legacy system modernization'),
                    array('challenge_title' => 'Subscriber experience optimization')
                )
            )
        ),
        
        array(
            'title' => 'Internet Service Providers (ISPs)',
            'slug' => 'industries/internet-service-providers',
            'content' => alepo_get_industry_content('isp'),
            'template' => 'page-templates/page-industry.php',
            'meta_description' => 'Advanced platforms for internet service providers. Streamline operations and enhance customer experience.',
            'focus_keyword' => 'internet service providers',
            'acf_fields' => array(
                'industry_icon' => '🌐',
                'market_size' => '$450 billion'
            )
        ),
        
        array(
            'title' => 'MVNOs & MVNEs',
            'slug' => 'industries/mvno-mvne',
            'content' => alepo_get_industry_content('mvno'),
            'template' => 'page-templates/page-industry.php',
            'meta_description' => 'Complete solutions for MVNOs and MVNEs. Accelerate launch and improve operational efficiency.',
            'focus_keyword' => 'MVNO MVNE solutions'
        ),
        
        array(
            'title' => 'Satellite & Fixed Wireless',
            'slug' => 'industries/satellite-fixed-wireless',
            'content' => alepo_get_industry_content('satellite'),
            'template' => 'page-templates/page-industry.php',
            'meta_description' => 'Specialized solutions for satellite and fixed wireless operators. Unique connectivity challenges solved.',
            'focus_keyword' => 'satellite fixed wireless'
        ),
        
        array(
            'title' => 'Enterprise & Private LTE/5G',
            'slug' => 'industries/enterprise-private-networks',
            'content' => alepo_get_industry_content('enterprise'),
            'template' => 'page-templates/page-industry.php',
            'meta_description' => 'Private network solutions for enterprises. Secure, dedicated connectivity with advanced management.',
            'focus_keyword' => 'enterprise private networks'
        ),
        
        array(
            'title' => 'Government & Public Sector',
            'slug' => 'industries/government-public-sector',
            'content' => alepo_get_industry_content('government'),
            'template' => 'page-templates/page-industry.php',
            'meta_description' => 'Secure solutions for government and public sector networks. Compliance and security focused.',
            'focus_keyword' => 'government telecom solutions'
        ),
        
        // Customer Pages
        array(
            'title' => 'Customer Success Stories',
            'slug' => 'customers',
            'content' => alepo_get_customer_content('overview'),
            'meta_description' => 'Customer success stories and case studies. See how leading operators transform with Alepo solutions.',
            'focus_keyword' => 'customer success stories'
        ),
        
        array(
            'title' => 'Case Studies',
            'slug' => 'customers/case-studies',
            'content' => alepo_get_customer_content('case_studies'),
            'parent_slug' => 'customers',
            'meta_description' => 'Detailed case studies showing real-world results from Alepo implementations.',
            'focus_keyword' => 'telecom case studies'
        ),
        
        array(
            'title' => 'Testimonials',
            'slug' => 'customers/testimonials',
            'content' => alepo_get_customer_content('testimonials'),
            'parent_slug' => 'customers',
            'meta_description' => 'Customer testimonials and reviews from satisfied Alepo clients worldwide.',
            'focus_keyword' => 'customer testimonials'
        ),
        
        array(
            'title' => 'Customer Portal',
            'slug' => 'customers/portal',
            'content' => alepo_get_customer_content('portal'),
            'parent_slug' => 'customers',
            'meta_description' => 'Secure customer portal access for Alepo clients. Support, documentation, and resources.',
            'focus_keyword' => 'customer portal'
        ),
        
        // Company Pages
        array(
            'title' => 'About Alepo',
            'slug' => 'company/about',
            'content' => alepo_get_company_content('about'),
            'template' => 'page-templates/page-company.php',
            'meta_description' => 'Learn about Alepo - leading provider of telecom software solutions. Our mission, vision, and company history.',
            'focus_keyword' => 'about Alepo'
        ),
        
        array(
            'title' => 'Leadership Team',
            'slug' => 'company/leadership',
            'content' => alepo_get_company_content('leadership'),
            'template' => 'page-templates/page-company.php',
            'parent_slug' => 'company/about',
            'meta_description' => 'Meet the Alepo leadership team. Experienced executives driving telecom innovation.',
            'focus_keyword' => 'Alepo leadership team'
        ),
        
        array(
            'title' => 'Careers',
            'slug' => 'company/careers',
            'content' => alepo_get_company_content('careers'),
            'template' => 'page-templates/page-company.php',
            'parent_slug' => 'company/about',
            'meta_description' => 'Join the Alepo team. Current job openings and career opportunities in telecom technology.',
            'focus_keyword' => 'Alepo careers'
        ),
        
        array(
            'title' => 'Press & News',
            'slug' => 'company/news',
            'content' => alepo_get_company_content('news'),
            'parent_slug' => 'company/about',
            'meta_description' => 'Latest news, press releases, and company announcements from Alepo.',
            'focus_keyword' => 'Alepo news'
        ),
        
        // Resource Pages
        array(
            'title' => 'Resource Center',
            'slug' => 'resources',
            'content' => alepo_get_resource_content('overview'),
            'meta_description' => 'Telecom resources, whitepapers, case studies, and industry insights from Alepo experts.',
            'focus_keyword' => 'telecom resources'
        ),
        
        array(
            'title' => 'Blog',
            'slug' => 'resources/blog',
            'content' => alepo_get_resource_content('blog'),
            'parent_slug' => 'resources',
            'meta_description' => 'Telecom industry insights, trends, and technical articles from Alepo experts.',
            'focus_keyword' => 'telecom blog'
        ),
        
        array(
            'title' => 'Events & Webinars',
            'slug' => 'resources/events',
            'content' => alepo_get_resource_content('events'),
            'parent_slug' => 'resources',
            'meta_description' => 'Upcoming events, webinars, and industry conferences featuring Alepo.',
            'focus_keyword' => 'telecom events'
        ),
        
        // Support Pages
        array(
            'title' => 'Support Center',
            'slug' => 'support',
            'content' => alepo_get_support_content('overview'),
            'meta_description' => 'Alepo support center. Documentation, training, and technical support for customers.',
            'focus_keyword' => 'Alepo support'
        ),
        
        array(
            'title' => 'Documentation',
            'slug' => 'support/documentation',
            'content' => alepo_get_support_content('documentation'),
            'parent_slug' => 'support',
            'meta_description' => 'Technical documentation and user guides for Alepo products and solutions.',
            'focus_keyword' => 'Alepo documentation'
        ),
        
        array(
            'title' => 'Training',
            'slug' => 'support/training',
            'content' => alepo_get_support_content('training'),
            'parent_slug' => 'support',
            'meta_description' => 'Training programs and certification courses for Alepo solutions.',
            'focus_keyword' => 'Alepo training'
        ),
        
        // Legal Pages
        array(
            'title' => 'Privacy Policy',
            'slug' => 'privacy-policy',
            'content' => alepo_get_legal_content('privacy'),
            'meta_description' => 'Alepo privacy policy. How we collect, use, and protect your personal information.',
            'focus_keyword' => 'privacy policy'
        ),
        
        array(
            'title' => 'Terms of Service',
            'slug' => 'terms-of-service',
            'content' => alepo_get_legal_content('terms'),
            'meta_description' => 'Terms of service for using Alepo website and services.',
            'focus_keyword' => 'terms of service'
        ),
        
        array(
            'title' => 'Cookie Policy',
            'slug' => 'cookie-policy',
            'content' => alepo_get_legal_content('cookies'),
            'meta_description' => 'Information about how Alepo uses cookies and similar technologies.',
            'focus_keyword' => 'cookie policy'
        ),
        
        // Additional Core Pages
        array(
            'title' => 'Contact Us',
            'slug' => 'contact',
            'content' => alepo_get_utility_content('contact'),
            'meta_description' => 'Contact Alepo for sales, support, or partnership inquiries. Multiple ways to reach our team.',
            'focus_keyword' => 'contact Alepo'
        ),
        
        array(
            'title' => 'Partners',
            'slug' => 'partners',
            'content' => alepo_get_utility_content('partners'),
            'meta_description' => 'Alepo partner program and ecosystem. Technology partners and channel partners.',
            'focus_keyword' => 'Alepo partners'
        ),
        
        array(
            'title' => 'Request Demo',
            'slug' => 'request-demo',
            'content' => alepo_get_utility_content('demo'),
            'meta_description' => 'Request a personalized demo of Alepo solutions. See our technology in action.',
            'focus_keyword' => 'request demo'
        ),
        
        array(
            'title' => 'Pricing',
            'slug' => 'pricing',
            'content' => alepo_get_utility_content('pricing'),
            'meta_description' => 'Alepo pricing information and plans. Flexible licensing options for all organization sizes.',
            'focus_keyword' => 'Alepo pricing'
        )
    );
}

/**
 * Content generation functions
 */
function alepo_get_homepage_content() {
    return '
<!-- wp:paragraph -->
<p>Leading provider of telecom software solutions for 5G networks, BSS modernization, and digital transformation.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>Our Solutions</h2>
<!-- /wp:heading -->

<!-- wp:columns -->
<div class="wp-block-columns">
<!-- wp:column -->
<div class="wp-block-column">
<!-- wp:heading {"level":3} -->
<h3>Network Modernization</h3>
<!-- /wp:heading -->
<!-- wp:paragraph -->
<p>Transform legacy infrastructure with cloud-native solutions for 5G and beyond.</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column">
<!-- wp:heading {"level":3} -->
<h3>Digital BSS</h3>
<!-- /wp:heading -->
<!-- wp:paragraph -->
<p>Modern business support systems for rapid service delivery and customer experience.</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column">
<!-- wp:heading {"level":3} -->
<h3>AI-Powered CX</h3>
<!-- /wp:heading -->
<!-- wp:paragraph -->
<p>Intelligent customer experience automation and agent assistance solutions.</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:column -->
</div>
<!-- /wp:columns -->
';
}

function alepo_get_solution_content($solution_type) {
    $content_map = array(
        'legacy_aaa' => 'Modernize your legacy AAA infrastructure with our cloud-native solutions. Reduce operational costs by 50% while improving scalability and enabling 5G services.',
        '5g_evolution' => 'Accelerate your 5G network evolution with comprehensive solutions for service orchestration, monetization, and subscriber management.',
        'cloud_migration' => 'Migrate your telecom infrastructure to the cloud with confidence. Our proven methodology ensures zero downtime and immediate benefits.',
        'bss_modernization' => 'Transform legacy BSS systems with modern, API-first platforms that enable rapid service delivery and enhanced customer experiences.',
        'ai_automation' => 'Implement AI-driven automation across your network operations. Reduce manual tasks, improve efficiency, and enhance service quality.',
        'api_gateway' => 'Secure and manage your API ecosystem with enterprise-grade gateway solutions designed for telecom environments.',
        '5g_monetization' => 'Unlock new revenue streams with advanced 5G monetization platforms. Dynamic pricing, service slicing, and real-time billing.',
        'digital_services' => 'Enable rapid deployment of digital services with modern platforms that reduce time-to-market from months to weeks.',
        'partner_ecosystem' => 'Manage complex partner ecosystems efficiently with automated onboarding, billing, and revenue sharing capabilities.',
        'omnichannel_cx' => 'Deliver exceptional customer experiences across all channels with AI-powered personalization and automation.',
        'self_service' => 'Empower customers and partners with intuitive self-service portals that reduce support costs and improve satisfaction.',
        'mno_mvno' => 'Complete solutions for mobile network operators and MVNOs. Accelerate market entry and improve operational efficiency.',
        'isp' => 'Comprehensive platforms designed specifically for internet service providers. Streamline operations and enhance customer experience.',
        'enterprise_private' => 'Private network solutions for enterprises requiring secure, dedicated connectivity with advanced management capabilities.',
        'wholesale' => 'Scalable platforms for wholesale operators with advanced partner management, billing, and service delivery capabilities.'
    );
    
    $base_content = $content_map[$solution_type] ?? 'Comprehensive telecom solution designed to address your specific challenges and requirements.';
    
    return "
<!-- wp:paragraph -->
<p>{$base_content}</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>Key Benefits</h2>
<!-- /wp:heading -->

<!-- wp:list -->
<ul>
<li>Reduced operational costs</li>
<li>Improved scalability and performance</li>
<li>Faster time-to-market for new services</li>
<li>Enhanced customer experience</li>
</ul>
<!-- /wp:list -->

<!-- wp:heading -->
<h2>Implementation Approach</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Our proven methodology ensures successful implementation with minimal disruption to your existing operations.</p>
<!-- /wp:paragraph -->
";
}

function alepo_get_product_content($product_type) {
    return "
<!-- wp:paragraph -->
<p>Advanced telecom software solution designed for modern service providers.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>Key Features</h2>
<!-- /wp:heading -->

<!-- wp:list -->
<ul>
<li>High-performance architecture</li>
<li>Scalable and reliable</li>
<li>Easy integration</li>
<li>Comprehensive management</li>
</ul>
<!-- /wp:list -->

<!-- wp:heading -->
<h2>Technical Specifications</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Built on modern, cloud-native architecture with industry-leading performance and reliability.</p>
<!-- /wp:paragraph -->
";
}

function alepo_get_industry_content($industry_type) {
    return "
<!-- wp:paragraph -->
<p>Specialized solutions designed for the unique challenges and requirements of this industry.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>Industry Challenges</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>We understand the specific challenges facing organizations in this sector and have developed targeted solutions.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>Our Solutions</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Comprehensive portfolio of solutions designed specifically for your industry requirements.</p>
<!-- /wp:paragraph -->
";
}

function alepo_get_customer_content($page_type) {
    return "
<!-- wp:paragraph -->
<p>Learn how leading organizations worldwide have transformed their operations with Alepo solutions.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>Success Stories</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Real results from real customers across various industries and use cases.</p>
<!-- /wp:paragraph -->
";
}

function alepo_get_company_content($page_type) {
    $content_map = array(
        'about' => 'Alepo is a leading provider of telecom software solutions, helping service providers worldwide modernize their networks and transform their operations.',
        'leadership' => 'Meet our experienced leadership team driving innovation in telecom technology.',
        'careers' => 'Join our team of talented professionals working on cutting-edge telecom solutions.',
        'news' => 'Stay updated with the latest news, announcements, and company developments.'
    );
    
    $intro = $content_map[$page_type] ?? 'Learn more about Alepo and our mission to transform the telecom industry.';
    
    return "
<!-- wp:paragraph -->
<p>{$intro}</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>Our Mission</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>To empower service providers with innovative software solutions that drive digital transformation and business growth.</p>
<!-- /wp:paragraph -->
";
}

function alepo_get_resource_content($page_type) {
    return "
<!-- wp:paragraph -->
<p>Access comprehensive resources to help you stay informed about telecom industry trends and best practices.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>Latest Resources</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Whitepapers, case studies, and industry insights from our team of experts.</p>
<!-- /wp:paragraph -->
";
}

function alepo_get_support_content($page_type) {
    return "
<!-- wp:paragraph -->
<p>Comprehensive support resources to help you get the most from your Alepo solutions.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>Support Options</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Multiple support channels and resources available to assist you.</p>
<!-- /wp:paragraph -->
";
}

function alepo_get_legal_content($page_type) {
    return "
<!-- wp:paragraph -->
<p>Important legal information regarding the use of our website and services.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Last updated: " . date('F j, Y') . "</p>
<!-- /wp:paragraph -->
";
}

function alepo_get_utility_content($page_type) {
    $content_map = array(
        'contact' => 'Get in touch with our team for sales inquiries, support, or partnership opportunities.',
        'partners' => 'Join the Alepo partner ecosystem and grow your business with our solutions.',
        'demo' => 'See our solutions in action with a personalized demonstration.',
        'pricing' => 'Flexible pricing options designed to meet the needs of organizations of all sizes.'
    );
    
    $intro = $content_map[$page_type] ?? 'Contact us for more information about our solutions and services.';
    
    return "
<!-- wp:paragraph -->
<p>{$intro}</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>Get Started</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Contact our team to learn more about how Alepo can help transform your operations.</p>
<!-- /wp:paragraph -->
";
}

/**
 * Create navigation menus
 */
function alepo_create_navigation_menus() {
    echo "<br><h3>Creating Navigation Menus...</h3>\n";
    
    // Create primary menu
    $primary_menu_id = wp_create_nav_menu('Primary Menu');
    if (!is_wp_error($primary_menu_id)) {
        // Add menu items
        $menu_items = array(
            array('title' => 'Solutions', 'url' => '/solutions'),
            array('title' => 'Products', 'url' => '/products'),
            array('title' => 'Industries', 'url' => '/industries'),
            array('title' => 'Customers', 'url' => '/customers'),
            array('title' => 'Resources', 'url' => '/resources'),
            array('title' => 'Company', 'url' => '/company/about')
        );
        
        foreach ($menu_items as $item) {
            wp_update_nav_menu_item($primary_menu_id, 0, array(
                'menu-item-title' => $item['title'],
                'menu-item-url' => home_url($item['url']),
                'menu-item-status' => 'publish'
            ));
        }
        
        // Assign to theme location
        $locations = get_theme_mod('nav_menu_locations');
        $locations['primary'] = $primary_menu_id;
        set_theme_mod('nav_menu_locations', $locations);
        
        echo "<div style='color: green;'>✓ Created Primary Menu</div>\n";
    }
}

/**
 * Set homepage
 */
function alepo_set_homepage() {
    echo "<br><h3>Setting Homepage...</h3>\n";
    
    $homepage = get_page_by_path('home');
    if ($homepage) {
        update_option('page_on_front', $homepage->ID);
        update_option('show_on_front', 'page');
        echo "<div style='color: green;'>✓ Set homepage to: Home</div>\n";
    }
}

// Run the script if accessed directly
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    alepo_create_all_pages();
}
?>
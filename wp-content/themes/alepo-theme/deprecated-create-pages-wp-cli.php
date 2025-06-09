<?php
/**
 * Alepo Page Creation Script - WP-CLI Compatible
 * 
 * Usage: wp eval-file create-pages-wp-cli.php
 * 
 * @package Alepo
 */

if (!defined('WP_CLI') && !defined('ABSPATH')) {
    echo "This script must be run through WP-CLI or WordPress admin.\n";
    exit(1);
}

/**
 * Create all Alepo pages
 */
function alepo_create_pages_wp_cli() {
    WP_CLI::log('Starting Alepo page creation...');
    
    $pages_created = 0;
    $pages_data = alepo_get_all_pages_data();
    
    foreach ($pages_data as $page_data) {
        // Check if page exists
        $existing = get_page_by_path($page_data['slug']);
        if ($existing) {
            WP_CLI::log("Page already exists: {$page_data['title']} (ID: {$existing->ID})");
            continue;
        }
        
        // Create page
        $page_id = wp_insert_post([
            'post_title' => $page_data['title'],
            'post_name' => $page_data['slug'],
            'post_content' => $page_data['content'],
            'post_status' => 'publish',
            'post_type' => 'page',
            'meta_input' => [
                '_wp_page_template' => $page_data['template'] ?? 'page.php'
            ]
        ]);
        
        if (is_wp_error($page_id)) {
            WP_CLI::error("Failed to create page: {$page_data['title']} - " . $page_id->get_error_message());
            continue;
        }
        
        // Add ACF fields
        if (!empty($page_data['acf_fields']) && function_exists('update_field')) {
            foreach ($page_data['acf_fields'] as $field_name => $field_value) {
                update_field($field_name, $field_value, $page_id);
            }
        }
        
        // Add SEO meta
        if (!empty($page_data['meta_description'])) {
            update_post_meta($page_id, '_yoast_wpseo_metadesc', $page_data['meta_description']);
        }
        
        WP_CLI::success("Created: {$page_data['title']} (ID: {$page_id})");
        $pages_created++;
    }
    
    WP_CLI::success("Created {$pages_created} pages successfully!");
    
    // Set homepage
    $homepage = get_page_by_path('home');
    if ($homepage) {
        update_option('page_on_front', $homepage->ID);
        update_option('show_on_front', 'page');
        WP_CLI::success("Set homepage to: Home");
    }
}

/**
 * Get simplified pages data
 */
function alepo_get_all_pages_data() {
    return [
        // Homepage
        [
            'title' => 'Home',
            'slug' => 'home',
            'content' => alepo_get_simple_content('homepage'),
            'template' => 'front-page.php',
            'meta_description' => 'Leading provider of telecom software solutions for 5G, BSS, and network modernization.',
            'acf_fields' => [
                'hero_headline' => 'Transform Your Network with Future-Ready Telecom Solutions',
                'hero_subheadline' => 'Comprehensive AAA, BSS, and AI-powered solutions for 5G networks and digital transformation.',
                'hero_cta_primary' => 'Explore Solutions',
                'hero_cta_secondary' => 'Request Demo'
            ]
        ],
        
        // Solutions Pages
        [
            'title' => 'Legacy AAA Replacement',
            'slug' => 'solutions/legacy-aaa-replacement',
            'content' => alepo_get_simple_content('solution'),
            'template' => 'page-templates/page-solution.php',
            'meta_description' => 'Modernize legacy AAA infrastructure with cloud-native solutions. Reduce costs and enable 5G.',
        ],
        [
            'title' => '5G Network Evolution',
            'slug' => 'solutions/5g-network-evolution',
            'content' => alepo_get_simple_content('solution'),
            'template' => 'page-templates/page-solution.php',
            'meta_description' => '5G network evolution solutions for seamless transition and new service enablement.',
        ],
        [
            'title' => 'Cloud Migration',
            'slug' => 'solutions/cloud-migration',
            'content' => alepo_get_simple_content('solution'),
            'template' => 'page-templates/page-solution.php',
            'meta_description' => 'Migrate telecom infrastructure to cloud with confidence and zero downtime.',
        ],
        [
            'title' => 'BSS Modernization',
            'slug' => 'solutions/bss-modernization',
            'content' => alepo_get_simple_content('solution'),
            'template' => 'page-templates/page-solution.php',
            'meta_description' => 'Modernize legacy BSS systems with digital-first platforms.',
        ],
        [
            'title' => 'AI-Driven Automation',
            'slug' => 'solutions/ai-driven-automation',
            'content' => alepo_get_simple_content('solution'),
            'template' => 'page-templates/page-solution.php',
            'meta_description' => 'Implement AI-driven automation for telecom operations.',
        ],
        [
            'title' => 'API Gateway Solutions',
            'slug' => 'solutions/api-gateway',
            'content' => alepo_get_simple_content('solution'),
            'template' => 'page-templates/page-solution.php',
            'meta_description' => 'Secure API gateway solutions for telecom services.',
        ],
        [
            'title' => '5G Monetization',
            'slug' => 'solutions/5g-monetization',
            'content' => alepo_get_simple_content('solution'),
            'template' => 'page-templates/page-solution.php',
            'meta_description' => 'Unlock 5G revenue opportunities with advanced monetization platforms.',
        ],
        [
            'title' => 'Digital Services Enablement',
            'slug' => 'solutions/digital-services-enablement',
            'content' => alepo_get_simple_content('solution'),
            'template' => 'page-templates/page-solution.php',
            'meta_description' => 'Enable digital services delivery with modern platforms.',
        ],
        [
            'title' => 'Partner Ecosystem Management',
            'slug' => 'solutions/partner-ecosystem-management',
            'content' => alepo_get_simple_content('solution'),
            'template' => 'page-templates/page-solution.php',
            'meta_description' => 'Manage partner ecosystems efficiently with automated processes.',
        ],
        [
            'title' => 'Omnichannel Customer Experience',
            'slug' => 'solutions/omnichannel-cx',
            'content' => alepo_get_simple_content('solution'),
            'template' => 'page-templates/page-solution.php',
            'meta_description' => 'Deliver exceptional omnichannel customer experiences.',
        ],
        [
            'title' => 'Self-Service Portals',
            'slug' => 'solutions/self-service-portals',
            'content' => alepo_get_simple_content('solution'),
            'template' => 'page-templates/page-solution.php',
            'meta_description' => 'Modern self-service portals for customers and partners.',
        ],
        [
            'title' => 'MNO/MVNO Solutions',
            'slug' => 'solutions/mno-mvno',
            'content' => alepo_get_simple_content('solution'),
            'template' => 'page-templates/page-solution.php',
            'meta_description' => 'Complete solutions for mobile network operators and MVNOs.',
        ],
        [
            'title' => 'ISP Solutions',
            'slug' => 'solutions/isp',
            'content' => alepo_get_simple_content('solution'),
            'template' => 'page-templates/page-solution.php',
            'meta_description' => 'Comprehensive platforms for internet service providers.',
        ],
        [
            'title' => 'Enterprise Private Networks',
            'slug' => 'solutions/enterprise-private-networks',
            'content' => alepo_get_simple_content('solution'),
            'template' => 'page-templates/page-solution.php',
            'meta_description' => 'Private network solutions for enterprises.',
        ],
        [
            'title' => 'Wholesale Operators',
            'slug' => 'solutions/wholesale-operators',
            'content' => alepo_get_simple_content('solution'),
            'template' => 'page-templates/page-solution.php',
            'meta_description' => 'Scalable platforms for wholesale service providers.',
        ],
        
        // Product Pages
        [
            'title' => 'AAA Authentication Server',
            'slug' => 'products/aaa-server',
            'content' => alepo_get_simple_content('product'),
            'template' => 'page-templates/page-product.php',
            'meta_description' => 'Next-generation AAA authentication server for 5G and WiFi networks.',
            'acf_fields' => [
                'product_icon' => '🔐',
                'product_category' => 'aaa'
            ]
        ],
        [
            'title' => 'Digital BSS Platform',
            'slug' => 'products/digital-bss',
            'content' => alepo_get_simple_content('product'),
            'template' => 'page-templates/page-product.php',
            'meta_description' => 'Comprehensive digital BSS platform for modern service providers.',
            'acf_fields' => [
                'product_icon' => '💼',
                'product_category' => 'bss'
            ]
        ],
        [
            'title' => 'Policy Control (PCRF)',
            'slug' => 'products/pcrf',
            'content' => alepo_get_simple_content('product'),
            'template' => 'page-templates/page-product.php',
            'meta_description' => 'Advanced Policy Control and Charging Rules Function (PCRF).',
            'acf_fields' => [
                'product_icon' => '⚙️',
                'product_category' => 'aaa'
            ]
        ],
        [
            'title' => 'AI-Powered Customer Assistant',
            'slug' => 'products/ai-customer-assistant',
            'content' => alepo_get_simple_content('product'),
            'template' => 'page-templates/page-product.php',
            'meta_description' => 'AI-powered customer assistant for automated support.',
            'acf_fields' => [
                'product_icon' => '🤖',
                'product_category' => 'ai'
            ]
        ],
        [
            'title' => 'AI-Powered Agent Assistant',
            'slug' => 'products/ai-agent-assistant',
            'content' => alepo_get_simple_content('product'),
            'template' => 'page-templates/page-product.php',
            'meta_description' => 'AI-powered agent assistant to enhance support team productivity.',
            'acf_fields' => [
                'product_icon' => '👥',
                'product_category' => 'ai'
            ]
        ],
        
        // Industry Pages
        [
            'title' => 'Mobile Network Operators (MNOs)',
            'slug' => 'industries/mobile-operators',
            'content' => alepo_get_simple_content('industry'),
            'template' => 'page-templates/page-industry.php',
            'meta_description' => 'Telecom solutions for mobile network operators.',
        ],
        [
            'title' => 'Internet Service Providers (ISPs)',
            'slug' => 'industries/internet-service-providers',
            'content' => alepo_get_simple_content('industry'),
            'template' => 'page-templates/page-industry.php',
            'meta_description' => 'Advanced platforms for internet service providers.',
        ],
        [
            'title' => 'MVNOs & MVNEs',
            'slug' => 'industries/mvno-mvne',
            'content' => alepo_get_simple_content('industry'),
            'template' => 'page-templates/page-industry.php',
            'meta_description' => 'Complete solutions for MVNOs and MVNEs.',
        ],
        [
            'title' => 'Satellite & Fixed Wireless',
            'slug' => 'industries/satellite-fixed-wireless',
            'content' => alepo_get_simple_content('industry'),
            'template' => 'page-templates/page-industry.php',
            'meta_description' => 'Specialized solutions for satellite and fixed wireless operators.',
        ],
        [
            'title' => 'Enterprise & Private LTE/5G',
            'slug' => 'industries/enterprise-private-networks',
            'content' => alepo_get_simple_content('industry'),
            'template' => 'page-templates/page-industry.php',
            'meta_description' => 'Private network solutions for enterprises.',
        ],
        [
            'title' => 'Government & Public Sector',
            'slug' => 'industries/government-public-sector',
            'content' => alepo_get_simple_content('industry'),
            'template' => 'page-templates/page-industry.php',
            'meta_description' => 'Secure solutions for government and public sector networks.',
        ],
        
        // Additional core pages (abbreviated for brevity)
        [
            'title' => 'Customer Success Stories',
            'slug' => 'customers',
            'content' => alepo_get_simple_content('customer'),
            'meta_description' => 'Customer success stories and case studies from Alepo implementations.',
        ],
        [
            'title' => 'About Alepo',
            'slug' => 'company/about',
            'content' => alepo_get_simple_content('company'),
            'template' => 'page-templates/page-company.php',
            'meta_description' => 'Learn about Alepo - leading provider of telecom software solutions.',
        ],
        [
            'title' => 'Resource Center',
            'slug' => 'resources',
            'content' => alepo_get_simple_content('resource'),
            'meta_description' => 'Telecom resources, whitepapers, and industry insights.',
        ],
        [
            'title' => 'Support Center',
            'slug' => 'support',
            'content' => alepo_get_simple_content('support'),
            'meta_description' => 'Alepo support center with documentation and training.',
        ],
        [
            'title' => 'Contact Us',
            'slug' => 'contact',
            'content' => alepo_get_simple_content('contact'),
            'meta_description' => 'Contact Alepo for sales, support, or partnership inquiries.',
        ],
        [
            'title' => 'Request Demo',
            'slug' => 'request-demo',
            'content' => alepo_get_simple_content('demo'),
            'meta_description' => 'Request a personalized demo of Alepo solutions.',
        ]
    ];
}

/**
 * Get simple content by type
 */
function alepo_get_simple_content($type) {
    $content_templates = [
        'homepage' => "<!-- wp:heading -->\n<h2>Leading Telecom Software Solutions</h2>\n<!-- /wp:heading -->\n\n<!-- wp:paragraph -->\n<p>Transform your network with our comprehensive portfolio of 5G, BSS, and AI-powered solutions designed for modern service providers.</p>\n<!-- /wp:paragraph -->",
        
        'solution' => "<!-- wp:heading -->\n<h2>Overview</h2>\n<!-- /wp:heading -->\n\n<!-- wp:paragraph -->\n<p>Comprehensive solution designed to address your specific telecom challenges and drive digital transformation.</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:heading -->\n<h2>Key Benefits</h2>\n<!-- /wp:heading -->\n\n<!-- wp:list -->\n<ul><li>Reduced operational costs</li><li>Improved scalability and performance</li><li>Faster time-to-market</li><li>Enhanced customer experience</li></ul>\n<!-- /wp:list -->",
        
        'product' => "<!-- wp:heading -->\n<h2>Product Overview</h2>\n<!-- /wp:heading -->\n\n<!-- wp:paragraph -->\n<p>Advanced telecom software solution built on modern, cloud-native architecture for maximum performance and reliability.</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:heading -->\n<h2>Key Features</h2>\n<!-- /wp:heading -->\n\n<!-- wp:list -->\n<ul><li>High-performance architecture</li><li>Scalable and reliable</li><li>Easy integration</li><li>Comprehensive management</li></ul>\n<!-- /wp:list -->",
        
        'industry' => "<!-- wp:heading -->\n<h2>Industry Solutions</h2>\n<!-- /wp:heading -->\n\n<!-- wp:paragraph -->\n<p>Specialized solutions designed for the unique challenges and requirements of this industry sector.</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:heading -->\n<h2>Why Choose Alepo</h2>\n<!-- /wp:heading -->\n\n<!-- wp:paragraph -->\n<p>Deep industry expertise and proven track record of successful implementations worldwide.</p>\n<!-- /wp:paragraph -->",
        
        'customer' => "<!-- wp:heading -->\n<h2>Customer Success</h2>\n<!-- /wp:heading -->\n\n<!-- wp:paragraph -->\n<p>Learn how leading organizations worldwide have transformed their operations with Alepo solutions.</p>\n<!-- /wp:paragraph -->",
        
        'company' => "<!-- wp:heading -->\n<h2>About Alepo</h2>\n<!-- /wp:heading -->\n\n<!-- wp:paragraph -->\n<p>Alepo is a leading provider of telecom software solutions, helping service providers modernize their networks and transform operations.</p>\n<!-- /wp:paragraph -->",
        
        'resource' => "<!-- wp:heading -->\n<h2>Resources</h2>\n<!-- /wp:heading -->\n\n<!-- wp:paragraph -->\n<p>Access comprehensive resources including whitepapers, case studies, and industry insights.</p>\n<!-- /wp:paragraph -->",
        
        'support' => "<!-- wp:heading -->\n<h2>Support</h2>\n<!-- /wp:heading -->\n\n<!-- wp:paragraph -->\n<p>Comprehensive support resources to help you get the most from your Alepo solutions.</p>\n<!-- /wp:paragraph -->",
        
        'contact' => "<!-- wp:heading -->\n<h2>Contact Us</h2>\n<!-- /wp:heading -->\n\n<!-- wp:paragraph -->\n<p>Get in touch with our team for sales inquiries, support, or partnership opportunities.</p>\n<!-- /wp:paragraph -->",
        
        'demo' => "<!-- wp:heading -->\n<h2>Request Demo</h2>\n<!-- /wp:heading -->\n\n<!-- wp:paragraph -->\n<p>See our solutions in action with a personalized demonstration tailored to your needs.</p>\n<!-- /wp:paragraph -->"
    ];
    
    return $content_templates[$type] ?? "<!-- wp:paragraph -->\n<p>Welcome to this page. Content coming soon.</p>\n<!-- /wp:paragraph -->";
}

// Run if using WP-CLI
if (defined('WP_CLI') && WP_CLI) {
    alepo_create_pages_wp_cli();
}
?>
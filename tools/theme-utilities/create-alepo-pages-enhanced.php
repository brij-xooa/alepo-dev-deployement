<?php
/**
 * Enhanced Alepo Page Creator with Template System
 * Supports section-specific generation with consistent templates
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

class AlepoPageCreator {
    
    public $content_base_dir;
    public $template_base_dir;
    private $available_sections = ['products', 'solutions', 'industries'];
    public $templates = [];
    private $gutenberg_processor;
    
    public function __construct() {
        // Try multiple path strategies
        $theme_dir = get_template_directory();
        
        // Strategy 1: Relative to theme (current)
        $this->content_base_dir = $theme_dir . '/../../../alepo-generated-content/01-page-content';
        $this->template_base_dir = $theme_dir . '/../../../alepo-templates';
        
        // Strategy 2: If that doesn't work, try absolute paths
        if (!is_dir($this->template_base_dir)) {
            $possible_paths = [
                ABSPATH . '../alepo-templates',
                dirname(ABSPATH) . '/alepo-templates',
                '/nas/content/live/alepodev/alepo-templates'
            ];
            
            foreach ($possible_paths as $path) {
                if (is_dir($path)) {
                    $this->template_base_dir = $path;
                    $this->content_base_dir = str_replace('alepo-templates', 'alepo-generated-content/01-page-content', $path);
                    break;
                }
            }
        }
        
        $this->load_templates();
        $this->gutenberg_processor = new AlepoGutenbergProcessor();
    }
    
    /**
     * Load all available templates
     */
    private function load_templates() {
        $template_files = glob($this->template_base_dir . '/page-templates/*.json');
        
        // Debug: Log what we're finding
        error_log("Template base dir: " . $this->template_base_dir);
        error_log("Template files found: " . print_r($template_files, true));
        
        foreach ($template_files as $file) {
            $template_name = basename($file, '.json');
            $template_content = json_decode(file_get_contents($file), true);
            
            if ($template_content === null) {
                error_log("Failed to load template: " . $file);
                continue;
            }
            
            $this->templates[$template_name] = $template_content;
            error_log("Loaded template: " . $template_name);
        }
        
        error_log("Available templates: " . print_r(array_keys($this->templates), true));
    }
    
    /**
     * Get available pages for a section
     */
    public function get_available_pages($section) {
        $pages = [];
        $section_dir = $this->content_base_dir . '/' . $section;
        
        if (!is_dir($section_dir)) {
            return $pages;
        }
        
        $subdirs = glob($section_dir . '/*', GLOB_ONLYDIR);
        foreach ($subdirs as $subdir) {
            $page_slug = basename($subdir);
            
            // Skip placeholder directories
            if (strpos($page_slug, '{') !== false) {
                continue;
            }
            
            $metadata_file = $subdir . '/metadata.json';
            $content_file = $subdir . '/content.html';
            
            if (file_exists($content_file)) {
                $metadata = file_exists($metadata_file) ? json_decode(file_get_contents($metadata_file), true) : [];
                
                $pages[] = [
                    'slug' => $page_slug,
                    'title' => $metadata['title'] ?? ucwords(str_replace('-', ' ', $page_slug)),
                    'has_content' => true,
                    'has_metadata' => file_exists($metadata_file),
                    'path' => $subdir
                ];
            }
        }
        
        return $pages;
    }
    
    /**
     * Create pages with template application
     */
    public function create_pages($section, $selected_pages, $options = []) {
        $results = [
            'success' => [],
            'errors' => [],
            'warnings' => []
        ];
        
        // Determine which template to use
        // Handle plural section names by converting to singular for template lookup
        // Priority: wireframe templates for solutions, fallback to standard templates
        $template_mapping = [
            'products' => 'product-template',
            'solutions' => 'solution-wireframe-template', // Use wireframe-based template
            'industries' => 'industry-template'
        ];
        
        $template_name = $template_mapping[$section] ?? $section . '-template';
        
        if (!isset($this->templates[$template_name])) {
            $results['errors'][] = [
                'page' => $section,
                'message' => "Template not found for section: {$section}. Looking for: {$template_name}. Available: " . implode(', ', array_keys($this->templates))
            ];
            return $results;
        }
        
        $template = $this->templates[$template_name];
        
        // Create parent page if needed
        $parent_id = $this->ensure_parent_page($section);
        
        foreach ($selected_pages as $page_slug) {
            $result = $this->create_single_page($section, $page_slug, $template, $parent_id, $options);
            
            if ($result['status'] === 'success') {
                $results['success'][] = $result;
            } elseif ($result['status'] === 'error') {
                $results['errors'][] = $result;
            } else {
                $results['warnings'][] = $result;
            }
        }
        
        // Flush rewrite rules after all pages created
        flush_rewrite_rules(true);
        
        return $results;
    }
    
    /**
     * Create a single page with template
     */
    private function create_single_page($section, $page_slug, $template, $parent_id, $options) {
        $page_dir = $this->content_base_dir . '/' . $section . '/' . $page_slug;
        $content_file = $page_dir . '/content.html';
        $metadata_file = $page_dir . '/metadata.json';
        
        if (!file_exists($content_file)) {
            return [
                'status' => 'error',
                'page' => $page_slug,
                'message' => 'Content file not found'
            ];
        }
        
        // Load content and metadata
        $raw_content = file_get_contents($content_file);
        $metadata = file_exists($metadata_file) ? json_decode(file_get_contents($metadata_file), true) : [];
        
        // Process content through template
        $processed_content = $this->apply_template($raw_content, $metadata, $template, $section);
        
        // Convert to Gutenberg blocks if specified
        if (!empty($options['convert_to_gutenberg'])) {
            $processed_content = $this->gutenberg_processor->convert_to_blocks($processed_content, $template);
        }
        
        // Check if page exists
        $existing_page = get_page_by_path($section . '/' . $page_slug, OBJECT, 'page');
        
        // Prepare page data
        $page_data = [
            'post_title' => $metadata['title'] ?? ucwords(str_replace('-', ' ', $page_slug)),
            'post_content' => $processed_content,
            'post_status' => 'publish',
            'post_type' => 'page',
            'post_name' => $page_slug,
            'post_parent' => $parent_id,
            'meta_input' => $this->prepare_meta_input($metadata, $template)
        ];
        
        // Create or update page
        if ($existing_page) {
            $page_data['ID'] = $existing_page->ID;
            $page_id = wp_update_post($page_data);
            $action = 'updated';
        } else {
            $page_id = wp_insert_post($page_data);
            $action = 'created';
        }
        
        if (is_wp_error($page_id)) {
            return [
                'status' => 'error',
                'page' => $page_slug,
                'message' => $page_id->get_error_message()
            ];
        }
        
        // Set page template if specified
        if (!empty($template['wordpress_template'])) {
            update_post_meta($page_id, '_wp_page_template', $template['wordpress_template']);
        }
        
        return [
            'status' => 'success',
            'page' => $page_slug,
            'page_id' => $page_id,
            'action' => $action,
            'url' => get_permalink($page_id)
        ];
    }
    
    /**
     * Apply template to content
     */
    private function apply_template($raw_content, $metadata, $template, $section) {
        // Parse raw content into structured data
        $content_data = $this->parse_content($raw_content, $metadata);
        
        // Build page using template sections
        $structured_content = '';
        
        foreach ($template['sections'] as $section_config) {
            if (!$section_config['required'] && empty($content_data[$section_config['name']])) {
                continue;
            }
            
            $section_content = $this->build_section(
                $section_config,
                $content_data,
                $metadata
            );
            
            $structured_content .= $section_content . "\n\n";
        }
        
        return $structured_content;
    }
    
    /**
     * Build a single section based on template
     */
    private function build_section($section_config, $content_data, $metadata) {
        // Determine template file based on variation
        $template_variation = $section_config['template_variation'] ?? 'gutenberg';
        $block_type = str_replace('alepo/', '', $section_config['type']);
        
        // Enhanced block template loading for wireframe templates
        $block_template_file = null;
        
        // For wireframe templates, the block_type already includes "-wireframe"
        if (strpos($template_variation, 'wireframe') !== false || strpos($block_type, '-wireframe') !== false) {
            // If block_type already has '-wireframe', use it directly
            if (strpos($block_type, '-wireframe') !== false) {
                $wireframe_paths = [
                    $this->template_base_dir . '/block-library/content-blocks/' . $block_type . '.html',
                    $this->template_base_dir . '/block-library/hero-blocks/' . $block_type . '.html'
                ];
            } else {
                // Otherwise append '-wireframe'
                $wireframe_paths = [
                    $this->template_base_dir . '/block-library/content-blocks/' . $block_type . '-wireframe.html',
                    $this->template_base_dir . '/block-library/hero-blocks/' . $block_type . '-wireframe.html'
                ];
            }
            
            foreach ($wireframe_paths as $path) {
                if (file_exists($path)) {
                    $block_template_file = $path;
                    break;
                }
            }
        }
        
        // Fallback to variation-specific template (e.g., product-hero-modern.html)
        if (!$block_template_file) {
            $block_template_file = $this->template_base_dir . '/block-library/hero-blocks/' . $block_type . '-' . $template_variation . '.html';
        }
        
        // Fallback to standard template
        if (!file_exists($block_template_file)) {
            $block_template_file = $this->template_base_dir . '/block-library/hero-blocks/' . $block_type . '-gutenberg.html';
        }
        
        // Final fallback to content
        if (!file_exists($block_template_file)) {
            return $content_data[$section_config['name']] ?? '';
        }
        
        $block_template = file_get_contents($block_template_file);
        
        // Replace template variables with wireframe-specific logic
        $replacements = $this->prepare_wireframe_replacements($section_config, $content_data, $metadata);
        
        foreach ($replacements as $key => $value) {
            $block_template = str_replace('{{' . $key . '}}', $value, $block_template);
        }
        
        return $block_template;
    }
    
    /**
     * Prepare meta input for WordPress
     */
    private function prepare_meta_input($metadata, $template) {
        $meta_input = [
            '_alepo_custom_generated' => true,
            '_alepo_generation_date' => current_time('mysql'),
            '_alepo_template_used' => $template['templateName']
        ];
        
        // Add SEO meta
        if (!empty($metadata['meta_description'])) {
            $meta_input['_yoast_wpseo_metadesc'] = $metadata['meta_description'];
        }
        
        if (!empty($metadata['primary_keyword'])) {
            $meta_input['_yoast_wpseo_focuskw'] = $metadata['primary_keyword'];
        }
        
        // Add ACF fields
        if (!empty($metadata['acf_fields'])) {
            foreach ($metadata['acf_fields'] as $field => $value) {
                $meta_input[$field] = $value;
            }
        }
        
        return $meta_input;
    }
    
    /**
     * Ensure parent page exists
     */
    private function ensure_parent_page($section) {
        $parent_page = get_page_by_path($section, OBJECT, 'page');
        
        if (!$parent_page) {
            $parent_data = [
                'post_title' => ucfirst($section),
                'post_content' => $this->get_parent_page_content($section),
                'post_status' => 'publish',
                'post_type' => 'page',
                'post_name' => $section
            ];
            
            $parent_id = wp_insert_post($parent_data);
            return is_wp_error($parent_id) ? 0 : $parent_id;
        }
        
        return $parent_page->ID;
    }
    
    /**
     * Get default parent page content
     */
    private function get_parent_page_content($section) {
        $titles = [
            'products' => 'Our Products',
            'solutions' => 'Solutions for Every Challenge',
            'industries' => 'Industry Expertise'
        ];
        
        $descriptions = [
            'products' => 'Explore our comprehensive suite of telecom solutions designed for the 5G era.',
            'solutions' => 'Find the perfect solution for your specific business challenges.',
            'industries' => 'Tailored solutions for your industry\'s unique requirements.'
        ];
        
        return sprintf(
            '<h1>%s</h1><p>%s</p>',
            $titles[$section] ?? ucfirst($section),
            $descriptions[$section] ?? "Explore our {$section}."
        );
    }
    
    /**
     * Parse content into structured data
     */
    private function parse_content($raw_content, $metadata) {
        // This is a simplified parser - in production, use a proper HTML parser
        $data = [];
        
        // Extract sections based on common patterns
        if (preg_match('/<section[^>]*class="hero-section[^"]*"[^>]*>(.*?)<\/section>/s', $raw_content, $matches)) {
            $data['hero'] = $matches[1];
        }
        
        if (preg_match('/<section[^>]*class="challenge-section[^"]*"[^>]*>(.*?)<\/section>/s', $raw_content, $matches)) {
            $data['challenge'] = $matches[1];
        }
        
        // Add more section extractions as needed
        
        return $data;
    }
    
    /**
     * Prepare template variable replacements
     */
    private function prepare_replacements($section_config, $content_data, $metadata) {
        $replacements = [];
        
        // Map content to template variables
        if (!empty($metadata['title'])) {
            $replacements['productName'] = $metadata['title'];
            $replacements['productSlug'] = $metadata['slug'] ?? sanitize_title($metadata['title']);
        }
        
        // Add section-specific replacements
        if ($section_config['name'] === 'hero' && !empty($content_data['hero'])) {
            // Extract headline and subheadline from hero content
            if (preg_match('/<h1[^>]*>(.*?)<\/h1>/s', $content_data['hero'], $matches)) {
                $replacements['productHeadline'] = strip_tags($matches[1]);
            }
            
            if (preg_match('/<p[^>]*class="hero-subheadline[^"]*"[^>]*>(.*?)<\/p>/s', $content_data['hero'], $matches)) {
                $replacements['productSubheadline'] = strip_tags($matches[1]);
            }
        }
        
        // Add CTA replacements
        $replacements['primaryCTAText'] = $metadata['acf_fields']['cta_primary']['text'] ?? 'Learn More';
        $replacements['primaryCTAUrl'] = $metadata['acf_fields']['cta_primary']['url'] ?? '#';
        $replacements['secondaryCTAText'] = $metadata['acf_fields']['cta_secondary']['text'] ?? 'Download Resources';
        $replacements['secondaryCTAUrl'] = $metadata['acf_fields']['cta_secondary']['url'] ?? '#';
        
        // Enhanced data for modern templates
        if (!empty($metadata['acf_fields']['performance_metrics'])) {
            $replacements['productStats'] = $this->format_stats_for_template($metadata['acf_fields']['performance_metrics']);
        }
        
        // Add more complex data structures
        if (!empty($metadata['acf_fields']['key_features'])) {
            $replacements['productFeatures'] = $this->format_features_for_template($metadata['acf_fields']['key_features']);
        }
        
        return $replacements;
    }
    
    /**
     * Prepare wireframe-specific template variable replacements
     */
    private function prepare_wireframe_replacements($section_config, $content_data, $metadata) {
        $replacements = $this->prepare_replacements($section_config, $content_data, $metadata);
        
        // Add wireframe-specific variables based on section type
        $section_name = $section_config['name'];
        
        switch ($section_name) {
            case 'hero':
                $replacements = array_merge($replacements, $this->get_wireframe_hero_vars($metadata));
                break;
                
            case 'capability-section':
                $replacements = array_merge($replacements, $this->get_wireframe_capability_vars($metadata, $content_data));
                break;
                
            case 'technical-features':
                $replacements = array_merge($replacements, $this->get_wireframe_technical_vars($metadata));
                break;
                
            case 'business-benefits':
                $replacements = array_merge($replacements, $this->get_wireframe_benefits_vars($metadata));
                break;
                
            case 'customer-success':
                $replacements = array_merge($replacements, $this->get_wireframe_customer_vars($metadata));
                break;
                
            case 'final-cta':
                $replacements = array_merge($replacements, $this->get_wireframe_cta_vars($metadata));
                break;
        }
        
        return $replacements;
    }
    
    /**
     * Get wireframe hero section variables
     */
    private function get_wireframe_hero_vars($metadata) {
        return [
            'heroHeadline' => $metadata['title'] ?? 'Solution Name',
            'heroSubheadline' => $metadata['hero_subheadline'] ?? 'Transform your telecom operations with our proven solution.',
            'heroBreadcrumb' => 'Solutions',
            'primaryCTAText' => $metadata['acf_fields']['cta_primary']['text'] ?? 'Explore Solution',
            'primaryCTAUrl' => $metadata['acf_fields']['cta_primary']['url'] ?? '#contact',
            'secondaryCTAText' => $metadata['acf_fields']['cta_secondary']['text'] ?? 'Download Guide',
            'secondaryCTAUrl' => $metadata['acf_fields']['cta_secondary']['url'] ?? '#resources'
        ];
    }
    
    /**
     * Get wireframe capability section variables
     */
    private function get_wireframe_capability_vars($metadata, $content_data) {
        return [
            'capabilityGroupTitle' => $metadata['capability_group_title'] ?? 'Core Capabilities',
            'capability1Title' => $metadata['capability_1_title'] ?? 'Advanced Analytics',
            'capability1Description' => $metadata['capability_1_desc'] ?? 'Real-time insights and predictive analytics to optimize network performance and reduce operational costs.',
            'capability2Title' => $metadata['capability_2_title'] ?? 'Seamless Integration',
            'capability2Description' => $metadata['capability_2_desc'] ?? 'Native APIs and protocols ensure smooth integration with existing infrastructure and third-party systems.',
            'capability3Title' => $metadata['capability_3_title'] ?? 'Scalable Architecture',
            'capability3Description' => $metadata['capability_3_desc'] ?? 'Cloud-native design supports millions of subscribers with elastic scaling and high availability.',
            'layoutVariation' => 'layout-left',
            'contentWidth' => '60%',
            'visualWidth' => '40%',
            'visualPlaceholder' => 'Capability+Diagram',
            'visualAltText' => 'Solution capability diagram',
            'visualCaption' => 'Integrated solution architecture'
        ];
    }
    
    /**
     * Get wireframe technical features variables
     */
    private function get_wireframe_technical_vars($metadata) {
        return [
            'technicalFeaturesTitle' => 'Technical Features',
            'feature1Icon' => '🔗',
            'feature1Description' => 'Protocol Support (RADIUS, Diameter, 5G)',
            'feature2Icon' => '⚡',
            'feature2Description' => 'High Performance (36,000+ TPS)',
            'feature3Icon' => '🛡️',
            'feature3Description' => 'Enterprise Security & Compliance',
            'feature4Icon' => '🏗️',
            'feature4Description' => 'Microservices Architecture',
            'feature5Icon' => '📊',
            'feature5Description' => 'Real-time Analytics Dashboard',
            'feature6Icon' => '🔄',
            'feature6Description' => 'Zero-downtime Updates',
            'feature7Icon' => '🌐',
            'feature7Description' => 'Multi-tenant Support',
            'feature8Icon' => '🚀',
            'feature8Description' => 'Auto-scaling Capabilities'
        ];
    }
    
    /**
     * Get wireframe business benefits variables
     */
    private function get_wireframe_benefits_vars($metadata) {
        return [
            'businessBenefitsTitle' => 'Business Benefits',
            'benefit1Icon' => '💰',
            'benefit1Title' => 'Cost Reduction',
            'benefit1Description' => 'Reduce operational expenses by 30-50% through automation and efficient resource utilization.',
            'benefit1Metric' => 'Up to 50% savings',
            'benefit2Icon' => '⚡',
            'benefit2Title' => 'Faster Time-to-Market',
            'benefit2Description' => 'Launch new services 3x faster with pre-built templates and automated provisioning.',
            'benefit2Metric' => '3x faster deployment',
            'benefit3Icon' => '📈',
            'benefit3Title' => 'Revenue Growth',
            'benefit3Description' => 'Increase ARPU through personalized services and improved customer experience.',
            'benefit3Metric' => '15-25% ARPU increase',
            'benefit4Icon' => '🎯',
            'benefit4Title' => 'Operational Excellence',
            'benefit4Description' => 'Achieve 99.99% uptime with proactive monitoring and automated incident response.',
            'benefit4Metric' => '99.99% uptime'
        ];
    }
    
    /**
     * Get wireframe customer success variables
     */
    private function get_wireframe_customer_vars($metadata) {
        return [
            'customerSuccessTitle' => 'Customer Success',
            'customerQuote' => '"This solution transformed our network operations and reduced costs by 40% within six months."',
            'customerName' => 'Sarah Chen, CTO',
            'customerCompany' => 'Global Telecom Leader',
            'companyLogo' => null, // Will be set if available
            'trustIndicators' => ['500M+ Subscribers', 'Global Deployment', 'Telecom Leader']
        ];
    }
    
    /**
     * Get wireframe final CTA variables
     */
    private function get_wireframe_cta_vars($metadata) {
        return [
            'ctaHeadline' => 'Ready to Transform Your Operations?',
            'ctaSupportingText' => 'Join leading operators who trust Alepo for mission-critical solutions.',
            'primaryCTAText' => 'Schedule Demo',
            'primaryCTAUrl' => '/contact',
            'secondaryCTAText' => 'Download Guide',
            'secondaryCTAUrl' => '/resources',
            'trustSignals' => ['99.99% Uptime', 'SOC2 Certified', '24/7 Support'],
            'contactInfo' => 'Contact our solution architects: solutions@alepo.com'
        ];
    }
    
    /**
     * Format stats for modern template consumption
     */
    private function format_stats_for_template($stats) {
        $formatted_stats = [];
        foreach ($stats as $stat) {
            $formatted_stats[] = [
                'value' => $stat['metric'],
                'label' => $stat['label'],
                'description' => $stat['description'] ?? '',
                'numericValue' => preg_replace('/[^0-9]/', '', $stat['metric']), // Extract numbers for animation
                'percentage' => $this->calculate_stat_percentage($stat['metric']) // For progress bars
            ];
        }
        return json_encode($formatted_stats);
    }
    
    /**
     * Calculate percentage for progress bar visualization
     */
    private function calculate_stat_percentage($metric) {
        // Simple mapping logic - can be enhanced
        if (strpos($metric, '%') !== false) {
            return floatval($metric);
        } elseif (strpos($metric, '36,000') !== false) {
            return 95; // TPS performance
        } elseif (strpos($metric, '500M') !== false) {
            return 88; // Subscribers
        } else {
            return 75; // Default
        }
    }
    
    /**
     * Format features for template consumption
     */
    private function format_features_for_template($features) {
        $formatted_features = [];
        foreach ($features as $index => $feature) {
            $formatted_features[] = [
                'title' => $feature,
                'icon' => $this->get_feature_icon($feature),
                'delay' => ($index + 1) * 100 // For staggered animations
            ];
        }
        return json_encode($formatted_features);
    }
    
    /**
     * Get appropriate icon for feature
     */
    private function get_feature_icon($feature) {
        $icons = [
            'Performance' => '⚡',
            'Uptime' => '🛡️',
            'Protocol' => '🔗',
            'Security' => '🔐',
            'Architecture' => '🏗️',
            'Migration' => '🚀'
        ];
        
        foreach ($icons as $keyword => $icon) {
            if (stripos($feature, $keyword) !== false) {
                return $icon;
            }
        }
        
        return '✨'; // Default icon
    }
}

/**
 * Gutenberg block processor class
 */
class AlepoGutenbergProcessor {
    
    public function convert_to_blocks($content, $template) {
        // This would contain the logic to convert HTML to Gutenberg blocks
        // For now, returning the content as-is
        return $content;
    }
}

/**
 * Admin interface for the enhanced page creator
 */
add_action('admin_menu', function() {
    add_menu_page(
        'Alepo Page Creator',
        'Alepo Pages',
        'manage_options',
        'alepo-page-creator',
        'alepo_page_creator_admin_page',
        'dashicons-layout',
        30
    );
});

function alepo_page_creator_admin_page() {
    $creator = new AlepoPageCreator();
    
    // Debug: Show template loading status
    if (isset($_GET['debug'])) {
        echo '<div class="notice notice-info"><p>';
        echo '<strong>Debug Info:</strong><br>';
        echo 'Template base dir: ' . $creator->template_base_dir . '<br>';
        echo 'Content base dir: ' . $creator->content_base_dir . '<br>';
        echo 'Available templates: ' . implode(', ', array_keys($creator->templates)) . '<br>';
        echo '</p></div>';
    }
    
    // Handle form submission
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create_pages'])) {
        $section = sanitize_text_field($_POST['section']);
        $selected_pages = isset($_POST['pages']) ? array_map('sanitize_text_field', $_POST['pages']) : [];
        $options = [
            'convert_to_gutenberg' => !empty($_POST['convert_to_gutenberg'])
        ];
        
        $results = $creator->create_pages($section, $selected_pages, $options);
        
        // Display results
        if (!empty($results['success'])) {
            echo '<div class="notice notice-success"><p>';
            echo '<strong>Successfully created/updated ' . count($results['success']) . ' pages:</strong><br>';
            foreach ($results['success'] as $success) {
                if (is_array($success)) {
                    echo '✅ ' . ($success['page'] ?? 'Unknown') . ' (' . ($success['action'] ?? 'processed') . ') - <a href="' . ($success['url'] ?? '#') . '" target="_blank">View Page</a><br>';
                } else {
                    echo '✅ ' . $success . '<br>';
                }
            }
            echo '</p></div>';
        }
        
        if (!empty($results['errors'])) {
            echo '<div class="notice notice-error"><p>';
            echo '<strong>Errors:</strong><br>';
            foreach ($results['errors'] as $error) {
                if (is_array($error)) {
                    echo '❌ ' . ($error['page'] ?? 'Unknown') . ': ' . ($error['message'] ?? 'Unknown error') . '<br>';
                } else {
                    echo '❌ ' . $error . '<br>';
                }
            }
            echo '</p></div>';
        }
    }
    
    ?>
    <div class="wrap">
        <h1>Alepo Page Creator - Template-Based Generation</h1>
        <p>Create WordPress pages with consistent templates while preserving creative content.</p>
        
        <style>
            .alepo-creator-form { background: #fff; padding: 20px; margin-top: 20px; border: 1px solid #ccd0d4; }
            .section-selector { margin-bottom: 20px; }
            .page-selector { margin: 20px 0; max-height: 400px; overflow-y: auto; border: 1px solid #ddd; padding: 10px; }
            .page-item { margin: 5px 0; padding: 5px; background: #f5f5f5; }
            .page-item label { display: block; cursor: pointer; }
            .page-item:hover { background: #e8e8e8; }
            .options-section { margin: 20px 0; padding: 15px; background: #f9f9f9; }
            .template-info { margin: 10px 0; padding: 10px; background: #e3f2fd; border-left: 4px solid #2196f3; }
        </style>
        
        <form method="post" class="alepo-creator-form">
            <div class="section-selector">
                <h2>1. Select Section Type</h2>
                <select name="section" id="section-select" required>
                    <option value="">-- Select Section --</option>
                    <option value="products">Products</option>
                    <option value="solutions">Solutions</option>
                    <option value="industries">Industries</option>
                </select>
                
                <div class="template-info" style="display: none;">
                    <strong>Template Info:</strong> <span id="template-description"></span>
                </div>
            </div>
            
            <div id="page-selector-container" style="display: none;">
                <h2>2. Select Pages to Create/Update</h2>
                <div class="page-selector" id="page-selector">
                    <!-- Pages will be loaded here via AJAX -->
                </div>
                <p>
                    <button type="button" id="select-all">Select All</button>
                    <button type="button" id="select-none">Select None</button>
                </p>
            </div>
            
            <div class="options-section" style="display: none;">
                <h2>3. Generation Options</h2>
                <label>
                    <input type="checkbox" name="convert_to_gutenberg" value="1" checked>
                    Convert to Gutenberg blocks (Recommended for Spectra compatibility)
                </label>
            </div>
            
            <div class="submit-section" style="display: none;">
                <input type="submit" name="create_pages" value="Create Selected Pages" class="button button-primary button-large">
            </div>
        </form>
        
        <script>
        jQuery(document).ready(function($) {
            const templateDescriptions = {
                'products': 'Product pages with hero, challenge/solution comparison, features, technical specs, ROI, and testimonials.',
                'solutions': 'WIREFRAME-BASED: Hero (60-80 words) → 3 Capability Sections (120-150 words each) → Technical Features (80-120 words) → Business Benefits (160-200 words) → Customer Success (40-60 words) → Final CTA (25-40 words). Total: 550-650 words.',
                'industries': 'Industry pages with sector overview, challenges, solutions, success stories, and industry-specific CTAs.'
            };
            
            $('#section-select').on('change', function() {
                const section = $(this).val();
                
                if (section) {
                    // Show template info
                    $('#template-description').text(templateDescriptions[section] || 'Standard template for ' + section);
                    $('.template-info').show();
                    
                    // Load available pages
                    $.post(ajaxurl, {
                        action: 'alepo_get_section_pages',
                        section: section
                    }, function(response) {
                        if (response.success) {
                            let html = '';
                            response.data.forEach(function(page) {
                                html += '<div class="page-item">';
                                html += '<label>';
                                html += '<input type="checkbox" name="pages[]" value="' + page.slug + '">';
                                html += ' ' + page.title;
                                if (!page.has_metadata) {
                                    html += ' <em>(No metadata)</em>';
                                }
                                html += '</label>';
                                html += '</div>';
                            });
                            
                            $('#page-selector').html(html);
                            $('#page-selector-container, .options-section, .submit-section').show();
                        }
                    });
                } else {
                    $('.template-info, #page-selector-container, .options-section, .submit-section').hide();
                }
            });
            
            $('#select-all').on('click', function() {
                $('#page-selector input[type="checkbox"]').prop('checked', true);
            });
            
            $('#select-none').on('click', function() {
                $('#page-selector input[type="checkbox"]').prop('checked', false);
            });
        });
        </script>
    </div>
    <?php
}

// AJAX handler for getting section pages
add_action('wp_ajax_alepo_get_section_pages', function() {
    $creator = new AlepoPageCreator();
    $section = sanitize_text_field($_POST['section']);
    
    $pages = $creator->get_available_pages($section);
    
    wp_send_json_success($pages);
});
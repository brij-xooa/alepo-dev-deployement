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
        $template_name = $section . '-template';
        if (!isset($this->templates[$template_name])) {
            $results['errors'][] = [
                'page' => $section,
                'message' => "Template not found for section: {$section}"
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
        // Load block template
        $block_template_file = $this->template_base_dir . '/block-library/' . 
                              str_replace('alepo/', '', $section_config['type']) . '-gutenberg.html';
        
        if (!file_exists($block_template_file)) {
            // Fallback to content if template not found
            return $content_data[$section_config['name']] ?? '';
        }
        
        $block_template = file_get_contents($block_template_file);
        
        // Replace template variables
        $replacements = $this->prepare_replacements($section_config, $content_data, $metadata);
        
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
        
        return $replacements;
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
                'solutions': 'Solution pages with problem narrative, approach methodology, benefits, implementation, and case studies.',
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
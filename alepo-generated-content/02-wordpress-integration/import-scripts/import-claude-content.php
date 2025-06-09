<?php
/**
 * Import Claude-generated content to WordPress
 * This script preserves unique, creative content while setting up proper WordPress structure
 */

// Load WordPress
require_once(dirname(__DIR__, 3) . '/wp-load.php');

class AlepoContentImporter {
    private $content_base_dir;
    private $import_log = [];
    
    public function __construct($content_dir = null) {
        $this->content_base_dir = $content_dir ?: dirname(dirname(__DIR__)) . '/01-page-content';
    }
    
    /**
     * Main import function
     */
    public function import_all_content() {
        echo "🚀 Starting Alepo content import...\n\n";
        
        // Import pages by category
        $this->import_homepage();
        $this->import_product_pages();
        $this->import_solution_pages();
        $this->import_industry_pages();
        $this->import_company_pages();
        
        // Create menu structure
        $this->create_navigation_menus();
        
        // Display import summary
        $this->display_import_summary();
    }
    
    /**
     * Import a single page from Claude-generated content
     */
    private function import_page($page_path, $parent_id = 0) {
        // Check if page directory exists
        if (!is_dir($page_path)) {
            $this->log_error("Directory not found: $page_path");
            return false;
        }
        
        // Read content files
        $content_file = $page_path . '/content.html';
        $metadata_file = $page_path . '/metadata.json';
        
        if (!file_exists($content_file) || !file_exists($metadata_file)) {
            $this->log_error("Missing content files in: $page_path");
            return false;
        }
        
        $content = file_get_contents($content_file);
        $metadata = json_decode(file_get_contents($metadata_file), true);
        
        if (!$metadata) {
            $this->log_error("Invalid metadata in: $metadata_file");
            return false;
        }
        
        // Check if page already exists
        $existing_page = get_page_by_path($metadata['slug'], OBJECT, 'page');
        
        $page_data = [
            'post_title'    => $metadata['title'],
            'post_content'  => $content,
            'post_name'     => $metadata['slug'],
            'post_status'   => 'publish',
            'post_type'     => 'page',
            'post_parent'   => $parent_id,
            'meta_input'    => [
                '_alepo_custom_generated' => true,
                '_alepo_generation_date' => current_time('mysql')
            ]
        ];
        
        if ($existing_page) {
            $page_data['ID'] = $existing_page->ID;
            $page_id = wp_update_post($page_data);
            $action = 'Updated';
        } else {
            $page_id = wp_insert_post($page_data);
            $action = 'Created';
        }
        
        if (is_wp_error($page_id)) {
            $this->log_error("Failed to import: {$metadata['title']} - " . $page_id->get_error_message());
            return false;
        }
        
        // Set page template if specified
        if (!empty($metadata['page_template'])) {
            update_post_meta($page_id, '_wp_page_template', $metadata['page_template']);
        }
        
        // Set ACF fields if available
        if (function_exists('update_field') && !empty($metadata['acf_fields'])) {
            foreach ($metadata['acf_fields'] as $field_key => $field_value) {
                update_field($field_key, $field_value, $page_id);
            }
        }
        
        // Set SEO metadata (Yoast)
        if (!empty($metadata['meta_description'])) {
            update_post_meta($page_id, '_yoast_wpseo_metadesc', $metadata['meta_description']);
        }
        if (!empty($metadata['primary_keyword'])) {
            update_post_meta($page_id, '_yoast_wpseo_focuskw', $metadata['primary_keyword']);
        }
        
        $this->log_success("$action: {$metadata['title']} (ID: $page_id)");
        return $page_id;
    }
    
    /**
     * Import homepage
     */
    private function import_homepage() {
        echo "📄 Importing Homepage...\n";
        $homepage_id = $this->import_page($this->content_base_dir . '/homepage');
        
        if ($homepage_id) {
            // Set as front page
            update_option('page_on_front', $homepage_id);
            update_option('show_on_front', 'page');
        }
    }
    
    /**
     * Import product pages
     */
    private function import_product_pages() {
        echo "\n📦 Importing Product Pages...\n";
        
        // Create parent products page if needed
        $parent_page = get_page_by_path('products');
        if (!$parent_page) {
            $parent_id = wp_insert_post([
                'post_title' => 'Products',
                'post_name' => 'products',
                'post_status' => 'publish',
                'post_type' => 'page'
            ]);
        } else {
            $parent_id = $parent_page->ID;
        }
        
        $products_dir = $this->content_base_dir . '/products';
        if (is_dir($products_dir)) {
            $product_folders = glob($products_dir . '/*', GLOB_ONLYDIR);
            foreach ($product_folders as $product_folder) {
                $this->import_page($product_folder, $parent_id);
            }
        }
    }
    
    /**
     * Import solution pages
     */
    private function import_solution_pages() {
        echo "\n💡 Importing Solution Pages...\n";
        
        // Create parent solutions page if needed
        $parent_page = get_page_by_path('solutions');
        if (!$parent_page) {
            $parent_id = wp_insert_post([
                'post_title' => 'Solutions',
                'post_name' => 'solutions',
                'post_status' => 'publish',
                'post_type' => 'page'
            ]);
        } else {
            $parent_id = $parent_page->ID;
        }
        
        $solutions_dir = $this->content_base_dir . '/solutions';
        if (is_dir($solutions_dir)) {
            $solution_folders = glob($solutions_dir . '/*', GLOB_ONLYDIR);
            foreach ($solution_folders as $solution_folder) {
                $this->import_page($solution_folder, $parent_id);
            }
        }
    }
    
    /**
     * Import industry pages
     */
    private function import_industry_pages() {
        echo "\n🏭 Importing Industry Pages...\n";
        
        // Create parent industries page if needed
        $parent_page = get_page_by_path('industries');
        if (!$parent_page) {
            $parent_id = wp_insert_post([
                'post_title' => 'Industries',
                'post_name' => 'industries',
                'post_status' => 'publish',
                'post_type' => 'page'
            ]);
        } else {
            $parent_id = $parent_page->ID;
        }
        
        $industries_dir = $this->content_base_dir . '/industries';
        if (is_dir($industries_dir)) {
            $industry_folders = glob($industries_dir . '/*', GLOB_ONLYDIR);
            foreach ($industry_folders as $industry_folder) {
                $this->import_page($industry_folder, $parent_id);
            }
        }
    }
    
    /**
     * Import company pages
     */
    private function import_company_pages() {
        echo "\n🏢 Importing Company Pages...\n";
        
        $company_dir = $this->content_base_dir . '/company';
        if (is_dir($company_dir)) {
            $company_folders = glob($company_dir . '/*', GLOB_ONLYDIR);
            foreach ($company_folders as $company_folder) {
                $this->import_page($company_folder);
            }
        }
    }
    
    /**
     * Create navigation menus
     */
    private function create_navigation_menus() {
        echo "\n🔗 Setting up navigation menus...\n";
        
        // This would be populated based on the menu structure in metadata
        // For now, we'll create a basic structure
        
        $menu_name = 'Primary Menu';
        $menu_exists = wp_get_nav_menu_object($menu_name);
        
        if (!$menu_exists) {
            $menu_id = wp_create_nav_menu($menu_name);
        } else {
            $menu_id = $menu_exists->term_id;
        }
        
        // Set menu location
        $locations = get_theme_mod('nav_menu_locations');
        $locations['primary'] = $menu_id;
        set_theme_mod('nav_menu_locations', $locations);
        
        $this->log_success("Navigation menu configured");
    }
    
    /**
     * Logging functions
     */
    private function log_success($message) {
        echo "✅ $message\n";
        $this->import_log[] = ['type' => 'success', 'message' => $message];
    }
    
    private function log_error($message) {
        echo "❌ $message\n";
        $this->import_log[] = ['type' => 'error', 'message' => $message];
    }
    
    /**
     * Display import summary
     */
    private function display_import_summary() {
        echo "\n" . str_repeat('=', 50) . "\n";
        echo "📊 IMPORT SUMMARY\n";
        echo str_repeat('=', 50) . "\n\n";
        
        $success_count = 0;
        $error_count = 0;
        
        foreach ($this->import_log as $log) {
            if ($log['type'] === 'success') {
                $success_count++;
            } else {
                $error_count++;
            }
        }
        
        echo "✅ Successful imports: $success_count\n";
        echo "❌ Failed imports: $error_count\n";
        
        if ($error_count > 0) {
            echo "\n⚠️  Errors encountered:\n";
            foreach ($this->import_log as $log) {
                if ($log['type'] === 'error') {
                    echo "   - {$log['message']}\n";
                }
            }
        }
        
        echo "\n🎉 Import process complete!\n";
    }
}

// Run the import if called directly
if (php_sapi_name() === 'cli' || (!empty($_GET['run']) && $_GET['run'] === 'import')) {
    $importer = new AlepoContentImporter();
    $importer->import_all_content();
}
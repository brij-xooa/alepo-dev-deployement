<?php
/**
 * Admin Page Creator - Add to WordPress Admin Menu
 */

// Add admin menu item
add_action('admin_menu', 'alepo_add_admin_menu');
add_action('admin_init', 'alepo_handle_page_creation');

function alepo_add_admin_menu() {
    add_management_page(
        'Create Alepo Pages',
        'Create Alepo Pages', 
        'manage_options',
        'alepo-create-pages',
        'alepo_admin_page_creator'
    );
}

function alepo_admin_page_creator() {
    ?>
    <div class="wrap">
        <h1>Create Alepo Pages</h1>
        
        <div class="notice notice-info">
            <p><strong>This will create all 47 Alepo pages with proper content and ACF fields.</strong></p>
            <p>Pages that already exist will be skipped (not overwritten).</p>
        </div>
        
        <?php
        // Show existing pages count and some details
        $pages = get_pages();
        $alepo_pages = get_pages(array('meta_key' => '_alepo_page_type'));
        ?>
        
        <div class="notice notice-warning">
            <p><strong>Current Status:</strong></p>
            <ul>
                <li>Total pages in database: <?php echo count($pages); ?></li>
                <li>Alepo pages already created: <?php echo count($alepo_pages); ?></li>
                <li>Pages remaining to create: <?php echo max(0, 47 - count($alepo_pages)); ?></li>
            </ul>
        </div>
        
        <form method="post" action="">
            <?php wp_nonce_field('alepo_create_pages_action', 'alepo_create_pages_nonce'); ?>
            <p>
                <input type="submit" name="create_alepo_pages" class="button button-primary button-large" 
                       value="<?php echo count($alepo_pages) > 0 ? 'Create Remaining Alepo Pages' : 'Create All Alepo Pages'; ?>" 
                       onclick="return confirm('This will create the Alepo pages. Continue?');">
                
                <input type="submit" name="create_test_page" class="button button-secondary" 
                       value="Create Test Page (Debug)" 
                       onclick="return confirm('This will create a simple test page for debugging.');">
            </p>
        </form>
        
        <?php if (count($alepo_pages) > 0): ?>
        <h3>Existing Alepo Pages:</h3>
        <ul style="column-count: 3; column-gap: 20px;">
            <?php foreach ($alepo_pages as $page): ?>
                <li><a href="<?php echo get_permalink($page->ID); ?>" target="_blank"><?php echo $page->post_title; ?></a></li>
            <?php endforeach; ?>
        </ul>
        <?php endif; ?>
    </div>
    <?php
}

function alepo_handle_page_creation() {
    // Handle test page creation
    if (isset($_POST['create_test_page']) && 
        wp_verify_nonce($_POST['alepo_create_pages_nonce'], 'alepo_create_pages_action')) {
        
        ob_start();
        
        echo "<h3>Creating Test Page...</h3>\n";
        
        $test_page_data = array(
            'post_title'    => 'Test Page - ' . date('Y-m-d H:i:s'),
            'post_name'     => 'test-page-' . time(),
            'post_content'  => '<h1>Test Page</h1><p>This is a test page created at ' . date('Y-m-d H:i:s') . '</p>',
            'post_status'   => 'publish',
            'post_type'     => 'page',
            'post_author'   => get_current_user_id()
        );
        
        $page_id = wp_insert_post($test_page_data);
        
        if (is_wp_error($page_id)) {
            echo "<div style='color: red;'>Error: " . $page_id->get_error_message() . "</div>\n";
        } else {
            echo "<div style='color: green;'>✓ Test page created successfully with ID: {$page_id}</div>\n";
            echo "<p><a href='" . get_permalink($page_id) . "' target='_blank'>View Test Page</a></p>\n";
        }
        
        $output = ob_get_clean();
        set_transient('alepo_page_creation_output', $output, 300);
        
        wp_redirect(admin_url('tools.php?page=alepo-create-pages&created=1'));
        exit;
    }
    
    if (isset($_POST['create_alepo_pages']) && 
        wp_verify_nonce($_POST['alepo_create_pages_nonce'], 'alepo_create_pages_action')) {
        
        // Include the page creation functions
        require_once(get_template_directory() . '/create-pages.php');
        
        // Capture output and store results
        ob_start();
        
        try {
            // Add debug information
            echo "<h3>Debug Information:</h3>\n";
            echo "Current user ID: " . get_current_user_id() . "<br>\n";
            echo "User can manage options: " . (current_user_can('manage_options') ? 'Yes' : 'No') . "<br>\n";
            echo "User can edit pages: " . (current_user_can('edit_pages') ? 'Yes' : 'No') . "<br>\n";
            
            // Test if functions exist
            echo "alepo_get_pages_data function exists: " . (function_exists('alepo_get_pages_data') ? 'Yes' : 'No') . "<br>\n";
            
            // Test getting page data
            $pages_data = alepo_get_pages_data();
            echo "Number of pages to create: " . count($pages_data) . "<br><br>\n";
            
            // Run the main function
            $result = alepo_create_all_pages();
            
        } catch (Exception $e) {
            echo "<div style='color: red;'>Error: " . $e->getMessage() . "</div>\n";
        }
        
        $output = ob_get_clean();
        
        // Store the output in transient for display
        set_transient('alepo_page_creation_output', $output, 300);
        
        // Redirect to avoid resubmission
        wp_redirect(admin_url('tools.php?page=alepo-create-pages&created=1'));
        exit;
    }
    
    // Show success message and detailed output
    if (isset($_GET['created'])) {
        add_action('admin_notices', function() {
            echo '<div class="notice notice-success"><p><strong>Alepo pages have been created successfully!</strong></p></div>';
            
            // Show detailed creation output
            $output = get_transient('alepo_page_creation_output');
            if ($output) {
                echo '<div class="notice notice-info" style="max-height: 400px; overflow-y: auto;">';
                echo '<h3>Creation Details:</h3>';
                echo '<div style="font-family: monospace; font-size: 12px; background: #f9f9f9; padding: 10px; border: 1px solid #ddd;">';
                echo $output;
                echo '</div>';
                echo '</div>';
                
                // Clean up the transient
                delete_transient('alepo_page_creation_output');
            }
        });
    }
}
?>
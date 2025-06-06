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
            <p><strong>This will create all 47 Alepo pages.</strong> Only run this once on a fresh installation.</p>
        </div>
        
        <form method="post" action="">
            <?php wp_nonce_field('alepo_create_pages_action', 'alepo_create_pages_nonce'); ?>
            <p>
                <input type="submit" name="create_alepo_pages" class="button button-primary button-large" 
                       value="Create All Alepo Pages" 
                       onclick="return confirm('This will create 47 pages. Are you sure?');">
            </p>
        </form>
        
        <?php
        // Show existing pages count
        $pages = get_pages();
        echo "<p>Current pages in database: " . count($pages) . "</p>";
        ?>
    </div>
    <?php
}

function alepo_handle_page_creation() {
    if (isset($_POST['create_alepo_pages']) && 
        wp_verify_nonce($_POST['alepo_create_pages_nonce'], 'alepo_create_pages_action')) {
        
        // Include the page creation functions
        require_once(get_template_directory() . '/create-pages.php');
        
        // Redirect to avoid resubmission
        wp_redirect(admin_url('tools.php?page=alepo-create-pages&created=1'));
        exit;
    }
    
    // Show success message
    if (isset($_GET['created'])) {
        add_action('admin_notices', function() {
            echo '<div class="notice notice-success"><p>Alepo pages have been created successfully!</p></div>';
        });
    }
}
?>
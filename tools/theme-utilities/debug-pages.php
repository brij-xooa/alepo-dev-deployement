<?php
/**
 * Debug Page Creation - Check User Capabilities
 */

// Load WordPress
require_once(dirname(__FILE__) . '/../../../wp-load.php');

echo "<h1>Debug Page Creation</h1>";

// Check current user
$current_user = wp_get_current_user();
echo "<h2>Current User Info:</h2>";
echo "<p><strong>User ID:</strong> " . $current_user->ID . "</p>";
echo "<p><strong>User Login:</strong> " . $current_user->user_login . "</p>";
echo "<p><strong>User Email:</strong> " . $current_user->user_email . "</p>";

// Check capabilities
echo "<h2>User Capabilities:</h2>";
echo "<p><strong>manage_options:</strong> " . (current_user_can('manage_options') ? 'YES' : 'NO') . "</p>";
echo "<p><strong>edit_pages:</strong> " . (current_user_can('edit_pages') ? 'YES' : 'NO') . "</p>";
echo "<p><strong>publish_pages:</strong> " . (current_user_can('publish_pages') ? 'YES' : 'NO') . "</p>";
echo "<p><strong>administrator:</strong> " . (current_user_can('administrator') ? 'YES' : 'NO') . "</p>";

// Check user roles
echo "<h2>User Roles:</h2>";
if (!empty($current_user->roles)) {
    foreach ($current_user->roles as $role) {
        echo "<p>- " . $role . "</p>";
    }
} else {
    echo "<p>No roles assigned</p>";
}

// Test page creation
echo "<h2>Test Page Creation:</h2>";
if (current_user_can('edit_pages')) {
    $test_page = array(
        'post_title' => 'Test Page - ' . date('Y-m-d H:i:s'),
        'post_content' => 'This is a test page created by the debug script.',
        'post_status' => 'publish',
        'post_type' => 'page'
    );
    
    $page_id = wp_insert_post($test_page);
    
    if ($page_id && !is_wp_error($page_id)) {
        echo "<p style='color: green;'>✅ Successfully created test page with ID: " . $page_id . "</p>";
        echo "<p><a href='" . get_permalink($page_id) . "'>View Test Page</a></p>";
    } else {
        echo "<p style='color: red;'>❌ Failed to create test page</p>";
        if (is_wp_error($page_id)) {
            echo "<p>Error: " . $page_id->get_error_message() . "</p>";
        }
    }
} else {
    echo "<p style='color: red;'>❌ User cannot edit pages</p>";
}
?>
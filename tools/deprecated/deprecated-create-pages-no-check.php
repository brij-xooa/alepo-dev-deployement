<?php
/**
 * Alepo Page Creation Script - No Permission Check
 * Creates all 47 core pages with proper structure and ACF fields
 * 
 * @package Alepo
 * @version 1.0.0
 */

// Security check
if (!defined('ABSPATH')) {
    // Load WordPress if running standalone
    require_once(dirname(__FILE__) . '/../../../wp-load.php');
}

// REMOVED PERMISSION CHECK - Use at your own risk!

// Include all the functions from the original create-pages.php
require_once(dirname(__FILE__) . '/create-pages.php');

// Just run the page creation directly
alepo_create_all_pages();
?>
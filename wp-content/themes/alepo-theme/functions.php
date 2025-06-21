<?php
/**
 * Alepo Theme Functions
 * Page Builder Agnostic WordPress Theme with ACF Support
 * 
 * @package Alepo
 * @version 1.0.0
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Load Alepo Components Library
require_once get_template_directory() . '/inc/alepo-components-enqueue.php';

// Load Alepo Page Creator Updates for Enhanced Templates
if (file_exists(get_template_directory() . '/../../tools/theme-utilities/alepo-page-creator-update.php')) {
    require_once get_template_directory() . '/../../tools/theme-utilities/alepo-page-creator-update.php';
}

/**
 * Theme Setup
 */
function alepo_theme_setup() {
    // Add theme support features
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo', array(
        'height' => 50,
        'width' => 200,
        'flex-height' => true,
        'flex-width' => true,
    ));
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ));
    add_theme_support('customize-selective-refresh-widgets');
    add_theme_support('responsive-embeds');
    add_theme_support('wp-block-styles');
    add_theme_support('align-wide');
    add_theme_support('editor-color-palette', array(
        array(
            'name' => __('Primary Blue', 'alepo'),
            'slug' => 'primary-blue',
            'color' => '#0066CC',
        ),
        array(
            'name' => __('Primary Blue Dark', 'alepo'),
            'slug' => 'primary-blue-dark',
            'color' => '#0052A3',
        ),
        array(
            'name' => __('Dark Gray', 'alepo'),
            'slug' => 'dark-gray',
            'color' => '#2C3E50',
        ),
        array(
            'name' => __('Text Gray', 'alepo'),
            'slug' => 'text-gray',
            'color' => '#666666',
        ),
        array(
            'name' => __('Light Gray', 'alepo'),
            'slug' => 'light-gray',
            'color' => '#F8F9FA',
        ),
        array(
            'name' => __('Accent Green', 'alepo'),
            'slug' => 'accent-green',
            'color' => '#00C851',
        ),
    ));
    
    // Register navigation menus
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'alepo'),
        'utility' => __('Utility Menu', 'alepo'),
        'footer' => __('Footer Menu', 'alepo'),
        'mobile' => __('Mobile Menu', 'alepo'),
    ));
    
    // Set content width
    $GLOBALS['content_width'] = 1200;
    
    // Add image sizes
    add_image_size('hero-banner', 1920, 1080, true);
    add_image_size('hero-inner', 1920, 600, true);
    add_image_size('feature-image', 800, 600, true);
    add_image_size('product-screenshot', 1200, 800, true);
    add_image_size('thumbnail-large', 400, 300, true);
    add_image_size('logo-size', 200, 80, true);
}
add_action('after_setup_theme', 'alepo_theme_setup');

/**
 * Enqueue Scripts and Styles
 */
function alepo_scripts() {
    // External libraries first
    wp_enqueue_style('bootstrap-icons', 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.0/font/bootstrap-icons.min.css', array(), '1.11.0');
    wp_enqueue_style('bootstrap-css', 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css', array(), '5.3.0');
    
    // Enqueue theme stylesheet
    wp_enqueue_style('alepo-style', get_stylesheet_uri(), array('bootstrap-css'), '1.0.0');
    
    // Enqueue mega menu styles CSS
    wp_enqueue_style('alepo-mega-menu-styles', get_template_directory_uri() . '/mega-menu-styles.css', array('alepo-style'), '1.0.0');
    
    // Enqueue Google Fonts
    wp_enqueue_style('alepo-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap', array(), null);
    
    // Enqueue theme JavaScript
    wp_enqueue_script('alepo-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '1.0.0', true);
    wp_enqueue_script('alepo-animations', get_template_directory_uri() . '/js/animations.js', array(), '1.0.0', true);
    
    // Enqueue comment reply script
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
    
    // Localize script for AJAX
    wp_localize_script('alepo-navigation', 'alepo_ajax', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('alepo_nonce'),
    ));
}
add_action('wp_enqueue_scripts', 'alepo_scripts');

/**
 * Register Widget Areas
 */
function alepo_widgets_init() {
    register_sidebar(array(
        'name' => __('Footer Column 1', 'alepo'),
        'id' => 'footer-1',
        'description' => __('Add widgets here to appear in the first footer column.', 'alepo'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
    
    register_sidebar(array(
        'name' => __('Footer Column 2', 'alepo'),
        'id' => 'footer-2',
        'description' => __('Add widgets here to appear in the second footer column.', 'alepo'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
    
    register_sidebar(array(
        'name' => __('Footer Column 3', 'alepo'),
        'id' => 'footer-3',
        'description' => __('Add widgets here to appear in the third footer column.', 'alepo'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
    
    register_sidebar(array(
        'name' => __('Footer Column 4', 'alepo'),
        'id' => 'footer-4',
        'description' => __('Add widgets here to appear in the fourth footer column.', 'alepo'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
}
add_action('widgets_init', 'alepo_widgets_init');

/**
 * Include Enhanced Page Creator and Template System
 */
require_once get_template_directory() . '/../../../tools/theme-utilities/create-alepo-pages-enhanced.php';
require_once get_template_directory() . '/../../../alepo-templates/validation/template-mapping-demo.php';

/**
 * ACF Field Groups Registration
 */
function alepo_register_acf_fields() {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }
    
    // Page Hero Fields
    acf_add_local_field_group(array(
        'key' => 'group_page_hero',
        'title' => 'Page Hero',
        'fields' => array(
            array(
                'key' => 'field_hero_headline',
                'label' => 'Hero Headline',
                'name' => 'hero_headline',
                'type' => 'text',
                'required' => 1,
                'placeholder' => 'Compelling Hero Headline',
            ),
            array(
                'key' => 'field_hero_subheadline',
                'label' => 'Hero Subheadline',
                'name' => 'hero_subheadline',
                'type' => 'textarea',
                'rows' => 3,
                'placeholder' => 'Supporting hero text that expands on the value proposition',
            ),
            array(
                'key' => 'field_hero_image',
                'label' => 'Hero Image',
                'name' => 'hero_image',
                'type' => 'image',
                'return_format' => 'array',
                'preview_size' => 'medium',
            ),
            array(
                'key' => 'field_hero_cta_primary',
                'label' => 'Primary CTA Text',
                'name' => 'hero_cta_primary',
                'type' => 'text',
                'placeholder' => 'Get Started',
            ),
            array(
                'key' => 'field_hero_cta_primary_url',
                'label' => 'Primary CTA URL',
                'name' => 'hero_cta_primary_url',
                'type' => 'url',
            ),
            array(
                'key' => 'field_hero_cta_secondary',
                'label' => 'Secondary CTA Text',
                'name' => 'hero_cta_secondary',
                'type' => 'text',
                'placeholder' => 'Learn More',
            ),
            array(
                'key' => 'field_hero_cta_secondary_url',
                'label' => 'Secondary CTA URL',
                'name' => 'hero_cta_secondary_url',
                'type' => 'url',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'page',
                ),
            ),
        ),
    ));
    
    // Product Details Fields
    acf_add_local_field_group(array(
        'key' => 'group_product_details',
        'title' => 'Product Details',
        'fields' => array(
            array(
                'key' => 'field_product_icon',
                'label' => 'Product Icon',
                'name' => 'product_icon',
                'type' => 'text',
                'placeholder' => '🔐',
                'instructions' => 'Enter an emoji or icon character',
            ),
            array(
                'key' => 'field_product_category',
                'label' => 'Product Category',
                'name' => 'product_category',
                'type' => 'select',
                'choices' => array(
                    'aaa' => 'AAA Solutions',
                    'bss' => 'BSS Solutions',
                    'ai' => 'AI-Powered CX',
                ),
            ),
            array(
                'key' => 'field_key_features',
                'label' => 'Key Features',
                'name' => 'key_features',
                'type' => 'repeater',
                'sub_fields' => array(
                    array(
                        'key' => 'field_feature_title',
                        'label' => 'Feature Title',
                        'name' => 'feature_title',
                        'type' => 'text',
                    ),
                    array(
                        'key' => 'field_feature_description',
                        'label' => 'Feature Description',
                        'name' => 'feature_description',
                        'type' => 'textarea',
                        'rows' => 2,
                    ),
                ),
                'button_label' => 'Add Feature',
            ),
            array(
                'key' => 'field_technical_specs',
                'label' => 'Technical Specifications',
                'name' => 'technical_specs',
                'type' => 'textarea',
                'rows' => 5,
            ),
            array(
                'key' => 'field_performance_metrics',
                'label' => 'Performance Metrics',
                'name' => 'performance_metrics',
                'type' => 'repeater',
                'sub_fields' => array(
                    array(
                        'key' => 'field_metric_value',
                        'label' => 'Metric Value',
                        'name' => 'metric_value',
                        'type' => 'text',
                        'placeholder' => '99.999%',
                    ),
                    array(
                        'key' => 'field_metric_label',
                        'label' => 'Metric Label',
                        'name' => 'metric_label',
                        'type' => 'text',
                        'placeholder' => 'Uptime',
                    ),
                ),
                'button_label' => 'Add Metric',
            ),
            array(
                'key' => 'field_deployment_options',
                'label' => 'Deployment Options',
                'name' => 'deployment_options',
                'type' => 'checkbox',
                'choices' => array(
                    'on-premises' => 'On-premises',
                    'private-cloud' => 'Private Cloud',
                    'public-cloud' => 'Public Cloud',
                    'hybrid' => 'Hybrid',
                ),
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'page_template',
                    'operator' => '==',
                    'value' => 'page-templates/page-product.php',
                ),
            ),
        ),
    ));
    
    // Solution Components Fields
    acf_add_local_field_group(array(
        'key' => 'group_solution_components',
        'title' => 'Solution Components',
        'fields' => array(
            array(
                'key' => 'field_challenge_addressed',
                'label' => 'Challenge Addressed',
                'name' => 'challenge_addressed',
                'type' => 'textarea',
                'rows' => 3,
            ),
            array(
                'key' => 'field_target_audience',
                'label' => 'Target Audience',
                'name' => 'target_audience',
                'type' => 'checkbox',
                'choices' => array(
                    'csps' => 'Communication Service Providers',
                    'mvnos' => 'MVNOs',
                    'isps' => 'ISPs',
                    'enterprises' => 'Enterprises',
                ),
            ),
            array(
                'key' => 'field_implementation_time',
                'label' => 'Implementation Time',
                'name' => 'implementation_time',
                'type' => 'text',
                'placeholder' => '6-8 weeks',
            ),
            array(
                'key' => 'field_roi_metrics',
                'label' => 'ROI Metrics',
                'name' => 'roi_metrics',
                'type' => 'repeater',
                'sub_fields' => array(
                    array(
                        'key' => 'field_roi_metric',
                        'label' => 'Metric',
                        'name' => 'roi_metric',
                        'type' => 'text',
                        'placeholder' => '50%',
                    ),
                    array(
                        'key' => 'field_roi_description',
                        'label' => 'Description',
                        'name' => 'roi_description',
                        'type' => 'text',
                        'placeholder' => 'Reduction in operational costs',
                    ),
                ),
                'button_label' => 'Add ROI Metric',
            ),
            array(
                'key' => 'field_solution_benefits',
                'label' => 'Solution Benefits',
                'name' => 'solution_benefits',
                'type' => 'repeater',
                'sub_fields' => array(
                    array(
                        'key' => 'field_benefit_title',
                        'label' => 'Benefit Title',
                        'name' => 'benefit_title',
                        'type' => 'text',
                    ),
                    array(
                        'key' => 'field_benefit_description',
                        'label' => 'Benefit Description',
                        'name' => 'benefit_description',
                        'type' => 'textarea',
                        'rows' => 2,
                    ),
                    array(
                        'key' => 'field_benefit_icon',
                        'label' => 'Benefit Icon',
                        'name' => 'benefit_icon',
                        'type' => 'text',
                        'placeholder' => '🚀',
                    ),
                ),
                'button_label' => 'Add Benefit',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'page_template',
                    'operator' => '==',
                    'value' => 'page-templates/page-solution.php',
                ),
            ),
        ),
    ));
    
    // Industry Details Fields
    acf_add_local_field_group(array(
        'key' => 'group_industry_details',
        'title' => 'Industry Details',
        'fields' => array(
            array(
                'key' => 'field_industry_icon',
                'label' => 'Industry Icon',
                'name' => 'industry_icon',
                'type' => 'text',
                'placeholder' => '📱',
            ),
            array(
                'key' => 'field_market_size',
                'label' => 'Market Size',
                'name' => 'market_size',
                'type' => 'text',
                'placeholder' => '$1.7 trillion',
            ),
            array(
                'key' => 'field_key_challenges',
                'label' => 'Key Challenges',
                'name' => 'key_challenges',
                'type' => 'repeater',
                'sub_fields' => array(
                    array(
                        'key' => 'field_challenge_title',
                        'label' => 'Challenge',
                        'name' => 'challenge_title',
                        'type' => 'text',
                    ),
                ),
                'button_label' => 'Add Challenge',
            ),
            array(
                'key' => 'field_success_stories',
                'label' => 'Success Stories',
                'name' => 'success_stories',
                'type' => 'repeater',
                'sub_fields' => array(
                    array(
                        'key' => 'field_customer_name',
                        'label' => 'Customer Name',
                        'name' => 'customer_name',
                        'type' => 'text',
                    ),
                    array(
                        'key' => 'field_customer_logo',
                        'label' => 'Customer Logo',
                        'name' => 'customer_logo',
                        'type' => 'image',
                        'return_format' => 'array',
                    ),
                    array(
                        'key' => 'field_case_study_url',
                        'label' => 'Case Study URL',
                        'name' => 'case_study_url',
                        'type' => 'url',
                    ),
                    array(
                        'key' => 'field_success_quote',
                        'label' => 'Success Quote',
                        'name' => 'success_quote',
                        'type' => 'textarea',
                        'rows' => 3,
                    ),
                ),
                'button_label' => 'Add Success Story',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'page_template',
                    'operator' => '==',
                    'value' => 'page-templates/page-industry.php',
                ),
            ),
        ),
    ));
    
    // Company Info Fields
    acf_add_local_field_group(array(
        'key' => 'group_company_info',
        'title' => 'Company Information',
        'fields' => array(
            array(
                'key' => 'field_company_overview',
                'label' => 'Company Overview',
                'name' => 'company_overview',
                'type' => 'textarea',
                'rows' => 5,
            ),
            array(
                'key' => 'field_founding_year',
                'label' => 'Founding Year',
                'name' => 'founding_year',
                'type' => 'number',
            ),
            array(
                'key' => 'field_headquarters',
                'label' => 'Headquarters',
                'name' => 'headquarters',
                'type' => 'text',
            ),
            array(
                'key' => 'field_team_members',
                'label' => 'Team Members',
                'name' => 'team_members',
                'type' => 'repeater',
                'sub_fields' => array(
                    array(
                        'key' => 'field_member_name',
                        'label' => 'Name',
                        'name' => 'member_name',
                        'type' => 'text',
                    ),
                    array(
                        'key' => 'field_member_title',
                        'label' => 'Title',
                        'name' => 'member_title',
                        'type' => 'text',
                    ),
                    array(
                        'key' => 'field_member_bio',
                        'label' => 'Bio',
                        'name' => 'member_bio',
                        'type' => 'textarea',
                        'rows' => 3,
                    ),
                    array(
                        'key' => 'field_member_photo',
                        'label' => 'Photo',
                        'name' => 'member_photo',
                        'type' => 'image',
                        'return_format' => 'array',
                    ),
                ),
                'button_label' => 'Add Team Member',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'page_template',
                    'operator' => '==',
                    'value' => 'page-templates/page-company.php',
                ),
            ),
        ),
    ));
    
    // Page Builder Fields
    acf_add_local_field_group(array(
        'key' => 'group_page_builder',
        'title' => 'Page Builder',
        'fields' => array(
            array(
                'key' => 'field_page_sections',
                'label' => 'Page Sections',
                'name' => 'page_sections',
                'type' => 'flexible_content',
                'layouts' => array(
                    // Hero Section Layout
                    'hero_section' => array(
                        'key' => 'layout_hero_section',
                        'name' => 'hero_section',
                        'label' => 'Hero Section',
                        'display' => 'block',
                        'sub_fields' => array(
                            array(
                                'key' => 'field_hero_layout',
                                'label' => 'Hero Layout',
                                'name' => 'hero_layout',
                                'type' => 'select',
                                'choices' => array(
                                    'centered' => 'Centered Text',
                                    'split' => 'Split Layout (Text + Image)',
                                    'video' => 'Video Background',
                                    'minimal' => 'Minimal',
                                ),
                                'default_value' => 'centered',
                            ),
                            array(
                                'key' => 'field_hero_headline',
                                'label' => 'Headline',
                                'name' => 'hero_headline',
                                'type' => 'text',
                                'required' => 1,
                            ),
                            array(
                                'key' => 'field_hero_subheadline',
                                'label' => 'Subheadline',
                                'name' => 'hero_subheadline',
                                'type' => 'textarea',
                                'rows' => 3,
                            ),
                            array(
                                'key' => 'field_hero_image',
                                'label' => 'Hero Image',
                                'name' => 'hero_image',
                                'type' => 'image',
                                'return_format' => 'array',
                            ),
                            array(
                                'key' => 'field_hero_video_url',
                                'label' => 'Video URL',
                                'name' => 'hero_video_url',
                                'type' => 'url',
                                'conditional_logic' => array(
                                    array(
                                        array(
                                            'field' => 'field_hero_layout',
                                            'operator' => '==',
                                            'value' => 'video',
                                        ),
                                    ),
                                ),
                            ),
                            array(
                                'key' => 'field_hero_cta_primary',
                                'label' => 'Primary CTA',
                                'name' => 'hero_cta_primary',
                                'type' => 'group',
                                'sub_fields' => array(
                                    array(
                                        'key' => 'field_hero_cta_primary_text',
                                        'label' => 'Text',
                                        'name' => 'text',
                                        'type' => 'text',
                                    ),
                                    array(
                                        'key' => 'field_hero_cta_primary_url',
                                        'label' => 'URL',
                                        'name' => 'url',
                                        'type' => 'url',
                                    ),
                                ),
                            ),
                            array(
                                'key' => 'field_hero_cta_secondary',
                                'label' => 'Secondary CTA',
                                'name' => 'hero_cta_secondary',
                                'type' => 'group',
                                'sub_fields' => array(
                                    array(
                                        'key' => 'field_hero_cta_secondary_text',
                                        'label' => 'Text',
                                        'name' => 'text',
                                        'type' => 'text',
                                    ),
                                    array(
                                        'key' => 'field_hero_cta_secondary_url',
                                        'label' => 'URL',
                                        'name' => 'url',
                                        'type' => 'url',
                                    ),
                                ),
                            ),
                            array(
                                'key' => 'field_hero_animation_type',
                                'label' => 'Animation Type',
                                'name' => 'animation_type',
                                'type' => 'select',
                                'choices' => array(
                                    'fade-up' => 'Fade Up',
                                    'fade-down' => 'Fade Down',
                                    'fade-left' => 'Fade Left',
                                    'fade-right' => 'Fade Right',
                                    'zoom-in' => 'Zoom In',
                                    'typewriter' => 'Typewriter Effect',
                                    'none' => 'No Animation',
                                ),
                                'default_value' => 'fade-up',
                            ),
                            array(
                                'key' => 'field_hero_animation_delay',
                                'label' => 'Animation Delay (ms)',
                                'name' => 'animation_delay',
                                'type' => 'number',
                                'default_value' => 0,
                                'min' => 0,
                                'max' => 3000,
                                'step' => 100,
                            ),
                        ),
                    ),
                    
                    // Content Section Layout
                    'content_section' => array(
                        'key' => 'layout_content_section',
                        'name' => 'content_section',
                        'label' => 'Content Section',
                        'display' => 'block',
                        'sub_fields' => array(
                            array(
                                'key' => 'field_content_layout',
                                'label' => 'Content Layout',
                                'name' => 'content_layout',
                                'type' => 'select',
                                'choices' => array(
                                    'single-column' => 'Single Column',
                                    'two-column' => 'Two Column',
                                    'text-image' => 'Text + Image',
                                    'image-text' => 'Image + Text',
                                ),
                                'default_value' => 'single-column',
                            ),
                            array(
                                'key' => 'field_content_headline',
                                'label' => 'Headline',
                                'name' => 'content_headline',
                                'type' => 'text',
                            ),
                            array(
                                'key' => 'field_content_text',
                                'label' => 'Content',
                                'name' => 'content_text',
                                'type' => 'wysiwyg',
                                'tabs' => 'all',
                                'toolbar' => 'full',
                            ),
                            array(
                                'key' => 'field_content_image',
                                'label' => 'Image',
                                'name' => 'content_image',
                                'type' => 'image',
                                'return_format' => 'array',
                                'conditional_logic' => array(
                                    array(
                                        array(
                                            'field' => 'field_content_layout',
                                            'operator' => '==',
                                            'value' => 'text-image',
                                        ),
                                    ),
                                    array(
                                        array(
                                            'field' => 'field_content_layout',
                                            'operator' => '==',
                                            'value' => 'image-text',
                                        ),
                                    ),
                                ),
                            ),
                            array(
                                'key' => 'field_content_animation_type',
                                'label' => 'Animation Type',
                                'name' => 'animation_type',
                                'type' => 'select',
                                'choices' => array(
                                    'fade-up' => 'Fade Up',
                                    'fade-down' => 'Fade Down',
                                    'fade-left' => 'Fade Left',
                                    'fade-right' => 'Fade Right',
                                    'slide-up' => 'Slide Up',
                                    'none' => 'No Animation',
                                ),
                                'default_value' => 'fade-up',
                            ),
                            array(
                                'key' => 'field_content_animation_delay',
                                'label' => 'Animation Delay (ms)',
                                'name' => 'animation_delay',
                                'type' => 'number',
                                'default_value' => 0,
                                'min' => 0,
                                'max' => 3000,
                                'step' => 100,
                            ),
                        ),
                    ),
                    
                    // Features Grid Layout
                    'features_grid' => array(
                        'key' => 'layout_features_grid',
                        'name' => 'features_grid',
                        'label' => 'Features Grid',
                        'display' => 'block',
                        'sub_fields' => array(
                            array(
                                'key' => 'field_features_headline',
                                'label' => 'Section Headline',
                                'name' => 'features_headline',
                                'type' => 'text',
                            ),
                            array(
                                'key' => 'field_features_description',
                                'label' => 'Section Description',
                                'name' => 'features_description',
                                'type' => 'textarea',
                                'rows' => 3,
                            ),
                            array(
                                'key' => 'field_features_columns',
                                'label' => 'Columns',
                                'name' => 'features_columns',
                                'type' => 'select',
                                'choices' => array(
                                    '2' => '2 Columns',
                                    '3' => '3 Columns',
                                    '4' => '4 Columns',
                                ),
                                'default_value' => '3',
                            ),
                            array(
                                'key' => 'field_features_list',
                                'label' => 'Features',
                                'name' => 'features_list',
                                'type' => 'repeater',
                                'layout' => 'block',
                                'sub_fields' => array(
                                    array(
                                        'key' => 'field_feature_icon',
                                        'label' => 'Icon',
                                        'name' => 'feature_icon',
                                        'type' => 'text',
                                        'placeholder' => '🚀',
                                        'instructions' => 'Enter emoji or icon character',
                                    ),
                                    array(
                                        'key' => 'field_feature_title',
                                        'label' => 'Title',
                                        'name' => 'feature_title',
                                        'type' => 'text',
                                        'required' => 1,
                                    ),
                                    array(
                                        'key' => 'field_feature_description',
                                        'label' => 'Description',
                                        'name' => 'feature_description',
                                        'type' => 'textarea',
                                        'rows' => 3,
                                    ),
                                    array(
                                        'key' => 'field_feature_link',
                                        'label' => 'Link',
                                        'name' => 'feature_link',
                                        'type' => 'url',
                                    ),
                                ),
                                'button_label' => 'Add Feature',
                            ),
                            array(
                                'key' => 'field_features_animation_type',
                                'label' => 'Animation Type',
                                'name' => 'animation_type',
                                'type' => 'select',
                                'choices' => array(
                                    'fade-up' => 'Fade Up',
                                    'scale-in' => 'Scale In',
                                    'flip-in' => 'Flip In',
                                    'stagger' => 'Staggered Animation',
                                    'none' => 'No Animation',
                                ),
                                'default_value' => 'stagger',
                            ),
                            array(
                                'key' => 'field_features_animation_delay',
                                'label' => 'Animation Delay (ms)',
                                'name' => 'animation_delay',
                                'type' => 'number',
                                'default_value' => 0,
                                'min' => 0,
                                'max' => 3000,
                                'step' => 100,
                            ),
                        ),
                    ),
                    
                    // Statistics Section Layout
                    'statistics_section' => array(
                        'key' => 'layout_statistics_section',
                        'name' => 'statistics_section',
                        'label' => 'Statistics Section',
                        'display' => 'block',
                        'sub_fields' => array(
                            array(
                                'key' => 'field_stats_headline',
                                'label' => 'Section Headline',
                                'name' => 'stats_headline',
                                'type' => 'text',
                            ),
                            array(
                                'key' => 'field_stats_description',
                                'label' => 'Section Description',
                                'name' => 'stats_description',
                                'type' => 'textarea',
                                'rows' => 3,
                            ),
                            array(
                                'key' => 'field_stats_layout',
                                'label' => 'Layout Style',
                                'name' => 'stats_layout',
                                'type' => 'select',
                                'choices' => array(
                                    'horizontal' => 'Horizontal Row',
                                    'grid' => 'Grid Layout',
                                    'cards' => 'Card Style',
                                ),
                                'default_value' => 'grid',
                            ),
                            array(
                                'key' => 'field_statistics_list',
                                'label' => 'Statistics',
                                'name' => 'statistics_list',
                                'type' => 'repeater',
                                'layout' => 'table',
                                'sub_fields' => array(
                                    array(
                                        'key' => 'field_stat_number',
                                        'label' => 'Number',
                                        'name' => 'stat_number',
                                        'type' => 'text',
                                        'required' => 1,
                                        'placeholder' => '99.9%',
                                    ),
                                    array(
                                        'key' => 'field_stat_label',
                                        'label' => 'Label',
                                        'name' => 'stat_label',
                                        'type' => 'text',
                                        'required' => 1,
                                        'placeholder' => 'Uptime',
                                    ),
                                    array(
                                        'key' => 'field_stat_description',
                                        'label' => 'Description',
                                        'name' => 'stat_description',
                                        'type' => 'text',
                                        'placeholder' => 'Service Level Agreement',
                                    ),
                                    array(
                                        'key' => 'field_stat_icon',
                                        'label' => 'Icon',
                                        'name' => 'stat_icon',
                                        'type' => 'text',
                                        'placeholder' => '📈',
                                    ),
                                ),
                                'button_label' => 'Add Statistic',
                            ),
                            array(
                                'key' => 'field_stats_animation_type',
                                'label' => 'Animation Type',
                                'name' => 'animation_type',
                                'type' => 'select',
                                'choices' => array(
                                    'count-up' => 'Count Up Animation',
                                    'fade-up' => 'Fade Up',
                                    'scale-in' => 'Scale In',
                                    'pulse' => 'Pulse Effect',
                                    'none' => 'No Animation',
                                ),
                                'default_value' => 'count-up',
                            ),
                            array(
                                'key' => 'field_stats_animation_delay',
                                'label' => 'Animation Delay (ms)',
                                'name' => 'animation_delay',
                                'type' => 'number',
                                'default_value' => 0,
                                'min' => 0,
                                'max' => 3000,
                                'step' => 100,
                            ),
                        ),
                    ),
                    
                    // CTA Section Layout
                    'cta_section' => array(
                        'key' => 'layout_cta_section',
                        'name' => 'cta_section',
                        'label' => 'Call-to-Action Section',
                        'display' => 'block',
                        'sub_fields' => array(
                            array(
                                'key' => 'field_cta_style',
                                'label' => 'CTA Style',
                                'name' => 'cta_style',
                                'type' => 'select',
                                'choices' => array(
                                    'centered' => 'Centered',
                                    'split' => 'Split Layout',
                                    'banner' => 'Full Width Banner',
                                    'card' => 'Card Style',
                                ),
                                'default_value' => 'centered',
                            ),
                            array(
                                'key' => 'field_cta_background',
                                'label' => 'Background Style',
                                'name' => 'cta_background',
                                'type' => 'select',
                                'choices' => array(
                                    'light' => 'Light Background',
                                    'gradient' => 'Gradient Background',
                                    'primary' => 'Primary Blue',
                                    'dark' => 'Dark Background',
                                    'image' => 'Background Image',
                                ),
                                'default_value' => 'gradient',
                            ),
                            array(
                                'key' => 'field_cta_bg_image',
                                'label' => 'Background Image',
                                'name' => 'cta_bg_image',
                                'type' => 'image',
                                'return_format' => 'array',
                                'conditional_logic' => array(
                                    array(
                                        array(
                                            'field' => 'field_cta_background',
                                            'operator' => '==',
                                            'value' => 'image',
                                        ),
                                    ),
                                ),
                            ),
                            array(
                                'key' => 'field_cta_headline',
                                'label' => 'Headline',
                                'name' => 'cta_headline',
                                'type' => 'text',
                                'required' => 1,
                            ),
                            array(
                                'key' => 'field_cta_description',
                                'label' => 'Description',
                                'name' => 'cta_description',
                                'type' => 'textarea',
                                'rows' => 3,
                            ),
                            array(
                                'key' => 'field_cta_primary_button',
                                'label' => 'Primary Button',
                                'name' => 'cta_primary_button',
                                'type' => 'group',
                                'sub_fields' => array(
                                    array(
                                        'key' => 'field_cta_primary_text',
                                        'label' => 'Text',
                                        'name' => 'text',
                                        'type' => 'text',
                                        'required' => 1,
                                    ),
                                    array(
                                        'key' => 'field_cta_primary_url',
                                        'label' => 'URL',
                                        'name' => 'url',
                                        'type' => 'url',
                                        'required' => 1,
                                    ),
                                    array(
                                        'key' => 'field_cta_primary_style',
                                        'label' => 'Button Style',
                                        'name' => 'style',
                                        'type' => 'select',
                                        'choices' => array(
                                            'primary' => 'Primary',
                                            'secondary' => 'Secondary',
                                            'outline' => 'Outline',
                                        ),
                                        'default_value' => 'primary',
                                    ),
                                ),
                            ),
                            array(
                                'key' => 'field_cta_secondary_button',
                                'label' => 'Secondary Button',
                                'name' => 'cta_secondary_button',
                                'type' => 'group',
                                'sub_fields' => array(
                                    array(
                                        'key' => 'field_cta_secondary_text',
                                        'label' => 'Text',
                                        'name' => 'text',
                                        'type' => 'text',
                                    ),
                                    array(
                                        'key' => 'field_cta_secondary_url',
                                        'label' => 'URL',
                                        'name' => 'url',
                                        'type' => 'url',
                                    ),
                                    array(
                                        'key' => 'field_cta_secondary_style',
                                        'label' => 'Button Style',
                                        'name' => 'style',
                                        'type' => 'select',
                                        'choices' => array(
                                            'primary' => 'Primary',
                                            'secondary' => 'Secondary',
                                            'outline' => 'Outline',
                                        ),
                                        'default_value' => 'secondary',
                                    ),
                                ),
                            ),
                            array(
                                'key' => 'field_cta_animation_type',
                                'label' => 'Animation Type',
                                'name' => 'animation_type',
                                'type' => 'select',
                                'choices' => array(
                                    'fade-up' => 'Fade Up',
                                    'fade-down' => 'Fade Down',
                                    'scale-in' => 'Scale In',
                                    'bounce-in' => 'Bounce In',
                                    'slide-in' => 'Slide In',
                                    'none' => 'No Animation',
                                ),
                                'default_value' => 'fade-up',
                            ),
                            array(
                                'key' => 'field_cta_animation_delay',
                                'label' => 'Animation Delay (ms)',
                                'name' => 'animation_delay',
                                'type' => 'number',
                                'default_value' => 0,
                                'min' => 0,
                                'max' => 3000,
                                'step' => 100,
                            ),
                        ),
                    ),
                    
                    // Testimonials Section Layout
                    'testimonials_section' => array(
                        'key' => 'layout_testimonials_section',
                        'name' => 'testimonials_section',
                        'label' => 'Testimonials Section',
                        'display' => 'block',
                        'sub_fields' => array(
                            array(
                                'key' => 'field_testimonials_headline',
                                'label' => 'Section Headline',
                                'name' => 'testimonials_headline',
                                'type' => 'text',
                            ),
                            array(
                                'key' => 'field_testimonials_description',
                                'label' => 'Section Description',
                                'name' => 'testimonials_description',
                                'type' => 'textarea',
                                'rows' => 3,
                            ),
                            array(
                                'key' => 'field_testimonials_layout',
                                'label' => 'Layout Style',
                                'name' => 'testimonials_layout',
                                'type' => 'select',
                                'choices' => array(
                                    'grid' => 'Grid Layout',
                                    'carousel' => 'Carousel/Slider',
                                    'featured' => 'Featured Testimonial',
                                ),
                                'default_value' => 'grid',
                            ),
                            array(
                                'key' => 'field_testimonials_list',
                                'label' => 'Testimonials',
                                'name' => 'testimonials_list',
                                'type' => 'repeater',
                                'layout' => 'block',
                                'sub_fields' => array(
                                    array(
                                        'key' => 'field_testimonial_quote',
                                        'label' => 'Quote',
                                        'name' => 'testimonial_quote',
                                        'type' => 'textarea',
                                        'rows' => 4,
                                        'required' => 1,
                                    ),
                                    array(
                                        'key' => 'field_testimonial_name',
                                        'label' => 'Name',
                                        'name' => 'testimonial_name',
                                        'type' => 'text',
                                        'required' => 1,
                                    ),
                                    array(
                                        'key' => 'field_testimonial_title',
                                        'label' => 'Title',
                                        'name' => 'testimonial_title',
                                        'type' => 'text',
                                    ),
                                    array(
                                        'key' => 'field_testimonial_company',
                                        'label' => 'Company',
                                        'name' => 'testimonial_company',
                                        'type' => 'text',
                                    ),
                                    array(
                                        'key' => 'field_testimonial_avatar',
                                        'label' => 'Avatar',
                                        'name' => 'testimonial_avatar',
                                        'type' => 'image',
                                        'return_format' => 'array',
                                    ),
                                    array(
                                        'key' => 'field_testimonial_company_logo',
                                        'label' => 'Company Logo',
                                        'name' => 'testimonial_company_logo',
                                        'type' => 'image',
                                        'return_format' => 'array',
                                    ),
                                    array(
                                        'key' => 'field_testimonial_rating',
                                        'label' => 'Rating (1-5)',
                                        'name' => 'testimonial_rating',
                                        'type' => 'number',
                                        'min' => 1,
                                        'max' => 5,
                                        'default_value' => 5,
                                    ),
                                ),
                                'button_label' => 'Add Testimonial',
                            ),
                            array(
                                'key' => 'field_testimonials_animation_type',
                                'label' => 'Animation Type',
                                'name' => 'animation_type',
                                'type' => 'select',
                                'choices' => array(
                                    'fade-up' => 'Fade Up',
                                    'scale-in' => 'Scale In',
                                    'rotate-in' => 'Rotate In',
                                    'stagger' => 'Staggered Animation',
                                    'none' => 'No Animation',
                                ),
                                'default_value' => 'fade-up',
                            ),
                            array(
                                'key' => 'field_testimonials_animation_delay',
                                'label' => 'Animation Delay (ms)',
                                'name' => 'animation_delay',
                                'type' => 'number',
                                'default_value' => 0,
                                'min' => 0,
                                'max' => 3000,
                                'step' => 100,
                            ),
                        ),
                    ),
                    
                    // Spacer Layout
                    'spacer_section' => array(
                        'key' => 'layout_spacer_section',
                        'name' => 'spacer_section',
                        'label' => 'Spacer',
                        'display' => 'block',
                        'sub_fields' => array(
                            array(
                                'key' => 'field_spacer_height',
                                'label' => 'Spacer Height',
                                'name' => 'spacer_height',
                                'type' => 'select',
                                'choices' => array(
                                    'small' => 'Small (40px)',
                                    'medium' => 'Medium (80px)',
                                    'large' => 'Large (120px)',
                                    'custom' => 'Custom',
                                ),
                                'default_value' => 'medium',
                            ),
                            array(
                                'key' => 'field_spacer_custom_height',
                                'label' => 'Custom Height (px)',
                                'name' => 'spacer_custom_height',
                                'type' => 'number',
                                'min' => 0,
                                'max' => 500,
                                'conditional_logic' => array(
                                    array(
                                        array(
                                            'field' => 'field_spacer_height',
                                            'operator' => '==',
                                            'value' => 'custom',
                                        ),
                                    ),
                                ),
                            ),
                        ),
                    ),
                ),
                'button_label' => 'Add Section',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'page',
                ),
            ),
        ),
    ));
    
    // Global CTA Fields (keeping original for backward compatibility)
    acf_add_local_field_group(array(
        'key' => 'group_global_cta',
        'title' => 'Call-to-Action Components',
        'fields' => array(
            array(
                'key' => 'field_cta_sections',
                'label' => 'CTA Sections',
                'name' => 'cta_sections',
                'type' => 'repeater',
                'sub_fields' => array(
                    array(
                        'key' => 'field_cta_headline',
                        'label' => 'CTA Headline',
                        'name' => 'cta_headline',
                        'type' => 'text',
                    ),
                    array(
                        'key' => 'field_cta_description',
                        'label' => 'CTA Description',
                        'name' => 'cta_description',
                        'type' => 'textarea',
                        'rows' => 3,
                    ),
                    array(
                        'key' => 'field_cta_primary_text',
                        'label' => 'Primary CTA Text',
                        'name' => 'cta_primary_text',
                        'type' => 'text',
                    ),
                    array(
                        'key' => 'field_cta_primary_url',
                        'label' => 'Primary CTA URL',
                        'name' => 'cta_primary_url',
                        'type' => 'url',
                    ),
                    array(
                        'key' => 'field_cta_secondary_text',
                        'label' => 'Secondary CTA Text',
                        'name' => 'cta_secondary_text',
                        'type' => 'text',
                    ),
                    array(
                        'key' => 'field_cta_secondary_url',
                        'label' => 'Secondary CTA URL',
                        'name' => 'cta_secondary_url',
                        'type' => 'url',
                    ),
                    array(
                        'key' => 'field_cta_background',
                        'label' => 'Background Style',
                        'name' => 'cta_background',
                        'type' => 'select',
                        'choices' => array(
                            'light' => 'Light Background',
                            'gradient' => 'Gradient Background',
                            'blue' => 'Blue Background',
                        ),
                    ),
                ),
                'button_label' => 'Add CTA Section',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'page',
                ),
            ),
        ),
    ));
}
add_action('acf/init', 'alepo_register_acf_fields');

/**
 * Custom Post Types
 */
function alepo_register_post_types() {
    // Case Studies
    register_post_type('case_studies', array(
        'labels' => array(
            'name' => __('Case Studies', 'alepo'),
            'singular_name' => __('Case Study', 'alepo'),
            'add_new' => __('Add New Case Study', 'alepo'),
            'add_new_item' => __('Add New Case Study', 'alepo'),
            'edit_item' => __('Edit Case Study', 'alepo'),
            'new_item' => __('New Case Study', 'alepo'),
            'view_item' => __('View Case Study', 'alepo'),
            'search_items' => __('Search Case Studies', 'alepo'),
            'not_found' => __('No case studies found', 'alepo'),
            'not_found_in_trash' => __('No case studies found in trash', 'alepo'),
        ),
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
        'menu_icon' => 'dashicons-portfolio',
        'rewrite' => array('slug' => 'case-studies'),
    ));
    
    // Testimonials
    register_post_type('testimonials', array(
        'labels' => array(
            'name' => __('Testimonials', 'alepo'),
            'singular_name' => __('Testimonial', 'alepo'),
            'add_new' => __('Add New Testimonial', 'alepo'),
            'add_new_item' => __('Add New Testimonial', 'alepo'),
            'edit_item' => __('Edit Testimonial', 'alepo'),
            'new_item' => __('New Testimonial', 'alepo'),
            'view_item' => __('View Testimonial', 'alepo'),
            'search_items' => __('Search Testimonials', 'alepo'),
            'not_found' => __('No testimonials found', 'alepo'),
            'not_found_in_trash' => __('No testimonials found in trash', 'alepo'),
        ),
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'thumbnail'),
        'menu_icon' => 'dashicons-testimonial',
        'rewrite' => array('slug' => 'testimonials'),
    ));
    
    // Team Members
    register_post_type('team_members', array(
        'labels' => array(
            'name' => __('Team Members', 'alepo'),
            'singular_name' => __('Team Member', 'alepo'),
            'add_new' => __('Add New Team Member', 'alepo'),
            'add_new_item' => __('Add New Team Member', 'alepo'),
            'edit_item' => __('Edit Team Member', 'alepo'),
            'new_item' => __('New Team Member', 'alepo'),
            'view_item' => __('View Team Member', 'alepo'),
            'search_items' => __('Search Team Members', 'alepo'),
            'not_found' => __('No team members found', 'alepo'),
            'not_found_in_trash' => __('No team members found in trash', 'alepo'),
        ),
        'public' => true,
        'has_archive' => false,
        'supports' => array('title', 'editor', 'thumbnail'),
        'menu_icon' => 'dashicons-groups',
        'rewrite' => array('slug' => 'team'),
    ));
}
add_action('init', 'alepo_register_post_types');

/**
 * Custom Taxonomies
 */
function alepo_register_taxonomies() {
    // Product Categories
    register_taxonomy('product_category', 'page', array(
        'hierarchical' => true,
        'labels' => array(
            'name' => __('Product Categories', 'alepo'),
            'singular_name' => __('Product Category', 'alepo'),
        ),
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'product-category'),
    ));
    
    // Solution Categories
    register_taxonomy('solution_category', 'page', array(
        'hierarchical' => true,
        'labels' => array(
            'name' => __('Solution Categories', 'alepo'),
            'singular_name' => __('Solution Category', 'alepo'),
        ),
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'solution-category'),
    ));
    
    // Industry Categories
    register_taxonomy('industry_category', 'page', array(
        'hierarchical' => true,
        'labels' => array(
            'name' => __('Industry Categories', 'alepo'),
            'singular_name' => __('Industry Category', 'alepo'),
        ),
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'industry-category'),
    ));
}
add_action('init', 'alepo_register_taxonomies');

/**
 * Customize Admin
 */
function alepo_admin_init() {
    // Add editor styles
    add_editor_style(array('style.css'));
}
add_action('admin_init', 'alepo_admin_init');

/**
 * Customizer Settings
 */
function alepo_customize_register($wp_customize) {
    // Site Identity
    $wp_customize->add_section('alepo_site_identity', array(
        'title' => __('Alepo Site Settings', 'alepo'),
        'priority' => 30,
    ));
    
    // Utility Bar Phone
    $wp_customize->add_setting('alepo_utility_phone', array(
        'default' => '+1 (555) 123-4567',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('alepo_utility_phone', array(
        'label' => __('Utility Bar Phone', 'alepo'),
        'section' => 'alepo_site_identity',
        'type' => 'text',
    ));
    
    // Utility Bar Email
    $wp_customize->add_setting('alepo_utility_email', array(
        'default' => 'info@alepo.com',
        'sanitize_callback' => 'sanitize_email',
    ));
    
    $wp_customize->add_control('alepo_utility_email', array(
        'label' => __('Utility Bar Email', 'alepo'),
        'section' => 'alepo_site_identity',
        'type' => 'email',
    ));
    
    // Footer Copyright
    $wp_customize->add_setting('alepo_footer_copyright', array(
        'default' => '© 2024 Alepo. All rights reserved.',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('alepo_footer_copyright', array(
        'label' => __('Footer Copyright', 'alepo'),
        'section' => 'alepo_site_identity',
        'type' => 'text',
    ));
}
add_action('customize_register', 'alepo_customize_register');

/**
 * Helper Functions
 */

// Get ACF field with fallback
function alepo_get_field($field_name, $post_id = null, $default = '') {
    if (function_exists('get_field')) {
        $value = get_field($field_name, $post_id);
        return $value ? $value : $default;
    }
    return $default;
}

// Get page template name
function alepo_get_page_template() {
    $template = get_page_template_slug();
    if ($template) {
        return basename($template, '.php');
    }
    return 'page';
}

// Check if page uses specific template
function alepo_is_template($template_name) {
    return alepo_get_page_template() === $template_name;
}

// Generate breadcrumbs
function alepo_breadcrumbs() {
    if (is_front_page()) {
        return;
    }
    
    echo '<nav class="breadcrumbs" aria-label="Breadcrumb">';
    echo '<ol class="breadcrumb-list">';
    echo '<li><a href="' . home_url() . '">' . __('Home', 'alepo') . '</a></li>';
    
    if (is_page()) {
        $ancestors = get_post_ancestors(get_the_ID());
        $ancestors = array_reverse($ancestors);
        
        foreach ($ancestors as $ancestor) {
            echo '<li><a href="' . get_permalink($ancestor) . '">' . get_the_title($ancestor) . '</a></li>';
        }
        
        echo '<li aria-current="page">' . get_the_title() . '</li>';
    } elseif (is_single()) {
        $categories = get_the_category();
        if ($categories) {
            echo '<li><a href="' . get_category_link($categories[0]->term_id) . '">' . $categories[0]->name . '</a></li>';
        }
        echo '<li aria-current="page">' . get_the_title() . '</li>';
    } elseif (is_category()) {
        echo '<li aria-current="page">' . single_cat_title('', false) . '</li>';
    } elseif (is_search()) {
        echo '<li aria-current="page">' . __('Search Results', 'alepo') . '</li>';
    }
    
    echo '</ol>';
    echo '</nav>';
}

// Get navigation menu by location
function alepo_get_nav_menu($location) {
    if (has_nav_menu($location)) {
        return wp_nav_menu(array(
            'theme_location' => $location,
            'echo' => false,
            'container' => false,
            'menu_class' => 'nav-menu',
            'fallback_cb' => false,
        ));
    }
    return '';
}

// Security: Remove WordPress version
remove_action('wp_head', 'wp_generator');

// Clean up wp_head
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'wp_shortlink_wp_head');

// Optimize WordPress
add_filter('xmlrpc_enabled', '__return_false');
add_filter('wp_headers', function($headers) {
    unset($headers['X-Pingback']);
    return $headers;
});

/**
 * Include additional theme files
 */
if (file_exists(get_template_directory() . '/inc/template-functions.php')) {
    require get_template_directory() . '/inc/template-functions.php';
}
if (file_exists(get_template_directory() . '/inc/mega-menu-walker.php')) {
    require get_template_directory() . '/inc/mega-menu-walker.php';
}
if (file_exists(get_template_directory() . '/inc/gutenberg-mega-menu.php')) {
    require get_template_directory() . '/inc/gutenberg-mega-menu.php';
    
    // Create mega menu content on theme activation
    add_action('after_switch_theme', 'alepo_create_default_mega_menu_content');
    
    // Also create on admin_init if not exists (for existing installations)
    add_action('admin_init', function() {
        $existing = get_posts(array(
            'post_type' => 'mega_menu_content',
            'numberposts' => 1,
            'post_status' => 'any'
        ));
        
        if (empty($existing)) {
            alepo_create_default_mega_menu_content();
        }
    });
}

// Include gutenberg-footer functionality
if (file_exists(get_template_directory() . '/inc/gutenberg-footer.php')) {
    require get_template_directory() . '/inc/gutenberg-footer.php';
    
    // Auto-create footer content when theme is activated
    add_action('after_switch_theme', 'alepo_create_default_footer_content');
    
    // Also create on admin_init if not exists (for existing installations)
    add_action('admin_init', function() {
        $existing = get_posts(array(
            'post_type' => 'footer_content',
            'numberposts' => 1,
            'post_status' => 'any'
        ));
        
        if (empty($existing)) {
            alepo_create_default_footer_content();
        }
    });
}
// Customizer functions are already in this file, so we don't need to include customizer.php
// require get_template_directory() . '/inc/customizer.php';

// Include admin page creator
if (file_exists(get_template_directory() . '/admin-page-creator.php')) {
    require get_template_directory() . '/admin-page-creator.php';
}

// Include cleanup script
if (file_exists(get_template_directory() . '/cleanup-generated-pages.php')) {
    require get_template_directory() . '/cleanup-generated-pages.php';
}
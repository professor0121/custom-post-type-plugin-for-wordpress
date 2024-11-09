<?php
/**
 * Plugin Name: Custom CPTs and Taxonomies Plugin by Abhi
 * Description: A plugin to dynamically register multiple custom post types and taxonomies from settings.
 * Version: 1.0
 * Author: abhi
 * License: GPL2
 */

// Enqueue Styles and Scripts
function my_custom_cpts_taxonomies_enqueue_assets() {
    wp_enqueue_style('my-custom-cpts-taxonomies-admin-style', plugin_dir_url(__FILE__) . 'assets/css/style.css');
    wp_enqueue_script('my-custom-cpts-taxonomies-admin-script', plugin_dir_url(__FILE__) . 'assets/js/script.js', array('jquery'), false, true);
}
add_action('admin_enqueue_scripts', 'my_custom_cpts_taxonomies_enqueue_assets');

// Include necessary files
require_once plugin_dir_path(__FILE__) . 'includes/settings-page.php';  // Settings page to add CPTs & Taxonomies
require_once plugin_dir_path(__FILE__) . 'includes/register-cpts-taxonomies.php';  // Register CPTs & Taxonomies logic
require_once plugin_dir_path(__FILE__) . 'includes/delete-cpt.php';  // Delete CPT functionality
// Include the Featured Image Column functionality
require_once plugin_dir_path( __FILE__ ) . 'includes/featured-image-column.php';


// Add Settings page to the admin menu
function my_custom_cpts_taxonomies_settings_page() {
    add_menu_page(
        'Custom Post Types & Taxonomies Settings',
        'Custom Post Types & Taxonomies',
        'manage_options',
        'my_custom_cpts_taxonomies',
        'my_custom_cpts_taxonomies_settings_page_content',
        'dashicons-admin-post',
        20
    );
}
add_action('admin_menu', 'my_custom_cpts_taxonomies_settings_page');

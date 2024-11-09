<?php

// Delete Custom Post Type
function delete_custom_post_type($post_type_slug) {
    $cpt_slugs = get_option('my_custom_cpt_slugs', array());
    $index = array_search($post_type_slug, $cpt_slugs);

    if ($index !== false) {
        unset($cpt_slugs[$index]);
        update_option('my_custom_cpt_slugs', array_values($cpt_slugs));
        unregister_post_type($post_type_slug); // Unregister the CPT
        return true;
    }

    return false;
}

// Delete Custom Taxonomy
function delete_custom_taxonomy($taxonomy_slug) {
    $taxonomy_data = get_option('my_custom_taxonomy_slugs', array());
    foreach ($taxonomy_data as $key => $data) {
        if ($data['taxonomy'] == $taxonomy_slug) {
            unset($taxonomy_data[$key]);
            update_option('my_custom_taxonomy_slugs', array_values($taxonomy_data));
            unregister_taxonomy($taxonomy_slug); // Unregister the taxonomy
            return true;
        }
    }
    return false;
}

// Handle delete request for CPT
function handle_delete_cpt() {
    if (isset($_GET['delete_cpt']) && current_user_can('manage_options')) {
        $post_type_slug = sanitize_text_field($_GET['delete_cpt']);
        if (delete_custom_post_type($post_type_slug)) {
            wp_redirect(admin_url('admin.php?page=my_custom_cpts_taxonomies&deleted=' . $post_type_slug));
            exit;
        }
    }
}
add_action('admin_init', 'handle_delete_cpt');

// Handle delete request for Taxonomy
function handle_delete_taxonomy() {
    if (isset($_GET['delete_taxonomy']) && current_user_can('manage_options')) {
        $taxonomy_slug = sanitize_text_field($_GET['delete_taxonomy']);
        if (delete_custom_taxonomy($taxonomy_slug)) {
            wp_redirect(admin_url('admin.php?page=my_custom_cpts_taxonomies&deleted_taxonomy=' . $taxonomy_slug));
            exit;
        }
    }
}
add_action('admin_init', 'handle_delete_taxonomy');

// Display delete success message for CPT
function my_admin_notices() {
    if (isset($_GET['deleted'])) {
        echo '<div class="notice notice-success is-dismissible"><p>Custom post type <strong>' . esc_html($_GET['deleted']) . '</strong> has been deleted successfully.</p></div>';
    }

    if (isset($_GET['deleted_taxonomy'])) {
        echo '<div class="notice notice-success is-dismissible"><p>Custom taxonomy <strong>' . esc_html($_GET['deleted_taxonomy']) . '</strong> has been deleted successfully.</p></div>';
    }
}
add_action('admin_notices', 'my_admin_notices');

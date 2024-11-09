<?php function my_dynamic_cpts_taxonomies_register() {
   // Get options for Custom Post Types and Taxonomies
    $cpt_slugs = get_option( 'my_custom_cpt_slugs', array() );
    $cpt_names = get_option( 'my_custom_cpt_names', array() );
    $cpt_singular_names = get_option( 'my_custom_cpt_singular_names', array() );

    $taxonomy_slugs = get_option( 'my_custom_taxonomy_slugs', array() );
    $taxonomy_names = get_option( 'my_custom_taxonomy_names', array() );

    // Register Custom Post Types if settings are provided
    if ( ! empty( $cpt_slugs ) && ! empty( $cpt_names ) && ! empty( $cpt_singular_names ) ) {
        foreach ( $cpt_slugs as $index => $slug ) {
            if ( ! empty( $slug ) && ! empty( $cpt_names[$index] ) && ! empty( $cpt_singular_names[$index] ) ) {
                // Check if the post type is already registered
                if ( ! post_type_exists( $slug ) ) {
                    $args = array(
                        'labels' => array(
                            'name'               => $cpt_names[$index],
                            'singular_name'      => $cpt_singular_names[$index],
                            'add_new'            => 'Add New',
                            'add_new_item'       => 'Add New ' . $cpt_singular_names[$index],
                            'edit_item'          => 'Edit ' . $cpt_singular_names[$index],
                            'new_item'           => 'New ' . $cpt_singular_names[$index],
                            'view_item'          => 'View ' . $cpt_singular_names[$index],
                            'search_items'       => 'Search ' . $cpt_names[$index],
                            'not_found'          => 'No ' . strtolower( $cpt_singular_names[$index] ) . ' found',
                        ),
                        'public' => true,
                        'show_ui' => true,
                        'show_in_menu' => true,
                        'rewrite' => array( 'slug' => $slug ),
                        'supports' => array( 'title', 'editor', 'thumbnail' ),
                        'taxonomies' => isset($taxonomy_slugs) ? $taxonomy_slugs : array(), // Assign multiple taxonomies here
                    );
                    register_post_type( $slug, $args );
                }
            }
        }
    }

    // Register Custom Taxonomies if settings are provided
    if ( ! empty( $taxonomy_slugs ) && ! empty( $taxonomy_names ) ) {
        foreach ( $taxonomy_slugs as $index => $slug ) {
            if ( ! empty( $slug ) && ! empty( $taxonomy_names[$index] ) ) {
                // Check if the taxonomy is already registered
                if ( ! taxonomy_exists( $slug ) ) {
                    $args = array(
                        'hierarchical' => true, // Set to true for a category-like taxonomy
                        'labels' => array(
                            'name'              => $taxonomy_names[$index],
                            'singular_name'     => $taxonomy_names[$index],
                            'search_items'      => 'Search ' . $taxonomy_names[$index],
                            'all_items'         => 'All ' . $taxonomy_names[$index],
                            'parent_item'       => 'Parent ' . $taxonomy_names[$index],
                            'parent_item_colon' => 'Parent ' . $taxonomy_names[$index] . ':',
                            'edit_item'         => 'Edit ' . $taxonomy_names[$index],
                            'update_item'       => 'Update ' . $taxonomy_names[$index],
                            'add_new_item'      => 'Add New ' . $taxonomy_names[$index],
                            'new_item_name'     => 'New ' . $taxonomy_names[$index],
                        ),
                        'rewrite' => array( 'slug' => $slug ),
                        'show_ui' => true,
                        'show_admin_column' => true,
                    );
                    // Register taxonomy for the specific CPT slug
                    register_taxonomy( $slug, $cpt_slugs, $args ); // Multiple CPTs can be linked with this taxonomy
                }
            }
        }
    }
}
add_action( 'init', 'my_dynamic_cpts_taxonomies_register' );

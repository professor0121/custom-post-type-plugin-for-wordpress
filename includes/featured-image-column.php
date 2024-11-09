<?php // Add custom column for featured image in the CPT table
function my_plugin_cpt_add_featured_image_column( $columns ) {
    // Add a new column for Featured Image
    $columns['featured_image'] = 'Featured Image';
    return $columns;
}
add_filter( 'manage_{cpt_slug}_posts_columns', 'my_plugin_cpt_add_featured_image_column' );

// Display the featured image in the custom column
function my_plugin_cpt_show_featured_image_column( $column, $post_id ) {
    if ( 'featured_image' === $column ) {
        // Get the post thumbnail (featured image)
        $featured_image = get_the_post_thumbnail( $post_id, 'thumbnail' ); // Change 'thumbnail' to any other size if needed
        
        // Display the image in the column
        if ( $featured_image ) {
            echo $featured_image;
        } else {
            echo 'No Image';
        }
    }
}
add_action( 'manage_{cpt_slug}_posts_custom_column', 'my_plugin_cpt_show_featured_image_column', 10, 2 );

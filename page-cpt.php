<?php
/* Template Name: Custom CPT Page */

get_header(); // Display the header

// Query the custom post type
$args = array(
    'post_type' => 'product',  
    'posts_per_page' => 10,  
);

$query = new WP_Query( $args );

if ( $query->have_posts() ) :
    while ( $query->have_posts() ) : $query->the_post();
        ?>
        <div class="cpt-post">
            <h2><?php the_title(); ?></h2>
            <p><?php the_excerpt(); ?></p>
            <a href="<?php the_permalink(); ?>">Read More</a>
        </div>
        <?php
    endwhile;
    wp_reset_postdata();
else :
    echo '<p>No posts found.</p>';
endif;

get_footer(); // Display the footer

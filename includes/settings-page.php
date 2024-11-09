<?php
function my_custom_cpts_taxonomies_settings_page_content() {
    ?>
    <div class="wrap">
    <h1>Custom Post Types & Taxonomies Settings</h1>
    <form method="post" action="options.php">
        <?php
            settings_fields( 'my_custom_cpts_taxonomies_group' );
            do_settings_sections( 'my_custom_cpts_taxonomies' );
        ?>
        <h3>Custom Post Types</h3>
        <table class="form-table" id="cpt-table">
            <?php 
            $cpt_slugs = get_option('my_custom_cpt_slugs', array());
            $cpt_names = get_option('my_custom_cpt_names', array());
            $cpt_singular_names = get_option('my_custom_cpt_singular_names', array());

            // Display existing CPTs
            if (!empty($cpt_slugs)) {
                foreach ($cpt_slugs as $index => $slug) {
                    ?>
                    <tr>
                        <th><label for="cpt_slugs[]">Post Type Slug</label></th>
                        <td><input type="text" name="my_custom_cpt_slugs[]" value="<?php echo esc_attr($slug); ?>" /></td>
                        <th><label for="cpt_names[]">Post Type Name</label></th>
                        <td><input type="text" name="my_custom_cpt_names[]" value="<?php echo esc_attr($cpt_names[$index] ?? ''); ?>" /></td>
                        <th><label for="cpt_singular_names[]">Singular Name</label></th>
                        <td><input type="text" name="my_custom_cpt_singular_names[]" value="<?php echo esc_attr($cpt_singular_names[$index] ?? ''); ?>" /></td>
                        <td><button type="button" class="button-secondary delete-cpt-row">Delete</button></td>
                    </tr>
                    <?php
                }
            }
            ?>
        </table>
        <button type="button" class="button-primary" id="add-cpt-row">Add CPT</button>

        <h3>Custom Taxonomies</h3>
        <table class="form-table" id="taxonomy-table">
            <?php 
            $taxonomy_slugs = get_option('my_custom_taxonomy_slugs', array());
            $taxonomy_names = get_option('my_custom_taxonomy_names', array());

            // Display existing Taxonomies
            if (!empty($taxonomy_slugs)) {
                foreach ($taxonomy_slugs as $index => $slug) {
                    ?>
                    <tr>
                        <th><label for="taxonomy_slugs[]">Taxonomy Slug</label></th>
                        <td><input type="text" name="my_custom_taxonomy_slugs[]" value="<?php echo esc_attr($slug); ?>" /></td>
                        <th><label for="taxonomy_names[]">Taxonomy Name</label></th>
                        <td><input type="text" name="my_custom_taxonomy_names[]" value="<?php echo esc_attr($taxonomy_names[$index] ?? ''); ?>" /></td>
                        <td><button type="button" class="button-secondary delete-taxonomy-row">Delete</button></td>
                    </tr>
                    <?php
                }
            }
            ?>
        </table>
        <button type="button" class="button-primary" id="add-taxonomy-row">Add Taxonomy</button>

        <?php submit_button(); ?>
    </form>
</div>
    
    <?php
    
    
}
// Register the settings for the plugin
function my_custom_cpts_taxonomies_register_settings() {
    // These settings need to be registered properly with a group
    register_setting( 'my_custom_cpts_taxonomies_group', 'my_custom_cpt_slugs' );
    register_setting( 'my_custom_cpts_taxonomies_group', 'my_custom_cpt_names' );
    register_setting( 'my_custom_cpts_taxonomies_group', 'my_custom_cpt_singular_names' );
    register_setting( 'my_custom_cpts_taxonomies_group', 'my_custom_taxonomy_slugs' );
    register_setting( 'my_custom_cpts_taxonomies_group', 'my_custom_taxonomy_names' );
}
add_action( 'admin_init', 'my_custom_cpts_taxonomies_register_settings' );
?>
 

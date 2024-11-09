 
jQuery(document).ready(function($) {
    // Add CPT row
    $('#add-cpt-row').on('click', function() {
        var newRow = '<tr>' +
            '<th><label for="cpt_slugs[]">Post Type Slug</label></th>' +
            '<td><input type="text" name="my_custom_cpt_slugs[]" value="" /></td>' +
            '<th><label for="cpt_names[]">Post Type Name</label></th>' +
            '<td><input type="text" name="my_custom_cpt_names[]" value="" /></td>' +
            '<th><label for="cpt_singular_names[]">Singular Name</label></th>' +
            '<td><input type="text" name="my_custom_cpt_singular_names[]" value="" /></td>' +
            '<td><button type="button" class="button-secondary delete-cpt-row">Delete</button></td>' +
            '</tr>';
        $('#cpt-table').append(newRow);
    });

    // Delete CPT row
    $('#cpt-table').on('click', '.delete-cpt-row', function() {
        $(this).closest('tr').remove();
    });

    // Add Taxonomy row
    $('#add-taxonomy-row').on('click', function() {
        var newRow = '<tr>' +
            '<th><label for="taxonomy_slugs[]">Taxonomy Slug</label></th>' +
            '<td><input type="text" name="my_custom_taxonomy_slugs[]" value="" /></td>' +
            '<th><label for="taxonomy_names[]">Taxonomy Name</label></th>' +
            '<td><input type="text" name="my_custom_taxonomy_names[]" value="" /></td>' +
            '<td><button type="button" class="button-secondary delete-taxonomy-row">Delete</button></td>' +
            '</tr>';
        $('#taxonomy-table').append(newRow);
    });

    // Delete Taxonomy row
    $('#taxonomy-table').on('click', '.delete-taxonomy-row', function() {
        $(this).closest('tr').remove();
    });
});

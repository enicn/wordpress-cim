<?php
/**
 * Category Thumbnail Functions
 *
 * @package cim
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Add Category Thumbnail Field to Add Category Form
 */
function cim_add_category_thumbnail_field() {
    ?>
    <div class="form-field term-thumbnail-wrap">
        <label for="category-thumbnail"><?php _e( 'Category Thumbnail', 'cim' ); ?></label>
        <input type="hidden" id="category-thumbnail-id" name="category-thumbnail-id" value="">
        <div id="category-thumbnail-preview"></div>
        <p>
            <input type="button" class="button button-secondary" id="upload-category-thumbnail" value="<?php _e( 'Upload Thumbnail', 'cim' ); ?>">
            <input type="button" class="button button-secondary" id="remove-category-thumbnail" value="<?php _e( 'Remove Thumbnail', 'cim' ); ?>" style="display:none;">
        </p>
        <p class="description"><?php _e( 'Upload a thumbnail for this category', 'cim' ); ?></p>
    </div>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            var mediaUploader;
            
            $('#upload-category-thumbnail').on('click', function(e) {
                e.preventDefault();
                
                if (mediaUploader) {
                    mediaUploader.open();
                    return;
                }
                
                mediaUploader = wp.media({
                    title: '<?php _e( 'Choose Category Thumbnail', 'cim' ); ?>',
                    button: {
                        text: '<?php _e( 'Set Thumbnail', 'cim' ); ?>'
                    },
                    multiple: false
                });
                
                mediaUploader.on('select', function() {
                    var attachment = mediaUploader.state().get('selection').first().toJSON();
                    $('#category-thumbnail-id').val(attachment.id);
                    $('#category-thumbnail-preview').html('<img src="' + attachment.url + '" style="max-width:100%;height:auto;margin-top:10px;" />');
                    $('#remove-category-thumbnail').show();
                });
                
                mediaUploader.open();
            });
            
            $('#remove-category-thumbnail').on('click', function(e) {
                e.preventDefault();
                $('#category-thumbnail-id').val('');
                $('#category-thumbnail-preview').html('');
                $(this).hide();
            });
        });
    </script>
    <?php
}
add_action( 'category_add_form_fields', 'cim_add_category_thumbnail_field' );

/**
 * Add Category Thumbnail Field to Edit Category Form
 */
function cim_edit_category_thumbnail_field( $term ) {
    $thumbnail_id = get_term_meta( $term->term_id, 'category_thumbnail_id', true );
    $thumbnail_url = '';
    
    if ( $thumbnail_id ) {
        $thumbnail_url = wp_get_attachment_url( $thumbnail_id );
    }
    ?>
    <tr class="form-field term-thumbnail-wrap">
        <th scope="row"><label for="category-thumbnail"><?php _e( 'Category Thumbnail', 'cim' ); ?></label></th>
        <td>
            <input type="hidden" id="category-thumbnail-id" name="category-thumbnail-id" value="<?php echo esc_attr( $thumbnail_id ); ?>">
            <div id="category-thumbnail-preview">
                <?php if ( $thumbnail_url ) : ?>
                    <img src="<?php echo esc_url( $thumbnail_url ); ?>" style="max-width:200px;height:auto;margin-bottom:10px;" />
                <?php endif; ?>
            </div>
            <p>
                <input type="button" class="button button-secondary" id="upload-category-thumbnail" value="<?php _e( 'Upload Thumbnail', 'cim' ); ?>">
                <input type="button" class="button button-secondary" id="remove-category-thumbnail" value="<?php _e( 'Remove Thumbnail', 'cim' ); ?>" <?php echo $thumbnail_id ? '' : 'style="display:none;"'; ?>>
            </p>
            <p class="description"><?php _e( 'Upload a thumbnail for this category', 'cim' ); ?></p>
            
            <script type="text/javascript">
                jQuery(document).ready(function($) {
                    var mediaUploader;
                    
                    $('#upload-category-thumbnail').on('click', function(e) {
                        e.preventDefault();
                        
                        if (mediaUploader) {
                            mediaUploader.open();
                            return;
                        }
                        
                        mediaUploader = wp.media({
                            title: '<?php _e( 'Choose Category Thumbnail', 'cim' ); ?>',
                            button: {
                                text: '<?php _e( 'Set Thumbnail', 'cim' ); ?>'
                            },
                            multiple: false
                        });
                        
                        mediaUploader.on('select', function() {
                            var attachment = mediaUploader.state().get('selection').first().toJSON();
                            $('#category-thumbnail-id').val(attachment.id);
                            $('#category-thumbnail-preview').html('<img src="' + attachment.url + '" style="max-width:200px;height:auto;margin-bottom:10px;" />');
                            $('#remove-category-thumbnail').show();
                        });
                        
                        mediaUploader.open();
                    });
                    
                    $('#remove-category-thumbnail').on('click', function(e) {
                        e.preventDefault();
                        $('#category-thumbnail-id').val('');
                        $('#category-thumbnail-preview').html('');
                        $(this).hide();
                    });
                });
            </script>
        </td>
    </tr>
    <?php
}
add_action( 'category_edit_form_fields', 'cim_edit_category_thumbnail_field' );

/**
 * Save Category Thumbnail
 */
function cim_save_category_thumbnail( $term_id ) {
    if ( isset( $_POST['category-thumbnail-id'] ) ) {
        update_term_meta( $term_id, 'category_thumbnail_id', absint( $_POST['category-thumbnail-id'] ) );
    }
}
add_action( 'created_category', 'cim_save_category_thumbnail' );
add_action( 'edited_category', 'cim_save_category_thumbnail' );

/**
 * Get Category Thumbnail URL
 */
function cim_get_category_thumbnail_url( $term_id, $size = 'thumbnail' ) {
    $thumbnail_id = get_term_meta( $term_id, 'category_thumbnail_id', true );
    
    if ( $thumbnail_id ) {
        return wp_get_attachment_image_url( $thumbnail_id, $size );
    }
    
    return '';
}
<?php
/**
 * Technologies Page Settings
 *
 * @package cim
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Register Technology Post Type
 */
function cim_register_technology_post_type() {
    $labels = array(
        'name'               => _x( 'Technologies', 'post type general name', 'cim' ),
        'singular_name'      => _x( 'Technology', 'post type singular name', 'cim' ),
        'menu_name'          => _x( 'Technologies', 'admin menu', 'cim' ),
        'name_admin_bar'     => _x( 'Technology', 'add new on admin bar', 'cim' ),
        'add_new'            => _x( 'Add New', 'technology', 'cim' ),
        'add_new_item'       => __( 'Add New Technology', 'cim' ),
        'new_item'           => __( 'New Technology', 'cim' ),
        'edit_item'          => __( 'Edit Technology', 'cim' ),
        'view_item'          => __( 'View Technology', 'cim' ),
        'all_items'          => __( 'All Technologies', 'cim' ),
        'search_items'       => __( 'Search Technologies', 'cim' ),
        'parent_item_colon'  => __( 'Parent Technologies:', 'cim' ),
        'not_found'          => __( 'No technologies found.', 'cim' ),
        'not_found_in_trash' => __( 'No technologies found in Trash.', 'cim' )
    );

    $args = array(
        'labels'             => $labels,
        'description'        => __( 'Technologies for the CIM website', 'cim' ),
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'technology' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
        'menu_icon'          => 'dashicons-lightbulb'
    );

    register_post_type( 'technology', $args );
}
add_action( 'init', 'cim_register_technology_post_type' );

/**
 * Add Technology Meta Boxes
 */
function cim_add_technology_meta_boxes() {
    // Background Color
    add_meta_box(
        'cim_technology_bg_color',
        __('Background Color', 'cim'),
        'cim_technology_bg_color_callback',
        'technology',
        'side',
        'default'
    );
    
    // Title
    add_meta_box(
        'cim_technology_title',
        __('Title', 'cim'),
        'cim_technology_title_callback',
        'technology',
        'side',
        'default'
    );
}
add_action('add_meta_boxes', 'cim_add_technology_meta_boxes');

/**
 * Technology Background Color Meta Box Callback
 */
function cim_technology_bg_color_callback($post) {
    // Add nonce for security
    wp_nonce_field('cim_technology_bg_color_nonce', 'cim_technology_bg_color_nonce');
    
    // Get the background color if it exists
    $bg_color = get_post_meta($post->ID, '_technology_bg_color', true);
    if (empty($bg_color)) {
        $bg_color = '#4a4a4a'; // Default color
    }
    
    // Output the field
    echo '<label for="technology-bg-color">' . __('Background Color', 'cim') . '</label>';
    echo '<input type="color" id="technology-bg-color" name="technology_bg_color" value="' . esc_attr($bg_color) . '" style="width:100%">';
    echo '<p class="description">' . __('Select a background color for this technology content.', 'cim') . '</p>';
}

/**
 * Technology Title Meta Box Callback
 */
function cim_technology_title_callback($post) {
    // Add nonce for security
    wp_nonce_field('cim_technology_title_nonce', 'cim_technology_title_nonce');
    
    // Get the title if it exists
    $title = get_post_meta($post->ID, '_technology_title', true);
    
    // Output the field
    echo '<label for="technology-title">' . __('Title', 'cim') . '</label>';
    echo '<input type="text" id="technology-title" name="technology_title" value="' . esc_attr($title) . '" style="width:100%">';
    echo '<p class="description">' . __('Enter the title for this technology (e.g., CHROME WHITE IRON).', 'cim') . '</p>';
}

/**
 * Save Technology Meta Data
 */
function cim_save_technology_meta($post_id) {
    // Save Background Color
    if (isset($_POST['cim_technology_bg_color_nonce']) && wp_verify_nonce($_POST['cim_technology_bg_color_nonce'], 'cim_technology_bg_color_nonce')) {
        if (isset($_POST['technology_bg_color'])) {
            update_post_meta($post_id, '_technology_bg_color', sanitize_hex_color($_POST['technology_bg_color']));
        }
    }
    
    // Save Title
    if (isset($_POST['cim_technology_title_nonce']) && wp_verify_nonce($_POST['cim_technology_title_nonce'], 'cim_technology_title_nonce')) {
        if (isset($_POST['technology_title'])) {
            update_post_meta($post_id, '_technology_title', sanitize_text_field($_POST['technology_title']));
        }
    }
}
add_action('save_post_technology', 'cim_save_technology_meta');

/**
 * Register Technologies Page Settings
 */
function cim_register_technologies_settings() {
    // Register settings
    register_setting('cim_technologies_options', 'cim_technologies_image');
    register_setting('cim_technologies_options', 'cim_technologies_link');
    
    // Add settings section
    add_settings_section(
        'cim_technologies_section',
        __('Technologies Page Settings', 'cim'),
        'cim_technologies_section_callback',
        'cim_technologies_options'
    );
    
    // Add settings fields
    add_settings_field(
        'cim_technologies_image',
        __('Header Image', 'cim'),
        'cim_technologies_image_callback',
        'cim_technologies_options',
        'cim_technologies_section'
    );
    
    add_settings_field(
        'cim_technologies_link',
        __('Image Link URL', 'cim'),
        'cim_technologies_link_callback',
        'cim_technologies_options',
        'cim_technologies_section'
    );
}
add_action('admin_init', 'cim_register_technologies_settings');

/**
 * Settings Section Callback
 */
function cim_technologies_section_callback() {
    echo '<p>' . __('Configure the Technologies page header image and link.', 'cim') . '</p>';
}

/**
 * Enqueue Media Scripts for Technologies Settings Page
 */
function cim_enqueue_media_scripts($hook) {
    // Only enqueue on the technologies settings page
    if ($hook !== 'technology_page_technologies-settings') {
        return;
    }
    wp_enqueue_media(); // Enqueue WordPress media scripts
}
add_action('admin_enqueue_scripts', 'cim_enqueue_media_scripts');

/**
 * Image Field Callback
 */
function cim_technologies_image_callback() {
    $image_id = get_option('cim_technologies_image');
    $image_url = '';
    
    if ($image_id) {
        $image_url = wp_get_attachment_image_url($image_id, 'medium');
    }
    
    ?>
    <div class="technologies-image-container">
        <input type="hidden" id="cim_technologies_image" name="cim_technologies_image" value="<?php echo esc_attr($image_id); ?>">
        <div id="technologies-image-preview" style="margin-bottom: 10px;">
            <?php if ($image_url) : ?>
                <img src="<?php echo esc_url($image_url); ?>" alt="" style="max-width: 300px; height: auto;">
            <?php endif; ?>
        </div>
        <button type="button" class="button" id="select-technologies-image"><?php _e('Choose from Media Library', 'cim'); ?></button>
        <button type="button" class="button" id="remove-technologies-image" <?php echo empty($image_id) ? 'style="display:none;"' : ''; ?>><?php _e('Remove Image', 'cim'); ?></button>
    </div>
    <p class="description"><?php _e('Select an image from the media library for the Technologies page header.', 'cim'); ?></p>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            var mediaUploader;
            
            $('#select-technologies-image').on('click', function(e) {
                e.preventDefault();
                
                if (mediaUploader) {
                    mediaUploader.open();
                    return;
                }
                
                mediaUploader = wp.media({
                    title: '<?php _e("Select Image from Media Library", "cim"); ?>',
                    button: {
                        text: '<?php _e("Use This Image", "cim"); ?>'
                    },
                    multiple: false,
                    library: {
                        type: 'image' // Restrict to images only
                    }
                });
                
                mediaUploader.on('select', function() {
                    var attachment = mediaUploader.state().get('selection').first().toJSON();
                    $('#cim_technologies_image').val(attachment.id);
                    $('#technologies-image-preview').html('<img src="' + attachment.url + '" alt="" style="max-width: 300px; height: auto;">');
                    $('#remove-technologies-image').show();
                });
                
                mediaUploader.open();
            });
            
            $('#remove-technologies-image').on('click', function() {
                $('#cim_technologies_image').val('');
                $('#technologies-image-preview').html('');
                $(this).hide();
            });
        });
    </script>
    <?php
}

/**
 * Link Field Callback
 */
function cim_technologies_link_callback() {
    $link = get_option('cim_technologies_link');
    echo '<input type="url" id="cim_technologies_link" name="cim_technologies_link" value="' . esc_url($link) . '" class="regular-text">';
    echo '<p class="description">' . __('Enter a URL for the header image to link to.', 'cim') . '</p>';
}

/**
 * Add Technologies Settings Page
 */
function cim_add_technologies_settings_page() {
    add_submenu_page(
        'edit.php?post_type=technology',
        __('Technologies Page Settings', 'cim'),
        __('Page Settings', 'cim'),
        'manage_options',
        'technologies-settings',
        'cim_technologies_settings_page'
    );
}
add_action('admin_menu', 'cim_add_technologies_settings_page');

/**
 * Technologies Settings Page Content
 */
function cim_technologies_settings_page() {
    if (!current_user_can('manage_options')) {
        return;
    }
    ?>
    <div class="wrap">
        <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
        <form action="options.php" method="post">
            <?php
            settings_fields('cim_technologies_options');
            do_settings_sections('cim_technologies_options');
            submit_button();
            ?>
        </form>
    </div>
    <?php
}
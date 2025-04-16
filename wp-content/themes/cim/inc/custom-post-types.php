<?php
/**
 * Custom Post Types for CIM Theme
 *
 * @package Industrial
 */

/**
 * Register custom post types for form submissions and stories
 */
function cim_register_form_submission_post_types() {
    // Register Story post type
    register_post_type('story', array(
        'labels' => array(
            'name'               => __('Stories', 'cim'),
            'singular_name'      => __('Story', 'cim'),
            'menu_name'          => __('Stories', 'cim'),
            'add_new'            => __('Add New', 'cim'),
            'add_new_item'       => __('Add New Story', 'cim'),
            'edit_item'          => __('Edit Story', 'cim'),
            'new_item'           => __('New Story', 'cim'),
            'view_item'          => __('View Story', 'cim'),
            'search_items'       => __('Search Stories', 'cim'),
            'not_found'          => __('No stories found', 'cim'),
            'not_found_in_trash' => __('No stories found in trash', 'cim'),
        ),
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => false, // Hide from main menu, shown in CIM Theme Settings
        'menu_icon'           => 'dashicons-format-aside',
        'capability_type'     => 'post',
        'hierarchical'        => false,
        'supports'            => array('title', 'editor', 'thumbnail', 'excerpt'),
        'has_archive'         => true,
        'rewrite'             => array('slug' => 'stories'),
        'query_var'           => true,
        'show_in_rest'        => true, // Enable Gutenberg editor
    ));
    // Register Career Submission post type
    register_post_type('career_submission', array(
        'labels' => array(
            'name'               => __('Career Submissions', 'cim'),
            'singular_name'      => __('Career Submission', 'cim'),
            'menu_name'          => __('Career Submissions', 'cim'),
            'add_new'            => __('Add New', 'cim'),
            'add_new_item'       => __('Add New Submission', 'cim'),
            'edit_item'          => __('Edit Submission', 'cim'),
            'new_item'           => __('New Submission', 'cim'),
            'view_item'          => __('View Submission', 'cim'),
            'search_items'       => __('Search Submissions', 'cim'),
            'not_found'          => __('No submissions found', 'cim'),
            'not_found_in_trash' => __('No submissions found in trash', 'cim'),
        ),
        'public'              => false,
        'show_ui'             => true,
        'show_in_menu'        => false, // Hide from main menu, shown in CIM Theme Settings
        'menu_icon'           => 'dashicons-id',
        'capability_type'     => 'post',
        'hierarchical'        => false,
        'supports'            => array('title'),
        'has_archive'         => false,
        'rewrite'             => false,
        'query_var'           => false,
    ));
    
    // Register Contact Submission post type
    register_post_type('contact_submission', array(
        'labels' => array(
            'name'               => __('Contact Submissions', 'cim'),
            'singular_name'      => __('Contact Submission', 'cim'),
            'menu_name'          => __('Contact Submissions', 'cim'),
            'add_new'            => __('Add New', 'cim'),
            'add_new_item'       => __('Add New Submission', 'cim'),
            'edit_item'          => __('Edit Submission', 'cim'),
            'new_item'           => __('New Submission', 'cim'),
            'view_item'          => __('View Submission', 'cim'),
            'search_items'       => __('Search Submissions', 'cim'),
            'not_found'          => __('No submissions found', 'cim'),
            'not_found_in_trash' => __('No submissions found in trash', 'cim'),
        ),
        'public'              => false,
        'show_ui'             => true,
        'show_in_menu'        => false, // Hide from main menu, shown in CIM Theme Settings
        'menu_icon'           => 'dashicons-email',
        'capability_type'     => 'post',
        'hierarchical'        => false,
        'supports'            => array('title'),
        'has_archive'         => false,
        'rewrite'             => false,
        'query_var'           => false,
    ));
}
add_action('init', 'cim_register_form_submission_post_types');

/**
 * Add meta boxes for story subtitle
 */
function cim_add_story_meta_boxes() {
    add_meta_box(
        'story_subtitle',
        __('Story Subtitle', 'cim'),
        'cim_story_subtitle_meta_box_callback',
        'story',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'cim_add_story_meta_boxes');

/**
 * Story subtitle meta box callback
 */
function cim_story_subtitle_meta_box_callback($post) {
    // Add nonce for security
    wp_nonce_field('cim_story_subtitle_meta_box', 'cim_story_subtitle_meta_box_nonce');
    
    // Get meta value
    $subtitle = get_post_meta($post->ID, '_story_subtitle', true);
    
    // Output field
    echo '<label for="story_subtitle">' . __('Subtitle', 'cim') . '</label>';
    echo '<input type="text" id="story_subtitle" name="story_subtitle" value="' . esc_attr($subtitle) . '" style="width:100%">';
}

/**
 * Save story subtitle meta box data
 */
function cim_save_story_subtitle_meta_box_data($post_id) {
    // Check if our nonce is set
    if (!isset($_POST['cim_story_subtitle_meta_box_nonce'])) {
        return;
    }

    // Verify that the nonce is valid
    if (!wp_verify_nonce($_POST['cim_story_subtitle_meta_box_nonce'], 'cim_story_subtitle_meta_box')) {
        return;
    }

    // If this is an autosave, our form has not been submitted, so we don't want to do anything
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    // Check the user's permissions
    if (isset($_POST['post_type']) && 'story' == $_POST['post_type']) {
        if (!current_user_can('edit_post', $post_id)) {
            return;
        }
    }

    // Save the subtitle
    if (isset($_POST['story_subtitle'])) {
        update_post_meta($post_id, '_story_subtitle', sanitize_text_field($_POST['story_subtitle']));
    }
}
add_action('save_post', 'cim_save_story_subtitle_meta_box_data');

/**
 * Add meta boxes for career submissions
 */
function cim_add_career_submission_meta_boxes() {
    add_meta_box(
        'career_submission_details',
        __('Submission Details', 'cim'),
        'cim_career_submission_meta_box_callback',
        'career_submission',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'cim_add_career_submission_meta_boxes');

/**
 * Career submission meta box callback
 */
function cim_career_submission_meta_box_callback($post) {
    // Add nonce for security
    wp_nonce_field('cim_career_submission_meta_box', 'cim_career_submission_meta_box_nonce');
    
    // Get meta values
    $full_name = get_post_meta($post->ID, '_full_name', true);
    $position = get_post_meta($post->ID, '_position', true);
    $email = get_post_meta($post->ID, '_email', true);
    $phone = get_post_meta($post->ID, '_phone', true);
    $education = get_post_meta($post->ID, '_education', true);
    $experience = get_post_meta($post->ID, '_experience', true);
    $additional_info = get_post_meta($post->ID, '_additional_info', true);
    $submission_date = get_post_meta($post->ID, '_submission_date', true);
    
    // Output fields
    echo '<p><strong>' . __('Full Name:', 'cim') . '</strong> ' . esc_html($full_name) . '</p>';
    echo '<p><strong>' . __('Position Applied For:', 'cim') . '</strong> ' . esc_html($position) . '</p>';
    echo '<p><strong>' . __('Email:', 'cim') . '</strong> ' . esc_html($email) . '</p>';
    echo '<p><strong>' . __('Phone:', 'cim') . '</strong> ' . esc_html($phone) . '</p>';
    echo '<p><strong>' . __('Education:', 'cim') . '</strong> ' . esc_html($education) . '</p>';
    echo '<p><strong>' . __('Experience:', 'cim') . '</strong> ' . esc_html($experience) . '</p>';
    echo '<p><strong>' . __('Additional Information:', 'cim') . '</strong></p>';
    echo '<div style="padding: 10px; background: #f8f8f8; border: 1px solid #ddd;">' . wpautop(esc_html($additional_info)) . '</div>';
    echo '<p><strong>' . __('Submission Date:', 'cim') . '</strong> ' . esc_html($submission_date) . '</p>';
}

/**
 * Add meta boxes for contact submissions
 */
function cim_add_contact_submission_meta_boxes() {
    add_meta_box(
        'contact_submission_details',
        __('Submission Details', 'cim'),
        'cim_contact_submission_meta_box_callback',
        'contact_submission',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'cim_add_contact_submission_meta_boxes');

/**
 * Contact submission meta box callback
 */
function cim_contact_submission_meta_box_callback($post) {
    // Add nonce for security
    wp_nonce_field('cim_contact_submission_meta_box', 'cim_contact_submission_meta_box_nonce');
    
    // Get meta values
    $first_name = get_post_meta($post->ID, '_first_name', true);
    $last_name = get_post_meta($post->ID, '_last_name', true);
    $email = get_post_meta($post->ID, '_email', true);
    $phone = get_post_meta($post->ID, '_phone', true);
    $comments = get_post_meta($post->ID, '_comments', true);
    $submission_date = get_post_meta($post->ID, '_submission_date', true);
    
    // Output fields
    echo '<p><strong>' . __('First Name:', 'cim') . '</strong> ' . esc_html($first_name) . '</p>';
    echo '<p><strong>' . __('Last Name:', 'cim') . '</strong> ' . esc_html($last_name) . '</p>';
    echo '<p><strong>' . __('Email:', 'cim') . '</strong> ' . esc_html($email) . '</p>';
    echo '<p><strong>' . __('Phone:', 'cim') . '</strong> ' . esc_html($phone) . '</p>';
    echo '<p><strong>' . __('Comments:', 'cim') . '</strong></p>';
    echo '<div style="padding: 10px; background: #f8f8f8; border: 1px solid #ddd;">' . wpautop(esc_html($comments)) . '</div>';
    echo '<p><strong>' . __('Submission Date:', 'cim') . '</strong> ' . esc_html($submission_date) . '</p>';
}
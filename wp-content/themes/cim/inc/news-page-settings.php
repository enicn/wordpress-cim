<?php
/**
 * News Page Settings
 *
 * Adds admin settings for the News page template
 */

if (!defined('ABSPATH')) {
  exit; // Exit if accessed directly
}

/**
 * Add News Page Settings to the admin menu
 * 
 * Note: This function is no longer needed as the menu item is now added
 * through the CIM Theme Settings menu in theme-settings.php
 */
function cim_add_news_page_settings_menu()
{
  // Menu registration moved to theme-settings.php
  // This function is kept for backward compatibility
}
// Removed action hook as this is now handled in theme-settings.php

/**
 * Register News Page Settings
 */
function cim_register_news_page_settings()
{
  // Register settings
  register_setting('cim_news_page_settings', 'cim_featured_main_post');
  register_setting('cim_news_page_settings', 'cim_featured_sidebar_posts');
  register_setting('cim_news_page_settings', 'cim_news_video_url');
  register_setting('cim_news_page_settings', 'cim_news_video_title');
  register_setting('cim_news_page_settings', 'cim_news_video_subtitle');
}
add_action('admin_init', 'cim_register_news_page_settings');

/**
 * News Page Settings Callback
 */
function cim_news_page_settings_callback()
{
  // Get current settings
  $featured_main_post_id = get_option('cim_featured_main_post');
  $featured_sidebar_posts = get_option('cim_featured_sidebar_posts', array());
  $video_url = get_option('cim_news_video_url', '');
  $video_title = get_option('cim_news_video_title', 'CIM Products');
  $video_subtitle = get_option('cim_news_video_subtitle', 'Silicon Carbide Ceramic');

  // Get posts for selection
  $posts = get_posts(array(
    'post_type' => 'post',
    'posts_per_page' => -1,
    'orderby' => 'title',
    'order' => 'ASC',
  ));
  ?>
  <div class="wrap">
    <h1><?php echo esc_html__('News Page Settings', 'cim'); ?></h1>
    <form method="post" action="options.php">
      <?php settings_fields('cim_news_page_settings'); ?>

      <h2><?php echo esc_html__('Featured Posts', 'cim'); ?></h2>
      <p><?php echo esc_html__('Select posts to feature on the News page.', 'cim'); ?></p>

      <table class="form-table">
        <tr>
          <th scope="row">
            <label for="cim_featured_main_post"><?php echo esc_html__('Main Featured Post', 'cim'); ?></label>
          </th>
          <td>
            <select name="cim_featured_main_post" id="cim_featured_main_post">
              <option value=""><?php echo esc_html__('-- Select a post --', 'cim'); ?></option>
              <?php foreach ($posts as $post): ?>
                <option value="<?php echo esc_attr($post->ID); ?>" <?php selected($featured_main_post_id, $post->ID); ?>>
                  <?php echo esc_html($post->post_title); ?>
                </option>
              <?php endforeach; ?>
            </select>
            <p class="description">
              <?php echo esc_html__('This post will be displayed as the large featured post on the left side.', 'cim'); ?>
            </p>
          </td>
        </tr>

        <tr>
          <th scope="row">
            <label><?php echo esc_html__('Sidebar Featured Posts', 'cim'); ?></label>
          </th>
          <td>
            <p><?php echo esc_html__('Select up to 5 posts to display in the sidebar.', 'cim'); ?></p>
            <?php for ($i = 0; $i < 5; $i++): ?>
              <select name="cim_featured_sidebar_posts[]" style="margin-bottom: 10px; width: 100%;">
                <option value=""><?php echo esc_html__('-- Select a post --', 'cim'); ?></option>
                <?php foreach ($posts as $post): ?>
                  <option value="<?php echo esc_attr($post->ID); ?>" <?php selected(isset($featured_sidebar_posts[$i]) ? $featured_sidebar_posts[$i] : '', $post->ID); ?>>
                    <?php echo esc_html($post->post_title); ?>
                  </option>
                <?php endforeach; ?>
              </select>
            <?php endfor; ?>
          </td>
        </tr>
      </table>

      <h2><?php echo esc_html__('Video Section', 'cim'); ?></h2>
      <p><?php echo esc_html__('Configure the video section displayed below the main featured post.', 'cim'); ?></p>

      <table class="form-table">
        <tr>
          <th scope="row">
            <label for="cim_news_video_url"><?php echo esc_html__('Video URL', 'cim'); ?></label>
          </th>
          <td>
            <input type="url" name="cim_news_video_url" id="cim_news_video_url"
              value="<?php echo esc_attr($video_url); ?>" class="regular-text">
            <p class="description"><?php echo esc_html__('Enter the URL for the video (YouTube, Vimeo, etc.).', 'cim'); ?>
            </p>
          </td>
        </tr>

        <tr>
          <th scope="row">
            <label for="cim_news_video_title"><?php echo esc_html__('Video Title', 'cim'); ?></label>
          </th>
          <td>
            <input type="text" name="cim_news_video_title" id="cim_news_video_title"
              value="<?php echo esc_attr($video_title); ?>" class="regular-text">
          </td>
        </tr>

        <tr>
          <th scope="row">
            <label for="cim_news_video_subtitle"><?php echo esc_html__('Video Subtitle', 'cim'); ?></label>
          </th>
          <td>
            <input type="text" name="cim_news_video_subtitle" id="cim_news_video_subtitle"
              value="<?php echo esc_attr($video_subtitle); ?>" class="regular-text">
          </td>
        </tr>
      </table>

      <?php submit_button(); ?>
    </form>
  </div>
  <?php
}

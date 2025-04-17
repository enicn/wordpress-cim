<?php
/**
 * CIM Theme Settings
 *
 * Creates a unified admin menu for all CIM theme settings
 *
 * @package Industrial
 */

if (!defined('ABSPATH')) {
  exit; // Exit if accessed directly
}

/**
 * Add main CIM Theme Settings menu
 */
function cim_add_theme_settings_menu()
{
  // Add main menu
  add_menu_page(
    __('CIM Theme Settings', 'cim'),
    __('CIM Theme', 'cim'),
    'manage_options',
    'cim-theme-settings',
    'cim_theme_settings_callback',
    'dashicons-admin-customizer',
    30
  );

  // Add submenu pages
  add_submenu_page(
    'cim-theme-settings',
    __('Theme Overview', 'cim'),
    __('Theme Overview', 'cim'),
    'manage_options',
    'cim-theme-settings',
    'cim_theme_settings_callback'
  );

  // Add Carousel Slides submenu
  add_submenu_page(
    'cim-theme-settings',
    __('Carousel Slides', 'cim'),
    __('Carousel Slides', 'cim'),
    'manage_options',
    'edit.php?post_type=carousel'
  );

  // Redirect existing settings pages to the new menu
  // News Page Settings
  // add_submenu_page(
  //   'cim-theme-settings',
  //   __('News Page Settings', 'cim'),
  //   __('News Page Settings', 'cim'),
  //   'manage_options',
  //   'cim-news-page-settings',
  //   'cim_news_page_settings_callback'
  // );

  // About Page Settings
  add_submenu_page(
    'cim-theme-settings',
    __('About Page Settings', 'cim'),
    __('About Page Settings', 'cim'),
    'manage_options',
    'about-page-settings',
    'cim_about_page_settings_page'
  );

  // Add Stories submenu
  add_submenu_page(
    'cim-theme-settings',
    __('Stories', 'cim'),
    __('Stories', 'cim'),
    'manage_options',
    'edit.php?post_type=story'
  );

  // Remove original menu items
  remove_submenu_page('options-general.php', 'cim-news-page-settings');
  remove_submenu_page('edit.php?post_type=page', 'about-page-settings');

  // Add Technologies submenu
  add_submenu_page(
    'cim-theme-settings',
    __('Technologies', 'cim'),
    __('Technologies', 'cim'),
    'manage_options',
    'edit.php?post_type=technology'
  );

  // Add Technologies Settings submenu
  add_submenu_page(
    'cim-theme-settings',
    __('Technologies Settings', 'cim'),
    __('Technologies Settings', 'cim'),
    'manage_options',
    'technologies-settings',
    'cim_technologies_settings_page'
  );
  
  // Add Products submenu
  add_submenu_page(
    'cim-theme-settings',
    __('Products', 'cim'),
    __('Products', 'cim'),
    'manage_options',
    'edit.php?post_type=product'
  );

  // Add Career Submissions submenu
  add_submenu_page(
    'cim-theme-settings',
    __('Career Submissions', 'cim'),
    __('Career Submissions', 'cim'),
    'manage_options',
    'edit.php?post_type=career_submission'
  );

  // Add Contact Submissions submenu
  add_submenu_page(
    'cim-theme-settings',
    __('Contact Submissions', 'cim'),
    __('Contact Submissions', 'cim'),
    'manage_options',
    'edit.php?post_type=contact_submission'
  );
}
add_action('admin_menu', 'cim_add_theme_settings_menu', 9); // Priority 9 to run before other menu registrations

/**
 * Main Theme Settings page callback
 */
function cim_theme_settings_callback()
{
  ?>
  <div class="wrap">
    <h1><?php echo esc_html__('CIM Theme Settings', 'cim'); ?></h1>
    <div class="card">
      <h2><?php echo esc_html__('Theme Information', 'cim'); ?></h2>
      <p><?php echo esc_html__('CIM Theme Version:', 'cim'); ?> <strong><?php echo esc_html(cim_VERSION); ?></strong></p>
      <p><?php echo esc_html__('This page provides access to all settings for the CIM theme.', 'cim'); ?></p>
    </div>

    <div class="card">
      <h2><?php echo esc_html__('Available Settings', 'cim'); ?></h2>
      <ul class="cim-settings-list" style="list-style: disc; padding-left: 20px;">
        <li><a
            href="<?php echo esc_url(admin_url('admin.php?page=cim-news-page-settings')); ?>"><?php echo esc_html__('News Page Settings', 'cim'); ?></a>
        </li>
        <li><a
            href="<?php echo esc_url(admin_url('admin.php?page=about-page-settings')); ?>"><?php echo esc_html__('About Page Settings', 'cim'); ?></a>
        </li>
        <li><a
            href="<?php echo esc_url(admin_url('edit.php?post_type=story')); ?>"><?php echo esc_html__('Stories', 'cim'); ?></a>
        </li>
        <li><a
            href="<?php echo esc_url(admin_url('edit.php?post_type=career_submission')); ?>"><?php echo esc_html__('Career Submissions', 'cim'); ?></a>
        </li>
        <li><a
            href="<?php echo esc_url(admin_url('edit.php?post_type=contact_submission')); ?>"><?php echo esc_html__('Contact Submissions', 'cim'); ?></a>
        </li>
        <li><a
            href="<?php echo esc_url(admin_url('edit.php?post_type=product')); ?>"><?php echo esc_html__('Products', 'cim'); ?></a>
        </li>
        <li><a
            href="<?php echo esc_url(admin_url('edit.php?post_type=technology')); ?>"><?php echo esc_html__('Technologies', 'cim'); ?></a>
        </li>
        <li><a
            href="<?php echo esc_url(admin_url('admin.php?page=technologies-settings')); ?>"><?php echo esc_html__('Technologies Settings', 'cim'); ?></a>
        </li>
        <li><a
            href="<?php echo esc_url(admin_url('edit.php?post_type=carousel')); ?>"><?php echo esc_html__('Carousel Slides', 'cim'); ?></a>
        </li>
      </ul>
    </div>
  </div>
  <?php
}
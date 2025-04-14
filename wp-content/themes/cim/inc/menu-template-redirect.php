<?php
/**
 * Menu Template Redirect Functions
 *
 * Functions to handle redirecting menu items to specific page templates
 *
 * @package Industrial
 */

/**
 * Create rewrite rules for our custom templates
 */
function cim_add_rewrite_rules()
{
  add_rewrite_rule('^([a-zA-Z0-9\-]+)\.html$', 'index.php?pagename=$matches[1]', 'top');
}
add_action('init', 'cim_add_rewrite_rules');

/**
 * Register virtual pages for our templates
 */
function cim_register_virtual_pages($query)
{
  if (!$query->is_main_query()) {
    return;
  }
  $pagename = $query->get('pagename');
  if (!empty($pagename)) {
    add_filter('template_include', function () use ($pagename) {
      return get_template_directory() . "/page-{$pagename}.php";
    });
  }
}
add_action('pre_get_posts', 'cim_register_virtual_pages');

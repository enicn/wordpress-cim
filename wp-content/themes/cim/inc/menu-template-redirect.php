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
  add_rewrite_rule('^([a-zA-Z0-9\-]+)$', 'index.php?pagename=$matches[1]', 'top');
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

/**
 * Set custom title parts for virtual pages
 */
function cim_custom_virtual_page_title_parts($title_parts) {
  // 检查当前查询是否为 'about' 页面
  $pagename = get_query_var('pagename');
  // 修改标题数组中的 'title' 部分
  $title_parts['title'] = ucwords(str_replace('-', ' ', $pagename)); // e.g., "About", "Contact Us"
  // 返回修改后的标题部分数组
  return $title_parts;
}
add_filter('document_title_parts', 'cim_custom_virtual_page_title_parts', 20); // 使用较高优先级

/**
* 确保主题支持 title-tag (如果尚未添加)
* 应该放在主题的 functions.php 中
*/
function theme_setup() {
  add_theme_support('title-tag');
}
add_action('after_setup_theme', 'theme_setup');

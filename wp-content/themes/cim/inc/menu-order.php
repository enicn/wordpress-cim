<?php
/**
 * Menu Order Settings
 *
 * @package Industrial
 */

/**
 * 重新排序WordPress管理菜单
 */
function cim_custom_menu_order($menu_ord) {
    if (!$menu_ord) return true;
    
    // 定义菜单顺序
    $custom_menu_order = array(
        'index.php', // Dashboard
        'themes.php', // 外观 (全局设置)
        'edit.php?post_type=page', // 页面
        'about-page-settings', // About Us 设置
        'edit.php', // 文章 (News)
        'edit.php?post_type=story', // Success Stories
        'technologies-settings', // Technologies 设置
        'edit.php?post_type=product', // Products
        'edit.php?post_type=career_submission', // Careers
        'edit.php?post_type=contact_submission', // Contact Us
        'upload.php', // 媒体
        'plugins.php', // 插件
        'users.php', // 用户
        'tools.php', // 工具
        'options-general.php', // 设置
    );
    
    return $custom_menu_order;
}
add_filter('custom_menu_order', 'cim_custom_menu_order', 10, 1);
add_filter('menu_order', 'cim_custom_menu_order', 10, 1);

/**
 * 修改子菜单顺序
 */
function cim_custom_submenu_order() {
    global $submenu;
    
    // 确保页面子菜单存在
    if (isset($submenu['edit.php?post_type=page'])) {
        // 将About Page Settings移到顶部
        foreach ($submenu['edit.php?post_type=page'] as $key => $item) {
            if ($item[2] === 'about-page-settings') {
                // 保存About Page Settings菜单项
                $about_settings = $submenu['edit.php?post_type=page'][$key];
                // 从原位置删除
                unset($submenu['edit.php?post_type=page'][$key]);
                // 重新插入到顶部
                array_unshift($submenu['edit.php?post_type=page'], $about_settings);
                break;
            }
        }
    }
}
add_action('admin_menu', 'cim_custom_submenu_order', 999);

/**
 * 添加菜单分隔符
 */
function cim_add_admin_menu_separator() {
    global $menu;
    
    // 在主要菜单项之后添加分隔符
    $positions = array(
        59, // 在Contact Us之后
        69, // 在媒体之后
    );
    
    foreach ($positions as $position) {
        $menu[$position] = array(
            '',
            'read',
            'separator' . $position,
            '',
            'wp-menu-separator'
        );
    }
}
add_action('admin_menu', 'cim_add_admin_menu_separator');
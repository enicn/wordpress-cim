<?php
/**
 * About Page Settings
 *
 * @package Industrial
 */

/**
 * Register About Page Settings
 */
function cim_register_about_page_settings() {
    // 只在管理员界面加载
    if (!is_admin()) {
        return;
    }

    // 注册设置
    add_action('admin_init', 'cim_register_about_page_options');
}
add_action('init', 'cim_register_about_page_settings');

/**
 * 添加About页面菜单
 * 
 * 注意：实际菜单项已在theme-settings.php中添加到CIM Theme菜单下
 * 此函数保留但不再使用，菜单注册已移至theme-settings.php
 */
function cim_add_about_page_menu() {
    // 菜单项已在theme-settings.php中添加到CIM Theme菜单下
    // 此处不再添加到页面菜单中
}

/**
 * 注册About页面选项
 */
function cim_register_about_page_options() {
    // 注册设置组
    register_setting('cim_about_page_options', 'cim_about_page_options', 'cim_about_page_options_sanitize');

    // Hero部分
    add_settings_section(
        'cim_about_hero_section',
        __('Hero Section', 'cim'),
        'cim_about_hero_section_callback',
        'about-page-settings'
    );

    // 添加Hero部分字段
    add_settings_field(
        'hero_title',
        __('Hero Title', 'cim'),
        'cim_text_field_callback',
        'about-page-settings',
        'cim_about_hero_section',
        array(
            'id' => 'hero_title',
            'default' => 'CIM Corporation'
        )
    );

    add_settings_field(
        'hero_description',
        __('Hero Description', 'cim'),
        'cim_textarea_field_callback',
        'about-page-settings',
        'cim_about_hero_section',
        array(
            'id' => 'hero_description',
            'default' => get_bloginfo('description') . ' (CIM) is a global leader in wear solutions, specializing in advanced materials engineered to withstand extreme abrasion in the mining, energy, and construction industries. Our proprietary technologies - including Tungsten Carbide Overlay (WCO), High Chrome White Iron (HCWI), Silicon Carbide Ceramic (SiC), and Chrome Carbide Overlay (CCO) - provide exceptional wear resistance, significantly enhancing equipment performance and longevity.'
        )
    );

    add_settings_field(
        'brochure_button_text',
        __('Brochure Button Text', 'cim'),
        'cim_text_field_callback',
        'about-page-settings',
        'cim_about_hero_section',
        array(
            'id' => 'brochure_button_text',
            'default' => 'CIM Brochure'
        )
    );

    add_settings_field(
        'brochure_button_url',
        __('Brochure Button URL', 'cim'),
        'cim_text_field_callback',
        'about-page-settings',
        'cim_about_hero_section',
        array(
            'id' => 'brochure_button_url',
            'default' => 'https://drive.google.com/file/d/1tKpVcyX2ZXmbXX2xVfOI7AZpGLQM1292/view?pli=1'
        )
    );

    add_settings_field(
        'hero_image',
        __('Hero Image', 'cim'),
        'cim_image_field_callback',
        'about-page-settings',
        'cim_about_hero_section',
        array(
            'id' => 'hero_image',
            'default' => get_template_directory_uri() . '/assets/images/CIM-Brochure-2022-Latest-Cover.webp'
        )
    );

    // Values部分
    add_settings_section(
        'cim_about_values_section',
        __('Values Section', 'cim'),
        'cim_about_values_section_callback',
        'about-page-settings'
    );

    add_settings_field(
        'values_background_image',
        __('Values Background Image', 'cim'),
        'cim_image_field_callback',
        'about-page-settings',
        'cim_about_values_section',
        array(
            'id' => 'values_background_image',
            'default' => get_template_directory_uri() . '/assets/images/DARK-BG-NEW.jpg'
        )
    );

    // 添加四个核心价值观
    $values = array(
        'integrity' => array(
            'title' => 'Integrity',
            'description' => 'We uphold the highest standards of integrity in all of our activities, prioritizing honest, transparency and a commitment to excellence.',
            'icon' => get_template_directory_uri() . '/assets/images/icon-1.webp'
        ),
        'innovation' => array(
            'title' => 'Innovation',
            'description' => 'We foster creativity, delivering globally recognized solutions that surpass the expectations of our clients and the market.',
            'icon' => get_template_directory_uri() . '/assets/images/icon-2.webp'
        ),
        'improvement' => array(
            'title' => 'Improvement',
            'description' => 'We are lifelong learners, constantly seeking professional growth. Our culture thrives on innovation and continuous improvement.',
            'icon' => get_template_directory_uri() . '/assets/images/icon-3.webp'
        ),
        'teamwork' => array(
            'title' => 'Teamwork',
            'description' => 'We collaborate as a team to foster member growth and uphold excellence, ensuring the success of our partners.',
            'icon' => get_template_directory_uri() . '/assets/images/icon-4.webp'
        )
    );

    foreach ($values as $key => $value) {
        add_settings_field(
            $key . '_title',
            sprintf(__('%s Title', 'cim'), $value['title']),
            'cim_text_field_callback',
            'about-page-settings',
            'cim_about_values_section',
            array(
                'id' => $key . '_title',
                'default' => $value['title']
            )
        );

        add_settings_field(
            $key . '_description',
            sprintf(__('%s Description', 'cim'), $value['title']),
            'cim_textarea_field_callback',
            'about-page-settings',
            'cim_about_values_section',
            array(
                'id' => $key . '_description',
                'default' => $value['description']
            )
        );

        add_settings_field(
            $key . '_icon',
            sprintf(__('%s Icon', 'cim'), $value['title']),
            'cim_image_field_callback',
            'about-page-settings',
            'cim_about_values_section',
            array(
                'id' => $key . '_icon',
                'default' => $value['icon']
            )
        );
    }

    // Vision/Mission部分
    add_settings_section(
        'cim_about_vision_mission_section',
        __('Vision & Mission Section', 'cim'),
        'cim_about_vision_mission_section_callback',
        'about-page-settings'
    );

    add_settings_field(
        'vision_title',
        __('Vision Title', 'cim'),
        'cim_text_field_callback',
        'about-page-settings',
        'cim_about_vision_mission_section',
        array(
            'id' => 'vision_title',
            'default' => 'VISION'
        )
    );

    add_settings_field(
        'vision_description',
        __('Vision Description', 'cim'),
        'cim_textarea_field_callback',
        'about-page-settings',
        'cim_about_vision_mission_section',
        array(
            'id' => 'vision_description',
            'default' => 'To deliver innovative wear solutions and reliable products that enhance efficiency and promote sustainability for our customers.'
        )
    );

    add_settings_field(
        'mission_title',
        __('Mission Title', 'cim'),
        'cim_text_field_callback',
        'about-page-settings',
        'cim_about_vision_mission_section',
        array(
            'id' => 'mission_title',
            'default' => 'MISSION'
        )
    );

    add_settings_field(
        'mission_description',
        __('Mission Description', 'cim'),
        'cim_textarea_field_callback',
        'about-page-settings',
        'cim_about_vision_mission_section',
        array(
            'id' => 'mission_description',
            'default' => 'We develop advanced coating, wear-resistant materials and disruptive technologies for mining, energy and construction applications to enhance performance and improve performance.'
        )
    );
}

/**
 * Hero部分回调
 */
function cim_about_hero_section_callback() {
    echo '<p>' . __('Configure the hero section of the About page.', 'cim') . '</p>';
}

/**
 * Values部分回调
 */
function cim_about_values_section_callback() {
    echo '<p>' . __('Configure the values section of the About page.', 'cim') . '</p>';
}

/**
 * Vision/Mission部分回调
 */
function cim_about_vision_mission_section_callback() {
    echo '<p>' . __('Configure the vision and mission section of the About page.', 'cim') . '</p>';
}

/**
 * 文本字段回调
 */
function cim_text_field_callback($args) {
    $options = get_option('cim_about_page_options', array());
    $id = $args['id'];
    $default = isset($args['default']) ? $args['default'] : '';
    $value = isset($options[$id]) ? $options[$id] : $default;
    
    echo '<input type="text" id="' . esc_attr($id) . '" name="cim_about_page_options[' . esc_attr($id) . ']" value="' . esc_attr($value) . '" class="regular-text" />';
}

/**
 * 文本区域字段回调
 */
function cim_textarea_field_callback($args) {
    $options = get_option('cim_about_page_options', array());
    $id = $args['id'];
    $default = isset($args['default']) ? $args['default'] : '';
    $value = isset($options[$id]) ? $options[$id] : $default;
    
    echo '<textarea id="' . esc_attr($id) . '" name="cim_about_page_options[' . esc_attr($id) . ']" rows="5" cols="50">' . esc_textarea($value) . '</textarea>';
}

/**
 * 图片字段回调
 */
function cim_image_field_callback($args) {
    $options = get_option('cim_about_page_options', array());
    $id = $args['id'];
    $default = isset($args['default']) ? $args['default'] : '';
    $value = isset($options[$id]) ? $options[$id] : $default;
    
    echo '<div class="image-preview-wrapper">';
    echo '<img id="' . esc_attr($id) . '_preview" src="' . esc_url($value) . '" style="max-width:100px;" />';
    echo '</div>';
    echo '<input type="text" id="' . esc_attr($id) . '" name="cim_about_page_options[' . esc_attr($id) . ']" value="' . esc_url($value) . '" class="regular-text" />';
    echo '<input type="button" class="button button-secondary cim-image-upload" value="' . esc_attr__('Upload Image', 'cim') . '" data-field="' . esc_attr($id) . '" />';
    
    // 确保只加载一次媒体上传脚本
    static $is_script_loaded = false;
    if (!$is_script_loaded) {
        add_action('admin_footer', 'cim_image_upload_script');
        $is_script_loaded = true;
    }
}

/**
 * 图片上传脚本
 */
function cim_image_upload_script() {
    ?>
    <script type="text/javascript">
    jQuery(document).ready(function($) {
        $('.cim-image-upload').click(function(e) {
            e.preventDefault();
            
            var button = $(this);
            var fieldId = button.data('field');
            var customUploader = wp.media({
                title: '<?php echo esc_js(__('Select Image', 'cim')); ?>',
                button: {
                    text: '<?php echo esc_js(__('Use this image', 'cim')); ?>'
                },
                multiple: false
            }).on('select', function() {
                var attachment = customUploader.state().get('selection').first().toJSON();
                $('#' + fieldId).val(attachment.url);
                $('#' + fieldId + '_preview').attr('src', attachment.url);
            }).open();
        });
    });
    </script>
    <?php
}

/**
 * 选项清理
 */
function cim_about_page_options_sanitize($input) {
    $sanitized_input = array();
    
    foreach ($input as $key => $value) {
        if (strpos($key, 'description') !== false) {
            $sanitized_input[$key] = wp_kses_post($value);
        } elseif (strpos($key, 'url') !== false || strpos($key, 'image') !== false || strpos($key, 'icon') !== false) {
            $sanitized_input[$key] = esc_url_raw($value);
        } else {
            $sanitized_input[$key] = sanitize_text_field($value);
        }
    }
    
    return $sanitized_input;
}

/**
 * About页面设置页面
 */
function cim_about_page_settings_page() {
    if (!current_user_can('manage_options')) {
        return;
    }
    ?>
    <div class="wrap">
        <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
        <form action="options.php" method="post">
            <?php
            settings_fields('cim_about_page_options');
            do_settings_sections('about-page-settings');
            submit_button();
            ?>
        </form>
    </div>
    <?php
}

/**
 * 获取About页面选项
 */
function cim_get_about_page_option($key, $default = '') {
    $options = get_option('cim_about_page_options', array());
    return isset($options[$key]) && !empty($options[$key]) ? $options[$key] : $default;
}
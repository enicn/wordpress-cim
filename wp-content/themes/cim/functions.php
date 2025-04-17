<?php
/**
 * CIM functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Industrial
 * @package Industrial
 */

if (!defined('cim_VERSION')) {
  // Replace the version number of the theme on each release.
  define('cim_VERSION', '1.0.1');
}

// Include custom menu walker
require get_template_directory() . '/inc/class-cim-menu-walker.php';

// Include menu template redirect functions
require get_template_directory() . '/inc/menu-template-redirect.php';

// Include custom post types for form submissions
require get_template_directory() . '/inc/custom-post-types.php';

// Include form handlers
require get_template_directory() . '/inc/form-handlers.php';

// Include Ajax handlers
require get_template_directory() . '/inc/ajax-handlers.php';

// Include theme settings menu
require get_template_directory() . '/inc/theme-settings.php';

// Include news page settings
require get_template_directory() . '/inc/news-page-settings.php';

// Include technologies page settings
require get_template_directory() . '/inc/technologies-settings.php';

// Include about page settings
require get_template_directory() . '/inc/about-page-settings.php';

// Include menu order settings
require get_template_directory() . '/inc/menu-order.php';

// Include live chat functionality
require get_template_directory() . '/inc/live-chat.php';

/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function cim_setup()
{
  /*
   * Make theme available for translation.
   */
  load_theme_textdomain('cim', get_template_directory() . '/languages');

  // Add default posts and comments RSS feed links to head.
  add_theme_support('automatic-feed-links');

  /*
   * Let WordPress manage the document title.
   */
  add_theme_support('title-tag');

  /*
   * Enable support for Post Thumbnails on posts and pages.
   */
  add_theme_support('post-thumbnails');

  // This theme uses wp_nav_menu() in one location.
  register_nav_menus(
    array(
      'primary' => esc_html__('Primary Menu', 'cim'),
      'footer' => esc_html__('Footer Menu', 'cim'),
    )
  );

  /*
   * Switch default core markup for search form, comment form, and comments
   * to output valid HTML5.
   */
  add_theme_support(
    'html5',
    array(
      'search-form',
      'comment-form',
      'comment-list',
      'gallery',
      'caption',
      'style',
      'script',
    )
  );

  // Set up the WordPress core custom background feature.
  add_theme_support(
    'custom-background',
    apply_filters(
      'cim_custom_background_args',
      array(
        'default-color' => '121212',
        'default-image' => '',
      )
    )
  );

  // Add theme support for selective refresh for widgets.
  add_theme_support('customize-selective-refresh-widgets');

  /**
   * Add support for core custom logo.
   */
  add_theme_support(
    'custom-logo',
    array(
      'height' => 250,
      'width' => 250,
      'flex-width' => true,
      'flex-height' => true,
    )
  );
}
add_action('after_setup_theme', 'cim_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function cim_content_width()
{
  $GLOBALS['content_width'] = apply_filters('cim_content_width', 1200);
}
add_action('after_setup_theme', 'cim_content_width', 0);

/**
 * Register widget area.
 */
function cim_widgets_init()
{
  register_sidebar(
    array(
      'name' => esc_html__('Sidebar', 'cim'),
      'id' => 'sidebar-1',
      'description' => esc_html__('Add widgets here.', 'cim'),
      'before_widget' => '<section id="%1$s" class="widget %2$s">',
      'after_widget' => '</section>',
      'before_title' => '<h2 class="widget-title">',
      'after_title' => '</h2>',
    )
  );

  register_sidebar(
    array(
      'name' => esc_html__('Footer 1', 'cim'),
      'id' => 'footer-1',
      'description' => esc_html__('Add footer widgets here.', 'cim'),
      'before_widget' => '<div id="%1$s" class="widget %2$s">',
      'after_widget' => '</div>',
      'before_title' => '<h3 class="footer-title">',
      'after_title' => '</h3>',
    )
  );

  register_sidebar(
    array(
      'name' => esc_html__('Footer 2', 'cim'),
      'id' => 'footer-2',
      'description' => esc_html__('Add footer widgets here.', 'cim'),
      'before_widget' => '<div id="%1$s" class="widget %2$s">',
      'after_widget' => '</div>',
      'before_title' => '<h3 class="footer-title">',
      'after_title' => '</h3>',
    )
  );

  register_sidebar(
    array(
      'name' => esc_html__('Footer 3', 'cim'),
      'id' => 'footer-3',
      'description' => esc_html__('Add footer widgets here.', 'cim'),
      'before_widget' => '<div id="%1$s" class="widget %2$s">',
      'after_widget' => '</div>',
      'before_title' => '<h3 class="footer-title">',
      'after_title' => '</h3>',
    )
  );
}
add_action('widgets_init', 'cim_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function cim_scripts()
{
  // Enqueue main stylesheet
  wp_enqueue_style('cim-style', get_stylesheet_uri(), array(), cim_VERSION);

  // Enqueue Font Awesome for icons
  wp_enqueue_style('cim-fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css', array(), '5.15.4');

  // Enqueue Slick Slider
  wp_enqueue_style('slick', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css', array(), '1.8.1');
  wp_enqueue_style('slick-theme', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css', array(), '1.8.1');
  wp_enqueue_script('slick', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', array('jquery'), '1.8.1', true);

  // Enqueue custom CSS
  wp_enqueue_style('cim-menu-page', get_template_directory_uri() . '/assets/css/menu-page.css', array(), cim_VERSION);

  // Enqueue carousel and about CSS for front page
  if (is_front_page()) {
    wp_enqueue_style('cim-carousel', get_template_directory_uri() . '/assets/css/carousel.css', array(), cim_VERSION);
    wp_enqueue_style('cim-about', get_template_directory_uri() . '/assets/css/about.css', array(), cim_VERSION);
    wp_enqueue_style('cim-category-thumbnails', get_template_directory_uri() . '/assets/css/category-thumbnails.css', array(), cim_VERSION);
  }

  // Enqueue Ajax forms script for contact and careers pages
  if (is_page_template('page-careers.php') || is_page_template('page-contact-us.php')) {
    wp_enqueue_script('cim-ajax-forms', get_template_directory_uri() . '/assets/js/ajax-forms.js', array('jquery'), cim_VERSION, true);

    // Localize the script with ajax_url
    wp_localize_script('cim-ajax-forms', 'ajaxurl', admin_url('admin-ajax.php'));
  }

  // Enqueue careers page CSS and JS
  if (is_page_template('page-careers.php')) {
    wp_enqueue_style('cim-careers', get_template_directory_uri() . '/assets/css/careers.css', array(), cim_VERSION);
    wp_enqueue_script('cim-careers', get_template_directory_uri() . '/assets/js/careers.js', array('jquery'), cim_VERSION, true);
  }

  // Enqueue contact page CSS
  if (is_page_template('page-contact-us.php')) {
    wp_enqueue_style('cim-contact', get_template_directory_uri() . '/assets/css/contact.css', array(), cim_VERSION);
  }

  // Enqueue technologies page CSS
  if (is_page_template('page-technologies.php')) {
    wp_enqueue_style('cim-technologies', get_template_directory_uri() . '/assets/css/technologies.css', array(), cim_VERSION);
  }

  // Enqueue news page CSS and JS
  if (is_page_template('page-news.php')) {
    // News page styles are included inline in the template
    // The infinite scroll script is enqueued in the template file

    // Enqueue the news list loader script
    wp_enqueue_script('cim-news-list-loader', get_template_directory_uri() . '/assets/js/news-list-loader.js', array('jquery', 'cim-news-infinite-scroll'), cim_VERSION, true);
  }

  // Enqueue custom JavaScript
  wp_enqueue_script('cim-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), cim_VERSION, true);

  if (is_singular() && comments_open() && get_option('thread_comments')) {
    wp_enqueue_script('comment-reply');
  }
}
add_action('wp_enqueue_scripts', 'cim_scripts');

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Create directory structure if it doesn't exist
 */
function cim_create_directories()
{
  $directories = array(
    '/inc',
    '/js',
    '/images',
  );

  foreach ($directories as $directory) {
    $dir_path = get_template_directory() . $directory;
    if (!file_exists($dir_path)) {
      wp_mkdir_p($dir_path);
    }
  }
}
add_action('after_switch_theme', 'cim_create_directories');


/**
 * Register Carousel Post Type
 * 
 * @see inc/theme-settings.php for admin menu integration
 */
function cim_register_carousel_post_type()
{
  $labels = array(
    'name' => _x('Carousel Slides', 'post type general name', 'cim'),
    'singular_name' => _x('Carousel Slide', 'post type singular name', 'cim'),
    'menu_name' => _x('Carousel Slides', 'admin menu', 'cim'),
    'name_admin_bar' => _x('Carousel Slide', 'add new on admin bar', 'cim'),
    'add_new' => _x('Add New', 'carousel slide', 'cim'),
    'add_new_item' => __('Add New Carousel Slide', 'cim'),
    'new_item' => __('New Carousel Slide', 'cim'),
    'edit_item' => __('Edit Carousel Slide', 'cim'),
    'view_item' => __('View Carousel Slide', 'cim'),
    'all_items' => __('All Carousel Slides', 'cim'),
    'search_items' => __('Search Carousel Slides', 'cim'),
    'parent_item_colon' => __('Parent Carousel Slides:', 'cim'),
    'not_found' => __('No carousel slides found.', 'cim'),
    'not_found_in_trash' => __('No carousel slides found in Trash.', 'cim')
  );

  $args = array(
    'labels' => $labels,
    'description' => __('Carousel slides for the homepage', 'cim'),
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true,
    'show_in_menu' => false, // Hide from main menu, will be shown in CIM Theme Settings
    'query_var' => true,
    'rewrite' => array('slug' => 'carousel'),
    'capability_type' => 'post',
    'has_archive' => false,
    'hierarchical' => false,
    'menu_position' => null,
    'supports' => array('title', 'editor', 'thumbnail'),
    'menu_icon' => 'dashicons-images-alt2'
  );

  register_post_type('carousel', $args);
}
add_action('init', 'cim_register_carousel_post_type');

/**
 * Register Product Post Type
 */
function cim_register_product_post_type()
{
  $labels = array(
    'name' => _x('Products', 'post type general name', 'cim'),
    'singular_name' => _x('Product', 'post type singular name', 'cim'),
    'menu_name' => _x('Products', 'admin menu', 'cim'),
    'name_admin_bar' => _x('Product', 'add new on admin bar', 'cim'),
    'add_new' => _x('Add New', 'product', 'cim'),
    'add_new_item' => __('Add New Product', 'cim'),
    'new_item' => __('New Product', 'cim'),
    'edit_item' => __('Edit Product', 'cim'),
    'view_item' => __('View Product', 'cim'),
    'all_items' => __('All Products', 'cim'),
    'search_items' => __('Search Products', 'cim'),
    'parent_item_colon' => __('Parent Products:', 'cim'),
    'not_found' => __('No products found.', 'cim'),
    'not_found_in_trash' => __('No products found in Trash.', 'cim')
  );

  $args = array(
    'labels' => $labels,
    'description' => __('Products for the CIM website', 'cim'),
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true,
    'show_in_menu' => false, // Hide from main menu, will be shown in CIM Theme Settings
    'query_var' => true,
    'rewrite' => array('slug' => 'product'),
    'capability_type' => 'post',
    'has_archive' => true,
    'hierarchical' => false,
    'menu_position' => null,
    'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
    'menu_icon' => 'dashicons-products'
  );

  register_post_type('product', $args);

  // Register Product Category Taxonomy
  $category_labels = array(
    'name' => _x('Product Categories', 'taxonomy general name', 'cim'),
    'singular_name' => _x('Product Category', 'taxonomy singular name', 'cim'),
    'search_items' => __('Search Product Categories', 'cim'),
    'all_items' => __('All Product Categories', 'cim'),
    'parent_item' => __('Parent Product Category', 'cim'),
    'parent_item_colon' => __('Parent Product Category:', 'cim'),
    'edit_item' => __('Edit Product Category', 'cim'),
    'update_item' => __('Update Product Category', 'cim'),
    'add_new_item' => __('Add New Product Category', 'cim'),
    'new_item_name' => __('New Product Category Name', 'cim'),
    'menu_name' => __('Product Categories', 'cim'),
  );

  $category_args = array(
    'hierarchical' => true,
    'labels' => $category_labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'query_var' => true,
    'rewrite' => array('slug' => 'product-category'),
  );

  register_taxonomy('product_category', array('product'), $category_args);
}
add_action('init', 'cim_register_product_post_type');

/**
 * Register Blog Category
 */
function cim_register_blog_category()
{
  // Check if the category already exists
  if (!term_exists('blog', 'category')) {
    wp_insert_term(
      'Blog', // The term 
      'category', // The taxonomy
      array(
        'description' => 'Blog posts category',
        'slug' => 'blog',
      )
    );
  }
}
add_action('init', 'cim_register_blog_category');

/**
 * Register News Category
 */
function cim_register_news_category()
{
  // Check if the category already exists
  if (!term_exists('news', 'category')) {
    wp_insert_term(
      'News', // The term 
      'category', // The taxonomy
      array(
        'description' => 'News posts category',
        'slug' => 'news',
      )
    );
  }
}
add_action('init', 'cim_register_news_category');

/**
 * Customize REST API for News Infinite Scroll
 */
function cim_customize_rest_api()
{
  // Make sure featured media and author are embedded in REST API responses
  register_rest_field('post', 'featured_image_url', array(
    'get_callback' => 'cim_get_featured_image_url',
    'schema' => null,
  ));
}
add_action('rest_api_init', 'cim_customize_rest_api');

/**
 * Get featured image URL for REST API
 */
function cim_get_featured_image_url($post)
{
  if (has_post_thumbnail($post['id'])) {
    $image_id = get_post_thumbnail_id($post['id']);
    $image_url = wp_get_attachment_image_src($image_id, 'large');
    return $image_url[0];
  }
  return get_template_directory_uri() . '/assets/images/placeholder-news.jpg';
}

/**
 * Add Product Meta Boxes
 */
function cim_add_product_meta_boxes()
{
  // Product Short Name
  add_meta_box(
    'cim_product_short_name',
    __('Product Short Name', 'cim'),
    'cim_product_short_name_callback',
    'product',
    'normal',
    'high'
  );

  // Product Gallery
  add_meta_box(
    'cim_product_gallery',
    __('Product Gallery', 'cim'),
    'cim_product_gallery_callback',
    'product',
    'normal',
    'high'
  );

  // Product Video
  add_meta_box(
    'cim_product_video',
    __('Product Video', 'cim'),
    'cim_product_video_callback',
    'product',
    'normal',
    'high'
  );
}
add_action('add_meta_boxes', 'cim_add_product_meta_boxes');

/**
 * Product Short Name Meta Box Callback
 */
function cim_product_short_name_callback($post)
{
  // Add nonce for security
  wp_nonce_field('cim_product_short_name_nonce', 'cim_product_short_name_nonce');

  // Get the short name if it exists
  $short_name = get_post_meta($post->ID, '_product_short_name', true);

  // Output the field
  echo '<label for="product-short-name">' . __('Short Name', 'cim') . '</label>';
  echo '<input type="text" id="product-short-name" name="product_short_name" value="' . esc_attr($short_name) . '" style="width:100%">';
  echo '<p class="description">' . __('Enter a short name for this product.', 'cim') . '</p>';
}

/**
 * Product Gallery Meta Box Callback
 */
function cim_product_gallery_callback($post)
{
  // Add nonce for security
  wp_nonce_field('cim_product_gallery_nonce', 'cim_product_gallery_nonce');

  // Get the gallery images if they exist
  $gallery_images = get_post_meta($post->ID, '_product_gallery', true);

  // Output the field
  echo '<div id="product-gallery-container">';
  echo '<input type="hidden" id="product-gallery" name="product_gallery" value="' . esc_attr($gallery_images) . '">';
  echo '<div id="product-gallery-preview" class="gallery-preview">';

  if (!empty($gallery_images)) {
    $gallery_array = explode(',', $gallery_images);
    foreach ($gallery_array as $image_id) {
      $image_url = wp_get_attachment_image_url($image_id, 'thumbnail');
      if ($image_url) {
        echo '<div class="gallery-image-preview" data-id="' . esc_attr($image_id) . '">';
        echo '<img src="' . esc_url($image_url) . '" alt="">';
        echo '<button type="button" class="remove-gallery-image">×</button>';
        echo '</div>';
      }
    }
  }

  echo '</div>';
  echo '<button type="button" class="button" id="add-gallery-images">' . __('Add Gallery Images', 'cim') . '</button>';
  echo '</div>';

  // Add JavaScript for gallery functionality
  ?>
  <script type="text/javascript">
    jQuery(document).ready(function ($) {
      var mediaUploader;

      $('#add-gallery-images').on('click', function (e) {
        e.preventDefault();

        if (mediaUploader) {
          mediaUploader.open();
          return;
        }

        mediaUploader = wp.media({
          title: '<?php _e("Choose Gallery Images", "cim"); ?>',
          button: {
            text: '<?php _e("Add to Gallery", "cim"); ?>'
          },
          multiple: true
        });

        mediaUploader.on('select', function () {
          var attachments = mediaUploader.state().get('selection').toJSON();
          var galleryIds = $('#product-gallery').val();
          var idsArray = galleryIds ? galleryIds.split(',') : [];

          attachments.forEach(function (attachment) {
            if (idsArray.indexOf(attachment.id.toString()) === -1) {
              idsArray.push(attachment.id);

              $('#product-gallery-preview').append(
                '<div class="gallery-image-preview" data-id="' + attachment.id + '">' +
                '<img src="' + attachment.sizes.thumbnail.url + '" alt="">' +
                '<button type="button" class="remove-gallery-image">×</button>' +
                '</div>'
              );
            }
          });

          $('#product-gallery').val(idsArray.join(','));
        });

        mediaUploader.open();
      });

      // Remove gallery image
      $('#product-gallery-preview').on('click', '.remove-gallery-image', function () {
        var container = $(this).parent('.gallery-image-preview');
        var imageId = container.data('id');
        var galleryIds = $('#product-gallery').val().split(',');

        galleryIds = galleryIds.filter(function (id) {
          return id != imageId;
        });

        $('#product-gallery').val(galleryIds.join(','));
        container.remove();
      });
    });
  </script>
  <style type="text/css">
    .gallery-preview {
      display: flex;
      flex-wrap: wrap;
      margin-bottom: 10px;
    }

    .gallery-image-preview {
      position: relative;
      margin: 5px;
      width: 100px;
      height: 100px;
    }

    .gallery-image-preview img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .remove-gallery-image {
      position: absolute;
      top: 0;
      right: 0;
      background: rgba(0, 0, 0, 0.7);
      color: #fff;
      border: none;
      border-radius: 50%;
      width: 20px;
      height: 20px;
      font-size: 14px;
      line-height: 1;
      cursor: pointer;
    }
  </style>
  <?php
}

/**
 * Product Video Meta Box Callback
 */
function cim_product_video_callback($post)
{
  // Add nonce for security
  wp_nonce_field('cim_product_video_nonce', 'cim_product_video_nonce');

  // Get the video URL if it exists
  $video_url = get_post_meta($post->ID, '_product_video', true);

  // Output the field
  echo '<label for="product-video">' . __('Video URL', 'cim') . '</label>';
  echo '<input type="url" id="product-video" name="product_video" value="' . esc_url($video_url) . '" style="width:100%" placeholder="https://www.youtube.com/watch?v=...">';
  echo '<p class="description">' . __('Enter a YouTube or Vimeo URL for the product introduction video.', 'cim') . '</p>';
}

/**
 * Save Product Meta Data
 */
function cim_save_product_meta($post_id)
{
  // Save Short Name
  if (isset($_POST['cim_product_short_name_nonce']) && wp_verify_nonce($_POST['cim_product_short_name_nonce'], 'cim_product_short_name_nonce')) {
    if (isset($_POST['product_short_name'])) {
      update_post_meta($post_id, '_product_short_name', sanitize_text_field($_POST['product_short_name']));
    }
  }

  // Save Gallery
  if (isset($_POST['cim_product_gallery_nonce']) && wp_verify_nonce($_POST['cim_product_gallery_nonce'], 'cim_product_gallery_nonce')) {
    if (isset($_POST['product_gallery'])) {
      update_post_meta($post_id, '_product_gallery', sanitize_text_field($_POST['product_gallery']));
    }
  }

  // Save Video
  if (isset($_POST['cim_product_video_nonce']) && wp_verify_nonce($_POST['cim_product_video_nonce'], 'cim_product_video_nonce')) {
    if (isset($_POST['product_video'])) {
      update_post_meta($post_id, '_product_video', esc_url_raw($_POST['product_video']));
    }
  }
}
add_action('save_post_product', 'cim_save_product_meta');

/**
 * Add Carousel Redirect URL Meta Box
 */
function cim_add_carousel_meta_boxes()
{
  add_meta_box(
    'cim_carousel_redirect',
    __('Redirect Link', 'cim'),
    'cim_carousel_redirect_callback',
    'carousel',
    'normal',
    'default'
  );
}
add_action('add_meta_boxes', 'cim_add_carousel_meta_boxes');

/**
 * Add Default Carousel Link to Customizer
 */
function cim_customize_carousel_settings($wp_customize)
{
  // Add section if it doesn't exist
  if (!$wp_customize->get_section('cim_carousel_settings')) {
    $wp_customize->add_section('cim_carousel_settings', array(
      'title' => __('Carousel Settings', 'cim'),
      'priority' => 30,
    ));
  }

  // Add default carousel link setting
  $wp_customize->add_setting('cim_default_carousel_link', array(
    'default' => '#',
    'sanitize_callback' => 'esc_url_raw',
  ));

  // Add default carousel link control
  $wp_customize->add_control('cim_default_carousel_link', array(
    'label' => __('Default Carousel Link', 'cim'),
    'description' => __('Enter a URL for the default carousel slide link', 'cim'),
    'section' => 'cim_carousel_settings',
    'type' => 'url',
  ));
}
add_action('customize_register', 'cim_customize_carousel_settings');

/**
 * Carousel Redirect Meta Box Callback
 */
function cim_carousel_redirect_callback($post)
{
  // Add nonce for security
  wp_nonce_field('cim_carousel_redirect_nonce', 'cim_carousel_redirect_nonce');

  // Get the redirect URL if it exists
  $redirect_url = get_post_meta($post->ID, '_carousel_redirect_url', true);

  // Output the field
  echo '<label for="carousel-redirect-url">' . __('Redirect URL', 'cim') . '</label>';
  echo '<input type="url" id="carousel-redirect-url" name="carousel_redirect_url" value="' . esc_url($redirect_url) . '" style="width:100%" placeholder="' . __('https://example.com', 'cim') . '">';
  echo '<p class="description">' . __('Enter a URL to redirect to when this carousel slide is clicked. Leave empty for no redirection.', 'cim') . '</p>';
}

/**
 * Save Carousel Redirect URL
 */
function cim_save_carousel_redirect($post_id)
{
  // Check if nonce is set
  if (!isset($_POST['cim_carousel_redirect_nonce'])) {
    return;
  }

  // Verify nonce
  if (!wp_verify_nonce($_POST['cim_carousel_redirect_nonce'], 'cim_carousel_redirect_nonce')) {
    return;
  }

  // If this is an autosave, don't do anything
  if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
    return;
  }

  // Check user permissions
  if (!current_user_can('edit_post', $post_id)) {
    return;
  }

  // Save the redirect URL
  if (isset($_POST['carousel_redirect_url'])) {
    $redirect_url = esc_url_raw($_POST['carousel_redirect_url']);
    update_post_meta($post_id, '_carousel_redirect_url', $redirect_url);
  }
}
add_action('save_post_carousel', 'cim_save_carousel_redirect');

// Include category thumbnail functions
require get_template_directory() . '/inc/category-thumbnail.php';

/**
 * Add Theme Customizer Settings
 */
function cim_customize_register($wp_customize)
{
  // About Us Section Settings
  $wp_customize->add_section('cim_about_section', array(
    'title' => __('About Us Section', 'cim'),
    'priority' => 30,
  ));

  // About Us Image (Left side - Person)
  $wp_customize->add_setting('cim_about_image', array(
    'default' => get_template_directory_uri() . '/assets/images/CIM-Brochure-2022-Latest-Cover.webp',
    'sanitize_callback' => 'esc_url_raw',
  ));

  $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'cim_about_image', array(
    'label' => __('About Us Person Image (Left Side)', 'cim'),
    'section' => 'cim_about_section',
    'settings' => 'cim_about_image',
  )));

  // About Us Background Image (Right side)
  $wp_customize->add_setting('cim_about_bg_image', array(
    'default' => get_template_directory_uri() . '/assets/images/BG-DARK.webp',
    'sanitize_callback' => 'esc_url_raw',
  ));

  $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'cim_about_bg_image', array(
    'label' => __('About Us Background Image (Right Side)', 'cim'),
    'section' => 'cim_about_section',
    'settings' => 'cim_about_bg_image',
  )));

  // About Us Title
  $wp_customize->add_setting('cim_about_title', array(
    'default' => __('ABOUT US', 'cim'),
    'sanitize_callback' => 'sanitize_text_field',
  ));

  $wp_customize->add_control('cim_about_title', array(
    'label' => __('About Us Title', 'cim'),
    'section' => 'cim_about_section',
    'type' => 'text',
  ));

  // About Us Text
  $wp_customize->add_setting('cim_about_text', array(
    'default' => __('cim is a global leader in wear solutions for cim applications. We specialize in creating innovative materials designed to withstand extreme conditions in mining, energy, and manufacturing sectors. Our proprietary technologies and extensive experience allow us to deliver exceptional wear resistance and longevity.', 'cim'),
    'sanitize_callback' => 'wp_kses_post',
  ));

  $wp_customize->add_control('cim_about_text', array(
    'label' => __('About Us Text', 'cim'),
    'section' => 'cim_about_section',
    'type' => 'textarea',
  ));

  // About Us Button Text
  $wp_customize->add_setting('cim_about_button_text', array(
    'default' => __('READ MORE', 'cim'),
    'sanitize_callback' => 'sanitize_text_field',
  ));

  $wp_customize->add_control('cim_about_button_text', array(
    'label' => __('Button Text', 'cim'),
    'section' => 'cim_about_section',
    'type' => 'text',
  ));

  // About Us Button URL
  $wp_customize->add_setting('cim_about_button_url', array(
    'default' => '#',
    'sanitize_callback' => 'esc_url_raw',
  ));

  $wp_customize->add_control('cim_about_button_url', array(
    'label' => __('Button URL', 'cim'),
    'section' => 'cim_about_section',
    'type' => 'url',
  ));

  // Contact Info Section Settings
  $wp_customize->add_section('cim_contact_section', array(
    'title' => __('Contact Information', 'cim'),
    'priority' => 40,
  ));

  // Contact Address
  $wp_customize->add_setting('cim_contact_address', array(
    'default' => __('123 cim Avenue, Manufacturing District, City, Country', 'cim'),
    'sanitize_callback' => 'sanitize_text_field',
  ));

  $wp_customize->add_control('cim_contact_address', array(
    'label' => __('Address', 'cim'),
    'section' => 'cim_contact_section',
    'type' => 'textarea',
  ));

  // Contact Phone
  $wp_customize->add_setting('cim_contact_phone', array(
    'default' => __('+1 234 567 8900', 'cim'),
    'sanitize_callback' => 'sanitize_text_field',
  ));

  $wp_customize->add_control('cim_contact_phone', array(
    'label' => __('Phone Number', 'cim'),
    'section' => 'cim_contact_section',
    'type' => 'text',
  ));

  // Contact Email
  $wp_customize->add_setting('cim_contact_email', array(
    'default' => __('info@cim-theme.com', 'cim'),
    'sanitize_callback' => 'sanitize_email',
  ));

  $wp_customize->add_control('cim_contact_email', array(
    'label' => __('Email Address', 'cim'),
    'section' => 'cim_contact_section',
    'type' => 'email',
  ));

  // Social Media Section
  $wp_customize->add_section('cim_social_section', array(
    'title' => __('Social Media Links', 'cim'),
    'priority' => 50,
  ));

  // Facebook URL
  $wp_customize->add_setting('cim_facebook_url', array(
    'default' => '#',
    'sanitize_callback' => 'esc_url_raw',
  ));

  $wp_customize->add_control('cim_facebook_url', array(
    'label' => __('Facebook URL', 'cim'),
    'section' => 'cim_social_section',
    'type' => 'url',
  ));

  // Twitter URL
  $wp_customize->add_setting('cim_twitter_url', array(
    'default' => '#',
    'sanitize_callback' => 'esc_url_raw',
  ));

  $wp_customize->add_control('cim_twitter_url', array(
    'label' => __('Twitter URL', 'cim'),
    'section' => 'cim_social_section',
    'type' => 'url',
  ));

  // Instagram URL
  $wp_customize->add_setting('cim_instagram_url', array(
    'default' => '#',
    'sanitize_callback' => 'esc_url_raw',
  ));

  $wp_customize->add_control('cim_instagram_url', array(
    'label' => __('Instagram URL', 'cim'),
    'section' => 'cim_social_section',
    'type' => 'url',
  ));

  // LinkedIn URL
  $wp_customize->add_setting('cim_linkedin_url', array(
    'default' => '#',
    'sanitize_callback' => 'esc_url_raw',
  ));

  $wp_customize->add_control('cim_linkedin_url', array(
    'label' => __('LinkedIn URL', 'cim'),
    'section' => 'cim_social_section',
    'type' => 'url',
  ));

  // YouTube URL
  $wp_customize->add_setting('cim_youtube_url', array(
    'default' => '#',
    'sanitize_callback' => 'esc_url_raw',
  ));

  $wp_customize->add_control('cim_youtube_url', array(
    'label' => __('YouTube URL', 'cim'),
    'section' => 'cim_social_section',
    'type' => 'url',
  ));
}
add_action('customize_register', 'cim_customize_register');

// Career Application post type removed - using only Career Submission post type

/**
 * Handle careers application form submission
 */
function cim_process_careers_application()
{
  if (isset($_POST['action']) && $_POST['action'] == 'cim_career_form') {
    if (check_admin_referer('careers_application_nonce', 'careers_nonce')) {
      // Get form data
      $name = sanitize_text_field($_POST['applicant-name']);
      $position = sanitize_text_field($_POST['position-applied']);
      $email = sanitize_email($_POST['applicant-email']);
      $phone = sanitize_text_field($_POST['applicant-phone']);

      // Create post object for the application
      $application = array(
        'post_title' => 'Application from ' . $name . ' for ' . $position,
        'post_content' => 'Name: ' . $name . '\n' .
          'Position: ' . $position . '\n' .
          'Email: ' . $email . '\n' .
          'Phone: ' . $phone,
        'post_status' => 'private',
        'post_type' => 'career_application',
        'post_author' => 1,
      );

      // Insert the application into the database
      $application_id = wp_insert_post($application);

      if ($application_id) {
        // Add custom fields
        update_post_meta($application_id, '_applicant_name', $name);
        update_post_meta($application_id, '_applicant_position', $position);
        update_post_meta($application_id, '_applicant_email', $email);
        update_post_meta($application_id, '_applicant_phone', $phone);

        // Send email notification
        $to = get_option('admin_email');
        $subject = 'New Career Application from ' . $name;
        $message = "Name: $name\n";
        $message .= "Position: $position\n";
        $message .= "Email: $email\n";
        $message .= "Phone: $phone\n";

        wp_mail($to, $subject, $message);

        // Redirect to thank you page or show message
        wp_redirect(add_query_arg('application', 'success', get_permalink()));
        exit;
      }
    }
  }
}
add_action('template_redirect', 'cim_process_careers_application');

/**
 * Filters the document title before it is generated.
 * Allows setting specific titles for certain pages.
 *
 * @param string $title The original title (usually empty at this stage).
 * @return string The potentially modified title.
 */
function my_custom_page_titles( $title ) {
  // 检查是否为 "about" 页面 (使用页面别名/slug)
  // 假设你的 "About" 页面的 slug 是 'about'
  if ( is_page( 'about' ) ) {
      return '这是我们的“关于我们”页面的自定义标题'; // 设置你想要的精确标题
  }

  // 检查是否为 "news" 页面 (使用页面别名/slug)
  // 假设你的 "News" 页面的 slug 是 'news'
  if ( is_page( 'news' ) ) {
      return '查看最新消息 - 这是自定义的新闻标题'; // 设置你想要的精确标题
  }

  // 对于所有其他页面，返回原始值，让 WordPress 或其他插件正常处理
  return $title;
}
add_filter( 'pre_get_document_title', 'my_custom_page_titles' );

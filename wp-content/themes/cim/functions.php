<?php
/**
 * Industrial Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Industrial
 */

if ( ! defined( 'INDUSTRIAL_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( 'INDUSTRIAL_VERSION', '1.0.0' );
}

// Include custom menu walker
require get_template_directory() . '/inc/class-cim-menu-walker.php';

/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function industrial_setup() {
	/*
	 * Make theme available for translation.
	 */
	load_theme_textdomain( 'industrial', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'primary' => esc_html__( 'Primary Menu', 'industrial' ),
			'footer' => esc_html__( 'Footer Menu', 'industrial' ),
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
			'industrial_custom_background_args',
			array(
				'default-color' => '121212',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'industrial_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function industrial_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'industrial_content_width', 1200 );
}
add_action( 'after_setup_theme', 'industrial_content_width', 0 );

/**
 * Register widget area.
 */
function industrial_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'industrial' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'industrial' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer 1', 'industrial' ),
			'id'            => 'footer-1',
			'description'   => esc_html__( 'Add footer widgets here.', 'industrial' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="footer-title">',
			'after_title'   => '</h3>',
		)
	);
	
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer 2', 'industrial' ),
			'id'            => 'footer-2',
			'description'   => esc_html__( 'Add footer widgets here.', 'industrial' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="footer-title">',
			'after_title'   => '</h3>',
		)
	);
	
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer 3', 'industrial' ),
			'id'            => 'footer-3',
			'description'   => esc_html__( 'Add footer widgets here.', 'industrial' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="footer-title">',
			'after_title'   => '</h3>',
		)
	);
}
add_action( 'widgets_init', 'industrial_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function industrial_scripts() {
	// Enqueue main stylesheet
	wp_enqueue_style( 'industrial-style', get_stylesheet_uri(), array(), INDUSTRIAL_VERSION );
	
	// Enqueue Font Awesome for icons
	wp_enqueue_style( 'industrial-fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css', array(), '5.15.4' );
	
	// Enqueue Slick Slider
	wp_enqueue_style( 'slick', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css', array(), '1.8.1' );
	wp_enqueue_style( 'slick-theme', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css', array(), '1.8.1' );
	wp_enqueue_script( 'slick', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', array('jquery'), '1.8.1', true );
	
	// Enqueue custom CSS
	wp_enqueue_style( 'industrial-menu-page', get_template_directory_uri() . '/assets/css/menu-page.css', array(), INDUSTRIAL_VERSION );
	
	// Enqueue careers page CSS and JS
	if (is_page_template('page-careers.php')) {
		wp_enqueue_style( 'industrial-careers', get_template_directory_uri() . '/assets/css/careers.css', array(), INDUSTRIAL_VERSION );
		wp_enqueue_script( 'industrial-careers', get_template_directory_uri() . '/assets/js/careers.js', array('jquery'), INDUSTRIAL_VERSION, true );
	}
	
	// Enqueue contact page CSS
	if (is_page_template('page-contact.php')) {
		wp_enqueue_style( 'industrial-contact', get_template_directory_uri() . '/assets/css/contact.css', array(), INDUSTRIAL_VERSION );
	}
	
	// Enqueue custom JavaScript
	wp_enqueue_script( 'industrial-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), INDUSTRIAL_VERSION, true );
	
	// Enqueue custom slider script
	wp_enqueue_script( 'industrial-slider', get_template_directory_uri() . '/assets/js/slider.js', array('jquery', 'slick'), INDUSTRIAL_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'industrial_scripts' );

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
function industrial_create_directories() {
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
add_action('after_switch_theme', 'industrial_create_directories');

/**
 * Add custom CSS for dropdown menu
 */
function cim_custom_styles() {
    ?>
    <style type="text/css">
        /* Header Menu Styles */
        .main-navigation ul ul {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            z-index: 99999;
            background-color: #1a1a1a;
            min-width: 200px;
            box-shadow: 0 3px 5px rgba(0, 0, 0, 0.2);
            padding: 10px 0;
        }
        
        .main-navigation ul li:hover > ul {
            display: block;
        }
        
        .main-navigation ul ul li {
            margin: 0;
            width: 100%;
        }
        
        .main-navigation ul ul a {
            padding: 10px 20px;
            width: 100%;
            font-size: 0.85rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .main-navigation ul ul li:last-child a {
            border-bottom: none;
        }
        
        .main-navigation ul ul a:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }
        
        /* Carousel Styles */
        .cim-carousel {
            position: relative;
            margin-top: 90px;
        }
        
        .carousel-item {
            position: relative;
            height: 600px;
            background-size: cover;
            background-position: center;
        }
        
        .carousel-item:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
        }
        
        .carousel-content {
            position: absolute;
            bottom: 100px;
            left: 100px;
            max-width: 600px;
            color: #fff;
            z-index: 2;
        }
        
        .carousel-title {
            font-size: 3rem;
            margin-bottom: 1rem;
            color: #ffc107;
            text-transform: uppercase;
        }
        
        .carousel-description {
            font-size: 1.2rem;
            margin-bottom: 2rem;
        }
        
        /* Product Category Styles */
        .product-category {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .category-thumbnail {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            overflow: hidden;
            margin: 0 auto 15px;
            border: 3px solid #ffc107;
        }
        
        .category-thumbnail img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .category-title {
            font-size: 1.2rem;
            margin: 0;
            color: #fff;
        }
    </style>
    <?php
}
add_action('wp_head', 'cim_custom_styles');

/**
 * Register Carousel Post Type
 */
function cim_register_carousel_post_type() {
    $labels = array(
        'name'               => _x( 'Carousel Slides', 'post type general name', 'industrial' ),
        'singular_name'      => _x( 'Carousel Slide', 'post type singular name', 'industrial' ),
        'menu_name'          => _x( 'Carousel Slides', 'admin menu', 'industrial' ),
        'name_admin_bar'     => _x( 'Carousel Slide', 'add new on admin bar', 'industrial' ),
        'add_new'            => _x( 'Add New', 'carousel slide', 'industrial' ),
        'add_new_item'       => __( 'Add New Carousel Slide', 'industrial' ),
        'new_item'           => __( 'New Carousel Slide', 'industrial' ),
        'edit_item'          => __( 'Edit Carousel Slide', 'industrial' ),
        'view_item'          => __( 'View Carousel Slide', 'industrial' ),
        'all_items'          => __( 'All Carousel Slides', 'industrial' ),
        'search_items'       => __( 'Search Carousel Slides', 'industrial' ),
        'parent_item_colon'  => __( 'Parent Carousel Slides:', 'industrial' ),
        'not_found'          => __( 'No carousel slides found.', 'industrial' ),
        'not_found_in_trash' => __( 'No carousel slides found in Trash.', 'industrial' )
    );

    $args = array(
        'labels'             => $labels,
        'description'        => __( 'Carousel slides for the homepage', 'industrial' ),
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'carousel' ),
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array( 'title', 'editor', 'thumbnail' ),
        'menu_icon'          => 'dashicons-images-alt2'
    );

    register_post_type( 'carousel', $args );
}
add_action( 'init', 'cim_register_carousel_post_type' );

/**
 * Add Category Thumbnail Field
 */
function cim_add_category_thumbnail_field() {
    ?>
    <div class="form-field term-thumbnail-wrap">
        <label for="category-thumbnail"><?php _e( 'Category Thumbnail', 'industrial' ); ?></label>
        <input type="hidden" id="category-thumbnail-id" name="category-thumbnail-id" value="">
        <div id="category-thumbnail-preview"></div>
        <p>
            <input type="button" class="button button-secondary" id="upload-category-thumbnail" value="<?php _e( 'Upload Thumbnail', 'industrial' ); ?>">
            <input type="button" class="button button-secondary" id="remove-category-thumbnail" value="<?php _e( 'Remove Thumbnail', 'industrial' ); ?>" style="display:none;">
        </p>
        <p class="description"><?php _e( 'Upload a thumbnail for this category', 'industrial' ); ?></p>
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
                    title: '<?php _e( 'Choose Category Thumbnail', 'industrial' ); ?>',
                    button: {
                        text: '<?php _e( 'Set Thumbnail', 'industrial' ); ?>'
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
 * Edit Category Thumbnail Field
 */
function cim_edit_category_thumbnail_field( $term ) {
    $thumbnail_id = get_term_meta( $term->term_id, 'category_thumbnail_id', true );
    $thumbnail_url = '';
    
    if ( $thumbnail_id ) {
        $thumbnail_url = wp_get_attachment_url( $thumbnail_id );
    }
    ?>
    <tr class="form-field term-thumbnail-wrap">
        <th scope="row"><label for="category-thumbnail"><?php _e( 'Category Thumbnail', 'industrial' ); ?></label></th>
        <td>
            <input type="hidden" id="category-thumbnail-id" name="category-thumbnail-id" value="<?php echo esc_attr( $thumbnail_id ); ?>">
            <div id="category-thumbnail-preview">
                <?php if ( $thumbnail_url ) : ?>
                    <img src="<?php echo esc_url( $thumbnail_url ); ?>" style="max-width:200px;height:auto;margin-bottom:10px;" />
                <?php endif; ?>
            </div>
            <p>
                <input type="button" class="button button-secondary" id="upload-category-thumbnail" value="<?php _e( 'Upload Thumbnail', 'industrial' ); ?>">
                <input type="button" class="button button-secondary" id="remove-category-thumbnail" value="<?php _e( 'Remove Thumbnail', 'industrial' ); ?>" <?php echo $thumbnail_id ? '' : 'style="display:none;"'; ?>>
            </p>
            <p class="description"><?php _e( 'Upload a thumbnail for this category', 'industrial' ); ?></p>
            
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
                            title: '<?php _e( 'Choose Category Thumbnail', 'industrial' ); ?>',
                            button: {
                                text: '<?php _e( 'Set Thumbnail', 'industrial' ); ?>'
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

/**
 * Add Theme Customizer Settings
 */
function cim_customize_register( $wp_customize ) {
    // About Us Section Settings
    $wp_customize->add_section( 'cim_about_section', array(
        'title'    => __( 'About Us Section', 'industrial' ),
        'priority' => 30,
    ) );
    
    // About Us Image
    $wp_customize->add_setting( 'industrial_about_image', array(
        'default'           => get_template_directory_uri() . '/images/about-image.jpg',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'industrial_about_image', array(
        'label'    => __( 'About Us Image', 'industrial' ),
        'section'  => 'cim_about_section',
        'settings' => 'industrial_about_image',
    ) ) );
    
    // About Us Title
    $wp_customize->add_setting( 'industrial_about_title', array(
        'default'           => __( 'ABOUT US', 'industrial' ),
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    
    $wp_customize->add_control( 'industrial_about_title', array(
        'label'    => __( 'About Us Title', 'industrial' ),
        'section'  => 'cim_about_section',
        'type'     => 'text',
    ) );
    
    // About Us Text
    $wp_customize->add_setting( 'industrial_about_text', array(
        'default'           => __( 'Industrial is a global leader in wear solutions for industrial applications. We specialize in creating innovative materials designed to withstand extreme conditions in mining, energy, and manufacturing sectors. Our proprietary technologies and extensive experience allow us to deliver exceptional wear resistance and longevity.', 'industrial' ),
        'sanitize_callback' => 'wp_kses_post',
    ) );
    
    $wp_customize->add_control( 'industrial_about_text', array(
        'label'    => __( 'About Us Text', 'industrial' ),
        'section'  => 'cim_about_section',
        'type'     => 'textarea',
    ) );
    
    // About Us Button Text
    $wp_customize->add_setting( 'industrial_about_button_text', array(
        'default'           => __( 'READ MORE', 'industrial' ),
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    
    $wp_customize->add_control( 'industrial_about_button_text', array(
        'label'    => __( 'Button Text', 'industrial' ),
        'section'  => 'cim_about_section',
        'type'     => 'text',
    ) );
    
    // About Us Button URL
    $wp_customize->add_setting( 'industrial_about_button_url', array(
        'default'           => '#',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    
    $wp_customize->add_control( 'industrial_about_button_url', array(
        'label'    => __( 'Button URL', 'industrial' ),
        'section'  => 'cim_about_section',
        'type'     => 'url',
    ) );
    
    // Contact Info Section Settings
    $wp_customize->add_section( 'cim_contact_section', array(
        'title'    => __( 'Contact Information', 'industrial' ),
        'priority' => 40,
    ) );
    
    // Contact Address
    $wp_customize->add_setting( 'industrial_contact_address', array(
        'default'           => __( '123 Industrial Avenue, Manufacturing District, City, Country', 'industrial' ),
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    
    $wp_customize->add_control( 'industrial_contact_address', array(
        'label'    => __( 'Address', 'industrial' ),
        'section'  => 'cim_contact_section',
        'type'     => 'textarea',
    ) );
    
    // Contact Phone
    $wp_customize->add_setting( 'industrial_contact_phone', array(
        'default'           => __( '+1 234 567 8900', 'industrial' ),
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    
    $wp_customize->add_control( 'industrial_contact_phone', array(
        'label'    => __( 'Phone Number', 'industrial' ),
        'section'  => 'cim_contact_section',
        'type'     => 'text',
    ) );
    
    // Contact Email
    $wp_customize->add_setting( 'industrial_contact_email', array(
        'default'           => __( 'info@industrial-theme.com', 'industrial' ),
        'sanitize_callback' => 'sanitize_email',
    ) );
    
    $wp_customize->add_control( 'industrial_contact_email', array(
        'label'    => __( 'Email Address', 'industrial' ),
        'section'  => 'cim_contact_section',
        'type'     => 'email',
    ) );
    
    // Social Media Section
    $wp_customize->add_section( 'cim_social_section', array(
        'title'    => __( 'Social Media Links', 'industrial' ),
        'priority' => 50,
    ) );
    
    // Facebook URL
    $wp_customize->add_setting( 'industrial_facebook_url', array(
        'default'           => '#',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    
    $wp_customize->add_control( 'industrial_facebook_url', array(
        'label'    => __( 'Facebook URL', 'industrial' ),
        'section'  => 'cim_social_section',
        'type'     => 'url',
    ) );
    
    // Twitter URL
    $wp_customize->add_setting( 'industrial_twitter_url', array(
        'default'           => '#',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    
    $wp_customize->add_control( 'industrial_twitter_url', array(
        'label'    => __( 'Twitter URL', 'industrial' ),
        'section'  => 'cim_social_section',
        'type'     => 'url',
    ) );
    
    // LinkedIn URL
    $wp_customize->add_setting( 'industrial_linkedin_url', array(
        'default'           => '#',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    
    $wp_customize->add_control( 'industrial_linkedin_url', array(
        'label'    => __( 'LinkedIn URL', 'industrial' ),
        'section'  => 'cim_social_section',
        'type'     => 'url',
    ) );
    
    // YouTube URL
    $wp_customize->add_setting( 'industrial_youtube_url', array(
        'default'           => '#',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    
    $wp_customize->add_control( 'industrial_youtube_url', array(
        'label'    => __( 'YouTube URL', 'industrial' ),
        'section'  => 'cim_social_section',
        'type'     => 'url',
    ) );
}
add_action( 'customize_register', 'cim_customize_register' );

/**
 * Register Career Application custom post type
 */
function cim_register_career_application_post_type() {
    $labels = array(
        'name'               => _x( 'Career Applications', 'post type general name', 'industrial' ),
        'singular_name'      => _x( 'Career Application', 'post type singular name', 'industrial' ),
        'menu_name'          => _x( 'Career Applications', 'admin menu', 'industrial' ),
        'name_admin_bar'     => _x( 'Career Application', 'add new on admin bar', 'industrial' ),
        'add_new'            => _x( 'Add New', 'career application', 'industrial' ),
        'add_new_item'       => __( 'Add New Career Application', 'industrial' ),
        'new_item'           => __( 'New Career Application', 'industrial' ),
        'edit_item'          => __( 'Edit Career Application', 'industrial' ),
        'view_item'          => __( 'View Career Application', 'industrial' ),
        'all_items'          => __( 'All Career Applications', 'industrial' ),
        'search_items'       => __( 'Search Career Applications', 'industrial' ),
        'parent_item_colon'  => __( 'Parent Career Applications:', 'industrial' ),
        'not_found'          => __( 'No career applications found.', 'industrial' ),
        'not_found_in_trash' => __( 'No career applications found in Trash.', 'industrial' )
    );

    $args = array(
        'labels'             => $labels,
        'description'        => __( 'Career applications submitted through the website', 'industrial' ),
        'public'             => false,
        'publicly_queryable' => false,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'career-application' ),
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array( 'title', 'editor' ),
        'menu_icon'          => 'dashicons-id'
    );

    register_post_type( 'career_application', $args );
}
add_action( 'init', 'cim_register_career_application_post_type' );

/**
 * Handle careers application form submission
 */
function cim_process_careers_application() {
    if (isset($_POST['action']) && $_POST['action'] == 'submit_careers_application') {
        if (check_admin_referer('careers_application_nonce', 'careers_nonce')) {
            // Get form data
            $name = sanitize_text_field($_POST['applicant-name']);
            $position = sanitize_text_field($_POST['position-applied']);
            $email = sanitize_email($_POST['applicant-email']);
            $phone = sanitize_text_field($_POST['applicant-phone']);
            
            // Create post object for the application
            $application = array(
                'post_title'    => 'Application from ' . $name . ' for ' . $position,
                'post_content'  => 'Name: ' . $name . '\n' .
                                  'Position: ' . $position . '\n' .
                                  'Email: ' . $email . '\n' .
                                  'Phone: ' . $phone,
                'post_status'   => 'private',
                'post_type'     => 'career_application',
                'post_author'   => 1,
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
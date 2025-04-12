<?php
/**
 * The template for displaying the front page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Industrial
 */

get_header();
?>

<main id="primary" class="site-main">

    <!-- Carousel Section -->
    <section class="cim-carousel-section">
        <div class="cim-carousel">
            <?php
            // Get carousel slides
            $carousel_args = array(
                'post_type' => 'carousel',
                'posts_per_page' => -1,
                'orderby' => 'menu_order',
                'order' => 'ASC',
            );
            
            $carousel_query = new WP_Query( $carousel_args );
            
            if ( $carousel_query->have_posts() ) :
                while ( $carousel_query->have_posts() ) : $carousel_query->the_post();
                    $slide_image = get_the_post_thumbnail_url( get_the_ID(), 'full' );
                    if ( !$slide_image ) {
                        $slide_image = get_template_directory_uri() . '/images/hero-bg.jpg';
                    }
            ?>
                <div class="carousel-item" style="background-image: url('<?php echo esc_url( $slide_image ); ?>')">
                    <div class="carousel-content">
                        <h2 class="carousel-title"><?php the_title(); ?></h2>
                        <div class="carousel-description"><?php the_content(); ?></div>
                    </div>
                </div>
            <?php
                endwhile;
                wp_reset_postdata();
            else :
            ?>
                <!-- Fallback if no carousel slides -->
                <div class="carousel-item" style="background-image: url('<?php echo esc_url( get_template_directory_uri() . '/images/hero-bg.jpg' ); ?>')">
                    <div class="carousel-content">
                        <h2 class="carousel-title">CIM MATERIALS</h2>
                        <div class="carousel-description">The Global Innovator in Wear Solutions</div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- About Section -->
    <section class="about-section section">
        <div class="container about-container">
            <div class="about-image">
                <?php 
                $about_image = get_theme_mod( 'industrial_about_image', get_template_directory_uri() . '/images/about-image.jpg' );
                if ( $about_image ) : 
                ?>
                    <img src="<?php echo esc_url( $about_image ); ?>" alt="<?php esc_attr_e( 'About Us', 'industrial' ); ?>">
                <?php endif; ?>
            </div>
            <div class="about-content">
                <h2 class="about-title"><?php echo esc_html( get_theme_mod( 'industrial_about_title', __( 'ABOUT US', 'industrial' ) ) ); ?></h2>
                <div class="about-text">
                    <?php echo wp_kses_post( get_theme_mod( 'industrial_about_text', __( 'Industrial is a global leader in wear solutions for industrial applications. We specialize in creating innovative materials designed to withstand extreme conditions in mining, energy, and manufacturing sectors. Our proprietary technologies and extensive experience allow us to deliver exceptional wear resistance and longevity.', 'industrial' ) ) ); ?>
                </div>
                <a href="<?php echo esc_url( get_theme_mod( 'industrial_about_button_url', '#' ) ); ?>" class="read-more-button">
                    <?php echo esc_html( get_theme_mod( 'industrial_about_button_text', __( 'READ MORE', 'industrial' ) ) ); ?>
                </a>
            </div>
        </div>
    </section>

    <!-- Products/Solutions Section -->
    <section class="products-section section">
        <div class="container">
            <h2 class="section-title"><?php echo esc_html( get_theme_mod( 'industrial_products_title', __( 'CIM Proprietary Solutions', 'industrial' ) ) ); ?></h2>
            
            <div class="products-grid">
                <?php
                // Get product categories
                $product_categories = get_categories(array(
                    'taxonomy' => 'category',
                    'parent' => get_cat_ID('Products'), // Get subcategories of Products
                    'hide_empty' => false,
                ));
                
                // If no product categories or Products category doesn't exist, show default products
                if ( empty($product_categories) ) :
                    // Define default products
                    $default_products = array(
                        array(
                            'image' => get_template_directory_uri() . '/images/product1.jpg',
                            'title' => __( 'Chrome Carbide Overlay', 'industrial' ),
                            'description' => __( 'Highly wear-resistant overlay for extreme abrasion environments.', 'industrial' ),
                            'link' => '#'
                        ),
                        array(
                            'image' => get_template_directory_uri() . '/images/product2.jpg',
                            'title' => __( 'Chrome White Iron', 'industrial' ),
                            'description' => __( 'Premium cast wear materials for mining and aggregate applications.', 'industrial' ),
                            'link' => '#'
                        ),
                        array(
                            'image' => get_template_directory_uri() . '/images/product3.jpg',
                            'title' => __( 'Ceramic Solutions', 'industrial' ),
                            'description' => __( 'Advanced ceramic composites for extreme wear resistance.', 'industrial' ),
                            'link' => '#'
                        ),
                        array(
                            'image' => get_template_directory_uri() . '/images/product4.jpg',
                            'title' => __( 'Coating Technologies', 'industrial' ),
                            'description' => __( 'Specialized surface treatments for enhanced performance.', 'industrial' ),
                            'link' => '#'
                        ),
                        array(
                            'image' => get_template_directory_uri() . '/images/product5.jpg',
                            'title' => __( 'Liner Systems', 'industrial' ),
                            'description' => __( 'Custom engineered wear liners for material handling systems.', 'industrial' ),
                            'link' => '#'
                        ),
                        array(
                            'image' => get_template_directory_uri() . '/images/product6.jpg',
                            'title' => __( 'Additive Manufacturing', 'industrial' ),
                            'description' => __( 'Next-generation 3D printed wear components.', 'industrial' ),
                            'link' => '#'
                        ),
                    );
                    
                    // Get products from customizer or use defaults
                    $products = get_theme_mod( 'industrial_products', $default_products );
                    
                    // Display products
                    foreach ( $products as $product ) :
                    ?>
                        <div class="product-item">
                            <div class="product-image" style="background-image: url('<?php echo esc_url( $product['image'] ); ?>');">
                            </div>
                            <div class="product-content">
                                <h3 class="product-title"><?php echo esc_html( $product['title'] ); ?></h3>
                                <p class="product-description"><?php echo esc_html( $product['description'] ); ?></p>
                                <a href="<?php echo esc_url( $product['link'] ); ?>" class="product-link"><?php esc_html_e( 'Learn More', 'industrial' ); ?> <i class="fas fa-arrow-right"></i></a>
                            </div>
                        </div>
                    <?php 
                    endforeach;
                else :
                    // Display product categories with thumbnails
                    foreach ( $product_categories as $category ) :
                        $thumbnail_url = cim_get_category_thumbnail_url( $category->term_id, 'medium' );
                        if ( !$thumbnail_url ) {
                            $thumbnail_url = get_template_directory_uri() . '/images/product-default.jpg';
                        }
                    ?>
                        <div class="product-category">
                            <a href="<?php echo esc_url( get_category_link( $category->term_id ) ); ?>">
                                <div class="category-thumbnail">
                                    <img src="<?php echo esc_url( $thumbnail_url ); ?>" alt="<?php echo esc_attr( $category->name ); ?>">
                                </div>
                                <h3 class="category-title"><?php echo esc_html( $category->name ); ?></h3>
                            </a>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Geometric Section -->
    <section class="geometric-section">
        <div class="geometric-bg">
            <div class="geometric-shape shape-1"></div>
            <div class="geometric-shape shape-2"></div>
            <div class="geometric-shape shape-3"></div>
            <div class="geometric-shape shape-4"></div>
            <div class="geometric-shape shape-5"></div>
            <div class="geometric-shape shape-6"></div>
        </div>
    </section>

</main><!-- #main -->

<?php
get_footer();
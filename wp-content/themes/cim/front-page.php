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
    <!-- Navigation Arrows -->
    <div class="carousel-arrow carousel-prev"><i class="fas fa-chevron-left"></i></div>
    <div class="carousel-arrow carousel-next"><i class="fas fa-chevron-right"></i></div>

    <div class="cim-carousel">
      <?php
      // Get carousel slides
      $carousel_args = array(
        'post_type' => 'carousel',
        'posts_per_page' => -1,
        'orderby' => 'menu_order',
        'order' => 'ASC',
      );

      $carousel_query = new WP_Query($carousel_args);

      if ($carousel_query->have_posts()):
        while ($carousel_query->have_posts()):
          $carousel_query->the_post();
          $slide_image = get_the_post_thumbnail_url(get_the_ID(), 'full');
          if (!$slide_image) {
            $slide_image = get_template_directory_uri() . '/assets/images/DARK-BG-NEW.jpg';
          }
          ?>
          <?php
          // Get redirect URL if it exists
          $redirect_url = get_post_meta(get_the_ID(), '_carousel_redirect_url', true);
          $has_link = !empty($redirect_url);

          // If has redirect link, wrap with <a> tag
          if ($has_link) {
            echo '<a href="' . esc_url($redirect_url) . '" class="carousel-link">';
          }
          ?>
          <div class="carousel-item" style="background-image: url('<?php echo esc_url($slide_image); ?>')">
            <div class="carousel-content custom">
              <div class="carousel-title"><?php the_title(); ?></div>
              <div class="carousel-description"><?php the_content(); ?></div>
            </div>
          </div>
          <?php if ($has_link) {
            echo '</a>';
          } ?>
          <?php
        endwhile;
        wp_reset_postdata();
      else:
        // Display default slide if no carousel posts
        ?>
        <?php
        // Default slide can also have a link if set in customizer
        $default_redirect_url = get_theme_mod('cim_default_carousel_link', '#');
        $has_default_link = !empty($default_redirect_url) && $default_redirect_url !== '#';

        if ($has_default_link) {
          echo '<a href="' . esc_url($default_redirect_url) . '" class="carousel-link">';
        }
        ?>
        <div class="carousel-item"
          style="background-image: url('<?php echo esc_url(get_template_directory_uri() . '/assets/images/BG-DARK.webp'); ?>')">
          <div class="carousel-content">
            <h2 class="carousel-title"><?php esc_html_e('INNOVATIVE WEAR SOLUTIONS', 'cim'); ?></h2>
            <div class="carousel-description">
              <?php esc_html_e('Global leader in advanced materials engineered to withstand extreme abrasion in mining, energy, and construction industries.', 'cim'); ?>
            </div>
          </div>
        </div>
        <?php if ($has_default_link) {
          echo '</a>';
        } ?>
      <?php endif; ?>
    </div>

    <script>
      jQuery(document).ready(function ($) {
        // Initialize Slick Slider
        $('.cim-carousel').slick({
          slidesToShow: 1,
          slidesToScroll: 1,
          autoplay: true,
          autoplaySpeed: 5000,
          arrows: true,
          prevArrow: $('.carousel-prev'),
          nextArrow: $('.carousel-next'),
          fade: true,
          speed: 1000,
          infinite: true,
          adaptiveHeight: true
        });

        // // Hide content by default and show on hover
        // $('.carousel-content').hide();

        // // Handle hover events for carousel items
        $('.carousel-item').hover(
          function () {
            // $(this).find('.carousel-content').fadeIn(200);
            $(this).addClass('hover');
          },
          function () {
            // $(this).find('.carousel-content').fadeOut(200);
            $(this).removeClass('hover');
          }
        );

        // Prevent default click behavior on carousel content when inside a link
        $('.carousel-content').on('click', function (e) {
          e.stopPropagation(); // Prevent event bubbling to parent link
        });
      });
    </script>
  </section>

  <!-- About Section -->
  <section class="about-section section">
    <div class="about-container">
      <div class="about-image"
        style="<?php echo get_theme_mod('cim_about_image') ? 'background-image: url(' . esc_url(get_theme_mod('cim_about_image')) . ');' : ''; ?>">
      </div>
      <div class="about-content"
        style="<?php echo get_theme_mod('cim_about_bg_image') ? 'background-image: url(' . esc_url(get_theme_mod('cim_about_bg_image')) . ');' : ''; ?>">
        <h2 class="about-title">
          <?php echo esc_html(get_theme_mod('cim_about_title', __('ABOUT US', 'cim'))); ?>
        </h2>
        <div class="about-text">
          <?php echo wp_kses_post(get_theme_mod('cim_about_text', __('Canadian Innovative Materials (CIM) is a global leader in wear solutions, specializing in advanced materials engineered to withstand extreme abrasion in the mining, energy, and construction industries. Our proprietary technologies - including Tungsten Carbide Overlay (WCO), High Chrome White Iron (HCWI), Silicon Carbide Ceramic (SiC), and Chrome Carbide Overlay (CCO) - provide exceptional wear resistance, significantly enhancing equipment performance and longevity.', 'cim'))); ?>
        </div>
        <a href="<?php echo esc_url(get_theme_mod('cim_about_button_url', '#')); ?>" class="read-more-button">
          <?php echo esc_html(get_theme_mod('cim_about_button_text', __('READ MORE', 'cim'))); ?>
        </a>
      </div>
    </div>
  </section>

  <!-- Products/Solutions Section -->
  <section class="products-section section">
    <div class="container">
      <h2 class="section-title">
        <?php echo esc_html(get_theme_mod('industrial_products_title', __('CIM Proprietary Solutions', 'industrial'))); ?>
      </h2>
      
      <style>
        /* Technology Items Grid */
        .products-grid {
          display: grid;
          grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
          gap: 30px;
          margin-top: 40px;
        }
        
        /* Technology Item Styling */
        .technology-item {
          text-align: center;
        }
        
        .technology-item a {
          text-decoration: none;
          color: inherit;
          display: block;
        }
        
        /* Circular Thumbnail */
        .technology-thumbnail {
          position: relative;
          width: 180px;
          height: 180px;
          border-radius: 50%;
          overflow: hidden;
          margin: 0 auto 15px;
        }
        
        .technology-thumbnail img {
          width: 100%;
          height: 100%;
          object-fit: cover;
          transition: transform 0.3s ease;
        }
        
        /* Abbreviation Overlay (hidden by default) */
        .technology-abbreviation {
          position: absolute;
          top: 0;
          left: 0;
          width: 100%;
          height: 100%;
          background-color: rgba(0, 0, 0, 0.7);
          display: flex;
          align-items: center;
          justify-content: center;
          opacity: 0;
          transition: opacity 0.3s ease;
        }
        
        .technology-abbreviation span {
          color: #d4af37; /* Gold color */
          font-size: 2.5em;
          font-weight: 700;
        }
        
        /* Hover Effects */
        .technology-item:hover .technology-abbreviation {
          opacity: 1;
        }
        
        .technology-item:hover .technology-thumbnail img {
          transform: scale(1.1);
        }
        
        /* Title Styling */
        .technology-title {
          font-size: 1.1em;
          color: #ffffff;
          margin-top: 10px;
          transition: color 0.3s ease;
        }
        
        .technology-item:hover .technology-title {
          color: #d4af37; /* Gold color on hover */
        }
        
        /* Responsive Adjustments */
        @media (max-width: 768px) {
          .products-grid {
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 20px;
          }
          
          .technology-thumbnail {
            width: 150px;
            height: 150px;
          }
          
          .technology-abbreviation span {
            font-size: 2em;
          }
        }
      </style>

      <div class="products-grid">
        <?php
        // Get technology posts
        $technology_args = array(
          'post_type' => 'technology',
          'posts_per_page' => -1,
          'orderby' => 'title',
          'order' => 'ASC',
        );
        
        $technology_query = new WP_Query($technology_args);
        
        // If no technology posts exist, show default products
        if (!$technology_query->have_posts()):
          // Define default products
          $default_products = array(
            array(
              'image' => get_template_directory_uri() . '/images/product1.jpg',
              'title' => __('Chrome Carbide Overlay', 'industrial'),
              'description' => __('Highly wear-resistant overlay for extreme abrasion environments.', 'industrial'),
              'link' => '#'
            ),
            array(
              'image' => get_template_directory_uri() . '/images/product2.jpg',
              'title' => __('Chrome White Iron', 'industrial'),
              'description' => __('Premium cast wear materials for mining and aggregate applications.', 'industrial'),
              'link' => '#'
            ),
            array(
              'image' => get_template_directory_uri() . '/images/product3.jpg',
              'title' => __('Ceramic Solutions', 'industrial'),
              'description' => __('Advanced ceramic composites for extreme wear resistance.', 'industrial'),
              'link' => '#'
            ),
            array(
              'image' => get_template_directory_uri() . '/images/product4.jpg',
              'title' => __('Coating Technologies', 'industrial'),
              'description' => __('Specialized surface treatments for enhanced performance.', 'industrial'),
              'link' => '#'
            ),
            array(
              'image' => get_template_directory_uri() . '/images/product5.jpg',
              'title' => __('Liner Systems', 'industrial'),
              'description' => __('Custom engineered wear liners for material handling systems.', 'industrial'),
              'link' => '#'
            ),
            array(
              'image' => get_template_directory_uri() . '/images/product6.jpg',
              'title' => __('Additive Manufacturing', 'industrial'),
              'description' => __('Next-generation 3D printed wear components.', 'industrial'),
              'link' => '#'
            ),
          );

          // Get products from customizer or use defaults
          $products = get_theme_mod('industrial_products', $default_products);

          // Display products
          foreach ($products as $product):
            ?>
            <div class="product-item">
              <div class="product-image" style="background-image: url('<?php echo esc_url($product['image']); ?>');">
              </div>
              <div class="product-content">
                <h3 class="product-title"><?php echo esc_html($product['title']); ?></h3>
                <p class="product-description"><?php echo esc_html($product['description']); ?></p>
                <a href="<?php echo esc_url($product['link']); ?>"
                  class="product-link"><?php esc_html_e('Learn More', 'industrial'); ?> <i
                    class="fas fa-arrow-right"></i></a>
              </div>
            </div>
            <?php
          endforeach;
        else:
          // Display technology posts with circular thumbnails
          while ($technology_query->have_posts()) : $technology_query->the_post();
            $thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), 'medium');
            if (!$thumbnail_url) {
              $thumbnail_url = get_template_directory_uri() . '/assets/images/DARK-BG-NEW.jpg';
            }
            // Get the abbreviation
            $abbreviation = get_post_meta(get_the_ID(), '_technology_abbreviation', true);
            ?>
            <div class="technology-item">
              <a href="<?php the_permalink(); ?>">
                <div class="technology-thumbnail">
                  <img src="<?php echo esc_url($thumbnail_url); ?>" alt="<?php echo esc_attr(get_the_title()); ?>">
                  <div class="technology-abbreviation">
                    <span><?php echo esc_html($abbreviation); ?></span>
                  </div>
                </div>
                <h3 class="technology-title"><?php the_title(); ?></h3>
              </a>
            </div>
          <?php endwhile; wp_reset_postdata(); ?>
        <?php endif; ?>
      </div>
    </div>
  </section>

  <!-- Video Section -->
  <section class="video-section section">
    <div class="container">
      <div class="video-container">
        <video autoplay loop muted playsinline>
          <source src="https://video.wixstatic.com/video/2ca1e9_0e5abe2f22a045c1a15f89df63952315/720p/mp4/file.mp4"
            type="video/mp4">
          <?php esc_html_e('Your browser does not support the video tag.', 'cim'); ?>
        </video>
      </div>
    </div>
  </section>
  <section class="geometric-section section"
    style="background-image: url(<?php echo get_template_directory_uri() . '/assets/images/BG-DARK-long.webp' ?>">
  </section>

</main><!-- #main -->

<?php
get_footer();
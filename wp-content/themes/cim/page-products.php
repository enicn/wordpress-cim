<?php
/**
 * Template Name: Products Page
 * 
 * This template displays a list of products with hover effects and links to product details.
 *
 * @package cim
 */

get_header();
?>

<style>
  /* Products Page Styles */
  .products-main {
    background-color: var(--industrial-dark-bg);
    padding: 40px 0;
    min-height: 60vh;
  }

  .products-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 15px;
  }

  .products-header {
    text-align: center;
    margin-bottom: 40px;
  }

  .products-title {
    font-size: 2.5em;
    font-weight: bold;
    color: var(--industrial-yellow);
    margin-bottom: 15px;
    text-transform: uppercase;
  }

  .products-description {
    color: var(--industrial-text-light);
    max-width: 800px;
    margin: 0 auto;
    line-height: 1.6;
  }

  .products-list {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 30px;
  }

  .product-item {
    position: relative;
    border-radius: 50%;
    overflow: hidden;
    aspect-ratio: 1/1;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
  }

  .product-item:hover {
    transform: scale(1.05);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.5);
  }

  .product-item a {
    display: block;
    width: 100%;
    height: 100%;
    text-decoration: none;
    color: #fff;
  }

  .product-thumbnail {
    width: 100%;
    height: 100%;
    position: relative;
  }

  .product-thumbnail img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
  }

  .product-info {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.7);
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    text-align: center;
    opacity: 0;
    transition: opacity 0.3s ease;
  }

  .product-item:hover .product-info {
    opacity: 1;
  }

  .product-title {
    font-size: 1.2em;
    font-weight: bold;
    margin-bottom: 5px;
    color: var(--industrial-yellow);
  }

  .product-short-name {
    font-size: 1em;
    color: #fff;
    margin-bottom: 10px;
  }

  .product-link {
    display: inline-block;
    background-color: var(--industrial-yellow);
    color: var(--industrial-dark-bg);
    padding: 8px 15px;
    border-radius: 3px;
    font-weight: bold;
    margin-top: 10px;
    transition: background-color 0.3s ease;
  }

  .product-link:hover {
    background-color: var(--industrial-yellow-dark);
  }

  /* Responsive adjustments */
  @media (max-width: 768px) {
    .products-list {
      grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
      gap: 20px;
    }

    .products-title {
      font-size: 2em;
    }
  }

  @media (max-width: 480px) {
    .products-list {
      grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
      gap: 15px;
    }
  }
</style>

<main id="main" class="site-main products-main">
  <div class="products-container">
    <header class="products-header">
      <h1 class="products-title"><?php the_title(); ?></h1>
      <?php if (get_the_content()): ?>
        <div class="products-description">
          <?php the_content(); ?>
        </div>
      <?php endif; ?>
    </header>

    <div class="products-content">
      <?php
      // Query posts with the 'product' category
      $args = array(
        'post_type' => 'product',
        'posts_per_page' => -1,
        'orderby' => 'title',
        'order' => 'ASC'
      );

      $product_query = new WP_Query($args);

      if ($product_query->have_posts()):
        ?>
        <div class="products-list">
          <?php
          while ($product_query->have_posts()):
            $product_query->the_post();
            $thumbnail = get_the_post_thumbnail_url(get_the_ID(), 'medium');
            if (!$thumbnail) {
              $thumbnail = get_template_directory_uri() . '/assets/images/product-default.jpg';
            }
            $short_name = get_post_meta(get_the_ID(), '_product_short_name', true);
            ?>
            <div class="product-item">
              <a href="<?php the_permalink(); ?>">
                <div class="product-thumbnail">
                  <img src="<?php echo esc_url($thumbnail); ?>" alt="<?php the_title_attribute(); ?>">
                </div>
                <div class="product-info">
                  <h3 class="product-title"><?php the_title(); ?></h3>
                  <?php if (!empty($short_name)): ?>
                    <div class="product-short-name">(<?php echo esc_html($short_name); ?>)</div>
                  <?php endif; ?>
                  <span class="product-link"><?php esc_html_e('View Details', 'cim'); ?></span>
                </div>
              </a>
            </div>
          <?php endwhile; ?>
        </div>

        <?php
        // Reset post data
        wp_reset_postdata();

      else:
        ?>
        <div class="no-products">
          <p><?php esc_html_e('No products found.', 'cim'); ?></p>
        </div>
      <?php endif; ?>
    </div>
  </div>
</main>

<?php
get_footer();
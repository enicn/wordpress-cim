<?php
/**
 * The template for displaying product archives
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package cim
 */

get_header();
?>

<style>
    .products-archive-main {
        background-color: var(--industrial-dark-bg);
        padding: 40px 20px;
        min-height: 60vh;
    }
    
    .products-archive-title {
        text-align: center;
        font-size: 2.5em;
        font-weight: bold;
        color: var(--industrial-yellow);
        margin-bottom: 40px;
        text-transform: uppercase;
        letter-spacing: 2px;
    }
    
    .products-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 30px;
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 15px;
    }
    
    .product-item {
        background-color: var(--industrial-dark-secondary);
        border: none;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        overflow: hidden;
        display: flex;
        flex-direction: column;
        transition: transform 0.3s ease;
    }
    
    .product-item:hover {
        transform: translateY(-5px);
    }
    
    .product-thumbnail {
        height: 250px;
        overflow: hidden;
    }
    
    .product-thumbnail img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }
    
    .product-item:hover .product-thumbnail img {
        transform: scale(1.05);
    }
    
    .product-info {
        background-color: var(--industrial-dark-secondary);
        color: var(--industrial-text-light);
        padding: 20px;
        text-align: center;
    }
    
    .product-title {
        font-size: 1.2em;
        font-weight: bold;
        margin: 0 0 5px 0;
        color: var(--industrial-yellow);
    }
    
    .product-short-name {
        font-size: 0.9em;
        margin: 0 0 10px 0;
        color: var(--industrial-text-muted);
        font-style: italic;
    }
    
    .product-excerpt {
        font-size: 0.9em;
        margin-bottom: 15px;
        color: var(--industrial-text-light);
    }
    
    .product-link {
        display: inline-block;
        background-color: var(--industrial-yellow);
        color: var(--industrial-dark-bg);
        padding: 8px 15px;
        text-decoration: none;
        font-weight: bold;
        border-radius: 3px;
        transition: background-color 0.3s ease;
    }
    
    .product-link:hover {
        background-color: var(--industrial-yellow-dark);
    }
    
    /* Responsive adjustments */
    @media (max-width: 768px) {
        .products-archive-title {
            font-size: 2em;
        }
        
        .products-grid {
            gap: 20px;
        }
        
        .product-thumbnail {
            height: 200px;
        }
    }
</style>

<main id="main" class="site-main products-archive-main">

    <h1 class="products-archive-title"><?php esc_html_e('Products', 'cim'); ?></h1>

    <div class="products-grid">

        <?php
        if (have_posts()) :
            while (have_posts()) :
                the_post();
                
                // Get product short name
                $short_name = get_post_meta(get_the_ID(), '_product_short_name', true);
                ?>

                <article id="post-<?php the_ID(); ?>" <?php post_class('product-item'); ?>>
                    <a href="<?php the_permalink(); ?>" class="product-thumbnail">
                        <?php
                        if (has_post_thumbnail()) {
                            the_post_thumbnail('medium_large');
                        } else {
                            echo '<img src="' . esc_url(get_template_directory_uri() . '/assets/images/product-placeholder.jpg') . '" alt="' . esc_attr__('Product Image Placeholder', 'cim') . '">';
                        }
                        ?>
                    </a>

                    <div class="product-info">
                        <h2 class="product-title"><?php the_title(); ?></h2>
                        <?php if (!empty($short_name)) : ?>
                            <p class="product-short-name"><?php echo esc_html($short_name); ?></p>
                        <?php endif; ?>
                        
                        <div class="product-excerpt">
                            <?php the_excerpt(); ?>
                        </div>
                        
                        <a href="<?php the_permalink(); ?>" class="product-link">
                            <?php esc_html_e('View Details', 'cim'); ?>
                        </a>
                    </div>
                </article>

                <?php
            endwhile;
            
            the_posts_navigation();
        else :
            ?>
            <p class="no-products">
                <?php esc_html_e('No products found.', 'cim'); ?>
            </p>
            <?php
        endif;
        ?>

    </div>

</main>

<?php
get_footer();
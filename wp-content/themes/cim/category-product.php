<?php
/**
 * The template for displaying Product category archives
 *
 * This template will display all subcategories of the 'product' category
 * and can be used for paths like /category/product/get-attachment
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package cim
 */

get_header();

// Get current category
$current_category = get_queried_object();
$category_title = $current_category->name;
$category_description = $current_category->description;

// Check if this is a subcategory of Products
$is_product_subcategory = false;
$parent_categories = get_ancestors($current_category->term_id, 'category');
foreach ($parent_categories as $parent_id) {
    $parent = get_term($parent_id, 'category');
    if ($parent->slug === 'product') {
        $is_product_subcategory = true;
        break;
    }
}

// Also check if this is the main Products category
$is_product_category = ($current_category->slug === 'product');

// If this is the Products category or a subcategory of Products
if ($is_product_category || $is_product_subcategory) {
    // Get subcategories if this is the main Products category
    if ($is_product_category) {
        $subcategories = get_categories(array(
            'taxonomy' => 'category',
            'parent' => $current_category->term_id,
            'hide_empty' => false,
        ));
    }
?>

<style>
    .product-archive-main {
        background-color: var(--industrial-dark-bg, #121212);
        padding: 40px 20px;
        min-height: 60vh;
    }
    
    .product-archive-title {
        text-align: center;
        font-size: 2.5em;
        font-weight: bold;
        color: var(--industrial-yellow, #e4b95b);
        margin-bottom: 40px;
        text-transform: uppercase;
        letter-spacing: 2px;
    }
    
    .product-archive-description {
        text-align: center;
        max-width: 800px;
        margin: 0 auto 40px;
        color: var(--industrial-text-light, #ffffff);
        font-size: 1.1em;
        line-height: 1.6;
    }
    
    .product-categories-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 30px;
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 15px;
    }
    
    .product-category-item {
        background-color: var(--industrial-dark-secondary, #1e1e1e);
        border: none;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        overflow: hidden;
        display: flex;
        flex-direction: column;
        transition: transform 0.3s ease;
    }
    
    .product-category-item:hover {
        transform: translateY(-5px);
    }
    
    .category-thumbnail {
        height: 250px;
        overflow: hidden;
    }
    
    .category-thumbnail img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }
    
    .product-category-item:hover .category-thumbnail img {
        transform: scale(1.05);
    }
    
    .category-info {
        background-color: var(--industrial-dark-secondary, #1e1e1e);
        color: var(--industrial-text-light, #ffffff);
        padding: 20px;
        text-align: center;
    }
    
    .category-title {
        font-size: 1.2em;
        font-weight: bold;
        margin: 0 0 5px 0;
        color: var(--industrial-yellow, #e4b95b);
    }
    
    .category-description {
        font-size: 0.9em;
        margin-bottom: 15px;
        color: var(--industrial-text-light, #ffffff);
    }
    
    .category-link {
        display: inline-block;
        background-color: var(--industrial-yellow, #e4b95b);
        color: var(--industrial-dark-bg, #121212);
        padding: 8px 15px;
        text-decoration: none;
        font-weight: bold;
        text-transform: uppercase;
        font-size: 0.8em;
        letter-spacing: 1px;
        transition: background-color 0.3s ease;
    }
    
    .category-link:hover {
        background-color: #d1a64a;
    }
    
    /* Products list styles */
    .products-list {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 30px;
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 15px;
    }
    
    .product-item {
        background-color: var(--industrial-dark-secondary, #1e1e1e);
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
        background-color: var(--industrial-dark-secondary, #1e1e1e);
        color: var(--industrial-text-light, #ffffff);
        padding: 20px;
        text-align: center;
    }
    
    .product-title {
        font-size: 1.2em;
        font-weight: bold;
        margin: 0 0 5px 0;
        color: var(--industrial-yellow, #e4b95b);
    }
    
    .product-short-name {
        font-size: 0.9em;
        margin: 0 0 10px 0;
        color: var(--industrial-text-muted, #999999);
        font-style: italic;
    }
    
    .product-excerpt {
        font-size: 0.9em;
        margin-bottom: 15px;
        color: var(--industrial-text-light, #ffffff);
    }
    
    .product-link {
        display: inline-block;
        background-color: var(--industrial-yellow, #e4b95b);
        color: var(--industrial-dark-bg, #121212);
        padding: 8px 15px;
        text-decoration: none;
        font-weight: bold;
        text-transform: uppercase;
        font-size: 0.8em;
        letter-spacing: 1px;
        transition: background-color 0.3s ease;
    }
    
    .product-link:hover {
        background-color: #d1a64a;
    }
</style>

<main id="primary" class="site-main product-archive-main">
    <div class="container">
        <h1 class="product-archive-title"><?php echo esc_html($category_title); ?></h1>
        
        <?php if (!empty($category_description)): ?>
            <div class="product-archive-description">
                <?php echo wp_kses_post($category_description); ?>
            </div>
        <?php endif; ?>

        <?php if ($is_product_category && !empty($subcategories)): ?>
            <!-- Display subcategories if this is the main Products category -->
            <div class="product-categories-grid">
                <?php foreach ($subcategories as $subcategory): 
                    $thumbnail_url = cim_get_category_thumbnail_url($subcategory->term_id, 'medium');
                    if (!$thumbnail_url) {
                        $thumbnail_url = get_template_directory_uri() . '/assets/images/product-default.jpg';
                    }
                ?>
                    <div class="product-category-item">
                        <a href="<?php echo esc_url(get_category_link($subcategory->term_id)); ?>">
                            <div class="category-thumbnail">
                                <img src="<?php echo esc_url($thumbnail_url); ?>" alt="<?php echo esc_attr($subcategory->name); ?>">
                            </div>
                            <div class="category-info">
                                <h3 class="category-title"><?php echo esc_html($subcategory->name); ?></h3>
                                <?php if (!empty($subcategory->description)): ?>
                                    <div class="category-description"><?php echo wp_kses_post($subcategory->description); ?></div>
                                <?php endif; ?>
                                <span class="category-link"><?php esc_html_e('View Products', 'cim'); ?></span>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <!-- Display posts in this category -->
            <?php if (have_posts()): ?>
                <div class="products-list">
                    <?php while (have_posts()): the_post(); 
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
                                        <div class="product-short-name"><?php echo esc_html($short_name); ?></div>
                                    <?php endif; ?>
                                    <div class="product-excerpt"><?php the_excerpt(); ?></div>
                                    <span class="product-link"><?php esc_html_e('View Details', 'cim'); ?></span>
                                </div>
                            </a>
                        </div>
                    <?php endwhile; ?>
                </div>
                
                <?php the_posts_navigation(); ?>
                
            <?php else: ?>
                <p class="no-products"><?php esc_html_e('No products found in this category.', 'cim'); ?></p>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</main><!-- #main -->

<?php
} else {
    // If not a product category, use the default category template
    get_template_part('archive');
}

get_footer();
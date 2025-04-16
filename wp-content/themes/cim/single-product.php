<?php
/**
 * The template for displaying single product
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package cim
 */

get_header();

// Get product meta data
$short_name = get_post_meta(get_the_ID(), '_product_short_name', true);
$gallery_images = get_post_meta(get_the_ID(), '_product_gallery', true);
$video_url = get_post_meta(get_the_ID(), '_product_video', true);
?>

<style>
    .product-single-main {
        background-color: rgba(0, 0, 0, 0.7);
        padding: 40px 20px;
        min-height: 60vh;
    }
    
    .product-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 15px;
    }
    
    .product-header {
        margin-bottom: 30px;
        text-align: center;
    }
    
    .product-title {
        font-size: 2.5em;
        font-weight: bold;
        color: var(--industrial-yellow);
        margin-bottom: 10px;
        text-transform: uppercase;
    }
    
    .product-short-name {
        font-size: 1.2em;
        color: var(--industrial-text-muted);
        font-style: italic;
        margin-bottom: 20px;
    }
    
    .product-content-wrapper {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 30px;
    }
    
    .product-main-image {
        width: 100%;
        height: auto;
        border: 3px solid var(--industrial-yellow);
        margin-bottom: 20px;
    }
    
    .product-gallery {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 10px;
        margin-bottom: 30px;
    }
    
    .gallery-image {
        width: 100%;
        height: 120px;
        object-fit: cover;
        cursor: pointer;
        border: 2px solid transparent;
        transition: border-color 0.3s ease;
    }
    
    .gallery-image:hover {
        border-color: var(--industrial-yellow);
    }
    
    .product-video {
        margin-top: 20px;
    }
    
    .video-container {
        position: relative;
        padding-bottom: 56.25%; /* 16:9 aspect ratio */
        height: 0;
        overflow: hidden;
        max-width: 100%;
    }
    
    .video-container iframe {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
    }
    
    .product-description {
        color: var(--industrial-text-light);
        line-height: 1.6;
    }
    
    .product-description h2,
    .product-description h3 {
        color: var(--industrial-yellow);
        margin-top: 20px;
        margin-bottom: 10px;
    }
    
    .product-meta {
        margin-top: 30px;
        padding-top: 20px;
        border-top: 1px solid var(--industrial-dark-secondary);
        color: var(--industrial-text-muted);
    }
    
    .product-categories {
        margin-top: 10px;
    }
    
    .product-categories a {
        color: var(--industrial-blue-light);
        text-decoration: none;
    }
    
    .product-categories a:hover {
        text-decoration: underline;
    }
    
    .back-to-products {
        display: inline-block;
        margin-top: 30px;
        background-color: var(--industrial-yellow);
        color: var(--industrial-dark-bg);
        padding: 10px 20px;
        text-decoration: none;
        font-weight: bold;
        border-radius: 3px;
        transition: background-color 0.3s ease;
    }
    
    .back-to-products:hover {
        background-color: var(--industrial-yellow-dark);
    }
    
    /* Responsive adjustments */
    @media (max-width: 768px) {
        .product-content-wrapper {
            grid-template-columns: 1fr;
        }
        
        .product-title {
            font-size: 2em;
        }
        
        .gallery-image {
            height: 100px;
        }
    }
</style>

<div style="position: fixed; inset: 0; z-index: -1;">
  <video crossorigin="anonymous" playsinline="" preload="auto" muted="" loop="" autoplay="" controls="no"
    src="https://video.wixstatic.com/video/11062b_2ccb88c1c6de4151b51879d6c90fca9d/720p/mp4/file.mp4"
    style="height: 100%; width: 100%; object-fit: cover; object-position: center center; opacity: 1;"></video>
</div>
<!-- Modal for gallery images -->
<div id="gallery-modal" style="display: none; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%; overflow: auto; background-color: rgba(0,0,0,0.9);">
    <span id="close-modal" style="position: absolute; top: 15px; right: 35px; color: #f1f1f1; font-size: 40px; font-weight: bold; cursor: pointer;">&times;</span>
    <img id="modal-image" style="margin: auto; display: block; max-width: 90%; max-height: 90%; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
</div>

<main id="main" class="site-main product-single-main">

    <?php
    while (have_posts()) :
        the_post();
        ?>

        <div class="product-container">
            <header class="product-header">
                <h1 class="product-title"><?php the_title(); ?></h1>
                <?php if (!empty($short_name)) : ?>
                    <p class="product-short-name">(<?php echo esc_html($short_name); ?>)</p>
                <?php endif; ?>
            </header>

            <div class="product-content-wrapper">
                <div class="product-media">
                    <?php if (has_post_thumbnail()) : ?>
                        <?php the_post_thumbnail('large', array('class' => 'product-main-image')); ?>
                    <?php else : ?>
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/product-placeholder.jpg'); ?>" alt="<?php esc_attr_e('Product Image Placeholder', 'cim'); ?>" class="product-main-image">
                    <?php endif; ?>

                    <?php if (!empty($gallery_images)) : ?>
                        <div class="product-gallery">
                            <?php
                            $gallery_array = explode(',', $gallery_images);
                            foreach ($gallery_array as $image_id) :
                                $image_url = wp_get_attachment_image_url($image_id, 'medium_large');
                                $image_full = wp_get_attachment_image_url($image_id, 'full');
                                if ($image_url) :
                                    ?>
                                    <img src="<?php echo esc_url($image_url); ?>" data-full="<?php echo esc_url($image_full); ?>" alt="<?php esc_attr_e('Product Gallery Image', 'cim'); ?>" class="gallery-image">
                                    <?php
                                endif;
                            endforeach;
                            ?>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($video_url)) : ?>
                        <div class="product-video">
                            <h3><?php esc_html_e('Product Video', 'cim'); ?></h3>
                            <div class="video-container">
                                <?php
                                // Extract video ID and create embed URL
                                $video_id = '';
                                $embed_url = '';
                                
                                // YouTube
                                if (strpos($video_url, 'youtube.com') !== false || strpos($video_url, 'youtu.be') !== false) {
                                    if (preg_match('/youtube\.com\/watch\?v=([\w-]+)/', $video_url, $matches)) {
                                        $video_id = $matches[1];
                                    } elseif (preg_match('/youtu\.be\/([\w-]+)/', $video_url, $matches)) {
                                        $video_id = $matches[1];
                                    }
                                    
                                    if ($video_id) {
                                        $embed_url = 'https://www.youtube.com/embed/' . $video_id;
                                    }
                                }
                                // Vimeo
                                elseif (strpos($video_url, 'vimeo.com') !== false) {
                                    if (preg_match('/vimeo\.com\/([\d]+)/', $video_url, $matches)) {
                                        $video_id = $matches[1];
                                        $embed_url = 'https://player.vimeo.com/video/' . $video_id;
                                    }
                                }
                                
                                if ($embed_url) {
                                    echo '<iframe src="' . esc_url($embed_url) . '" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
                                } else {
                                    echo '<p>' . esc_html__('Invalid video URL. Please provide a valid YouTube or Vimeo URL.', 'cim') . '</p>';
                                }
                                ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="product-details">
                    <div class="product-description">
                        <?php the_content(); ?>
                    </div>

                    <div class="product-meta">
                        <?php
                        $product_categories = get_the_terms(get_the_ID(), 'product_category');
                        if ($product_categories && !is_wp_error($product_categories)) :
                            ?>
                            <div class="product-categories">
                                <strong><?php esc_html_e('Categories:', 'cim'); ?></strong>
                                <?php
                                $category_links = array();
                                foreach ($product_categories as $category) {
                                    $category_links[] = '<a href="' . esc_url(get_term_link($category)) . '">' . esc_html($category->name) . '</a>';
                                }
                                echo implode(', ', $category_links);
                                ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <a href="<?php echo esc_url(get_post_type_archive_link('product')); ?>" class="back-to-products">
                        <?php esc_html_e('Back to Products', 'cim'); ?>
                    </a>
                </div>
            </div>
        </div>

    <?php endwhile; ?>

</main>

<script>
    // Gallery modal functionality
    document.addEventListener('DOMContentLoaded', function() {
        const galleryImages = document.querySelectorAll('.gallery-image');
        const modal = document.getElementById('gallery-modal');
        const modalImg = document.getElementById('modal-image');
        const closeModal = document.getElementById('close-modal');
        
        galleryImages.forEach(function(img) {
            img.addEventListener('click', function() {
                modal.style.display = 'block';
                modalImg.src = this.getAttribute('data-full');
            });
        });
        
        closeModal.addEventListener('click', function() {
            modal.style.display = 'none';
        });
        
        modal.addEventListener('click', function(event) {
            if (event.target === modal) {
                modal.style.display = 'none';
            }
        });
    });
</script>

<?php
get_footer();
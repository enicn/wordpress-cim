<?php
/**
 * Template Name: Menu Page Template
 * 
 * A template for displaying Default menu pages with consistent styling
 *
 * @package Industrial
 */

get_header();
?>

<main id="primary" class="site-main menu-page">
    <div class="page-header">
        <div class="container">
            <h1 class="page-title"><?php the_title(); ?></h1>
            <?php if (function_exists('yoast_breadcrumb')) {
                yoast_breadcrumb('<p id="breadcrumbs" class="breadcrumbs">', '</p>');
            } ?>
        </div>
    </div>
    
    <div class="container page-content-container">
        <div class="page-content">
            <?php
            while (have_posts()) :
                the_post();
                
                // Display featured image if available
                if (has_post_thumbnail()) :
                    echo '<div class="featured-image-container">';
                    the_post_thumbnail('full', array('class' => 'featured-image'));
                    echo '</div>';
                endif;
                
                // Display content
                echo '<div class="entry-content">';
                the_content();
                echo '</div>';
                
                // If comments are open or we have at least one comment, load up the comment template.
                if (comments_open() || get_comments_number()) :
                    comments_template();
                endif;
                
            endwhile; // End of the loop.
            ?>
        </div>
        
        <aside class="page-sidebar">
            <div class="sidebar-widget">
                <h3 class="widget-title"><?php esc_html_e('Menu', 'industrial'); ?></h3>
                <?php
                wp_nav_menu(
                    array(
                        'menu'           => 'Default',
                        'menu_class'     => 'sidebar-menu',
                        'container'      => false,
                        'depth'          => 2,
                    )
                );
                ?>
            </div>
        </aside>
    </div>
</main><!-- #main -->

<?php
get_footer();
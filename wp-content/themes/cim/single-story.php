<?php
/**
 * The template for displaying single story posts
 *
 * @package cim
 */

get_header();
?>

<style>
  /*--------------------------------------------------------------
  # Single Story Styles
  --------------------------------------------------------------*/
  .single-story-section {
    background-color: #2a2a2a;
    padding: 60px 0;
    color: #cccccc;
  }

  .single-story-section .container {
    max-width: 1140px;
    margin-left: auto;
    margin-right: auto;
    padding-left: 15px;
    padding-right: 15px;
  }

  .single-story-header {
    margin-bottom: 40px;
  }

  .single-story-title {
    color: #d4af37;
    font-size: 2em;
    font-weight: 700;
    text-transform: uppercase;
    margin-bottom: 10px;
    line-height: 1.3;
  }

  .single-story-subtitle {
    color: #ffffff;
    font-size: 1.5em;
    font-weight: 600;
    margin-bottom: 25px;
    line-height: 1.4;
  }

  .single-story-content {
    margin-bottom: 40px;
  }

  .single-story-content p {
    font-size: 1.1em;
    line-height: 1.8;
    margin-bottom: 25px;
  }

  .single-story-content img {
    max-width: 100%;
    height: auto;
    margin: 30px 0;
  }

  .story-back-button {
    display: inline-block;
    background-color: #d4af37;
    color: #2a2a2a;
    padding: 10px 25px;
    text-decoration: none;
    font-weight: 600;
    font-size: 0.9em;
    border-radius: 4px;
    transition: background-color 0.3s ease, color 0.3s ease;
    text-align: center;
    cursor: pointer;
    border: none;
  }

  .story-back-button:hover,
  .story-back-button:focus {
    background-color: #c49e27;
    color: #1a1a1a;
    text-decoration: none;
  }

  /* Responsive Adjustments */
  @media (max-width: 768px) {
    .single-story-title {
      font-size: 1.7em;
    }

    .single-story-subtitle {
      font-size: 1.3em;
    }

    .single-story-section {
      padding: 40px 0;
    }
  }
</style>

<main id="main-content" class="site-main">
  <section class="single-story-section">
    <div class="container">
      <?php while (have_posts()) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
          <header class="single-story-header">
            <h1 class="single-story-title"><?php the_title(); ?></h1>
            <?php 
            // Get the subtitle
            $subtitle = get_post_meta(get_the_ID(), '_story_subtitle', true);
            if (!empty($subtitle)) : 
            ?>
            <h2 class="single-story-subtitle"><?php echo esc_html($subtitle); ?></h2>
            <?php endif; ?>
          </header>

          <div class="single-story-content">
            <?php the_content(); ?>
          </div>

          <div class="story-navigation">
            <a href="<?php echo esc_url(get_permalink(get_page_by_path('stories'))); ?>" class="story-back-button">
              <?php _e('Back to Stories', 'cim'); ?>
            </a>
          </div>
        </article>
      <?php endwhile; ?>
    </div>
  </section>
</main><!-- #main-content -->

<?php
get_footer();
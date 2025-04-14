<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package CIM
 */

get_header();
?>

<main id="primary" class="site-main">
  <div class="container">
    <?php
    while (have_posts()):
      the_post();
      ?>
      <article id="post-<?php the_ID(); ?>" <?php post_class('single-post-content'); ?>
        style="background-color: #243c6b; color: #fff;">
        <header class="entry-header">
          <div class="entry-meta">
            <span class="cim-logo-icon">CIM</span>
            <span class="post-author"><?php the_author(); ?></span> ·
            <span class="post-date"><?php echo get_the_date(); ?></span> ·
            <span class="post-categories"><?php the_category(', '); ?></span>
          </div>
        </header>

        <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
        <div class="entry-content">
          <?php
          the_content();

          wp_link_pages(
            array(
              'before' => '<div class="page-links">' . esc_html__('Pages:', 'cim'),
              'after' => '</div>',
            )
          );
          ?>
        </div>

        <footer class="entry-footer">
          <?php if (has_tag()): ?>
            <div class="post-tags">
              <i class="fas fa-tags"></i>
              <?php the_tags('', ', '); ?>
            </div>
          <?php endif; ?>
        </footer>
      </article>

      <div class="post-navigation">
        <?php
        the_post_navigation(
          array(
            'prev_text' => '<span class="nav-subtitle">' . esc_html__('Previous:', 'cim') . '</span> <span class="nav-title">%title</span>',
            'next_text' => '<span class="nav-subtitle">' . esc_html__('Next:', 'cim') . '</span> <span class="nav-title">%title</span>',
          )
        );
        ?>
      </div>

      <?php
      // If comments are open or we have at least one comment, load up the comment template.
      // if (comments_open() || get_comments_number()):
      //   comments_template();
      // endif;

    endwhile; // End of the loop.
    ?>
  </div>
</main><!-- #main -->

<style>
  /* Single Post Styles */
  .single-post-content {
    max-width: 800px;
    margin: 40px auto;
    background-color: #fff;
    padding: 30px;
    border-radius: 5px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
  }

  .entry-title {
    font-size: 2.5rem;
    margin-bottom: 15px;
    color: var(--industrial-yellow);
  }

  .entry-meta {
    margin-bottom: 20px;
    font-size: 0.9rem;
  }

  .cim-logo-icon {
    display: inline-block;
    background-color: var(--industrial-yellow);
    color: var(--cim-primary-dark-blue);
    padding: 4px 6px;
    border-radius: 3px;
    font-weight: bold;
    font-size: 0.75rem;
    margin-right: 8px;
    vertical-align: middle;
  }

  .post-featured-image {
    margin-bottom: 25px;
  }

  .post-featured-image img {
    width: 100%;
    height: auto;
    border-radius: 5px;
  }

  .entry-content {
    font-size: 1.1rem;
    line-height: 1.7;
  }

  .entry-content p {
    margin-bottom: 1.5rem;
  }

  .entry-content h2,
  .entry-content h3 {
    margin-top: 2rem;
    margin-bottom: 1rem;
    color: var(--cim-primary-dark-blue);
  }

  .entry-footer {
    margin-top: 30px;
    padding-top: 20px;
    border-top: 1px solid #eee;
  }

  .post-tags {
    font-size: 0.9rem;
    color: #666;
  }

  .post-navigation {
    margin: 40px 0;
  }

  .post-navigation .nav-links {
    display: flex;
    justify-content: space-between;
  }

  .post-navigation .nav-previous,
  .post-navigation .nav-next {
    max-width: 48%;
  }

  .post-navigation .nav-subtitle {
    display: block;
    font-size: 0.8rem;
    color: #666;
  }

  .post-navigation .nav-title {
    font-weight: bold;
    color: var(--cim-primary-dark-blue);
  }

  @media (max-width: 768px) {
    .single-post-content {
      padding: 20px;
      margin: 20px auto;
    }

    .entry-title {
      font-size: 2rem;
    }
  }
</style>

<?php
get_footer();
<?php
/**
 * Template Name: Technologies Page
 *
 * @package cim
 */

get_header();

// Get the header image and link from options
$header_image_id = get_option('cim_technologies_image');
$header_image_url = '';
if ($header_image_id) {
  $header_image_url = wp_get_attachment_image_url($header_image_id, 'full');
}
$header_link = get_option('cim_technologies_link');
?>
<style>
.tech-intro-container {
  display: flex;
}
.tech-image-container {
  flex: none;
  width: 30%;
}
.tech-header-image {
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.6);
}
</style>
<div style="position: fixed; inset: 0; z-index: -1;">
  <video crossorigin="anonymous" playsinline="" preload="auto" muted="" loop="" autoplay="" controls="no"
    src="https://video.wixstatic.com/video/11062b_c18db2b1461b46f2ad31bae61009fee1/1080p/mp4/file.mp4"
    style="height: 100%; width: 100%; object-fit: cover; object-position: center center; opacity: 1;"></video>
</div>
<main id="main" class="site-main">
  <!-- Proprietary Technologies Section -->
  <section id="proprietary-tech" class="tech-section">
    <div class="container" style="
      background-color: rgba(232,205,139, 0.6);
      color: #000;
      padding: 3em 2em;
    ">
      <h1 style="font-size: 2.5rem;">CIM Proprietary Technologies</h1>
      <div class="tech-intro-container">
        <div class="tech-description">
          <p>TungTough™ and TungHard™ are specially formulated tungsten carbide overlay (WCO) applied using Plasma Transfer Arc (PTA) welding process. The WCO hardfacing overlays contain 60-70% tungsten carbide within NiBSi or NiCrBSi matrix, offering an optimal balance of exceptional wear resistance and toughness. This unique combination makes WCO the preferred choice for extreme wear applications. </p>
          <p>TungCast™ and TitanCast™ are exclusively CIM products renowned for their exceptional toughness, durability, and wear resistance. With tungsten carbide or titanium carbide metallurgically bonded into chrome white iron, these materials combine the strength of the base metal with the hardness of the carbides, excelling in high-impact applications.</p>
          <p>DuraPlate™ is a composite Chrome Carbide Overlay (CCO) manufactured using a specialized automatic welding process (modified sub-arc welding). A proprietary post-weld heat treatment ensures a smooth surface and free of welding beads and check cracks. CIM CCO overlay can be produced up to 19 mm thick in a single pass and a maximum thickness of 25 mm. </p>
          <p>CIMSiC™ is a high-performance silicon carbide ceramic known for its outstanding corrosion, erosion, and thermal shock resistance. CIM offers three types of ceramic solutions: Nitride Bonded SiC (NBSC), Reaction Bonded SiC (RBSC), and resin-bonded SiC, tailored to meet various application needs. </p>
          <p>CIMTiC™ is sintered titanium carbide (TiC) designed for seamless integration with iron or steel through the cast-in process. Its excellent wettability with steel enables metallurgical bonding during casting, eliminating residual stress issues commonly associated with brazing. </p>
        </div>

        <div class="tech-image-container">
          <p>
          <?php if ($header_image_url): ?>
            <?php if ($header_link): ?>
              <a href="<?php echo esc_url($header_link); ?>" target="_blank">
                <img src="<?php echo esc_url($header_image_url); ?>" alt="CIM Technologies" class="tech-header-image">
              </a>
            <?php else: ?>
              <img src="<?php echo esc_url($header_image_url); ?>" alt="CIM Technologies" class="tech-header-image">
            <?php endif; ?>
          <?php else: ?>
            <div class="placeholder-image">Technology Image</div>
          <?php endif; ?>
          </p>
        </div>
      </div>
    </div>
  </section>

  <!-- Technology Articles Section -->
  <section id="technology-articles" class="tech-articles-section">
    <div class="container">

      <div class="technology-grid">
        <?php
        $args = array(
          'post_type' => 'technology',
          'posts_per_page' => -1,
          'orderby' => 'title',
          'order' => 'ASC'
        );

        $technology_query = new WP_Query($args);

        if ($technology_query->have_posts()):
          while ($technology_query->have_posts()):
            $technology_query->the_post();
            // Get background color
            $bg_color = get_post_meta(get_the_ID(), '_technology_bg_color', true);
            if (empty($bg_color)) {
              $bg_color = '#4a4a4a'; // Default color
            }
            ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('technology-item'); ?>>
              <div class="technology-content" style="background-color: <?php echo esc_attr($bg_color); ?>">
                <?php if (has_post_thumbnail()): ?>
                  <div class="technology-thumbnail">
                    <?php the_post_thumbnail('medium_large'); ?>
                  </div>
                <?php endif; ?>

                <div class="technology-text">
                  <h3 class="technology-title"><?php the_title(); ?></h3>
                  <div class="technology-description">
                    <?php the_content(); ?>
                  </div>
                </div>
              </div>
            </article>
            <?php
          endwhile;
          wp_reset_postdata();
        else:
          ?>
          <div class="no-technologies">
            <p><?php _e('No technologies found. Please add some technology posts.', 'cim'); ?></p>
          </div>
          <?php
        endif;
        ?>
      </div>
    </div>
  </section>
</main>

<!-- Styles are loaded from external CSS file -->

<?php get_footer(); ?>
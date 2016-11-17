<?php
/**
 * The template for displaying Category News
 */

get_header(); ?>

<div class="row articles-navigation">
  <div class="col-md-12 articles-navigation__area">
    <?php wp_nav_menu(array('theme_location' => 'articles-menu')); ?>
  </div><!-- articles-navigation__area -->
    <div class="articles-navigation__social-area-subscribe">
      <?php pll_e('Stay informed'); ?> 
      <a href="<?php bloginfo('wpurl'); ?>/index.php?page_id=<?php pll_e('Subscribe-Button-URL'); ?>" class="button button-blue button-social-area-subscribe">
      <?php pll_e('Subscribe-Button'); ?>
      </a>
    </div><!-- articles-navigation__social-area -->
</div><!-- row -->
<div id="article-anchor"></div>

<div class="row search-component search-component-top">
	<div class="container">
		<div class="col-md-2">
		</div>
		<div class="col-md-8">
			<?php get_template_part( 'custom-search' ); ?>
		</div>
	</div><!-- container -->
</div><!-- search-component -->


<?php
  /* Start the Loop.
   *
   * In Twenty Ten we use the same loop in multiple contexts.
   * It is broken into three main parts: when we're displaying
   * posts that are in the gallery category, when we're displaying
   * posts in the asides category, and finally all other posts.
   *
   * Additionally, we sometimes check for whether we are on an
   * archive page, a search page, etc., allowing for small differences
   * in the loop on each template without actually duplicating
   * the rest of the loop that is shared.
   *
   * Without further ado, the loop:
   */ ?>
<div class="row articles-documents">
  <div class="container">
    <div class="col-md-12">
      <h2 class="page-title">  
        <?php pll_e('News'); ?>
      </h2>
      <?php $i = 0; ?>      
      <?php while ( have_posts() ) : the_post();
            $i++;
          ?>
            <?php if ($i == 5) { ?>

            <?php } else {
              } ?>
        <div class="row article-documents__box">
          <div class="col-md-2 article-documents__date">
            <a href="<?php the_permalink(); ?>#article-anchor">
              <?php the_time('j.m.Y'); ?>
            </a>
          </div><!-- cols -->
          <div class="col-md-10">
            <div class="article-documents__subtitle">
              <a href="<?php the_permalink(); ?>#article-anchor">
                <?php the_field('post_subtitle'); ?>
              </a>
            </div><!-- article-documents__date -->
            <h3 class="article-documents__title">
              <a href="<?php the_permalink(); ?>#article-anchor">
                <?php the_title(); ?>
              </a>
            </h3>
            <div class="news__lead">
            <?php if(get_field('featured_text')) : ?>
              <?php echo the_field('featured_text'); ?>
            <?php else: ?>
              <?php echo excerpt(30); ?>
              <?php endif ?>
              <a href="<?php the_permalink(); ?>#article-anchor" class="news__link">
                <?php pll_e('Read more'); ?>
              </a>
            </div><!-- photos-lead -->
          </div><!-- cols -->

        </div><!-- row -->
      <?php endwhile; // End the loop. Whew. ?>
      <div class="col-md-12 pagination-area">
        <?php wp_pagenavi(); ?>
      </div><!-- pagination-area -->
    </div><!-- col -->
  </div><!-- container -->
</div><!-- row -->
<?php get_footer(); ?>

<?php
/**
 * Template Name: Articles
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


<div class="row search-component search-component-top">
	<div class="container">
		<div class="col-md-2">
		</div>
		<div class="col-md-8">
			<?php get_template_part( 'custom-search' ); ?>
		</div>
	</div><!-- container -->
</div><!-- search-component -->



<div class="row articles articles-subpage">
  <div class="container">
    <div class="col-md-12">
      <h2 class="page-title">  
        <?php pll_e('All Articles'); ?>!
      </h2>
        <?php
        $results = custom_search();
        $i = 0;
//          query_posts(array('post_type' => 'post', 'posts_per_page' => -1));
//          if($results->have_posts()) :
//            while($results->have_posts()) : $results->the_post();
//            query_posts(array('post_type' => 'post', 'posts_per_page' => -1));
            if(have_posts()) :
              while(have_posts()) : the_post();
            $i++;
          ?>
            <?php if ($i == 5) { ?>

            <?php } else {
              } ?>
            <div class="row homepage__announcements-box">
              <div class="col-md-3 homepage__announcements-date">
                <?php the_time('j. F Y') ?>
              </div><!-- homepage__announcements-date -->
              <div class="col-md-9 homepage__announcements-content">
                <div class="homepage__announcements-subtitle">
                  <a href="<?php the_permalink(); ?>#article-anchor">
                    <?php the_field('post_subtitle'); ?>
                  </a>
                </div><!-- homepage__announcements-subtitle -->
                <h3 class="homepage__announcements-title">
                  <a href="<?php the_permalink(); ?>#article-anchor">
                    <?php the_title(); ?>
                  </a>
                </h3>
                <?php if ( has_post_thumbnail() ) : ?>
                  <div class="homepage__announcements-detail-link  homepage__announcements-thumb">
                    <a href="<?php the_permalink(); ?>#article-anchor" title="<?php the_title_attribute(); ?>">
                        <?php the_post_thumbnail('icon-articles'); ?>
                    </a>
                  </div>
                <?php endif; ?>
                <div class="homepage__announcements-excerpt"><!-- homepage__announcements-excerpt-link -->
                <a href="<?php the_permalink(); ?>/#article-anchor">
            <?php if(get_field('featured_text')) : ?>
              <?php echo the_field('featured_text'); ?>
            <?php else: ?>
              <?php echo excerpt(30); ?>
              <?php endif ?>
                </a>
                <!-- <style="homepage__announcements-detail-link"> -->
                <div>
                <a href="<?php the_permalink(); ?>#article-anchor" class="news__link">
                  <?php pll_e('Read more'); ?>    
                </a>
                </div>
                </div>                
              </div><!-- homepage__announcements-content -->
            </div><!-- row -->
        <?php
          endwhile;
?>
      <div class="col-md-12 pagination-area">
        <?php wp_pagenavi(); ?>
      </div><!-- pagination-area -->
<?php
          endif;
          wp_reset_query();
        ?>
    </div><!-- cols -->
  </div><!-- container -->
</div><!-- row -->

<?php get_footer(); ?>

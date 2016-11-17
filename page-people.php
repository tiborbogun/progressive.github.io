<?php
/**
 * Template Name: People
 */

get_header(); ?>

<div class="row articles-navigation">
  <div class="col-md-12 articles-navigation__area">
    <?php wp_nav_menu(array('theme_location' => 'network-menu')); ?>
  </div><!-- articles-navigation__area -->
      <div class="articles-navigation__social-area">
      <?php pll_e('Facebook Share People'); ?>
      <?php
      $title=urlencode('Progressive Alliance');
      $url=urlencode('http://beta.progressive-alliance.info/network/people');
      $summary=urlencode('http://beta.progressive-alliance.info/network/people');
      $image=urlencode('http://beta.progressive-alliance.info/wp-content/uploads/2016/08/Sergei-Stanishev-portrait.jpg');
      ?>
      <a onClick="window.open('http://www.facebook.com/sharer.php?s=100&amp;p[title]=<?php echo $title;?>&amp;p[summary]=<?php echo $summary;?>&amp;p[url]=<?php echo $url; ?>&amp;p[images][0]=<?php echo $image;?>','sharer','toolbar=0,status=0,width=548,height=325');" href="javascript: void(0)" class="articles-navigation__share-btn">
        <img src="<?php bloginfo('template_url'); ?>/images/icons/facebook-icon.png" alt="Share on facebook" />
      </a>
    </div><!-- articles-navigation__social-area -->  
</div><!-- row -->

<div id="article-anchor"></div>
<div class="row network">
  <div class="container">
    <div class="col-md-12 people">
      <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
        <h2 class="page-title"><?php the_field('people_page_title'); ?></h2>
        <div class="people__lead">
          <?php the_content(); ?>
        </div><!-- people__lead -->
      <?php endwhile; // end of the loop. ?>
    </div><!-- col -->

    <div class="people_boxes">
     <?php
        query_posts(array('post_type' => 'people_type', 'posts_per_page' => -1));
        if(have_posts()) :
          while(have_posts()) : the_post();
        ?>
        <div class="col-md-4 people__box">
		          <div class="people__box-image">
							<?php if ( get_field( 'hide_active_link' ) ): ?>
									<?php the_post_thumbnail('icon-people-small'); ?>
							<?php else: ?>
								<a href="<?php the_permalink(); ?>#people-anchor">
									<?php the_post_thumbnail('icon-people-small'); ?>
								</a>
							<?php endif; ?>
		          </div><!-- people__box-image -->
		          <h3 class="people__box-name">
								<?php if ( get_field( 'hide_active_link' ) ): ?>
										<?php the_title(); ?>
								<?php else: ?>
									<a href="<?php the_permalink(); ?>#people-anchor">
										<?php the_title(); ?>
									</a>
								<?php endif; ?>
		          </h3>
		          <div class="people__box-description">
								<?php if ( get_field( 'hide_active_link' ) ): ?>
										<?php $summary = get_field('people_short_description'); echo substr($summary, 0, 200); ?> ...
								<?php else: ?>
									<a href="<?php the_permalink(); ?>#people-anchor">
										<?php $summary = get_field('people_short_description'); echo substr($summary, 0, 200); ?> ...
									</a>
								<?php endif; ?>
		          </div><!-- people__box-description -->
								<?php if ( get_field( 'hide_active_link' ) ): ?>

								<?php else: ?>
								<a href="<?php the_permalink(); ?>#people-anchor" class="button button-transparent"><!-- people__box-button -->
									<?php pll_e('Read more'); ?>
								</a>
								<?php endif; ?>
        </div><!-- people_box -->
      <?php
        endwhile;
        endif;
        wp_reset_query();
      ?>

    </div><!-- people_boxes -->
  </div><!-- container -->
</div><!-- row -->

<?php include('component-featured.php'); ?>

<?php get_footer(); ?>

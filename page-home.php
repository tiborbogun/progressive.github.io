<?php
/**
 * Template Name: Homepage
 */

get_header(); ?>

<div class="row homepage-social">
  <div class="col-md-12 articles-navigation__area">
  </div><!-- articles-navigation__area -->
    <div class="articles-navigation__social-area">
      <?php pll_e('Facebook Like'); ?> 
      <?php the_field('like_us_button_code', 223); ?>
    </div><!-- articles-navigation__social-area -->
</div><!-- row -->

<div class="row homepage__boxes">
  <div class="container">
    <div class="col-md-12">
      <h2 class="homepage__boxes-headline">  
       <?php pll_e('Welcome to the Progressive Alliance'); ?>
      </h2>
    </div><!-- cols -->
      <?php
        query_posts(array('post_type' => 'boxes', 'posts_per_page' => 3));
        if(have_posts()) :
          while(have_posts()) : the_post();
        ?>
          <div class="col-md-4">
            <h3 class="homepage__boxes-single-box">
            <?php if(get_field('internal_link')) : ?>
              <a href="<?php echo the_field('internal_link'); ?>">
            <?php else: ?>
              <a href="<?php the_permalink(); ?>#article-anchor">
              <?php endif ?>
                <?php the_title(); ?>
              </a>
            </h3>


						<div class="homepage__boxes-image">
            <?php if (get_field('internal_link')) : ?>
              <a href="<?php echo the_field ('internal_link'); ?>">
            <?php endif ?>
							<img src="<?php the_field('boxes-homepage-image');?>" alt="" />
              </a>
						</div>


            <div class="homepage__boxes-text">
              <a href="<?php the_permalink(); ?>#article-anchor">
            <?php echo excerpt(50); ?>
              </a> 
            </div><!-- homepage__boxes-text-->

            <!-- <div class="homepage__boxes-text">
            <?php if(get_field('internal_link')) : ?>
                <a href="<?php echo the_field('internal_link'); ?>#article-anchor">
              <?php else: ?>
                <a href="<?php the_permalink(); ?>#article-anchor">
              <?php endif ?>
            <?php echo custom_field_excerpt(); ?>
                </a>
            </div> --><!-- homepage__boxes-text See Function: Custom Field Excerpt -->

            <div class="homepage__boxes-link">
              <?php if(get_field('internal_link')) : ?>
                <a href="<?php echo the_field('internal_link'); ?>" class="button button-transparent">
              <?php else: ?>
                <a href="<?php the_permalink(); ?>#article-anchor" class="button button-transparent">
              <?php endif ?>
              <?php pll_e('Read more'); ?>
              </a>
            </div><!-- homepage__boxes-link -->
          </div>
      <?php
        endwhile;
        endif;
        wp_reset_query();
      ?>


<!-- Hier die Upcoming Events rein <div class="col-md-4"></div> -->

</div>

  <!-- container -->

</div><!-- row -->

<div class="row homepage__announcements">
  <div class="container">
    <div class="col-md-12">
      <div class="row homepage__announcements-headline">
        <div class="col-md-6">
          <h2 class="homepage__announcements-headline-text">  
            <?php pll_e('News'); ?>
          </h2>
        </div><!-- cols -->
        <div class="col-md-6 text-right homepage__announcement-notifyer">
          <?php pll_e('Stay informed'); ?>
           <a href="<?php bloginfo('wpurl'); ?>/index.php?page_id=<?php pll_e('Subscribe-Button-URL'); ?>" class="button button-blue homepage__announcement-notifyer-btn">
            <?php pll_e('Subscribe-Button'); ?>
           </a>
        </div><!-- cols -->
      </div><!-- row -->
        <?php
          query_posts(array('post_type' => 'post', 'posts_per_page' => 4));
          if(have_posts()) :
            while(have_posts()) : the_post();
          ?>
          <div class="row homepage__announcements-box">
            <div class="col-md-3 homepage__announcements-date">
              <?php the_time('j. F Y') ?>
            </div><!-- homepage__announcements-date -->
            <div class="col-md-9 homepage__announcements-content">
              <div class="homepage__announcements-subtitle">
                <a href="<?php the_permalink(); ?>">
                  <?php the_field('post_subtitle'); ?>
                </a>
              </div><!-- homepage__announcements-subtitle -->
              <h3 class="homepage__announcements-title">
                <a href="<?php the_permalink(); ?>/#article-anchor">
                  <?php the_title(); ?>
                </a>
              </h3>
              <?php if ( has_post_thumbnail() ) : ?>
                <div class="homepage__announcements-detail-link homepage__announcements-thumb">
                  <a href="<?php the_permalink(); ?>/#article-anchor" title="<?php the_title_attribute(); ?>">
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
                <!-- </div> -->
              </div>
            </div><!-- homepage__announcements-content -->

          </div><!-- row -->
        <?php
          endwhile;
          endif;
          wp_reset_query();
        ?>
    </div>
        <div class="col-md-12 homepage__announcements-read-more" >
      <a href="<?php bloginfo('wpurl'); ?>/index.php?page_id=<?php pll_e('Read More Archive Link'); ?>" class="button button-blue">
        <?php pll_e('Read more'); ?>
      </a>
    </div><!-- cols -->
  </div><!-- container -->
</div><!-- row -->



<div class="row network-page">
	<div class="container">




        <?php
            query_posts(array('post_type' => 'teaser-network-hp', 'posts_per_page' => 1));
            if(have_posts()) :
              while(have_posts()) : the_post();
            ?>
            <div class="col-md-12 teaser__box-network">
              <div class="teaser__title">
                <?php the_field('teaser_title'); ?>
              </div><!-- teaser-title NEW -->
              <div class="teaser__text">
                <?php the_field('teaser_text'); ?>
              </div><!-- teaser__text -->         
            </div><!-- teaser_box -->
          <?php
            endwhile;
            endif;
            wp_reset_query();
      ?>




      <!-- network-page__content -->
			<div class="row network-page__people">
		    <?php
		        query_posts(array('post_type' => 'people_type', 'posts_per_page' => 3, 'orderby' => 'rand'));
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
								<a href="<?php the_permalink(); ?>#people-anchor" class="button button-transparent people__box-button">
									<?php pll_e('Read more'); ?>
								</a>
								<?php endif; ?>
		        </div><!-- people_box -->
		      <?php
		        endwhile;
		        endif;
		        wp_reset_query();
          ?>
      <!-- col -->
			</div><!-- network-page__people -->		

    <div class="col-md-12 homepage__announcements-read-more" >
          <a href="<?php bloginfo('wpurl'); ?>/?page_id=<?php pll_e('Page People'); ?>#people-anchor" class="button button-blue network-page__people-button" >
          <?php pll_e('Meet them all'); ?>
          </a>
    </div>


<!-- Meet them all -->
      </div><!-- cols -->

  </div><!-- container -->
</div><!-- network-page -->

<div class="row teasers">
	<div class="container">
		<div class="col-md-12">
		    <?php
		        query_posts(array('post_type' => 'teaser-box', 'posts_per_page' => 3));
		        if(have_posts()) :
		          while(have_posts()) : the_post();
		        ?>
		        <div class="col-md-12 teaser__box">
<!-- 							<div class="teaser__title">
								<?php the_title(); ?>
							</div> --><!-- teaser-title -->
              <div class="teaser__title">
                <?php the_field('teaser_title'); ?>
              </div><!-- teaser-title NEW -->
							<div class="teaser__text">
								<?php the_field('teaser_text'); ?>
							</div><!-- teaser__text -->			    
							<div>
              <a href="<?php the_field('link_to'); ?>" class="button button-transparent people__box-button">
								<?php pll_e('Read more'); ?>
							</a>
              </div>
		        </div><!-- teaser_box -->
		      <?php
		        endwhile;
		        endif;
		        wp_reset_query();
      ?>
	    </div><!-- col -->
	</div><!-- container -->
</div><!-- teasers -->

<?php include('component-featured.php'); ?>

<?php get_footer(); ?>

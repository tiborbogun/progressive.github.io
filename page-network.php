<?php
/**
 * Template Name: Network
 */

get_header(); ?>

<div class="row articles-navigation">
  <div class="col-md-12 articles-navigation__area">
    <?php wp_nav_menu(array('theme_location' => 'network-menu')); ?>
  </div><!-- articles-navigation__area -->
  <div class="articles-navigation__social-area">
	  <?php pll_e('Facebook Like'); ?>
		<?php the_field('like_us_button_code', 223); ?>
  </div><!-- articles-navigation__social-area -->
</div><!-- row -->

<div id="article-anchor"></div>
<div class="row network-page__banner" style="background: url('<?php the_field('network_banner_image'); ?>') no-repeat 
<?php $values = get_field( 'banner_x-position_in_percent' );
if ( $values ) {
    the_field('banner_x-position_in_percent');
} else {
    echo '50';
}
?>%
<?php $values2 = get_field( 'banner_y-position_in_percent' );
if ( $values2 ) {
    the_field('banner_y-position_in_percent');
} else {
    echo '50';
}
?>%
 / cover;">
  <div class="container" >
		<div class="col-md-2">
		</div><!-- cols -->
		<div class="col-md-8 network-page__banner-content">
			<div class="network-page__banner-title">
				<?php the_field('networ_banner_name'); ?>
			</div><!-- network-page__banner-title -->
			<div class="network-page__banner-function">
				<?php the_field('network_banner_second_line'); ?>
			</div><!-- network-page__banner-function -->
			<?php if( get_field('network_banner_external_link_url') ) { ?>
				<a href="<?php the_field('network_banner_external_link_url'); ?>" class=" button button-red">
					<?php pll_e('More about'); ?> <?php the_field('network_text_on_banner_button'); ?>
				</a>
				<?php } else { ?>
					<a href="<?php the_field('banner_button_link'); ?>" class=" button button-red">
					<?php pll_e('More about'); ?> <?php the_field('network_text_on_banner_button'); ?>
					</a>
			<?php } ?>
			
		</div><!-- network-page__banner-content -->
		<div class="col-md-2">
		</div><!-- cols -->
  </div><!-- container-->
</div><!-- row -->

<div class="row network-page">
	<div class="container">
			<div class="col-md-12 teaser__box-network">
				<h2 class="network-page__title">
				<?php the_field('network_npeople_title'); ?>
				</h2>
			<div class="teaser__text">
				<?php the_field('network_people_description'); ?>
			</div>
	</div>

		<!-- <div class="col-md-12"> -->
				
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
<!-- cols -->
	</div><!-- container -->
</div><!-- network-page -->

<div class="row our-mission">
	<div class="container">
		<div class="col-md-12">
			<h2 class="network-page__title">
				<?php the_field('our_mission_title'); ?>
			</h2>
			<div class="network-page__content">
				<?php the_field('our_mission_description'); ?>
			</div><!-- network-page__content -->
		</div><!-- cols -->
	</div><!-- container -->
</div><!-- network-page -->

<div class="row teasers">
	<div class="container">
		<div class="col-md-12">
		    <?php
		        query_posts(array('post_type' => 'teaser-network-box', 'posts_per_page' => 3));
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
							<a href="<?php the_field('link_to'); ?>" class="button button-transparent people__box-button">
								<?php pll_e('Read more'); ?>
							</a>
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

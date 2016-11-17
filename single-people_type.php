<?php
/**
 * The Template for displaying Single people
 */

get_header(); ?>

<div class="row articles-navigation">
  <div class="col-md-12 articles-navigation__area">
    <?php wp_nav_menu(array('theme_location' => 'network-menu')); ?>
  </div><!-- articles-navigation__area -->
        <div class="articles-navigation__social-area">

            <?php
      // $title=urlencode('');
      $url=urlencode(get_permalink($post->ID));
      $summary=urlencode(get_field('people_short_description'));
      // $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "icon-people-big" );
      // $image=urlencode($thumbnail_src[0]);
      $image=urlencode('');
      ?>

      <a onClick="window.open('http://www.facebook.com/sharer.php?s=100&amp;p[title]=<?php echo $title;?>&amp;p[summary]=<?php echo $summary;?>&amp;p[url]=<?php echo $url; ?>&amp;&p[images][0]=<?php echo $image;?>', 'sharer', 'toolbar=0,status=0,width=548,height=325');" target="_parent" href="javascript: void(0)" class="">
        <span class="articles-navigation__social-area-inline"><?php pll_e('Share'); ?> <?php the_title(); ?>'s <?php pll_e('on facebook'); ?></span>
        </a>
      <a onClick="window.open('http://www.facebook.com/sharer.php?s=100&amp;p[title]=<?php echo $title;?>&amp;p[summary]=<?php echo $summary;?>&amp;p[url]=<?php echo $url; ?>&amp;&p[images][0]=<?php echo $image;?>', 'sharer', 'toolbar=0,status=0,width=548,height=325');" target="_parent" href="javascript: void(0)" class="articles-navigation__share-btn">
        <img src="<?php bloginfo('template_url'); ?>/images/icons/facebook-icon.png" alt="Share on facebook" class="articles-navigation__facebook-share"/>
      </a>
    </div><!-- articles-navigation__social-area -->  
</div><!-- row -->

<div id="people-anchor"></div>

<div class="row single-people">
  <div class="container">
  	<div class="col-md-12">
    	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
 				<div class="row single-people__image">
 					<div class="col-md-2">
 					</div><!-- cols -->
 					<div class="col-md-8">
		    		<h1 class="single-people__title">
		    			<?php the_title(); ?>
		    		</h1>
		    		<div class="single-people__function">
		    			<?php the_field('people_function'); ?>
		    		</div><!-- single-people__function -->
 						<?php the_post_thumbnail('icon-people-big'); ?>
            <?php if (get_field('people_copyright')) : ?>
 						<div class="single-post-thumb__copyright">
 							© <?php the_field('people_copyright'); ?>
 						</div>
            <?php endif ?><!-- single-people__copyright -->
 					</div><!-- cols -->
 					<div class="col-md-2">
 					</div><!-- cols -->
 				</div><!--single-people__image -->
 				<div class="row">
 					<div class="col-md-6 single-people__description">
 						<div class="single-people__description-nam">
 							<?php the_title(); ?>
 						</div><!-- single-people__description-nam -->
 						<?php the_field('people_short_description'); ?>
 					</div><!-- single-people__description -->
 					<div class="col-md-6">
 					</div><!-- cols -->
 				</div><!-- row -->
 				<div class="row single-people__content">
 					<div class="col-md-2">
 					</div><!-- cols -->
 					<div class="col-md-8">
						<?php the_content(); ?>
 					</div><!-- cols -->
 					<div class="col-md-2">
 					</div><!-- cols -->
 				</div><!--single-people__content -->
			<?php endwhile; // end of the loop. ?>
		</div><!-- cols -->
  </div><!-- container --> 
</div><!-- row -->

<?php include('component-featured.php'); ?>
<?php get_footer(); ?>

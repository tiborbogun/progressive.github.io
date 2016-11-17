<?php
/**
 * The Template for displaying Single partner
 */

get_header(); ?>

<div class="row articles-navigation">
  <div class="col-md-12 articles-navigation__area">
    <?php wp_nav_menu(array('theme_location' => 'network-menu')); ?>
  </div><!-- articles-navigation__area -->
</div><!-- row -->

<div id="people-anchor"></div>
<div class="row single-partner">
  <div class="container">
  	<div class="col-md-12">
    	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
 				<div class="row single-partner__image">
 					<div class="col-md-2">
 					</div><!-- cols -->
 					<div class="col-md-8">
		    		<h1 class="single-partner__title">
		    			<?php the_title(); ?>
		    		</h1>
		    		<div class="single-partner__logotype">
 							<?php the_post_thumbnail('icon-people-big'); ?>
 						</div><!--single-partner__logotype -->
 					</div><!-- cols -->
 					<div class="col-md-2">
 					</div><!-- cols -->
 				</div><!--single-partner__image -->
 				<div class="row single-partner__content">
 					<div class="col-md-2">
 					</div><!-- cols -->
 					<div class="col-md-8">
						<?php the_content(); ?>
 					</div><!-- cols -->
 					<div class="col-md-2">
 					</div><!-- cols -->
 				</div><!--single-partner__content -->
			<?php endwhile; // end of the loop. ?>
		</div><!-- cols -->
  </div><!-- container --> 
</div><!-- row -->

<?php include('component-featured.php'); ?>
<?php get_footer(); ?>

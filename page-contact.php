<?php
/**
 * Template Name: Contact page
 */

get_header(); ?>

<div class="row articles-navigation">
  <div class="col-md-12 articles-navigation__area">
    <?php wp_nav_menu(array('theme_location' => 'contact-menu')); ?>
  </div><!-- articles-navigation__area -->
</div><!-- row -->

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

<div class="row contact">
  <div class="container">
  	<div class="col-md-12">
  		<h2 class=" col-md-12 page-title">
  			<?php the_title(); ?>
  		</h2>
  		<div class="col-md-6 contact__address">
  			<?php the_content(); ?>
  		</div><!-- contact__address -->
  		<div class="col-md-6 contact__form">
  			<?php $contact_form = get_field('contact_shortcode');
				echo do_shortcode( $contact_form ); ?>
  		</div><!-- contact__form -->
  		<div class="col-md-12 contact__map">
  			<?php the_field('mapa_google'); ?>
  		</div><!-- contact__map -->
		</div><!-- cols -->
  </div><!-- container --> 
</div><!-- row -->

<?php endwhile; // end of the loop. ?>

<?php get_footer(); ?>

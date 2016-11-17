<?php
/**
 * Template Name: E-mail Subscription
 */

get_header(); ?>

<div class="row articles-navigation">
  <div class="col-md-12 articles-navigation__area" style="height:29px;">
      <?php wp_nav_menu(array('theme_location' => 'subscribe-menu')); ?>
  </div><!-- articles-navigation__area -->
</div><!-- row -->


<div class="row contact">
  <div class="container">
  	<div class="col-md-12">
      <?php
      get_template_part( 'loop', 'page' );
      ?>
		</div><!-- cols -->
  </div><!-- container --> 
</div><!-- row -->


<?php get_footer(); ?>
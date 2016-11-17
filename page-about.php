<?php
/**
 * Template Name: About
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

<div class="row network">
  <div class="container">
  <div class="col-md-12">
  <div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10 about">
      <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
        <h2 class="page-title"><?php the_title(); ?></h2>
        <div class="about__content">
          <?php the_content(); ?>
        </div><!-- people__lead -->
      <?php endwhile; // end of the loop. ?>
    </div>
    </div><!-- col -->
  </div><!-- container -->
</div><!-- row -->

<?php include('component-featured.php'); ?>

<?php get_footer(); ?>

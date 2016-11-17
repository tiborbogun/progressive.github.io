<?php
/**
 * The template for displaying all pages.
 */

get_header(); ?>

<!-- FB-Script -->
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/de_DE/sdk.js#xfbml=1&version=v2.8&appId=582077768479186";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<!-- END FB-Script -->


<div class="row articles-navigation">
  <div class="col-md-12 articles-navigation__area">
    <?php wp_nav_menu(array('theme_location' => 'network-menu')); ?>
  </div><!-- articles-navigation__area -->
  <div class="articles-navigation__social-area">
     <div class="fb-like" data-href="http://www.progressive-alliance.info" data-layout="button_count" data-action="like" data-size="large" data-show-faces="true" data-share="true"></div>
  </div><!-- articles-navigation__social-area -->
</div><!-- row -->


<div class="row network">
  <div class="container">
    <div class="col-md-12 participants">
      <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
        <h2 class="page-title"><?php the_title(); ?></h2>
        <div class="about__content">
          <?php the_content(); ?>
        </div><!-- people__lead -->
      <?php endwhile; // end of the loop. ?>
    </div><!-- col -->
  </div><!-- container -->
</div><!-- row -->

<?php include('component-featured.php'); ?>

<?php get_footer(); ?>

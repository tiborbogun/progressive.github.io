<?php
/**
 * Template Name: Partners
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
    <div class="col-md-12 partners">
      <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
        <h2 class="page-title"><?php the_title(); ?></h2>
        <div class="people__lead">
          <?php the_content(); ?>
        </div><!-- people__lead -->
      <?php endwhile; // end of the loop. ?>
    </div><!-- col -->

    <div class="partner_boxes">
     <?php
        query_posts(array('post_type' => 'partner_type', 'posts_per_page' => -1));
        if(have_posts()) :
          while(have_posts()) : the_post();
        ?>
        <div class="col-md-4 partner__box">
          <div class="people__box-image">
            <a href="<?php the_permalink(); ?>#people-anchor"><?php the_post_thumbnail('icon-people-small'); ?></a>
          </div><!-- people__box-image -->
          <h3 class="partner__box-name">
            <a href="<?php the_permalink(); ?>#people-anchor"><?php the_title(); ?></a>
          </h3>
          <div class="partner__box-description">
            <a href="<?php the_permalink(); ?>#people-anchor"><?php echo excerpt(30); ?></a>
          </div><!-- people__box-description -->
          <a href="<?php the_permalink(); ?>#people-anchor" class="button button-transparent people__box-button">
            <?php pll_e('Read more'); ?>
          </a>
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

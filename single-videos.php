<?php
/**
 * The Template for displaying Single Video (en)
 */

get_header(); ?>

<div class="row articles-navigation">
  <div class="col-md-12 articles-navigation__area">
    <?php wp_nav_menu(array('theme_location' => 'articles-menu')); ?>
  </div><!-- articles-navigation__area -->
    <div class="articles-navigation__social-area-subscribe">
      <?php pll_e('Stay informed'); ?> 
      <a href="<?php bloginfo('wpurl'); ?>/index.php?page_id=<?php pll_e('Subscribe-Button-URL'); ?>" class="button button-blue button-social-area-subscribe">
      <?php pll_e('Subscribe-Button'); ?>
      </a>
    </div><!-- articles-navigation__social-area --><!-- articles-navigation__social-area -->
</div><!-- row -->

<div id="article-anchor"></div>
<div class="row single-article">
  <div class="container">
    <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
      <div class="row">
        <div class="col-md-8 single-post">
          <div class="single-post__subheader">
            <?php the_field('post_subtitle'); ?>
          </div><!-- single-post__subheader -->
          <h1 class="single-post__title"><?php the_title(); ?></h1>
          <div class="single-post__featured">
            <?php the_field('featured_text'); ?>
          </div><!-- single-post__featured -->
        </div><!-- col -->
        <div class="col-md-4">
        </div><!-- cols -->
      </div><!-- row -->
      <div class="row">
        <div class="col-md-8 single-post">
          <div class="single-post__date">
            <?php pll_e('PUBLISHED ON'); ?>  <?php the_time('F j, Y'); ?><?php edit_post_link('&nbsp;&nbsp;|&nbsp;&nbsp;edit', '', ''); ?>
            <div class="single-post__print-btn">
              <?php if(function_exists('wp_print')) { print_link(); } ?>
            </div><!-- single-post__print-btn -->
            <?php echo recommend_a_friend_link( $permalink, $image_url, $text_link ); ?>
          </div><!-- single-post__date -->
					<div class="single-post-thumb">
						<?php the_post_thumbnail('medium'); ?>
            <?php if (get_field('image_copyright')) : ?>
              <span class="single-post-thumb__copyright">
                @ <?php the_field('image_copyright'); ?>
              </span>
            <?php endif ?>
					</div><!-- single-post-thumb -->
          <div class="single-post__content">
            <?php the_content(); ?>
          </div><!-- single-post__content -->
            <?php
              if( have_rows('article_videos') ):
                  while ( have_rows('article_videos') ) : the_row(); ?>
                    <div class="row single-video">
                      <div class="col-md-12">
                        <?php the_sub_field('video_movie'); ?>
                      </div><!-- col -->
                    </div><!-- single-video -->
                  <?php endwhile;
                else :
              endif;
          endwhile; // end of the loop. ?>
        </div><!-- cols -->
        <div class="col-md-4 sidebar">
          <?php dynamic_sidebar('sidebar'); ?>
        </div><!-- cols -->
      </div><!-- row -->
  </div><!-- container --> 
</div><!-- row -->

<?php include('component-featured.php'); ?>

<?php get_footer(); ?>

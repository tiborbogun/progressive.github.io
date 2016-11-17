<?php
/**
  * The Template for displaying Single boxes
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

<div class="single-article">
  <div class="container">
  <div class="row">
    <div class="col-md-8">
      <h2 class="page-title"><?php the_title(); ?></h2>
    </div>
  <div class="col-md-8">
    <div>
      <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
        <div class="about__content">
          <?php the_content(); ?>
        </div><!-- people__lead -->
      <?php endwhile; // end of the loop. ?>
    </div>
    <div class="">
        <?php if( have_rows('post_documents') ):
                    while ( have_rows('post_documents') ) : the_row(); ?>
                      <div class="single-post__document-box">
                        <div class="row">
                          <div class="col-md-8 single-post__document-name">
                           <?php the_sub_field('document_name'); ?>
                          </div><!-- col -->
                          <div class="col-md-4">
                            <a href="<?php the_sub_field('document_file'); ?>" class="button button-blue single-post__download-button">
                              <?php pll_e('Download'); ?> 
                              <span>
                                <img src="<?php bloginfo('template_url'); ?>/images/icons/download-02.svg" alt="download" />
                              </span>                            
                            </a>
                          </div><!-- col -->
                        </div><!-- row -->
                      </div><!-- single__post-document-box -->
                    <?php endwhile;
                  else :
                endif; // end of the loop.
              ?> 
    </div>
  </div>
  <div class="col-md-4 related-articles">
    <?php 
      $posts = get_field('infobox_links');

      if( $posts ): ?>
        <h3 class="widget-title"><?php pll_e('Read this'); ?></h3>  
          <?php foreach( $posts as $post): // variable must be called $post (IMPORTANT) ?>
              <?php setup_postdata($post); ?>
                          <div class="col-md-12 related-articles__box">
                <div class="related-articles__subtitle">
                  <?php the_field('post_subtitle'); ?>
                </div><!-- related-articles__subtitle -->
                <div class="related-articles__title">
                  <a href="<?php the_permalink(); ?>">
                    <?php the_title(); ?>
                  </a>
                </div><!-- related-articles__title -->
          <div class="realated-articles__excerpt">
                <a href="<?php the_permalink(); ?>/#article-anchor">
            <?php if(get_field('featured_text')) : ?>
              <?php echo the_field('featured_text'); ?>
            <?php else: ?>
              <?php $content = get_the_excerpt(); echo substr($content, 0, 100); ?> ...
              <?php endif ?>
                </a>
          </div><!-- realated-articles__excerpt -->
              </div>
                  
          <?php endforeach; ?>
          <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
      <?php endif; ?>
      </div>
    </div><!-- cols -->
  </div><!-- container -->
</div><!-- row -->

<?php include('component-featured.php'); ?>

<?php get_footer(); ?>

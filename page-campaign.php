<?php
/**
 * Template Name: Campaign
 */

get_header(); ?>

<div class="row articles-navigation">
  <div class="col-md-12 articles-navigation__area">
    <?php wp_nav_menu(array('theme_location' => 'campaign-menu')); ?>
  </div><!-- articles-navigation__area -->
    <div class="articles-navigation__social-area">
      <?php pll_e('Facebook Share Campaign'); ?>
      <?php
      $title=urlencode('Progressive Alianze');
      $url=urlencode('http://progressive.akradev.vdl.pl/?page_id=20');
      $summary=urlencode('International trade and mobility of capital created economic growth and newly emerging economies are a promise to many people around the world. However, most of the world’s population is not seeing their lives improving as a result of economic growth, technological advances and globalization. Inequality is on the rise.');
      $image=urlencode('http://progressive.akradev.vdl.pl/wp-content/uploads/2016/07/campaign.jpg');
      ?>
      <a onClick="window.open('http://www.facebook.com/sharer.php?s=100&amp;p[title]=<?php echo $title;?>&amp;p[summary]=<?php echo $summary;?>&amp;p[url]=<?php echo $url; ?>&amp;p[images][0]=<?php echo $image;?>','sharer','toolbar=0,status=0,width=548,height=325');" href="javascript: void(0)" class="articles-navigation__share-btn">
        <img src="<?php bloginfo('template_url'); ?>/images/icons/facebook-icon.png" alt="Share on facebook" />
      </a>
    </div><!-- articles-navigation__social-area -->
</div><!-- row -->


<div class="row">
  <div class="col-md-12 campaign__banner">
    <img src="<?php the_field('campaign_image'); ?>" alt="Campaign">
  </div><!-- campaign__banner -->
</div><!-- row -->


<div class="row campaign">
  <div class="container">
    <div class="col-md-12 campaign">
      <div class="row">
        <div class="col-md-1">
        </div><!-- col -->
        <div class="col-md-10">
          <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
            <div class="campaign__subtitle">
              <?php the_field('campaign_subtitle'); ?>
            </div><!-- campaign__subtitle -->
            <h2 class="page-title campaign__title"><?php the_field('campaign_title'); ?></h2>
              <?php the_content(); ?>

            <div class="campaign__participate">
                <h3 class="page-subtitle">
                  <?php pll_e('Participate'); ?>
                </h3>
                        <div class="campaign__participate-box">
                          <a href="/campaign/banners-and-assets" class="button button-blue">
                            <?php pll_e('Download Campaign Banners'); ?>
                          </a>
                        </div><!-- campaign__participate-box -->
            </div><!-- campaign__participate -->

            <div class="campaign__documents">
              <?php if( get_field('documents') ): ?>
                <h3 class="page-subtitle">
                  <?php pll_e('Download'); ?>
                </h3>
                <?php
                  if( have_rows('documents') ):
                      while ( have_rows('documents') ) : the_row(); ?>
                        <div class="single-post__document-box">
                          <div class="row">
                            <div class="col-md-8 single-post__document-name">
                             <?php the_sub_field('campaign_document_name'); ?>
                            </div><!-- col -->
                            <div class="col-md-4">
                              <a href="<?php the_sub_field('campaign_document_file'); ?>" class="button button-blue single-post__download-button">
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
                  endif;
                ?>
              <?php endif; ?>
            </div><!-- campaign__documents -->


          <?php endwhile; // end of the loop. ?>
        </div><!-- col -->
        <div class="col-md-2">
        </div><!-- col -->
      </div><!-- row -->
    </div><!-- col -->
  </div><!-- container -->
</div><!-- row -->
<?php get_footer(); ?>
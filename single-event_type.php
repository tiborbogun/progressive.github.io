<?php
/**
 * The Template for displaying all Single event
 */

get_header(); ?>

<div class="row articles-navigation">
  <div class="col-md-12 articles-navigation__area">
    <?php wp_nav_menu(array('theme_location' => 'event-menu')); ?>
  </div><!-- articles-navigation__area -->
</div><!-- row -->

<div class="row single-article">
  <div class="container">
    <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
      <div class="row">
        <div class="col-md-8 single-post">
          <div class="single-post__subheader">
            <?php the_field('event_subtitle'); ?>
          </div><!-- single-post__subheader -->
          <h1 class="single-post__title"><?php the_title(); ?></h1>
        </div><!-- col -->
        <div class="col-md-4">
        </div><!-- cols -->
      </div><!-- row -->
      <div class="row">
        <div class="col-md-8 single-post">
          <div class="single-event__date">
            DATE: 
            <span> 
              <?php if( get_field('event_end_date') ) { 
                  $startdate = get_field('event_start_day', false, false);
                  $startdate = new DateTime($startdate);
                  $enddate = get_field('event_end_date', false, false);
                  $enddate = new DateTime($enddate); 
                  $onedaydate = get_field('event_start_day', false, false);
                  $onedaydate = new DateTime($onedaydate);
                  echo $startdate->format('j.');
                  echo '-';
                  echo $enddate->format('j.m.Y');
                  } else { 
                    $startdate = get_field('event_start_day', false, false);
                    $startdate = new DateTime($startdate);
                    echo $startdate->format('j.m.Y'); 
                  } ?>
            </span>
            <div class="single-post__print-btn">
              <?php if(function_exists('wp_print')) { print_link(); } ?>
            </div><!-- single-post__print-btn -->
          <?php echo recommend_a_friend_link( $permalink, $image_url, $text_link ); ?>
          </div><!-- single-post__date -->
          <div class="single-event__content">
            <?php the_content(); ?>
          </div><!-- single-event__content -->
          <div class="single-event__documents">
            <?php
              if( have_rows('event_documents') ): ?>
                  <h3 class="single-event__section-title">
                    <?php pll_e('Documents'); ?>
                  </h3>
                  <?php while ( have_rows('event_documents') ) : the_row(); ?>
                    <div class="single-post__document-box">
                      <div class="row">
                        <div class="col-md-8 single-post__document-name">
                         <?php the_sub_field('event_document_name'); ?>
                        </div><!-- col -->
                        <div class="col-md-4">
                          <a href="<?php the_sub_field('event_document_file'); ?>" class="button button-blue single-post__download-button">
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
        </div><!-- class="single-event__documents -->
        <div class="single-event__photos">
            <?php
              if( have_rows('event_photos') ): ?>
                  <h3 class="single-event__section-title">
                    <?php pll_e('Photos'); ?>
                  </h3>
                  <?php while ( have_rows('event_photos') ) : the_row(); ?>
                    <?php
                    $image_id = get_sub_field('event_image');
                    $image_size = 'icon-photo-single';
                    $image_size2 = 'full';
                    $image_array = wp_get_attachment_image_src($image_id, $image_size);
                    $image_full = wp_get_attachment_image_src($image_id, $image_size2);
                    $image_url = $image_array[0];
                    ?>
                    <div class="col-sm-4 col-md-4 single-photo__image">
                      <a href="<?php echo $image_full[0]; ?>" rel="lightbox">
                        <img src="<?php echo $image_url; ?>" alt="<?php the_sub_field('photo_name'); ?>" />
                      </a>
                    </div><!-- col-md-4 -->

                  <?php endwhile;
                else :
              endif;
            ?>
        </div><!-- single-event__photos -->
        <div class="single-event__videos">
            <?php
              if( have_rows('video') ): ?>
                  <h3 class="single-event__section-title">
                    <?php pll_e('Videos'); ?>
                  </h3>
                  <?php while ( have_rows('video') ) : the_row(); ?>
                      <div class="col-md-12">
                        <?php the_sub_field('video_code'); ?>
                      </div><!-- col -->
                  <?php endwhile;
                else :
              endif;
            endwhile; // end of the loop. ?>
        </div><!-- single-event__videos -->
        </div><!-- cols -->
        <div class="col-md-4 sidebar">
          <?php dynamic_sidebar('sidebar'); ?>
        </div><!-- cols -->
      </div><!-- row -->
  </div><!-- container --> 
</div><!-- row -->

<?php include('component-featured.php'); ?>

<?php get_footer(); ?>

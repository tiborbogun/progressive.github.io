<?php
/*
Plugin Name: Related articles
Plugin URI: http://akra.net
Description: Widget displays upcomming events for progressive theme
Author: Akra Polska
Version: 1
Author URI: http://akra.net
*/


class RelatedArticles extends WP_Widget
{
  function RelatedArticles()
  {
    $widget_ops = array('classname' => 'RelatedArticles', 'description' => 'Displays related 4 articles' );
    $this->WP_Widget('RelatedArticles', 'Related articles', $widget_ops);
  }
 
  function form($instance)
  {
    $instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
    $title = $instance['title'];
?>
  <p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>
<?php
  }
 
  function update($new_instance, $old_instance)
  {
    $instance = $old_instance;
    $instance['title'] = $new_instance['title'];
    return $instance;
  }
 
  function widget($args, $instance)
  {
    extract($args, EXTR_SKIP);
 
    echo $before_widget;
    $title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
 
    if (!empty($title))
      echo $before_title . $title . $after_title;; ?>
 
<!--     // WIDGET CODE GOES HERE -->
    <div class="related-articles">  
      <?php
        query_posts(array('post_type' => 'post', 'posts_per_page' => 4, 'post__not_in' => array( get_the_ID()) ));
        if(have_posts()) :
          while(have_posts()) : the_post();
        ?>
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


      <?php
        endwhile;
        endif;
        wp_reset_query();
      ?>
    </div><!-- upcoming-event -->

    <?php echo $after_widget; ?>
 <?php  }
 
}
add_action( 'widgets_init', create_function('', 'return register_widget("RelatedArticles");') );?>

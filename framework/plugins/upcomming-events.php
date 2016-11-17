<?php

/*
Plugin Name: Upcomming evcents
Plugin URI: http://akra.net
Description: Widget displays upcomming events for progressive theme
Author: Akra Polska
Version: 1
Author URI: http://akra.net
*/


class UpcommingEvents extends WP_Widget
{
    private $upcomingEvents;

    function UpcommingEvents()
    {
        $widget_ops = array('classname' => 'UpcommingEvents', 'description' => 'Displays upcoming events');
        $this->WP_Widget('UpcommingEvents', 'Upcoming events', $widget_ops);
    }

    function form($instance)
    {
        $instance = wp_parse_args((array)$instance, array('title' => ''));
        $title    = $instance['title'];
        ?>
        <p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat"
                                                                                  id="<?php echo $this->get_field_id(
                                                                                      'title'
                                                                                  ); ?>"
                                                                                  name="<?php echo $this->get_field_name(
                                                                                      'title'
                                                                                  ); ?>" type="text"
                                                                                  value="<?php echo attribute_escape(
                                                                                      $title
                                                                                  ); ?>"/></label></p>
        <?php
    }

    function update($new_instance, $old_instance)
    {
        $instance          = $old_instance;
        $instance['title'] = $new_instance['title'];

        return $instance;
    }

    function widget($args, $instance)
    {
        extract($args, EXTR_SKIP);

        $from = new DateTime();
        $to   = clone $from;
        $to->modify('+12 months');
        $this->upcomingEvents = eventsFromDateRange($from, $to, 4);

        echo $before_widget;
        $title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);

        if ( ! empty($title)) {
            echo $before_title.$title.$after_title;
        }; ?>

        <!--     // WIDGET CODE GOES HERE -->
        <div class="upcoming-event">
            <?php
            if ($this->upcomingEvents->have_posts()) :
                while ($this->upcomingEvents->have_posts()) : $this->upcomingEvents->the_post();
                    ?>
                    <div class="col-md-12 upcoming-events__box">
                        <div class="upcoming-events__month">
                            <?php
                            $eventId = get_the_ID();
                            $monthDate = new DateTime(get_post_meta($eventId, 'event_start_day', true));
                            echo $monthDate->format('F Y')
                            ?>
                        </div>
                        <!-- upcoming-event__month -->
                        <div class="upcoming-events__tile">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_title(); ?>
                            </a>
                        </div>
                        <!-- upcoming-event__tile -->
                        <div class="upcoming-events__date">
                            <?php
                            $eventId = get_the_ID();
                            $startDate = new DateTime(get_post_meta($eventId, 'event_start_day', true));
                            $eventEnd  = get_post_meta($eventId, 'event_end_date', true);
                            if ( ! empty($eventEnd)) {
                                $endDate = new DateTime($eventEnd);
                                echo $startDate->format('j.');
                                echo '-';
                                echo $endDate->format('j. F');
                            } else {
                                echo $startDate->format('j. F');
                            } ?>
                        </div>
                        <!-- upcoming-events__date -->
                    </div><!-- cols -->
                    <?php
                endwhile;
            endif;
            wp_reset_query();
            ?>
        </div><!-- upcoming-event -->

        <?php echo $after_widget; ?>
        <?php
    }

}

add_action('widgets_init', create_function('', 'return register_widget("UpcommingEvents");'));
?>
<?php
/**
 * Template Name: Events
 */

get_header(); ?>

<div class="row articles-navigation">
    <div class="col-md-12 articles-navigation__area">
        <?php wp_nav_menu(array('theme_location' => 'event-menu')); ?>
    </div>
    <!-- articles-navigation__area -->
    <div class="articles-navigation__social-area">
      <?php pll_e('Facebook Share Events'); ?>
      <?php
      $title=urlencode('Progressive Alianze');
      $url=urlencode('http://progressive.akradev.vdl.pl/events/');
      $summary=urlencode('International trade and mobility of capital created economic growth and newly emerging economies are a promise to many people around the world. However, most of the world’s population is not seeing their lives improving as a result of economic growth, technological advances and globalization. Inequality is on the rise.');
      $image=urlencode('http://progressive.akradev.vdl.pl/wp-content/uploads/2016/07/event1-715x247.jpg');
      ?>
      <a onClick="window.open('http://www.facebook.com/sharer.php?s=100&amp;p[title]=<?php echo $title;?>&amp;p[summary]=<?php echo $summary;?>&amp;p[url]=<?php echo $url; ?>&amp;p[images][0]=<?php echo $image;?>','sharer','toolbar=0,status=0,width=548,height=325');" href="javascript: void(0)" class="articles-navigation__share-btn">
        <img src="<?php bloginfo('template_url'); ?>/images/icons/facebook-icon.png" alt="Share on facebook" />
      </a>
    </div><!-- articles-navigation__social-area -->
</div><!-- row -->

<div id="article-anchor"></div>
<div class="row events">
<div class="past-events">
    <div class="container">
        <div class="col-md-12">
            <h2 class="events__title">
                <?php pll_e('Upcoming'); ?>
            </h2>
            <?php
            $monthsWithEvents = monthsWithEvents();
            if ( ! empty($monthsWithEvents)){
            foreach ($monthsWithEvents as $monthWithEvents) {
            $from = new DateTime($monthWithEvents->month);
            $to   = clone $from;
            $to->modify('+1 month');
            $events = eventsFromDateRange($from, $to);

            if (have_posts()):
            ?>
            <div class="row events__label">
                <div class="col-md-12">
                    <?php echo date_i18n('F Y', strtotime($monthWithEvents->month)); ?>
                </div>
                <!-- col -->
            </div>
            <!-- network-page__label -->
            <div class="events__current-list">
                <?php
                while ($events->have_posts()):
                    $events->the_post();
                    ?>
                    <div class="row events__box">
                        <div class="col-md-3 events__date">
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
                        <div class="col-md-9 events__content">
                            <a href="<?php the_permalink(); ?>" class="events__subtitle">
                                <?php the_field('event_subtitle'); ?>
                            </a>
                            <a href="<?php the_permalink(); ?>" class="events__title-link">
                                <h2 class="events__title">
                                    <?php the_title(); ?>
                                </h2>
                            </a>

                            <div class="events__thumbnail">
                                <?php if (has_post_thumbnail()) : ?>
                                    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                        <?php the_post_thumbnail('icon-event'); ?>
                                    </a>
                                <?php endif; ?>
                            </div>
                            <!-- events__thumbnail -->
                            <p>
                                <?php echo excerpt(23); ?>
                                <a href="<?php the_permalink(); ?>" class="events__read-more">
                                    <?php pll_e('Read more'); ?>
                                </a>
                            </p>
                        </div>
                    </div>
                    <?php
                endwhile;
                endif;
                wp_reset_postdata();
                }
                }
                ?>
            </div>
            <!-- events__current-list -->
        </div>
        <!-- col -->
    </div>
    <!-- container -->
</div>
<!-- events-page -->

<div class="row">
    <div class="container">
        <div class="col-md-12">
            <h2 class="events__title">
                <?php pll_e('Review: Past Events'); ?>
            </h2>

            <div class="past-events__current-list">
                <?php
                $yearsWithEvents = yearsWithEvents();
                if ( ! empty($yearsWithEvents)) {
                    $currentDay = new DateTime();
                    foreach ($yearsWithEvents as $yearWithEvents) {
                        ?>
                        <div class="row events__label">
                            <div class="col-md-12">
                                <?php
                                echo($yearWithEvents->year);
                                ?>
                            </div>
                            <!-- col -->
                        </div>
                        <!-- network-page__label -->
                        <?php
                        $fromYear = new DateTime();
                        $fromYear->setDate($yearWithEvents->year, 1, 1);
                        $toYear = null;
                        if ($currentDay->format('Y') === $yearWithEvents->year) {
                            $toYear = $currentDay;
                        } else {
                            $toYear = clone $fromYear;
                            $toYear->setDate($fromYear->format('Y'), 12, 31);
                        }
                        $eventsFromYear = eventsFromDateRange($fromYear, $toYear);
                        if ($eventsFromYear->have_posts()) :
                            while ($eventsFromYear->have_posts()) : $eventsFromYear->the_post();
                                ?>
                                <div class="row past-events__box">
                                    <div class="col-md-3 past-events__date">
                                        <?php
                                        $eventId = get_the_ID();
                                        $startDate = new DateTime(get_post_meta($eventId, 'event_start_day', true));
                                        $eventEnd  = get_post_meta($eventId, 'event_end_date', true);
                                        if ( ! empty($eventEnd)) {
                                            $endDate = new DateTime(
                                                $eventEnd
                                            );
                                            echo $startDate->format('j.');
                                            echo '-';
                                            echo $endDate->format('j.m.Y');
                                        } else {
                                            echo $startDate->format('j.m.Y');
                                        } ?>
                                    </div>
                                    <!-- events__date-->

                                    <div class="col-md-9 past-events__content">
                                        <a href="<?php the_permalink(); ?>" class="events__subtitle">
                                            <?php the_field('event_subtitle'); ?>
                                        </a>
                                        <a href="<?php the_permalink(); ?>" class="events__title-link">
                                            <h2 class="past-events__title">
                                                <?php the_title(); ?>
                                            </h2>
                                        </a>

                                        <p>
                                            <?php echo excerpt(23); ?>
                                            <a href="<?php the_permalink(); ?>" class="events__read-more">
                                                <?php pll_e('Read more'); ?>
                                            </a>
                                        </p>
                                    </div>
                                    <!-- events__content -->
                                </div><!-- row -->
                                <?php
                            endwhile;
                        endif;
                        wp_reset_postdata();
                    }

                }
                query_posts(array('post_type' => 'event_type', 'posts_per_page' => -1));
                if ( ! have_posts()) :
                    while (have_posts()) : the_post();
                        ?>
                        <div class="row past-events__box">
                            <div class="col-md-3 past-events__date">
                                <?php if (get_field('event_end_date')) {
                                    $startDate = get_field('event_start_day', false, false);
                                    $startDate = new DateTime($startDate);
                                    $endDate   = get_field('event_end_date', false, false);
                                    $endDate   = new DateTime($endDate);
                                    echo $startDate->format('j.');
                                    echo '-';
                                    echo $endDate->format('j.m.Y');
                                } else {
                                    echo $startDate->format('j.m.Y');
                                } ?>
                            </div>
                            <!-- events__date-->

                            <div class="col-md-9 past-events__content">
                                <a href="<?php the_permalink(); ?>" class="events__subtitle">
                                    <?php the_field('event_subtitle'); ?>
                                </a>
                                <a href="<?php the_permalink(); ?>" class="events__title-link">
                                    <h2 class="past-events__title">
                                        <?php the_title(); ?>
                                    </h2>
                                </a>

                                <p>
                                    <?php echo excerpt(23); ?>
                                    <a href="<?php the_permalink(); ?>" class="events__read-more">
                                        <?php pll_e('Read more'); ?>
                                    </a>
                                </p>
                            </div>
                            <!-- events__content -->
                        </div><!-- row -->
                        <?php
                    endwhile;
                endif;
                wp_reset_query();
                ?>
            </div>
            <!-- events__current-list -->
        </div>
        <!-- col -->
    </div>
    <!-- container -->
</div>
</div>
<!-- past-events -->
</div>
<?php include('component-featured.php'); ?>

<?php get_footer(); ?>

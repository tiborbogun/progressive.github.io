<div class="row component-featured">
	<div class="container">
		<div class="col-md-12 teaser__title">
			<?php dynamic_sidebar('component-featured'); ?>
		</div><!-- component-featured__headline -->
		<div class="col-md-4 component-featured__program">
			<h4 class="component-featured__title">
				<a href="<?php bloginfo('wpurl'); ?>/?page_id=<?php pll_e('Page People'); ?>#article-anchor"><?php pll_e('Teaser Footer People'); ?> 
			</h4>
			<?php
			  query_posts(array('post_type' => 'people_type', 'posts_per_page' => 1, 'orderby' => 'rand'));
			  if(have_posts()) :
			    while(have_posts()) : the_post();
			  ?>
			  	<div class="component-featured__thumbnail">
			    	<a href="<?php the_permalink(); ?>#people-anchor"><?php the_post_thumbnail('icon-people-small'); ?></a>
					</div><!--component-featured__thumbnail -->

				<div class="component-featured__subtitle">
					<a href="<?php the_permalink(); ?>#people-anchor"><?php the_title(); ?></a>
					</div><!-- component-featured__title -->

				<div class="featured__box-lead">
					<a href="<?php the_permalink(); ?>#people-anchor">
						<?php $summary = get_field('people_short_description'); echo substr($summary, 0, 200); ?> ...
					</a>
					</div><!-- component-featured__lead -->
	
			    <a href="<?php the_permalink(); ?>#people-anchor" class="button button-transparent people__box-button">
			      <?php pll_e('Read more'); ?>
			    </a>
			<?php
			  endwhile;
			  endif;
			  wp_reset_query();
			?>
		</div><!-- component-featured__people -->
		<div class="col-md-4 component-featured__partner">
			<h4 class="component-featured__title">
				<a href="<?php bloginfo('wpurl'); ?>/?page_id=<?php pll_e('Page Partner'); ?>#article-anchor"><?php pll_e('Teaser Footer Partners'); ?></a>
			</h4>
			<?php
			  query_posts(array('post_type' => 'partner_type', 'posts_per_page' => 1, 'orderby' => 'rand'));
			  if(have_posts()) :
			    while(have_posts()) : the_post();
			  ?>
			  	<div class="component-featured__thumbnail">
			    	<a href="<?php the_permalink(); ?>#people-anchor"><?php the_post_thumbnail('icon-people-small'); ?></a>
					</div><!--component-featured__thumbnail -->

				<div class="component-featured__subtitle">
					<a href="<?php the_permalink(); ?>#people-anchor"><?php the_title(); ?></a>
					</div><!-- component-featured__title -->

				<div class="featured__box-lead">
					<a href="<?php the_permalink(); ?>#people-anchor"><?php $content = get_the_excerpt(); echo substr($content, 0, 200); ?> ...</a>
					</div><!-- component-featured__lead -->
	
					<a href="<?php the_permalink(); ?>#people-anchor" class="button button-transparent people__box-button">
			    	<?php pll_e('Read more'); ?></a>
			<?php
			  endwhile;
			  endif;
			  wp_reset_query();
			?>
		</div><!-- component-featured__partner -->
		<div class="col-md-4 component-featured__campaign">
			<h4 class="component-featured__title">
				<a href="<?php bloginfo('wpurl'); ?>/?page_id=<?php pll_e('Page Campaign'); ?>"><?php pll_e('Teaser Footer Campaign'); ?></a>
			</h4>
			<?php
		    $your_query = new WP_Query( 'pagename=campaign' );
		    while ( $your_query->have_posts() ) : $your_query->the_post(); ?>
			  	<div class="component-featured__thumbnail">
			    	<a href="<?php bloginfo('wpurl'); ?>/?page_id=<?php pll_e('Page Campaign'); ?>"><?php the_post_thumbnail('icon-people-small'); ?></a>
					</div><!--component-featured__thumbnail -->

				<div class="component-featured__subtitle">
					<a href="<?php bloginfo('wpurl'); ?>/?page_id=<?php pll_e('Page Campaign'); ?>"><?php the_title(); ?></a>
					</div><!-- component-featured__title -->

				<div class="featured__box-lead">
					<a href="<?php bloginfo('wpurl'); ?>/?page_id=<?php pll_e('Page Campaign'); ?>"><?php $content = get_the_excerpt(); echo substr($content, 0, 200); ?> ...</a>
					</div><!-- component-featured__lead -->
	
			    <a href="<?php bloginfo('wpurl'); ?>/?page_id=<?php pll_e('Page Campaign'); ?>" class="button button-transparent people__box-button">
			      <?php pll_e('Read more'); ?>
			    </a>
		    <?php endwhile;
		    wp_reset_postdata();
			?>
		</div><!-- component-featured__program -->
	</div><!-- container -->
</div><!-- component-featured -->
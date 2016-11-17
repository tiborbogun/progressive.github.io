<?php
/**
 * The template for displaying Search Results pages.
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
    </div><!-- articles-navigation__social-area -->
</div><!-- row -->
<div class="row search-component search-component-top">
	<div class="container">
		<div class="col-md-2">
		</div>
		<div class="col-md-8">
			<?php get_template_part( 'custom-search' ); ?>
		</div>
	</div><!-- container -->
</div><!-- search-component -->

<div class="row search-results search-results--list">
  <div class="container">
    <div class="col-md-12">
			<?php if ( have_posts() ) : ?>
				<?php get_template_part( 'loop', 'search' );
							?>
			<?php else : ?>
				<div id="post-0" class="post no-results not-found">
					<h2 class="entry-title"><?php pll_e('Nothing Found'); ?></h2>
					<div class="entry-content">
						<p><?php pll_e('Sorry nothing matched'); ?><!-- <?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'psd2wp' ); ?> --></p>
						<!-- <?php get_search_form(); ?> -->
					</div><!-- .entry-content -->
				</div><!-- #post-0 -->
			<?php endif; ?>
    </div><!-- col -->
  </div><!-- container -->
</div><!-- row -->

<?php include('component-featured.php'); ?>

<?php get_footer(); ?>

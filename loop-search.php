<?php
/**
 * The loop that displays posts.
 */
?>


<?php /* If there are no posts to display, such as an empty archive page */ ?>
<?php if ( ! have_posts() ) : ?>
	<div id="post-0" class="post error404 not-found">
		<h1 class="entry-title"><?php _e( 'Not Found', 'progressive' ); ?></h1>
		<div class="entry-content">
			<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'progressive' ); ?></p>
			<?php get_search_form(); ?>
		</div><!-- .entry-content -->
	</div><!-- #post-0 -->
<?php endif; ?>

<?php
	/* Start the Loop.
	 *
	 * In Twenty Ten we use the same loop in multiple contexts.
	 * It is broken into three main parts: when we're displaying
	 * posts that are in the gallery category, when we're displaying
	 * posts in the asides category, and finally all other posts.
	 *
	 * Additionally, we sometimes check for whether we are on an
	 * archive page, a search page, etc., allowing for small differences
	 * in the loop on each template without actually duplicating
	 * the rest of the loop that is shared.
	 *
	 * Without further ado, the loop:
	 */ ?>
<?php while ( have_posts() ) : the_post(); ?>

<?php /* How to display posts of the Gallery format. The gallery category is the old way. */ ?>

	<?php if ( ( function_exists( 'get_post_format' ) && 'gallery' == get_post_format( $post->ID ) ) || in_category( _x( 'gallery', 'gallery category slug', 'progressive' ) ) ) : ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<h2 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>

			<div class="entry-content">
<?php if ( post_password_required() ) : ?>
				<?php the_content(); ?>
<?php else : ?>
				<?php
					$images = progressive_get_gallery_images();
					if ( $images ) :
						$total_images = count( $images );
						$image = array_shift( $images );
				?>
						<div class="gallery-thumb">
							<a class="size-thumbnail" href="<?php the_permalink(); ?>"><?php echo wp_get_attachment_image( $image, 'thumbnail' ); ?></a>
						</div><!-- .gallery-thumb -->
						<p><em><?php printf( _n( 'This gallery contains <a %1$s>%2$s photo</a>.', 'This gallery contains <a %1$s>%2$s photos</a>.', $total_images, 'progressive' ),
								'href="' . get_permalink() . '" title="' . esc_attr( sprintf( __( 'Permalink to %s', 'progressive' ), the_title_attribute( 'echo=0' ) ) ) . '" rel="bookmark"',
								number_format_i18n( $total_images )
							); ?></em></p>
				<?php endif; // end progressive_get_gallery_images() check ?>
						<?php the_excerpt(); ?>
<?php endif; ?>
			</div><!-- .entry-content -->
		</div><!-- #post-## -->

<?php /* How to display posts of the Aside format. The asides category is the old way. */ ?>

	<?php elseif ( ( function_exists( 'get_post_format' ) && 'aside' == get_post_format( $post->ID ) ) || in_category( _x( 'asides', 'asides category slug', 'progressive' ) )  ) : ?>

<?php /* How to display all other posts. */ ?>

	<?php else : ?>
            <div class="row homepage__announcements-box">
              <div class="col-md-3 homepage__announcements-date">
                <?php the_time('j. F Y') ?>
              </div><!-- homepage__announcements-date -->
              <div class="col-md-9 homepage__announcements-content">
                <div class="homepage__announcements-subtitle">
                  <a href="<?php the_permalink(); ?>#article-anchor">
                    <?php the_field('post_subtitle'); ?>
                  </a>
                </div><!-- homepage__announcements-subtitle -->
                <h3 class="homepage__announcements-title">
                  <a href="<?php the_permalink(); ?>#article-anchor">
                    <?php the_title(); ?>
                  </a>
                </h3>
                <?php if ( has_post_thumbnail() ) : ?>
                  <div class="homepage__announcements-detail-link  homepage__announcements-thumb">
                    <a href="<?php the_permalink(); ?>#article-anchor" title="<?php the_title_attribute(); ?>">
                        <?php the_post_thumbnail('icon-articles'); ?>
                    </a>
                  </div>
                <?php endif; ?>
                <div class="homepage__announcements-excerpt"><!-- homepage__announcements-excerpt-link -->
                <a href="<?php the_permalink(); ?>/#article-anchor">
            <?php if(get_field('featured_text')) : ?>
              <?php echo the_field('featured_text'); ?>
            <?php else: ?>
              <?php echo excerpt(30); ?>
              <?php endif ?>
                </a>
                <!-- <style="homepage__announcements-detail-link"> -->
                <div>
                <a href="<?php the_permalink(); ?>#article-anchor" class="news__link">
                  <?php pll_e('Read more'); ?>    
                </a>
                </div>
                
              </div><!-- homepage__announcements-content -->
            </div><!-- row -->
		</div><!-- #post-## -->

		

	<?php endif; // This was the if statement that broke the loop into three parts based on categories. ?>


<?php endwhile; // End the loop. Whew. ?>
<?php /* Display navigation to next/previous pages when applicable */ ?>
<?php if (  $wp_query->max_num_pages > 1 ) : ?>
	<div class="col-md-12 pagination-area">
        <?php wp_pagenavi(); ?>
      </div>
<?php endif; ?>

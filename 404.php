<?php
/**
 * The template for displaying 404 pages (Not Found).
 */

get_header(); ?>


<div class="row error-404">
  <div class="container">
    <div class="col-md-12">
				<h1 class="entry-title"><?php _e( 'Not Found', 'psd2wp' ); ?></h1>
				<p><?php _e( 'Apologies, but the page you requested could not be found. Perhaps searching will help to find. Yeah.', 'psd2wp' ); ?></p>
					<?php get_search_form(); ?>
    </div><!-- col -->
  </div><!-- container -->
</div><!-- row -->

<?php include('component-featured.php'); ?>



	<script type="text/javascript">
		// focus on search field after it has loaded
		document.getElementById('s') && document.getElementById('s').focus();
	</script>

<?php get_footer(); ?>
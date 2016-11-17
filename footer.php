<?php
/**
 * The template for displaying the footer.
 */
?>
	<footer class="footer">
    <div class="row">
      <div class="container">
        <div class="col-md-12 footer__content">
          <?php dynamic_sidebar('copyright'); ?><br>
          <a href="<?php bloginfo('wpurl'); ?>/index.php?page_id=605" class="button button-transparent footer__login-button">
                  Admin & Editors Login
                </a>
        </div><!-- footer__content -->
      </div><!-- container -->
    </div><!-- row -->
	</footer>

<?php
	/* Always have wp_footer() just before the closing </body>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to reference JavaScript files.
	 */

	wp_footer();
?>
</body>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/pl_PL/sdk.js#xfbml=1&version=v2.7&appId=460943067268084";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
</html>

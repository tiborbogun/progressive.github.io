<?php
/**
 * The Header for our theme.
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>

<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'psd2wp' ), max( $paged, $page ) );

	?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,300,700' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('template_url'); ?>/framework/css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('stylesheet_url'); ?>" />
<!-- <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('template_url'); ?>/framework/css/responsive-tablet.css" /> -->
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('template_url'); ?>/framework/css/responsive-mobile.css" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('template_url'); ?>/framework/inc/page-list/css/page-list.css" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
 <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
 <!--[if lt IE 9]>
	<script src="htdps://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
 <![endif]-->
<?php
	/* We add some JavaScript to pages with the comment form
	 * to support sites with threaded comments (when in use).
	 */
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	wp_head();
?>
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('template_url'); ?>/framework/css/flexslider.css" />
<script type="text/javascript">
   (function($) {
      $(window).load(function(){
      $('.header__homepage-slider').flexslider({
        animation: "fade",
		slideshowSpeed: 7000,
        start: function(slider){
          $('body').removeClass('loading');
        }
      });
    });
   })(jQuery);
</script>

</head>

<body <?php body_class(); ?>>

<!-- Facebook SDK -->
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.8&appId=256430984753923";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<!-- Facebook END-->

<header class="header">
  <?php if(is_home() || is_front_page() ) { ?>



      <div class="header__homepage-slider">
        <div class="flexslider">
          <ul class="slides">                
            <?php
              query_posts(array('post_type' => 'slides', 'posts_per_page' => 6));
              if(have_posts()) :
                while(have_posts()) : the_post();
              ?>
              <li style="background: url('<?php the_field('slides_image'); ?>') no-repeat 50% top / cover;" class="header__homepage-slider-element">
                <div class="header__homepage-slider-gradient"></div>
                <div class="header__homepage-slider-box">
                    <?php if (get_field('quotation')) : ?>
                      <h2 class="header__homepage-slider-title">»<?php the_field('quotation'); ?>«</h2>
                    <?php endif ?>
                  <h3 class="header__homepage-slider-subtitle"><?php the_field('slides_subtitles'); ?></h3>
                  <a href="<?php the_field('slides_link_to'); ?>#people-anchor" class="button header__homepage-slider-button" style="background-color: <?php the_field('slides_button_color'); ?>">
                    <?php pll_e('More about'); ?> <?php the_field('slides_button_text'); ?>
                  </a>
                </div><!-- header__homepage-slider-box -->
              </li>
            <?php
              endwhile;
              endif;
              wp_reset_query();
            ?>
          </ul>
        </div><!-- flex_slider -->
      </div><!-- header__homepage-slider -->



      <a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" class="header__logotype header__logotype--homepage"></a>
      <nav class="navigation navigation--homepage row">
        <div class="col-md-8 col-sm-7 navigation__menu">
          <?php wp_nav_menu(array('theme_location' => 'main-menu')); ?>
        </div><!-- navigation__menu -->
        <div class="col-md-4 col-md-5 text-right navigation__search">
          <div class="navigation__search-box">
            <?php get_search_form(); ?>
          </div><!-- navigation__search-box -->
          <div class="navigation__contact-menu">
            <?php wp_nav_menu(array('theme_location' => 'contact-menu')); ?>
            <div class="navigation__change-language">
              <?php dynamic_sidebar('change-language'); ?>
            </div><!-- navigation__change-language -->
          </div><!-- navigation__contact-menu -->
        </div><!-- navigation__search -->
      </nav>

    <?php } else { ?>
      <a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" class="header__logotype header__logotype--subpage"></a>
      <nav class="navigation navigation--subpage row">
        <div class="col-md-8 navigation__menu">
          <?php wp_nav_menu(array('theme_location' => 'main-menu')); ?>
        </div><!-- navigation__menu -->
        <div class="col-md-4 text-right navigation__search">
          <div class="navigation__search-box">
            <?php get_search_form(); ?>
          </div><!-- navigation__search-box -->
          <div class="navigation__contact-menu">
            <?php wp_nav_menu(array('theme_location' => 'contact-menu')); ?>
            <div class="navigation__change-language--subpage">
              <?php dynamic_sidebar('change-language'); ?>
            </div><!-- navigation__change-language -->
          </div><!-- navigation__contact-menu -->
        </div><!-- navigation__search -->
      </nav>


  <?php } ?>

  <div class="navigation__change-language--responsive">
    <?php dynamic_sidebar('change-language'); ?>
  </div><!-- navigation__change-language-responsive -->  
</header>
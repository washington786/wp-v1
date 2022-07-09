<?php
/**
 * Template Name: Simple Page 
 *
 * A custom page template which lacks several of the content elements.
 *
 */
//get_header();
 ?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<?php  cryout_meta_hook(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=<?php bloginfo( 'charset' ); ?>" />
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php
 	cryout_header_hook();
	wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<?php cryout_body_hook(); ?>

<div id="wrapper" class="hfeed">
<?php /* <div id="topbar" ><div id="topbar-inner"> <?php cryout_topbar_hook(); ?> </div></div> */ ?>
<?php cryout_wrapper_hook(); ?>

<div id="header-full">
	<header id="header">
		<div id="masthead">
		<?php cryout_masthead_hook(); ?>
			<div id="branding" role="banner" >
				<?php cryout_branding_hook();?>
				<?php cryout_header_widgets_hook(); ?>
				<div style="clear:both;"></div>
			</div><!-- #branding -->
			<a id="nav-toggle"><span>&nbsp;</span></a>
			<nav id="access" role="navigation">
				<?php // cryout_access_hook();?>
			</nav><!-- #access -->
			
			
		</div><!-- #masthead -->
	</header><!-- #header -->
</div><!-- #header-full -->

<div style="clear:both;height:0;"> </div>
<?php // cryout_breadcrumbs_hook();?>
<div id="main">
		<?php cryout_main_hook(); ?>
	<div  id="forbottom" >
		<?php cryout_forbottom_hook(); ?>

		<div style="clear:both;"> </div>
		<section id="container" class="one-column <?php //echo nirvana_get_layout_class(); ?>">

			<div id="content" role="main">
			<?php cryout_before_content_hook(); ?>

				<?php get_template_part( 'content/content', 'page'); ?>

			<?php cryout_after_content_hook(); ?>
			</div><!-- #content -->
			<?php //nirvana_get_sidebar(); ?>
		</section><!-- #container -->


<?php
// get_footer();
?>	<div style="clear:both;"></div>
	</div> <!-- #forbottom -->

	<footer id="footer" role="contentinfo">
		<div id="colophon">
		
			<?php //get_sidebar( 'footer' );?>
			
		</div><!-- #colophon -->

		<div id="footer2">
		
			<div id="footer2-inside">
			<?php cryout_footer_hook(); ?>
			</div> <!-- #footer2-inside -->
			
		</div><!-- #footer2 -->

	</footer><!-- #footer -->

	</div><!-- #main -->
</div><!-- #wrapper -->

<?php wp_footer(); ?>

</body>
</html>
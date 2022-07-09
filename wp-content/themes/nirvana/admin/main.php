<?php
// Frontend

require_once(get_template_directory() . "/admin/defaults.php");					// default options
require_once(get_template_directory() . "/admin/prototypes.php");				// prototype functions
require_once(get_template_directory() . "/includes/custom-styles.php");			// custom styling
require_once(get_template_directory() . "/admin/customizer.php");				// customizer hook

// Admin side
if ( is_admin() ) {
	require_once(get_template_directory() . "/admin/settings.php");				// theme settings
	require_once(get_template_directory() . "/admin/sanitize.php");				// settings sanitizers
	include(get_template_directory() . "/admin/schemes.php");					// preset color schemes
$nirvana_cleanup_warnings = array ( 'scripts' => 0, 'styles' => 0, 'keys' => array() );
}

/**
 * Import/export functionality is part of the companion Theme Settings plugin 
 */

// Get the theme options and make sure defaults are used if no values are set
function nirvana_get_theme_options() {
	$optionsNirvana = wp_parse_args(
		get_option( 'nirvana_settings', array() ),
		nirvana_get_option_defaults()
	);
	$optionsNirvana['id'] = "nirvana_settings";
	return $optionsNirvana;
}

// load up theme options
$nirvanas = nirvana_get_theme_options();

// Hooks/Filters
//add_action('admin_init', 'nirvana_init_fn' ); // hooked by settings plugin
add_action('admin_menu', 'nirvana_add_page_fn');
add_action('init', 'nirvana_init');

// Register and enqueue all scripts and styles for the init hook
function nirvana_init() {
	// load text domain into the admin section
	load_theme_textdomain( 'nirvana', get_template_directory_uri() . '/languages' );
}

// Create the nirvana subpage
function nirvana_add_page_fn() {
	global $nirvana_page;
	$nirvana_page = add_theme_page('Nirvana Settings', 'Nirvana Settings', 'edit_theme_options', 'nirvana-page', 'nirvana_page_fn');
	add_action( 'admin_enqueue_scripts', 'nirvana_admin_scripts', 99 ); // try to enqueue as late as possible to intercept all other enqueues
}

// Add admin scripts
function nirvana_admin_scripts($hook) {
	global $nirvana_page;
	global $nirvana_cleanup_warnings;
    	global $nirvanas;
	$extensions = array();
	
	// bail if not right page
	if( $nirvana_page != $hook ) return;
	
	/* STYLES */

	wp_enqueue_style( 'jquery-ui-style', get_template_directory_uri() . '/js/jqueryui/css/ui-lightness/jquery-ui-1.8.16.custom.css', NULL, _CRYOUT_THEME_VERSION );
	wp_enqueue_style( 'nirvana-admin-style', get_template_directory_uri() . '/admin/css/admin.css', NULL, _CRYOUT_THEME_VERSION );

	/* SCRIPTS */
	// farbtastic color selector included in WP
	wp_enqueue_script('farbtastic');
	wp_enqueue_style( 'farbtastic' );

	// jQuery accordion and slider libraries included in WP
   	wp_enqueue_script('jquery-ui-accordion');
	wp_enqueue_script('jquery-ui-slider');
	wp_enqueue_script('jquery-ui-tooltip');
	
	// For backwards compatibility where Nirvana is installed on older versions of WP where the ui accordion and slider are not included
	if (!wp_script_is('jquery-ui-accordion',$list='registered')) {
		wp_enqueue_script('cryout_accordion', get_template_directory_uri() . '/admin/js/accordion-slider.js', array('jquery'), _CRYOUT_THEME_VERSION);
	}
    
	wp_enqueue_media();// WP uploader
	wp_enqueue_script('cryout-admin-js',get_template_directory_uri() . '/admin/js/admin.js', NULL, _CRYOUT_THEME_VERSION );
}

// Settings sections. All the referenced functions are found in admin-functions.php
function nirvana_init_fn(){

	register_setting('nirvana_settings', 'nirvana_settings', 'nirvana_settings_validate');

	do_action('nirvana_pre_settings_fields');

	/**************
	   sections
	**************/

	add_settings_section('layout_section', __('Layout Settings','nirvana'), 'cryout_section_placeholder_fn', 'nirvana-page');
	add_settings_section('header_section', __('Header Settings','nirvana'), 'cryout_section_placeholder_fn', 'nirvana-page');
	add_settings_section('presentation_section', __('Presentation Page','nirvana'), 'cryout_section_placeholder_fn', 'nirvana-page');
	add_settings_section('text_section', __('Text Settings','nirvana'), 'cryout_section_placeholder_fn', 'nirvana-page');
	add_settings_section('appearance_section',__('Color Settings','nirvana') , 'cryout_section_placeholder_fn', 'nirvana-page');
	add_settings_section('graphics_section', __('Graphics Settings','nirvana') , 'cryout_section_placeholder_fn', 'nirvana-page');
	add_settings_section('post_section', __('Post Information Settings','nirvana') , 'cryout_section_placeholder_fn', 'nirvana-page');
	add_settings_section('excerpt_section', __('Post Excerpt Settings','nirvana') , 'cryout_section_placeholder_fn', 'nirvana-page');
	add_settings_section('featured_section', __('Featured Image Settings','nirvana') , 'cryout_section_placeholder_fn', 'nirvana-page');
	add_settings_section('socials_section', __('Social Media Settings','nirvana') , 'cryout_section_placeholder_fn', 'nirvana-page');
	add_settings_section('misc_section', __('Miscellaneous Settings','nirvana') , 'cryout_section_placeholder_fn', 'nirvana-page');

	/*** layout ***/
	add_settings_field('nirvana_side', __('Main Layout','nirvana') , 'cryout_setting_side_fn', 'nirvana-page', 'layout_section');
	add_settings_field('nirvana_sidewidth', __('Content / Sidebar Width','nirvana') , 'cryout_setting_sidewidth_fn', 'nirvana-page', 'layout_section');
	add_settings_field('nirvana_contentmargins', __('Content Margins','nirvana') , 'cryout_setting_contentmargins_fn', 'nirvana-page', 'layout_section');
	add_settings_field('nirvana_duality', __('Duality','nirvana') , 'cryout_setting_duality_fn', 'nirvana-page', 'layout_section');
	add_settings_field('nirvana_magazinelayout', __('Magazine Layout','nirvana') , 'cryout_setting_magazinelayout_fn', 'nirvana-page', 'layout_section');
	add_settings_field('nirvana_mobile', __('Responsiveness','nirvana') , 'cryout_setting_mobile_fn', 'nirvana-page', 'layout_section');

	/*** presentation ***/
	add_settings_field('nirvana_frontpage', __('Enable Presentation Page','nirvana') , 'cryout_setting_frontpage_fn', 'nirvana-page', 'presentation_section');
	add_settings_field('nirvana_frontposts', __('Show Posts on Presentation Page','nirvana') , 'cryout_setting_frontposts_fn', 'nirvana-page', 'presentation_section');
	add_settings_field('nirvana_frontslider', __('Slider Settings','nirvana') , 'cryout_setting_frontslider_fn', 'nirvana-page', 'presentation_section');
	add_settings_field('nirvana_frontslider2', __('Slides','nirvana') , 'cryout_setting_frontslider2_fn', 'nirvana-page', 'presentation_section');
	add_settings_field('nirvana_frontcolumns', __('Columns','nirvana') , 'cryout_setting_frontcolumns_fn', 'nirvana-page', 'presentation_section');
	add_settings_field('nirvana_fronttext', __('Text Areas','nirvana') , 'cryout_setting_fronttext_fn', 'nirvana-page', 'presentation_section');
	add_settings_field('nirvana_frontextras', __('Extras','nirvana') , 'cryout_setting_frontextras_fn', 'nirvana-page', 'presentation_section');

	/*** header ***/
	add_settings_field('nirvana_hheight', __('Header Height','nirvana') , 'cryout_setting_hheight_fn', 'nirvana-page', 'header_section');
	add_settings_field('nirvana_himage', __('Header Image','nirvana') , 'cryout_setting_himage_fn', 'nirvana-page', 'header_section');
	add_settings_field('nirvana_siteheader', __('Site Header','nirvana') , 'cryout_setting_siteheader_fn', 'nirvana-page', 'header_section');
	add_settings_field('nirvana_logoupload', __('Custom Logo Upload','nirvana') , 'cryout_setting_logoupload_fn', 'nirvana-page', 'header_section');
	add_settings_field('nirvana_headermargin', __('Header Content Spacing','nirvana') , 'cryout_setting_headermargin_fn', 'nirvana-page', 'header_section');
	// favicon functionality removed @nirvana 1.6.0
	add_settings_field('nirvana_headerwidgetwidth', __('Header Widget Width','nirvana') , 'cryout_setting_headerwidgetwidth_fn', 'nirvana-page', 'header_section');

	/*** text ***/
	add_settings_field('nirvana_fontfamily', __('General Font','nirvana') , 'cryout_setting_fontfamily_fn', 'nirvana-page', 'text_section');
	add_settings_field('nirvana_fonttitle', __('Post Title Font ','nirvana') , 'cryout_setting_fonttitle_fn', 'nirvana-page', 'text_section');
	add_settings_field('nirvana_fontside', __('Widget Title Font','nirvana') , 'cryout_setting_fontside_fn', 'nirvana-page', 'text_section');
	add_settings_field('nirvana_fontwidget', __('Widget Font','nirvana') , 'cryout_setting_fontwidget_fn', 'nirvana-page', 'text_section');
	add_settings_field('nirvana_sitetitlefont', __('Site Title Font','nirvana') , 'cryout_setting_sitetitlefont_fn', 'nirvana-page', 'text_section');
	add_settings_field('nirvana_menufont', __('Main Menu Font','nirvana') , 'cryout_setting_menufont_fn', 'nirvana-page', 'text_section');
	add_settings_field('nirvana_fontheadings', __('Headings Font','nirvana') , 'cryout_setting_fontheadings_fn', 'nirvana-page', 'text_section');
	add_settings_field('nirvana_textalign', __('Force Text Align','nirvana') , 'cryout_setting_textalign_fn', 'nirvana-page', 'text_section');
	add_settings_field('nirvana_paragraphspace', __('Paragraph spacing','nirvana') , 'cryout_setting_paragraphspace_fn', 'nirvana-page', 'text_section');
	add_settings_field('nirvana_parindent', __('Paragraph Indent','nirvana') , 'cryout_setting_parindent_fn', 'nirvana-page', 'text_section');
	add_settings_field('nirvana_headingsindent', __('Headings Indent','nirvana') , 'cryout_setting_headingsindent_fn', 'nirvana-page', 'text_section');
	add_settings_field('nirvana_lineheight', __('Line Height','nirvana') , 'cryout_setting_lineheight_fn', 'nirvana-page', 'text_section');
	add_settings_field('nirvana_wordspace', __('Word Spacing','nirvana') , 'cryout_setting_wordspace_fn', 'nirvana-page', 'text_section');
	add_settings_field('nirvana_letterspace', __('Letter Spacing','nirvana') , 'cryout_setting_letterspace_fn', 'nirvana-page', 'text_section');
	add_settings_field('nirvana_letterspace', __('Uppercase Text','nirvana') , 'cryout_setting_uppercasetext_fn', 'nirvana-page', 'text_section');

	/*** appearance ***/
    add_settings_field('nirvana_sitebackground', __('Background Image','nirvana') , 'cryout_setting_sitebackground_fn', 'nirvana-page', 'appearance_section');
	add_settings_field('nirvana_generalcolors', __('General','nirvana') , 'cryout_setting_generalcolors_fn', 'nirvana-page', 'appearance_section');
	add_settings_field('nirvana_accentcolors', __('Accents','nirvana') , 'cryout_setting_accentcolors_fn', 'nirvana-page', 'appearance_section');
	add_settings_field('nirvana_titlecolors', __('Site Title','nirvana') , 'cryout_setting_titlecolors_fn', 'nirvana-page', 'appearance_section');
	add_settings_field('nirvana_menucolors', __('Main Menu','nirvana') , 'cryout_setting_menucolors_fn', 'nirvana-page', 'appearance_section');
	add_settings_field('nirvana_topmenucolors', __('Top Bar','nirvana') , 'cryout_setting_topmenucolors_fn', 'nirvana-page', 'appearance_section');
	add_settings_field('nirvana_contentcolors', __('Content','nirvana') , 'cryout_setting_contentcolors_fn', 'nirvana-page', 'appearance_section');
	add_settings_field('nirvana_frontpagecolors', __('Presentation Page','nirvana') , 'cryout_setting_frontpagecolors_fn', 'nirvana-page', 'appearance_section');
	add_settings_field('nirvana_sidecolors', __('Sidebar Widgets','nirvana') , 'cryout_setting_sidecolors_fn', 'nirvana-page', 'appearance_section');
	add_settings_field('nirvana_widgetcolors', __('Footer Widgets','nirvana') , 'cryout_setting_widgetcolors_fn', 'nirvana-page', 'appearance_section');
	add_settings_field('nirvana_linkcolors', __('Links','nirvana') , 'cryout_setting_linkcolors_fn', 'nirvana-page', 'appearance_section');
	add_settings_field('nirvana_metacolors', __('Post metas','nirvana') , 'cryout_setting_metacolors_fn', 'nirvana-page', 'appearance_section');
	add_settings_field('nirvana_socialcolors', __('Socials','nirvana') , 'cryout_setting_socialcolors_fn', 'nirvana-page', 'appearance_section');
	add_settings_field('nirvana_caption', __('Caption type','nirvana') , 'cryout_setting_caption_fn', 'nirvana-page', 'appearance_section');

	/*** graphics ***/
	add_settings_field('nirvana_topbar', __('Top Bar','nirvana') , 'cryout_setting_topbar_fn', 'nirvana-page', 'graphics_section');
	add_settings_field('nirvana_breadcrumbs', __('Breadcrumbs','nirvana') , 'cryout_setting_breadcrumbs_fn', 'nirvana-page', 'graphics_section');
	add_settings_field('nirvana_pagination', __('Pagination','nirvana') , 'cryout_setting_pagination_fn', 'nirvana-page', 'graphics_section');
	add_settings_field('nirvana_menualign', __('Menu Alignment','nirvana') , 'cryout_setting_menualign_fn', 'nirvana-page', 'graphics_section');
	add_settings_field('nirvana_searchbar', __('Search Bar Locations','nirvana') , 'cryout_setting_searchbar_fn', 'nirvana-page', 'graphics_section');
	add_settings_field('nirvana_image', __('Post Images Border','nirvana') , 'cryout_setting_image_fn', 'nirvana-page', 'graphics_section');
	add_settings_field('nirvana_pagetitle', __('Page Titles','nirvana') , 'cryout_setting_pagetitle_fn', 'nirvana-page', 'graphics_section');
	add_settings_field('nirvana_categetitle', __('Category Titles','nirvana') , 'cryout_setting_categtitle_fn', 'nirvana-page', 'graphics_section');
	add_settings_field('nirvana_tables', __('Hide Tables','nirvana') , 'cryout_setting_tables_fn', 'nirvana-page', 'graphics_section');
	add_settings_field('nirvana_backtop', __('Back to Top button','nirvana') , 'cryout_setting_backtop_fn', 'nirvana-page', 'graphics_section');

	/*** post metas ***/
	add_settings_field('nirvana_metapos', __('Meta Bar Position','nirvana') , 'cryout_setting_metapos_fn', 'nirvana-page', 'post_section');
	add_settings_field('nirvana_metashowblog', __('Show on Blog Pages','nirvana') , 'cryout_setting_metashowblog_fn', 'nirvana-page', 'post_section');
	add_settings_field('nirvana_metashowsingle', __('Show on Single Pages','nirvana') , 'cryout_setting_metashowsingle_fn', 'nirvana-page', 'post_section');
	add_settings_field('nirvana_comtext', __('Text Under Comments','nirvana') , 'cryout_setting_comtext_fn', 'nirvana-page', 'post_section');
	add_settings_field('nirvana_comclosed', __('Comments are closed text','nirvana') , 'cryout_setting_comclosed_fn', 'nirvana-page', 'post_section');
	add_settings_field('nirvana_comoff', __('Comments off','nirvana') , 'cryout_setting_comoff_fn', 'nirvana-page', 'post_section');
	add_settings_field('nirvana_comlabels', __('Comment Fields Labels','nirvana') , 'cryout_setting_comlabels_fn', 'nirvana-page', 'post_section');

	/*** post excerpts ***/
	add_settings_field('nirvana_excerpthome', __('Home Page','nirvana') , 'cryout_setting_excerpthome_fn', 'nirvana-page', 'excerpt_section');
	add_settings_field('nirvana_excerptsticky', __('Sticky Posts','nirvana') , 'cryout_setting_excerptsticky_fn', 'nirvana-page', 'excerpt_section');
	add_settings_field('nirvana_excerptarchive', __('Archive and Category Pages','nirvana') , 'cryout_setting_excerptarchive_fn', 'nirvana-page', 'excerpt_section');
	add_settings_field('nirvana_excerptlength', __('Post Excerpt Length ','nirvana') , 'cryout_setting_excerptlength_fn', 'nirvana-page', 'excerpt_section');
	add_settings_field('nirvana_excerptdots', __('Excerpt suffix','nirvana') , 'cryout_setting_excerptdots_fn', 'nirvana-page', 'excerpt_section');
	add_settings_field('nirvana_excerptcont', __('Continue reading link text ','nirvana') , 'cryout_setting_excerptcont_fn', 'nirvana-page', 'excerpt_section');
	add_settings_field('nirvana_excerpttags', __('HTML tags in Excerpts','nirvana') , 'cryout_setting_excerpttags_fn', 'nirvana-page', 'excerpt_section');

	/*** featured ***/
	add_settings_field('nirvana_fpost', __('Featured Images as POST Thumbnails ','nirvana') , 'cryout_setting_fpost_fn', 'nirvana-page', 'featured_section');
	add_settings_field('nirvana_fauto', __('Auto Select Images From Posts ','nirvana') , 'cryout_setting_fauto_fn', 'nirvana-page', 'featured_section');
	add_settings_field('nirvana_falign', __('Thumbnails Alignment ','nirvana') , 'cryout_setting_falign_fn', 'nirvana-page', 'featured_section');
	add_settings_field('nirvana_fsize', __('Thumbnails Size ','nirvana') , 'cryout_setting_fsize_fn', 'nirvana-page', 'featured_section');
	add_settings_field('nirvana_fheader', __('Featured Images as HEADER Images ','nirvana') , 'cryout_setting_fheader_fn', 'nirvana-page', 'featured_section');

	/*** socials ***/
	add_settings_field('nirvana_socials1', __('Link #1','nirvana') , 'cryout_setting_socials1_fn', 'nirvana-page', 'socials_section');
	add_settings_field('nirvana_socials2', __('Link #2','nirvana') , 'cryout_setting_socials2_fn', 'nirvana-page', 'socials_section');
	add_settings_field('nirvana_socials3', __('Link #3','nirvana') , 'cryout_setting_socials3_fn', 'nirvana-page', 'socials_section');
	add_settings_field('nirvana_socials4', __('Link #4','nirvana') , 'cryout_setting_socials4_fn', 'nirvana-page', 'socials_section');
	add_settings_field('nirvana_socials5', __('Link #5','nirvana') , 'cryout_setting_socials5_fn', 'nirvana-page', 'socials_section');
	add_settings_field('nirvana_socialshow', __('Socials display','nirvana') , 'cryout_setting_socialsdisplay_fn', 'nirvana-page', 'socials_section');

	/*** misc ***/
	add_settings_field('nirvana_iecompat', __('Internet Explorer Compatibility Tag','nirvana') , 'cryout_setting_iecompat_fn', 'nirvana-page', 'misc_section');
	//add_settings_field('nirvana_masonry', __('Masonry','nirvana') , 'cryout_setting_masonry_fn', 'nirvana-page', 'misc_section');
	add_settings_field('nirvana_fitvids', __('FitVids','nirvana') , 'cryout_setting_fitvids_fn', 'nirvana-page', 'misc_section');
	add_settings_field('nirvana_editorstyle', __('Editor Styling','nirvana') , 'cryout_setting_editorstyle_fn', 'nirvana-page', 'misc_section');
	add_settings_field('nirvana_copyright', __('Custom Footer Text','nirvana') , 'cryout_setting_copyright_fn', 'nirvana-page', 'misc_section');
	add_settings_field('nirvana_customcss', __('Custom CSS','nirvana') , 'cryout_setting_customcss_fn', 'nirvana-page', 'misc_section');
	add_settings_field('nirvana_customjs', __('Custom JavaScript','nirvana') , 'cryout_setting_customjs_fn', 'nirvana-page', 'misc_section');

	do_action('nirvana_post_settings_fields');
} // nirvana_init_fn()

function nirvana_theme_settings_placeholder() { 
	global $wp_version;
	if (function_exists('nirvana_theme_settings_restore') ):
		nirvana_theme_settings_restore();
	else:
?>
   <div id="nirvana-settings-placeholder">
		<h3>Where are the theme settings?</h3>
		<p>According to the <a href="https://make.wordpress.org/themes/2015/04/21/this-weeks-meeting-important-information-regarding-theme-options/" target="_blank">Wordpress Theme Review Guidelines</a>, starting with Nirvana v1.2 we had to remove the settings page from the theme and transfer all the settings to the <a href="http://codex.wordpress.org/Appearance_Customize_Screen" target="_blank">Customizer</a> interface.</p>
		<p>However, we feel that the Customizer interface does not provide the right medium (in space of terms and usability) for our existing theme options. We've created our settings with a certain layout that is not really compatible with the Customizer interface.</p>
		<p>As an alternative solution that allows us to keep updating and improving our theme we have moved the settings functionality to the separate <a href="https://wordpress.org/plugins/cryout-theme-settings/" target="_blank">Cryout Serious Theme Settings</a> plugin. To restore the theme settings page to previous functionality, all you need to do is install this free plugin with a couple of clicks.</p>
		<h3>How do I restore the settings?</h3>
		<p><strong>Navigate <a href="themes.php?page=nirvana-extra-plugins">to this page</a> to install and activate the Cryout Serious Theme Settings plugin, then return here to find the settings page in all its past glory.</strong></p>
		<p>The plugin is compatible with all our themes that are affected by this change and only needs to be installed once.</p>
   </div>
<?php
	endif;
} // nirvana_theme_settings_placeholder()

 // Display the admin options page
function nirvana_page_fn() {

	// Load the import form page if the import button has been pressed
	if (isset($_POST['nirvana_import'])) {
		nirvana_import_form();
		return;
	}
	// Load the import form  page after upload button has been pressed
	if (isset($_POST['nirvana_import_confirmed'])) {
		nirvana_import_file();
		return;
	}
	// Load the presets  page after presets button has been pressed
	if (isset($_POST['nirvana_presets'])) {
		nirvana_init_fn();
		nirvana_presets();
		return;
	}
	if (!current_user_can('edit_theme_options'))  {
		wp_die( __('Sorry, but you do not have sufficient permissions to access this page.','nirvana') );
	}
	?>
	<div class="wrap cryout-admin"><!-- Admin wrap page -->
		<h2 id="empty-placeholder-heading-for-wp441-notice-forced-move"></h2>
		<?php
		if ( isset( $_GET['settings-updated'] ) ) { ?>
			<div class='updated fade' style='clear:left;'>
				<p><?php _e('Nirvana settings updated successfully.','nirvana'); ?></p>	
			</div>
		<?php } ?>
		
		<div id="lefty"><!-- Left side of page - the options area -->
		<div>
			<div id="admin_header"><img src="<?php echo esc_url( get_template_directory_uri() ) . '/admin/images/nirvana-logo.png' ?>" /> </div>
			<div id="admin_links">
				<a target="_blank" href="https://www.cryoutcreations.eu/wordpress-themes/nirvana">Nirvana Homepage</a>
				<a target="_blank" href="https://www.cryoutcreations.eu/forum">Support</a>
				<a target="_blank" href="https://www.cryoutcreations.eu">Cryout Creations</a>
			</div>
			<div style="clear: both;"></div>
		</div>
		<?php global $nirvanas; ?>
			<div id="main-options">
				<?php nirvana_theme_settings_placeholder() ?>
				<span id="version">
				Nirvana v<?php echo _CRYOUT_THEME_VERSION; ?> by <a href="https://www.cryoutcreations.eu" target="_blank">Cryout Creations</a>
				</span>
			</div><!-- main-options -->
		</div><!--lefty -->


		<div id="righty" ><!-- Right side of page - Coffee, RSS tips and others -->

			<?php do_action('nirvana_before_righty') ?>

			<div id="nirvana-donate" class="postbox donate">
				<h3 class="hndle"> Coffee Break </h3>
				<div class="inside">
					<p>We here at Cryout Creations have reached a higher state of mind. While meticulously crafting WordPress themes we have elevated to another dimension where we have spent ages enhancing our cognitive development, growing infinitely wiser and more experienced. In this surreal place called Nirvana we've finally found the answer to the question humanity has been asking itself since the dawn of time: <i>'What is the meaning of life?'</i></p>
					<p>And now, thanks to us, that question has an absolute and undisputable answer: <i>'Coffee'</i>. Coffee is the answer to everything, the key to every lock, the source code to the Universe. Coffee powers our bodies and minds and it's what our souls are made of. </p>
					<p>Also, it's a universal fact that when coffee takes the form of a question ('Coffee?') the answer will always be <i>'Yes, please'</i>, so...</p>
					<div style="display:block;float:none;margin:0 auto;text-align:center;">
						<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank">
							<input type="hidden" name="cmd" value="_donations">
							<input type="hidden" name="business" value="KYL26KAN4PJC8">
							<input type="hidden" name="item_name" value="Cryout Creations / Nirvana Theme donation">
							<input type="hidden" name="currency_code" value="EUR">
							<input type="hidden" name="bn" value="PP-DonationsBF:btn_donate_SM.gif:NonHosted">
							<input type="image" src="<?php echo esc_url( get_template_directory_uri() ) . '/admin/images/coffee.png' ?>" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
							<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
						</form>
					</div>
					<p>Or socially smother, caress and embrace us:</p>
					<div class="social-buttons">
						<a href="https://www.facebook.com/cryoutcreations" target="_blank" title="Follow us on Facebook">
							<img src="<?php echo esc_url( get_template_directory_uri() ) . '/admin/images/icon-facebook.png' ?>" alt="Facebook">
						</a>
						<a href="https://twitter.com/cryoutcreations" target="_blank" title="Follow us on Twitter">
							<img src="<?php echo esc_url( get_template_directory_uri() ) . '/admin/images/icon-twitter.png' ?>" alt="Twitter">
						</a>
						<a href="https://profiles.wordpress.org/cryout-creations/" target="_blank" title="Check out our WordPress.org creations">
							<img src="<?php echo esc_url( get_template_directory_uri() ) . '/admin/images/icon-wporg.png' ?>" alt="WordPress.org">
				</a>
					</div>

				</div><!-- inside -->
			</div><!-- donate -->
			
			<?php do_action('nirvana_after_righty') ?>

		</div><!--  righty -->
	</div><!--  wrap -->

	<script type="text/javascript">
	var reset_confirmation = '<?php echo esc_html(__('Reset Nirvana Settings to Defaults?','nirvana')); ?>';
	var nirvana_help_icon = '<?php echo esc_url(get_template_directory_uri()); ?>/images/icon-tooltip.png';

	jQuery(document).ready(function(){
		if (vercomp(jQuery.ui.version,"1.9.0")) {
			tooltip_terain();
			jQuery('.colorthingy').each(function(){
				id = "#"+jQuery(this).attr('id');
				startfarb(id,id+'2');
			});
		} else {
			jQuery("#main-options").addClass('oldwp');
			setTimeout(function(){jQuery('#nirvana_slideType').trigger('click')},1000);
			jQuery('.colorthingy').each(function(){
				id = "#"+jQuery(this).attr('id');
				jQuery(this).on('keyup',function(){coloursel(this)});
				coloursel(this);
			});
		}
	});
	</script>

	<?php 
} // nirvana_page_fn()

// FIN
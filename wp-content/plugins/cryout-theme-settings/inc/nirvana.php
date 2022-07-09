<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

if (function_exists('nirvana_init_fn')):
	add_action('admin_init', 'nirvana_init_fn');
	add_action('nirvana_before_righty', 'nirvana_extra');
endif;

function nirvana_theme_settings_restore($class='') { 
	global $cryout_theme_settings;
?>
		<form name="nirvana_form" id="nirvana_form" action="options.php" method="post" enctype="multipart/form-data">
			<div id="accordion" class="<?php echo $class; ?>">
				<?php settings_fields('nirvana_settings'); ?>
				<?php do_settings_sections('nirvana-page'); ?>
			</div>
			<div id="submitDiv">
			    <br>
				<input class="button" name="nirvana_settings[nirvana_submit]" type="submit" id="nirvana_sumbit" style="float:right;"   value="<?php _e('Save Changes','nirvana'); ?>" />
				<input class="button" name="nirvana_settings[nirvana_defaults]" id="nirvana_defaults" type="submit" style="float:left;" value="<?php _e('Reset to Defaults','nirvana'); ?>" />
				</div>
		</form>
<?php
} // nirvana_theme_settings_buttons()

function nirvana_extra() { 
	$url = untrailingslashit( plugin_dir_url( dirname(__FILE__) ) ) . '/media';
	include_once( plugin_dir_path( __FILE__ ) . 'extra.php' );
} // nirvana_extra()

if ( version_compare( $this->current_theme['version'], '1.6.0', '>=' ) ) {
// all the functionality below is conditioned to running Nirvana v1.6.0 or newer and is not needed in older versions

	/**
	 * Export Nirvana settings to file
	 */

	function nirvana_export_options(){
		
		if ( ! isset( $_POST['nirvana_export'] ) ) return; 

		if (ob_get_contents()) ob_clean();

		/* Check authorisation */
		$authorised = true;
		// Check nonce
		if ( ! wp_verify_nonce( $_POST['nirvana-export'], 'nirvana-export' ) ) {
			$authorised = false;
		}
		// Check permissions
		if ( ! current_user_can( 'edit_theme_options' ) ){
			$authorised = false;
		}

		if ( $authorised) {
			global $nirvanas;
			date_default_timezone_set('UTC');
			$name = 'nirvanasettings-'.preg_replace("/[^a-z0-9-_]/i",'',str_replace("http://","",get_option('siteurl'))).'-'.date('Ymd-His').'.txt';

			$data = $nirvanas;
			$data = json_encode( $data );
			$size = strlen( $data );

			header( 'Content-Type: text/plain' );
			header( 'Content-Disposition: attachment; filename="'.$name.'"' );
			header( "Content-Transfer-Encoding: binary" );
			header( 'Accept-Ranges: bytes' );

			/* The three lines below basically make the download non-cacheable */
			header( "Cache-control: private" );
			header( 'Pragma: private' );
			header( "Expires: Mon, 26 Jul 1997 05:00:00 GMT" );

			header( "Content-Length: " . $size);
			print( $data );
		}
		die();
	} // nirvana_export_options()
	add_action( 'admin_init', 'nirvana_export_options' );

	/**
	 * This file manages the theme settings uploading and import operations.
	 * Uses the theme page to create a new form for uplaoding the settings
	 * Uses WP_Filesystem
	*/
	function nirvana_import_form(){

		$bytes = apply_filters( 'import_upload_size_limit', wp_max_upload_size() );
		$size = size_format( $bytes );
		$upload_dir = wp_upload_dir();
		if ( ! empty( $upload_dir['error'] ) ) :
			?><div class="error"><p><?php _e('Before you can upload your import file, you will need to fix the following error:', 'nirvana'); ?></p>
				<p><strong><?php echo $upload_dir['error']; ?></strong></p></div><?php
		else :
		?>

		<div class="wrap cryout-admin">
			<div style="width:400px;display:block;margin-left:30px;">
			<div id="icon-tools" class="icon32"><br></div>
			<h2><?php echo __( 'Import Nirvana Settings', 'nirvana' );?></h2>
			<form enctype="multipart/form-data" id="import-upload-form" method="post" action="">
			<p><?php _e('Only files obtained from Nirvana\'s export process are supported.', 'nirvana'); ?></p>
				<p>
					<label for="upload"><strong><?php printf( __('Select an existing theme settings file: %s', 'nirvana'), '(nirvana-settings.txt)' ) ?> </strong><i></i></label> 
				   <input type="file" id="upload" name="import" size="25"  />
					<span style="font-size:10px;">(<?php  printf( __( 'Maximum size: %s', 'nirvana' ), $size ); ?> )</span>
					<input type="hidden" name="action" value="save" />
					<input type="hidden" name="max_file_size" value="<?php echo $bytes; ?>" />
					<?php wp_nonce_field('nirvana-import', 'nirvana-import'); ?>
					<input type="hidden" name="nirvana_import_confirmed" value="true" />
				</p>
				<input type="submit" class="button" value="<?php _e('And import!', 'nirvana'); ?>" />
			</form>
		</div>
		</div> <!-- end wrap -->
		<?php
		endif;
	} // Closes the nirvana_import_form() function definition


	/**
	 * This actual import of the options from the file to the settings array.
	*/
	function nirvana_import_file() {
		global $nirvanas;

		/* Check authorisation */
		$authorised = true;
		// Check nonce
		if (!wp_verify_nonce($_POST['nirvana-import'], 'nirvana-import')) {$authorised = false;}
		// Check permissions
		if (!current_user_can('edit_theme_options')){ $authorised = false; }

		// If the user is authorised, import the theme's options to the database
		if ($authorised) {?>
			<?php
			// make sure there is an import file uploaded
			if ( (isset($_FILES["import"]["size"]) &&  ($_FILES["import"]["size"] > 0) ) ) {

				$form_fields = array('import');
				$method = '';

				$url = wp_nonce_url('themes.php?page=nirvana-page', 'nirvana-import');

				// Get file writing credentials
				if (false === ($creds = request_filesystem_credentials($url, $method, false, false, $form_fields) ) ) {
					return true;
				}

				if ( ! WP_Filesystem($creds) ) {
					// our credentials were no good, ask the user for them again
					request_filesystem_credentials($url, $method, true, false, $form_fields);
					return true;
				}

				// Write the file if credentials are good
				$upload_dir = wp_upload_dir();
				$filename = trailingslashit($upload_dir['path']).'nirvanas.txt';

				// by this point, the $wp_filesystem global should be working, so let's use it to create a file
				global $wp_filesystem;
				if ( ! $wp_filesystem->move($_FILES['import']['tmp_name'], $filename, true) ) {
					echo 'Error saving file!';
					return;
				}

				$file = $_FILES['import'];

				if ($file['type'] == 'text/plain') {
					$data = $wp_filesystem->get_contents($filename);
					// try to read the file
					if ($data !== FALSE){
						$settings = json_decode($data, true);
						// try to read the settings array
						if (isset($settings['nirvana_db'])){ ?>
			<div class="wrap cryout-admin">
			<div id="icon-tools" class="icon32"><br></div>
			<h2><?php echo __( 'Import Nirvana Theme Options', 'nirvana' );?></h2> <?php
							$settings = array_merge($nirvanas, $settings);
							update_option('nirvana_settings', $settings);
							echo '<div class="updated fade"><p>'. __('Great! The options have been imported!', 'nirvana').'<br />';
							printf( '<a href="%s">%s<a></p></div>', admin_url( 'themes.php?page=nirvana-page' ), __('Go back to the settings page and check them out!', 'nirvana') );
						}
						else { // else: try to read the settings array
							echo '<div class="error"><p><strong>'.__('Oops, there\'s a small problem.', 'nirvana').'</strong><br />';
							echo __('The uploaded file does not contain valid Nirvana settings. Make sure the file is exported from Nirvana.', 'nirvana').'</p></div>';
							nirvana_import_form();
						}
					}
					else { // else: try to read the file
						echo '<div class="error"><p><strong>'.__('Oops, there\'s a small problem.', 'nirvana').'</strong><br />';
						echo __('The uploaded file could not be read.', 'nirvana').'</p></div>';
						nirvana_import_form();
					}
				}
				else { // else: make sure the file uploaded was a plain text file
					echo '<div class="error"><p><strong>'.__('Oops, there\'s a small problem.', 'nirvana').'</strong><br />';
					echo __('The uploaded file is not supported. Make sure the file was exported from Nirvana and that it is a text file.', 'nirvana').'</p></div>';
					nirvana_import_form();
				}

				// Delete the file after we're done
				$wp_filesystem->delete($filename);

			}
			else { // else: make sure there is an import file uploaded
				echo '<div class="error"><p>'.__( 'Oops! The file is empty or there was no file. This error could also be caused by uploads being disabled in your php.ini or by post_max_size being defined as smaller than upload_max_filesize in php.ini.', 'nirvana' ).'</p></div>';
				nirvana_import_form();
			}
			echo '</div> <!-- end wrap -->';
		}
		else {
			wp_die(__('ERROR: You are not authorised to perform that operation', 'nirvana'));
		}
	} // Closes the nirvana_import_file() function definition



	function nirvana_presets(){
	?>
	<script type="text/javascript">
		var scheme_confirmation = '<?php echo esc_html__('Are you sure you want to load a new color scheme? \nAll current saved settings under Text and Color Settings will be lost.','nirvana'); ?>'; 
	</script>
		<div class="wrap cryout-admin">
			<div id="admin_header"><img src="<?php echo get_template_directory_uri() . '/admin/images/colorschemes-logo.png' ?>" /> </div>
			<div style="display:block;margin-left:30px;clear:both;float:none;">
				<p><em><?php echo _e("Select one of the preset color schemes and press the Load button.<br> <b> CAUTION! </b> When loading a color scheme, the Nirvana theme settings under Text and Color Settings will be overriden. All other settings will remain intact.<br> <u>SUGGESTION:</u> It's always better to export your current theme settings before loading a color scheme." , "nirvana"); ?></em></p>
				<br>
				<form name="nirvana_form" action="options.php" method="post" enctype="multipart/form-data">

		<?php
		settings_fields('nirvana_settings');

		global $nirvanas;
		global $nirvana_colorschemes_array;

		foreach($nirvana_colorschemes_array as $key=>$item) {
			$id = preg_replace('/[^a-z0-9]/i', '',$key);
			$checkedClass = ($nirvanas['nirvana_colorschemes']==$item) ? ' checkedClass' : '';
/* 			printf( "<label id='%1$s' for='sel_%2$s' class='images presets %3$s'>
					<input %4$s value='%5$s' id='sel_%2$s' onClick=\"changeBorder('%1$s','images');\" name='nirvana_settings[nirvana_colorschemes]' type='radio' />
					<img class='%2$s' src='%6$s'/> <p>%5$s</p>
				</label>\n",
				$id, 
				strtolower( $id ),
				$checkedClass,
				checked($nirvanas['nirvana_colorschemes'], $item, false),
				$key,
				sprintf( '%1%s/admin/images/schemes/%2$s.png', esc_url( get_template_directory_uri() ), $key )
			); */
			echo " <label id='$id' for='$id$id' class='images presets $checkedClass'><input ";
				checked($nirvanas['nirvana_colorschemes'],$item);
			echo " value='$key' id='$id$id' onClick=\"changeBorder('$id','images');\" name='nirvana_settings[nirvana_colorschemes]' type='radio' /><img class='$id'  src='".get_template_directory_uri()."/admin/images/schemes/{$key}.png'/><p>{$key}</p></label>";
		}
		?>

				<div id="submitDiv" style="width:400px;display:block;margin:0 auto;">
					<br>
					<input type="hidden" value="true" name="nirvana_presets_loaded" />
					<input class="button" name="nirvana_settings[nirvana_schemessubmit]" type="submit" id="load-color-scheme" style="width:400px;height:40px;display:block;text-align:center;" value="<?php _e('Load Color Scheme','nirvana'); ?>" />
				</div>
				</form>
			</div>
		</div> <!-- end wrap -->
		<br>
		<?php
	} // nirvana_presets()


	// Truncate function for use in the Admin RSS feed
	function nirvana_truncate_words($string,$words=20, $ellipsis=' ...') {
		$new = preg_replace('/((\w+\W+\'*){'.($words-1).'}(\w+))(.*)/', '${1}', $string);
		return $new.$ellipsis;
	}

	function nirvana_righty_below() { ?>

			<div id="nirvana-export" class="postbox export non-essential-option" style="overflow:hidden;">
				<h3 class="hndle"><?php _e( 'Import/Export Settings', 'nirvana' ); ?></h3>
				<div class="panel-wrap inside">
					<form action="" method="post">
						<?php wp_nonce_field('nirvana-export', 'nirvana-export'); ?>
						<input type="hidden" name="nirvana_export" value="true" />
						<input type="submit" class="button" value="<?php _e('Export Theme options', 'nirvana'); ?>" />
						<p class="imex-text"><?php _e("It's that easy: a mouse click away - the ability to export your Nirvana settings and save them on your computer. Feeling safer? You should!","nirvana"); ?></p>
					</form>
					<br />
					<form action="" method="post">
						<input type="hidden" name="nirvana_import" value="true" />
						<input type="submit" class="button" value="<?php _e('Import Theme options', 'nirvana'); ?>" />
						<p class="imex-text"><?php _e("Without the import, the export would just be a fool's exercise. Make sure you have the exported file ready and see you after the mouse click.","nirvana"); ?></p>
					</form>
					<br />
					<form action="" method="post">
						<input type="hidden" name="nirvana_presets" value="true" />
						<input type="submit" class="button" id="presets_button" value="<?php _e('Color Schemes', 'nirvana'); ?>" />
						<p class="imex-text"><?php _e("A collection of preset color schemes to use as the starting point for your site. Just load one up and see your blog in a different light.","nirvana"); ?></p>
					</form>
				</div><!-- inside -->
			</div><!-- export -->

			<div id="nirvana-news" class="postbox news" >
				<h3 class="hndle"><?php _e( 'Nirvana Latest News', 'nirvana' ); ?></h3>
				<div class="panel-wrap inside" style="height:200px;overflow:auto;">
						<?php
	 	                $news_feed = fetch_feed( array( 'http://www.cryoutcreations.eu/cat/wordpress-themes/nirvana/feed/') );
	 	                $maxitems = 0;
	 	                if ( ! is_wp_error( $news_feed ) ) {
	 	                    $maxitems = $news_feed->get_item_quantity( 10 );
	 	                    $news_items = $news_feed->get_items( 0, $maxitems );
	 	                }
	 	                ?>
	 	                <ul class="news-list">
	 	                    <?php if ( $maxitems == 0 ) : echo '<li>' . __( 'No news items.', 'parabola' ) . '</li>'; else :
	 	                    foreach( $news_items as $news_item ) : ?>
	 	                        <li>
	 	                            <a class="news-header" href='<?php echo esc_url( $news_item->get_permalink() ); ?>'><?php echo esc_html( $news_item->get_title() ); ?></a><br />
	 	                   <span class="news-item-date"><?php _e('Posted on','parabola'); echo $news_item->get_date(' j F Y, H:i'); ?></span>
	 	
	 	                    <br><a class="news-read" href='<?php echo esc_url( $news_item->get_permalink() ); ?>'>Read the full post &raquo;</a><br />
	 	                        </li>
	 	                    <?php endforeach; endif; ?>
	 	                </ul>
				</div><!-- inside -->
			</div><!-- news -->

	<?php 
	} // nirvana_righty_below()
	add_action( 'nirvana_after_righty', 'nirvana_righty_below' );
	
} // endif version_compare()

// FIN
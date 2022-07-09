<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

if (function_exists('parabola_init_fn')):
	add_action('admin_init', 'parabola_init_fn');
	add_action('parabola_before_righty', 'parabola_extra');
endif;

function parabola_theme_settings_restore($class='') { 
	global $cryout_theme_settings;
?>
		<form name="parabola_form" action="options.php" method="post" enctype="multipart/form-data">
			<div id="accordion">
				<?php settings_fields('parabola_settings'); ?>
				<?php do_settings_sections('parabola-page'); ?>
			</div>
			<div id="submitDiv">
			    <br>
				<input class="button" name="parabola_settings[parabola_submit]" type="submit" style="float:right;"   value="<?php _e('Save Changes','parabola'); ?>" />
				<input class="button" name="parabola_settings[parabola_defaults]" id="parabola_defaults" type="submit" style="float:left;" value="<?php _e('Reset to Defaults','parabola'); ?>" />
				</div>
		</form>
<?php
} // parabola_theme_settings_buttons()

function parabola_extra() { 
	$url = untrailingslashit( plugin_dir_url( dirname(__FILE__) ) ) . '/media';
	include_once( plugin_dir_path( __FILE__ ) . 'extra.php' );
} // parabola_extra()

if ( version_compare( $this->current_theme['version'], '2.4.0', '>=' ) ) {
// all the functionality below is conditioned to running Parabola v2.4.0 or newer and is not needed in older versions

	/**
	 * Export Parabola settings to file
	 */

	function parabola_export_options(){
		
		if ( ! isset( $_POST['parabola_export'] ) ) return; 

		if (ob_get_contents()) ob_clean();

		/* Check authorisation */
		$authorised = true;
		// Check nonce
		if ( ! wp_verify_nonce( $_POST['parabola-export'], 'parabola-export' ) ) {
			$authorised = false;
		}
		// Check permissions
		if ( ! current_user_can( 'edit_theme_options' ) ){
			$authorised = false;
		}

		if ( $authorised) {
			global $parabolas;
			date_default_timezone_set('UTC');
			$name = 'parabolasettings-'.preg_replace("/[^a-z0-9-_]/i",'',str_replace("http://","",get_option('siteurl'))).'-'.date('Ymd-His').'.txt';

			$data = $parabolas;
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
	} // parabola_export_options()
	add_action( 'admin_init', 'parabola_export_options' );

	/**
	 * This file manages the theme settings uploading and import operations.
	 * Uses the theme page to create a new form for uplaoding the settings
	 * Uses WP_Filesystem
	*/
	function parabola_import_form(){

		$bytes = apply_filters( 'import_upload_size_limit', wp_max_upload_size() );
		$size = size_format( $bytes );
		$upload_dir = wp_upload_dir();
		if ( ! empty( $upload_dir['error'] ) ) :
			?><div class="error"><p><?php _e('Before you can upload your import file, you will need to fix the following error:', 'parabola'); ?></p>
				<p><strong><?php echo $upload_dir['error']; ?></strong></p></div><?php
		else :
		?>

		<div class="wrap cryout-admin">
			<div style="width:400px;display:block;margin-left:30px;">
			<div id="icon-tools" class="icon32"><br></div>
			<h2><?php echo __( 'Import Parabola Settings', 'parabola' );?></h2>
			<form enctype="multipart/form-data" id="import-upload-form" method="post" action="">
				<p><?php _e('Only files obtained from Parabola\'s export process are supported.', 'parabola'); ?></p>
				<p>
					<label for="upload"><strong><?php printf( __('Select an existing theme settings file: %s', 'parabola'), '(parabola-settings.txt)' ) ?> </strong><i></i></label> 
				   <input type="file" id="upload" name="import" size="25"  />
					<span style="font-size:10px;">(<?php  printf( __( 'Maximum size: %s', 'parabola' ), $size ); ?> )</span>
					<input type="hidden" name="action" value="save" />
					<input type="hidden" name="max_file_size" value="<?php echo $bytes; ?>" />
					<?php wp_nonce_field('parabola-import', 'parabola-import'); ?>
					<input type="hidden" name="parabola_import_confirmed" value="true" />
				</p>
				<input type="submit" class="button" value="<?php _e('And import!', 'parabola'); ?>" />
			</form>
		</div>
		</div> <!-- end wrap -->
		<?php
		endif;
	} // Closes the parabola_import_form() function definition


	/**
	 * This actual import of the options from the file to the settings array.
	*/
	function parabola_import_file() {
		global $parabolas;

		/* Check authorisation */
		$authorised = true;
		// Check nonce
		if (!wp_verify_nonce($_POST['parabola-import'], 'parabola-import')) {$authorised = false;}
		// Check permissions
		if (!current_user_can('edit_theme_options')){ $authorised = false; }

		// If the user is authorised, import the theme's options to the database
		if ($authorised) {?>
			<?php
			// make sure there is an import file uploaded
			if ( (isset($_FILES["import"]["size"]) &&  ($_FILES["import"]["size"] > 0) ) ) {

				$form_fields = array('import');
				$method = '';

				$url = wp_nonce_url('themes.php?page=parabola-page', 'parabola-import');

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
				$filename = trailingslashit($upload_dir['path']).'parabolas.txt';

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
						if (isset($settings['parabola_db'])){ ?>
			<div class="wrap cryout-admin">
			<div id="icon-tools" class="icon32"><br></div>
			<h2><?php echo __( 'Import Parabola Theme Options ', 'parabola' );?></h2> <?php
							$settings = array_merge($parabolas, $settings);
							update_option('parabola_settings', $settings);
							echo '<div class="updated fade"><p>'. __('Great! The options have been imported!', 'parabola').'<br />';
							printf( '<a href="%s">%s<a></p></div>', admin_url( 'themes.php?page=parabola-page' ), __('Go back to the settings page and check them out!', 'parabola') );
						}
						else { // else: try to read the settings array
							echo '<div class="error"><p><strong>'.__('Oops, there\'s a small problem.', 'parabola').'</strong><br />';
							echo __('The uploaded file does not contain valid Parabola settings. Make sure the file is exported from the Parabola.', 'parabola').'</p></div>';
							parabola_import_form();
						}
					}
					else { // else: try to read the file
						echo '<div class="error"><p><strong>'.__('Oops, there\'s a small problem.', 'parabola').'</strong><br />';
						echo __('The uploaded file could not be read.', 'parabola').'</p></div>';
						parabola_import_form();
					}
				}
				else { // else: make sure the file uploaded was a plain text file
					echo '<div class="error"><p><strong>'.__('Oops, there\'s a small problem.', 'parabola').'</strong><br />';
					echo __('The uploaded file is not supported. Make sure the file was exported from Parabola and that it is a text file.', 'parabola').'</p></div>';
					parabola_import_form();
				}

				// Delete the file after we're done
				$wp_filesystem->delete($filename);

			}
			else { // else: make sure there is an import file uploaded
				echo '<div class="error"><p>'.__( 'Oops! The file is empty or there was no file. This error could also be caused by uploads being disabled in your php.ini or by post_max_size being defined as smaller than upload_max_filesize in php.ini.', 'parabola' ).'</p></div>';
				parabola_import_form();
			}
			echo '</div> <!-- end wrap -->';
		}
		else {
			wp_die(__('ERROR: You are not authorised to perform that operation', 'parabola'));
		}
	} // Closes the parabola_import_file() function definition

	function parabola_presets(){
	?>
	<script type="text/javascript">
		var scheme_confirmation = '<?php echo esc_html__('Are you sure you want to load a new color scheme? \nAll current saved settings under Text and Color Settings will be lost.','parabola'); ?>'; 
	</script>
		<div class="wrap cryout-admin">
			<div id="admin_header"><img src="<?php echo get_template_directory_uri() . '/admin/images/colorschemes-logo.png' ?>" /> </div>
			<div style="display:block;margin-left:30px;clear:both;float:none;">
				<p><em><?php echo _e("Select one of the preset color schemes and press the Load button.<br> <b> CAUTION! </b> When loading a color scheme, the Parabola theme settings under Text and Color Settings will be overriden. All other settings will remain intact.<br> <u>SUGGESTION:</u> It's always better to export your current theme settings before loading a color scheme." , "parabola"); ?></em></p>
				<br>
				<form name="parabola_form" action="options.php" method="post" enctype="multipart/form-data">

		<?php
		settings_fields('parabola_settings');

		global $parabolas;
		global $parabola_colorschemes_array;

		foreach($parabola_colorschemes_array as $key=>$item) {
			$id = preg_replace('/[^a-z0-9]/i', '',$key);
			$checkedClass = ($parabolas['parabola_colorschemes']==$item) ? ' checkedClass' : '';
/* 			printf( "<label id='%1$s' for='sel_%2$s' class='images presets %3$s'>
					<input %4$s value='%5$s' id='sel_%2$s' onClick=\"changeBorder('%1$s','images');\" name='parabola_settings[parabola_colorschemes]' type='radio' />
					<img class='%2$s' src='%6$s'/> <p>%5$s</p>
				</label>\n",
				$id, 
				strtolower( $id ),
				$checkedClass,
				checked($parabolas['parabola_colorschemes'], $item, false),
				$key,
				sprintf( '%1%s/admin/images/schemes/%2$s.png', esc_url( get_template_directory_uri() ), $key )
			); */
			echo " <label id='$id' for='$id$id' class='images presets $checkedClass'><input ";
				checked($parabolas['parabola_colorschemes'],$item);
			echo " value='$key' id='$id$id' onClick=\"changeBorder('$id','images');\" name='parabola_settings[parabola_colorschemes]' type='radio' /><img class='$id'  src='".get_template_directory_uri()."/admin/images/schemes/{$key}.png'/><p>{$key}</p></label>";
		}
		?>
				<div id="submitDiv" style="width:400px;display:block;margin:0 auto;">
					<br>
					<input type="hidden" value="true" name="parabola_presets_loaded" />
					<input class="button" name="parabola_settings[parabola_schemessubmit]" type="submit" id="load-color-scheme" style="width:400px;height:40px;display:block;text-align:center;" value="<?php _e('Load Color Scheme','parabola'); ?>" />
				</div>
				</form>
			</div>
		</div> <!-- end wrap -->
		<br>
		<?php
	} // parabola_presets()

	// Truncate function for use in the Admin RSS feed
	function parabola_truncate_words($string,$words=20, $ellipsis=' ...') {
	 $new = preg_replace('/((\w+\W+\'*){'.($words-1).'}(\w+))(.*)/', '${1}', $string);
	 return $new.$ellipsis;
	}
	
	function parabola_righty_below() { ?>
		<div class="postbox export non-essential-option" style="overflow:hidden;">
			<div class="head-wrap">
				<div title="Click to toggle" class="handlediv"><br /></div>
				<h3 class="hndle"><?php _e( 'Import/Export Settings', 'parabola' ); ?></h3>
			</div><!-- head-wrap -->
			<div class="panel-wrap inside">
					<form action="" method="post">
						<?php wp_nonce_field('parabola-export', 'parabola-export'); ?>
						<input type="hidden" name="parabola_export" value="true" />
						<input type="submit" class="button" value="<?php _e('Export Theme options', 'parabola'); ?>" />
						<p class="imex-text"><?php _e("It's that easy: a mouse click away - the ability to export your Parabola settings and save them on your computer. Feeling safer? You should!","parabola"); ?></p>
					</form>
					<br />
					<form action="" method="post">
						<input type="hidden" name="parabola_import" value="true" />
						<input type="submit" class="button" value="<?php _e('Import Theme options', 'parabola'); ?>" />
						<p class="imex-text"><?php _e("Without the import, the export would just be a fool's exercise. Make sure you have the exported file ready and see you after the mouse click.","parabola"); ?></p>
					</form>
					<br />
					<form action="" method="post">
						<input type="hidden" name="parabola_presets" value="true" />
						<input type="submit" class="button" id="presets_button" value="<?php _e('Color Schemes', 'parabola'); ?>" />
						<p class="imex-text"><?php _e("A collection of preset color schemes to use as the starting point for your site. Just load one up and see your blog in a different light.","parabola"); ?></p>
					</form>

			</div><!-- inside -->
		</div><!-- export -->

		<div class="postbox news" >
				<div>
					<h3 class="hndle"><?php _e( 'Parabola Latest News', 'parabola' ); ?></h3>
				</div>
				<div class="panel-wrap inside" style="height:200px;overflow:auto;">
					<?php
					$parabola_news = fetch_feed( array( 'http://www.cryoutcreations.eu/cat/wordpress-themes/parabola/feed/') );
					$maxitems = 0;
					if ( ! is_wp_error( $parabola_news ) ) {
						$maxitems = $parabola_news->get_item_quantity( 10 );
						$news_items = $parabola_news->get_items( 0, $maxitems );
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
		</div><!-- news -->	 <?php
	} // parabola_righty_below()
	add_action( 'parabola_after_righty', 'parabola_righty_below' );

	
} // endif version_compare()

// FIN
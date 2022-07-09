<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

$theme_page_url = admin_url( 'themes.php?page=' . $this->current_theme['slug'] . '-page' );
$theme_slug = $this->current_theme['slug'];
$theme_name = ucwords($this->current_theme['slug']);
$url = plugin_dir_url( dirname(__FILE__) ) . 'media';
?>

	<div class="wrap">
		<h2><?php _e('Serious Theme Settings Status', 'cryout-theme-settings') ?></h2>

			<?php if ($this->status == 1): ?>
			<div class="notice updated"><p>Currently detected theme is: <strong><?php echo $theme_name; ?></strong>.<br>
				The plugin is <strong style="color: #008000;">active</strong>. Go <a href="<?php echo $theme_page_url ?>"><strong>configure <?php echo $theme_name ?></strong></a>.
				</p></div>
			<?php elseif ($this->status == 4): ?>
			<div class="notice updated"><p>Currently detected theme is: <strong><?php echo $theme_name; ?></strong> and you are running WordPress 4.4 or newer.<br>
				The plugin is <strong style="color: #008000;">active</strong> in compatibility mode. Go <a href="<?php echo $theme_page_url ?>"><strong>configure <?php echo $theme_name ?></strong></a>.
				</p></div>
			<?php else: ?>
			<div class="notice error"><p>
			<?php
				switch ($this->status):
					case 5:
					// theme requires update ?>
						Currently detected theme is: <strong><?php echo $theme_name; ?></strong>.<br>
						This plugin cannot work with this version of the theme. Please update the theme first. <br>
						The plugin is <strong style="color: #800000;">INACTIVE</strong>. <?php
					break;
					case 3:
					// unsupported theme ?>
						Currently detected theme is: <strong><?php echo $theme_name; ?></strong>.<br>
						This plugin is designed to work only with the supported themes. <br>
						The plugin is <strong style="color: #800000;">INACTIVE</strong> and can be disabled and/or removed. <?php
					break;
					case 2:
					// unsupported version ?>
						Currently detected theme is: <strong><?php echo $theme_name ?></strong>, however the plugin is designed to work with version <b><?php echo $this->supported_themes[$this->current_theme['slug']] ?></b> or newer of <em><?php echo $theme_name ?></em>.<br>
						You are running <em><?php echo $theme_name ?> version <?php echo $this->current_theme['version'] ?></em> which does not need this plugin.</br>
						The plugin is <strong style="color: #800000;">INACTIVE</strong> and can be disabled and/or removed. <?php
					break;
					case 0:
					default:
					// inactive/undefined ?>
						Currently detected theme is: <strong><?php echo $theme_name; ?></strong>.<br>
						This plugin is designed to work only with the supported themes. <br>
						The plugin is <strong style="color: #800000;">INACTIVE</strong> and can be disabled and/or removed. <?php
					break; ?>
			<?php endswitch; ?>
			</p></div>
			<?php endif; ?>
			<?php if ($this->renamed_theme) :?>
			<div class="notice error">
				<p style="font-size: 1.4em; ">The plugin has detected that you have renamed the theme folder - this will limit your ability to update the theme.<br>
				If you need to customize the theme code, we strongly recommend using a <a href="http://www.cryoutcreations.eu/wordpress-themes/wordpress-tutorials/wordpress-child-themes" target="_blank">child theme</a>.</p>
			</div>
			<?php endif; ?>

		<div id="poststuff">
		<div id="post-body" class="metabox-holder columns-2">

			<div id="post-body-content">

					<div class="postbox">
						<h3 class="hndle"><span>About</span></h3>
						<div class="inside">
							<?php if ($this->status != 4) { ?>
								<p>This plugin is designed to inter-operate with the supported themes to enable their advanced theme settings pages:</p>
								<ul>	<li><a href="http://wordpress.org/themes/mantra" target="_blank"><img src="<?php echo $url . '/mantra.jpg'; ?>" /><span>Mantra</span></a> version 2.5 and newer</li>
								<li><a href="http://wordpress.org/themes/nirvana" target="_blank"><img src="<?php echo $url . '/nirvana.jpg'; ?>" /><span>Nirvana</span></a> version 1.2 and newer</li>
								<li><a href="http://wordpress.org/themes/parabola" target="_blank"><img src="<?php echo $url . '/parabola.jpg'; ?>" /><span>Parabola</span></a> version 1.6 and newer</li>
								<li><a href="http://wordpress.org/themes/tempera" target="_blank"><img src="<?php echo $url . '/tempera.jpg'; ?>" /><span>Tempera</span></a> version 1.4 and newer</li>	</ul>
								<p>If you are using a different theme or a theme version not listed here this plugin will not activate.</p>
							<?php } else { ?>
								<p>
								This plugin restores the settings page to working condition on WordPress 4.4-RC1 and newer with:
								<ul>	<li><a href="http://wordpress.org/themes/mantra" target="_blank"><img src="<?php echo $url . '/mantra.jpg'; ?>" /><span>Mantra</span></a> versions 2.0 to 2.4.1.1</li>
								<li><a href="http://wordpress.org/themes/parabola" target="_blank"><img src="<?php echo $url . '/parabola.jpg'; ?>" /><span>Parabola</span></a> versions 0.9 to 1.5.1</li>
								<li><a href="http://wordpress.org/themes/tempera" target="_blank"><img src="<?php echo $url . '/tempera.jpg'; ?>" /><span>Tempera</span></a> versions 0.9 to 1.3.3</li>		</ul>
								</p>
								<p>If you are using a different theme or a theme version not listed here this plugin will not activate.</p>
							<?php } ?>
						</div>
					</div>

					<div class="postbox">
						<h3 class="hndle"><span>Our Latest Themes</span></h3>
						<div class="inside">
							<?php $themes = array_slice( $this->get_suggested_themes(), 0, 4 ); ?>
							<ul> <?php foreach ( $themes as $theme ) { ?>
								<li><?php printf( '<a href="https://www.cryoutcreations.eu/wordpress-themes/%1$s" target="_blank"><img src="%2$s/%1$s.jpg" /><span>%3$s</span></a> ', $theme, $url, ucwords( $theme ) ); ?> </li>
							<?php } // foreach ?> </ul>
						</div>
					</div>

			</div> <!-- post-body-content-->

			<div class="postbox-container" id="postbox-container-1">

						<div class="meta-box-sortables">

							<div class="postbox">
								<h3 style="text-align: center;" class="hndle">
									<span><strong>Serious Theme Settings</strong></span>
								</h3>

								<div class="inside">
									<div style="text-align: center; margin: auto">
										<strong>version: <?php echo $this->version ?></strong><br>
										by Cryout Creations<br>
										<a target="_blank" href="https://www.cryoutcreations.eu/wordpress-plugins/cryout-theme-settings/">www.cryoutcreations.eu</a>
									</div>
								</div>
							</div>

							<div class="postbox">
								<h3 style="text-align: center;" class="hndle"> 
								<span>Support</span>
								</h3>

								<div class="inside">
									<div style="text-align: center; margin: auto">
										For support questions, issues<br>
										or suggestions, please use <a target="_blank" href="https://www.cryoutcreations.eu/forums/f/wordpress/plugins/serious-settings">our forum</a>.
									</div>
								</div>
							</div>
						</div>
			</div> <!-- postbox-container -->

		</div> <!-- post-body -->
		<br class="clear">
		</div> <!-- poststuff -->

	</div><!--end wrap-->

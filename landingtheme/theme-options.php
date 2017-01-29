<?php

add_action( 'admin_init', 'theme_options_init' );
add_action( 'admin_menu', 'theme_options_add_page' );

/**
 * Init plugin options to white list our options
 */
function theme_options_init(){
	register_setting( 'sample_options', 'landingtheme_options', 'theme_options_validate' );
}

/**
 * Load up the menu page
 */
function theme_options_add_page() {
	add_theme_page( __( 'Landing Theme Options', 'landingtheme' ), __( 'Landing Theme Options', 'landingtheme' ), 'edit_theme_options', 'theme_options', 'theme_options_do_page' );
}

/**
 * Create arrays for our select and radio options
 */
$select_options = array(
	'blue' => array(
		'value' =>	'blue',
		'label' => __( 'blue', 'landingtheme' )
	),
	'pink' => array(
		'value' =>	'pink',
		'label' => __( 'pink', 'landingtheme' )
	),
	'purple' => array(
		'value' => 'purple',
		'label' => __( 'purple', 'landingtheme' )
	),
	'tomato' => array(
		'value' => 'tomato',
		'label' => __( 'tomato', 'landingtheme' )
	)
);

$radio_options = array(
	'yes' => array(
		'value' => 'yes',
		'label' => __( 'Yes', 'landingtheme' )
	),
	'no' => array(
		'value' => 'no',
		'label' => __( 'No', 'landingtheme' )
	),
	'maybe' => array(
		'value' => 'maybe',
		'label' => __( 'Maybe', 'landingtheme' )
	)
);

/**
 * Create the options page
 */
function theme_options_do_page() {
	global $select_options, $radio_options;

	if ( ! isset( $_REQUEST['settings-updated'] ) )
		$_REQUEST['settings-updated'] = false;

	?>
	<div class="wrap">
		<?php screen_icon(); echo "<h2>" . get_current_theme() . __( ': Options', 'landingtheme' ) . "</h2>"; ?>

		<?php if ( false !== $_REQUEST['settings-updated'] ) : ?>
		<div class="updated fade"><p><strong><?php _e( 'Options saved', 'landingtheme' ); ?></strong></p></div>
		<?php endif; ?>

		<form method="post" action="options.php">
			<?php settings_fields( 'sample_options' ); ?>
			<?php $options = get_option( 'landingtheme_options' ); ?>

			<table class="form-table">

				<?php
				/**
				 * A sample text input option
				 */
				?>
				<tr valign="top"><th scope="row"><?php _e( 'Phone', 'landingtheme' ); ?></th>
					<td>
						<input id="landingtheme_options[phonetext]" class="regular-text" type="text" name="landingtheme_options[phonetext]" value="<?php esc_attr_e( $options['phonetext'] ); ?>" />
					</td>
				</tr>
				<tr valign="top"><th scope="row"><?php _e( 'Website', 'landingtheme' ); ?></th>
					<td>
						<input id="landingtheme_options[sitetext]" class="regular-text" type="text" name="landingtheme_options[sitetext]" value="<?php esc_attr_e( $options['sitetext'] ); ?>" />
					</td>
				</tr>
				<tr valign="top"><th scope="row"><?php _e( 'Skype', 'landingtheme' ); ?></th>
					<td>
						<input id="landingtheme_options[skypetext]" class="regular-text" type="text" name="landingtheme_options[skypetext]" value="<?php esc_attr_e( $options['skypetext'] ); ?>" />
					</td>
				</tr>

				<?php
				/**
				 * A sample select input option
				 */
				?>
				<tr valign="top"><th scope="row"><?php _e( 'Choose color scheme', 'landingtheme' ); ?></th>
					<td>
						<select name="landingtheme_options[selectinput]">
							<?php
								$selected = $options['selectinput'];
								$p = '';
								$r = '';

								foreach ( $select_options as $option ) {
									$label = $option['label'];
									if ( $selected == $option['value'] ) // Make default first in list
										$p = "\n\t<option style=\"padding-right: 10px;\" selected='selected' value='" . esc_attr( $option['value'] ) . "'>$label</option>";
									else
										$r .= "\n\t<option style=\"padding-right: 10px;\" value='" . esc_attr( $option['value'] ) . "'>$label</option>";
								}
								echo $p . $r;
							?>
						</select>
						<label class="description" for="landingtheme_options[selectinput]"></label>
					</td>
				</tr>
				
			</table>

			<p class="submit">
				<input type="submit" class="button-primary" value="<?php _e( 'Save Options', 'landingtheme' ); ?>" />
			</p>
		</form>
	</div>
	<?php
}

/**
 * Sanitize and validate input. Accepts an array, return a sanitized array.
 */
function theme_options_validate( $input ) {
	global $select_options, $radio_options;

	// Our checkbox value is either 0 or 1
	if ( ! isset( $input['option1'] ) )
		$input['option1'] = null;
	$input['option1'] = ( $input['option1'] == 1 ? 1 : 0 );

	// Say our text option must be safe text with no HTML tags
	$input['sometext'] = wp_filter_nohtml_kses( $input['sometext'] );

	// Our select option must actually be in our array of select options
	if ( ! array_key_exists( $input['selectinput'], $select_options ) )
		$input['selectinput'] = null;

	// Our radio option must actually be in our array of radio options
	if ( ! isset( $input['radioinput'] ) )
		$input['radioinput'] = null;
	if ( ! array_key_exists( $input['radioinput'], $radio_options ) )
		$input['radioinput'] = null;

	// Say our textarea option must be safe text with the allowed tags for posts
	$input['sometextarea'] = wp_filter_post_kses( $input['sometextarea'] );

	return $input;
}

// adapted from http://planetozh.com/blog/2009/05/handling-plugins-options-in-wordpress-28-with-register_setting/
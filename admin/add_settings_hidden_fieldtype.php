 <?php 
/*
 * Plugin Name: Easy Digital Downloads - Add the "input hidden" field type to the EDD settings
 * Description: Add <code>input type="hidden"</code> to the type of input fields avaiable when set up your plugin's EDD settings
 * Author: Stefano Garuti - garubi
 * Version: 1.0
 */

/* 
 Here we define new field type for EDD settings: input hidden
*/
function edd_hidden_callback( $args ) {
	global $edd_options;
	if ( isset( $edd_options[ $args['id'] ] ) )
		$value = $edd_options[ $args['id'] ];
	else
		$value = isset( $args['std'] ) ? $args['std'] : '';
	$size = ( isset( $args['size'] ) && ! is_null( $args['size'] ) ) ? $args['size'] : 'regular';
	$html = '<input type="hidden" class="' . $size . '-text" id="edd_settings[' . $args['id'] . ']" name="edd_settings[' . $args['id'] . ']" value="' . esc_attr( stripslashes( $value ) ) . '"/>';
	echo $html;
}
?>
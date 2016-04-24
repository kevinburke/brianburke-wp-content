<?php
/** Theme Options */
function get_retina_options( $key = 'retina_options' ) {
	
	/** Setup Cache */
	static $retina_options = array();
	if ( ! empty( $retina_options ) ) {
		return $retina_options;
	}
	
	$retina_options = get_option( $key );
	return $retina_options;

}

/**
 * Avoid "Undefined Index"
 * Must be passed by reference
 */
function retina_undefined_index_fix( &$var ) {

	if ( isset( $var ) ) {
		return $var;
	}
	
	return '';
}
?>
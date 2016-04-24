<?php
/** Load Retina Constants */
add_action( 'retina_init', 'retina_constants' );
function retina_constants() {
	
	/** Directory Location Constants */
	define( 'RETINA_DIR', get_template_directory() );
	define( 'RETINA_LIB_DIR', RETINA_DIR . '/lib' );
	
	/** URI Location Constants */
	define( 'RETINA_URL', get_template_directory_uri() );
	define( 'RETINA_LIB_URL', RETINA_URL . '/lib' );	

}

/** Load Retina Framework */
add_action( 'retina_init', 'retina_framework' );
function retina_framework() {

	/** Load Functions */
	require_once( RETINA_LIB_DIR . '/functions/general.php' );
	require_once( RETINA_LIB_DIR . '/functions/filters.php' );
	require_once( RETINA_LIB_DIR . '/functions/image.php' );
	
	/** Load Widgets */
	require_once( RETINA_LIB_DIR . '/widgets/widgets.php' );
	
	/** Load Structure */
	require_once( RETINA_LIB_DIR . '/structure/setup.php' );
	require_once( RETINA_LIB_DIR . '/structure/custom-header.php' );
	require_once( RETINA_LIB_DIR . '/structure/header.php' );	
	require_once( RETINA_LIB_DIR . '/structure/sidebar.php' );
	require_once( RETINA_LIB_DIR . '/structure/menu.php' );
	require_once( RETINA_LIB_DIR . '/structure/post.php' );
	require_once( RETINA_LIB_DIR . '/structure/footer.php' );
	
	/** Load Scripts */
	require_once( RETINA_LIB_DIR . '/js/scripts.php' );

}

/** 
 * All the components of Retina are properly hooked at "retina_init" for "retina_setup" and "other" Hooks.
 */
do_action( 'retina_before_init' );
do_action( 'retina_init' );
do_action( 'retina_after_init' );

/** 
 * "retina_before_setup" is an ideal Hook for the Retina Child themes for any modifications that
 * were previous integrated at "retina_init" Hook. 
 */
do_action( 'retina_before_setup' );
do_action( 'retina_setup' );
do_action( 'retina_after_setup' );
?>
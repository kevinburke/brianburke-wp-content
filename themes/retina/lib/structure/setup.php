<?php
/** Set the content width based on the theme's design and stylesheet. */
add_action( 'retina_setup', 'retina_content_width_init' );
function retina_content_width_init() {	
	retina_content_width();
}

/** Theme Content Width */
function retina_content_width( $args = array() ) {
	
	global $content_width;	
	
	$defaults = array (
		'content_width'	=>	'615',
	);
	$args = wp_parse_args( $args, $defaults );
	
	if ( !isset( $content_width ) ) {
		$content_width = $args['content_width'];
	}

}

/** 
 * Tell WordPress to run retina_setup_theme_init() when the 'after_setup_theme' hook is run.
 */
add_action( 'after_setup_theme', 'retina_setup_theme_init' );

if ( ! function_exists( 'retina_setup_theme_init' ) ):

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * To override retina_setup_theme_init() in a child theme, add your own retina_setup_theme_init to your child theme's
 * functions.php file.
 *
 */
	
	function retina_setup_theme_init() {
		
		/** This theme styles the visual editor with editor-style.css to match the theme style. */
		add_editor_style();
		
		/** Add default posts and comments RSS feed links to <head>. */
		add_theme_support( 'automatic-feed-links' );		
		
		/** This theme uses Featured Images (also known as post thumbnails) for per-post/per-page Custom Header images */
		add_theme_support( 'post-thumbnails' );
		
		/** Add support for custom header */
		do_action( 'retina_custom_header' );
		
		/** Add support for custom backgrounds */
		add_custom_background();
		
		if ( is_admin() ) :
		
		/** Load up our theme options page and related code. */
		require_once( RETINA_LIB_DIR . '/admin/options.php' );
		add_action( 'admin_init' , array( 'Retina_Options', 'retina_theme_options_init' ) );
		add_action( 'admin_init' , array( 'Retina_Options', 'retina_default_theme_options' ) );	
		add_action( 'admin_init' , array( 'Retina_Options', 'retina_admin_enqueue_scripts' ) );
		add_action( 'admin_menu' , array( 'Retina_Options', 'retina_theme_options_add_page' ) );
				
		endif;					
	
	}

endif;
?>
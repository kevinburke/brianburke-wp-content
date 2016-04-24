<?php
/** Register Primary Sidebar */
add_action( 'retina_register_sidebar', 'retina_register_primary_sidebar_init' );
function retina_register_primary_sidebar_init() {	
	$args = array ( 
		'name' => 'Primary Sidebar',
		'id' => 'primary-sidebar',
		'description' => 'Primary sidebar of your blog'
	);
	retina_register_sidebar_init( $args );	
}

/**
 * Registration Methods
 */

/** Register Widget */
function retina_register_widget_init( $arg ) {
	
	if( !empty( $arg ) ) {
		return register_widget( $arg );		 
	}
	
}

/** Register Sidebar */
function retina_register_sidebar_init( $args = array() ) {
	
	$defaults = array (
		'before_widget'	=>	'<div id="%1$s" class="%2$s"><div class="widget-wrap">',
		'after_widget'	=>	'<div class="clear"></div></div></div>',
		'before_title'	=>	'<h2 class="widget-title">',
		'after_title'	=> '</h2>',
	);
	
	$defaults = apply_filters( 'retina_register_sidebar_defaults', $defaults );	
	$args = wp_parse_args( $args, $defaults );
	
	return register_sidebar( $args );		 
	
}

/** Theme Sidebars/Widgets */
add_action( 'widgets_init', 'retina_widgets_init' );
function retina_widgets_init() {
	
	/** Register Sidebar Hook */
	do_action( 'retina_register_sidebar' );	
	
}
?>
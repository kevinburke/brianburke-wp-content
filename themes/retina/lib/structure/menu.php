<?php
/** This theme uses wp_nav_menu() in two locations.*/
register_nav_menus(
	array( 'primary-menu' => 'Primary Menu' )
);

/**
 * Primary Menu
 */

/** Primary Menu Callback */
function retina_primary_menu_cb() {
	wp_page_menu ();		 
}

/** Build Primary Menu */
function retina_primary_menu() {
	
	echo '<div class="menu1">
			<div class="menu1-data">';
	
	if ( has_nav_menu( 'primary-menu' ) ):
	
		$args = array(
			
		'container' => 'div', 
		'container_class' => 'primary-container', 
		'theme_location' => 'primary-menu',
		'menu_class' => 'sf-menu1',
		'depth' => 0,
		'fallback_cb' => 'retina_primary_menu_cb'
						
		);
		
		wp_nav_menu( $args );
	
	else:
	
		retina_primary_menu_cb();
	
	endif;
	
	echo '<div class="clear"></div>
			</div> <!-- end .menu1-data -->
		  </div> <!-- end .menu1 -->';
	
}

/** Primary Menu Init */
add_action( 'retina_after_header', 'retina_primary_menu_init' );
function retina_primary_menu_init() {	
	retina_primary_menu();	
}
?>
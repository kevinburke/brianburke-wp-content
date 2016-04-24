<?php
/** Theme Custom Header */
add_action( 'retina_custom_header', 'retina_custom_header_admin_init' ); 
function retina_custom_header_admin_init() {

	/** The default header text color */
	define( 'HEADER_TEXTCOLOR', 'dcdcdc' );
	/** By leaving empty, we allow for random image rotation. */
	define( 'HEADER_IMAGE', '' );
	/** The height and width of your custom header. */
	define( 'HEADER_IMAGE_WIDTH', 960 );
	define( 'HEADER_IMAGE_HEIGHT', 200 );
	/** Header Text */
	define( 'NO_HEADER_TEXT', false );
	
	/** Turn on random header image rotation by default. */
	add_theme_support( 'custom-header', array( 'random-default' => true ) );
	/** Add a way for the custom header to be styled in the admin panel that controls */
	add_custom_image_header( 'retina_header_style', 'retina_admin_header_style' );
	
	/** Default custom headers packaged with the theme. %s is a placeholder for the theme template directory URI. */
	register_default_headers( array(
		
		'retina' =>	array(
			'url' => '%s/images/headers/header-retina.png',
			'thumbnail_url' => '%s/images/headers/header-retina-thumbnail.png',
			'description' => 'Retina'
		),
		
		'bubbles' =>	array(
			'url' => '%s/images/headers/header-bubbles.png',
			'thumbnail_url' => '%s/images/headers/header-bubbles-thumbnail.png',
			'description' => 'Bubbles'
		),
		
		'dawn' =>	array(
			'url' => '%s/images/headers/header-dawn.png',
			'thumbnail_url' => '%s/images/headers/header-dawn-thumbnail.png',
			'description' => 'Dawn'
		),	
	
	) );

}

/** Styles the header image and text displayed on the blog */
function retina_header_style() {
	
	$headimg = sprintf( '#headimg { border: none; background: url(%s) no-repeat; font-family: Georgia, Times, serif; width: %spx; height: %spx; text-align: center; text-shadow: #8e8e8e 1px 1px; }', get_header_image(), HEADER_IMAGE_WIDTH, HEADER_IMAGE_HEIGHT );
	$headimgdata = sprintf( '#headimg-data {}' );	
	$h1 = sprintf( '#headimg h1, #headimg h1 a { margin:0px; padding-top:50px; color: #%s; font-size: 48px; font-weight: normal; text-decoration: none; }', esc_html( get_header_textcolor() ) );
	$desc = sprintf( '#headimg #desc { margin:0px; padding-top:5px; color: #%s; font-size: 20px; font-style: italic;  }', esc_html( get_header_textcolor() ) );

	printf( '<style type="text/css">%1$s %2$s %3$s %4$s</style>', $headimg, $headimgdata, $h1, $desc );
	
}

/** Styles the header image displayed on the Appearance > Header admin panel. */
function retina_admin_header_style() {

	$headimg = sprintf( '.appearance_page_custom-header #headimg { border: none; background: url(%s) no-repeat; font-family: Georgia, Times, serif; width: %spx; height: %spx; text-align: center; text-shadow: #8e8e8e 1px 1px; }', get_header_image(), HEADER_IMAGE_WIDTH, HEADER_IMAGE_HEIGHT );
	$h1 = sprintf( '#headimg h1, #headimg h1 a { margin:0px; padding-top:65px; color: #%s; font-size: 48px; font-weight: normal; text-decoration: none; }', esc_html( get_header_textcolor() ) );
	$desc = sprintf( '#headimg #desc { margin:0px; padding-top:25px; color: #%s; font-size: 20px; font-style: italic; }', esc_html( get_header_textcolor() ) );

	printf( '<style type="text/css">%1$s %2$s %3$s</style>', $headimg, $h1, $desc );

}
?>
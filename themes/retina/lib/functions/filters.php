<?php
/** Sets the post excerpt length. */
add_filter( 'excerpt_length', 'retina_excerpt_length' );
function retina_excerpt_length( $length ) {
	return 50;
}

/** Returns a "Continue Reading" link for content */
add_filter( 'the_content_more_link', 'retina_content_more_link', 10, 2 );
function retina_content_more_link( $more_link, $more_link_text ) {
	return str_replace( $more_link_text, '<span>Continue Reading &rarr;</span>', $more_link );
}

/** Returns a "Continue Reading" link for excerpts */
function retina_continue_reading_link() {
	return '<p><a href="'. esc_url( get_permalink() ) . '" class="more-link"><span>Continue Reading &rarr;</span></a></p>';
}

/** Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and retina_continue_reading_link(). */
add_filter( 'excerpt_more', 'retina_auto_excerpt_more' );
function retina_auto_excerpt_more( $more ) {
	return ' &hellip;' . retina_continue_reading_link();
}	

/** Adds a pretty "Continue Reading" link to custom post excerpts. */
add_filter( 'get_the_excerpt', 'retina_custom_excerpt_more' );
function retina_custom_excerpt_more( $output ) {
	
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= ' &hellip;' . retina_continue_reading_link();
	}
	return $output;

}	
	
/** Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link. */
add_filter( 'wp_page_menu_args', 'retina_page_menu_args' );
function retina_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}	

/** Remove Gallery CSS */
add_filter( 'gallery_style', 'retina_remove_gallery_css' );
function retina_remove_gallery_css( $css ) {
	return preg_replace( "#<style type='text/css'>(.*?)</style>#s", '', $css );
}		
?>
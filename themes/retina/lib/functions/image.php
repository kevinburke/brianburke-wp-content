<?php
/** Retina Get Image Id */
function retina_get_image_id( $num = 0 ) {
	global $post;

	$image_ids = array_keys(
		get_children(
			array(
				'post_parent' => $post->ID,
				'post_type' => 'attachment',
				'post_mime_type' => 'image',
				'orderby' => 'menu_order',
				'order' => 'ASC'
			)
		)
	);

	if ( isset( $image_ids[$num] ) ) {
		return $image_ids[$num];
	}

	return false;
}

/** Retina Get Image*/
function retina_get_image( $args = array() ) {
	
	global $post;

	/** Arguments */
	$defaults = array( 'format' => 'html', 'size' => 'full', 'num' => 0, 'attr' => '' );	
	$defaults = apply_filters( 'retina_get_image_defaults', $defaults );	
	$args = wp_parse_args( $args, $defaults );

	/** WordPress built-in method */
	if ( has_post_thumbnail() && ( $args['num'] === 0 ) ) {
		
		$id = get_post_thumbnail_id();
		$html = wp_get_attachment_image( $id, $args['size'], false, $args['attr'] );
		list( $url ) = wp_get_attachment_image_src( $id, $args['size'], false, $args['attr'] );
	
	}
	
	/** Grab the first attachment image */		
	else {
		
		$id = retina_get_image_id( $args['num'] );
		$html = wp_get_attachment_image( $id, $args['size'], false, $args['attr'] );
		list( $url ) = wp_get_attachment_image_src( $id, $args['size'], false, $args['attr'] );
	
	}

	/** Source path, relative to the root */
	$src = str_replace( home_url(), '', $url );

	/** Output Logic */
	if ( strtolower( $args['format'] ) == 'html' ) {
		$output = $html;
	} else if ( strtolower( $args['format'] ) == 'url' ) {
		$output = $url;
	} else {
		$output = $src;
	}

	/** return FALSE if $url is blank */
	if ( empty( $url ) ) {
		$output = FALSE;
	}

	/** return data, filtered */
	return apply_filters( 'retina_get_image_output', $output, $args, $id, $html, $url, $src );
}

/** Retina Image Sizes */
function retina_get_image_sizes() {
	
	$default_sizes = array(
		
		'none'		=> array(
			'width' => 0,
			'height' => 0
		),
		
		'large'		=> array(
			'width' => get_option('large_size_w'),
			'height' => get_option('large_size_h')
		),
		
		'medium'	=> array(
			'width' => get_option('medium_size_w'),
			'height' => get_option('medium_size_h')
		),
		
		'thumbnail'	=> array(
			'width' => get_option('thumbnail_size_w'),
			'height' => get_option('thumbnail_size_h')
		)
	);

	$additional_sizes = retina_get_additional_image_sizes();	
	return array_merge( $default_sizes, $additional_sizes );
}

/** Retina Additional Image Sizes */
function retina_get_additional_image_sizes() {
	global $_wp_additional_image_sizes;

	if ( ! empty( $_wp_additional_image_sizes ) ) {
		return $_wp_additional_image_sizes;
	}

	return array();
}
?>
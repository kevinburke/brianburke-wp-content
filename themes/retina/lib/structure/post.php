<?php
/** Post Date */
function retina_post_date() {
	
	$post_date = esc_html( get_the_date() ) . " " . esc_attr( get_the_time() );
	
	/** Output */
	$output = sprintf( '<span class="entry-date" title="%1$s"><a href="%2$s" title="%3$s" rel="bookmark">%1$s</a></span>', $post_date, esc_url( get_permalink() ), the_title_attribute( 'echo=0' ) );
	return $output;

}

/** Post Author */
function retina_post_author() {
	
	$output = sprintf( '<span class="entry-author author vcard"><a href="%1$s" title="View all posts by %2$s" rel="author">%2$s</a></span>', esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ), esc_html( get_the_author() ) );
	return $output;

}

/** Post Edit Link */
function retina_post_edit_link() {

	/** Manipulation */	
	ob_start();
	edit_post_link( 'Edit', '<span class="edit-link">', '</span>' );
	$output = ob_get_clean();
	
	return $output;

}

/** Post Comments */
function retina_post_comments() {
	
	if ( ( ! comments_open() || post_password_required() ) ) {
		return;
	}

	ob_start();
	comments_number( 'Leave a Comment', '1 Comment', '% Comments' );
	$comments = ob_get_clean();
	
	/** Output */
	$comments = sprintf( '<a href="%s">%s</a>', esc_url( get_comments_link() ), $comments );
	$output = sprintf( '<span class="comments-link">%1$s</span>', $comments );
	return $output;
}

/** Post Categories */
function retina_post_category() {
	
	$categories_list = get_the_category_list( ', ' );
	if ( ! $categories_list ) {
		return;
	}
		
	$output = sprintf( '<span class="cat-links"><span class="%1$s">Posted in</span> %2$s</span>', 'entry-utility-prep entry-utility-prep-cat-links', $categories_list );
	return $output;
}

/** Post Tags */
function retina_post_tags() {
	
	$tags_list = get_the_tag_list( '', ', ' );
	if ( ! $tags_list ) {
		return;
	}
		
	$output = sprintf( '<span class="tag-links"><span class="%1$s">Tagged</span> %2$s</span>', 'entry-utility-prep entry-utility-prep-tag-links', $tags_list );
	return $output;
}

/** Post Link Pages */
function retina_post_link_pages() {
	return wp_link_pages( array( 
		
		'before' => '<div class="page-link"><span class="assistive-text">Pages:</span>',
		'after' => '</div>',
		'link_before' => '<span>',
		'link_after' => '</span>',
		'echo' => 0
		
		)
	);
}

/** Display navigation to next/previous pages when applicable */
add_action( 'retina_after_content', 'retina_post_nav_init' );
function retina_post_nav_init() {

	global $wp_query;	
	
	if ( $wp_query->max_num_pages > 1 ) :
		
		$retina_options = get_retina_options();
		
		if ( $retina_options['retina_post_nav_style'] == 'numeric' ) :		
			retina_post_nav_numeric();		
		else:		
			retina_post_nav();		
		endif;
	
	endif;

}

/** Retina Post Nav: Default */
function retina_post_nav() {
?>
<div id="nav">
	<h3 class="assistive-text">Post Navigation</h3>
	<?php next_posts_link( '<div class="nav-previous"><span class="meta-nav">&larr;</span> Older Posts</div>' ); ?>
	<?php previous_posts_link( '<div class="nav-next">Newer Posts <span class="meta-nav">&rarr;</span></div>' ); ?>
<div class="clear"></div>
</div> <!-- end #nav -->
<?php
}

/** Retina Post Nav Numeric */
function retina_post_nav_numeric() {
	
	global $wp_query;
	$big = 999999999; // need an unlikely integer
	$args = array(
		'base' => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
		'format' => '?paged=%#%',
		'current' => max( 1, get_query_var('paged') ),
		'total' => $wp_query->max_num_pages
	);
	
?>
<div id="nav-numeric" class="nav-numeric">
	<h3 class="assistive-text">Post Navigation</h3>
	<?php echo paginate_links( $args ); ?>
<div class="clear"></div>
</div> <!-- end #nav-numeric -->
<?php	
}

/** Display navigation at single */
function retina_post_nav_single() {
?>
<div id="nav-single">
	<h3 class="assistive-text">Post navigation</h3>
	
    <?php
    ob_start();
	previous_post_link( '%link', '<span class="meta-nav">&larr;</span> Previous Post' );
	$previous_post_link = ob_get_clean();
	
	ob_start();
	next_post_link( '%link', 'Next Post <span class="meta-nav">&rarr;</span>' );
	$next_post_link = ob_get_clean();	
	
	if( !empty( $previous_post_link ) ):
	echo '<div class="nav-previous">' . $previous_post_link . '</div>';
	endif;
	
	if( !empty( $next_post_link ) ):
	echo '<div class="nav-next">' . $next_post_link . '</div>';
	endif;	
	?>

<div class="clear"></div>    
</div><!-- #nav-single -->
<?php
}

/** Retina Author */
function retina_author() {
if ( get_the_author_meta( 'description' ) && is_multi_author() ) :	
?>
<div id="author-info">
  
	<div id="author-avatar">
		<?php echo get_avatar( get_the_author_meta( 'user_email' ), 70 ); ?>
	</div><!-- #author-avatar -->
  
	<div id="author-description">
		<h2><?php printf( 'About %s', get_the_author() ); ?></h2>
		<p><?php the_author_meta( 'description' ); ?></p>
		<div id="author-link">
			<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author"><?php printf( 'View all posts by %s <span class="meta-nav">&rarr;</span>', get_the_author() ); ?></a>
		</div><!-- #author-link	-->
	</div><!-- #author-description -->
  
	<div class="clear"></div>
</div><!-- #entry-author-info -->
<?php
endif;
}

/** Retina Comment List */
function retina_comment( $comment, $args, $depth ) {
  
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
?>
			<li class="post pingback">
				<p>Pingback: <?php comment_author_link(); ?> <?php edit_comment_link( 'Edit', '<span class="edit-link">', '</span>' ); ?></p>
		<?php
		break;
		default :
		?>
			
            <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
				
				<div id="comment-<?php comment_ID(); ?>" class="comment">
	    
					<div class="comment-meta">
						<div class="comment-author vcard">
		    
							<?php
                            $avatar_size = 60;
                            if ( '0' != $comment->comment_parent ) {
                            	$avatar_size = 60;
                            }                            
                            echo get_avatar( $comment, $avatar_size );
							?>
                            
                            <?php                            
                            printf( '%1$s on %2$s <span class="says">said:</span>',
                            	sprintf( '<span class="fn">%s</span>', get_comment_author_link() ),
                            	sprintf( '<a href="%1$s"><span pubdate datetime="%2$s">%3$s</span></a>', esc_url( get_comment_link( $comment->comment_ID ) ), get_comment_time( 'c' ),
                            		sprintf( '%1$s at %2$s', get_comment_date(), get_comment_time() )
                            		)
                            );                            
                            ?>

							<?php edit_comment_link( 'Edit', '<span class="edit-link">', '</span>' ); ?>
		  
						</div> <!-- end .comment-author .vcard -->

						<?php if ( $comment->comment_approved == '0' ) : ?>
						<em class="comment-awaiting-moderation">Your comment is awaiting moderation.</em><br />
						<?php endif; ?>

					</div> <!-- end .comment-meta -->

					<div class="comment-content">
					  <?php comment_text(); ?>
                    </div> <!-- end .comment-content -->

					<div class="reply">
						<?php comment_reply_link( array_merge( $args, array( 'reply_text' => 'Reply <span>&darr;</span>', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
					</div><!-- .reply -->
		
				</div><!-- end #comment-<?php comment_ID(); ?> -->

		<?php
		break;
		endswitch;
}

/** Nothing Found */
add_action( 'retina_notfound', 'retina_nothing_found' );
function retina_nothing_found() {
?>
<div id="post-0" class="post no-results not-found">
  
	<h1 class="entry-title">Nothing Found</h1>
	<div class="entry-content">
		<p>Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.</p>
	<?php get_search_form(); ?>
	</div><!-- .entry-content -->

</div><!-- #post-0 -->
<?php
}

/** Post Style */
function retina_post_style() {
	
	$retina_options = get_retina_options();
	
	if( $retina_options['retina_post_style'] == 'excerpt' ):
		
		$img = retina_get_image( array( 'format' => 'html', 'size' => 'thumbnail', 'attr' => array( 'class' => 'entry-image' ) ) );
		printf( '<div class="entry-image-wrap"><a href="%s" title="%s">%s</a></div>', esc_url( get_permalink() ), the_title_attribute( 'echo=0' ), $img );
		the_excerpt();
	
	else:
		
		the_content( 'Continue Reading <span class="meta-nav">&rarr;</span>' );
	
	endif;

}
?>
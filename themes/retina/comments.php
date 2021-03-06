<div id="comments">
  
  <?php if ( post_password_required() ) : ?>
  <p class="nopassword">This post is password protected. Enter the password to view any comments.</p>
  </div><!-- #comments -->
  <?php
  /**
    * Stop the rest of comments.php from being processed,
    * but don't kill the script entirely -- we still have
    * to fully load the template.
    */
	return;
	endif;
  ?>

  <?php if ( have_comments() ) : ?>
  
  <h2 id="comments-title">
    <?php printf( _n( 'One Thought on &ldquo;%2$s&rdquo;', '%1$s Thoughts on &ldquo;%2$s&rdquo;', get_comments_number() ), get_comments_number(), '<span>' . get_the_title() . '</span>' ); ?>
  </h2>

  <ol class="commentlist">
    <?php wp_list_comments( apply_filters ( 'retina_list_comments', array( 'callback' => 'retina_comment' ) ) ); ?>
  </ol>

  <?php if ( get_comment_pages_count() > 1 ) : ?>
  <div id="comment-nav-below">
	<h3 class="assistive-text">Comment navigation</h3>
	
	<?php
    ob_start();
	previous_comments_link( '&larr; Older Comments' );
	$previous_comments_link = ob_get_clean();
	
	ob_start();
	next_comments_link( 'Newer Comments &rarr;' );
	$next_comments_link = ob_get_clean();	
	
	if( !empty( $previous_comments_link ) ):
	echo '<div class="nav-previous">' . $previous_comments_link . '</div>';
	endif;
	
	if( !empty( $next_comments_link ) ):
	echo '<div class="nav-next">' . $next_comments_link . '</div>';
	endif;	
	?>
    
  <div class="clear"></div>
  </div>
  <?php endif; ?>

  <?php
  /**
    * If there are no comments and comments are closed, let's leave a little note, shall we?
	* But we don't want the note on pages or post types that do not support comments.
	*/
  elseif ( ! comments_open() && ! is_page() && post_type_supports( get_post_type(), 'comments' ) ) :
  ?>
  <p class="nocomments">Comments are closed.</p>
  <?php endif; ?>

  <?php comment_form(); ?>

</div><!-- #comments -->
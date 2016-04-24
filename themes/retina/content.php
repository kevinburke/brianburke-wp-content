<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  
  <h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr( 'Permalink to %s' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
  
  <?php if ( is_sticky() ) : ?>
  <h2 class="entry-format">Featured</h2>
  <?php endif; ?>
  
  <div class="entry-meta">
    <?php
    if ( 'post' == get_post_type() ) :
    echo retina_post_date() . retina_post_author() . retina_post_comments() . retina_post_edit_link();
    else:
    echo retina_post_edit_link();
    endif;
    ?>    
  </div><!-- .entry-meta -->
  
  <div class="entry-content">
  	<?php retina_post_style(); ?>
  <div class="clear"></div>
  </div> <!-- end .entry-content -->
  
  <?php echo retina_post_link_pages(); ?>
  
  <?php if ( 'post' == get_post_type() ) : ?>
    <div class="entry-meta">
        <?php echo retina_post_category() . retina_post_tags(); ?>
    </div><!-- .entry-meta -->
    <?php endif; ?>

<div class="clear"></div>
</div> <!-- end #post-<?php the_ID(); ?> .post_class -->
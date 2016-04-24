<?php get_header();	?>
    
    <?php if ( have_posts() ) : ?>
    
    <?php
	/**
	  * Queue the first post, that way we know
	  * what author we're dealing with (if that is the case).
	  *
	  * We reset this later so we can run the loop
	  * properly with a call to rewind_posts().
	  */
	the_post();
	?>
          
      <div id="page-header">
        <div id="page-header-data">
            
          <h1 class="page-title"><?php printf( 'Author Archives: %s', '<span>' . get_the_author() . '</span>' ); ?></h1>     
            
        </div>
      </div>
          
    <?php
	/**
	  * Since we called the_post() above, we need to
	  * rewind the loop back to the beginning that way
	  * we can run the loop properly, in full.
	  */
	rewind_posts();
	?>
	
	<?php endif; ?>
    
    <div id="grid">
      <div id="grid-data">      
          
          <div id="content">
            <div id="content-data">
              
			  <?php if ( have_posts() ) : ?>
                
				<?php do_action( 'retina_before_content' ); ?>
				
				<?php while ( have_posts() ) : the_post(); ?>
                  
                  <?php get_template_part( 'content' ); ?>
                   
                <?php endwhile; ?>
                
                <?php do_action( 'retina_after_content' ); ?>
              
			  <?php else : ?>
              
              	<?php do_action( 'retina_notfound' ); ?>
              
              <?php endif; ?>
              
            <div class="clear"></div>
            </div> <!-- end #content-data --> 
          </div> <!-- end #content -->	              
          
		<?php get_sidebar(); ?>        	  
      
      <div class="clear"></div>
      </div> <!-- end #grid-data -->  
    </div> <!-- end #grid --> 
<?php get_footer(); ?>
<?php get_header();	?>
    
    <?php if ( have_posts() ) : ?>
          
      <div id="page-header">
        <div id="page-header-data">
            
          <h1 class="page-title"><?php printf( 'Category Archives: %s', '<span>' . ucfirst( strtolower ( single_cat_title( '', false ) ) ) . '</span>' ); ?></h1>     
            
        </div>
      </div>
          
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
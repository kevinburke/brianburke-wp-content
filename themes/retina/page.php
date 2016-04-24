<?php get_header();	?>
    <div id="grid">
      <div id="grid-data">      
        
          <div id="content">
            <div id="content-data">
              
			  <?php the_post(); ?>
              
              <?php get_template_part( 'content', 'page' ); ?>              
              
            <div class="clear"></div>
            </div> <!-- end #content-data --> 
          </div> <!-- end #content -->	              
          
		<?php get_sidebar(); ?>        	  
      
      <div class="clear"></div>
      </div> <!-- end #grid-data -->  
    </div> <!-- end #grid --> 
<?php get_footer(); ?>
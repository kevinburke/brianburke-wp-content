<?php get_header();	?>
    
          
    <div id="page-header">
      <div id="page-header-data">
            
        <h1 class="page-title"><span>404</span></h1>     
            
      </div>
    </div>
         
    
    <div id="grid">
      <div id="grid-data">      
          
          <div id="content">
            <div id="content-data">
              
			  <div id="post-0" class="post error404 not-found">
  
                  <h1 class="entry-title">This is somewhat embarrassing, isn&rsquo;t it?</h1>
                  <div class="entry-content">
                    
                    <p>It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching, or one of the links below, can help.</p>               
                    
                    <?php get_search_form(); ?>
					
					<?php the_widget( 'WP_Widget_Recent_Posts', array( 'number' => 10 ), array( 'widget_id' => '404' ) ); ?>
                    
                    <div class="widget">
					  <h2 class="widgettitle">Most Used Categories</h2>
					  <ul>
					    <?php wp_list_categories( array( 'orderby' => 'count', 'order' => 'DESC', 'show_count' => 1, 'title_li' => '', 'number' => 10 ) ); ?>
					  </ul>
					</div>
                    
                    <?php
					$archive_content = '<p>' . sprintf( 'Try looking in the monthly archives. %1$s', convert_smilies( ':)' ) ) . '</p>';
					the_widget( 'WP_Widget_Archives', array('count' => 0 , 'dropdown' => 1 ), array( 'after_title' => '</h2>' . $archive_content ) );
					?>

					<?php the_widget( 'WP_Widget_Tag_Cloud' ); ?>                   
                    
                  </div><!-- .entry-content -->
              
              </div><!-- #post-0 -->
              
            <div class="clear"></div>
            </div> <!-- end #content-data --> 
          </div> <!-- end #content -->	              
          
		<?php get_sidebar(); ?>        	  
      
      <div class="clear"></div>
      </div> <!-- end #grid-data -->  
    </div> <!-- end #grid --> 
<?php get_footer(); ?>
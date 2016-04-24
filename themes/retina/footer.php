    <div id="footer">
      <div id="footer-data">        
        <?php do_action( 'retina_before_footer' ); ?>
		<?php do_action( 'retina_footer' ); ?>
        <?php do_action( 'retina_after_footer' ); ?>        	
      </div> <!-- end #footer-data -->
    </div> <!-- end #footer -->
  
  </div>  <!-- end #wrap-data -->  
</div>  <!-- end #wrap -->
<?php
do_action( 'retina_after_wrap' );
wp_footer();
?>
</body>
</html>
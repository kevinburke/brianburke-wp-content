<?php
/** Post Date */
add_action( 'retina_footer', 'retina_info' );
function retina_info() {
	$retina_options = get_retina_options();
?>
<div id="info-wrap">
  <div id="info-wrap-data">
    
    <div id="blog-info"><?php echo htmlspecialchars_decode ( esc_html ( $retina_options['retina_copyright'] ) ); ?></div>    
    <div id="theme-info">Retina Theme by <a href="http://wpaisle.com/" title="WPAisle">WPAisle</a> &sdot; <a href="http://wordpress.org/" title="WordPress">WordPress</a></div>
    
  <div class="clear"></div>
  </div> <!-- end #info-wrap-data -->
</div> <!-- end #info-wrap -->
<?php
}
?>
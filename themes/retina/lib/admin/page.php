<div class="wrap">
  
  <?php screen_icon(); ?>
  <h2><?php echo sprintf( '%1$s Theme Settings', get_current_theme() ); ?></h2>    
  
  <div class="retina-tabs ui-tabs ui-widget ui-widget-content ui-corner-all">
   
     <div class="ui-state-default ui-corner-all">
       <h2>Retina</h2>
     </div>
   
     <div class="retina-tabs-content">
       <p><strong>Version:</strong> 0.1 &sdot; <strong>Released:</strong> November 02, 2011 &sdot; <strong>Author:</strong> <a href="http://wpaisle.com/" target="_blank">WPAisle</a></p>
       <p>Please visit <a href="http://wpaisle.ccom/retina/"><strong>Retina</strong></a> page for the support and documentation.</p>       
     </div>   
  
  </div>
  
  <?php settings_errors( 'retina_options' ); ?>
  
  <form action="options.php" method="post">
    
    <?php settings_fields('retina_options_group'); ?>
    
    <div id="retina_tabs" class="retina-tabs">
    
      <ul>
        <li><a href="#retina_section_post_tab">Post Options</a></li>
        <li><a href="#retina_section_general_tab">General Options</a></li>        
      </ul>
      
      <div id="retina_section_post_tab"><?php do_settings_sections( 'retina_section_post_page' ); ?></div>
      <div id="retina_section_general_tab"><?php do_settings_sections( 'retina_section_general_page' ); ?></div>      
    
    </div>
    
    <p class="submit">
      <input name="Submit" type="submit" class="button-primary" value="Save Changes" />
    </p>
  
  </form>

</div>

<script>
//<![CDATA[
jQuery(document).ready(function($){
    $( '#retina_tabs' ).tabs({
		cookie: { expires: 1 }
	});
});
//]]>
</script>
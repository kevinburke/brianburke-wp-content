<?php
/** Retina Header */
add_action( 'retina_header', 'retina_custom_header_init' );
function retina_custom_header_init() {
?>
<div id="headimg">
  <div id="headimg-data">        
    
    <?php 
    $header_textcolor = get_theme_mod( 'header_textcolor', HEADER_TEXTCOLOR );
    if( ( !empty( $header_textcolor ) && $header_textcolor != 'blank' ) ):
    ?>
    <h1><a id="name" href="<?php echo home_url( '/' ); ?>" title="<?php bloginfo( 'name' ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
    <div id="desc"><?php bloginfo( 'description' ); ?></div>
    <?php else: ?>
    <a href="<?php echo home_url( '/' ); ?>"><img src="<?php header_image(); ?>" width="<?php echo HEADER_IMAGE_WIDTH; ?>" height="<?php echo HEADER_IMAGE_HEIGHT; ?>" alt="<?php bloginfo( 'name' ); ?>" /></a>        
    <?php endif; ?>
  
  </div> <!-- end #headimg-data -->	
</div> <!-- end #headimg -->
<?php 
}
?>
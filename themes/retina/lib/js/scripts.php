<?php
/** Register Scripts */
add_action( 'retina_setup', 'retina_register_scripts' );
function retina_register_scripts() {
	
	wp_register_script( 'retina_script_hoverintent', RETINA_LIB_URL . '/js/hoverintent.min.js', array( 'jquery' ), '5', true );
	wp_register_script( 'retina_script_superfish', RETINA_LIB_URL . '/js/superfish.min.js', array( 'jquery' ), '1.4.8', true );
	wp_register_script( 'retina_script_supersubs', RETINA_LIB_URL . '/js/supersubs.min.js', array( 'jquery' ), '0.2', true );

}

/** Enqueue Scripts */
add_action( 'wp_print_styles', 'retina_print_scripts' );
function retina_print_scripts() {		
	
	wp_enqueue_script( 'jquery' );
	
	if( is_singular() ) : 
	wp_enqueue_script( 'comment-reply' );
	endif;
	
	wp_enqueue_script( 'retina_script_hoverintent' );
	wp_enqueue_script( 'retina_script_superfish' );
	wp_enqueue_script( 'retina_script_supersubs' );
	
}

/** Retina Analytic Code */
add_action( 'retina_after_wrap', 'retina_analytic_code_init' );
function retina_analytic_code_init() {
	
	$retina_options = get_retina_options();
	
	if( $retina_options['retina_analytic'] == 1 ) :	
	echo htmlspecialchars_decode ( $retina_options['retina_analytic_code'] );	
	echo '<!-- end analytic-code -->';	
	endif;

}

/** Retina JS Logic */
add_action( 'retina_after_wrap', 'retina_js_logic_init' );
function retina_js_logic_init() {
?>
<script language="javascript" type="text/javascript">
jQuery(document).ready(function($) {
	
	$( '.menu1 ul' ).supersubs( {   	
		
		minWidth: 12,
		maxWidth: 15,
		extraWidth: 1
	
	} ).superfish({
  	
		delay: 100,
		speed: 'fast',
		animation: { opacity:'show', height:'show' }
  
  });
  <!-- end .menu's -->
	
});
</script>
<?php
}
?>
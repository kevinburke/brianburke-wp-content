<?php
/**
* Retina Options Class
*/

class Retina_Options {

		
		/**
		* Theme Options Init
		*/
		
		function retina_theme_options_init() {
		
			/** Register Admin Stylesheet */
			wp_register_style( 'retina_admin_style', RETINA_LIB_URL . '/admin/style.css' );
			wp_register_style( 'retina_admin_style_ui_smoothness', RETINA_LIB_URL . '/js/ui/css/smoothness/jquery-ui-1.8.16.custom.css' );
			
			/** Register Admin Scripts */
			wp_register_script( 'retina_admin_script_jquery_cookie', RETINA_LIB_URL . '/js/jquery.cookie.js' );
			
			/** Register Theme Options */
			register_setting( 'retina_options_group', 'retina_options', array( 'Retina_Options', 'retina_theme_options_validate' ) );
			
			/** Post Section */
			add_settings_section( 'retina_section_post', 'Post Options', array( 'Retina_Options', 'retina_section_post_fn' ), 'retina_section_post_page' );			
			add_settings_field( 'retina_field_post_style', 'Post Style', array( 'Retina_Options', 'retina_field_post_style_fn' ), 'retina_section_post_page', 'retina_section_post' );
			add_settings_field( 'retina_field_post_nav_style', 'Post Navigation Style', array( 'Retina_Options', 'retina_field_post_nav_style_fn' ), 'retina_section_post_page', 'retina_section_post' );
			
			/** General Section */
			add_settings_section( 'retina_section_general', 'General Options', array( 'Retina_Options', 'retina_section_general_fn' ), 'retina_section_general_page' );
			
			add_settings_field( 'retina_field_analytic', 'Use Analytic', array( 'Retina_Options', 'retina_field_analytic_fn' ), 'retina_section_general_page', 'retina_section_general' );
			add_settings_field( 'retina_field_analytic_code', 'Enter Analytic Code', array( 'Retina_Options', 'retina_field_analytic_code_fn' ), 'retina_section_general_page', 'retina_section_general' );
			
			add_settings_field( 'retina_field_copyright', 'Enter Copyright Text', array( 'Retina_Options', 'retina_field_copyright_fn' ), 'retina_section_general_page', 'retina_section_general' );
			
			add_settings_field('retina_field_reset', 'Reset Theme Options', array( 'Retina_Options', 'retina_field_reset_fn' ), 'retina_section_general_page', 'retina_section_general' );
		
		}
		
		/**
		* Theme Options Add Page
		*/
		
		function retina_theme_options_add_page() {		
			$theme_page = add_theme_page( 'Retina Options', 'Retina Options', 'edit_theme_options', 'retina-options', array( 'Retina_Options', 'retina_theme_options_render_page' ) );
			if ( ! $theme_page ) return;
			$help = '<p>Some themes provide customization options that are grouped together on a Theme Options screen. If you change themes, options may change or disappear, as they are theme-specific. Your current theme, Retina, provides the following Theme Options:</p>
			<ol>
			  <li><strong>Post Options > Post Style</strong>: You can switch between content/excerpt Post style.</li>
			  <li><strong>General Options > Analytic Code</strong>: You can track your visitors by entering your Analytic code.</li>
			  <li><strong>General Options > Copyright Text</strong>: You can enter your own copyright text that will be displayed at the footer of the theme.</li>
			  <li><strong>General Options > Reset Theme Options</strong>: You can reset your theme options to the default.</li>
			</ol>
			<p>Remember to click "Save Changes" to save any changes you have made to the theme options.</p>
			';
			add_contextual_help( $theme_page, $help );
		}		
		
		/**
		* Theme Options Page
		*/
		
		function retina_theme_options_render_page() {
			require( RETINA_LIB_DIR . '/admin/page.php' );
		}
		
		/**
		* Admin Enqueue Scripts
		*/
		
		function retina_admin_enqueue_scripts() {
			
			wp_enqueue_script( 'jquery' );
			wp_enqueue_script( 'jquery-ui-tabs' );
			wp_enqueue_script( 'retina_admin_script_jquery_cookie' );			
			
			wp_enqueue_style( 'retina_admin_style' );
			wp_enqueue_style( 'retina_admin_style_ui_smoothness' );
		
		}		
		
		/**
		* Default Theme Options
		*/
		
		function retina_default_theme_options() {
		
			$retina_reset = false;
			$retina_options = get_option( 'retina_options' );
			
			/** Retina Reset Logic */
			if ( ! is_array( $retina_options ) ) {			
				$retina_reset = true;			
			} 						
			elseif ( $retina_options['retina_reset'] == 1 ) {			
				$retina_reset = true;			
			}			
			
			/** Let Reset Retina */
			if( $retina_reset == true ) {
				
				$default = array(
					
					'retina_post_style' => 'content',
					'retina_post_nav_style' => 'numeric',
					
					'retina_analytic' => 0,
					'retina_analytic_code' => 'Analytic Code',
					
					'retina_copyright' => '&copy; Copyright '. date('Y') .' - <a href="'. home_url( '/' ) .'">'. get_bloginfo( 'name' ) .'</a>',
					
					'retina_reset' => 0,
					
				);
				
				update_option( 'retina_options' , $default );
			
			}
		
		}
		
		/**
		 * Retina Pre-defined Range
		*/
		
		/* Boolean Yes | No */		
		function retina_pd_boolean() {			
			return array( 1 => 'yes', 0 => 'no' );		
		}
		
		/* Post Style Range */		
		function retina_pd_post_style() {			
			return array( 'content' => 'Content', 'excerpt' => 'Excerpt (Magazine Style)' );			
		}
		
		/* Post Navigation Style Range */		
		function retina_pd_post_nav_style() {			
			return array( 'numeric' => 'Numeric', 'older-newer' => 'Older / Newer' );			
		}
		
		/**
		 * Theme Options Validation
		*/		
		
		function retina_theme_options_validate( $input ) {
			
			/* Validation: retina_post_style */
			$retina_pd_post_style = Retina_Options::retina_pd_post_style();
			if ( ! array_key_exists( $input['retina_post_style'], $retina_pd_post_style ) ) {
				 $input['retina_post_style'] = "excerpt";
			}
			
			/* Validation: retina_post_nav_style */
			$retina_pd_post_nav_style = Retina_Options::retina_pd_post_nav_style();
			if ( ! array_key_exists( $input['retina_post_nav_style'], $retina_pd_post_nav_style ) ) {
				 $input['retina_post_nav_style'] = "numeric";
			}								
			
			/* Validation: retina_analytic */
			$retina_pd_boolean = Retina_Options::retina_pd_boolean();
			if ( ! array_key_exists( $input['retina_analytic'], $retina_pd_boolean ) ) {
				 $input['retina_analytic'] = 0;
			}
			
			/* Validation: retina_analytic_code */
			if( !empty( $input['retina_analytic_code'] ) ) {
				$input['retina_analytic_code'] = htmlspecialchars ( $input['retina_analytic_code'] );
			}
			
			/* Validation: retina_copyright */
			if( !empty( $input['retina_copyright'] ) ) {
				$input['retina_copyright'] = esc_html ( $input['retina_copyright'] );
			}
			
			/* Validation: retina_reset */
			$retina_pd_boolean = Retina_Options::retina_pd_boolean();
			if ( ! array_key_exists( retina_undefined_index_fix ( $input['retina_reset'] ), $retina_pd_boolean ) ) {
				 $input['retina_reset'] = 0;
			}
			
			add_settings_error( 'retina_options', 'retina_options', 'Settings Saved.', 'updated' );
			
			return $input;
		
		}
		
		/**
		 * Post Section Callback
		 */		
		
		function retina_section_post_fn() {
			echo "Retina Post Options";
		}
		
		/* Post Style Callback */		
		function retina_field_post_style_fn() {
			
			$retina_options = get_option('retina_options');
			$items = Retina_Options::retina_pd_post_style();			
			
			foreach( $items as $key => $val ) {
			?>
            <label><input type="radio" id="retina_post_style[]" name="retina_options[retina_post_style]" value="<?php echo $key; ?>" <?php checked( $key, $retina_options['retina_post_style'] ); ?> /> <?php echo $val; ?></label><br />
            <?php
			}		
		
		}
		
		/* Post Style Navigaiton Callback */		
		function retina_field_post_nav_style_fn() {
			
			$retina_options = get_option('retina_options');
			$items = Retina_Options::retina_pd_post_nav_style();			
			
			foreach( $items as $key => $val ) {
			?>
            <label><input type="radio" id="retina_post_nav_style[]" name="retina_options[retina_post_nav_style]" value="<?php echo $key; ?>" <?php checked( $key, $retina_options['retina_post_nav_style'] ); ?> /> <?php echo $val; ?></label><br />
            <?php
			}
		
		}
		
		/**
		* General Section Callback
		*/		
		
		function retina_section_general_fn() {
			echo "Retina General Options";
		}
		
		/* Analytic Callback */		
		function  retina_field_analytic_fn() {
			
			$retina_options = get_option( 'retina_options' );
			$items = Retina_Options::retina_pd_boolean();
			
			echo '<select id="retina_analytic" name="retina_options[retina_analytic]">';
			foreach( $items as $key => $val ) {
			?>
            <option value="<?php echo $key; ?>" <?php selected( $key, $retina_options['retina_analytic'] ); ?>><?php echo $val; ?></option>
            <?php
			}
			echo '</select>';
			echo '<div><small>Select yes to add your Analytic code.</small></div>';
		
		}
		
		function retina_field_analytic_code_fn() {
			
			$retina_options = get_option('retina_options');
			echo '<textarea type="textarea" id="retina_analytic_code" name="retina_options[retina_analytic_code]" rows="7" cols="50">'. htmlspecialchars_decode ( $retina_options['retina_analytic_code'] ) .'</textarea>';
			echo '<div><small>Enter the Analytic code</small></div>';
		
		}
		
		/* Copyright Text Callback */		
		function retina_field_copyright_fn() {
			
			$retina_options = get_option('retina_options');
			echo '<input type="text" id="retina_copyright" name="retina_options[retina_copyright]" size="40" value="'. esc_html ( $retina_options['retina_copyright'] ) .'" />';
			echo '<div><small>Enter Copyright Text.</small></div>';
			echo '<div><small>Example: <strong>&amp;copy; Copyright '.date('Y').' - &lt;a href="'. home_url( '/' ) .'"&gt;'. get_bloginfo('name') .'&lt;/a&gt;</strong></small></div>';
		
		}		
		
		/* Theme Reset Callback */		
		function retina_field_reset_fn() {
			
			$retina_options = get_option('retina_options');			
			$items = Retina_Options::retina_pd_boolean();			
			echo '<label><input type="checkbox" id="retina_reset" name="retina_options[retina_reset]" value="1" /> Reset Theme Options</label>';
		
		}
}
?>
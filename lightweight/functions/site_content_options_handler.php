<?
function admin_panel_options_catcher() { //935AM

    if ( !current_user_can('administrator') ) { return; }
    
        $site_content_options = get_option( 'site_content_options' );
		
		if (isset($_POST['admin_header_has_submitted'])) { // 0101PM THIS CATCHES FORM SUBMISSIONS
		
			$site_content_options['admin_header_content'] = $_POST['admin_header_content'];
		
		    update_option( 'site_content_options', $site_content_options );
		 
		} // 0101PM
		
		
		if (isset($_POST['admin_footer_has_submitted'])) { // 111PM THIS CATCHES FORM SUBMISSIONS
		
			$site_content_options['admin_footer_content'] = $_POST['admin_footer_content'];
		
		    update_option( 'site_content_options', $site_content_options );
		 
		} // 111PM


} //935AM

add_action( 'wp_loaded', 'admin_panel_options_catcher' );
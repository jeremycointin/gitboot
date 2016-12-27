<?
 
function save_defaults() { //1245PM
 
    if ( !current_user_can('administrator') ) { return; } 
    
    if ( !isset($_POST['page_defaults_submitted'])) { return; }
    
    if (!wp_verify_nonce( $_POST['defaults_submitted_nonce'], 'process_defaults_submitted' )) { return; }
    
	$site_content_options   = get_option( 'site_content_options' );
	
    $site_content_options['default_page_left_sidebar']        = $_POST['admin_default_page_left_sidebar'];
    if (empty($site_content_options['default_page_left_sidebar'])) { $site_content_options['default_page_left_sidebar'] = "inactive"; }
    $site_content_options['default_page_right_sidebar']       = $_POST['admin_default_page_right_sidebar'];
    if (empty($site_content_options['default_page_right_sidebar'])) { $site_content_options['default_page_right_sidebar'] = "inactive"; }
    
    $site_content_options['default_page_left_sidebar_name']   = $_POST['default_page_left_sidebar_name'];
    $site_content_options['default_page_right_sidebar_name']  = $_POST['default_page_right_sidebar_name'];
    
    ///////////////////////   
    
    $site_content_options['default_single_left_sidebar']        = $_POST['admin_default_single_left_sidebar'];
    if (empty($site_content_options['default_single_left_sidebar'])) { $site_content_options['default_single_left_sidebar'] = "inactive"; }
    $site_content_options['default_single_right_sidebar']       = $_POST['admin_default_single_right_sidebar'];
    if (empty($site_content_options['default_single_right_sidebar'])) { $site_content_options['default_single_right_sidebar'] = "inactive"; }
    
    $site_content_options['default_single_left_sidebar_name']   = $_POST['default_single_left_sidebar_name'];
    $site_content_options['default_single_right_sidebar_name']  = $_POST['default_single_right_sidebar_name'];
    
    $site_content_options['display_frontend_admin_panel']       = $_POST['display_frontend_admin_panel'];

    
    update_option( 'site_content_options', $site_content_options );    
    
} //1245PM

add_action( 'wp_loaded', 'save_defaults' );







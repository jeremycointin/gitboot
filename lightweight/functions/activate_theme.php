<?
function light_weight_initialize() { //836AM
	
	$site_url     = site_url();
	$theme_path   = get_template_directory_uri();
	$templatepath = TEMPLATEPATH;
	$site_name    = get_bloginfo( 'name' );
	
	$site_content_options = get_option( 'site_content_options' );
	
	if (!$site_content_options['admin_header_content']) {
	   $site_content_options['admin_header_content'] = "<a href='$site_url'><span id='logo'><img src='$theme_path/images/logo.png' /></span></a>";  }
	   
	if (!$site_content_options['admin_footer_content']) {
	   $site_content_options['admin_footer_content'] = "&copy [current_date] $site_name";  }	
	   
	if (!$site_content_options['admin_default_show_post_title']) {
	    $site_content_options['admin_default_show_post_title'] = "active"; }   

	if (!$site_content_options['admin_default_show_post_content']) {
	    $site_content_options['admin_default_show_post_content'] = "active"; }  
	   
	if (!$site_content_options['default_page_left_sidebar']) {
	    $site_content_options['default_page_left_sidebar'] = "inactive"; }  
	     
	if (!$site_content_options['default_page_left_sidebar_name']) {
	    $site_content_options['default_page_left_sidebar_name']   = 'Default Left'; }
	    
	if (!$site_content_options['default_page_right_sidebar']) {
	    $site_content_options['default_page_right_sidebar'] = "inactive"; }  
	     
	if (!$site_content_options['default_page_right_sidebar_name']) {
	    $site_content_options['default_page_right_sidebar_name']   = 'Default Right'; }
	    
	    
	    
	if (!$site_content_options['default_single_right_sidebar']) {
	    $site_content_options['default_single_right_sidebar'] = "inactive"; }	
	    
	if (!$site_content_options['default_single_right_sidebar_name']) {
	    $site_content_options['default_single_right_sidebar_name']   = 'Default Right'; }
	    
	if (!$site_content_options['default_single_left_sidebar']) {
	    $site_content_options['default_single_left_sidebar'] = "inactive"; }	
	    
	if (!$site_content_options['default_single_left_sidebar_name']) {
	    $site_content_options['default_single_left_sidebar_name']   = 'Default Left'; }
	    
	
	update_option( 'site_content_options', $site_content_options );		
	
	$site_post_page_options   = get_option( 'site_post_page_options' );  $site_post_page_options = "";
	
	if (empty($site_post_page_options)) {
	
		$pp_options[] = 'left_sidebar_active';
		$pp_options[] = 'right_sidebar_active';
		$pp_options[] = 'right_sidebar_content';
		$pp_options[] = 'left_sidebar_content';
		$pp_options[] = 'show_post_title';
		$pp_options[] = 'show_post_content'; 
		
		$pp_options[] = 'header_image';
		$pp_options[] = 'alt_link';
		$pp_options[] = 'alt_excerpt';
		
		$site_post_page_options = $pp_options;
		
		update_option( 'site_post_page_options', $site_post_page_options );
	
	}
	
	$lw_sidebars                    = get_option( 'lw_sidebars' );
	
	if (empty($lw_sidebars)) {
	
		$lw_sidebars['Default Left']  = " [display_widget name='Default Left'] ";
		
		$lw_sidebars['Default Right']  = " [display_widget name='Default Right'] ";
		
		update_option('lw_sidebars',$lw_sidebars);
	
	}
  
} //836AM

add_action("after_switch_theme", "light_weight_initialize", 10 ,  2);
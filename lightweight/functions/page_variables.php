<? 

$body_class = "";  
$template_slug = preg_replace('/\\.[^.\\s]{3,4}$/', '', get_page_template_slug( $post->ID ));  

if ( !empty($template_slug) )           { $body_class .= " $template_slug"; }
if ( is_front_page() )                  { $is_frontpage  = true; $body_class .= " front-page"; }	
if ( is_404() )                         { $is_404        = true; $body_class .= " 404";        }
if ( is_page() )                        { $is_page       = true; $body_class .= " page";       }
if ( is_page() && !is_front_page())     { $is_page       = true; $body_class .= " inner_page"; }
if ( is_single() )                      { $is_single     = true; $body_class .= " single";     }
if ( is_user_logged_in() )              { $is_logged_in  = true; $body_class .= " logged_in";  }
if ( current_user_can('administrator')) { $is_admin      = true; $body_class .= " admin";      }

$post_page_id         = $post->ID;
global $post_page_options;
$post_page_options    = get_post_meta( $post_page_id , 'post_page_options', true ); 
if (empty($post_page_options)) { $post_page_options = array(); }
global $site_content_options;
$site_content_options = get_option( 'site_content_options' );

if (!empty($post_page_options['show_post_content']))    { $body_class .= " post_content_".$post_page_options['show_post_content'];     } 

if (!empty($post_page_options['left_sidebar_active']))  { $body_class .= " left_sidebar_".$post_page_options['left_sidebar_active'];   }
if (!empty($post_page_options['right_sidebar_active'])) { $body_class .= " right_sidebar_".$post_page_options['right_sidebar_active']; }

if (is_page()) { 

	//////////   THIS SETS DEFAULT SIDEBARS ////////////////  
	if (empty($post_page_options['left_sidebar_active'])) { //427PM 
		$post_page_options['left_sidebar_active'] = $site_content_options['default_page_left_sidebar'];
		if ($post_page_options['left_sidebar_active'] == "active") { $body_class .= " default_active left_page_default_active"; }
		if ($post_page_options['left_sidebar_active'] == "inactive") { $body_class .= " default_active left_page_default_inactive"; }
		$post_page_options['left_sidebar_content'] = do_shortcode("[display_sidebar name='".$site_content_options['default_page_left_sidebar_name']."']");
	} //427PM  
	
	
	//////////   THIS SETS DEFAULT SIDEBARS ////////////////  
	if (empty($post_page_options['right_sidebar_active'])) { //427PM
		$post_page_options['right_sidebar_active'] = $site_content_options['default_page_right_sidebar'];
		if ($post_page_options['right_sidebar_active'] == "active") { $body_class .= " default_active right_page_default_active"; }
		if ($post_page_options['right_sidebar_active'] == "inactive") { $body_class .= " default_active right_page_default_inactive"; }
		$post_page_options['right_sidebar_content'] = do_shortcode("[display_sidebar name='".$site_content_options['default_page_right_sidebar_name']."']");
	} //427PM  

} 

if (is_single()) { 

	//////////   THIS SETS DEFAULT SIDEBARS ////////////////  
	if (empty($post_page_options['left_sidebar_name'])) { //427PM 
		$post_page_options['left_sidebar_active'] = $site_content_options['default_single_left_sidebar'];
		if ($post_page_options['left_sidebar_active'] == "active") { $body_class .= " default_active left_single_default_active"; }
		if ($post_page_options['left_sidebar_active'] == "inactive") { $body_class .= " default_active left_single_default_inactive"; }
		$post_page_options['left_sidebar_content'] = do_shortcode("[display_sidebar name='".$site_content_options['default_single_left_sidebar_name']."']");
	} //427PM  
	
	
	//////////   THIS SETS DEFAULT SIDEBARS ////////////////  
	if (empty($post_page_options['right_sidebar_name'])) { //427PM 
		$post_page_options['right_sidebar_active'] = $site_content_options['default_single_right_sidebar'];
		if ($post_page_options['right_sidebar_active'] == "active") { $body_class .= " default_active right_single_default_active"; }
		if ($post_page_options['right_sidebar_active'] == "inactive") { $body_class .= " default_active right_single_default_inactive"; }
		$post_page_options['right_sidebar_content'] = do_shortcode("[display_sidebar name='".$site_content_options['default_single_right_sidebar_name']."']");
	} //427PM  

}

if ( $post_page_options['left_sidebar_active'] != "active" &&
     $post_page_options['right_sidebar_active'] != "active" )  {  $body_class .= " full_width_active";  }
     
     
     
if (empty($post_page_options['show_post_title'])) { 
	$post_page_options['show_post_title'] = "active";
}

if (empty($post_page_options['show_post_content'])) { 
	$post_page_options['show_post_content'] = "active";
}

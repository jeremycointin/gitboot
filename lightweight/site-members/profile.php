<?


$post_page_options          = get_post_meta( $post->ID, 'post_page_options', true );

$page_owner_id              = $post_page_options['page_owner'];

$site_members_options       = get_option('site_members_options');

$sm_profile_fields          = get_option('sm_profile_fields');

$added_meta                 = get_the_author_meta( 'added_meta', $page_owner_id );

$original_user_login        = get_the_author_meta( 'user_login', $page_owner_id );
 
$original_first_name        = get_the_author_meta( 'user_firstname', $page_owner_id );
 
$original_last_name         = get_the_author_meta( 'user_lastname', $page_owner_id );
 
$original_user_email        = get_the_author_meta( 'user_email', $page_owner_id );

$original_user_description  = get_the_author_meta( 'description', $page_owner_id );

$theme_based_style          =  TEMPLATEPATH."/site-members/sm_style.css";
$plugin_based_style         =  WP_PLUGIN_DIR."/site-members/templates/sm_style.css";

if (file_exists($theme_based_style)) {
    $style_all = get_bloginfo( 'template_url' )."/site-members/sm_style.css";
	$page_style="<link rel='stylesheet' media='screen' type='text/css' href='$style_all' />";
} else if (file_exists($plugin_based_style)) { 
    $style_all = get_bloginfo( 'template_url' )."/site-members/templates/sm_style.css";
	$page_style="<link rel='stylesheet' media='screen' type='text/css' href='$plugin_based_style' />";		
}

?>


<!DOCTYPE html>

<html>

<head>
	<? wp_head(); ?>
	<? echo $page_style; ?>		
	<title><?php echo $original_first_name." ".$original_last_name; ?></title>
</head>

	<body id="page-<?php echo $post->ID; ?>" class="sm-page">
	
		<? include_once 'sm_header.php'; ?>
		    
			<div class="content_block">
			
				<div class="content_wrapper page_width">
					<div class="middle_column">
					<?                                                  
					if (!empty($sm_profile_fields)) { foreach ( $sm_profile_fields as $key => $sm_profile_field ) { // 954PM
					    	     
						$args = array(
						  'sm_profile_field'      => $sm_profile_field,
						  'count'                 => $count,
						  'user_id'               => $page_owner_id,
						  'display_where'         => "frontend",
						);
						process_display_profile_field($args);
						$count++;
					
					} } // 954PM
					?>
					</div><!-- middle_column -->    
					<br style="clear: both;" />
				</div ><!-- content_wrapper --> 
			
			
			</div ><!-- content_block --> 
				 

        <? include_once 'sm_footer.php'; ?>
	
	</body>

</html>
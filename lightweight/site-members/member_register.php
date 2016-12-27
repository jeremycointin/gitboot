<?


$post_page_options          = get_post_meta( $post->ID, 'post_page_options', true );

if (empty($post_page_options)) { $post_page_options = array(); }

$page_owner_id              = $post_page_options['page_owner'];

$site_members_options       = get_option('site_members_options');

$sm_profile_fields          = get_option('sm_profile_fields');

$added_meta                 = get_the_author_meta( 'added_meta', $page_owner_id );

if (empty($added_meta)) { $added_meta = array(); }

$original_user_login        = get_the_author_meta( 'user_login', $page_owner_id );
 
$original_first_name        = get_the_author_meta( 'user_firstname', $page_owner_id );
 
$original_last_name         = get_the_author_meta( 'user_lastname', $page_owner_id );
 
$original_user_email        = get_the_author_meta( 'user_email', $page_owner_id );

$original_user_description  = get_the_author_meta( 'description', $page_owner_id );

$theme_based_style   =  TEMPLATEPATH."/site-members/sm_style.css";
$plugin_based_style  =  WP_PLUGIN_DIR."/site-members/templates/sm_style.css";

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
	<title>Member Registration</title>
    <?
    echo stripslashes($site_members_options['jquery_call']);  
	include_once WP_PLUGIN_DIR . '/site-members/js/php_to_js.php';
    echo '<script src="'.plugins_url('/site-members/js/frontend_script.js').'"></script>';
    ?>
</head>

	<body id="page-<?php echo $post->ID; ?>" class="sm-page sm_registration">
	
		<? include_once 'sm_header.php'; ?>
		    
			<div class="content_block">
			
				<div class="content_wrapper page_width">
					<div class="middle_column">
					    <h1>Member Registration</h1>
					    <?							
			    		echo "<form class='registration_form' method='post' enctype='multipart/form-data' action=''>";
						
						$count = 0; 
						if (!empty($sm_profile_fields)) { foreach ( $sm_profile_fields as $key => $sm_profile_field ) { // 954PM
						    	     
							$args = array(
							  'sm_profile_field'      => $sm_profile_field,
							  'count'                 => $count,
							  'user_id'               => $user_id,
							  'display_where'         => "registration",
							);
							$all_errors = process_input_profile_field($args);
							$count++;
						
						} } // 954PM
						
						
					    echo "<input type='hidden' name='from_where' value='registration' />";
					    
					    echo "<div id='honey_pot_wrap'><label>If you can see this leave it blank</label><input type='text' name='honey_pot' value='' /></div>";
					    
					    echo "<div id='bot_check_wrap'><label>If this is empty check your javascript. The form won't process</label>";
					    echo "<input type='text' name='bot_check' id='bot_check' value='' /></div>";
					    
					    wp_nonce_field( 'process_member_registration', 'member_registration_nonce' );
					    
					    echo "<label></label><input type='submit' value='Submit' class='submit'>";
					    
					    echo "</form>";
					    global $all_errors;
						if (!empty($all_errors)) { echo "<div class='error_wrap'>";foreach ($all_errors as $error) {
							echo $error['message']."<br />";							
						} echo "</div>"; }	
					    ?>	
					</div><!-- middle_column -->    
					<br style="clear: both;" />
				</div ><!-- content_wrapper --> 
			
			
			</div ><!-- content_block --> 
				 

        <? include_once 'sm_footer.php'; ?>
	
	</body>

</html>
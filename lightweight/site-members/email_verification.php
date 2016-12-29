<?
	$sm_profile_fields        = get_option('sm_profile_fields');
	
	$site_members_options     = get_option('site_members_options');
	
    $count = 0;

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
	<title>Email Verification</title>

</head>

	<body id="page-<?php echo $post->ID; ?>" class="sm-page sm_email_verification">
	
		<? include_once 'sm_header.php'; ?>
		    
			<div class="content_block">
			
				<div class="content_wrapper page_width">
					<div class="middle_column">
					    <h1>Email Verification</h1>
		                <? $check_email = $_GET['activate']; ?>                
		                              		
		              	<? $email_verifications = get_option('email_verifications'); ?>	
		              	
		              	<? $login_url = get_bloginfo('url'); ?>
		              	
		              	<? 
		              	
		              	if (!empty($email_verifications)) { foreach ($email_verifications as $key => $email_verification) { //905AM
		              	 
		              	      if (in_array($check_email, $email_verification)) {	
		              	      
							     $email_varified = true;
		
							     $this_user_id  = $email_verification['user_id'];
							     
							     $added_meta    = get_the_author_meta( 'added_meta', $this_user_id );
							     
								 $added_meta['sm_confirmed_email_address']  = true;
									
		     				     update_user_meta( $this_user_id, 'added_meta', $added_meta );
		     				     
							     unset($email_verifications[$key]);
							     update_option('email_verifications',$email_verifications);
							  }
		              	
		              	} } //905AM
		              	
		              	
		              	
		              	if ($email_varified == true) { //855AM ?>
		              	
                             <? echo stripslashes($site_members_options['evsm']); ?>
		              	      
		              	<?      
		              	}else{ //855AM
		              	     echo "Sorry, your account has either already been verified or you have not yet completed the registration form. Verification id was not found.";
		              	} //855AM
		              	?>   	
					</div><!-- middle_column -->    
					<br style="clear: both;" />
				</div ><!-- content_wrapper --> 
			
			
			</div ><!-- content_block --> 
				 

        <? include_once 'sm_footer.php'; ?>
	
	</body>

</html>
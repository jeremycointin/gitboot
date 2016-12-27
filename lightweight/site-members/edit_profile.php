<?

$current_user = wp_get_current_user();

$user_id = $current_user->ID;

$sm_profile_fields        = get_option('sm_profile_fields');

$site_members_options     = get_option('site_members_options');

$added_meta               = get_the_author_meta( 'added_meta', $user_id );

$errors                   = $added_meta['errors'];

$count                    = 0;

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

	<title>Edit Profile</title>

</head>

	<body id="page-<?php echo $post->ID; ?>" class="sm-page sm_profile_edit">
	
		
		<? include_once 'sm_header.php'; ?>
		    
			<div class="content_block">
			
				<div class="content_wrapper page_width">
                    <div class="middle_column">
                    
                
								    <?							
						    		echo "<form class='frontend_edit_form' method='post' enctype='multipart/form-data' action=''>";
									
									if (!empty($sm_profile_fields)) { foreach ( $sm_profile_fields as $key => $sm_profile_field ) { // 954PM
									    	     
										$args = array(
										  'sm_profile_field'      => $sm_profile_field,
										  'count'                 => $count,
										  'user_id'               => $user_id,
										  'display_where'         => "frontend",
										);
										$all_errors = process_input_profile_field($args);
										$count++;
									
									} } // 954PM
									
									
								    echo "<input type='hidden' name='from_where' value='frontend' />";
								    
								    echo "<div id='honey_pot_wrap'><label>If you can see this leave it blank</label><input type='text' name='honey_pot' value='' /></div>";
								    
								    echo "<div id='bot_check_wrap'><label>If this is empty check your javascript. The form won't process</label>";
								    echo "<input type='text' name='bot_check' id='bot_check' value='' /></div>";
								    
								    wp_nonce_field( 'process_frontend_profile_update', 'frontend_profile_update_nonce' );
								    
								    echo "<input type='submit' value='Submit' class='sm_submit_button'>";
								    
								    echo "</form>";
								    
									if (!empty($all_errors)) { echo "<div class='errors_wrap'>"; foreach ($all_errors as $error) {
										echo $error['message']."<br />";							
									} echo "</div>"; }	
								    ?>	
								    
								    
							 
			                    <? if ($page_windows['page_blog_state']     == "active") { ?>
			                    <?php include 'admin/admin_blog.php'; ?> 
			                    <? } ?>  					        	 
                                 
                    </div><!-- middle_column -->  
                    
                    
                    <? ////////////////////////////////////////////////////////////////////////////////////////////////////// ?>
                    
                    
                    
                    <div class="right_column" id="<? echo $right_sidebar_id; ?>_sidebar" >
                    
			           <div class="show_profile_button_wrap">
					        <a href="<?php echo get_post_permalink( $added_meta['user_page_id'] ); ?>" target="_blank">
					        <button type="button" class="create_post" >View Profile</button></a>
			            </div><!--show_profile_button_wrap-->
				        
				        <div class="create_buttons_wrap">
					        <? if ($site_members_options['allow_post_creation'] == true) { ?>
					        <a href="<?php echo get_page_link($site_members_options['post_page_manage_page_id']); ?>?action=new post" target="_blank">
					        <button type="button" class="create_post" >Create New Post</button></a><? } ?>
					        
					        <? if ($site_members_options['allow_page_creation'] == true) { ?>
					        <a href="<?php echo get_page_link($site_members_options['post_page_manage_page_id']); ?>?action=new page" target="_blank">
					        <button type="button" class="create_post" >Create New Page</button></a><? } ?>   
				        </div><!--create_buttons_wrap-->
				        
			            <? if ($site_members_options['allow_post_creation'] == true) { ?>
			                <div class="display_created_posts">
			                    <div class="created_posts_header">Created Posts</div>
			                    
			                    <div class="all_created_posts_wrap">
			                        <?
			                        $call_args = array(
			                            'post_type'        => 'post',
			                            'posts_per_page'   => -1,
			                            'post_status'      => array( 'publish', 'draft' ),
			                            'author'           => $user_id,
			                            'order'            => 'DESC'
			                        );
			                     
			                        $custom_query = new WP_Query( $call_args );
			                        $count = 0;
			                         
			                         
			         
			                        if ( $custom_query->have_posts() ) : while ( $custom_query->have_posts() ) : $custom_query->the_post();
			                     
			                        $this_post_id=$post->ID;
			                        $this_post_title= get_the_title();
			                        $this_post_excerpt= get_the_excerpt();
			                        $this_post_link = get_permalink($this_post_id);
			                        ?>
			                     
			                          
			                               <? $count++; ?>
			                               <a href="<?php echo get_page_link($site_members_options['post_page_manage_page_id']); ?>?action=edit_post&post_page_id=<? echo $this_post_id; ?>" target="_blank">
			                               <div class="single_created_post_wrap" id="single_created_post_<? echo $count; ?>">
			                                
			                                   <h1 class="post_title"><? echo $this_post_title; ?></h1>
			                     
			                               </div><!--single_created_post_wrap-->
			                               </a>
			                     
			                               <?php endwhile; ?>
			                      
			                       <?php endif; ?>
			                       
			                     </div><!--all_created_posts_wrap-->
			                       
			                     <? if ($count > 10) { ?><div class="created_posts_expand">Show All Created Posts</div><? } ?>	               
			                </div><!--display_created_posts-->
				        <? } ?>
			            
			            
					    <? if ($site_members_options['allow_page_creation'] == true) { ?>
			                <div class="display_created_posts">
			                    <div class="created_posts_header">Created Pages</div>
			                    
			                    <div class="all_created_posts_wrap">
			                        <?
			                        $call_args = array(
			                            'post_type'        => 'page',
			                            'posts_per_page'   => -1,
			                            'post_status'      => array( 'publish', 'draft' ),
			                            'author'           => $user_id,
			                            'order'            => 'DESC'
			                        );
			                     
			                        $custom_query = new WP_Query( $call_args );
			                        $count = 0;
			                         
			                         
			         
			                        if ( $custom_query->have_posts() ) : while ( $custom_query->have_posts() ) : $custom_query->the_post();
			                     
			                        $this_post_id=$post->ID;
			                        $this_post_title= get_the_title();
			                        $this_post_excerpt= get_the_excerpt();
			                        $this_post_link = get_permalink($this_post_id);
			                        ?>
			                     
			                          
			                               <? $count++; ?>
			                               <a href="<?php echo get_page_link($site_members_options['post_page_manage_page_id']); ?>?action=edit_page&post_page_id=<? echo $this_post_id; ?>" target="_blank">
			                               <div class="single_created_post_wrap" id="single_created_post_<? echo $count; ?>">
			                                
			                                   <h1 class="post_title"><? echo $this_post_title; ?></h1>
			                     
			                               </div><!--single_created_post_wrap-->
			                               </a>
			                     
			                               <?php endwhile; ?>
			                      
			                       <?php endif; ?>
			                       
			                     </div><!--all_created_posts_wrap-->
			                       
			                     <? if ($count > 10) { ?><div class="created_posts_expand">Show All Created Pages</div><? } ?>	               
			                </div><!--display_created_posts-->
				        <? } ?>
				        
				        <? if ($site_members_options['allow_collaboration'] == true) { ?>
			                <div class="display_created_posts">
			                    <div class="created_posts_header">Collaborations</div>
			                    
			                    <div class="all_created_posts_wrap">
			                        <?
			                        $call_args = array(
			                            'post_type'        => array( 'post', 'page' ),
			                            'posts_per_page'   => -1,
			                            'post_status'      => array( 'publish', 'draft' ),
			                            'order'            => 'DESC'
			                        );
			                     
			                        $custom_query = new WP_Query( $call_args );
			                        $count = 0;
			                         
			                         
			         
			                        if ( $custom_query->have_posts() ) : while ( $custom_query->have_posts() ) : $custom_query->the_post();
			                     
			                        $this_post_id       = $post->ID;
			                        $this_post_title    = get_the_title();
			                        $this_post_excerpt  = get_the_excerpt();
			                        $this_post_link     = get_permalink($this_post_id);
			                        $post_page_options  = get_post_meta($this_post_id, 'post_page_options', true );
			                        $collaborators      = $post_page_options['collaborators'];
			                        $this_post_author   = $post->post_author;
			                        
							  	        if ( !empty($collaborators)) { if (in_array($user_id,$collaborators) &&  $this_post_author != $user_id){ 	
			                            ?>
			                               <? $count++; ?>
			                               <a href="<?php echo get_page_link($site_members_options['post_page_manage_page_id']); ?>?action=edit_page&post_page_id=<? echo $this_post_id; ?>" target="_blank">
			                               <div class="single_created_post_wrap" id="single_created_post_<? echo $count; ?>">
			                                
			                                   <h1 class="post_title"><? echo $this_post_title; ?></h1>
			                     
			                               </div><!--single_created_post_wrap-->
			                               </a>
			                            <?
			                            }}  //1026AM  ?>
			                     
			                       <?php endwhile; ?>
			                      
			                       <?php endif; ?>
			                       
			                     </div><!--all_created_posts_wrap-->
			                       
			                     <? if ($count > 10) { ?><div class="created_posts_expand">Show All Collaborations</div><? } ?>	               
			                </div><!--display_created_posts-->
			                
			            <? } ?>    

                    </div><!--right_column-->
                    
                    
                    
                    <? ////////////////////////////////////////////////////////////////////////////////////////////////////// ?>
                    
                    
                        
					<br style="clear: both;" />
				</div ><!-- content_wrapper --> 
			
			
			</div ><!-- content_block --> 
				 

    	<? include_once 'sm_footer.php'; ?>
	
	</body>

</html>
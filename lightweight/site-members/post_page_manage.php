<?


$current_user             = wp_get_current_user();

$user_id                  = $current_user->ID;

$sm_profile_fields        = get_option('sm_profile_fields');

$site_members_options     = get_option('site_members_options');

$added_meta               = get_the_author_meta( 'added_meta', $user_id );

$errors                   = $added_meta['errors'];

$count                    = 0;

$action                   = $_GET['action'];

$post_page_id             = $_GET['post_page_id'];

if (!empty($post_page_id)) {
	$current_post           = get_post($post_page_id); 
	$current_post_title     = $current_post->post_title;
	$current_post_content   = $current_post->post_content;
    $post_page_options      = get_post_meta($post_page_id, 'post_page_options', true );
    $this_post_author       = $current_post->post_author;
}

if ($action == "new post" || $action == "edit_post") { $post_type = "post"; $post_cat    = $site_members_options['member_created_post_category_id']; $re_action = "edit_post"; }
if ($action == "new page" || $action == "edit_page") { $post_type = "page"; $page_parent = $site_members_options['member_created_page_parent_id']; $re_action = "edit_page"; }
	

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

	<title>Manage <? echo $post_type; ?></title>
	<?
    echo stripslashes($site_members_options['jquery_call']);  
	include_once WP_PLUGIN_DIR . '/site-members/js/php_to_js.php';
    echo '<script src="'.plugins_url('/site-members/js/frontend_script.js').'"></script>';
    ?>
  	<script>
  	
  	
	  	var post_type = "<? echo $post_type; ?>";
  	 
  	     <?
  	     $comma = "";
  	     if ( !empty($post_page_options['collaborators'])) { foreach ($post_page_options['collaborators'] as $key => $collaborator_id) { //1026AM
  	       
  	          $all_collaborators .= "$comma'$collaborator_id'"; $comma = ",";
  	    
  	     }}  //1026AM  	
  	     ?>
  	    
	    <? if ( empty($post_page_options['collaborators'][0])) {  $empty_collaborators = true; } ?>
  	     
  	    var all_chosen_ids = new Array(<? echo $all_collaborators; ?>);
  	
  	</script>
</head>

	<body id="page-<?php echo $post->ID; ?>" class="sm-page sm_profile_edit">
	
	
		<? include_once 'sm_header.php'; ?>
		    
			<div class="content_block">
			
				<div class="content_wrapper page_width">
				
                    <form class='frontend_post_page_manage_form' id='frontend_post_page_manage_form_1' method='post' enctype='multipart/form-data' action=''>
				
                    <div class="middle_column">

								
									<div id="sm_post_page_title_wrap" class="sm_field_wrap">
									    <label>Title</label>
										<input type="text" name="sm_post_page_title" id="sm_post_page_title" value="<? echo $current_post_title; ?>">
								    </div>		
									
									<div id="sm_post_page_content_wrap" class="sm_field_wrap">
										<? wp_editor( $current_post_content, "sm_post_page_content"); ?>
								    </div>
								    
								    <div id='honey_pot_wrap'><label>If you can see this leave it blank</label><input type='text' name='honey_pot' value='' /></div>
								    
								    <div id='bot_check_wrap'><label>If this is empty check your javascript. The form won't process</label>
								    <input type='text' name='bot_check' id='bot_check' value='' /></div>
								    
								    <div id='total_mce_wrap_1' class='total_mce_wrap'>
								    
								        <? include WP_PLUGIN_DIR.'/site-members/mce_image_insert_popup.php'; ?>
								    
								        <? wp_nonce_field( 'process_post_page_manage', 'post_page_manage_nonce' ); ?>
								        
								   </div> 
								    
								    
								    <input type="hidden" name="post_page_manage_submitted" value="true" />
								    
								    <input type="hidden" name="delete_this_post" id="delete_this_post" value="" />
								    
								    <input type="hidden" name="post_page_id" value="<? echo $post_page_id; ?>" />
								    
								    <input type="hidden" name="action" value="<? echo $action; ?>" />
								    
								    <input type="submit" name="post_status" value="Save" class="sm_submit_button" />	
                                    
                                    
                        
                    </div><!-- middle_column -->  
                    
                    
                    <? ////////////////////////////////////////////////////////////////////////////////////////////////////// ?>
                    
                    
                    
                    <div class="right_column" id="<? echo $right_sidebar_id; ?>_sidebar" >
                    
			            <div class="show_profile_button_wrap post_status_wrap">
                            <div class="post_status">
							   <?
							   $current_status = $current_post->post_status; 
							   if ($current_status == "publish") { echo "Published"; } else{ echo $current_status; }
							   ?>
                            </div> 
                        </div><!--show_profile_button_wrap-->
                        
                        <div class="primary_buttons_wrap">
				            <div class="show_profile_button_wrap">
		                        <input type="submit" name="post_status" value="Save" class="sm_submit_button" />
				            </div><!--show_profile_button_wrap-->
	                        
				            <div class="show_profile_button_wrap">
				                <a href="<?php echo get_permalink($post_page_id); ?>" target="_blank">
				                <button type="button" class="view_post_button" >View <? echo $post_type; ?></button></a>
				            </div><!--show_profile_button_wrap-->
	                        
				            <div class="show_profile_button_wrap">
	                            <input type="submit" name="post_status" value="Save as Draft" id="save_as_draft" class="sm_save_draft_button" />
				            </div><!--show_profile_button_wrap-->			            
			            </div><!--primary_buttons_wrap-->

                        <div class="post_date_wrap">
                            <div class="summary_toggle class_on_off" data-what="parent" data-what-class="on">
                                <span class="text_off">Edit post date</span>
                                <span class="text_on">Hide post date edit</span>
                             </div>   
                            <div class="post_date_inputs_wrap">
                            
                                 <? if (empty($current_post->post_date)) { $current_post_date = date('F j, Y g:i a',time()); echo $current_post_date; }else{ $current_post_date = $current_post->post_date; } ?> 
                            <? $post_month   = date("m", strtotime($current_post_date)); ?>                         
                            <? $post_year    = date("Y", strtotime($current_post_date)); ?>    
                            <? $post_day     = date("d", strtotime($current_post_date)); ?>  
                            <? $post_hour    = date("h", strtotime($current_post_date)); ?>  
                            <? $post_minute  = date("i", strtotime($current_post_date)); ?> 
                            <br />                
                            <label for="mm" class="screen-reader-text">Month</label>
                            <select id="mm" name="mm">
                                        <option value="01" <? if ($post_month == "01") { echo "selected"; } ?>>01-Jan</option>
                                        <option value="02" <? if ($post_month == "02") { echo "selected"; } ?>>02-Feb</option>
                                        <option value="03" <? if ($post_month == "03") { echo "selected"; } ?>>03-Mar</option>
                                        <option value="04" <? if ($post_month == "04") { echo "selected"; } ?>>04-Apr</option>
                                        <option value="05" <? if ($post_month == "05") { echo "selected"; } ?>>05-May</option>
                                        <option value="06" <? if ($post_month == "06") { echo "selected"; } ?>>06-Jun</option>
                                        <option value="07" <? if ($post_month == "07") { echo "selected"; } ?>>07-Jul</option>
                                        <option value="08" <? if ($post_month == "08") { echo "selected"; } ?>>08-Aug</option>
                                        <option value="09" <? if ($post_month == "09") { echo "selected"; } ?>>09-Sep</option>
                                        <option value="10" <? if ($post_month == "10") { echo "selected"; } ?>>10-Oct</option>
                                        <option value="11" <? if ($post_month == "11") { echo "selected"; } ?>>11-Nov</option>
                                        <option value="12" <? if ($post_month == "12") { echo "selected"; } ?>>12-Dec</option>
                            </select><br />
                            
                            <label for="jj" class="screen-reader-text">Day</label>
                            <input type="text" id="jj" name="jj" value="<? echo $post_day; ?>" size="2" maxlength="2" autocomplete="off" /><br />
                            
                            <label for="aa" class="screen-reader-text">Year</label>
                            <input type="text" id="aa" name="aa" value="<? echo $post_year; ?>" size="4" maxlength="4" autocomplete="off" /><br />
                            
                            <label for="hh" class="screen-reader-text">Hour</label>
                            <input type="text" id="hh" name="hh" value="<? echo $post_hour; ?>" size="2" maxlength="2" autocomplete="off" /><br />
                            
                            <label for="mn" class="screen-reader-text">Minute</label>
                            <input type="text" id="mn" name="mn" value="<? echo $post_minute; ?>" size="2" maxlength="2" autocomplete="off" /><br />
                            
                            <input type="hidden" id="ss" name="ss" value="1" />
                            </div><!--post_date_inputs_wrap-->
                        </div><!--show_profile_button_wrap-->
			            
			                     
			            <?			
						if ($post_type == "post") { // 759AM
						$post_categories = wp_get_post_categories( $post_page_id );
						$cats = array(); ?>
						
						<div class="categories_wrap">
						<label>Categories</label>
						<br />
						<?
						foreach($post_categories as $c){ $cats[] = $c; }
						?>        
			
						<?php $categories = get_categories( $args ); ?>
						
						<? foreach ($categories as $category) { ?>
						    <? if (in_array($category->cat_ID, $cats)) { $checked = "checked"; }else{ $checked = ""; } ?>
						    <input type="checkbox" value="<? echo $category->cat_ID; ?>" name="post_categories[]" <? echo $checked; ?> /> <? echo $category->name; ?>	<br />
						<? } ?>
			
			            </div><!--categories_wrap-->
			
			            <? }  // 759AM ?>
			            
			            
			            <? $sm_featured_image = $post_page_options['sm_featured_image']; ?>
			            
                        <div id="sm_featured_image_wrap_1" class="sm_featured_image_wrap">
                            <div class="sm_featured_toggle class_on_off" data-what="parent" data-what-class="on">
                                <span class="text_off">Featured Image</span>
                                <span class="text_on">Hide Featured</span>
                             </div>    
                            <div class="featured_image_details">                        
	                            <input class="sm_file_uploader profile_field sm_field"
	                             type="file" data-paste-bg-where="#sm_featured_preview"
	                             data-paste-where="#sm_featured_image_1"
	                             data-image-size="mid_size" name="sm_pic_1"> <br />                                 
	                            
	                            <input type="text" value="<? echo $sm_featured_image; ?>"
	                             name="sm_featured_image" id="sm_featured_image_1" class="long_link" /><br />
	                             <? if (!empty($sm_featured_image)) { $show = "display: block;"; } ?>
	                             <div class="sm_featured_image" id="sm_featured_preview" style="background-image: url('<? echo $sm_featured_image; ?>'); <? echo $show; ?>"></div>
                             </div><!--featured_image_details-->
                        </div><!--added_single_slide_wrap_1-->
                        
                        
                        

                    <? ////////////////////////////////////////////////////////////////////////////////////////////////////// ?>
                    
                    
                   <? if ($site_members_options['allow_collaboration'] == true) { ?>
                   
                        <div id="sm_add_collaborators_1" class="sm_add_collaborators">
                            <div class="sm_collaborators_toggle class_on_off" data-what="parent" data-what-class="on">
                                <span class="text_off">Show Collaborators</span>
                                <span class="text_on">Hide Collaborators</span>
                             </div>    
                             <div id="collaborators_details_1" class="collaborators_details">  
                                <? if ($user_id == $this_post_author) { ?>                      
	                                <label>Search</label>
	                                <input type="text" id="collaborator_search" data-display-where="#collaborator_search_results" />
	                                <div id="collaborator_search_results"></div>
	                                <button type="button" id="add_collaborators" data-add-where="#added_collaborators">Add</button>
                                <? } ?>
                                <div id="added_collaborators">
							  	     <?
							  	     $comma = "";
							  	     if ( !empty($post_page_options['collaborators'])) { foreach ($post_page_options['collaborators'] as $key => $collaborator_id) { //1026AM
							  	       
										$sm_first_name        = get_the_author_meta( 'user_firstname', $collaborator_id );										 
										$sm_last_name         = get_the_author_meta( 'user_lastname', $collaborator_id );
										echo "<div><span class='collaborator_name'>$sm_first_name  $sm_last_name</span>"; 
										if ($user_id == $this_post_author) {
										echo "<span class='remove_collaborator' data-collaborator-id='$collaborator_id'>X</span>"; 
										}
										echo "</div>";
							  	    
							  	     }}  //1026AM  	
							  	     ?> 
                                </div>
                                <input type="hidden" name="all_collaborators" id="all_collaborators" value="" />
                             </div><!--collaborators_details-->
                        </div><!--added_single_slide_wrap_1-->
                        
                  <? } ?>
			            
		            
			            <div class="show_profile_button_wrap">
                            <input type="button" name="post_delete" value="DELETE" class="sm_delete_post_button" id="post_delete" />
			            </div><!--show_profile_button_wrap-->
			            
                  

                    </div><!--right_column-->

                    </form>	
                    
                    
                    
                    <? ////////////////////////////////////////////////////////////////////////////////////////////////////// ?>
                    
                    
                        
					<br style="clear: both;" />
				</div ><!-- content_wrapper --> 
			
			
			</div ><!-- content_block --> 
				 

        <? include_once 'sm_footer.php'; ?>
	
	</body>

</html>
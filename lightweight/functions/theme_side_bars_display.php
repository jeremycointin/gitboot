<?

function side_bars_display() {

	$lw_sidebars   = get_option( 'lw_sidebars' );


?>


	<h1>Side Bar Names</h1>
	
	
	<form action="" class="add_lw_sidebars_form" method="post" enctype="multipart/form-data">
	 

		<label class="admin_awc_label">Sidebar Name</label>
		<input type="text" name="lw_sidebar_name" value="" class="" />
		
		<input type="submit" class="admin_button admin_submit_button" value="Submit" />
		<input type="hidden" name="add_lw_sidebar_submitted" value="true" />	
		
		<? wp_nonce_field( 'process_lw_sidebar', 'lw_sidebar_nonce' ); ?>			
	 
	</form> 
	

	<form method="post" enctype="text" action="">
	
		<? if (!empty($lw_sidebars)) { foreach ($lw_sidebars as $lw_sidebar_name => $lw_sidebar_content ) { ?>
		
		       <? if (empty($lw_sidebar_name)) { continue; } ?>
		       
		       <div class="sidebar_name_wrap">
			       <span class="checkbox_wrap ib"><input type="checkbox" name="delete_sidebars[]" value="<? echo stripslashes($lw_sidebar_name); ?>" /></span>
			       <span class="sidebar_name ib"><? echo stripslashes($lw_sidebar_name); ?></span>	 
			       <span class="shortcode_display ib">[display_sidebar name='<? echo stripslashes($lw_sidebar_name); ?>']</span>  
			       <span class="shortcode_display ib">[display_widget name='<? echo stripslashes($lw_sidebar_name); ?>']</span>     
		       </div>
		
		<? } }else{ echo "no sidebars";} ?> 
	
		<? wp_nonce_field( 'process_delete_sidebars', 'delete_sidebars_nonce' ); ?>
		
		<br />
		   
		<input type="submit" name="delete_sidebars_submit" class="admin_button admin_submit_button" value="Delete Sidebars" />
		   
		<input type="hidden" name="delete_sidebars_submitted" value="true" />		

	</form>
	
<?


}


<?

function defaults_display() { //809AM

	$site_content_options   = get_option( 'site_content_options' ); 
    $lw_sidebars            = get_option( 'lw_sidebars' );
	
?>


<style>

.admin_default_sidebar_activate { display: block; }

left_sidebar_wrap,right_sidebar_wrap { display: block; margin-bottom: 25px; }


</style>



<form class="admin_page_defaults_form" method="post" enctype="multipart/form-data">

    <h1>Page Defaults</h1>

	<div class="left_sidebar_wrap">
	
		
		  <div class="sidebar_select_wrap">
				<label>Left Sidebar State</label>  
				<select name="admin_default_page_left_sidebar">	
				     <option value="<? echo $site_content_options['default_page_left_sidebar']; ?>"><? echo $site_content_options['default_page_left_sidebar']; ?></option>	        
				     <option value="active">active</option>
				     <option value="inactive">inactive</option>
				 </select>   
		  </div> 
		  
		  <div class="sidebar_select_wrap">
		  <label>Left Sidebar Name</label>  
				<select name="default_page_left_sidebar_name">
		        
		                       <? if (!empty($site_content_options['default_page_left_sidebar_name'])) { ?>
		                       <option value="<? echo stripslashes($site_content_options['default_page_left_sidebar_name']); ?>">
		                       <? echo stripslashes($site_content_options['default_page_left_sidebar_name']); ?></option><? } ?>
		                       <option value=""></option>
							   <? if (!empty($lw_sidebars)) { ?>
				                    <? foreach ($lw_sidebars as $lw_sidebar_name => $lw_sidebar_content ){ ?>                
				                       <option value="<? echo $lw_sidebar_name; ?>"><? echo $lw_sidebar_name; ?></option>                
				                    <? } ?> 
				               <? } ?>
		         </select>   
		  </div>
	
	

	
	


		  <div class="sidebar_select_wrap">
		        <label>Right Sidebar State</label>  
				<select name="admin_default_page_right_sidebar">	
				     <option value="<? echo $site_content_options['default_page_right_sidebar']; ?>"><? echo $site_content_options['default_page_right_sidebar']; ?></option>	        
	                 <option value="active">active</option>
	                 <option value="inactive">inactive</option>
		         </select>   
		  </div>  
		  
		  <div class="sidebar_select_wrap">
		        <label>Right Sidebar Name</label>  
				<select name="default_page_right_sidebar_name">
		        
		                       <? if (!empty($site_content_options['default_page_right_sidebar_name'])) { ?>
		                       <option value="<? echo stripslashes($site_content_options['default_page_right_sidebar_name']); ?>">
		                       <? echo stripslashes($site_content_options['default_page_right_sidebar_name']); ?></option><? } ?>
		                       <option value=""></option>
							   <? if (!empty($lw_sidebars)) { ?>
				                    <? foreach ($lw_sidebars as $lw_sidebar_name => $lw_sidebar_content ){ ?>                
				                       <option value="<? echo $lw_sidebar_name; ?>"><? echo $lw_sidebar_name; ?></option>                
				                    <? } ?> 
				               <? } ?>
		         </select>   
		  </div>
	

	</div>
	
	
	
	
	
	
    <h1>Single Defaults</h1>

	<div class="left_sidebar_wrap">
	
		
		  <div class="sidebar_select_wrap">
		        <label>Left Sidebar State</label>  
				<select name="admin_default_single_left_sidebar">	
				     <option value="<? echo $site_content_options['default_single_left_sidebar']; ?>"><? echo $site_content_options['default_single_left_sidebar']; ?></option>	        
	                 <option value="active">active</option>
	                 <option value="inactive">inactive</option>
		         </select>   
		  </div> 
		  
		  <div class="sidebar_select_wrap">
		        <label>Left Sidebar Name</label>  
				<select name="default_single_left_sidebar_name">
		        
		                       <? if (!empty($site_content_options['default_single_left_sidebar_name'])) { ?>
		                       <option value="<? echo stripslashes($site_content_options['default_single_left_sidebar_name']); ?>">
		                       <? echo stripslashes($site_content_options['default_single_left_sidebar_name']); ?></option><? } ?>
		                       <option value=""></option>
							   <? if (!empty($lw_sidebars)) { ?>
				                    <? foreach ($lw_sidebars as $lw_sidebar_name => $lw_sidebar_content ){ ?>                
				                       <option value="<? echo $lw_sidebar_name; ?>"><? echo $lw_sidebar_name; ?></option>                
				                    <? } ?> 
				               <? } ?>
		         </select>   
		  </div>
	
	


		  <div class="sidebar_select_wrap">
		        <label>Right Sidebar State</label>  
				<select name="admin_default_single_right_sidebar">	
				     <option value="<? echo $site_content_options['default_single_right_sidebar']; ?>"><? echo $site_content_options['default_single_right_sidebar']; ?></option>	        
	                 <option value="active">active</option>
	                 <option value="inactive">inactive</option>
		         </select>   
		  </div>  
		  
		  <div class="sidebar_select_wrap">
		        <label>Right Sidebar Name</label>  
				<select name="default_single_right_sidebar_name">
		        
		                       <? if (!empty($site_content_options['default_single_right_sidebar_name'])) { ?>
		                       <option value="<? echo stripslashes($site_content_options['default_single_right_sidebar_name']); ?>">
		                       <? echo stripslashes($site_content_options['default_single_right_sidebar_name']); ?></option><? } ?>
		                       <option value=""></option>
							   <? if (!empty($lw_sidebars)) { ?>
				                    <? foreach ($lw_sidebars as $lw_sidebar_name => $lw_sidebar_content ){ ?>                
				                       <option value="<? echo $lw_sidebar_name; ?>"><? echo $lw_sidebar_name; ?></option>                
				                    <? } ?> 
				               <? } ?>
		         </select>   
		  </div>
	

	</div>
	
	
	

	<? wp_nonce_field( 'process_defaults_submitted', 'defaults_submitted_nonce' ); ?> 
	
	
	<input type="hidden" name="page_defaults_submitted" value="true" />
	
	<input type="submit" value="submit" />

</form>


<?
} //809AM
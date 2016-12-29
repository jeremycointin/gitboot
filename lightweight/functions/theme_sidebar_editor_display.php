<?

function side_bar_editor_display() { ?>

<? $lw_sidebars   = get_option( 'lw_sidebars' ); ?>

<h1>Edit Sidebars</h1>


	 
        <? foreach ($lw_sidebars as $lw_sidebar_name => $lw_sidebar_content ){ ?>  
           <? if (empty($lw_sidebar_name)) { continue; }  ?>
           <? if ($lw_sidebar_name == $_POST['lw_sidebar_name']) { $state="on";  }else{ $state=""; }  ?>
           <form class="side_bar_editor_form <? echo $state; ?>" action="" method="post" enctype="multipart/form-data">            
               <div class="lw_sidebar_name lw_class_on_off" data-what="parent" data-what-class='on'>
	               <span class="the_name"><? echo $lw_sidebar_name; ?></span>
	               <span class="click">(click)</span>
	           </div> 
               <div class="side_bar_editor_wrap">       
	               <div class="shortcode_case">
				       <span class="shortcode_display ib">[display_sidebar name='<? echo stripslashes($lw_sidebar_name); ?>']</span>  
				       <span class="shortcode_display ib">[display_widget name='<? echo stripslashes($lw_sidebar_name); ?>']</span>
	               </div>        
                   <textarea name="lw_sidebar_content" class="lw_sidebar_content"><? echo stripslashes($lw_sidebar_content); ?></textarea>
                   <br />
                   <input type="submit" value="Submit">
                   <input type="hidden" name="side_bar_editor_submitted" value="true" />
                   <input type="hidden" name="lw_sidebar_name" value="<? echo $lw_sidebar_name; ?>" />                   
                   <? wp_nonce_field( 'process_lw_sidebar_editor_handler', 'lw_sidebar_editor_handler_nonce' ); ?>
               </div>
           </form>
        <? } ?>

<? 
}
<? include TEMPLATEPATH.'/functions/page_variables.php'; ?>

<!DOCTYPE html>

<html>

<head>
    <script src="<?php echo get_stylesheet_directory_uri(); ?>/js/aframe.min.js"></script>
    <script src="https://rawgit.com/mayognaise/aframe-mouse-cursor-component/master/dist/aframe-mouse-cursor-component.min.js"></script>
    <script src="https://rawgit.com/ngokevin/aframe-text-component/master/dist/aframe-text-component.min.js"></script>
	<meta name="viewport"    content="user-scalable=1.0,initial-scale=0.85">
	<? wp_head(); ?>
</head>

<body id="page-<?php echo $post->ID ?>" class="<? echo "$body_class"; ?>">  

	<div class="header_menu_wrapper">
	
		<div class="header_block">
		     <div class="header_wrapper page_width">
		         <? echo do_shortcode(stripslashes($site_content_options['admin_header_content'])); ?>
		     </div><!-- header_wrapper -->
		</div><!-- header_block -->
				
		
		<div class="menu_block">
		        <div class="menu_wrapper page_width" id="menu_wrapper_1">
		        		        
		               <div class="menu_toggle_block">
	                      <div class="menu_toggle_wrap lw_class_on_off" data-what="#menu_wrapper_1" data-what-class="on">                    
		                    <div class="top_bar menu_toggle_bar"></div>	                    
		                    <div class="mid_bar menu_toggle_bar"></div>	                    
		                    <div class="bottom_bar menu_toggle_bar"></div>                    
	                      </div> 	        
		               </div>               
		               
				    <div class="menu_div"><?php echo do_shortcode('[display_menu]'); ?></div>   
		        </div><!-- menu_wrapper -->
		</div><!-- menu_block -->    
		
	</div><!-- header_menu_wrapper -->
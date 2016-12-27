<? // template name: Front Page ?>

<?php get_header(); ?>

<? global $post_page_options; ?>

              <div class="content_block">

				    <div class="content_wrapper page_width">               
				                               
                       
		                    <div class="middle_column" id="middle_column_1">
								
										 <?php if (have_posts()) : ?>
										 
										           <?php while (have_posts()) : the_post(); ?>    
		                                           
		                                                <? if ( $post_page_options['show_post_title'] == "active" ) { ?>
				                                           <h1><? the_title(); ?></h1>
				                                        <? } ?>
		                                           
		                                           
			                                            <? if ( $post_page_options['show_post_content'] == "active" ) { ?>
														    <? the_content(); ?>
													    <? } ?> 

		
										 
										           <?php endwhile; ?>
										 
										 <?php endif; ?>  									 
	                               
		                    </div><!-- middle_column -->   
	                    
	                    
	                    <? if ($post_page_options['left_sidebar_active'] == "active") {  ?>
		                    <div class="left_column" id="left_column_1" >
			                    <? echo do_shortcode($post_page_options['left_sidebar_content']); ?>
		                    </div><!-- left_column -->   
	                    <? } ?>
	                    
	                    <? if ($post_page_options['right_sidebar_active'] == "active") {  ?>
		                    <div class="right_column" id="right_column_1" >
		                        <? echo do_shortcode($post_page_options['right_sidebar_content']); ?>
		                    </div><!-- right_column -->   
	                    <? } ?>           
                    

				    </div ><!-- content_wrapper -->  				    
				    
			 </div ><!-- content_block --> 
			 
			 
       <?php get_footer(); ?>
       
  </body>

</html>
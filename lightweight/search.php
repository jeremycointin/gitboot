<? // template name: Search ?>

<?php get_header(); ?>

              <div class="content_block">

				    <div class="content_wrapper page_width">                                        
                    
	                    <div class="middle_column" id="middle_column_1">
							
									 <?php if (have_posts()) : ?>
									 
									           <?php while (have_posts()) : the_post(); ?>    
	                                           
	
		                                           <h1><? the_title(); ?></h1>
		                                           
		                                           
												   <? the_content(); ?>
	
									 
									           <?php endwhile; ?>
									 
									 <?php endif; ?>  									 
                               
	                    </div><!-- middle_column -->    
	                    
	                    
	                    <div class="left_column" id="<? echo $left_sidebar_id; ?>_sidebar" >   
	                    
	                    <div class="right_column" id="<? echo $left_sidebar_id; ?>_sidebar" >                
                    

				    </div ><!-- content_wrapper --> 				    
				    
			 </div ><!-- content_block --> 
			 
			 
       <?php wp_footer(); ?>
       
  </body>

</html>
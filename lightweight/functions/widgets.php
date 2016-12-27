<?
function custom_2108_init() { //1151AM

		if (function_exists('register_sidebar')) {	//1140AM		
			
				 $lw_sidebars   = get_option( 'lw_sidebars' );

				 if (!empty($lw_sidebars)) { //834PM
                     foreach ($lw_sidebars as $lw_sidebar_name => $lw_sidebar_content ){  //711PM
                     
                        $lw_sidebar_widget_slug = make_slug($lw_sidebar_name);
					 
						register_sidebar(array(
							'name' => $lw_sidebar_name,
							'id'   => $lw_sidebar_widget_slug,
							'description'   => __( $lw_sidebar_name, '2108' ),
							'before_widget' => '<div class="widget">',
							'after_widget'  => '</div>',
							'before_title'  => '<div class="widget_title">',
							'after_title'   => '</div>'
						));	           

                     } //711PM 
                } //834PM

		} //1140AM
		
} //1151AM

add_action( 'widgets_init', 'custom_2108_init' );
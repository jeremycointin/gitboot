<?
function add_lw_sidebar() { // 322PM

	if ( !current_user_can('administrator') ) { return; }
	
	if ( !isset($_POST['add_lw_sidebar_submitted'])) { return; }  
	
	if ( !wp_verify_nonce( $_POST['lw_sidebar_nonce'], 'process_lw_sidebar' )) { exit; }
	

    $lw_sidebars                    = get_option( 'lw_sidebars' );
	
	$lw_sidebar_name                = $_POST['lw_sidebar_name'];
	
	$lw_sidebars[$lw_sidebar_name]  = "";
	
	update_option('lw_sidebars',$lw_sidebars);	
	
		
} // 322PM

add_action( 'wp_loaded', 'add_lw_sidebar' );



function side_bar_editor_handler() {

	if (!isset($_POST['side_bar_editor_submitted'])) { return; }
	 
	if ( !current_user_can('administrator') ) { exit; }
	 
	if (!wp_verify_nonce( $_POST['lw_sidebar_editor_handler_nonce'], 'process_lw_sidebar_editor_handler' )) { exit; }
	
	
	$lw_sidebars                                = get_option( 'lw_sidebars' );
	
	$lw_sidebar_name                            = $_POST['lw_sidebar_name'];
	
	$lw_sidebars[$lw_sidebar_name]              = $_POST['lw_sidebar_content'];	
	
	update_option('lw_sidebars',$lw_sidebars);


}

add_action('wp_loaded','side_bar_editor_handler');



function delete_sidebars() { // 322PM

    if ( !current_user_can('administrator') ) { return; }

	if ( !isset($_POST['delete_sidebars_submitted'])) { return; } 
	
	if (!wp_verify_nonce( $_POST['delete_sidebars_nonce'], 'process_delete_sidebars' )) { return; }	
	
	
	          $lw_sidebars = get_option( 'lw_sidebars' );
	
              if (!empty( $_POST['delete_sidebars'] )) { foreach ( $_POST['delete_sidebars'] as $sidebar_name) {
	              unset($lw_sidebars[$sidebar_name]); 
              } }	
              
              update_option('lw_sidebars',$lw_sidebars);			
	
		
} // 322PM

add_action( 'wp_loaded', 'delete_sidebars' );



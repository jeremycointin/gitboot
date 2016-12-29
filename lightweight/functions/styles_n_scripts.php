<?
function lw_frontend_scripts() {

    wp_enqueue_style( 'lw_style', get_template_directory_uri ().'/style.css' );
    wp_enqueue_style( 'media_queries', get_template_directory_uri ().'/css/media_queries.css' );
    
    
    wp_register_script( 'lw_frontend_script', get_template_directory_uri ().'/js/frontend_script.js', array( 'jquery' ) );
	
	$translation_array = array(
		'ajax_url'                => admin_url('admin-ajax.php'),
	);
	
	wp_localize_script( 'lw_frontend_script', 'lw_frontend_vars', $translation_array );
	
	wp_enqueue_script( 'lw_frontend_script' );
	
	
	wp_register_script( 'lw_modernizer_script', get_template_directory_uri ().'/js/modernizer.js', array( 'jquery' ) );
	 
    wp_enqueue_script( 'lw_modernizer_script' );
}

add_action( 'wp_enqueue_scripts', 'lw_frontend_scripts' );


function lw_backend_scripts() {
	wp_enqueue_style( 'lw_backend_style', get_template_directory_uri ().'/css/backend.css' );
    wp_register_script( 'lw_backend_script', get_template_directory_uri ().'/js/backend_script.js', array('jquery','jquery-ui-droppable','jquery-ui-draggable', 'jquery-ui-sortable'));
    wp_enqueue_script('jquery-ui-droppable');
	
	$translation_array2 = array(
		'ajax_url' => admin_url('admin-ajax.php'),
	);
	
	wp_localize_script( 'lw_backend_script', 'lwbackendvars', $translation_array2 );
	
	wp_enqueue_script( 'lw_backend_script' );

}

add_action( 'admin_enqueue_scripts', 'lw_backend_scripts' );


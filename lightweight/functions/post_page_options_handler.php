<?

function added_post_page_options_save( $post_id ) { // 847AM
 
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) // this stops auto save from updating my fields automatically
    return;
 
    if ( !current_user_can('administrator') ) { return; } 
    
    if ( !isset($_POST['post_page_id'])) { return; } 
    
    
    $post_page_id = $_POST['post_page_id'];

    
    
    $cppo_meta  = get_post_meta( $post_page_id, 'post_page_options', true );
    
    
    if (!empty($_POST['wysiwyg'])) { foreach ($_POST['wysiwyg'] as $meta_name => $wysiwyg_value) {
    
	    $_POST[$wysiwyg_value][$meta_name] = $_POST[$meta_name];
	    //echo "wysiwyg value is --->".$_POST[$meta_name];
    
    } }
    
    
    if (!empty($_POST['cppo_separate_meta'])) { foreach ($_POST['cppo_separate_meta'] as $meta_name => $post_value) {
    
	    update_post_meta( $post_page_id, $meta_name, $post_value );
    
    } }
    
    $cppo_meta = $_POST['cppo_meta']; 
    

   
    update_post_meta( $post_page_id, 'post_page_options', $cppo_meta );    
    
 
} // 847AM
 
 
add_action( 'wp_loaded', 'added_post_page_options_save' );



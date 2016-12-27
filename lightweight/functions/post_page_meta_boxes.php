<?
function added_post_page_options_box() {
 
    $screens = array( 'post', 'page' );                         // this is the post type that the box will appear on (post,page,custom post type) separated by commas
 
    foreach ( $screens as $screen ) {                           // 1122AM
 
      add_meta_box(
          'added_post_page_options_box',                        // the id of the div that controls the meta box. Case you want to style it
          __( 'Added Post Page Options', 'studio2108.com' ),    // little title that appears in the meta box in the editor
          'added_post_page_options_content',                    // this is the function that prints the HTML out
          $screen,                                              // this is the post type that the box will appear on (post,page,custom post type)
          'normal',                                             // puts the box under the editor // sometimes I use "side" for side boxes
          'high'                                                // places it first under the editor
      );
 
   } // 1122AM
}

add_action( 'add_meta_boxes', 'added_post_page_options_box' );







function added_post_page_options_content( $post ) { //926AM

     
    wp_nonce_field( plugin_basename( __FILE__ ), 'added_post_page_options_nonce' );   
    
    $post_page_id        = $post->ID;    

	// sets the post page meta
    $post_page_options   = get_post_meta( $post_page_id, 'post_page_options', true );    
    if (empty($post_page_options)) { $post_page_options = array(); }   //var_dump($post_page_options);   
    $site_post_page_options   = get_option( 'site_post_page_options' );      
    if (!empty($site_post_page_options)) { foreach ($site_post_page_options as $option_name) { // 741AM

	    if (empty($post_page_options[$option_name])) {
	        $post_page_options[$option_name] = "";
	    }   
    
    }}  // 741AM  
    
?>
 

    <? 
    if (!empty($site_post_page_options)) { foreach ($site_post_page_options as $key => $input_field) {
    
	    $field_slug          = $input_field['field_slug'];
	    $field_name          = $input_field['field_name'];
	    $field_type          = $input_field['field_type'];
	    $field_values        = $input_field['field_values'];
	    $field_placeholder   = $input_field['field_placeholder'];
	    $field_save_type     = $input_field['field_save_type'];
	    if (empty($cppo_meta[$field_slug])) { $cppo_meta[$field_slug] = ""; }
	    
		if ($field_save_type == "group") { $field_input_name = "cppo_meta"; $field_value = $post_page_options[$field_slug]; } 
		if ($field_save_type == "separate") { $field_input_name = "cppo_separate_meta"; $field_value = get_post_meta( $post->ID, $field_slug, true ); } 
	    
	    switch($field_type) {
			case "text":
		        include 'field_text_setup.php';
		        break;
			case "textarea":
		        include 'field_textarea_setup.php';
		        break;
			case "checkbox":
		        include 'field_checkbox_setup.php';
		        break;
			case "image":
		        include 'field_image_setup.php';
		        break;
			case "select":
		        include 'field_select_setup.php';
		        break;
			case "radio":
		        include 'field_radio_setup.php';
		        break;	
			case "wysiwyg":
		        include 'field_wysiwyg_setup.php';
		        break;	 
	    
	    }
	    
	    $field_input_name = "";	    
    
    } }
    
	    ?> 
 
  
  <input type="hidden" name="post_page_id" value="<? echo $post_page_id; ?>" />
  <div id="this_post_page_id">Page ID: <? echo $post_page_id; ?></div>
   
   
<?
} //926AM 
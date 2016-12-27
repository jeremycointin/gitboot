<?
function custom_content_menu() {
   add_menu_page('Custom Content', 'Custom Content', 'manage_options', 'content','top_level_content');
}
   
function cc_lower_with_underscores($string) {
   
   $string = strtolower ( $string );
      
   $string = str_replace(' ', '_', $string); // Replaces all spaces with hyphens.
   
   return preg_replace('/[^A-Za-z0-9\_]/', '', $string); // Removes special chars.
}
      
function top_level_content() { //844AM
     
     
if(isset($_POST['has_submitted_custom_content'])) { //117PM
    
    if (!wp_verify_nonce( $_POST['custom_content_nonce'], 'process_custom_content' )) { exit; }
     
     
    $custom_content_name         = cc_lower_with_underscores($_POST['custom_content_name']);
    
    if (empty($_POST['custom_content_field_type'])) { $_POST['custom_content_field_type'] = ""; }
    if (empty($_POST['custom_content_data']))       { $_POST['custom_content_data'] = ""; }
    if (empty($_POST['custom_content_link']))       { $_POST['custom_content_link'] = ""; }
       
    $custom_content_field_type   = $_POST['custom_content_field_type'];
    $custom_content_data         = $_POST['custom_content_data'];
    $custom_content_link         = $_POST['custom_content_link'];
       
    $data['custom_content_field_type']  =  $custom_content_field_type;
    $data['custom_content_data']        =  $custom_content_data;
    $data['custom_content_link']        =  $custom_content_link;
        
    $all_custom_content = get_option('custom_content');
  
    if ($custom_content_field_type == "image" && !empty($_FILES["uploaded_image"]["name"])) {
  
        $uploaded_file       = $_FILES["uploaded_image"];
        $listing_id          = $_FILES["uploaded_image"];
           
        if ( ! function_exists( 'wp_handle_upload' ) ) require_once( ABSPATH . 'wp-admin/includes/file.php' );
        $upload_overrides = array( 'test_form' => false );
        $movefile = wp_handle_upload( $uploaded_file, $upload_overrides );
        if ( $movefile ) {
            $return['status'] = "good";
        } else {
            $return['status'] = "bad";
        }   
           
        $data['custom_content_data'] = $movefile['url'];
           
    }
     
     
    if ( !empty($custom_content_name) && !empty($custom_content_field_type)) { $all_custom_content[$custom_content_name] = $data ; }
        
        
                         if (empty($_POST['delete_content']))   { $_POST['delete_content'] = ""; }
                         if ($_POST['delete_content'] == "yes") {  //117PM                         
                             
                            unset($all_custom_content[$custom_content_name]);
                             
                         } //117PM
                           
                           
                  
         
    update_option( 'custom_content', $all_custom_content );
     
     
     
}//117PM
     
     
    $all_custom_content = get_option('custom_content');
     
?>
     
<style>
            
.custom_content_form label {
    display: block;
}   
    
    
.custom_content_form input{
    width :300px;
    padding: 5px;
    margin-bottom: 10px;
}
     
.custom_content_form textarea{
    width :500px;
    height :350px;
    padding: 5px;
    margin-bottom: 10px;
}
    
.content_submit {
    cursor:pointer;
    width: auto !important;
    display: inline-block;
    border: 1px solid #000000;
    border-radius: 6px;
}
    
    
.custom_content_form {
    
   background-color: #C9C7C7;
   padding: 15px;
   margin-bottom: 15px;
}
    
.delete_content {
    width: auto !important;
}
    
.delete_content_wrap {
  display: inline-block;
  margin-left: 340px;
}
    
    
    
.custom_content_form h2 span {
    font-size: 12px;
    display: inline-block;
    margin-left: 300px;
}
   
.custom_content_form .long_text {
    width: 80%;
}
   
.custom_content_form .short_text {
    width: 20%;
}
   
.file_image_wrap img {
    max-height: 200px;
} 
 
.image_link_spacer {
    display: inline-block;
    width: 302px;
    height: 20px;
}
     
</style>
     
<h1>Custom Content</h1>                          
            
        <form class="custom_content_form" method="post" enctype="multipart/form-data">
                <h2>New content</h2>         
                     
                <label>Content Name</label> 
                <input type="text" name="custom_content_name" class="content_name_input" value=""/> 
                     
                <label>Content Data Type</label>  
                <select name="custom_content_field_type">
                    <option value="textarea">textarea</option>
                    <option value="long text">long text</option>
                    <option value="small text">small text</option>
                    <option value="image">image</option>
                </select>
     
                <? wp_nonce_field( 'process_custom_content', 'custom_content_nonce' ); ?>  
                    
                <input type="submit" class="content_submit" value="Submit" />       
                <input type="hidden" name="has_submitted_custom_content" id="custom_content_submitted" value="true" /> 
        </form>
            
            
<? if (!empty($all_custom_content)) { foreach ($all_custom_content as $content_name => $custom_content_data) { //434PM ?>
    
        <? $custom_content      = $custom_content_data['custom_content_data']; ?>
        <? $custom_content_link = $custom_content_data['custom_content_link']; ?>
        <? $field_type          = $custom_content_data['custom_content_field_type']; ?>
   
    
        <form class="custom_content_form" method="post" enctype="multipart/form-data">
                <h2><? echo $content_name; ?>  <span> [content name="<? echo $content_name; ?>"]</span> </h2>         
                     
                 <input type="hidden" name="custom_content_name" class="content_name_input" value="<? echo $content_name; ?>"/> 
                    
                <label>Content Data Type</label>  
                <select name="custom_content_field_type">
                    <option value="<? echo $field_type; ?>"><? echo $field_type; ?></option>
                    <option value="textarea">textarea</option>
                    <option value="long text">long text</option>
                    <option value="small text">small text</option>
                    <option value="image">image</option>
                </select>
                     
                <label>Content Data</label>  
                   
                <? if ($field_type == "textarea") { ?>
                    <textarea  name="custom_content_data" class="content_textarea"><? echo stripslashes($custom_content); ?></textarea> <br />
                <? } ?>
                   
                <? if ($field_type == "small text") { ?>
                    <? $custom_content = stripslashes($custom_content); ?>
                    <? $custom_content = htmlentities($custom_content); ?>
                    <input type="text" name="custom_content_data" class="small_text" value="<? echo $custom_content; ?>" /> <br />
                <? } ?>
                   
                <? if ($field_type == "long text") { ?>
                    <? $custom_content = stripslashes($custom_content); ?>
                    <? $custom_content = htmlentities($custom_content); ?>
                    <input type="text" name="custom_content_data" class="long_text" value="<? echo $custom_content; ?>" /> <br />
                <? } ?>
  
                <? if ($field_type == "image") { ?>
                    <input type="file" name="uploaded_image" />
                    <input type="text" name="custom_content_data" class="long_text" value="<? echo stripslashes($custom_content); ?>" /> <br />
                        <? if (!empty($custom_content)) { ?>
                            <div class="file_image_wrap"><a href="<? echo stripslashes($custom_content); ?>" target="_blank"><img src="<? echo stripslashes($custom_content); ?>" /></a></div>
                        <? } ?>
                    <div class="image_link_spacer"></div>    
                    <input type="text" name="custom_content_link" class="long_text image_link" value="<? echo stripslashes($custom_content_link); ?>" placeholder="IMAGE LINK"/> <br />
                <? } ?>
     
                <? wp_nonce_field( 'process_custom_content', 'custom_content_nonce' ); ?>  
                    
                   
                <input type="submit" class="content_submit" value="Submit" />
                    
                    
                <div class="delete_content_wrap"><input type="checkbox" class="delete_content" name="delete_content" value="yes" /><span>DELETE content</span></div>
                    
                           
                <input type="hidden" name="has_submitted_custom_content" id="custom_content_submitted" value="true" /> 
        </form>
    
    
    
<? } } //434PM        
            
            
             
} //844AM
     
add_action('admin_menu', 'custom_content_menu');
    
    
    
function custom_content_shortcode( $atts ){
    
    extract( shortcode_atts( array(
        'name' => '',
        'display_image' => false,
    ), $atts ) );
      
    $all_custom_content = get_option('custom_content');
    $content = "";
     
    if (!empty($all_custom_content[$name]['custom_content_link'])) { $content .= "<a href='".$all_custom_content[$name]['custom_content_link']."'>"; } 
    if ($display_image == true && !empty($all_custom_content[$name]['custom_content_data'])) { 
        $image_url = stripslashes($all_custom_content[$name]['custom_content_data']);
        $content .= "<img src='$image_url' />";
    }else{  
        $content .= stripslashes($all_custom_content[$name]['custom_content_data']);
    }
             
    if (!empty($all_custom_content[$name]['custom_content_link'])) { $content .= "</a>"; } 
    
    return $content;
}
    
add_shortcode( 'content', 'custom_content_shortcode' ); 







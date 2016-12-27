<?
function site_post_page_options_handler() {

    if ( !current_user_can('administrator') ) { return; } 
    
    if ( !isset($_POST['site_post_page_options_submitted'])) { return; }

    if (!empty($_POST['field_name'])) { foreach( $_POST['field_name'] as $key => $field_name ) { 
    
	    if (empty($field_name)) { continue; }
	    if (empty($_POST['field_slug'][$key])) { $_POST['field_slug'][$key] = $field_name; }
	    
	    $cppo_fields[$key]['field_name']        =  $field_name;
	    $cppo_fields[$key]['field_slug']        =  lower_with_underscores($_POST['field_slug'][$key]);
	    $cppo_fields[$key]['field_type']        =  $_POST['field_type'][$key];
	    $cppo_fields[$key]['field_values']      =  $_POST['field_values'][$key];
	    $cppo_fields[$key]['field_placeholder'] =  $_POST['field_placeholder'][$key];
	    $cppo_fields[$key]['field_save_type']   =  $_POST['field_save_type'][$key];
    
    }   $all_cppo_fields = $cppo_fields;  }
	
	
    update_option( 'site_post_page_options', $all_cppo_fields );

}

add_action ('wp_loaded', 'site_post_page_options_handler');







function post_page_options_display() {

    $cppo_fields   = get_option( 'site_post_page_options' );
    
?>

<h1>Site Post Page Options</h1>
<form id="header_content_form" action="" method="post" enctype="multipart/form-data"> 





	        <div class="cppo_fields_wrap">
		        <label>Custom Meta Input Fields</label> <br />
				<div class="add_sppo_field" data-id="">ADD FIELD</div>
				<div class="all_cppo_fields" id="all_cppo_fields_1">
				    <? if (!empty($cppo_fields)) { foreach( $cppo_fields as $key => $input_field_data ) { ?>
						<div class="custom_meta_input_wrap">
							<span class="drag_indicator"></span>
							<span class="delete_this">x</span>
						    <label>Field Name</label>
						    <input type="text" name="field_name[]" value="<? echo $input_field_data["field_name"]; ?>" class="meta_input_field" /> 
						    <label>Field Slug</label>
						    <input type="text" name="field_slug[]" value="<? echo $input_field_data["field_slug"]; ?>" class="meta_input_field" />
						    <label>Field Type</label>
						    <select name="field_type[]" class="meta_input_field field_type">  
						        <option value="<? echo $input_field_data["field_type"]; ?>"><? echo $input_field_data["field_type"]; ?></option> 
						        <option value="text">text</option> 
						        <option value="textarea">textarea</option> 
						        <option value="checkbox">checkbox</option>         
						        <option value="image">image</option> 
						        <option value="select">select</option> 
						        <option value="radio">radio</option> 
						        <option value="wysiwyg">WYSIWYG</option> 
						    </select> 
						    <br />
						    <label>Field Values</label>
						    <input type="text" name="field_values[]" placeholder="value,label/value,label/value,label" value="<? echo $input_field_data["field_values"]; ?>" class="meta_input_field field_type">  
						    <label>Placeholder</label>
						    <input type="text" name="field_placeholder[]" placeholder="" value="<? echo $input_field_data["field_placeholder"]; ?>" class="meta_input_field field_type"> 
						    <label>Save Type</label>
						    <select name="field_save_type[]" class="meta_input_field field_type">  
							    <? if (!empty($input_field_data["field_save_type"])) { ?>
						            <option value="<? echo $input_field_data["field_save_type"]; ?>"><? echo $input_field_data["field_save_type"]; ?></option> 
						        <? } ?>
						        <option value="group">group</option> 
						        <option value="separate">separate</option> 
						    </select> 
						</div> 
				    <? } } ?>
				</div>
            </div>
	
	
	
	
	
	
	<input type="hidden" name="site_post_page_options_submitted" value="true" />
	<input type="submit" value="Submit" />
</form>



<?
}
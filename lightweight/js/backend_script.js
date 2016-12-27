jQuery(document).ready(function($) {

	var ajax_url = lwbackendvars.ajax_url;
	
	$( ".lw_class_on_off" ).click(function() { //2AM ON AND OFF

	  var what        = $(this).attr("data-what");
	  if (what == "parent") { what =  $(this).parent(); }
	  if (what == "this")   { what =  $(this); }
	  var what_class      = $(this).attr("data-what-class");
	  var what_class_off  = $(this).attr("data-what-class-off");
	  var has_class       = false;
	  if ($(what).hasClass( what_class )) { has_class   = true; }
      if (what_class_off != "undefined") { $( what_class_off ).removeClass( what_class ); }
	  
	  
	  if (has_class == false) {
	      $(what).addClass(what_class);
	  }else{
	      $(what).removeClass(what_class);
	  }
	   
	}); //2AM ON AND OFF
	
	
	$(document).on("click", '.add_sppo_field', function (event) { //1AM 
	    var field_html  = "<div class='custom_meta_input_wrap'>";
	        field_html += "<label>Field Name</label><input type='text' name='field_name[]' vale='' class='meta_input_field' />"; 
	        field_html += "<label>Field Slug</label><input type='text' name='field_slug[]' vale='' class='meta_input_field' />";
	        field_html += "<label>Field Type</label><select name='field_type[]' class='meta_input_field'>";  
	        field_html += "                            <option value='text'>text</option>"; 
	        field_html += "                            <option value='textarea'>textarea</option>"; 
	        field_html += "                            <option value='checkbox'>checkbox</option>";         
	        field_html += "                            <option value='image'>image</option>"; 
	        field_html += "                            <option value='select'>select</option>"; 
	        field_html += "                            <option value='radio'>radio</option>"; 
	        field_html += "                            <option value='wysiwyg'>wysiwyg</option>"; 
	        field_html += "                          </select><br />"; 
	        field_html += "<label>Field Values</label><input type='text' name='field_values[]' placeholder='value,label/value,label/value,label'>"; 
	        field_html += "<label>Placeholder</label><input type='text' name='field_placeholder[]' placeholder=''>"; 
	        field_html += "<label>Save Type</label><select name='save_type[]' class='meta_input_field'>";  
	        field_html += "                            <option value='group'>group</option>"; 
	        field_html += "                            <option value='separate'>separate</option>"; 
	        field_html += "                          </select><br />"; 
	        field_html += "</div>"; 
	    $(this).siblings('.all_cppo_fields').append(field_html);
	
	}); //1AM 
	
	$(document).on("click", '.cppo_checkbox', function (event) { //1AM 
	
		var current_value = $(this).siblings('.checkbox_value').val();
		
		
		if (current_value == "true" ) {
		    $(this).siblings('.checkbox_value').val("false");
		    $(this).parent().removeClass('true');
		}else{
			$(this).siblings('.checkbox_value').val("true");
			$(this).parent().addClass('true');
		}
		

	    
	}); //1AM 

	
	$(document).on('change', '.cppo_set_image', function() {
	

	
	     var parent_div = $(this).parent();
	    
	    
	
		//var append_where     = $(this).attr("data-append-where");
	
	
	    formdata = false;
	    
		  if (window.FormData) {
		    formdata = new FormData();
		    var uploaded_image = this.files;
		    formdata.append("uploaded_image", uploaded_image[0]);
		    formdata.append("action", "cpt_pic_handler");
		  }
		  
		  
		if (formdata) {
		  $.ajax({
		    url: ajax_url,
		    type: "POST",
		    data: formdata,
		    processData: false,
		    contentType: false,
		    success: function (res) {
	
				response = JSON.parse(res);
				
				console.log(response.status);
				console.log(response.url);

				parent_div.children('.display_image').html('<img src="'+response.url+'" class="image_preview" />');
				
				parent_div.children('.image_src').val(response.url);
				
	
		    }
		  });
		}
				
	}); 
	
	if ( $.isFunction($.fn.sortable) ) { 
	    $( "#all_cppo_fields_1" ).sortable({    placeholder: "ui-sortable-placeholder", handle: ".drag_indicator"   }); // MAKES ADMIN SLIDES SORTABLE 
    }
	
	$(document).on("click", '.delete_this', function (event) { //1AM 
		$(this).parent().remove();
	});
	
});
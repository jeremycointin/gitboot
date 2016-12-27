<? 

function header_display() { // 816AM

$site_content_options = get_option( 'site_content_options' );

$header_content = stripslashes($site_content_options['admin_header_content']);

?>
 
<style>
 
.admin_header_form { padding: 50px; }

#wp-admin_header_content-wrap { margin-bottom: 25px; }

input[type="submit"] { cursor: pointer; }
 
</style>

<h1>Header</h1>


<form class="admin_header_form" method="post" enctype="multipart/form-data">

	<? wp_editor( $header_content, "admin_header_content" ); ?>
	
	<input type="hidden" name="admin_header_has_submitted" value="true" />
	
	<input type="submit" value="submit" />

</form>

<? } // 816AM
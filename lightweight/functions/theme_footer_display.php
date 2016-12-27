<? 

function footer_display() { // 816AM

$site_content_options = get_option( 'site_content_options' );

$footer_content = stripslashes($site_content_options['admin_footer_content']);

 ?>
 
 <style>
 
.admin_footer_form { padding: 50px; }

#wp-admin_footer_content-wrap { margin-bottom: 25px; }

input[type="submit"] { cursor: pointer; }
 
 </style>

<h1>Footer</h1>


<form class="admin_footer_form" method="post" enctype="multipart/form-data">

<? wp_editor( $footer_content, "admin_footer_content" ); ?>


<input type="hidden" name="admin_footer_has_submitted" value="true" />

<input type="submit" value="submit" />

</form>

<? } // 816AM
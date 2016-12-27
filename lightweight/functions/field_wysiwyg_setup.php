<div class="cppo_meta_input_wrap">
	<label><? echo $field_name; ?></label>
	<div class="cppo_wysiwyg">
	<? wp_editor( stripslashes($field_value), $field_slug ); ?>
	</div>
	<input type="hidden" name="wysiwyg[<? echo $field_slug; ?>]" value="<? echo $field_input_name; ?>">
</div>
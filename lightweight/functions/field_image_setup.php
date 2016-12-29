<div class="cppo_meta_input_wrap <? echo $cppo_meta[$field_slug]; ?>">
	<label><? echo $field_name; ?></label>	
    <input type="file" name="cppo_set_image" class="ib cppo_set_image" />
    <div class="display_image">
    <? if (!empty($field_value)) { ?>
	    <img src="<? echo $field_value; ?>" class="image_preview"/>
    <? } ?>
    </div>
	<input type="text" class="image_src" name="<? echo $field_input_name; ?>[<? echo $field_slug; ?>]" value="<? echo $field_value; ?>" placeholder="<? echo $field_name; ?> SRC"/>
</div>
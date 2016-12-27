<div class="cppo_meta_input_wrap">
<label><? echo $field_name; ?></label>
<select name="<? echo $field_input_name; ?>[<? echo $field_slug; ?>]">
<option value=""></option>
<?
$pairs = explode("/",$field_values); 
if (!empty($pairs)) { foreach ( $pairs as $pair) {
	$data = explode(",",$pair);
	if ($field_value == $data[0]) { $select_text = "selected='selected'"; }else{ $select_text = ""; }
	?>
		<option value="<? echo $data[0]; ?>" <? echo $select_text; ?>><? echo $data[1]; ?></option>
	<?
}}
?>
</select>
</div>
<div class="cppo_meta_input_wrap">
<label><? echo $field_name; ?></label>
<?
$pairs = explode("/",$field_values); 
if (!empty($pairs)) { foreach ( $pairs as $pair) {
	$data = explode(",",$pair);
	if ($field_value == $data[0]) { $select_text = "checked='checked'"; }else{ $select_text = ""; }
	?>
		<input type="radio" name="<? echo $field_input_name; ?>[<? echo $field_slug; ?>]" value="<? echo $data[0]; ?>" <? echo $select_text; ?>/><? echo $data[1]; ?>
	<?
}}
?>
</div>
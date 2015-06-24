<?php
	$random_select = false;
	$i = 0;
	if ( empty($value) ){
		$random_select = rand( 0, count( $options ) );
	}
?>
<?php foreach($options as $opt_value=>$opt_name): ?>
	<?php if ( false !== $random_select && $i = $random_select ){ $value = $opt_value; } ?>
	<label>
		<input type="radio" name="<?php echo $id?>" id="<?php echo $id?>_<?php echo $opt_value ?>" value="<?php echo $opt_value?>" <?php checked($value, $opt_value)?> />
		<?php echo $opt_name . '&nbsp;&nbsp;'?>
	</label>
	<?php $i++; ?>
<?php endforeach ?>

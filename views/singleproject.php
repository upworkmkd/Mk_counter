<?php
$options=get_option("mk_countdown_setting");
$lavel=isset($options['showlabel']) ? $options['showlabel'] : true;
$fontsize=isset($options['fontsize']) ? $options['fontsize'] : 'md';
$playsound=isset($options['playsound']) ? $options['playsound'] : false;
$format=isset($options['format']) ? $options['format'] : "DHMS";
?>
<div class="mk_single_post" id="mk_post<?php echo $post->ID; ?>">
	<?php 
		$expiraydate=get_post_meta($post->ID,'project_fields_project_date',true); 
	?>
	<div class="post_thumb"><?php echo get_the_post_thumbnail($post->ID,'large'); ?></div>
	<div class="mk_counter" id="mk_counter<?php echo $post->ID; ?>"></div>
	<script>
		jQuery('#mk_counter<?php echo $post->ID; ?>').countdowntimer({
			dateAndTime : "<?php echo $expiraydate; ?>",
			labelsFormat : <?php echo $lavel; ?>,
			displayFormat : "<?php echo $format; ?>",
			size : '<?php echo $fontsize; ?>'
		});
	</script>
	
</div>

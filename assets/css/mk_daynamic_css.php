<?php
	header('Content-type: text/css');
   require '../../../../../wp-load.php'; // load wordpress bootstrap, this is what I don't like
   $options=get_option("mk_countdown_setting");
	$bcolor=isset($options['bordercolor']) ? $options['bordercolor'] : '#F0068E';
	$font_color=isset($options['font_color']) ? $options['font_color'] : '#FFFFFF';
	$border=isset($options['border']) ? $options['border'] : '2';
	$backcolor=isset($options['background']) ? $options['background'] : '#000';
	$width=isset($options['no_of_cl']) ? round(100/$options['no_of_cl']-1).'%' : '49%';
   
?>
.mk_single_post{
	width: <?php echo $width; ?>;
}
.colorDefinition{
	border-color: <?php echo $bcolor; ?> !important;
	background: <?php echo $backcolor; ?> !important;
	color: <?php echo $font_color; ?>;
	border: <?php echo $border; ?>px solid;
}
.labelformat {
    border-width: <?php echo $border; ?>px;
}
.displaySection{
	border-right: <?php echo $border; ?>px solid <?php echo $bcolor; ?>;
}

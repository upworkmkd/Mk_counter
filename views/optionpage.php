<style>
label {
    width: 124px;
    display: inline-block;
}
.mk_form_group {
    padding: 10px 0px 10px 0px;
}
</style>
<?php //echo "<pre>"; print_r($options); ?>
<div class="wrap">
	<h2>Countdown Setting</h2>
	<p class="mk_info">
		Use shortcode <b>[Mk_CounterPosts]</b> in your pages to display countdown projects.
	</p>
	<form method="post">
		<div class="mk_row">
			<div class="mk-col-6">
				<div class="mk_form_group">
					<label for="border">Grid Column</label>
					<input type="text" name="Options[format]" value="<?php echo isset($options['format']) ? $options['format'] : 'DHMS';  ?>" class="mk-input">
					<i>i.e YODHMS</i>
				</div>
			</div>
		</div>
		<div class="mk_row">
			<div class="mk-col-6">
				<div class="mk_form_group">
					<label for="border">Grid Column</label>
					<input type="number" name="Options[no_of_cl]" value="<?php echo isset($options['no_of_cl']) ? $options['no_of_cl'] : '';  ?>" class="mk-input">
				</div>
			</div>
		</div>
		<div class="mk_row">
			<div class="mk-col-6">
				<div class="mk_form_group">
					<label for="border">Border Color</label>
					<input type="text" name="Options[bordercolor]" value="<?php echo isset($options['bordercolor']) ? $options['bordercolor'] : '';  ?> " class="mk-input">
				</div>
			</div>
		</div>
		<div class="mk_row">
			<div class="mk-col-6">
				<div class="mk_form_group">
					<label for="border">Border</label>
					<input type="number" name="Options[border]" value="<?php echo isset($options['border']) ? $options['border'] : '';  ?>" class="mk-input">
				</div>
			</div>
		</div>
		<div class="mk_row">
			<div class="mk-col-6">
				<div class="mk_form_group">
					<label for="border">Background Color</label>
					<input type="text" name="Options[background]" value="<?php echo isset($options['background']) ? $options['background'] : '';  ?>"  class="mk-input">
				</div>
			</div>
		</div>
		<div class="mk_row">
			<div class="mk-col-6">
				<div class="mk_form_group">
					<label for="border">Font Color</label>
					<input type="text" name="Options[font_color]" value="<?php echo isset($options['font_color']) ? $options['font_color'] : '';  ?>"  class="mk-input">
				</div>
			</div>
		</div>
		<div class="mk_row">
			<div class="mk-col-6">
				<div class="mk_form_group">
					<label for="border">Font Size</label>
					<select name="Options[fontsize]">
						<option <?php echo isset($options['fontsize']) && $options['fontsize']=='xl' ? "selected" : '';  ?>  value="xl">Extra Large</option>
						<option <?php echo isset($options['fontsize']) && $options['fontsize']=='lg' ? "selected" : '';  ?> value="lg">Large</option>
						<option <?php echo isset($options['fontsize']) && $options['fontsize']=='md' ? "selected" : '';  ?> value="md">Medium</option>
						<option <?php echo isset($options['fontsize']) && $options['fontsize']=='sm' ? "selected" : '';  ?> value="sm">Small</option>
						<option <?php echo isset($options['fontsize']) && $options['fontsize']=='xm' ? "selected" : '';  ?> value="xm">Extra Small</option>
					</select>
				</div>
			</div>
		</div>
		<div class="mk_row">
			<div class="mk-col-6">
				<div class="mk_form_group">
					<label for="border">Show Label</label>
					<select name="Options[showlabel]">
						<option <?php echo isset($options['showlabel']) && $options['showlabel']=='true' ? "selected" : '';  ?>  value="true">Yes</option>
						<option <?php echo isset($options['showlabel']) && $options['showlabel']=='false' ? "selected" : '';  ?> value="false">No</option>
					</select>
				</div>
			</div>
		</div>
		<div class="mk_row">
			<div class="mk-col-6">
				<div class="mk_form_group">
					<label for="border">Play Sound</label>
					<select name="Options[playsound]">
						<option <?php echo isset($options['playsound']) && $options['playsound']=='false' ? "selected" : '';  ?> value="false">No</option>
						<option <?php echo isset($options['playsound']) && $options['playsound']=='true' ? "selected" : '';  ?>  value="true">Yes</option>
					</select>
				</div>
			</div>
		</div>
		<input type="submit" name="save_mk_option">
	</form>
</div>

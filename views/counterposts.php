<div class="mk_Counter_wrap">
	<?php if(!empty($posts)): ?>
		<?php foreach($posts as $key=>$post): ?>
			<a href="<?php echo get_the_permalink($post->ID); ?>">
				<div class="mk_single_post" id="mk_post<?php echo $post->ID; ?>">
					<?php 
						$expiraydate=get_post_meta($post->ID,'project_fields_project_date',true); 
					?>
					<div class="post_thumb"><?php echo get_the_post_thumbnail($post->ID,'large'); ?></div>
					<div class="mk_counter" id="mk_counter<?php echo $post->ID; ?>"></div>
					<script>
						jQuery('#mk_counter<?php echo $post->ID; ?>').countdowntimer({
							dateAndTime : "<?php echo $expiraydate; ?>",
							labelsFormat : true,
							displayFormat : "YODHMS"
						});
					</script>
					
				</div>
			</a>	
		<?php endforeach; ?>
	<?php else: ?>
		<div class="mk_error">Sorry! No posts to display please create some posts.</div>
	<?php endif; ?>
</div>

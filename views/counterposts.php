<div class="mk_Counter_wrap">
	<?php if(!empty($posts)): ?>
		<?php foreach($posts as $key=>$post): ?>
			<a href="<?php echo get_the_permalink($post->ID); ?>">
				<?php echo $content=MkCounterView('singleproject',array('post'=>$post)); ?>
			</a>	
		<?php endforeach; ?>
		<?php if($playsound): ?>
			<audio src="<?php echo MKCOUNTER_URL ;?>/assets/reloj.mp3" autoplay="true" loop="true"></audio>
		<?php endif; ?>	
	<?php else: ?>
		<div class="mk_error">Sorry! No posts to display please create some posts.</div>
	<?php endif; ?>
</div>

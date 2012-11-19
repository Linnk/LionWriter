<?php if(isset($page['email'])): ?>

	<div class="profile">
		<img src="http://www.gravatar.com/avatar/<?php echo md5(trim($page['email'])) ?>" class="img-circle" align="left" />
		<div class="info">
			<p><strong><?php echo $page['author'] ?></strong> <span class="muted">— <?php echo $page['date'] ?></span></p>
			<?php if(isset($page['epilogue'])): ?>
				<p><?php echo $page['epilogue'] ?></p>
			<?php endif; ?>
			<p><a href="/">Return to home.</a></p>
		</div>
		
	</div>

<?php endif; ?>
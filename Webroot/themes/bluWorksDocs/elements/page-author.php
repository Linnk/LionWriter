<?php if(isset($page['email'])): ?>

	<div class="profile">
		<hr />
		<img src="http://www.gravatar.com/avatar/<?php echo md5(trim($page['email'])) ?>" class="avatar img-circle" align="left" />
		<div class="info">
			<p><strong><?php echo $page['author'] ?></strong><br /><em class="text-muted"><?php echo $page['date'] ?></em></p>
			<?php if(isset($page['epilogue'])): ?>
				<p><?php echo $page['epilogue'] ?></p>
			<?php endif; ?>
			<p><a href="/">Return to home</a></p>
		</div>
	</div>

<?php endif; ?>
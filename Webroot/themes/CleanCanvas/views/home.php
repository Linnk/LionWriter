<div class="content">

<?php if(isset($pages[0])): $page = array_shift($pages);?>

	<h2><a href="<?php echo $page['permalink'] ?>"><?php echo $page['title'] ?></a></h2>
	<?php echo $page['content'] ?>

<?php endif; ?>

	<h2>More</h2>
	<ul class="list-pages">
	<?php foreach($pages as $page): ?>
		<li>
			<span class="page-date"><?php echo $page['date'] ?></span> <span class="script-dialog">—</span> <a href="<?php echo $page['permalink'] ?>"><?php echo $page['title'] ?></a>
			<p><?php echo $page['excerpt'] ?>…</p>
		</li>
	<?php endforeach; ?>
	</ul>
	
</div>
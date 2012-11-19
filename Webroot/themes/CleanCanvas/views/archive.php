<div class="row row-static">
	<h2>List of pages:</h2>
	<ol class="list-pages">
	<?php foreach($pages as $page): ?>
		<li><span class="page-date"><?php echo $page['date'] ?></span> <span class="script-dialog">—</span> <a href="<?php echo $page['permalink'] ?>"><?php echo $page['title'] ?></a></li>
	<?php endforeach; ?>
	</ol>
</div>

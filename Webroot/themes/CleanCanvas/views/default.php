<div class="content">

<?php if(isset($page)): ?>

	<h2><?php echo $page['title'] ?></h2>
	<?php echo $page['content'] ?>

<?php elseif(isset($pages)): ?>

	<hr />
	
	<h2>List of pages:</h2>
	<ol class="list-pages">
	<?php foreach($pages as $page): ?>
		<li><span class="page-date"><?php echo $page['date'] ?></span> <span class="script-dialog">—</span> <a href="<?php echo $page['permalink'] ?>"><?php echo $page['title'] ?></a></li>
	<?php endforeach; ?>
	</ol>

<?php else: ?>

	<p>I didn't recieve anything :( </p>

<?php endif; ?>

</div>